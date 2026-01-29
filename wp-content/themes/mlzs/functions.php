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
            array(
                'key'   => 'field_tab_academics',
                'label' => __('Academics Section', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_academics_badge_text',
                'label' => __('Badge Text', 'mlzs'),
                'name'  => 'academics_badge_text',
                'type'  => 'text',
                'default_value' => 'Student Life',
            ),
            array(
                'key'   => 'field_academics_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name'  => 'academics_badge_icon',
                'type'  => 'text',
                'placeholder' => 'e.g. graduation-cap',
                'default_value' => 'graduation-cap',
            ),
            array(
                'key'   => 'field_academics_heading',
                'label' => __('Section Heading', 'mlzs'),
                'name'  => 'academics_heading',
                'type'  => 'text',
                'default_value' => 'Academics & Beyond',
            ),
            array(
                'key'   => 'field_academics_description',
                'label' => __('Section Description', 'mlzs'),
                'name'  => 'academics_description',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => 'We believe education extends far beyond the classroom walls. Explore the diverse opportunities that shape our students into well-rounded global leaders through arts, sports, and community engagement.',
            ),
            array(
                'key'   => 'field_academics_tabs',
                'label' => __('Tabs & Panels', 'mlzs'),
                'name'  => 'academics_tabs',
                'type'  => 'repeater',
                'min'   => 1,
                'layout' => 'block',
                'button_label' => __('Add Tab / Panel', 'mlzs'),
                'instructions' => __('Each row = one tab button + one panel of cards. Use Tab Slug for JS (e.g. fun, sports, events).', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key'   => 'field_academics_tab_icon',
                        'label' => __('Tab Icon', 'mlzs'),
                        'name'  => 'tab_icon',
                        'type'  => 'text',
                        'placeholder' => 'e.g. palette, trophy',
                        'default_value' => 'palette',
                    ),
                    array(
                        'key'   => 'field_academics_tab_label',
                        'label' => __('Tab Label', 'mlzs'),
                        'name'  => 'tab_label',
                        'type'  => 'text',
                        'placeholder' => 'e.g. Fun & Art',
                        'default_value' => 'Fun & Art',
                    ),
                    array(
                        'key'   => 'field_academics_tab_slug',
                        'label' => __('Tab Slug', 'mlzs'),
                        'name'  => 'tab_slug',
                        'type'  => 'text',
                        'placeholder' => 'e.g. fun (no spaces)',
                        'default_value' => 'fun',
                        'instructions' => __('Unique ID for this tab/panel (used in HTML).', 'mlzs'),
                    ),
                    array(
                        'key'   => 'field_academics_cards',
                        'label' => __('Cards', 'mlzs'),
                        'name'  => 'cards',
                        'type'  => 'repeater',
                        'min'   => 1,
                        'layout' => 'block',
                        'button_label' => __('Add Card', 'mlzs'),
                        'sub_fields' => array(
                            array(
                                'key'   => 'field_academics_card_image',
                                'label' => __('Card Image', 'mlzs'),
                                'name'  => 'image',
                                'type'  => 'image',
                                'return_format' => 'url',
                                'preview_size' => 'medium',
                            ),
                            array(
                                'key'   => 'field_academics_card_tag',
                                'label' => __('Tag', 'mlzs'),
                                'name'  => 'tag',
                                'type'  => 'text',
                                'placeholder' => 'e.g. Clubs',
                            ),
                            array(
                                'key'   => 'field_academics_card_tag_style',
                                'label' => __('Tag Style', 'mlzs'),
                                'name'  => 'tag_style',
                                'type'  => 'select',
                                'choices' => array(
                                    'primary' => __('Primary (purple)', 'mlzs'),
                                    'accent'  => __('Accent (amber)', 'mlzs'),
                                ),
                                'default_value' => 'primary',
                            ),
                            array(
                                'key'   => 'field_academics_card_title',
                                'label' => __('Card Title', 'mlzs'),
                                'name'  => 'title',
                                'type'  => 'text',
                                'default_value' => 'Litera Clubs',
                            ),
                            array(
                                'key'   => 'field_academics_card_description',
                                'label' => __('Description', 'mlzs'),
                                'name'  => 'description',
                                'type'  => 'textarea',
                                'rows'  => 3,
                            ),
                            array(
                                'key'   => 'field_academics_card_link',
                                'label' => __('Link', 'mlzs'),
                                'name'  => 'link',
                                'type'  => 'link',
                                'return_format' => 'array',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'key'   => 'field_academics_cta',
                'label' => __('View All Link', 'mlzs'),
                'name'  => 'academics_cta',
                'type'  => 'link',
                'return_format' => 'array',
                'instructions' => __('Bottom CTA e.g. View All Activities.', 'mlzs'),
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

/**
 * ACF Pro: About Us Page – Hero, Mission, Legacy, CTA, Values
 */
function mlzs_acf_about_us_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_about_us',
        'title'                 => __('About Us Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_about_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_about_hero_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'about_hero_badge',
                'type' => 'text',
                'default_value' => 'Our Story & Legacy',
            ),
            array(
                'key' => 'field_about_hero_headline',
                'label' => __('Headline (before highlight)', 'mlzs'),
                'name' => 'about_hero_headline',
                'type' => 'text',
                'default_value' => 'About',
            ),
            array(
                'key' => 'field_about_hero_highlight',
                'label' => __('Headline (highlighted part)', 'mlzs'),
                'name' => 'about_hero_highlight',
                'type' => 'text',
                'default_value' => 'Mount Litera',
            ),
            array(
                'key' => 'field_about_hero_headline_suffix',
                'label' => __('Headline (after highlight)', 'mlzs'),
                'name' => 'about_hero_headline_suffix',
                'type' => 'text',
                'default_value' => 'Zee School',
            ),
            array(
                'key' => 'field_about_hero_subheadline',
                'label' => __('Subheadline', 'mlzs'),
                'name' => 'about_hero_subheadline',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Preparing leaders of the 21st century through innovative education that blends tradition with modernity, values with technology.',
            ),
            array(
                'key' => 'field_about_hero_cta_primary',
                'label' => __('Primary Button (Our Mission)', 'mlzs'),
                'name' => 'about_hero_cta_primary',
                'type' => 'link',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_about_hero_cta_primary_icon',
                'label' => __('Primary Button Icon', 'mlzs'),
                'name' => 'about_hero_cta_primary_icon',
                'type' => 'text',
                'default_value' => 'arrow-down',
            ),
            array(
                'key' => 'field_about_hero_cta_secondary',
                'label' => __('Secondary Button (Our Legacy)', 'mlzs'),
                'name' => 'about_hero_cta_secondary',
                'type' => 'link',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_about_hero_cta_secondary_icon',
                'label' => __('Secondary Button Icon', 'mlzs'),
                'name' => 'about_hero_cta_secondary_icon',
                'type' => 'text',
                'default_value' => 'history',
            ),
            array(
                'key' => 'field_about_hero_bg_image',
                'label' => __('Hero Background Image', 'mlzs'),
                'name' => 'about_hero_bg_image',
                'type' => 'image',
                'return_format' => 'url',
                'required' => 0,
            ),
            array('key' => 'field_about_tab_mission', 'label' => __('Mission & Overview', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_about_mission_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'about_mission_badge',
                'type' => 'text',
                'default_value' => 'Our Endeavour',
            ),
            array(
                'key' => 'field_about_mission_heading',
                'label' => __('Section Heading', 'mlzs'),
                'name' => 'about_mission_heading',
                'type' => 'text',
                'default_value' => 'Mount Litera Zee School',
            ),
            array(
                'key' => 'field_about_mission_paragraphs',
                'label' => __('Description Paragraphs', 'mlzs'),
                'name' => 'about_mission_paragraphs',
                'type' => 'textarea',
                'rows' => 6,
                'default_value' => "Mount Litera Zee School is an endeavor by the Essel Group to prepare leaders of the 21st century through its Education arm, Zee Learn Limited.\n\nWith more than 65 schools in 55 cities, Mount Litera Zee School is India's fastest growing network of K12 schools.\n\nZee Learn Limited has its preschool network Kidzee with more than 1350 preschools in India and is Asia's largest network of preschools.",
            ),
            array(
                'key' => 'field_about_mission_stats',
                'label' => __('Stats (2 boxes)', 'mlzs'),
                'name' => 'about_mission_stats',
                'type' => 'repeater',
                'min' => 2,
                'max' => 2,
                'layout' => 'table',
                'button_label' => __('Add Stat', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_about_mission_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '65+'),
                    array('key' => 'field_about_mission_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Schools Across India'),
                ),
            ),
            array(
                'key' => 'field_about_mission_image',
                'label' => __('Right Side Image', 'mlzs'),
                'name' => 'about_mission_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_about_mission_image_title',
                'label' => __('Image Overlay Title', 'mlzs'),
                'name' => 'about_mission_image_title',
                'type' => 'text',
                'default_value' => 'Innovative Learning Environment',
            ),
            array(
                'key' => 'field_about_mission_image_caption',
                'label' => __('Image Overlay Caption', 'mlzs'),
                'name' => 'about_mission_image_caption',
                'type' => 'text',
                'default_value' => 'State-of-the-art infrastructure for holistic development',
            ),
            array('key' => 'field_about_tab_legacy', 'label' => __('Legacy Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_about_legacy_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'about_legacy_badge',
                'type' => 'text',
                'default_value' => 'Our Legacy',
            ),
            array(
                'key' => 'field_about_legacy_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'about_legacy_badge_icon',
                'type' => 'text',
                'default_value' => 'sparkles',
            ),
            array(
                'key' => 'field_about_legacy_heading',
                'label' => __('Heading (before highlight)', 'mlzs'),
                'name' => 'about_legacy_heading',
                'type' => 'text',
                'default_value' => 'The',
            ),
            array(
                'key' => 'field_about_legacy_highlight',
                'label' => __('Heading (highlighted)', 'mlzs'),
                'name' => 'about_legacy_highlight',
                'type' => 'text',
                'default_value' => 'Legacy',
            ),
            array(
                'key' => 'field_about_legacy_heading_suffix',
                'label' => __('Heading (after highlight)', 'mlzs'),
                'name' => 'about_legacy_heading_suffix',
                'type' => 'text',
                'default_value' => 'of Excellence',
            ),
            array(
                'key' => 'field_about_legacy_intro',
                'label' => __('Intro Paragraph', 'mlzs'),
                'name' => 'about_legacy_intro',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => "Pioneering educational innovation since 1994, shaping minds and building futures",
            ),
            array(
                'key' => 'field_about_legacy_image',
                'label' => __('Legacy Image', 'mlzs'),
                'name' => 'about_legacy_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_about_legacy_year',
                'label' => __('Year Card Number', 'mlzs'),
                'name' => 'about_legacy_year',
                'type' => 'text',
                'default_value' => '1994',
            ),
            array(
                'key' => 'field_about_legacy_year_label',
                'label' => __('Year Card Label', 'mlzs'),
                'name' => 'about_legacy_year_label',
                'type' => 'text',
                'default_value' => 'Year of Foundation',
            ),
            array(
                'key' => 'field_about_legacy_year_caption',
                'label' => __('Year Card Caption', 'mlzs'),
                'name' => 'about_legacy_year_caption',
                'type' => 'text',
                'default_value' => 'Innovation leader in Indian education',
            ),
            array(
                'key' => 'field_about_legacy_paragraphs',
                'label' => __('Body Paragraphs', 'mlzs'),
                'name' => 'about_legacy_paragraphs',
                'type' => 'textarea',
                'rows' => 5,
                'default_value' => "Mount Litera Zee School is an endeavour by the Essel Group led by Shri Subhash Chandra to prepare leaders of the 21st century through its education arm, Zee Learn Limited.\n\nZee Learn Limited is an innovation leader in Indian education since 1994. We introduced various firsts in the country ranging from Zeed, Kidzee preschools, Mount Litera Zee Schools, Mount Litera School International, BrainCalfeSchool Programs and Zee Institutes of Media Art and Creative Art.",
            ),
            array(
                'key' => 'field_about_legacy_vision_title',
                'label' => __('Vision Box Title', 'mlzs'),
                'name' => 'about_legacy_vision_title',
                'type' => 'text',
                'default_value' => 'Our Vision',
            ),
            array(
                'key' => 'field_about_legacy_vision_text',
                'label' => __('Vision Box Text', 'mlzs'),
                'name' => 'about_legacy_vision_text',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'The aim of Mount Litera Zee Schools is to establish social spaces in the country for providing quality educational experiences to improve human capital and create quality manpower for a knowledge society.',
            ),
            array(
                'key' => 'field_about_legacy_stats',
                'label' => __('Legacy Stats (3 boxes)', 'mlzs'),
                'name' => 'about_legacy_stats',
                'type' => 'repeater',
                'min' => 3,
                'max' => 3,
                'layout' => 'table',
                'button_label' => __('Add Stat', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_about_legacy_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                    array('key' => 'field_about_legacy_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
                ),
            ),
            array('key' => 'field_about_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_about_cta_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'about_cta_badge',
                'type' => 'text',
                'default_value' => 'Join Our Community',
            ),
            array(
                'key' => 'field_about_cta_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'about_cta_badge_icon',
                'type' => 'text',
                'default_value' => 'star',
            ),
            array(
                'key' => 'field_about_cta_heading',
                'label' => __('Heading (before highlight)', 'mlzs'),
                'name' => 'about_cta_heading',
                'type' => 'text',
                'default_value' => 'Be Part of the Mount Litera',
            ),
            array(
                'key' => 'field_about_cta_highlight',
                'label' => __('Heading (highlighted)', 'mlzs'),
                'name' => 'about_cta_highlight',
                'type' => 'text',
                'default_value' => 'Legacy',
            ),
            array(
                'key' => 'field_about_cta_description',
                'label' => __('Description', 'mlzs'),
                'name' => 'about_cta_description',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => "Join India's fastest growing network of K12 schools and give your child the gift of world-class education combined with strong values and innovative learning.",
            ),
            array(
                'key' => 'field_about_cta_primary',
                'label' => __('Primary Button', 'mlzs'),
                'name' => 'about_cta_primary',
                'type' => 'link',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_about_cta_primary_icon',
                'label' => __('Primary Button Icon', 'mlzs'),
                'name' => 'about_cta_primary_icon',
                'type' => 'text',
                'default_value' => 'arrow-right',
            ),
            array(
                'key' => 'field_about_cta_secondary',
                'label' => __('Secondary Button', 'mlzs'),
                'name' => 'about_cta_secondary',
                'type' => 'link',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_about_cta_secondary_icon',
                'label' => __('Secondary Button Icon', 'mlzs'),
                'name' => 'about_cta_secondary_icon',
                'type' => 'text',
                'default_value' => 'phone',
            ),
            array('key' => 'field_about_tab_values', 'label' => __('Values & Philosophy', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_about_values_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'about_values_badge',
                'type' => 'text',
                'default_value' => 'Our Values',
            ),
            array(
                'key' => 'field_about_values_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'about_values_badge_icon',
                'type' => 'text',
                'default_value' => 'heart',
            ),
            array(
                'key' => 'field_about_values_heading',
                'label' => __('Heading (before highlight)', 'mlzs'),
                'name' => 'about_values_heading',
                'type' => 'text',
                'default_value' => 'Educational',
            ),
            array(
                'key' => 'field_about_values_highlight',
                'label' => __('Heading (highlighted)', 'mlzs'),
                'name' => 'about_values_highlight',
                'type' => 'text',
                'default_value' => 'Philosophy',
            ),
            array(
                'key' => 'field_about_values_intro',
                'label' => __('Intro Paragraph', 'mlzs'),
                'name' => 'about_values_intro',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'We believe in creating social spaces for quality education that builds human capital for a knowledge society',
            ),
            array(
                'key' => 'field_about_values_cards',
                'label' => __('Value Cards (3)', 'mlzs'),
                'name' => 'about_values_cards',
                'type' => 'repeater',
                'min' => 3,
                'max' => 3,
                'layout' => 'block',
                'button_label' => __('Add Card', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_about_values_card_icon', 'label' => __('Lucide Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'),
                    array('key' => 'field_about_values_card_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_about_values_card_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 3),
                    array(
                        'key' => 'field_about_values_card_style',
                        'label' => __('Card Style', 'mlzs'),
                        'name' => 'style',
                        'type' => 'select',
                        'choices' => array('primary' => 'Primary (purple)', 'accent' => 'Accent (amber)', 'primary-light' => 'Primary Light'),
                        'default_value' => 'primary',
                    ),
                ),
            ),
            array(
                'key' => 'field_about_commitment_heading',
                'label' => __('Commitment Box Heading', 'mlzs'),
                'name' => 'about_commitment_heading',
                'type' => 'text',
                'default_value' => 'Our Commitment to Excellence',
            ),
            array(
                'key' => 'field_about_commitment_text',
                'label' => __('Commitment Box Text', 'mlzs'),
                'name' => 'about_commitment_text',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Mount Litera Zee School synthesizes human values with the highest quality of teaching-learning using modern technology-driven tools. We prepare well-rounded personalities who can lead effectively in our contemporary society.',
            ),
            array(
                'key' => 'field_about_commitment_cta_primary',
                'label' => __('Commitment Primary Button', 'mlzs'),
                'name' => 'about_commitment_cta_primary',
                'type' => 'link',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_about_commitment_cta_primary_icon',
                'label' => __('Commitment Primary Icon', 'mlzs'),
                'name' => 'about_commitment_cta_primary_icon',
                'type' => 'text',
                'default_value' => 'arrow-right',
            ),
            array(
                'key' => 'field_about_commitment_cta_secondary',
                'label' => __('Commitment Secondary Button', 'mlzs'),
                'name' => 'about_commitment_cta_secondary',
                'type' => 'link',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_about_commitment_cta_secondary_icon',
                'label' => __('Commitment Secondary Icon', 'mlzs'),
                'name' => 'about_commitment_cta_secondary_icon',
                'type' => 'text',
                'default_value' => 'download',
            ),
            array(
                'key' => 'field_about_commitment_stats',
                'label' => __('Commitment Stats (4 boxes)', 'mlzs'),
                'name' => 'about_commitment_stats',
                'type' => 'repeater',
                'min' => 4,
                'max' => 4,
                'layout' => 'table',
                'button_label' => __('Add Stat', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_about_commitment_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                    array('key' => 'field_about_commitment_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'about-us.php',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_about_us_field_group');

/**
 * ACF Pro: Art & Craft Page – Hero, Main Content, Images, Curriculum, Benefits, CTA
 */
function mlzs_acf_art_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_art',
        'title'                 => __('Art & Craft Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_art_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'art_hero_badge', 'type' => 'text', 'default_value' => 'Creative Expression'),
            array('key' => 'field_art_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'art_hero_icon', 'type' => 'text', 'default_value' => 'palette'),
            array('key' => 'field_art_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'art_hero_headline', 'type' => 'text', 'default_value' => 'Art &'),
            array('key' => 'field_art_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'art_hero_highlight', 'type' => 'text', 'default_value' => 'Craft'),
            array('key' => 'field_art_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'art_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Nurturing imagination and creativity through hands-on artistic experiences'),
            array('key' => 'field_art_tab_content', 'label' => __('Main Content', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_content_heading', 'label' => __('Content Card Heading', 'mlzs'), 'name' => 'art_content_heading', 'type' => 'text', 'default_value' => 'The Art of Creative Expression'),
            array('key' => 'field_art_content_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'art_content_para1', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_art_content_para2', 'label' => __('Paragraph 2 (highlight box)', 'mlzs'), 'name' => 'art_content_para2', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_art_content_para3', 'label' => __('Paragraph 3', 'mlzs'), 'name' => 'art_content_para3', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_art_content_labs_heading', 'label' => __('Art Labs Section Heading', 'mlzs'), 'name' => 'art_content_labs_heading', 'type' => 'text', 'default_value' => 'Our Art Labs'),
            array('key' => 'field_art_content_junior_label', 'label' => __('Junior Lab Label', 'mlzs'), 'name' => 'art_content_junior_label', 'type' => 'text', 'default_value' => 'Junior Art Lab'),
            array('key' => 'field_art_content_junior_classes', 'label' => __('Junior Lab Classes', 'mlzs'), 'name' => 'art_content_junior_classes', 'type' => 'text', 'default_value' => 'For Classes 1-4'),
            array('key' => 'field_art_content_senior_label', 'label' => __('Senior Lab Label', 'mlzs'), 'name' => 'art_content_senior_label', 'type' => 'text', 'default_value' => 'Senior Art Lab'),
            array('key' => 'field_art_content_senior_classes', 'label' => __('Senior Lab Classes', 'mlzs'), 'name' => 'art_content_senior_classes', 'type' => 'text', 'default_value' => 'For Classes 5-9'),
            array('key' => 'field_art_tab_images', 'label' => __('Images', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_image_1', 'label' => __('Image 1 (Junior Art Lab)', 'mlzs'), 'name' => 'art_image_1', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_art_image_1_title', 'label' => __('Image 1 Title', 'mlzs'), 'name' => 'art_image_1_title', 'type' => 'text', 'default_value' => 'Junior Art Lab'),
            array('key' => 'field_art_image_1_caption', 'label' => __('Image 1 Caption', 'mlzs'), 'name' => 'art_image_1_caption', 'type' => 'text', 'default_value' => 'Classes 1-4 students exploring creativity'),
            array('key' => 'field_art_image_2', 'label' => __('Image 2 (Senior Craft Lab)', 'mlzs'), 'name' => 'art_image_2', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_art_image_2_title', 'label' => __('Image 2 Title', 'mlzs'), 'name' => 'art_image_2_title', 'type' => 'text', 'default_value' => 'Senior Craft Lab'),
            array('key' => 'field_art_image_2_caption', 'label' => __('Image 2 Caption', 'mlzs'), 'name' => 'art_image_2_caption', 'type' => 'text', 'default_value' => 'Classes 5-9 developing advanced skills'),
            array('key' => 'field_art_tab_curriculum', 'label' => __('Curriculum & Activities', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_curriculum_heading', 'label' => __('Curriculum Heading', 'mlzs'), 'name' => 'art_curriculum_heading', 'type' => 'text', 'default_value' => 'Our Art Curriculum'),
            array('key' => 'field_art_curriculum_items', 'label' => __('Curriculum Items', 'mlzs'), 'name' => 'art_curriculum_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_art_curriculum_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_art_activities_heading', 'label' => __('Activities Heading', 'mlzs'), 'name' => 'art_activities_heading', 'type' => 'text', 'default_value' => 'Activities & Events'),
            array('key' => 'field_art_activities_items', 'label' => __('Activities Items', 'mlzs'), 'name' => 'art_activities_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_art_activities_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_art_tab_benefits', 'label' => __('Benefits Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_benefits_heading', 'label' => __('Benefits Heading', 'mlzs'), 'name' => 'art_benefits_heading', 'type' => 'text', 'default_value' => 'Benefits of Art Education'),
            array('key' => 'field_art_benefits_sub', 'label' => __('Benefits Subheading', 'mlzs'), 'name' => 'art_benefits_sub', 'type' => 'text', 'default_value' => 'Developing creativity, critical thinking, and emotional expression through art'),
            array('key' => 'field_art_benefits_cards', 'label' => __('Benefit Cards (3)', 'mlzs'), 'name' => 'art_benefits_cards', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'block', 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_art_benefit_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_art_benefit_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_art_benefit_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_art_benefit_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_art_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_art_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'art_cta_heading', 'type' => 'text', 'default_value' => 'Explore Your Creative Potential'),
            array('key' => 'field_art_cta_description', 'label' => __('CTA Description', 'mlzs'), 'name' => 'art_cta_description', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Join our art programs and discover the joy of creative expression in our state-of-the-art art labs.'),
            array('key' => 'field_art_cta_btn_primary', 'label' => __('Primary Button', 'mlzs'), 'name' => 'art_cta_btn_primary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_art_cta_btn_primary_icon', 'label' => __('Primary Button Icon', 'mlzs'), 'name' => 'art_cta_btn_primary_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_art_cta_btn_secondary', 'label' => __('Secondary Button', 'mlzs'), 'name' => 'art_cta_btn_secondary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_art_cta_btn_secondary_icon', 'label' => __('Secondary Button Icon', 'mlzs'), 'name' => 'art_cta_btn_secondary_icon', 'type' => 'text', 'default_value' => 'image'),
            array('key' => 'field_art_cta_stats', 'label' => __('Stats (4 boxes)', 'mlzs'), 'name' => 'art_cta_stats', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_art_cta_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_art_cta_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(
                array('param' => 'page_template', 'operator' => '==', 'value' => 'art.php'),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_art_field_group');

/**
 * ACF Pro: CBSE Mandate Page – Hero, Documents Section, Filters, Document Cards, Stats
 */
function mlzs_acf_cbse_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_cbse',
        'title'                 => __('CBSE Mandate Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_cbse_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_cbse_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'cbse_hero_badge', 'type' => 'text', 'default_value' => 'CBSE Compliance'),
            array('key' => 'field_cbse_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'cbse_hero_icon', 'type' => 'text', 'default_value' => 'shield-check'),
            array('key' => 'field_cbse_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'cbse_hero_headline', 'type' => 'text', 'default_value' => 'CBSE'),
            array('key' => 'field_cbse_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'cbse_hero_highlight', 'type' => 'text', 'default_value' => 'Mandate'),
            array('key' => 'field_cbse_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'cbse_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Essential documents, certificates, and academic planners for students, parents, and stakeholders'),
            array('key' => 'field_cbse_tab_section', 'label' => __('Documents Section Header', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_cbse_section_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'cbse_section_badge', 'type' => 'text', 'default_value' => 'Important Documents'),
            array('key' => 'field_cbse_section_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'cbse_section_icon', 'type' => 'text', 'default_value' => 'folder-open'),
            array('key' => 'field_cbse_section_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'cbse_section_heading', 'type' => 'text', 'default_value' => 'Related'),
            array('key' => 'field_cbse_section_heading_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'cbse_section_heading_highlight', 'type' => 'text', 'default_value' => 'Documents'),
            array('key' => 'field_cbse_section_description', 'label' => __('Section Description', 'mlzs'), 'name' => 'cbse_section_description', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_cbse_tab_filters', 'label' => __('Filter Buttons', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_cbse_filters', 'label' => __('Category Filters', 'mlzs'), 'name' => 'cbse_filters', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Filter', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_cbse_filter_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
                array('key' => 'field_cbse_filter_slug', 'label' => __('Slug (all, fee, certificate, result, safety)', 'mlzs'), 'name' => 'slug', 'type' => 'text', 'placeholder' => 'all'),
                array('key' => 'field_cbse_filter_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'folder'),
            )),
            array('key' => 'field_cbse_tab_documents', 'label' => __('Documents', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_cbse_documents', 'label' => __('Document Cards', 'mlzs'), 'name' => 'cbse_documents', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Document', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_cbse_doc_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_cbse_doc_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
                array('key' => 'field_cbse_doc_link', 'label' => __('Link (PDF/URL)', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                array('key' => 'field_cbse_doc_category', 'label' => __('Category (for filter)', 'mlzs'), 'name' => 'category', 'type' => 'select', 'choices' => array('fee' => 'Fee Structure', 'certificate' => 'Certificates', 'result' => 'Results', 'safety' => 'Safety & Compliance'), 'default_value' => 'certificate'),
                array('key' => 'field_cbse_doc_icon', 'label' => __('Corner Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'file-text'),
                array('key' => 'field_cbse_doc_button_text', 'label' => __('Button Text', 'mlzs'), 'name' => 'button_text', 'type' => 'text', 'default_value' => 'View Document'),
            )),
            array('key' => 'field_cbse_tab_stats', 'label' => __('Statistics', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_cbse_stats', 'label' => __('Stats (4 boxes)', 'mlzs'), 'name' => 'cbse_stats', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_cbse_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_cbse_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(
                array('param' => 'page_template', 'operator' => '==', 'value' => 'cbse.php'),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_cbse_field_group');

/**
 * ACF Pro: Music & Dance Page – Hero, Intro, Gallery, Programs, Benefits, CTA
 */
function mlzs_acf_dance_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_dance',
        'title'                 => __('Music & Dance Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_dance_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'dance_hero_badge', 'type' => 'text', 'default_value' => 'Rhythmic Expression'),
            array('key' => 'field_dance_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'dance_hero_icon', 'type' => 'text', 'default_value' => 'music'),
            array('key' => 'field_dance_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'dance_hero_headline', 'type' => 'text', 'default_value' => 'Music &'),
            array('key' => 'field_dance_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'dance_hero_highlight', 'type' => 'text', 'default_value' => 'Dance'),
            array('key' => 'field_dance_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'dance_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Where rhythm meets expression, creating harmony in mind, body, and soul'),
            array('key' => 'field_dance_tab_intro', 'label' => __('Introduction', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_intro_heading', 'label' => __('Intro Heading', 'mlzs'), 'name' => 'dance_intro_heading', 'type' => 'text', 'default_value' => 'The Healing Power of Music & Dance'),
            array('key' => 'field_dance_intro_icon', 'label' => __('Intro Icon', 'mlzs'), 'name' => 'dance_intro_icon', 'type' => 'text', 'default_value' => 'heart'),
            array('key' => 'field_dance_intro_para1', 'label' => __('Intro Paragraph', 'mlzs'), 'name' => 'dance_intro_para1', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_dance_intro_box_heading', 'label' => __('Box Heading (Music Program)', 'mlzs'), 'name' => 'dance_intro_box_heading', 'type' => 'text', 'default_value' => 'Comprehensive Music Program'),
            array('key' => 'field_dance_intro_box_text', 'label' => __('Box Text', 'mlzs'), 'name' => 'dance_intro_box_text', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_dance_tab_gallery', 'label' => __('Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_gallery_heading', 'label' => __('Gallery Heading (before highlight)', 'mlzs'), 'name' => 'dance_gallery_heading', 'type' => 'text', 'default_value' => 'Our'),
            array('key' => 'field_dance_gallery_highlight', 'label' => __('Gallery Heading (highlighted)', 'mlzs'), 'name' => 'dance_gallery_highlight', 'type' => 'text', 'default_value' => 'Performance Gallery'),
            array('key' => 'field_dance_gallery_sub', 'label' => __('Gallery Subheading', 'mlzs'), 'name' => 'dance_gallery_sub', 'type' => 'text', 'default_value' => 'Capturing moments of musical excellence and rhythmic expression'),
            array('key' => 'field_dance_gallery_images', 'label' => __('Gallery Images (first 4 = row 1, next 2 = row 2 large)', 'mlzs'), 'name' => 'dance_gallery_images', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Image', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_dance_gallery_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_dance_gallery_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_dance_gallery_caption', 'label' => __('Caption', 'mlzs'), 'name' => 'caption', 'type' => 'text'),
                array('key' => 'field_dance_gallery_large', 'label' => __('Large (second row)', 'mlzs'), 'name' => 'large', 'type' => 'true_false', 'ui' => 1, 'default_value' => 0),
            )),
            array('key' => 'field_dance_tab_programs', 'label' => __('Programs', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_programs_heading', 'label' => __('Programs Heading (before highlight)', 'mlzs'), 'name' => 'dance_programs_heading', 'type' => 'text', 'default_value' => 'Our'),
            array('key' => 'field_dance_programs_highlight', 'label' => __('Programs Heading (highlighted)', 'mlzs'), 'name' => 'dance_programs_highlight', 'type' => 'text', 'default_value' => 'Programs'),
            array('key' => 'field_dance_programs_sub', 'label' => __('Programs Subheading', 'mlzs'), 'name' => 'dance_programs_sub', 'type' => 'text', 'default_value' => 'Comprehensive music and dance education from 1st to 9th standard'),
            array('key' => 'field_dance_music_heading', 'label' => __('Music Program Heading', 'mlzs'), 'name' => 'dance_music_heading', 'type' => 'text', 'default_value' => 'Music Program'),
            array('key' => 'field_dance_music_icon', 'label' => __('Music Program Icon', 'mlzs'), 'name' => 'dance_music_icon', 'type' => 'text', 'default_value' => 'music-2'),
            array('key' => 'field_dance_music_items', 'label' => __('Music Program Items', 'mlzs'), 'name' => 'dance_music_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_dance_music_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_dance_dance_heading', 'label' => __('Dance Program Heading', 'mlzs'), 'name' => 'dance_dance_heading', 'type' => 'text', 'default_value' => 'Dance Program'),
            array('key' => 'field_dance_dance_icon', 'label' => __('Dance Program Icon', 'mlzs'), 'name' => 'dance_dance_icon', 'type' => 'text', 'default_value' => 'sparkles'),
            array('key' => 'field_dance_dance_items', 'label' => __('Dance Program Items', 'mlzs'), 'name' => 'dance_dance_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_dance_dance_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_dance_tab_benefits', 'label' => __('Benefits', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_benefits_heading', 'label' => __('Benefits Heading', 'mlzs'), 'name' => 'dance_benefits_heading', 'type' => 'text', 'default_value' => 'Benefits of Music & Dance Education'),
            array('key' => 'field_dance_benefits_icon', 'label' => __('Benefits Icon', 'mlzs'), 'name' => 'dance_benefits_icon', 'type' => 'text', 'default_value' => 'star'),
            array('key' => 'field_dance_benefits_list', 'label' => __('Benefits (4 items)', 'mlzs'), 'name' => 'dance_benefits_list', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'block', 'button_label' => __('Add Benefit', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_dance_benefit_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_dance_benefit_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_dance_benefit_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_dance_benefit_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_dance_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_dance_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'dance_cta_heading', 'type' => 'text', 'default_value' => 'Join Our Rhythmic Journey'),
            array('key' => 'field_dance_cta_description', 'label' => __('CTA Description', 'mlzs'), 'name' => 'dance_cta_description', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_dance_cta_btn_primary', 'label' => __('Primary Button', 'mlzs'), 'name' => 'dance_cta_btn_primary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_dance_cta_btn_primary_icon', 'label' => __('Primary Button Icon', 'mlzs'), 'name' => 'dance_cta_btn_primary_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_dance_cta_btn_secondary', 'label' => __('Secondary Button', 'mlzs'), 'name' => 'dance_cta_btn_secondary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_dance_cta_btn_secondary_icon', 'label' => __('Secondary Button Icon', 'mlzs'), 'name' => 'dance_cta_btn_secondary_icon', 'type' => 'text', 'default_value' => 'music'),
            array('key' => 'field_dance_cta_stats', 'label' => __('Stats (4 boxes)', 'mlzs'), 'name' => 'dance_cta_stats', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_dance_cta_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_dance_cta_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(
                array('param' => 'page_template', 'operator' => '==', 'value' => 'dance.php'),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_dance_field_group');

/**
 * ACF Pro: Admission Process Page – Hero, Process Steps, Entry Criteria, Documents, Form Section
 */
function mlzs_acf_admission_process_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_admission_process',
        'title'                 => __('Admission Process Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_adm_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_adm_hero_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'admission_hero_badge',
                'type' => 'text',
                'default_value' => 'Join Our Community',
            ),
            array(
                'key' => 'field_adm_hero_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'admission_hero_badge_icon',
                'type' => 'text',
                'default_value' => 'user-plus',
            ),
            array(
                'key' => 'field_adm_hero_headline',
                'label' => __('Headline (before highlight)', 'mlzs'),
                'name' => 'admission_hero_headline',
                'type' => 'text',
                'default_value' => 'Admission',
            ),
            array(
                'key' => 'field_adm_hero_highlight',
                'label' => __('Headline (highlighted)', 'mlzs'),
                'name' => 'admission_hero_highlight',
                'type' => 'text',
                'default_value' => 'Process',
            ),
            array(
                'key' => 'field_adm_hero_subheadline',
                'label' => __('Subheadline', 'mlzs'),
                'name' => 'admission_hero_subheadline',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'A seamless and transparent admission process to welcome your child into our learning community',
            ),
            array('key' => 'field_adm_tab_process', 'label' => __('Admission Process Steps', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_adm_process_heading',
                'label' => __('Card Title', 'mlzs'),
                'name' => 'admission_process_heading',
                'type' => 'text',
                'default_value' => 'Admission Process',
            ),
            array(
                'key' => 'field_adm_process_icon',
                'label' => __('Card Icon', 'mlzs'),
                'name' => 'admission_process_icon',
                'type' => 'text',
                'default_value' => 'clipboard-list',
            ),
            array(
                'key' => 'field_adm_process_steps',
                'label' => __('Process Steps', 'mlzs'),
                'name' => 'admission_process_steps',
                'type' => 'repeater',
                'min' => 1,
                'layout' => 'block',
                'button_label' => __('Add Step', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key' => 'field_adm_process_step_text',
                        'label' => __('Step Text', 'mlzs'),
                        'name' => 'step_text',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                ),
            ),
            array(
                'key' => 'field_adm_process_cta',
                'label' => __('CTA Button (e.g. Start Admission Process)', 'mlzs'),
                'name' => 'admission_process_cta',
                'type' => 'link',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_adm_process_cta_icon',
                'label' => __('CTA Icon', 'mlzs'),
                'name' => 'admission_process_cta_icon',
                'type' => 'text',
                'default_value' => 'arrow-down',
            ),
            array(
                'key' => 'field_adm_process_image',
                'label' => __('Right Side Image', 'mlzs'),
                'name' => 'admission_process_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_adm_process_image_caption',
                'label' => __('Image Overlay Caption', 'mlzs'),
                'name' => 'admission_process_image_caption',
                'type' => 'text',
                'default_value' => 'Seamless Admission Journey',
            ),
            array('key' => 'field_adm_tab_entry', 'label' => __('Entry Criteria', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_adm_entry_heading',
                'label' => __('Section Heading', 'mlzs'),
                'name' => 'admission_entry_heading',
                'type' => 'text',
                'default_value' => 'Entry Criteria for Admission',
            ),
            array(
                'key' => 'field_adm_entry_icon',
                'label' => __('Section Icon', 'mlzs'),
                'name' => 'admission_entry_icon',
                'type' => 'text',
                'default_value' => 'target',
            ),
            array(
                'key' => 'field_adm_entry_intro',
                'label' => __('Intro Paragraph', 'mlzs'),
                'name' => 'admission_entry_intro',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Admissions are granted to students on the basis of the following assessments:',
            ),
            array(
                'key' => 'field_adm_entry_criteria',
                'label' => __('Criteria Items', 'mlzs'),
                'name' => 'admission_entry_criteria',
                'type' => 'repeater',
                'min' => 1,
                'layout' => 'block',
                'button_label' => __('Add Item', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_adm_entry_label', 'label' => __('Label (bold)', 'mlzs'), 'name' => 'label', 'type' => 'text', 'placeholder' => 'e.g. Grade 1:'),
                    array('key' => 'field_adm_entry_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text', 'placeholder' => 'e.g. age 5+ as on April 1'),
                ),
            ),
            array(
                'key' => 'field_adm_entry_image',
                'label' => __('Left Side Image', 'mlzs'),
                'name' => 'admission_entry_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_adm_entry_image_caption',
                'label' => __('Image Overlay Caption', 'mlzs'),
                'name' => 'admission_entry_image_caption',
                'type' => 'text',
                'default_value' => 'Clear Entry Guidelines',
            ),
            array('key' => 'field_adm_tab_docs', 'label' => __('Documents Required', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_adm_docs_heading',
                'label' => __('Section Heading', 'mlzs'),
                'name' => 'admission_docs_heading',
                'type' => 'text',
                'default_value' => 'Documents Required',
            ),
            array(
                'key' => 'field_adm_docs_icon',
                'label' => __('Section Icon', 'mlzs'),
                'name' => 'admission_docs_icon',
                'type' => 'text',
                'default_value' => 'folder-open',
            ),
            array(
                'key' => 'field_adm_docs_intro',
                'label' => __('Intro Paragraph', 'mlzs'),
                'name' => 'admission_docs_intro',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Documents to be submitted at the time of admission:',
            ),
            array(
                'key' => 'field_adm_docs_items',
                'label' => __('Document Items', 'mlzs'),
                'name' => 'admission_docs_items',
                'type' => 'repeater',
                'min' => 1,
                'layout' => 'block',
                'button_label' => __('Add Document', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_adm_docs_item_icon', 'label' => __('Lucide Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'file-text'),
                    array('key' => 'field_adm_docs_item_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_adm_docs_item_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
                ),
            ),
            array(
                'key' => 'field_adm_docs_image',
                'label' => __('Right Side Image', 'mlzs'),
                'name' => 'admission_docs_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_adm_docs_image_caption',
                'label' => __('Image Overlay Caption', 'mlzs'),
                'name' => 'admission_docs_image_caption',
                'type' => 'text',
                'default_value' => 'Required Documentation',
            ),
            array('key' => 'field_adm_tab_form', 'label' => __('Registration Form Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_adm_form_badge',
                'label' => __('Form Section Badge', 'mlzs'),
                'name' => 'admission_form_badge',
                'type' => 'text',
                'default_value' => 'Online Registration',
            ),
            array(
                'key' => 'field_adm_form_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'admission_form_badge_icon',
                'type' => 'text',
                'default_value' => 'edit-3',
            ),
            array(
                'key' => 'field_adm_form_heading',
                'label' => __('Form Heading', 'mlzs'),
                'name' => 'admission_form_heading',
                'type' => 'text',
                'default_value' => 'Registration Form',
            ),
            array(
                'key' => 'field_adm_form_description',
                'label' => __('Form Description', 'mlzs'),
                'name' => 'admission_form_description',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => "Fill in the details below to begin your child's admission journey with us",
            ),
            array(
                'key' => 'field_adm_form_submit_text',
                'label' => __('Submit Button Text', 'mlzs'),
                'name' => 'admission_form_submit_text',
                'type' => 'text',
                'default_value' => 'Submit Registration Form',
            ),
            array(
                'key' => 'field_adm_form_terms_text',
                'label' => __('Terms Text (below button)', 'mlzs'),
                'name' => 'admission_form_terms_text',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'By submitting this form, you agree to our terms and conditions.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'admission-process.php',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_admission_process_field_group');

/**
 * ACF Pro: Cafe (School Cafe) Page – Hero, Overview
 */
function mlzs_acf_cafe_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_cafe',
        'title'                 => __('Cafe Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_cafe_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_cafe_hero_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'cafe_hero_badge',
                'type' => 'text',
                'default_value' => 'Campus Dining',
            ),
            array(
                'key' => 'field_cafe_hero_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'cafe_hero_badge_icon',
                'type' => 'text',
                'default_value' => 'coffee',
            ),
            array(
                'key' => 'field_cafe_hero_headline',
                'label' => __('Headline (before highlight)', 'mlzs'),
                'name' => 'cafe_hero_headline',
                'type' => 'text',
                'default_value' => 'School',
            ),
            array(
                'key' => 'field_cafe_hero_highlight',
                'label' => __('Headline (highlighted)', 'mlzs'),
                'name' => 'cafe_hero_highlight',
                'type' => 'text',
                'default_value' => 'Cafe',
            ),
            array(
                'key' => 'field_cafe_hero_subheadline',
                'label' => __('Subheadline', 'mlzs'),
                'name' => 'cafe_hero_subheadline',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'A welcoming space for students to relax, refuel, and connect over nutritious meals and refreshments',
            ),
            array('key' => 'field_cafe_tab_overview', 'label' => __('Overview Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_cafe_overview_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'cafe_overview_badge',
                'type' => 'text',
                'default_value' => 'Dining Experience',
            ),
            array(
                'key' => 'field_cafe_overview_heading',
                'label' => __('Section Heading', 'mlzs'),
                'name' => 'cafe_overview_heading',
                'type' => 'text',
                'default_value' => 'More Than Just Food',
            ),
            array(
                'key' => 'field_cafe_overview_description',
                'label' => __('Description Paragraphs', 'mlzs'),
                'name' => 'cafe_overview_description',
                'type' => 'textarea',
                'rows' => 5,
                'default_value' => "Our school cafe provides a comfortable and welcoming environment where students can enjoy nutritious meals, healthy snacks, and refreshing beverages. It serves as a social hub where students can relax, connect with friends, and recharge during breaks.\n\nWe prioritize health and nutrition, offering a variety of balanced meal options that cater to different dietary preferences and requirements.",
            ),
            array(
                'key' => 'field_cafe_overview_image',
                'label' => __('Right Side Image', 'mlzs'),
                'name' => 'cafe_overview_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_cafe_overview_card_title',
                'label' => __('Overlay Card Title', 'mlzs'),
                'name' => 'cafe_overview_card_title',
                'type' => 'text',
                'default_value' => 'Fresh',
            ),
            array(
                'key' => 'field_cafe_overview_card_label',
                'label' => __('Overlay Card Label', 'mlzs'),
                'name' => 'cafe_overview_card_label',
                'type' => 'text',
                'default_value' => 'Daily Meals',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'cafe.php',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_cafe_field_group');

/**
 * ACF Pro: Classroom Page – Hero, Overview, Features, Details, Comparison, CTA
 */
function mlzs_acf_classroom_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_classroom',
        'title'                 => __('Classroom Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_class_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_class_hero_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'classroom_hero_badge',
                'type' => 'text',
                'default_value' => 'Campus Infrastructure',
            ),
            array(
                'key' => 'field_class_hero_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'classroom_hero_badge_icon',
                'type' => 'text',
                'default_value' => 'school',
            ),
            array(
                'key' => 'field_class_hero_headline',
                'label' => __('Headline (before highlight)', 'mlzs'),
                'name' => 'classroom_hero_headline',
                'type' => 'text',
                'default_value' => 'World-Class',
            ),
            array(
                'key' => 'field_class_hero_highlight',
                'label' => __('Headline (highlighted)', 'mlzs'),
                'name' => 'classroom_hero_highlight',
                'type' => 'text',
                'default_value' => 'Classrooms',
            ),
            array(
                'key' => 'field_class_hero_subheadline',
                'label' => __('Subheadline', 'mlzs'),
                'name' => 'classroom_hero_subheadline',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Designed to inspire learning and innovation, our classrooms set new standards in educational excellence with cutting-edge technology and spacious design.',
            ),
            array(
                'key' => 'field_class_hero_bullets',
                'label' => __('Hero Bullet Points (3)', 'mlzs'),
                'name' => 'classroom_hero_bullets',
                'type' => 'repeater',
                'min' => 3,
                'max' => 3,
                'layout' => 'table',
                'button_label' => __('Add Bullet', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_class_hero_bullet_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
                ),
            ),
            array('key' => 'field_class_tab_overview', 'label' => __('Overview Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_class_overview_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'classroom_overview_badge',
                'type' => 'text',
                'default_value' => 'International Standards',
            ),
            array(
                'key' => 'field_class_overview_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'classroom_overview_badge_icon',
                'type' => 'text',
                'default_value' => 'award',
            ),
            array(
                'key' => 'field_class_overview_heading',
                'label' => __('Heading (before highlight)', 'mlzs'),
                'name' => 'classroom_overview_heading',
                'type' => 'text',
                'default_value' => 'Learning Spaces That',
            ),
            array(
                'key' => 'field_class_overview_heading_highlight',
                'label' => __('Heading (highlighted)', 'mlzs'),
                'name' => 'classroom_overview_heading_highlight',
                'type' => 'text',
                'default_value' => 'Inspire Excellence',
            ),
            array(
                'key' => 'field_class_overview_description',
                'label' => __('Description Paragraphs', 'mlzs'),
                'name' => 'classroom_overview_description',
                'type' => 'textarea',
                'rows' => 5,
                'default_value' => "The classrooms of Mount Litera Zee School, Alwar are at par with international standards. All classrooms are replete with modular furniture and extensive display boards to ensure that students give their best to the process of learning and achievement.\n\nEach classroom spans an impressive area of 650 SQ FT which is 30% above the normal guidelines issued by CBSE, providing ample space for interactive learning and student movement.",
            ),
            array(
                'key' => 'field_class_overview_card_icon',
                'label' => __('Card Icon', 'mlzs'),
                'name' => 'classroom_overview_card_icon',
                'type' => 'text',
                'default_value' => 'maximize-2',
            ),
            array(
                'key' => 'field_class_overview_card_title',
                'label' => __('Card Title', 'mlzs'),
                'name' => 'classroom_overview_card_title',
                'type' => 'text',
                'default_value' => 'Spacious Design',
            ),
            array(
                'key' => 'field_class_overview_card_description',
                'label' => __('Card Description', 'mlzs'),
                'name' => 'classroom_overview_card_description',
                'type' => 'text',
                'default_value' => '650 SQ FT per classroom, exceeding CBSE guidelines by 30%',
            ),
            array(
                'key' => 'field_class_overview_right_heading',
                'label' => __('Right Placeholder Heading', 'mlzs'),
                'name' => 'classroom_overview_right_heading',
                'type' => 'text',
                'default_value' => 'Interactive Learning Environment',
            ),
            array(
                'key' => 'field_class_overview_right_text',
                'label' => __('Right Placeholder Text', 'mlzs'),
                'name' => 'classroom_overview_right_text',
                'type' => 'text',
                'default_value' => 'Designed for collaborative and engaging education',
            ),
            array('key' => 'field_class_tab_features', 'label' => __('Features Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_class_features_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'classroom_features_badge',
                'type' => 'text',
                'default_value' => 'Technology Features',
            ),
            array(
                'key' => 'field_class_features_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'classroom_features_badge_icon',
                'type' => 'text',
                'default_value' => 'cpu',
            ),
            array(
                'key' => 'field_class_features_heading',
                'label' => __('Section Heading', 'mlzs'),
                'name' => 'classroom_features_heading',
                'type' => 'text',
                'default_value' => 'Integrated Smart Classroom Technology',
            ),
            array(
                'key' => 'field_class_features_intro',
                'label' => __('Intro Paragraph', 'mlzs'),
                'name' => 'classroom_features_intro',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Equipped with state-of-the-art digital infrastructure to create immersive and interactive learning experiences',
            ),
            array(
                'key' => 'field_class_features_cards',
                'label' => __('Feature Cards (3)', 'mlzs'),
                'name' => 'classroom_features_cards',
                'type' => 'repeater',
                'min' => 3,
                'max' => 3,
                'layout' => 'block',
                'button_label' => __('Add Card', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_class_feature_icon', 'label' => __('Lucide Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'monitor'),
                    array('key' => 'field_class_feature_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_class_feature_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 3),
                    array('key' => 'field_class_feature_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                ),
            ),
            array('key' => 'field_class_tab_details', 'label' => __('Details Grid Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_class_details_left_cards',
                'label' => __('Left Grid Cards (4)', 'mlzs'),
                'name' => 'classroom_details_left_cards',
                'type' => 'repeater',
                'min' => 4,
                'max' => 4,
                'layout' => 'block',
                'button_label' => __('Add Card', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_class_detail_icon', 'label' => __('Lucide Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'wifi'),
                    array('key' => 'field_class_detail_icon_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'green' => 'Green', 'purple' => 'Purple', 'amber' => 'Amber'), 'default_value' => 'blue'),
                    array('key' => 'field_class_detail_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_class_detail_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
                ),
            ),
            array(
                'key' => 'field_class_details_right_badge',
                'label' => __('Right Badge', 'mlzs'),
                'name' => 'classroom_details_right_badge',
                'type' => 'text',
                'default_value' => 'Complete Package',
            ),
            array(
                'key' => 'field_class_details_right_badge_icon',
                'label' => __('Right Badge Icon', 'mlzs'),
                'name' => 'classroom_details_right_badge_icon',
                'type' => 'text',
                'default_value' => 'check-circle',
            ),
            array(
                'key' => 'field_class_details_right_heading',
                'label' => __('Right Heading', 'mlzs'),
                'name' => 'classroom_details_right_heading',
                'type' => 'text',
                'default_value' => 'Everything for Optimal Learning',
            ),
            array(
                'key' => 'field_class_details_right_items',
                'label' => __('Right Check Items (5)', 'mlzs'),
                'name' => 'classroom_details_right_items',
                'type' => 'repeater',
                'min' => 5,
                'max' => 5,
                'layout' => 'block',
                'button_label' => __('Add Item', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_class_detail_item_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_class_detail_item_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
                ),
            ),
            array(
                'key' => 'field_class_details_bottom_title',
                'label' => __('Bottom Box Title', 'mlzs'),
                'name' => 'classroom_details_bottom_title',
                'type' => 'text',
                'default_value' => '650 SQ FT Classrooms',
            ),
            array(
                'key' => 'field_class_details_bottom_text',
                'label' => __('Bottom Box Text', 'mlzs'),
                'name' => 'classroom_details_bottom_text',
                'type' => 'text',
                'default_value' => '30% above CBSE guidelines for optimal learning environment',
            ),
            array('key' => 'field_class_tab_comparison', 'label' => __('Comparison Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_class_comparison_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name' => 'classroom_comparison_badge',
                'type' => 'text',
                'default_value' => 'Advantage',
            ),
            array(
                'key' => 'field_class_comparison_badge_icon',
                'label' => __('Badge Icon', 'mlzs'),
                'name' => 'classroom_comparison_badge_icon',
                'type' => 'text',
                'default_value' => 'trending-up',
            ),
            array(
                'key' => 'field_class_comparison_heading',
                'label' => __('Section Heading', 'mlzs'),
                'name' => 'classroom_comparison_heading',
                'type' => 'text',
                'default_value' => 'Why Our Classrooms Stand Out',
            ),
            array(
                'key' => 'field_class_comparison_intro',
                'label' => __('Intro Paragraph', 'mlzs'),
                'name' => 'classroom_comparison_intro',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'A comparative look at how our classroom infrastructure exceeds standard requirements',
            ),
            array(
                'key' => 'field_class_comparison_bottom',
                'label' => __('Bottom Paragraph', 'mlzs'),
                'name' => 'classroom_comparison_bottom',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Our classrooms not only meet but exceed both national and international standards, providing students with an environment conducive to holistic development and academic excellence.',
            ),
            array(
                'key' => 'field_class_comparison_columns',
                'label' => __('Comparison Cards (3 columns)', 'mlzs'),
                'name' => 'classroom_comparison_columns',
                'type' => 'repeater',
                'min' => 3,
                'max' => 3,
                'layout' => 'block',
                'button_label' => __('Add Column', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key' => 'field_class_comp_style',
                        'label' => __('Card Style', 'mlzs'),
                        'name' => 'style',
                        'type' => 'select',
                        'choices' => array(
                            'standard' => __('Standard (left card)', 'mlzs'),
                            'highlight' => __('Highlight (middle – MLZS)', 'mlzs'),
                            'global' => __('Global (right card)', 'mlzs'),
                        ),
                        'default_value' => 'standard',
                    ),
                    array('key' => 'field_class_comp_icon', 'label' => __('Lucide Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'home'),
                    array('key' => 'field_class_comp_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Standard Classroom'),
                    array('key' => 'field_class_comp_subtitle', 'label' => __('Card Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'CBSE Minimum Requirements'),
                    array(
                        'key' => 'field_class_comp_badge',
                        'label' => __('Badge Text (highlight card only)', 'mlzs'),
                        'name' => 'badge_text',
                        'type' => 'text',
                        'default_value' => 'Our Standard',
                        'instructions' => __('Shown on middle card only.', 'mlzs'),
                    ),
                    array(
                        'key' => 'field_class_comp_rows',
                        'label' => __('Rows (label + value)', 'mlzs'),
                        'name' => 'rows',
                        'type' => 'repeater',
                        'min' => 1,
                        'layout' => 'table',
                        'button_label' => __('Add Row', 'mlzs'),
                        'sub_fields' => array(
                            array('key' => 'field_class_comp_row_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
                            array('key' => 'field_class_comp_row_value', 'label' => __('Value', 'mlzs'), 'name' => 'value', 'type' => 'text'),
                        ),
                    ),
                    array(
                        'key' => 'field_class_comp_bottom_label',
                        'label' => __('Bottom Box Label (highlight only)', 'mlzs'),
                        'name' => 'bottom_label',
                        'type' => 'text',
                        'default_value' => '+30%',
                    ),
                    array(
                        'key' => 'field_class_comp_bottom_text',
                        'label' => __('Bottom Box Text (highlight only)', 'mlzs'),
                        'name' => 'bottom_text',
                        'type' => 'text',
                        'default_value' => 'Above CBSE Guidelines',
                    ),
                ),
            ),
            array('key' => 'field_class_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key' => 'field_class_cta_icon',
                'label' => __('CTA Icon', 'mlzs'),
                'name' => 'classroom_cta_icon',
                'type' => 'text',
                'default_value' => 'eye',
            ),
            array(
                'key' => 'field_class_cta_heading',
                'label' => __('CTA Heading', 'mlzs'),
                'name' => 'classroom_cta_heading',
                'type' => 'text',
                'default_value' => 'Experience Our Classrooms Firsthand',
            ),
            array(
                'key' => 'field_class_cta_description',
                'label' => __('CTA Description', 'mlzs'),
                'name' => 'classroom_cta_description',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'See how our state-of-the-art classrooms create the perfect environment for learning, innovation, and growth.',
            ),
            array(
                'key' => 'field_class_cta_primary',
                'label' => __('Primary Button (Campus Tour)', 'mlzs'),
                'name' => 'classroom_cta_primary',
                'type' => 'link',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_class_cta_primary_icon',
                'label' => __('Primary Button Icon', 'mlzs'),
                'name' => 'classroom_cta_primary_icon',
                'type' => 'text',
                'default_value' => 'calendar',
            ),
            array(
                'key' => 'field_class_cta_secondary',
                'label' => __('Secondary Button (Virtual Tour)', 'mlzs'),
                'name' => 'classroom_cta_secondary',
                'type' => 'link',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_class_cta_secondary_icon',
                'label' => __('Secondary Button Icon', 'mlzs'),
                'name' => 'classroom_cta_secondary_icon',
                'type' => 'text',
                'default_value' => 'video',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'classroom.php',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_classroom_field_group');

/**
 * ACF Options Pages: Header & Footer (site-wide)
 */
function mlzs_acf_options_pages() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }
    acf_add_options_page(array(
        'page_title' => __('Header Settings', 'mlzs'),
        'menu_title' => __('Header', 'mlzs'),
        'menu_slug'  => 'acf-options-header',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ));
    acf_add_options_page(array(
        'page_title' => __('Footer Settings', 'mlzs'),
        'menu_title' => __('Footer', 'mlzs'),
        'menu_slug'  => 'acf-options-footer',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ));
}
add_action('acf/init', 'mlzs_acf_options_pages');

/**
 * ACF Field Group: Header (Options Page) – Bar: left max 3, right max 2; Full menu: nested max 4 levels
 */
function mlzs_acf_header_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'    => 'group_mlzs_header',
        'title'  => __('Header Content', 'mlzs'),
        'fields' => array(
            array('key' => 'field_header_tab_bar', 'label' => __('Bar (Logo + Left/Right)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key'   => 'field_header_logo',
                'label' => __('Logo', 'mlzs'),
                'name'  => 'header_logo',
                'type'  => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'instructions' => __('Leave empty to use theme logo.', 'mlzs'),
            ),
            array(
                'key'   => 'field_header_left_menu',
                'label' => __('Left Menu (max 3)', 'mlzs'),
                'name'  => 'header_left_menu',
                'type'  => 'repeater',
                'min'   => 0,
                'max'   => 3,
                'layout' => 'table',
                'button_label' => __('Add Link', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_header_left_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                ),
            ),
            array(
                'key'   => 'field_header_right_menu',
                'label' => __('Right Menu (max 2)', 'mlzs'),
                'name'  => 'header_right_menu',
                'type'  => 'repeater',
                'min'   => 0,
                'max'   => 2,
                'layout' => 'table',
                'button_label' => __('Add Link', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_header_right_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                ),
            ),
            array('key' => 'field_header_tab_full', 'label' => __('Full Menu (Overlay)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array(
                'key'   => 'field_header_full_menu',
                'label' => __('Explore Menu (nested, max 4 levels)', 'mlzs'),
                'name'  => 'header_full_menu',
                'type'  => 'repeater',
                'layout' => 'block',
                'button_label' => __('Add Item', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_header_full_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                    array(
                        'key'   => 'field_header_full_children',
                        'label' => __('Submenu (Level 2)', 'mlzs'),
                        'name'  => 'children',
                        'type'  => 'repeater',
                        'layout' => 'block',
                        'button_label' => __('Add', 'mlzs'),
                        'sub_fields' => array(
                            array('key' => 'field_header_full_link_2', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                            array(
                                'key'   => 'field_header_full_children_3',
                                'label' => __('Submenu (Level 3)', 'mlzs'),
                                'name'  => 'children',
                                'type'  => 'repeater',
                                'layout' => 'block',
                                'button_label' => __('Add', 'mlzs'),
                                'sub_fields' => array(
                                    array('key' => 'field_header_full_link_3', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                                    array(
                                        'key'   => 'field_header_full_children_4',
                                        'label' => __('Submenu (Level 4 – last)', 'mlzs'),
                                        'name'  => 'children',
                                        'type'  => 'repeater',
                                        'layout' => 'table',
                                        'button_label' => __('Add', 'mlzs'),
                                        'sub_fields' => array(
                                            array('key' => 'field_header_full_link_4', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'key'   => 'field_header_quick_actions',
                'label' => __('Quick Actions', 'mlzs'),
                'name'  => 'header_quick_actions',
                'type'  => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Link', 'mlzs'),
                'sub_fields' => array(
                    array('key' => 'field_header_quick_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                ),
            ),
            array('key' => 'field_header_tab_connect', 'label' => __('Connect (Overlay)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_header_connect_heading', 'label' => __('Connect Heading', 'mlzs'), 'name' => 'header_connect_heading', 'type' => 'text', 'default_value' => 'Connect'),
            array('key' => 'field_header_connect_email', 'label' => __('Email', 'mlzs'), 'name' => 'header_connect_email', 'type' => 'text', 'default_value' => 'mlzs.alwar@mountlitera.com'),
            array('key' => 'field_header_connect_phone', 'label' => __('Phone', 'mlzs'), 'name' => 'header_connect_phone', 'type' => 'text', 'default_value' => '+91 9672797979'),
            array(
                'key'   => 'field_header_connect_social_note',
                'label' => __('Social Links', 'mlzs'),
                'name'  => '',
                'type'  => 'message',
                'message' => __('Social links are taken from Footer settings. Edit Footer → Copyright & Social to update icons and URLs for both header overlay and footer.', 'mlzs'),
            ),
        ),
        'location' => array(
            array(array('param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-header')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_header_field_group');

/**
 * ACF Field Group: Footer (Options Page)
 */
function mlzs_acf_footer_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'    => 'group_mlzs_footer',
        'title'  => __('Footer Content', 'mlzs'),
        'fields' => array(
            array(
                'key'   => 'field_footer_tab_contact',
                'label' => __('Contact CTA Box (Top)', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_footer_contact_badge',
                'label' => __('Badge Text', 'mlzs'),
                'name'  => 'footer_contact_badge',
                'type'  => 'text',
                'default_value' => 'Contact Us',
            ),
            array(
                'key'   => 'field_footer_contact_heading',
                'label' => __('Heading', 'mlzs'),
                'name'  => 'footer_contact_heading',
                'type'  => 'text',
                'default_value' => 'Get In Touch',
            ),
            array(
                'key'   => 'field_footer_contact_description',
                'label' => __('Description', 'mlzs'),
                'name'  => 'footer_contact_description',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => 'Have questions about admissions, programs, or campus life? We\'re here to help. Reach out to us and we\'ll get back to you soon.',
            ),
            array(
                'key'   => 'field_footer_contact_email',
                'label' => __('Email', 'mlzs'),
                'name'  => 'footer_contact_email',
                'type'  => 'text',
                'default_value' => 'mlzs.alwar@mountlitera.com',
            ),
            array(
                'key'   => 'field_footer_contact_phone',
                'label' => __('Phone', 'mlzs'),
                'name'  => 'footer_contact_phone',
                'type'  => 'text',
                'default_value' => '+91 9672797979',
            ),
            array(
                'key'   => 'field_footer_tab_main',
                'label' => __('Logo & Tagline', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_footer_logo',
                'label' => __('Footer Logo', 'mlzs'),
                'name'  => 'footer_logo',
                'type'  => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'instructions' => __('Leave empty to use theme logo.', 'mlzs'),
            ),
            array(
                'key'   => 'field_footer_tagline',
                'label' => __('Tagline', 'mlzs'),
                'name'  => 'footer_tagline',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => 'Empowering the next generation of leaders through excellence in education, innovation, and character building.',
            ),
            array(
                'key'   => 'field_footer_address_heading',
                'label' => __('Address Block Heading', 'mlzs'),
                'name'  => 'footer_address_heading',
                'type'  => 'text',
                'default_value' => 'Campus Address',
            ),
            array(
                'key'   => 'field_footer_address_text',
                'label' => __('Address', 'mlzs'),
                'name'  => 'footer_address_text',
                'type'  => 'textarea',
                'rows'  => 3,
                'default_value' => '6th Milestone, Jharkheda, Sirmoli Village Road, Alwar - Bhiwadi State Highway, Alwar - 301028 (Raj.)',
            ),
            array(
                'key'   => 'field_footer_tab_menus',
                'label' => __('Menu & Links Columns', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_footer_menu_heading',
                'label' => __('Menu Column Heading', 'mlzs'),
                'name'  => 'footer_menu_heading',
                'type'  => 'text',
                'default_value' => 'Menu',
            ),
            array(
                'key'   => 'field_footer_menu_links',
                'label' => __('Menu Links', 'mlzs'),
                'name'  => 'footer_menu_links',
                'type'  => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Link', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key' => 'field_footer_menu_link',
                        'label' => __('Link', 'mlzs'),
                        'name' => 'link',
                        'type' => 'link',
                        'return_format' => 'array',
                        'instructions' => __('Link text (title) and URL in one field.', 'mlzs'),
                    ),
                ),
            ),
            array(
                'key'   => 'field_footer_links_heading',
                'label' => __('Links Column Heading', 'mlzs'),
                'name'  => 'footer_links_heading',
                'type'  => 'text',
                'default_value' => 'Links',
            ),
            array(
                'key'   => 'field_footer_links',
                'label' => __('Links', 'mlzs'),
                'name'  => 'footer_links',
                'type'  => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Link', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key' => 'field_footer_link',
                        'label' => __('Link', 'mlzs'),
                        'name' => 'link',
                        'type' => 'link',
                        'return_format' => 'array',
                        'instructions' => __('Link text (title) and URL in one field.', 'mlzs'),
                    ),
                ),
            ),
            array(
                'key'   => 'field_footer_contact_col_heading',
                'label' => __('Contact Column Heading', 'mlzs'),
                'name'  => 'footer_contact_col_heading',
                'type'  => 'text',
                'default_value' => 'Contact Us',
            ),
            array(
                'key'   => 'field_footer_tab_bottom',
                'label' => __('Copyright & Social', 'mlzs'),
                'name'  => '',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_footer_copyright',
                'label' => __('Copyright Text', 'mlzs'),
                'name'  => 'footer_copyright',
                'type'  => 'text',
                'default_value' => 'Mount Litera Zee School, Alwar. All rights reserved.',
                'instructions' => __('Year is added automatically. e.g. "Mount Litera Zee School, Alwar. All rights reserved."', 'mlzs'),
            ),
            array(
                'key'   => 'field_footer_developer_text',
                'label' => __('Developer Credit Text', 'mlzs'),
                'name'  => 'footer_developer_text',
                'type'  => 'text',
                'default_value' => 'Design & Developed By',
            ),
            array(
                'key'   => 'field_footer_developer_image',
                'label' => __('Developer Image', 'mlzs'),
                'name'  => 'footer_developer_image',
                'type'  => 'image',
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
                'instructions' => __('Leave empty to use theme default.', 'mlzs'),
            ),
            array(
                'key'   => 'field_footer_social',
                'label' => __('Social Links', 'mlzs'),
                'name'  => 'footer_social',
                'type'  => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Social', 'mlzs'),
                'sub_fields' => array(
                    array(
                        'key'   => 'field_footer_social_icon',
                        'label' => __('Icon', 'mlzs'),
                        'name'  => 'icon',
                        'type'  => 'text',
                        'placeholder' => 'e.g. instagram, linkedin, twitter, facebook',
                        'default_value' => 'instagram',
                    ),
                    array(
                        'key' => 'field_footer_social_link',
                        'label' => __('Link', 'mlzs'),
                        'name' => 'link',
                        'type' => 'link',
                        'return_format' => 'array',
                        'instructions' => __('Link URL. Link title used as aria-label.', 'mlzs'),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'acf-options-footer',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_footer_field_group');
