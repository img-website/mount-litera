<?php
/**
 * Mount Litera Zee School (MLZS) Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

/** IDE stubs for Imagick (never executed; removes "undefined type" in Cursor/Intelephense) */
if (false) {
    class Imagick {
        public const ALPHACHANNEL_ACTIVATE = 1;
        public function __construct($files = null) {}
        public function setImageFormat($format) {}
        public function setImageAlphaChannel($channel) {}
        public function setBackgroundColor($background) {}
        public function setImageCompressionQuality($quality) {}
        public function writeImage($filename = null) {}
        public function clear() {}
        public function destroy() {}
    }
    class ImagickPixel {
        public function __construct($color = null) {}
    }
}

/**
 * Theme setup: title-tag, post-thumbnails, etc.
 */
function mlzs_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
}
add_action('after_setup_theme', 'mlzs_theme_setup');

/**
 * Convert any uploaded image to WebP before saving to media library.
 * Runs on wp_handle_upload – supports JPEG, PNG, GIF; saves as WebP.
 */
function mlzs_convert_upload_to_webp($upload) {
    if (empty($upload['file']) || empty($upload['type']) || strpos($upload['type'], 'image/') !== 0) {
        return $upload;
    }
    $mime = $upload['type'];
    $allowed = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');
    if (!in_array($mime, $allowed, true)) {
        return $upload;
    }
    $file_path = $upload['file'];
    if (!is_file($file_path) || !is_readable($file_path)) {
        return $upload;
    }
    $webp_path = preg_replace('/\.(jpe?g|png|gif|webp)$/i', '.webp', $file_path);
    if ($webp_path === $file_path) {
        return $upload;
    }
    $converted = mlzs_image_to_webp($file_path, $webp_path, $mime);
    if (!$converted) {
        return $upload;
    }
    @unlink($file_path);
    $upload['file'] = $webp_path;
    $upload['url'] = str_replace(wp_basename($file_path), wp_basename($webp_path), $upload['url']);
    $upload['type'] = 'image/webp';
    return $upload;
}
add_filter('wp_handle_upload', 'mlzs_convert_upload_to_webp', 10, 2);

/**
 * Convert image file to WebP using GD or Imagick.
 *
 * @param string $source_path Full path to source image.
 * @param string $webp_path   Full path for WebP output.
 * @param string $mime        Mime type of source (image/jpeg, image/png, etc.).
 * @return bool True if conversion succeeded.
 */
function mlzs_image_to_webp($source_path, $webp_path, $mime) {
    if (extension_loaded('imagick') && class_exists('Imagick')) {
        try {
            $img = new Imagick($source_path);
            $img->setImageFormat('webp');
            if ($mime === 'image/png' || $mime === 'image/gif') {
                $img->setImageAlphaChannel(Imagick::ALPHACHANNEL_ACTIVATE);
                $img->setBackgroundColor(new ImagickPixel('transparent'));
            }
            $img->setImageCompressionQuality(82);
            $success = $img->writeImage($webp_path);
            $img->clear();
            $img->destroy();
            return $success && is_file($webp_path);
        } catch (Exception $e) {
            return false;
        }
    }
    if (!function_exists('imagewebp')) {
        return false;
    }
    switch ($mime) {
        case 'image/jpeg':
        case 'image/jpg':
            $image = @imagecreatefromjpeg($source_path);
            break;
        case 'image/png':
            $image = @imagecreatefrompng($source_path);
            if ($image) {
                imagealphablending($image, false);
                imagesavealpha($image, true);
            }
            break;
        case 'image/gif':
            $image = @imagecreatefromgif($source_path);
            if ($image) {
                imagealphablending($image, false);
                imagesavealpha($image, true);
            }
            break;
        case 'image/webp':
            $image = @imagecreatefromwebp($source_path);
            break;
        default:
            return false;
    }
    if (!$image) {
        return false;
    }
    if ($mime === 'image/png' || $mime === 'image/gif') {
        imagepalettetotruecolor($image);
        imagealphablending($image, false);
        imagesavealpha($image, true);
    }
    $result = imagewebp($image, $webp_path, 82);
    imagedestroy($image);
    return $result && is_file($webp_path);
}

/**
 * Ensure attachment metadata and mime type are set to WebP when file was converted.
 */
function mlzs_attachment_webp_metadata($metadata, $attachment_id) {
    $file = get_attached_file($attachment_id);
    if ($file && is_file($file) && strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'webp') {
        wp_update_post(array(
            'ID'             => $attachment_id,
            'post_mime_type' => 'image/webp',
        ));
        if (is_array($metadata) && !empty($metadata['file'])) {
            $metadata['file'] = wp_basename($file);
        }
    }
    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'mlzs_attachment_webp_metadata', 10, 2);

/**
 * Enqueue styles and scripts the WordPress way.
 */
function mlzs_enqueue_assets() {
    $theme_uri = get_template_directory_uri();
    $theme_version = wp_get_theme()->get('Version') ?: '1.0.0';

    // Google Fonts
    wp_enqueue_style(
        'mlzs-google-fonts',
        'https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;700&display=swap',
        array(),
        null
    );
    wp_enqueue_style(
        'mlzs-google-fonts-2',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap',
        array(),
        null
    );

    // Swiper CSS
    wp_enqueue_style(
        'swiper-bundle',
        'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css',
        array(),
        '8'
    );

    // Theme custom CSS (scrollbar, Swiper overrides)
    wp_enqueue_style(
        'mlzs-custom',
        $theme_uri . '/assets/css/custom.css',
        array('swiper-bundle'),
        $theme_version
    );

    // Tailwind CDN (script loads CSS via CDN)
    wp_enqueue_script(
        'tailwindcss',
        'https://cdn.tailwindcss.com?plugins=forms,container-queries',
        array(),
        '3',
        false
    );

    // Tailwind config (inline, must run after Tailwind)
    $tailwind_config = "
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'primary': '#3D348B',
                        'primary-dark': '#2d2566',
                        'primary-light': '#7678ED',
                        'primary-lighter': '#9a9cf0',
                        'secondary': '#F7B801',
                        'accent': '#F7B801',
                        'accent-dark': '#F18701',
                        'accent-light': '#F35B04',
                        'indigo-velvet': '#3D348B',
                        'slate-blue': '#7678ED',
                        'amber-flame': '#F7B801',
                        'tiger-orange': '#F18701',
                        'cayenne-red': '#F35B04',
                        'surface': '#ffffff',
                        'background-light': '#f8fafc',
                        'background-dark': '#111827',
                        'surface-light': '#ffffff',
                        'surface-dark': '#1f2937',
                        'text-main-light': '#0f172a',
                        'text-main-dark': '#f8fafc',
                        'text-secondary-light': '#475569',
                        'text-secondary-dark': '#94a3b8',
                        'border-light': '#e2e8f0',
                        'border-dark': '#374151',
                        'dark-text': '#1e293b',
                        'card-dark': '#1e293b',
                    },
                    fontFamily: {
                        'display': ['Spline Sans', 'sans-serif'],
                        'body': ['Noto Sans', 'sans-serif'],
                    },
                    borderRadius: {
                        'DEFAULT': '1rem',
                        'lg': '1.5rem',
                        'xl': '2rem',
                        '2xl': '2.5rem',
                        'full': '9999px'
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                        'fade-in': 'fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1)',
                        'hero-zoom': 'heroZoom 8s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        heroZoom: {
                            '0%, 100%': { transform: 'scale(1.1)' },
                            '50%': { transform: 'scale(1.2)' },
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(61, 52, 139, 0.05)',
                        'glow': '0 0 20px -5px rgba(61, 52, 139, 0.3)',
                        'glow-accent': '0 0 20px -5px rgba(247, 184, 1, 0.4)',
                    }
                },
            },
        };
    ";
    wp_add_inline_script('tailwindcss', $tailwind_config, 'after');

    // Lucide Icons (UMD build for createIcons())
    wp_enqueue_script(
        'lucide-icons',
        'https://unpkg.com/lucide@latest/dist/umd/lucide.min.js',
        array(),
        null,
        true
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper-bundle',
        'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js',
        array(),
        '8',
        true
    );

    // Theme main JS (header scroll, menu toggle, Lucide, Hero/Approach Swiper, Academics tabs)
    wp_enqueue_script(
        'mlzs-main',
        $theme_uri . '/assets/Js/main.js',
        array('swiper-bundle', 'lucide-icons'),
        $theme_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'mlzs_enqueue_assets');

/**
 * ACF Pro: Home Page Sections – Hero, Welcome, etc. (section-wise tabs when editing Home page)
 */
function mlzs_acf_hero_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_hero',
        'title'                 => 'Home Page Sections',
        'fields'                => array(
            array(
                'key'   => 'field_tab_hero',
                'label' => __('Hero Section', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_hero_slides',
                'label' => __('Hero Slides', 'mlzs'),
                'name'  => 'hero_slides',
                'type'  => 'repeater',
                'instructions' => __('Background images for the hero carousel. Add at least one.', 'mlzs'),
                'min'   => 1,
                'layout' => 'block',
                'button_label' => __('Add Slide', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key'   => 'field_hero_slide_image',
                        'label' => __('Slide Image', 'mlzs'),
                        'name'  => 'slide_image',
                        'type'  => 'image',
                        'required' => 1,
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                ),
            ),
            array(
                'key'   => 'field_hero_badge_text',
                'label' => __('Badge Text', 'mlzs'),
                'name'  => 'hero_badge_text',
                'type'  => 'text',
                'default_value' => 'Admissions Open for 2025-26',
            ),
            array(
                'key'   => 'field_hero_headline_line1',
                'label' => __('Headline (First Line)', 'mlzs'),
                'name'  => 'hero_headline_line1',
                'type'  => 'text',
                'default_value' => 'Fun. Study. Research.',
            ),
            array(
                'key'   => 'field_hero_headline_highlight',
                'label' => __('Headline (Highlighted Part)', 'mlzs'),
                'name'  => 'hero_headline_highlight',
                'type'  => 'text',
                'default_value' => 'Innovate. Play',
            ),
            array(
                'key'   => 'field_hero_subheadline',
                'label' => __('Subheadline', 'mlzs'),
                'name'  => 'hero_subheadline',
                'type'  => 'textarea',
                'default_value' => 'A Great School For A Great Future Of Your Child. Mount Litera Zee School will provide a complete and unique educational experience for the child, preparing the child for a successful life in the contemporary society.',
                'rows'  => 3,
            ),
            array(
                'key'   => 'field_hero_cta_primary',
                'label' => __('Primary Button Link', 'mlzs'),
                'name'  => 'hero_cta_primary',
                'type'  => 'link',
                'return_format' => 'array',
                'instructions' => __('Button text and URL in one link field.', 'mlzs'),
            ),
            array(
                'key'   => 'field_hero_cta_primary_icon',
                'label' => __('Primary Button Icon', 'mlzs'),
                'name'  => 'hero_cta_primary_icon',
                'type'  => 'text',
                'placeholder' => 'e.g. arrow-up-right',
                'default_value' => 'arrow-up-right',
                'instructions' => __('Lucide icon name (e.g. arrow-up-right, play-circle). Leave blank to hide icon.', 'mlzs'),
            ),
            array(
                'key'   => 'field_hero_cta_secondary',
                'label' => __('Secondary Button Link', 'mlzs'),
                'name'  => 'hero_cta_secondary',
                'type'  => 'link',
                'return_format' => 'array',
                'instructions' => __('Button text and URL in one link field.', 'mlzs'),
            ),
            array(
                'key'   => 'field_hero_cta_secondary_icon',
                'label' => __('Secondary Button Icon', 'mlzs'),
                'name'  => 'hero_cta_secondary_icon',
                'type'  => 'text',
                'placeholder' => 'e.g. play-circle',
                'default_value' => 'play-circle',
                'instructions' => __('Lucide icon name. Leave blank to hide icon.', 'mlzs'),
            ),
            array(
                'key'   => 'field_hero_stats',
                'label' => __('Stats Row', 'mlzs'),
                'name'  => 'hero_stats',
                'type'  => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Stat', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key'   => 'field_hero_stat_number',
                        'label' => __('Number / Value', 'mlzs'),
                        'name'  => 'stat_number',
                        'type'  => 'text',
                        'placeholder' => 'e.g. 100%',
                    ),
                    array(
                        'key'   => 'field_hero_stat_label',
                        'label' => __('Label', 'mlzs'),
                        'name'  => 'stat_label',
                        'type'  => 'text',
                        'placeholder' => 'e.g. University Acceptance',
                    ),
                ),
            ),
            array(
                'key'   => 'field_tab_welcome',
                'label' => __('Welcome Section', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_welcome_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name'  => 'welcome_badge',
                'type'  => 'text',
                'default_value' => 'Welcome to Our Campus',
            ),
            array(
                'key'   => 'field_welcome_heading_line1',
                'label' => __('Heading (First Line)', 'mlzs'),
                'name'  => 'welcome_heading_line1',
                'type'  => 'text',
                'default_value' => 'Mount Litera Zee School, Alwar',
            ),
            array(
                'key'   => 'field_welcome_heading_highlight',
                'label' => __('Heading (Highlighted Part)', 'mlzs'),
                'name'  => 'welcome_heading_highlight',
                'type'  => 'text',
                'default_value' => 'A Great School For A Great Future',
            ),
            array(
                'key'   => 'field_welcome_description',
                'label' => __('Description', 'mlzs'),
                'name'  => 'welcome_description',
                'type'  => 'textarea',
                'default_value' => 'Mount Litera Zee School will provide a complete and unique educational experience for the child, preparing the child for a successful life in the contemporary society. MLZS create an excellent educational institution synthesizing the human values with the highest quality of teaching–learning using modern technology-driven tools.',
                'rows'  => 4,
            ),
            array(
                'key'   => 'field_welcome_cta_primary',
                'label' => __('Primary Button Link', 'mlzs'),
                'name'  => 'welcome_cta_primary',
                'type'  => 'link',
                'return_format' => 'array',
                'instructions' => __('Button text and URL in one link field.', 'mlzs'),
            ),
            array(
                'key'   => 'field_welcome_cta_primary_icon',
                'label' => __('Primary Button Icon', 'mlzs'),
                'name'  => 'welcome_cta_primary_icon',
                'type'  => 'text',
                'placeholder' => 'e.g. arrow-right',
                'default_value' => 'arrow-right',
                'instructions' => __('Lucide icon name. Leave blank to hide icon.', 'mlzs'),
            ),
            array(
                'key'   => 'field_welcome_cta_secondary',
                'label' => __('Secondary Button Link', 'mlzs'),
                'name'  => 'welcome_cta_secondary',
                'type'  => 'link',
                'return_format' => 'array',
                'instructions' => __('Button text and URL in one link field.', 'mlzs'),
            ),
            array(
                'key'   => 'field_welcome_cta_secondary_icon',
                'label' => __('Secondary Button Icon', 'mlzs'),
                'name'  => 'welcome_cta_secondary_icon',
                'type'  => 'text',
                'placeholder' => 'e.g. external-link',
                'default_value' => '',
                'instructions' => __('Lucide icon name. Leave blank to hide icon.', 'mlzs'),
            ),
            array(
                'key'   => 'field_welcome_cards',
                'label' => __('Feature Cards', 'mlzs'),
                'name'  => 'welcome_cards',
                'type'  => 'repeater',
                'min'   => 2,
                'max'   => 2,
                'layout' => 'block',
                'button_label' => __('Add Card', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key'   => 'field_welcome_card_icon',
                        'label' => __('Lucide Icon Name', 'mlzs'),
                        'name'  => 'card_icon',
                        'type'  => 'text',
                        'placeholder' => 'e.g. book-open, award',
                        'default_value' => 'book-open',
                    ),
                    array(
                        'key'   => 'field_welcome_card_title',
                        'label' => __('Card Title', 'mlzs'),
                        'name'  => 'card_title',
                        'type'  => 'text',
                        'default_value' => 'The Best Learning Methods',
                    ),
                    array(
                        'key'   => 'field_welcome_card_description',
                        'label' => __('Card Description', 'mlzs'),
                        'name'  => 'card_description',
                        'type'  => 'textarea',
                        'rows'  => 3,
                        'default_value' => 'Mount Litera Zee School will provide a complete and unique educational experience for the child, preparing the child for a successful life in the contemporary society. MLZS create an excellent educational institution synthesizing the human values with the highest quality of teaching–learning using modern technology-driven tools for preparing a well-rounded personality for our society.',
                    ),
                    array(
                        'key'   => 'field_welcome_card_style',
                        'label' => __('Card Style', 'mlzs'),
                        'name'  => 'card_style',
                        'type'  => 'select',
                        'choices' => array(
                            'primary' => __('Primary (purple accent)', 'mlzs'),
                            'accent'  => __('Accent (amber/orange)', 'mlzs'),
                        ),
                        'default_value' => 'primary',
                    ),
                ),
            ),
            array(
                'key'   => 'field_tab_approach',
                'label' => __('Approach Section', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_approach_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name'  => 'approach_badge',
                'type'  => 'text',
                'default_value' => 'Our Philosophy',
            ),
            array(
                'key'   => 'field_approach_heading',
                'label' => __('Section Heading', 'mlzs'),
                'name'  => 'approach_heading',
                'type'  => 'text',
                'default_value' => 'The Litera Octave Approach',
            ),
            array(
                'key'   => 'field_approach_description',
                'label' => __('Section Description', 'mlzs'),
                'name'  => 'approach_description',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => 'A holistic framework for world-class education, seamlessly integrating eight core pillars of excellence to nurture future leaders.',
            ),
            array(
                'key'   => 'field_approach_pillars',
                'label' => __('Pillars (tabs + slides)', 'mlzs'),
                'name'  => 'approach_pillars',
                'type'  => 'repeater',
                'min'   => 1,
                'layout' => 'block',
                'button_label' => __('Add Pillar', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key'   => 'field_approach_pillar_icon',
                        'label' => __('Lucide Icon', 'mlzs'),
                        'name'  => 'icon',
                        'type'  => 'text',
                        'placeholder' => 'e.g. bar-chart-3',
                        'default_value' => 'bar-chart-3',
                    ),
                    array(
                        'key'   => 'field_approach_pillar_label',
                        'label' => __('Tab Label', 'mlzs'),
                        'name'  => 'label',
                        'type'  => 'text',
                        'placeholder' => 'e.g. Assessment',
                        'default_value' => 'Assessment',
                    ),
                    array(
                        'key'   => 'field_approach_pillar_tag',
                        'label' => __('Tag (uppercase text)', 'mlzs'),
                        'name'  => 'tag',
                        'type'  => 'text',
                        'placeholder' => 'e.g. Litera Assessment',
                        'default_value' => 'Litera Assessment',
                    ),
                    array(
                        'key'   => 'field_approach_pillar_title_line1',
                        'label' => __('Title First Line', 'mlzs'),
                        'name'  => 'title_line1',
                        'type'  => 'text',
                        'default_value' => 'Litera',
                    ),
                    array(
                        'key'   => 'field_approach_pillar_title_highlight',
                        'label' => __('Title Highlighted', 'mlzs'),
                        'name'  => 'title_highlight',
                        'type'  => 'text',
                        'default_value' => 'Assessment',
                    ),
                    array(
                        'key'   => 'field_approach_pillar_description',
                        'label' => __('Description', 'mlzs'),
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 4,
                        'default_value' => 'Our assessments focus on identifying what students are good at instead of whether they are good or not. MLZS assessments take place on a continuous basis and at the child\'s pace rather than through only stressful periodic exams.',
                    ),
                    array(
                        'key'   => 'field_approach_pillar_pills',
                        'label' => __('Pill Tags', 'mlzs'),
                        'name'  => 'pills',
                        'type'  => 'repeater',
                        'layout' => 'table',
                        'button_label' => __('Add Tag', 'mlzs'),
                        'sub_fields' => array(
                            array(
                                'key'   => 'field_approach_pillar_pill_text',
                                'label' => __('Tag Text', 'mlzs'),
                                'name'  => 'pill_text',
                                'type'  => 'text',
                                'placeholder' => 'e.g. Continuous',
                            ),
                        ),
                    ),
                    array(
                        'key'   => 'field_approach_pillar_button',
                        'label' => __('Button Link', 'mlzs'),
                        'name'  => 'button',
                        'type'  => 'link',
                        'return_format' => 'array',
                    ),
                    array(
                        'key'   => 'field_approach_pillar_image',
                        'label' => __('Slide Image', 'mlzs'),
                        'name'  => 'image',
                        'type'  => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'home.php',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_hero_field_group');
