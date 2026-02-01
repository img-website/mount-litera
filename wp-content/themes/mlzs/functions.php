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

    // Fancybox for Alumni Feed, Photo Gallery, Origin (Campus) video, and Sports gallery popup
    if (is_page_template('feed.php') || is_page_template('gallery.php') || is_page_template('origin.php') || is_page_template('sports.php')) {
        wp_enqueue_style(
            'fancybox',
            'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css',
            array(),
            '5.0'
        );
        wp_enqueue_script(
            'fancybox',
            'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js',
            array(),
            '5.0',
            true
        );
        $fancybox_init = "
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Fancybox !== 'undefined') {
                    Fancybox.bind('[data-fancybox=\"alumni-gallery\"]', { Toolbar: { display: { left: ['infobar'], middle: [], right: ['slideshow', 'download', 'thumbs', 'close'] } }, Thumbs: { autoStart: true } });
                    Fancybox.bind('[data-fancybox=\"gallery\"]', { Toolbar: { display: { left: ['infobar'], middle: [], right: ['slideshow', 'download', 'thumbs', 'close'] } }, Thumbs: { autoStart: true } });
                    Fancybox.bind('[data-fancybox=\"sports-gallery\"]', { Toolbar: { display: { left: ['infobar'], middle: [], right: ['slideshow', 'download', 'thumbs', 'close'] } }, Thumbs: { autoStart: true } });
                    Fancybox.bind('[data-fancybox=\"origin-video\"]', { Toolbar: { display: { left: ['infobar'], middle: [], right: ['close'] } } });
                }
            });
        ";
        wp_add_inline_script('fancybox', $fancybox_init, 'after');
    }
}
add_action('wp_enqueue_scripts', 'mlzs_enqueue_assets');

/**
 * Set ACF Google Maps API key from wp-config constant (for Reach page map field and any Google Map fields).
 */
function mlzs_acf_google_maps_api_key() {
    if (defined('MLZS_GOOGLE_MAPS_API_KEY') && function_exists('acf_update_setting')) {
        acf_update_setting('google_api_key', constant('MLZS_GOOGLE_MAPS_API_KEY'));
    }
}
add_action('acf/init', 'mlzs_acf_google_maps_api_key', 5);

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
 * ACF Pro: Disaster Management Page – full content dynamic, all icons dynamic (Hero, Aim/Need/Committee, SDMP a/b, Dissemination, Drills, Safety, Health, CTA)
 */
function mlzs_acf_disaster_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_disaster',
        'title'                 => __('Disaster Management Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_disaster_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'disaster_hero_badge', 'type' => 'text', 'default_value' => 'Safety First'),
            array('key' => 'field_disaster_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'disaster_hero_icon', 'type' => 'text', 'default_value' => 'shield-alert'),
            array('key' => 'field_disaster_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'disaster_hero_headline', 'type' => 'text', 'default_value' => 'Disaster'),
            array('key' => 'field_disaster_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'disaster_hero_highlight', 'type' => 'text', 'default_value' => 'Management'),
            array('key' => 'field_disaster_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'disaster_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Ensuring student and staff safety through comprehensive preparedness and response planning'),
            array('key' => 'field_disaster_tab_aim', 'label' => __('Aim & Need & Committee', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_aim_icon', 'label' => __('Aim Box Icon', 'mlzs'), 'name' => 'disaster_aim_icon', 'type' => 'text', 'default_value' => 'target'),
            array('key' => 'field_disaster_aim_heading', 'label' => __('Aim Heading', 'mlzs'), 'name' => 'disaster_aim_heading', 'type' => 'text', 'default_value' => 'Aim'),
            array('key' => 'field_disaster_aim_text', 'label' => __('Aim Text', 'mlzs'), 'name' => 'disaster_aim_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_disaster_need_icon', 'label' => __('Need Box Icon', 'mlzs'), 'name' => 'disaster_need_icon', 'type' => 'text', 'default_value' => 'alert-triangle'),
            array('key' => 'field_disaster_need_heading', 'label' => __('Need Heading', 'mlzs'), 'name' => 'disaster_need_heading', 'type' => 'text', 'default_value' => 'Need For Disaster Management Plan'),
            array('key' => 'field_disaster_need_text', 'label' => __('Need Text', 'mlzs'), 'name' => 'disaster_need_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_disaster_committee_icon', 'label' => __('Committee Box Icon', 'mlzs'), 'name' => 'disaster_committee_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_disaster_committee_heading', 'label' => __('Committee Heading', 'mlzs'), 'name' => 'disaster_committee_heading', 'type' => 'text', 'default_value' => 'Disaster Management Committee'),
            array('key' => 'field_disaster_committee_intro', 'label' => __('Committee Intro', 'mlzs'), 'name' => 'disaster_committee_intro', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_disaster_committee_members', 'label' => __('Committee Members (one per line)', 'mlzs'), 'name' => 'disaster_committee_members', 'type' => 'textarea', 'rows' => 8),
            array('key' => 'field_disaster_committee_students', 'label' => __('Committee Students Line', 'mlzs'), 'name' => 'disaster_committee_students', 'type' => 'text', 'placeholder' => 'e.g. Students: Riya Verma, Deepak Yadav, Parth Sharma', 'instructions' => __('Optional. Shown below members with bold styling (mt-2 font-medium). Leave blank to hide.', 'mlzs')),
            array('key' => 'field_disaster_side_image', 'label' => __('Side Image (above committee)', 'mlzs'), 'name' => 'disaster_side_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_disaster_tab_sdmp', 'label' => __('SDMP Document', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_sdmp_heading', 'label' => __('SDMP Heading', 'mlzs'), 'name' => 'disaster_sdmp_heading', 'type' => 'text', 'default_value' => 'Preparation of the School Disaster Management Plan Document'),
            array('key' => 'field_disaster_sdmp_intro', 'label' => __('SDMP Intro', 'mlzs'), 'name' => 'disaster_sdmp_intro', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_disaster_sdmp_items', 'label' => __('SDMP Content: use label "a)" or "b)" for blocks, icon+text for list items', 'mlzs'), 'name' => 'disaster_sdmp_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Row', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_sdmp_label', 'label' => __('Label (e.g. a) or b))', 'mlzs'), 'name' => 'label', 'type' => 'text', 'placeholder' => 'a), b), or leave blank'),
                array('key' => 'field_disaster_sdmp_item_icon', 'label' => __('Icon (leave blank for paragraph rows)', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_sdmp_item_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_disaster_tab_dissem', 'label' => __('Dissemination', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_dissem_heading', 'label' => __('Dissemination Heading', 'mlzs'), 'name' => 'disaster_dissem_heading', 'type' => 'text', 'default_value' => 'Dissemination Of The Information On SDMP To Everybody In The School'),
            array('key' => 'field_disaster_dissem_intro', 'label' => __('Dissemination Intro', 'mlzs'), 'name' => 'disaster_dissem_intro', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_disaster_dissem_activities', 'label' => __('Activities (icon + label)', 'mlzs'), 'name' => 'disaster_dissem_activities', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Activity', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_dissem_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_dissem_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_tab_drills', 'label' => __('Mock Drills', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_drills_heading_icon', 'label' => __('Drills Section Icon', 'mlzs'), 'name' => 'disaster_drills_heading_icon', 'type' => 'text', 'default_value' => 'alarm-clock'),
            array('key' => 'field_disaster_drills_heading', 'label' => __('Drills Section Heading', 'mlzs'), 'name' => 'disaster_drills_heading', 'type' => 'text', 'default_value' => 'Mock Drills'),
            array('key' => 'field_disaster_drills_intro', 'label' => __('Drills Intro Paragraph', 'mlzs'), 'name' => 'disaster_drills_intro', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_disaster_drills_cards', 'label' => __('Drill Cards (3)', 'mlzs'), 'name' => 'disaster_drills_cards', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'block', 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_drill_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_disaster_drill_icon', 'label' => __('Card Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'earthquake'),
                array('key' => 'field_disaster_drill_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_disaster_drill_items', 'label' => __('Items (icon + text per item)', 'mlzs'), 'name' => 'items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_disaster_drill_item_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                    array('key' => 'field_disaster_drill_item_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
                )),
            )),
            array('key' => 'field_disaster_tab_safety', 'label' => __('Safety Precautions', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_safety_cyclones_heading', 'label' => __('Cyclones Heading', 'mlzs'), 'name' => 'disaster_safety_cyclones_heading', 'type' => 'text', 'default_value' => 'Safety Precautions During Cyclones'),
            array('key' => 'field_disaster_safety_cyclones_para', 'label' => __('Cyclones Paragraph', 'mlzs'), 'name' => 'disaster_safety_cyclones_para', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_disaster_safety_cyclones_list', 'label' => __('Cyclones List (icon + text)', 'mlzs'), 'name' => 'disaster_safety_cyclones_list', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_cyclone_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_cyclone_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_safety_general_heading', 'label' => __('General Precautions Heading', 'mlzs'), 'name' => 'disaster_safety_general_heading', 'type' => 'text', 'default_value' => 'General Precautions During Cyclone'),
            array('key' => 'field_disaster_safety_general_list', 'label' => __('General List (icon + text)', 'mlzs'), 'name' => 'disaster_safety_general_list', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_general_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_general_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_tab_health', 'label' => __('Health & Guidelines', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_health_norms_heading', 'label' => __('Health Norms Heading', 'mlzs'), 'name' => 'disaster_health_norms_heading', 'type' => 'text', 'default_value' => 'Health and Safety Norms'),
            array('key' => 'field_disaster_health_norms_items', 'label' => __('Health Norms (icon + label)', 'mlzs'), 'name' => 'disaster_health_norms_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_norm_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_norm_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_health_hygiene_heading', 'label' => __('Hygiene Heading', 'mlzs'), 'name' => 'disaster_health_hygiene_heading', 'type' => 'text', 'default_value' => 'Health and Hygiene Measures'),
            array('key' => 'field_disaster_health_hygiene_list', 'label' => __('Hygiene List (icon + text)', 'mlzs'), 'name' => 'disaster_health_hygiene_list', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_hygiene_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_hygiene_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_guidelines_heading', 'label' => __('Guidelines Heading', 'mlzs'), 'name' => 'disaster_guidelines_heading', 'type' => 'text', 'default_value' => 'Guidelines'),
            array('key' => 'field_disaster_guidelines_list', 'label' => __('Guidelines (icon + text)', 'mlzs'), 'name' => 'disaster_guidelines_list', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_guideline_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_guideline_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_disaster_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_disaster_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'disaster_cta_heading', 'type' => 'text', 'default_value' => 'Student Safety Measures'),
            array('key' => 'field_disaster_cta_measures', 'label' => __('Measures (icon + text)', 'mlzs'), 'name' => 'disaster_cta_measures', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Measure', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_cta_measure_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_disaster_cta_measure_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_disaster_cta_btn_primary', 'label' => __('Primary Button', 'mlzs'), 'name' => 'disaster_cta_btn_primary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_disaster_cta_btn_primary_icon', 'label' => __('Primary Button Icon', 'mlzs'), 'name' => 'disaster_cta_btn_primary_icon', 'type' => 'text', 'default_value' => 'download'),
            array('key' => 'field_disaster_cta_btn_secondary', 'label' => __('Secondary Button', 'mlzs'), 'name' => 'disaster_cta_btn_secondary', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_disaster_cta_btn_secondary_icon', 'label' => __('Secondary Button Icon', 'mlzs'), 'name' => 'disaster_cta_btn_secondary_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_disaster_cta_stats', 'label' => __('Stats (4 boxes)', 'mlzs'), 'name' => 'disaster_cta_stats', 'type' => 'repeater', 'min' => 4, 'max' => 4, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_disaster_cta_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_disaster_cta_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'disaster.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_disaster_field_group');

/**
 * ACF Pro: Eco Friendly Environment (EFE) Page – Hero, Top 3 Cards, No Smoking, Three Column, World Conservation, Community (all icons dynamic)
 */
function mlzs_acf_efe_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_efe',
        'title'                 => __('Eco Friendly Environment Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_efe_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'efe_hero_badge', 'type' => 'text', 'default_value' => 'Sustainability Initiative'),
            array('key' => 'field_efe_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'efe_hero_icon', 'type' => 'text', 'default_value' => 'leaf'),
            array('key' => 'field_efe_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'efe_hero_headline', 'type' => 'text', 'default_value' => 'Eco Friendly'),
            array('key' => 'field_efe_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'efe_hero_highlight', 'type' => 'text', 'default_value' => 'Environment'),
            array('key' => 'field_efe_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'efe_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Committed to creating a sustainable future through innovative environmental practices and community awareness'),
            array('key' => 'field_efe_tab_top', 'label' => __('Top 3 Cards', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_top_cards', 'label' => __('Zero Garbage / Paper Recycling / Holding Exhibitions', 'mlzs'), 'name' => 'efe_top_cards', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'block', 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_efe_top_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'trash-2'),
                array('key' => 'field_efe_top_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_efe_top_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 4),
            )),
            array('key' => 'field_efe_tab_smoking', 'label' => __('No Smoking Zone', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_smoking_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'efe_smoking_icon', 'type' => 'text', 'default_value' => 'ban'),
            array('key' => 'field_efe_smoking_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'efe_smoking_title', 'type' => 'text', 'default_value' => 'No Smoking Zone'),
            array('key' => 'field_efe_smoking_text', 'label' => __('Paragraph', 'mlzs'), 'name' => 'efe_smoking_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_efe_smoking_box1_icon', 'label' => __('Box 1 Icon', 'mlzs'), 'name' => 'efe_smoking_box1_icon', 'type' => 'text', 'default_value' => 'shield'),
            array('key' => 'field_efe_smoking_box1_title', 'label' => __('Box 1 Title', 'mlzs'), 'name' => 'efe_smoking_box1_title', 'type' => 'text', 'default_value' => 'Anti Poly Bag Campaign'),
            array('key' => 'field_efe_smoking_box1_text', 'label' => __('Box 1 Text', 'mlzs'), 'name' => 'efe_smoking_box1_text', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_efe_smoking_box2_icon', 'label' => __('Box 2 Icon', 'mlzs'), 'name' => 'efe_smoking_box2_icon', 'type' => 'text', 'default_value' => 'book-open'),
            array('key' => 'field_efe_smoking_box2_title', 'label' => __('Box 2 Title', 'mlzs'), 'name' => 'efe_smoking_box2_title', 'type' => 'text', 'default_value' => 'Environment Quotient'),
            array('key' => 'field_efe_smoking_box2_text', 'label' => __('Box 2 Text', 'mlzs'), 'name' => 'efe_smoking_box2_text', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_efe_tab_three', 'label' => __('Three Column Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_three_cards', 'label' => __('Rakhi Tying / Earth Watch / Van Mahotsav (3 cards)', 'mlzs'), 'name' => 'efe_three_cards', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'block', 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_efe_three_icon', 'label' => __('Card Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'heart'),
                array('key' => 'field_efe_three_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_efe_three_description', 'label' => __('Card Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_efe_three_sub_boxes', 'label' => __('Sub boxes (icon + title + text)', 'mlzs'), 'name' => 'sub_boxes', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Box', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_efe_three_sub_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                    array('key' => 'field_efe_three_sub_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_efe_three_sub_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'textarea', 'rows' => 2),
                )),
                array('key' => 'field_efe_three_list_items', 'label' => __('List items (icon + text) – use if no sub boxes', 'mlzs'), 'name' => 'list_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_efe_three_list_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                    array('key' => 'field_efe_three_list_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
                )),
            )),
            array('key' => 'field_efe_tab_world', 'label' => __('World Conservation Day', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_world_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'efe_world_icon', 'type' => 'text', 'default_value' => 'globe'),
            array('key' => 'field_efe_world_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'efe_world_title', 'type' => 'text', 'default_value' => 'World Conservation Day'),
            array('key' => 'field_efe_world_text', 'label' => __('Paragraph', 'mlzs'), 'name' => 'efe_world_text', 'type' => 'textarea', 'rows' => 5),
            array('key' => 'field_efe_world_boxes', 'label' => __('Two boxes (icon + title + description)', 'mlzs'), 'name' => 'efe_world_boxes', 'type' => 'repeater', 'min' => 2, 'max' => 2, 'layout' => 'table', 'button_label' => __('Add Box', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_efe_world_box_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'),
                array('key' => 'field_efe_world_box_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_efe_world_box_text', 'label' => __('Description', 'mlzs'), 'name' => 'text', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_efe_tab_community', 'label' => __('Community Involvement', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_efe_community_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'efe_community_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_efe_community_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'efe_community_title', 'type' => 'text', 'default_value' => 'Community Involvement'),
            array('key' => 'field_efe_community_text', 'label' => __('Paragraph', 'mlzs'), 'name' => 'efe_community_text', 'type' => 'textarea', 'rows' => 5),
            array('key' => 'field_efe_community_boxes', 'label' => __('Three boxes (icon + label)', 'mlzs'), 'name' => 'efe_community_boxes', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'table', 'button_label' => __('Add Box', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_efe_community_box_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'file-text'),
                array('key' => 'field_efe_community_box_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'efe.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_efe_field_group');

/**
 * ACF Pro: Enquiry Page – Hero, Campus, Contact, Stats, Form heading/features, FAQ (all dynamic, icons dynamic)
 */
function mlzs_acf_enquiry_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_enquiry',
        'title'                 => __('Enquiry Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_enq_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'enquiry_hero_badge', 'type' => 'text', 'default_value' => 'Get in Touch'),
            array('key' => 'field_enq_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'enquiry_hero_icon', 'type' => 'text', 'default_value' => 'message-square'),
            array('key' => 'field_enq_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'enquiry_hero_headline', 'type' => 'text', 'default_value' => 'Enquiry'),
            array('key' => 'field_enq_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'enquiry_hero_highlight', 'type' => 'text', 'default_value' => 'Form'),
            array('key' => 'field_enq_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'enquiry_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Let's start your child's educational journey. Share your details and we'll reach out to you."),
            array('key' => 'field_enq_tab_campus', 'label' => __('Campus Card', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_campus_icon', 'label' => __('Card Icon', 'mlzs'), 'name' => 'enquiry_campus_icon', 'type' => 'text', 'default_value' => 'school'),
            array('key' => 'field_enq_campus_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'enquiry_campus_title', 'type' => 'text', 'default_value' => 'Campus'),
            array('key' => 'field_enq_campus_address_heading', 'label' => __('Address Heading', 'mlzs'), 'name' => 'enquiry_campus_address_heading', 'type' => 'text', 'default_value' => 'Address'),
            array('key' => 'field_enq_campus_address', 'label' => __('Address (multiline)', 'mlzs'), 'name' => 'enquiry_campus_address', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_enq_campus_map_url', 'label' => __('View on Map URL', 'mlzs'), 'name' => 'enquiry_campus_map_url', 'type' => 'url'),
            array('key' => 'field_enq_campus_map_text', 'label' => __('View on Map Button Text', 'mlzs'), 'name' => 'enquiry_campus_map_text', 'type' => 'text', 'default_value' => 'View on Map'),
            array('key' => 'field_enq_campus_map_icon', 'label' => __('Map Button Icon', 'mlzs'), 'name' => 'enquiry_campus_map_icon', 'type' => 'text', 'default_value' => 'navigation'),
            array('key' => 'field_enq_tab_contact', 'label' => __('Contact Card', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_contact_icon', 'label' => __('Card Icon', 'mlzs'), 'name' => 'enquiry_contact_icon', 'type' => 'text', 'default_value' => 'phone'),
            array('key' => 'field_enq_contact_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'enquiry_contact_title', 'type' => 'text', 'default_value' => 'Phone & E-mail'),
            array('key' => 'field_enq_contact_phone_label', 'label' => __('Phone Label', 'mlzs'), 'name' => 'enquiry_contact_phone_label', 'type' => 'text', 'default_value' => 'Admissions and Enquiry'),
            array('key' => 'field_enq_contact_phone_icon', 'label' => __('Phone Row Icon', 'mlzs'), 'name' => 'enquiry_contact_phone_icon', 'type' => 'text', 'default_value' => 'phone-call'),
            array('key' => 'field_enq_contact_phone_number', 'label' => __('Phone Number', 'mlzs'), 'name' => 'enquiry_contact_phone_number', 'type' => 'text'),
            array('key' => 'field_enq_contact_email_label', 'label' => __('Email Label', 'mlzs'), 'name' => 'enquiry_contact_email_label', 'type' => 'text', 'default_value' => 'Email Address'),
            array('key' => 'field_enq_contact_email_icon', 'label' => __('Email Row Icon', 'mlzs'), 'name' => 'enquiry_contact_email_icon', 'type' => 'text', 'default_value' => 'mail'),
            array('key' => 'field_enq_contact_emails', 'label' => __('Email Addresses (one per line)', 'mlzs'), 'name' => 'enquiry_contact_emails', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_enq_contact_call_text', 'label' => __('Call Button Text', 'mlzs'), 'name' => 'enquiry_contact_call_text', 'type' => 'text', 'default_value' => 'Call Now'),
            array('key' => 'field_enq_contact_call_icon', 'label' => __('Call Button Icon', 'mlzs'), 'name' => 'enquiry_contact_call_icon', 'type' => 'text', 'default_value' => 'phone'),
            array('key' => 'field_enq_contact_email_btn_text', 'label' => __('Email Button Text', 'mlzs'), 'name' => 'enquiry_contact_email_btn_text', 'type' => 'text', 'default_value' => 'Send Email'),
            array('key' => 'field_enq_contact_email_btn_icon', 'label' => __('Email Button Icon', 'mlzs'), 'name' => 'enquiry_contact_email_btn_icon', 'type' => 'text', 'default_value' => 'mail'),
            array('key' => 'field_enq_tab_stats', 'label' => __('Quick Stats', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_stat1_number', 'label' => __('Stat 1 Number', 'mlzs'), 'name' => 'enquiry_stat1_number', 'type' => 'text', 'default_value' => '24/7'),
            array('key' => 'field_enq_stat1_label', 'label' => __('Stat 1 Label', 'mlzs'), 'name' => 'enquiry_stat1_label', 'type' => 'text', 'default_value' => 'Support Available'),
            array('key' => 'field_enq_stat2_number', 'label' => __('Stat 2 Number', 'mlzs'), 'name' => 'enquiry_stat2_number', 'type' => 'text', 'default_value' => '2 Hours'),
            array('key' => 'field_enq_stat2_label', 'label' => __('Stat 2 Label', 'mlzs'), 'name' => 'enquiry_stat2_label', 'type' => 'text', 'default_value' => 'Response Time'),
            array('key' => 'field_enq_tab_form', 'label' => __('Form Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_form_icon', 'label' => __('Form Card Icon', 'mlzs'), 'name' => 'enquiry_form_icon', 'type' => 'text', 'default_value' => 'user-plus'),
            array('key' => 'field_enq_form_title', 'label' => __('Form Title', 'mlzs'), 'name' => 'enquiry_form_title', 'type' => 'text', 'default_value' => 'Submit Enquiry'),
            array('key' => 'field_enq_form_subtitle', 'label' => __('Form Subtitle', 'mlzs'), 'name' => 'enquiry_form_subtitle', 'type' => 'text', 'default_value' => "We'll contact you within 24 hours"),
            array('key' => 'field_enq_form_action', 'label' => __('Form Action URL', 'mlzs'), 'name' => 'enquiry_form_action', 'type' => 'url', 'instructions' => __('Leave blank to use # or add Contact Form 7 / custom handler URL.', 'mlzs')),
            array('key' => 'field_enq_form_privacy_text', 'label' => __('Privacy Text', 'mlzs'), 'name' => 'enquiry_form_privacy_text', 'type' => 'text', 'default_value' => 'By submitting, you agree to our'),
            array('key' => 'field_enq_form_privacy_link', 'label' => __('Privacy Policy Link', 'mlzs'), 'name' => 'enquiry_form_privacy_link', 'type' => 'url'),
            array('key' => 'field_enq_form_privacy_link_label', 'label' => __('Privacy Link Label', 'mlzs'), 'name' => 'enquiry_form_privacy_link_label', 'type' => 'text', 'default_value' => 'Privacy Policy'),
            array('key' => 'field_enq_form_submit_text', 'label' => __('Submit Button Text', 'mlzs'), 'name' => 'enquiry_form_submit_text', 'type' => 'text', 'default_value' => 'Submit Enquiry'),
            array('key' => 'field_enq_form_submit_icon', 'label' => __('Submit Button Icon', 'mlzs'), 'name' => 'enquiry_form_submit_icon', 'type' => 'text', 'default_value' => 'send'),
            array('key' => 'field_enq_form_features', 'label' => __('Form Features (3 items: icon + label)', 'mlzs'), 'name' => 'enquiry_form_features', 'type' => 'repeater', 'min' => 3, 'max' => 3, 'layout' => 'table', 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_enq_form_feature_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'shield-check'),
                array('key' => 'field_enq_form_feature_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
            array('key' => 'field_enq_tab_faq', 'label' => __('FAQ Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_enq_faq_heading', 'label' => __('FAQ Heading', 'mlzs'), 'name' => 'enquiry_faq_heading', 'type' => 'text', 'default_value' => 'Frequently Asked Questions'),
            array('key' => 'field_enq_faq_subtext', 'label' => __('FAQ Subtext', 'mlzs'), 'name' => 'enquiry_faq_subtext', 'type' => 'text', 'default_value' => 'Quick answers to common queries'),
            array('key' => 'field_enq_faq_items', 'label' => __('FAQ Items (icon + question + answer)', 'mlzs'), 'name' => 'enquiry_faq_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add FAQ', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_enq_faq_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'help-circle'),
                array('key' => 'field_enq_faq_question', 'label' => __('Question', 'mlzs'), 'name' => 'question', 'type' => 'text'),
                array('key' => 'field_enq_faq_answer', 'label' => __('Answer', 'mlzs'), 'name' => 'answer', 'type' => 'textarea', 'rows' => 2),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'enquiry.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_enquiry_field_group');

/**
 * ACF Pro: Exam Activity Planner Page – Hero, Exam blocks (III–V, VI–VIII, IX–XII), Activity tabs, Legend
 */
function mlzs_acf_exam_activity_planner_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_exam_activity_planner',
        'title'                 => __('Exam Activity Planner Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_eap_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_eap_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'eap_hero_badge', 'type' => 'text', 'default_value' => 'Academic Year 2025-2026'),
            array('key' => 'field_eap_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'eap_hero_icon', 'type' => 'text', 'default_value' => 'calendar-days'),
            array('key' => 'field_eap_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'eap_hero_headline', 'type' => 'text', 'default_value' => 'Exam & Activity'),
            array('key' => 'field_eap_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'eap_hero_highlight', 'type' => 'text', 'default_value' => 'Planner'),
            array('key' => 'field_eap_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'eap_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Comprehensive schedule for Half Yearly Examinations and Annual Activities at Mount Litera Zee School, Alwar. Stay updated with all academic and co-curricular events."),
            array('key' => 'field_eap_hero_btn1_label', 'label' => __('Button 1 Label', 'mlzs'), 'name' => 'eap_hero_btn1_label', 'type' => 'text', 'default_value' => 'Exam Schedule'),
            array('key' => 'field_eap_hero_btn1_link', 'label' => __('Button 1 Link (anchor)', 'mlzs'), 'name' => 'eap_hero_btn1_link', 'type' => 'text', 'default_value' => '#exam-planner'),
            array('key' => 'field_eap_hero_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'eap_hero_btn1_icon', 'type' => 'text', 'default_value' => 'book-open'),
            array('key' => 'field_eap_hero_btn2_label', 'label' => __('Button 2 Label', 'mlzs'), 'name' => 'eap_hero_btn2_label', 'type' => 'text', 'default_value' => 'Activity Planner'),
            array('key' => 'field_eap_hero_btn2_link', 'label' => __('Button 2 Link (anchor)', 'mlzs'), 'name' => 'eap_hero_btn2_link', 'type' => 'text', 'default_value' => '#activity-planner'),
            array('key' => 'field_eap_hero_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'eap_hero_btn2_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_eap_tab_exam', 'label' => __('Exam Planner Blocks', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_eap_exam_blocks', 'label' => __('Exam Sections (Grades III–V, VI–VIII, IX–XII)', 'mlzs'), 'name' => 'eap_exam_blocks', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Exam Section', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_eap_block_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'book-open'),
                array('key' => 'field_eap_block_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Half Yearly Exam - 2025-2026'),
                array('key' => 'field_eap_block_subtitle', 'label' => __('Section Subtitle (e.g. Grades: III to V)', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Grades: III to V'),
                array('key' => 'field_eap_block_icon_style', 'label' => __('Icon box color', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'primary-dark' => 'Primary Dark'), 'default_value' => 'primary'),
                array('key' => 'field_eap_verbal_heading', 'label' => __('Verbal Assessment Heading', 'mlzs'), 'name' => 'verbal_heading', 'type' => 'text', 'default_value' => 'Verbal Assessment Schedule'),
                array('key' => 'field_eap_verbal_note', 'label' => __('Verbal Note (below table)', 'mlzs'), 'name' => 'verbal_note', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_eap_verbal_note_icon', 'label' => __('Verbal Note Icon', 'mlzs'), 'name' => 'verbal_note_icon', 'type' => 'text', 'default_value' => 'info'),
                array('key' => 'field_eap_verbal_note_style', 'label' => __('Verbal note box style', 'mlzs'), 'name' => 'verbal_note_style', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'amber' => 'Amber'), 'default_value' => 'blue'),
                array('key' => 'field_eap_verbal_rows', 'label' => __('Verbal Table Rows', 'mlzs'), 'name' => 'verbal_rows', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Row', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_eap_vr_date', 'label' => __('Date', 'mlzs'), 'name' => 'date', 'type' => 'text'),
                    array('key' => 'field_eap_vr_day', 'label' => __('Day', 'mlzs'), 'name' => 'day', 'type' => 'text'),
                    array('key' => 'field_eap_vr_subject', 'label' => __('Subject', 'mlzs'), 'name' => 'subject', 'type' => 'text'),
                )),
                array('key' => 'field_eap_written_heading', 'label' => __('Written Assessment Heading', 'mlzs'), 'name' => 'written_heading', 'type' => 'text', 'default_value' => 'Written Assessment Schedule'),
                array('key' => 'field_eap_written_note', 'label' => __('Written Note (below table)', 'mlzs'), 'name' => 'written_note', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_eap_written_note_icon', 'label' => __('Written Note Icon', 'mlzs'), 'name' => 'written_note_icon', 'type' => 'text', 'default_value' => 'alert-circle'),
                array('key' => 'field_eap_written_note_style', 'label' => __('Written note box style', 'mlzs'), 'name' => 'written_note_style', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'amber' => 'Amber'), 'default_value' => 'amber'),
                array('key' => 'field_eap_written_header_labels', 'label' => __('Written Table Column Headers (one per line, after Date)', 'mlzs'), 'name' => 'written_header_labels', 'type' => 'textarea', 'rows' => 3, 'instructions' => __('e.g. Grade III, Grade IV, Grade V', 'mlzs')),
                array('key' => 'field_eap_written_rows', 'label' => __('Written Table Rows', 'mlzs'), 'name' => 'written_rows', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Row', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_eap_wr_date', 'label' => __('Date', 'mlzs'), 'name' => 'date', 'type' => 'text'),
                    array('key' => 'field_eap_wr_col1', 'label' => __('Col 1', 'mlzs'), 'name' => 'col1', 'type' => 'textarea', 'rows' => 1),
                    array('key' => 'field_eap_wr_col2', 'label' => __('Col 2', 'mlzs'), 'name' => 'col2', 'type' => 'textarea', 'rows' => 1),
                    array('key' => 'field_eap_wr_col3', 'label' => __('Col 3', 'mlzs'), 'name' => 'col3', 'type' => 'textarea', 'rows' => 1),
                    array('key' => 'field_eap_wr_col4', 'label' => __('Col 4', 'mlzs'), 'name' => 'col4', 'type' => 'textarea', 'rows' => 1),
                    array('key' => 'field_eap_wr_col5', 'label' => __('Col 5', 'mlzs'), 'name' => 'col5', 'type' => 'textarea', 'rows' => 1),
                )),
            )),
            array('key' => 'field_eap_tab_activity', 'label' => __('Activity Planner', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_eap_activity_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'eap_activity_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_eap_activity_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'eap_activity_title', 'type' => 'text', 'default_value' => 'Activity Planner 2025-2026'),
            array('key' => 'field_eap_activity_subtitle', 'label' => __('Section Subtitle', 'mlzs'), 'name' => 'eap_activity_subtitle', 'type' => 'text', 'default_value' => 'Annual Schedule of Events and Activities'),
            array('key' => 'field_eap_activity_tabs', 'label' => __('Month Tabs & Tables', 'mlzs'), 'name' => 'eap_activity_tabs', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Tab', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_eap_atab_label', 'label' => __('Tab Label', 'mlzs'), 'name' => 'tab_label', 'type' => 'text', 'placeholder' => 'e.g. APRIL - OCTOBER'),
                array('key' => 'field_eap_atab_slug', 'label' => __('Tab Slug (no spaces)', 'mlzs'), 'name' => 'tab_slug', 'type' => 'text', 'placeholder' => 'apr-oct'),
                array('key' => 'field_eap_atab_month1', 'label' => __('Month 1 Header', 'mlzs'), 'name' => 'month1_heading', 'type' => 'text', 'placeholder' => 'APRIL'),
                array('key' => 'field_eap_atab_month2', 'label' => __('Month 2 Header', 'mlzs'), 'name' => 'month2_heading', 'type' => 'text', 'placeholder' => 'OCTOBER'),
                array('key' => 'field_eap_atab_rows', 'label' => __('Table Rows', 'mlzs'), 'name' => 'table_rows', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Row', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_eap_atab_date1', 'label' => __('Date 1', 'mlzs'), 'name' => 'date1', 'type' => 'text'),
                    array('key' => 'field_eap_atab_desc1', 'label' => __('Description 1', 'mlzs'), 'name' => 'desc1', 'type' => 'textarea', 'rows' => 1),
                    array('key' => 'field_eap_atab_date2', 'label' => __('Date 2', 'mlzs'), 'name' => 'date2', 'type' => 'text'),
                    array('key' => 'field_eap_atab_desc2', 'label' => __('Description 2', 'mlzs'), 'name' => 'desc2', 'type' => 'textarea', 'rows' => 1),
                )),
            )),
            array('key' => 'field_eap_tab_legend', 'label' => __('Legend', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_eap_legend_items', 'label' => __('Legend Items', 'mlzs'), 'name' => 'eap_legend_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_eap_legend_abbrev', 'label' => __('Abbreviation', 'mlzs'), 'name' => 'abbrev', 'type' => 'text'),
                array('key' => 'field_eap_legend_full', 'label' => __('Full Text', 'mlzs'), 'name' => 'full_text', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'exam-activity-planner.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_exam_activity_planner_field_group');

/**
 * ACF Pro: Excursion Page – Hero, Uttarakhand trip, Village Experience, Outbound, Benefits, CTA
 */
function mlzs_acf_excursion_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_excursion',
        'title'                 => __('Excursion Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_exc_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'excursion_hero_badge', 'type' => 'text', 'default_value' => 'Learning Beyond Classroom'),
            array('key' => 'field_exc_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'excursion_hero_icon', 'type' => 'text', 'default_value' => 'map-pin'),
            array('key' => 'field_exc_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'excursion_hero_headline', 'type' => 'text', 'default_value' => 'Educational'),
            array('key' => 'field_exc_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'excursion_hero_highlight', 'type' => 'text', 'default_value' => 'Excursions'),
            array('key' => 'field_exc_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'excursion_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Exploring the world, connecting with nature, and creating lifelong memories through educational trips'),
            array('key' => 'field_exc_tab_uttarakhand', 'label' => __('Uttarakhand Trip', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_utt_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'excursion_uttarakhand_icon', 'type' => 'text', 'default_value' => 'mountain'),
            array('key' => 'field_exc_utt_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'excursion_uttarakhand_title', 'type' => 'text', 'default_value' => 'Uttarakhand Educational Excursion'),
            array('key' => 'field_exc_utt_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'excursion_uttarakhand_subtitle', 'type' => 'text', 'default_value' => 'Dehradun, Rishikesh, Mussoorie & Nainital'),
            array('key' => 'field_exc_utt_description', 'label' => __('Description', 'mlzs'), 'name' => 'excursion_uttarakhand_description', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_exc_utt_images', 'label' => __('Trip Images (2)', 'mlzs'), 'name' => 'excursion_uttarakhand_images', 'type' => 'repeater', 'min' => 0, 'max' => 6, 'layout' => 'block', 'button_label' => __('Add Image', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_utt_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
                array('key' => 'field_exc_utt_img_alt', 'label' => __('Alt Text', 'mlzs'), 'name' => 'alt', 'type' => 'text'),
                array('key' => 'field_exc_utt_caption_title', 'label' => __('Caption Title', 'mlzs'), 'name' => 'caption_title', 'type' => 'text'),
                array('key' => 'field_exc_utt_caption_sub', 'label' => __('Caption Subtitle', 'mlzs'), 'name' => 'caption_subtitle', 'type' => 'text'),
            )),
            array('key' => 'field_exc_utt_activities_heading', 'label' => __('Activities Heading', 'mlzs'), 'name' => 'excursion_uttarakhand_activities_heading', 'type' => 'text', 'default_value' => 'Activities Participated'),
            array('key' => 'field_exc_utt_activities_icon', 'label' => __('Activities Icon', 'mlzs'), 'name' => 'excursion_uttarakhand_activities_icon', 'type' => 'text', 'default_value' => 'activity'),
            array('key' => 'field_exc_utt_activities', 'label' => __('Activities (icon + label)', 'mlzs'), 'name' => 'excursion_uttarakhand_activities', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_utt_act_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'palette'),
                array('key' => 'field_exc_utt_act_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
            array('key' => 'field_exc_tab_village', 'label' => __('Village Experience', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_village_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'excursion_village_icon', 'type' => 'text', 'default_value' => 'home'),
            array('key' => 'field_exc_village_title', 'label' => __('Title', 'mlzs'), 'name' => 'excursion_village_title', 'type' => 'text', 'default_value' => 'Village Immersion Experience'),
            array('key' => 'field_exc_village_description', 'label' => __('Description', 'mlzs'), 'name' => 'excursion_village_description', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_exc_village_items', 'label' => __('List Items (icon + text)', 'mlzs'), 'name' => 'excursion_village_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_village_item_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_exc_village_item_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_exc_tab_outbound', 'label' => __('Outbound Programs', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_outbound_images', 'label' => __('Images (2)', 'mlzs'), 'name' => 'excursion_outbound_images', 'type' => 'repeater', 'min' => 0, 'max' => 6, 'layout' => 'block', 'button_label' => __('Add Image', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_out_img', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
                array('key' => 'field_exc_out_img_alt', 'label' => __('Alt Text', 'mlzs'), 'name' => 'alt', 'type' => 'text'),
                array('key' => 'field_exc_out_caption_title', 'label' => __('Caption Title', 'mlzs'), 'name' => 'caption_title', 'type' => 'text'),
                array('key' => 'field_exc_out_caption_sub', 'label' => __('Caption Subtitle', 'mlzs'), 'name' => 'caption_subtitle', 'type' => 'text'),
            )),
            array('key' => 'field_exc_outbound_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'excursion_outbound_icon', 'type' => 'text', 'default_value' => 'trees'),
            array('key' => 'field_exc_outbound_title', 'label' => __('Title', 'mlzs'), 'name' => 'excursion_outbound_title', 'type' => 'text', 'default_value' => 'Outbound Programs'),
            array('key' => 'field_exc_outbound_description', 'label' => __('Description', 'mlzs'), 'name' => 'excursion_outbound_description', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_exc_outbound_quote', 'label' => __('Quote (italic block)', 'mlzs'), 'name' => 'excursion_outbound_quote', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_exc_outbound_paragraph', 'label' => __('Second Paragraph', 'mlzs'), 'name' => 'excursion_outbound_paragraph', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_exc_tab_benefits', 'label' => __('Benefits Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_benefits_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'excursion_benefits_heading', 'type' => 'text', 'default_value' => 'Benefits of'),
            array('key' => 'field_exc_benefits_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'excursion_benefits_highlight', 'type' => 'text', 'default_value' => 'Educational Excursions'),
            array('key' => 'field_exc_benefits_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'excursion_benefits_subtext', 'type' => 'text', 'default_value' => 'Learning beyond classroom walls for holistic development'),
            array('key' => 'field_exc_benefits_cards', 'label' => __('Benefit Cards (icon, title, description)', 'mlzs'), 'name' => 'excursion_benefits_cards', 'type' => 'repeater', 'min' => 1, 'layout' => 'block', 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_ben_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'),
                array('key' => 'field_exc_ben_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_exc_ben_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_exc_ben_style', 'label' => __('Card style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-alt' => 'Primary (border)'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_exc_tab_cta', 'label' => __('Upcoming CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_exc_cta_title', 'label' => __('CTA Title', 'mlzs'), 'name' => 'excursion_cta_title', 'type' => 'text', 'default_value' => 'Upcoming Excursions'),
            array('key' => 'field_exc_cta_text', 'label' => __('CTA Text', 'mlzs'), 'name' => 'excursion_cta_text', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_exc_cta_btn1_label', 'label' => __('Button 1 Label', 'mlzs'), 'name' => 'excursion_cta_btn1_label', 'type' => 'text', 'default_value' => 'View Schedule'),
            array('key' => 'field_exc_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'excursion_cta_btn1_link', 'type' => 'url'),
            array('key' => 'field_exc_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'excursion_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_exc_cta_btn2_label', 'label' => __('Button 2 Label', 'mlzs'), 'name' => 'excursion_cta_btn2_label', 'type' => 'text', 'default_value' => 'Photo Gallery'),
            array('key' => 'field_exc_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'excursion_cta_btn2_link', 'type' => 'url'),
            array('key' => 'field_exc_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'excursion_cta_btn2_icon', 'type' => 'text', 'default_value' => 'camera'),
            array('key' => 'field_exc_cta_stats', 'label' => __('Stats (number + label)', 'mlzs'), 'name' => 'excursion_cta_stats', 'type' => 'repeater', 'min' => 0, 'max' => 6, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_exc_cta_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_exc_cta_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'excursion.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_excursion_field_group');

/**
 * ACF Pro: Alumni Feed Page – Hero, Alumni gallery, Suggestions form, Stats
 */
function mlzs_acf_feed_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_feed',
        'title'                 => __('Alumni Feed Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_feed_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_feed_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'feed_hero_badge', 'type' => 'text', 'default_value' => 'Alumni Network'),
            array('key' => 'field_feed_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'feed_hero_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_feed_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'feed_hero_headline', 'type' => 'text', 'default_value' => 'Alumni'),
            array('key' => 'field_feed_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'feed_hero_highlight', 'type' => 'text', 'default_value' => 'Feed'),
            array('key' => 'field_feed_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'feed_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Celebrating the achievements of our alumni who continue to inspire and make us proud across the globe'),
            array('key' => 'field_feed_hero_badge_icon_color', 'label' => __('Hero Badge Icon Color Class', 'mlzs'), 'name' => 'feed_hero_badge_icon_color', 'type' => 'text', 'default_value' => 'text-accent', 'instructions' => __('Tailwind class, e.g. text-accent', 'mlzs')),
            array('key' => 'field_feed_hero_highlight_color', 'label' => __('Hero Headline Highlight Color Class', 'mlzs'), 'name' => 'feed_hero_highlight_color', 'type' => 'text', 'default_value' => 'text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange', 'instructions' => __('Tailwind classes for the highlighted word', 'mlzs')),
            array('key' => 'field_feed_hero_subheadline_color', 'label' => __('Hero Subheadline Color Class', 'mlzs'), 'name' => 'feed_hero_subheadline_color', 'type' => 'text', 'default_value' => 'text-slate-200', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_tab_alumni', 'label' => __('Alumni Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_feed_section_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'feed_section_badge', 'type' => 'text', 'default_value' => 'Our Alumni Network'),
            array('key' => 'field_feed_section_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'feed_section_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_feed_section_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'feed_section_heading', 'type' => 'text', 'default_value' => 'Mount Litera'),
            array('key' => 'field_feed_section_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'feed_section_highlight', 'type' => 'text', 'default_value' => 'Alumni'),
            array('key' => 'field_feed_section_description', 'label' => __('Section Description', 'mlzs'), 'name' => 'feed_section_description', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Celebrating the achievements of our alumni who continue to inspire and make us proud across the globe.'),
            array('key' => 'field_feed_section_badge_color', 'label' => __('Section Badge Color Class', 'mlzs'), 'name' => 'feed_section_badge_color', 'type' => 'text', 'default_value' => 'text-primary', 'instructions' => __('Tailwind class for badge text/icon', 'mlzs')),
            array('key' => 'field_feed_section_heading_color', 'label' => __('Section Heading (normal) Color Class', 'mlzs'), 'name' => 'feed_section_heading_color', 'type' => 'text', 'default_value' => 'text-text-main-light', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_section_highlight_color', 'label' => __('Section Heading Highlight Color Class', 'mlzs'), 'name' => 'feed_section_highlight_color', 'type' => 'text', 'default_value' => 'text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light', 'instructions' => __('Tailwind classes for highlighted word', 'mlzs')),
            array('key' => 'field_feed_section_description_color', 'label' => __('Section Description Color Class', 'mlzs'), 'name' => 'feed_section_description_color', 'type' => 'text', 'default_value' => 'text-text-secondary-light', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_gallery', 'label' => __('Alumni Gallery Items', 'mlzs'), 'name' => 'feed_gallery', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_feed_gal_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
                array('key' => 'field_feed_gal_alt', 'label' => __('Alt Text', 'mlzs'), 'name' => 'alt', 'type' => 'text'),
                array('key' => 'field_feed_gal_title', 'label' => __('Caption Title', 'mlzs'), 'name' => 'caption_title', 'type' => 'text'),
                array('key' => 'field_feed_gal_subtitle', 'label' => __('Caption Subtitle', 'mlzs'), 'name' => 'caption_subtitle', 'type' => 'text'),
                array('key' => 'field_feed_gal_new_badge', 'label' => __('Show "New" badge', 'mlzs'), 'name' => 'show_new_badge', 'type' => 'true_false', 'ui' => 1, 'default_value' => 0),
                array('key' => 'field_feed_gal_span_two', 'label' => __('Span 2 columns (wide)', 'mlzs'), 'name' => 'span_two', 'type' => 'true_false', 'ui' => 1, 'default_value' => 0),
            )),
            array('key' => 'field_feed_tab_form', 'label' => __('Suggestions Form', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_feed_form_badge', 'label' => __('Form Badge Text', 'mlzs'), 'name' => 'feed_form_badge', 'type' => 'text', 'default_value' => 'Share Your Voice'),
            array('key' => 'field_feed_form_icon', 'label' => __('Form Badge Icon', 'mlzs'), 'name' => 'feed_form_icon', 'type' => 'text', 'default_value' => 'message-square'),
            array('key' => 'field_feed_form_title', 'label' => __('Form Title', 'mlzs'), 'name' => 'feed_form_title', 'type' => 'text', 'default_value' => 'Suggestions & Feedback'),
            array('key' => 'field_feed_form_subtitle', 'label' => __('Form Subtitle', 'mlzs'), 'name' => 'feed_form_subtitle', 'type' => 'text', 'default_value' => 'Your suggestions help us improve. Share your thoughts with us.'),
            array('key' => 'field_feed_form_action', 'label' => __('Form Action URL', 'mlzs'), 'name' => 'feed_form_action', 'type' => 'url', 'instructions' => __('Leave blank for # or use Contact Form 7 / custom handler URL.', 'mlzs')),
            array('key' => 'field_feed_form_privacy', 'label' => __('Privacy Note (below submit)', 'mlzs'), 'name' => 'feed_form_privacy', 'type' => 'text', 'default_value' => 'Your suggestions are confidential and will be used to improve our services.'),
            array('key' => 'field_feed_form_submit_text', 'label' => __('Submit Button Text', 'mlzs'), 'name' => 'feed_form_submit_text', 'type' => 'text', 'default_value' => 'Send Suggestion'),
            array('key' => 'field_feed_form_submit_icon', 'label' => __('Submit Button Icon', 'mlzs'), 'name' => 'feed_form_submit_icon', 'type' => 'text', 'default_value' => 'send'),
            array('key' => 'field_feed_form_badge_color', 'label' => __('Form Badge & Icon Color Class', 'mlzs'), 'name' => 'feed_form_badge_color', 'type' => 'text', 'default_value' => 'text-accent', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_form_title_color', 'label' => __('Form Title Color Class', 'mlzs'), 'name' => 'feed_form_title_color', 'type' => 'text', 'default_value' => 'text-white', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_form_subtitle_color', 'label' => __('Form Subtitle Color Class', 'mlzs'), 'name' => 'feed_form_subtitle_color', 'type' => 'text', 'default_value' => 'text-slate-300', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_form_privacy_color', 'label' => __('Form Privacy Note Color Class', 'mlzs'), 'name' => 'feed_form_privacy_color', 'type' => 'text', 'default_value' => 'text-slate-400', 'instructions' => __('Tailwind class', 'mlzs')),
            array('key' => 'field_feed_tab_stats', 'label' => __('Alumni Stats', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_feed_stats', 'label' => __('Stats (number + label)', 'mlzs'), 'name' => 'feed_stats', 'type' => 'repeater', 'min' => 0, 'max' => 6, 'layout' => 'table', 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_feed_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_feed_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
                array('key' => 'field_feed_stat_number_color', 'label' => __('Number Color Class', 'mlzs'), 'name' => 'number_color', 'type' => 'text', 'default_value' => '', 'instructions' => __('e.g. text-primary, text-accent, text-primary-light, text-accent-dark. Blank = default by position.', 'mlzs')),
                array('key' => 'field_feed_stat_label_color', 'label' => __('Label Color Class', 'mlzs'), 'name' => 'label_color', 'type' => 'text', 'default_value' => '', 'instructions' => __('e.g. text-text-secondary-light. Blank = default.', 'mlzs')),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'feed.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_feed_field_group');

/**
 * ACF Pro: Gallery Page – Hero, Photo Gallery (masonry)
 */
function mlzs_acf_gallery_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_gallery',
        'title'                 => __('Gallery Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_gal_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_gal_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'gallery_hero_badge', 'type' => 'text', 'default_value' => 'Memories'),
            array('key' => 'field_gal_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'gallery_hero_icon', 'type' => 'text', 'default_value' => 'images'),
            array('key' => 'field_gal_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'gallery_hero_headline', 'type' => 'text', 'default_value' => 'Photo'),
            array('key' => 'field_gal_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'gallery_hero_highlight', 'type' => 'text', 'default_value' => 'Gallery'),
            array('key' => 'field_gal_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'gallery_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Capturing moments of excellence, creativity, and achievement at Mount Litera Zee School'),
            array('key' => 'field_gal_tab_gallery', 'label' => __('Photo Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_gal_images', 'label' => __('Gallery Images', 'mlzs'), 'name' => 'gallery_images', 'type' => 'gallery', 'return_format' => 'id', 'preview_size' => 'medium', 'library' => 'all', 'min' => 0, 'max' => 0, 'instructions' => __('Add images for the masonry gallery. Order is preserved.')),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'gallery.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_gallery_field_group');

/**
 * ACF Pro: Life at a Glance Page – Hero, Intro row, Second row, Key Highlights, Quote, CTA
 */
function mlzs_acf_glance_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_glance',
        'title'                 => __('Life at a Glance Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_glance_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'glance_hero_badge', 'type' => 'text', 'default_value' => 'School Life'),
            array('key' => 'field_glance_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'glance_hero_icon', 'type' => 'text', 'default_value' => 'eye'),
            array('key' => 'field_glance_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'glance_hero_headline', 'type' => 'text', 'default_value' => 'Life at Mount Litera'),
            array('key' => 'field_glance_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'glance_hero_highlight', 'type' => 'text', 'default_value' => 'Glance'),
            array('key' => 'field_glance_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'glance_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A glimpse into the vibrant, enriching, and transformative educational journey at our institution.'),
            array('key' => 'field_glance_tab_row1', 'label' => __('First Row (Intro)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_student_icon', 'label' => __('Student Culture – Icon', 'mlzs'), 'name' => 'glance_student_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_glance_student_title', 'label' => __('Student Culture – Title', 'mlzs'), 'name' => 'glance_student_title', 'type' => 'text', 'default_value' => 'Student Culture'),
            array('key' => 'field_glance_student_content', 'label' => __('Student Culture – Content', 'mlzs'), 'name' => 'glance_student_content', 'type' => 'wysiwyg', 'default_value' => 'Students set the tone for our school. They are passionate, principled committed, persistent and trained to excel. They share a desire to challenge themselves.<br><br>By cultivating qualities such as analytical reasoning, self criticism and intellectual honesty. A culture of critical thinking and risk taking is developed wherein everything and everyone is open to being challenged and questioned.'),
            array('key' => 'field_glance_center_image', 'label' => __('Center – Image', 'mlzs'), 'name' => 'glance_center_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_glance_center_caption', 'label' => __('Center – Caption', 'mlzs'), 'name' => 'glance_center_caption', 'type' => 'text', 'default_value' => 'Vibrant Campus Life'),
            array('key' => 'field_glance_academic_icon', 'label' => __('Academic Excellence – Icon', 'mlzs'), 'name' => 'glance_academic_icon', 'type' => 'text', 'default_value' => 'award'),
            array('key' => 'field_glance_academic_title', 'label' => __('Academic Excellence – Title', 'mlzs'), 'name' => 'glance_academic_title', 'type' => 'text', 'default_value' => 'Academic Excellence'),
            array('key' => 'field_glance_academic_content', 'label' => __('Academic Excellence – Content', 'mlzs'), 'name' => 'glance_academic_content', 'type' => 'wysiwyg', 'default_value' => 'Their passion to succeed promotes a stimulating intellectual climate which help pursue excellence.<br><br>Apart from regular courses, our institutions offer examinations* in various subjects in collaboration with the University of Cambridge and offers subjects like Environmental Studies, Sustainable development programmes, Psychology etc. which enhance the skills to the optimum level.'),
            array('key' => 'field_glance_academic_note', 'label' => __('Academic Excellence – Footnote', 'mlzs'), 'name' => 'glance_academic_note', 'type' => 'text', 'default_value' => '*Subject to availability and student eligibility'),
            array('key' => 'field_glance_tab_row2', 'label' => __('Second Row', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_talents_icon', 'label' => __('Developing Talents – Icon', 'mlzs'), 'name' => 'glance_talents_icon', 'type' => 'text', 'default_value' => 'music'),
            array('key' => 'field_glance_talents_title', 'label' => __('Developing Talents – Title', 'mlzs'), 'name' => 'glance_talents_title', 'type' => 'text', 'default_value' => 'Developing Talents'),
            array('key' => 'field_glance_talents_content', 'label' => __('Developing Talents – Content', 'mlzs'), 'name' => 'glance_talents_content', 'type' => 'wysiwyg', 'default_value' => 'Theatre has been the backbone for improving the Standards of "Learning and Imparting meaningful Education through an experience" where the expressions of daily life are exhibited under the guidance of Professionals.<br><br>We invite the students to pursue higher education in music and theatre by streamlining the process for training under "master". We encourage every student to take part in Music, Theater and Dance be it Indian, Western, Classical or Popular.<br><br>It is our policy to support Choirs, Bands and present an Orchestra of Concert level.'),
            array('key' => 'field_glance_leadership_icon', 'label' => __('Leadership – Icon', 'mlzs'), 'name' => 'glance_leadership_icon', 'type' => 'text', 'default_value' => 'target'),
            array('key' => 'field_glance_leadership_title', 'label' => __('Leadership – Title', 'mlzs'), 'name' => 'glance_leadership_title', 'type' => 'text', 'default_value' => 'Leadership'),
            array('key' => 'field_glance_leadership_content', 'label' => __('Leadership – Content', 'mlzs'), 'name' => 'glance_leadership_content', 'type' => 'wysiwyg', 'default_value' => 'Learning is an essential part of our life. What carries us through life is our ability to grow, to discover new possibilities in ourselves and the world.<br><br>Our students will not shirk from the unknown fear, but embrace change with a consummate faith in the deepest principles of existence.<br><br>Living on the edge, leading from the edge, they respond to uncertainty by joyously seeking their balance in dynamic interaction with the challenges of life.'),
            array('key' => 'field_glance_life_image', 'label' => __('Life at School – Image', 'mlzs'), 'name' => 'glance_life_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_glance_life_title', 'label' => __('Life at School – Title', 'mlzs'), 'name' => 'glance_life_title', 'type' => 'text', 'default_value' => 'Life at Mount Litera'),
            array('key' => 'field_glance_life_subtitle', 'label' => __('Life at School – Subtitle', 'mlzs'), 'name' => 'glance_life_subtitle', 'type' => 'text', 'default_value' => 'Moments that define the Mount Litera experience'),
            array('key' => 'field_glance_life_icon', 'label' => __('Life at School – Badge Icon', 'mlzs'), 'name' => 'glance_life_icon', 'type' => 'text', 'default_value' => 'image'),
            array('key' => 'field_glance_tab_highlights', 'label' => __('Key Highlights', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_hl_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'glance_hl_badge', 'type' => 'text', 'default_value' => 'Key Highlights'),
            array('key' => 'field_glance_hl_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'glance_hl_icon', 'type' => 'text', 'default_value' => 'star'),
            array('key' => 'field_glance_hl_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'glance_hl_heading', 'type' => 'text', 'default_value' => 'What Makes Us'),
            array('key' => 'field_glance_hl_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'glance_hl_highlight', 'type' => 'text', 'default_value' => 'Different'),
            array('key' => 'field_glance_hl_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'glance_hl_subtext', 'type' => 'text', 'default_value' => 'Our approach to education goes beyond academics to shape well-rounded individuals'),
            array('key' => 'field_glance_hl_cards', 'label' => __('Highlight Cards', 'mlzs'), 'name' => 'glance_hl_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_glance_hl_card_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_glance_hl_card_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_glance_hl_card_desc', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
                array('key' => 'field_glance_hl_card_style', 'label' => __('Card colour', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => __('Primary', 'mlzs'), 'accent' => __('Accent', 'mlzs'), 'primary-light' => __('Primary Light', 'mlzs'), 'accent-dark' => __('Accent Dark', 'mlzs')), 'default_value' => 'primary'),
            )),
            array('key' => 'field_glance_tab_quote', 'label' => __('Quote Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_quote_text', 'label' => __('Quote Text', 'mlzs'), 'name' => 'glance_quote_text', 'type' => 'textarea', 'rows' => 3, 'default_value' => '"Living on the edge, leading from the edge, they respond to uncertainty by joyously seeking their balance in dynamic interaction with the challenges of life."'),
            array('key' => 'field_glance_quote_author', 'label' => __('Author Name', 'mlzs'), 'name' => 'glance_quote_author', 'type' => 'text', 'default_value' => 'Mount Litera Philosophy'),
            array('key' => 'field_glance_quote_title', 'label' => __('Author Title/Subtitle', 'mlzs'), 'name' => 'glance_quote_title', 'type' => 'text', 'default_value' => 'Our approach to leadership and personal growth'),
            array('key' => 'field_glance_tab_cta', 'label' => __('Call to Action', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_glance_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'glance_cta_heading', 'type' => 'text', 'default_value' => 'Experience the Mount Litera Difference'),
            array('key' => 'field_glance_cta_text', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'glance_cta_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Join our community of passionate learners, thinkers, and leaders shaping the future.'),
            array('key' => 'field_glance_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'glance_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_glance_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'glance_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein URL ke saath "Link Text" bhar den – wahi button par dikhega.', 'mlzs')),
            array('key' => 'field_glance_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'glance_cta_btn2_icon', 'type' => 'text', 'default_value' => 'download'),
            array('key' => 'field_glance_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'glance_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein URL ke saath "Link Text" bhar den – wahi button par dikhega.', 'mlzs')),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'glance.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_glance_field_group');

/**
 * ACF Pro: House System Page – Hero, Intro, 4 Houses (Blue/Green/Red/Ochre), Points & Achievements
 */
function mlzs_acf_house_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_house',
        'title'                 => __('House System Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_house_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_house_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'house_hero_badge', 'type' => 'text', 'default_value' => 'School Life'),
            array('key' => 'field_house_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'house_hero_icon', 'type' => 'text', 'default_value' => 'home'),
            array('key' => 'field_house_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'house_hero_headline', 'type' => 'text', 'default_value' => 'House'),
            array('key' => 'field_house_hero_highlight', 'label' => __('Headline (highlighted word)', 'mlzs'), 'name' => 'house_hero_highlight', 'type' => 'text', 'default_value' => 'System'),
            array('key' => 'field_house_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'house_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Fostering leadership, teamwork, and healthy competition through our four-house system, each named after legendary individuals who shaped history.'),
            array('key' => 'field_house_hero_pills', 'label' => __('House Pills (Hero)', 'mlzs'), 'name' => 'house_hero_pills', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Pill', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_house_pill_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Blue House'),
                array('key' => 'field_house_pill_dot', 'label' => __('Dot Color (Tailwind)', 'mlzs'), 'name' => 'dot_color', 'type' => 'text', 'default_value' => 'bg-blue-500', 'instructions' => 'e.g. bg-blue-500, bg-green-500, bg-red-500, bg-yellow-500'),
            )),
            array('key' => 'field_house_tab_intro', 'label' => __('Introduction Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_house_intro_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'house_intro_badge', 'type' => 'text', 'default_value' => 'Our Philosophy'),
            array('key' => 'field_house_intro_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'house_intro_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_house_intro_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'house_intro_heading', 'type' => 'text', 'default_value' => 'Building Character Through'),
            array('key' => 'field_house_intro_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'house_intro_highlight', 'type' => 'text', 'default_value' => 'Healthy Competition'),
            array('key' => 'field_house_intro_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'house_intro_para1', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'All students in the school are divided into four Houses, named after individuals who contributed to a larger cause. They were rational thinkers whose actions were driven by reason rather than assumption. They were ethical and sensitive human beings who were not afraid to do what was right.'),
            array('key' => 'field_house_intro_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'house_intro_para2', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Each house represents a different field - science, arts, philosophy, or exploration - allowing every student to realize their unique potential, bring about positive changes, and build a harmonious society.'),
            array('key' => 'field_house_intro_image', 'label' => __('Right Image', 'mlzs'), 'name' => 'house_intro_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_house_intro_overlay_icon', 'label' => __('Overlay Icon', 'mlzs'), 'name' => 'house_intro_overlay_icon', 'type' => 'text', 'default_value' => 'award'),
            array('key' => 'field_house_intro_overlay_title', 'label' => __('Overlay Title', 'mlzs'), 'name' => 'house_intro_overlay_title', 'type' => 'text', 'default_value' => 'Inter-House Competitions'),
            array('key' => 'field_house_intro_overlay_subtitle', 'label' => __('Overlay Subtitle', 'mlzs'), 'name' => 'house_intro_overlay_subtitle', 'type' => 'text', 'default_value' => 'Sports • Arts • Academics • Leadership'),
            array('key' => 'field_house_tab_blocks', 'label' => __('House Blocks (4 Houses)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_house_blocks', 'label' => __('Houses', 'mlzs'), 'name' => 'house_blocks', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add House', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_house_block_name', 'label' => __('House Name', 'mlzs'), 'name' => 'name', 'type' => 'text', 'default_value' => 'Blue House'),
                array('key' => 'field_house_block_color', 'label' => __('Color Theme', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'green' => 'Green', 'red' => 'Red', 'yellow' => 'Yellow'), 'default_value' => 'blue'),
                array('key' => 'field_house_block_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_house_block_card_icon', 'label' => __('Card Icon (on image)', 'mlzs'), 'name' => 'card_icon', 'type' => 'text', 'default_value' => 'compass'),
                array('key' => 'field_house_block_card_subtitle', 'label' => __('Card Subtitle (on image)', 'mlzs'), 'name' => 'card_subtitle', 'type' => 'text', 'default_value' => 'Exploration & Discovery'),
                array('key' => 'field_house_block_badge_icon', 'label' => __('Content Badge Icon', 'mlzs'), 'name' => 'badge_icon', 'type' => 'text', 'default_value' => 'navigation'),
                array('key' => 'field_house_block_badge_text', 'label' => __('Namesake (badge)', 'mlzs'), 'name' => 'badge_text', 'type' => 'text', 'default_value' => 'Christopher Columbus'),
                array('key' => 'field_house_block_heading', 'label' => __('Heading with dates', 'mlzs'), 'name' => 'heading', 'type' => 'text', 'default_value' => 'Christopher Columbus (1451-1506)'),
                array('key' => 'field_house_block_content', 'label' => __('Content (paragraphs)', 'mlzs'), 'name' => 'content', 'type' => 'wysiwyg'),
                array('key' => 'field_house_block_values', 'label' => __('House Values (tags)', 'mlzs'), 'name' => 'values', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Value', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_house_block_value_label', 'label' => __('Value', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Courage'),
                )),
                array('key' => 'field_house_block_image_order', 'label' => __('Image Position', 'mlzs'), 'name' => 'image_position', 'type' => 'select', 'choices' => array('left' => 'Left', 'right' => 'Right'), 'default_value' => 'left'),
            )),
            array('key' => 'field_house_tab_points', 'label' => __('Points & Achievements', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_house_points_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'house_points_badge', 'type' => 'text', 'default_value' => 'Current Standings'),
            array('key' => 'field_house_points_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'house_points_icon', 'type' => 'text', 'default_value' => 'trophy'),
            array('key' => 'field_house_points_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'house_points_heading', 'type' => 'text', 'default_value' => 'House'),
            array('key' => 'field_house_points_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'house_points_highlight', 'type' => 'text', 'default_value' => 'Points & Achievements'),
            array('key' => 'field_house_points_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'house_points_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Track the ongoing competition between houses through various academic, sports, and cultural events'),
            array('key' => 'field_house_points_cards', 'label' => __('Points Cards (4)', 'mlzs'), 'name' => 'house_points_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_house_points_card_name', 'label' => __('House Name', 'mlzs'), 'name' => 'house_name', 'type' => 'text', 'default_value' => 'Blue House'),
                array('key' => 'field_house_points_card_namesake', 'label' => __('Namesake', 'mlzs'), 'name' => 'namesake', 'type' => 'text', 'default_value' => 'Christopher Columbus'),
                array('key' => 'field_house_points_card_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'compass'),
                array('key' => 'field_house_points_card_color', 'label' => __('Color Theme', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'green' => 'Green', 'red' => 'Red', 'yellow' => 'Yellow'), 'default_value' => 'blue'),
                array('key' => 'field_house_points_card_total', 'label' => __('Total Points', 'mlzs'), 'name' => 'total_points', 'type' => 'text', 'default_value' => '1,250'),
                array('key' => 'field_house_points_card_academic', 'label' => __('Academic Events', 'mlzs'), 'name' => 'academic', 'type' => 'text', 'default_value' => '420'),
                array('key' => 'field_house_points_card_sports', 'label' => __('Sports Events', 'mlzs'), 'name' => 'sports', 'type' => 'text', 'default_value' => '380'),
                array('key' => 'field_house_points_card_cultural', 'label' => __('Cultural Events', 'mlzs'), 'name' => 'cultural', 'type' => 'text', 'default_value' => '450'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'house.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_house_field_group');

/**
 * ACF Pro: Infirmary Page – Hero, Wellness Philosophy, Features, Hygiene, Gallery, CTA
 */
function mlzs_acf_infirmary_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_infirmary',
        'title'                 => __('Infirmary Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_inf_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'infirmary_hero_badge', 'type' => 'text', 'default_value' => 'Health & Wellness'),
            array('key' => 'field_inf_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'infirmary_hero_icon', 'type' => 'text', 'default_value' => 'heart-pulse'),
            array('key' => 'field_inf_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'infirmary_hero_headline', 'type' => 'text', 'default_value' => 'School'),
            array('key' => 'field_inf_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'infirmary_hero_highlight', 'type' => 'text', 'default_value' => 'Infirmary'),
            array('key' => 'field_inf_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'infirmary_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Dedicated healthcare facility ensuring the well-being of every learner during school hours'),
            array('key' => 'field_inf_tab_wellness', 'label' => __('Wellness Philosophy', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_wellness_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'infirmary_wellness_icon', 'type' => 'text', 'default_value' => 'heart'),
            array('key' => 'field_inf_wellness_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'infirmary_wellness_heading', 'type' => 'text', 'default_value' => 'Our Commitment to'),
            array('key' => 'field_inf_wellness_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'infirmary_wellness_highlight', 'type' => 'text', 'default_value' => 'Well-being'),
            array('key' => 'field_inf_wellness_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'infirmary_wellness_para1', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'At Mount Litera Zee School Alwar, the well-being of learners is of great importance to us. We provide direct nursing services to learners and staff members to maximize health and wellness in the school community.'),
            array('key' => 'field_inf_wellness_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'infirmary_wellness_para2', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'We understand that as the children spend most of their time in school, we could be faced with emergencies pertaining to the health of our students. Minor injuries during sports and games or while performing experiments and even common fever are unavoidable parts of growing.'),
            array('key' => 'field_inf_wellness_image', 'label' => __('Right Image', 'mlzs'), 'name' => 'infirmary_wellness_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_inf_wellness_badge_title', 'label' => __('Image Badge Title', 'mlzs'), 'name' => 'infirmary_wellness_badge_title', 'type' => 'text', 'default_value' => 'Ready'),
            array('key' => 'field_inf_wellness_badge_subtitle', 'label' => __('Image Badge Subtitle', 'mlzs'), 'name' => 'infirmary_wellness_badge_subtitle', 'type' => 'text', 'default_value' => 'For Emergencies'),
            array('key' => 'field_inf_tab_features', 'label' => __('Infirmary Features', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_features_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'infirmary_features_heading', 'type' => 'text', 'default_value' => 'Fully Equipped'),
            array('key' => 'field_inf_features_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'infirmary_features_highlight', 'type' => 'text', 'default_value' => 'Infirmary'),
            array('key' => 'field_inf_features_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'infirmary_features_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Strategically located at the heart of the school premise to provide immediate medical attention'),
            array('key' => 'field_inf_features_center_icon', 'label' => __('Center Card Icon', 'mlzs'), 'name' => 'infirmary_features_center_icon', 'type' => 'text', 'default_value' => 'shield-check'),
            array('key' => 'field_inf_features_center_title', 'label' => __('Center Card Title', 'mlzs'), 'name' => 'infirmary_features_center_title', 'type' => 'text', 'default_value' => 'Emergency Preparedness'),
            array('key' => 'field_inf_features_center_para', 'label' => __('Center Card Paragraph', 'mlzs'), 'name' => 'infirmary_features_center_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'To meet these emergencies we have an Infirmary at the heart of the School premise. The school infirmary is equipped with the basic materials and facilities to address the health needs of learners while in school.'),
            array('key' => 'field_inf_features_checklist', 'label' => __('Center Card Checklist', 'mlzs'), 'name' => 'infirmary_features_checklist', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_inf_check_item', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'First Aid Supplies'),
                array('key' => 'field_inf_check_icon_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_inf_features_nurse_icon', 'label' => __('Qualified Nurse Card – Icon', 'mlzs'), 'name' => 'infirmary_features_nurse_icon', 'type' => 'text', 'default_value' => 'user-check'),
            array('key' => 'field_inf_features_nurse_title', 'label' => __('Qualified Nurse Card – Title', 'mlzs'), 'name' => 'infirmary_features_nurse_title', 'type' => 'text', 'default_value' => 'Qualified Nurse'),
            array('key' => 'field_inf_features_nurse_para', 'label' => __('Qualified Nurse Card – Paragraph', 'mlzs'), 'name' => 'infirmary_features_nurse_para', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'An on-site trained and qualified nurse is available to manage and assess any health issues that may arise during school hours.'),
            array('key' => 'field_inf_features_capacity_icon', 'label' => __('Capacity Card – Icon', 'mlzs'), 'name' => 'infirmary_features_capacity_icon', 'type' => 'text', 'default_value' => 'bed'),
            array('key' => 'field_inf_features_capacity_title', 'label' => __('Capacity Card – Title', 'mlzs'), 'name' => 'infirmary_features_capacity_title', 'type' => 'text', 'default_value' => 'Four-Bed Capacity'),
            array('key' => 'field_inf_features_capacity_para', 'label' => __('Capacity Card – Paragraph', 'mlzs'), 'name' => 'infirmary_features_capacity_para', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'With a four bed capacity, the infirmary provides ample space for students requiring medical attention and rest.'),
            array('key' => 'field_inf_tab_hygiene', 'label' => __('Hygiene & Wellness', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_hygiene_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'infirmary_hygiene_icon', 'type' => 'text', 'default_value' => 'sparkles'),
            array('key' => 'field_inf_hygiene_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'infirmary_hygiene_heading', 'type' => 'text', 'default_value' => 'Hygienic Excellence'),
            array('key' => 'field_inf_hygiene_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'infirmary_hygiene_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'The infirmary is hygienically maintained confirming to our belief of wellness of mind, body and soul. We follow strict sanitation protocols to ensure a clean and safe environment for all students.'),
            array('key' => 'field_inf_hygiene_tags', 'label' => __('Tags (e.g. Daily Sanitization)', 'mlzs'), 'name' => 'infirmary_hygiene_tags', 'type' => 'repeater', 'layout' => 'table', 'button_label' => __('Add Tag', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_inf_hygiene_tag_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Daily Sanitization'),
            )),
            array('key' => 'field_inf_hygiene_stats', 'label' => __('Stat Boxes (4)', 'mlzs'), 'name' => 'infirmary_hygiene_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_inf_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '24/7'),
                array('key' => 'field_inf_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Medical Support'),
                array('key' => 'field_inf_stat_color', 'label' => __('Text Color', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_inf_tab_gallery', 'label' => __('Medical Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_gallery_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'infirmary_gallery_heading', 'type' => 'text', 'default_value' => 'Infirmary'),
            array('key' => 'field_inf_gallery_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'infirmary_gallery_highlight', 'type' => 'text', 'default_value' => 'Facilities'),
            array('key' => 'field_inf_gallery_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'infirmary_gallery_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Modern medical facilities designed specifically for school healthcare needs'),
            array('key' => 'field_inf_gallery_items', 'label' => __('Gallery Items (2)', 'mlzs'), 'name' => 'infirmary_gallery_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 2, 'max' => 2, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_inf_gallery_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_inf_gallery_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Medical Equipment'),
                array('key' => 'field_inf_gallery_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Fully stocked with essential medical supplies'),
                array('key' => 'field_inf_gallery_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'badge', 'type' => 'text', 'default_value' => 'Equipment'),
                array('key' => 'field_inf_gallery_gradient', 'label' => __('Overlay Gradient', 'mlzs'), 'name' => 'gradient', 'type' => 'select', 'choices' => array('primary' => 'from-primary/50', 'primary-light' => 'from-primary-light/50'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_inf_tab_cta', 'label' => __('Health Protocol CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_inf_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'infirmary_cta_heading', 'type' => 'text', 'default_value' => 'Health & Safety Protocols'),
            array('key' => 'field_inf_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'infirmary_cta_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Parents are notified immediately in case of any medical emergency. We maintain detailed health records and follow strict protocols for medication administration.'),
            array('key' => 'field_inf_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'infirmary_cta_btn1_icon', 'type' => 'text', 'default_value' => 'file-text'),
            array('key' => 'field_inf_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'infirmary_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein URL ke saath "Link Text" bhar den – wahi button par dikhega.', 'mlzs')),
            array('key' => 'field_inf_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'infirmary_cta_btn2_icon', 'type' => 'text', 'default_value' => 'phone'),
            array('key' => 'field_inf_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'infirmary_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein URL ke saath "Link Text" bhar den – wahi button par dikhega.', 'mlzs')),
            array('key' => 'field_inf_cta_boxes', 'label' => __('CTA Stat Boxes (4)', 'mlzs'), 'name' => 'infirmary_cta_boxes', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Box', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_inf_cta_box_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Immediate'),
                array('key' => 'field_inf_cta_box_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Response Time'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'infirmary.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_infirmary_field_group');

/**
 * ACF Pro: Lab Page – Hero, Intro, Computer/Science Labs, Quick Labs (3), Specialty Labs (3), Features (3), CTA
 */
function mlzs_acf_lab_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_lab',
        'title'                 => __('Lab Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_lab_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'lab_hero_badge', 'type' => 'text', 'default_value' => 'Science & Technology'),
            array('key' => 'field_lab_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'lab_hero_icon', 'type' => 'text', 'default_value' => 'flask-conical'),
            array('key' => 'field_lab_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'lab_hero_headline', 'type' => 'text', 'default_value' => 'State-of-the-Art'),
            array('key' => 'field_lab_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'lab_hero_highlight', 'type' => 'text', 'default_value' => 'Laboratories'),
            array('key' => 'field_lab_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'lab_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Equipped with cutting-edge technology and modern facilities, our laboratories provide hands-on learning experiences that foster scientific curiosity and innovation.'),
            array('key' => 'field_lab_hero_buttons', 'label' => __('Hero Buttons (2)', 'mlzs'), 'name' => 'lab_hero_buttons', 'type' => 'repeater', 'layout' => 'row', 'min' => 2, 'max' => 2, 'button_label' => __('Add Button', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lab_hero_btn_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'cpu'),
                array('key' => 'field_lab_hero_btn_link', 'label' => __('Link', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein URL (ya #section-id) aur "Link Text" bhar den – wahi button par dikhega. Target bhi set kar sakte hain.', 'mlzs')),
                array('key' => 'field_lab_hero_btn_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('blue' => 'Blue (Computer)', 'green' => 'Green (Science)'), 'default_value' => 'blue'),
            )),
            array('key' => 'field_lab_tab_intro', 'label' => __('Introduction Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_intro_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'lab_intro_badge', 'type' => 'text', 'default_value' => 'Excellence'),
            array('key' => 'field_lab_intro_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'lab_intro_icon', 'type' => 'text', 'default_value' => 'award'),
            array('key' => 'field_lab_intro_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'lab_intro_heading', 'type' => 'text', 'default_value' => 'Among the Best CBSE Schools in Alwar'),
            array('key' => 'field_lab_intro_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'lab_intro_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Labs of Mount Litera Zee School provide all facilities as per the latest technology improvement, ensuring students get practical exposure to complement theoretical knowledge.'),
            array('key' => 'field_lab_tab_main', 'label' => __('Computer & Science Labs', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_computer_image', 'label' => __('Computer Lab – Image', 'mlzs'), 'name' => 'lab_computer_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_lab_computer_title', 'label' => __('Computer Lab – Title', 'mlzs'), 'name' => 'lab_computer_title', 'type' => 'text', 'default_value' => 'Computer Labs'),
            array('key' => 'field_lab_computer_para1', 'label' => __('Computer Lab – Paragraph 1', 'mlzs'), 'name' => 'lab_computer_para1', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our well established new technology computer labs surely meet the requirement of the students. As the time changes, technology is playing a vital role in the present world.'),
            array('key' => 'field_lab_computer_para2', 'label' => __('Computer Lab – Paragraph 2', 'mlzs'), 'name' => 'lab_computer_para2', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Browsing for new topics and gaining depth knowledge makes the students occupy the top positions in their academic and professional pursuits.'),
            array('key' => 'field_lab_science_image', 'label' => __('Science Lab – Image', 'mlzs'), 'name' => 'lab_science_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_lab_science_title', 'label' => __('Science Lab – Title', 'mlzs'), 'name' => 'lab_science_title', 'type' => 'text', 'default_value' => 'Composite Science Labs'),
            array('key' => 'field_lab_science_para1', 'label' => __('Science Lab – Paragraph 1', 'mlzs'), 'name' => 'lab_science_para1', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'All the labs for Physics, Chemistry, and Life Sciences are equipped with the latest material to fulfill the needs of the students.'),
            array('key' => 'field_lab_science_para2', 'label' => __('Science Lab – Paragraph 2', 'mlzs'), 'name' => 'lab_science_para2', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'The full-fledged labs provide good hands-on experience for all the students, allowing them to explore scientific concepts through practical experimentation.'),
            array('key' => 'field_lab_tab_quick', 'label' => __('Quick Labs (3 cards)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_quick_cards', 'label' => __('Quick Labs Cards', 'mlzs'), 'name' => 'lab_quick_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lab_quick_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_lab_quick_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Math Labs'),
                array('key' => 'field_lab_quick_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_lab_quick_footer', 'label' => __('Footer Label', 'mlzs'), 'name' => 'footer_label', 'type' => 'text', 'default_value' => 'Interactive Learning'),
            )),
            array('key' => 'field_lab_tab_specialty', 'label' => __('Specialty Labs (3)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_specialty_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'lab_specialty_badge', 'type' => 'text', 'default_value' => 'Specialty Labs'),
            array('key' => 'field_lab_specialty_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'lab_specialty_icon', 'type' => 'text', 'default_value' => 'beaker'),
            array('key' => 'field_lab_specialty_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'lab_specialty_heading', 'type' => 'text', 'default_value' => 'Specialized'),
            array('key' => 'field_lab_specialty_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'lab_specialty_highlight', 'type' => 'text', 'default_value' => 'Laboratory Facilities'),
            array('key' => 'field_lab_specialty_cards', 'label' => __('Specialty Cards (3)', 'mlzs'), 'name' => 'lab_specialty_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lab_spec_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_lab_spec_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Chemistry Lab'),
                array('key' => 'field_lab_spec_subtitle', 'label' => __('Subtitle or Paragraph', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Advanced Equipment', 'instructions' => 'Short tag (e.g. Advanced Equipment) or leave empty and use paragraph'),
                array('key' => 'field_lab_spec_para', 'label' => __('Paragraph (optional, for Robotic etc)', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_lab_tab_features', 'label' => __('Key Features (3)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_features_badge', 'label' => __('Section Badge', 'mlzs'), 'name' => 'lab_features_badge', 'type' => 'text', 'default_value' => 'Key Features'),
            array('key' => 'field_lab_features_icon', 'label' => __('Section Badge Icon', 'mlzs'), 'name' => 'lab_features_icon', 'type' => 'text', 'default_value' => 'check-circle'),
            array('key' => 'field_lab_features_heading', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'lab_features_heading', 'type' => 'text', 'default_value' => 'What Makes Our Labs'),
            array('key' => 'field_lab_features_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'lab_features_highlight', 'type' => 'text', 'default_value' => 'Exceptional'),
            array('key' => 'field_lab_features_items', 'label' => __('Feature Items (3)', 'mlzs'), 'name' => 'lab_features_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lab_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'cpu'),
                array('key' => 'field_lab_feat_color', 'label' => __('Color', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('blue' => 'Blue', 'green' => 'Green', 'purple' => 'Purple'), 'default_value' => 'blue'),
                array('key' => 'field_lab_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Latest Technology'),
                array('key' => 'field_lab_feat_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_lab_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lab_cta_icon', 'label' => __('CTA Icon', 'mlzs'), 'name' => 'lab_cta_icon', 'type' => 'text', 'default_value' => 'microscope'),
            array('key' => 'field_lab_cta_heading', 'label' => __('CTA Heading (before highlight)', 'mlzs'), 'name' => 'lab_cta_heading', 'type' => 'text', 'default_value' => 'Explore Our'),
            array('key' => 'field_lab_cta_highlight', 'label' => __('CTA Heading (highlighted)', 'mlzs'), 'name' => 'lab_cta_highlight', 'type' => 'text', 'default_value' => 'Laboratories'),
            array('key' => 'field_lab_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'lab_cta_para', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Experience firsthand how our state-of-the-art laboratories foster scientific curiosity and innovation among students.'),
            array('key' => 'field_lab_cta_btn_icon', 'label' => __('Button Icon', 'mlzs'), 'name' => 'lab_cta_btn_icon', 'type' => 'text', 'default_value' => 'image'),
            array('key' => 'field_lab_cta_btn_link', 'label' => __('Button Link', 'mlzs'), 'name' => 'lab_cta_btn_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein "Link Text" = button label (e.g. View Gallery).', 'mlzs')),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'lab.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_lab_field_group');

/**
 * ACF Pro: Library Page – Hero, Overview, Features (6), Gallery (3), CTA (buttons = Link field)
 * Note: Image alt = use attachment alt from Media Library (upload time); do not add separate ACF alt field.
 */
function mlzs_acf_library_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_library',
        'title'                 => __('Library Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_lib_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lib_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'library_hero_badge', 'type' => 'text', 'default_value' => 'Campus Facilities'),
            array('key' => 'field_lib_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'library_hero_icon', 'type' => 'text', 'default_value' => 'book-open'),
            array('key' => 'field_lib_hero_headline', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'library_hero_headline', 'type' => 'text', 'default_value' => 'School'),
            array('key' => 'field_lib_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'library_hero_highlight', 'type' => 'text', 'default_value' => 'Library'),
            array('key' => 'field_lib_hero_subheadline', 'label' => __('Subheadline', 'mlzs'), 'name' => 'library_hero_subheadline', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A 1000 SQ FT learning resource center fostering lifelong learning abilities and nurturing the love for reading'),
            array('key' => 'field_lib_tab_overview', 'label' => __('Library Overview', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lib_overview_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'library_overview_badge', 'type' => 'text', 'default_value' => 'Learning Resource Center'),
            array('key' => 'field_lib_overview_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'library_overview_heading', 'type' => 'text', 'default_value' => 'More Than Just Books'),
            array('key' => 'field_lib_overview_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'library_overview_para1', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'The 1000 SQ FT school library is a learning resource center in the widest sense as it houses information resources, expansive reading material, and digital data with internet access. The school library fosters the development of life-long learning abilities and inculcates love for reading in students.'),
            array('key' => 'field_lib_overview_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'library_overview_para2', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'It also provides teachers with instructional material and professional resources, creating a comprehensive ecosystem for academic excellence.'),
            array('key' => 'field_lib_overview_image', 'label' => __('Right Image', 'mlzs'), 'name' => 'library_overview_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_lib_overview_stat_number', 'label' => __('Stat Box Number', 'mlzs'), 'name' => 'library_overview_stat_number', 'type' => 'text', 'default_value' => '1000'),
            array('key' => 'field_lib_overview_stat_label', 'label' => __('Stat Box Label', 'mlzs'), 'name' => 'library_overview_stat_label', 'type' => 'text', 'default_value' => 'SQ FT Area'),
            array('key' => 'field_lib_tab_features', 'label' => __('Salient Features (6)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lib_features_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'library_features_heading', 'type' => 'text', 'default_value' => 'Salient'),
            array('key' => 'field_lib_features_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'library_features_highlight', 'type' => 'text', 'default_value' => 'Features'),
            array('key' => 'field_lib_features_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'library_features_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our library is equipped with state-of-the-art facilities to enhance the learning experience'),
            array('key' => 'field_lib_features_items', 'label' => __('Feature Cards (6)', 'mlzs'), 'name' => 'library_features_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 6, 'max' => 6, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lib_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'monitor'),
                array('key' => 'field_lib_feat_style', 'label' => __('Hover Border Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_lib_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'E-Library Facility'),
                array('key' => 'field_lib_feat_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_lib_tab_gallery', 'label' => __('Library Gallery (3)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lib_gallery_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'library_gallery_heading', 'type' => 'text', 'default_value' => 'Library'),
            array('key' => 'field_lib_gallery_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'library_gallery_highlight', 'type' => 'text', 'default_value' => 'Gallery'),
            array('key' => 'field_lib_gallery_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'library_gallery_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Explore our well-equipped library spaces designed for different age groups'),
            array('key' => 'field_lib_gallery_items', 'label' => __('Gallery Images (3)', 'mlzs'), 'name' => 'library_gallery_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Image', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lib_gallery_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
            )),
            array('key' => 'field_lib_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_lib_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'library_cta_heading', 'type' => 'text', 'default_value' => 'Visit Our Library'),
            array('key' => 'field_lib_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'library_cta_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Experience our state-of-the-art library facilities firsthand. Schedule a visit to explore how we foster love for reading and research among our students.'),
            array('key' => 'field_lib_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'library_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_lib_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'library_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein "Link Text" = button label (e.g. Schedule Library Tour).', 'mlzs')),
            array('key' => 'field_lib_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'library_cta_btn2_icon', 'type' => 'text', 'default_value' => 'book-open'),
            array('key' => 'field_lib_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'library_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link popup mein "Link Text" = button label (e.g. View Reading List).', 'mlzs')),
            array('key' => 'field_lib_cta_stats', 'label' => __('CTA Stat Boxes (4)', 'mlzs'), 'name' => 'library_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_lib_cta_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '5000+'),
                array('key' => 'field_lib_cta_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Books Collection'),
                array('key' => 'field_lib_cta_stat_color', 'label' => __('Text Color', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'library.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_library_field_group');

/**
 * ACF Pro: Life & Development Page – Hero (ESP cards 4), Intro, Knowledge (4), Life Skills (4), Risk (2 boxes + leader 4), CTA (Link buttons)
 * Image alt = use attachment alt from Media Library; no separate ACF alt field.
 */
function mlzs_acf_life_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_life',
        'title'                 => __('Life & Development Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_life_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'life_hero_badge', 'type' => 'text', 'default_value' => 'Emergent Student Profile'),
            array('key' => 'field_life_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'life_hero_headline', 'type' => 'text', 'default_value' => 'ESP of Child'),
            array('key' => 'field_life_hero_quote', 'label' => __('Quote', 'mlzs'), 'name' => 'life_hero_quote', 'type' => 'textarea', 'rows' => 2, 'default_value' => '"Knowledge is of no value unless you put it into practice."'),
            array('key' => 'field_life_hero_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'life_hero_paragraph', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Emergent Student Profile is our promise and our goal. Everything we do in the school strives to achieve this for each child. While each child will take a different path towards this profile, we run the school with the firm belief that it is this profile that will enable our children to be leaders of the 21st century.'),
            array('key' => 'field_life_hero_cards', 'label' => __('ESP Cards (4)', 'mlzs'), 'name' => 'life_hero_cards', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_life_hero_card_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_life_hero_card_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Knowledge'),
                array('key' => 'field_life_hero_card_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Higher order thinking & real understanding'),
            )),
            array('key' => 'field_life_tab_intro', 'label' => __('Introduction', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_intro_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'life_intro_heading_before', 'type' => 'text', 'default_value' => 'Our Philosophy:'),
            array('key' => 'field_life_intro_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'life_intro_heading_highlight', 'type' => 'text', 'default_value' => 'Child at the Center'),
            array('key' => 'field_life_intro_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'life_intro_para1', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_life_intro_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'life_intro_para2', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_life_intro_para3', 'label' => __('Paragraph 3', 'mlzs'), 'name' => 'life_intro_para3', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_life_intro_mantra_heading', 'label' => __('Mantra Card Heading', 'mlzs'), 'name' => 'life_intro_mantra_heading', 'type' => 'text', 'default_value' => 'Our Mantra'),
            array('key' => 'field_life_intro_mantra_icon', 'label' => __('Mantra Card Icon', 'mlzs'), 'name' => 'life_intro_mantra_icon', 'type' => 'text', 'default_value' => 'star'),
            array('key' => 'field_life_intro_mantra_quote', 'label' => __('Mantra Quote', 'mlzs'), 'name' => 'life_intro_mantra_quote', 'type' => 'textarea', 'rows' => 2, 'default_value' => '"This is the mantra through which we place the child at the centre of everything that we do & ensures single-minded devotion to the growth & development."'),
            array('key' => 'field_life_intro_life_skills_heading', 'label' => __('Life Skills Box Heading', 'mlzs'), 'name' => 'life_intro_life_skills_heading', 'type' => 'text', 'default_value' => 'Life Skills Education'),
            array('key' => 'field_life_intro_life_skills_para', 'label' => __('Life Skills Box Paragraph', 'mlzs'), 'name' => 'life_intro_life_skills_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Life skills education is the study of abilities for adaptive & positive behavior that enable individuals to deal effectively with the demands & the challenges of everyday life.'),
            array('key' => 'field_life_tab_knowledge', 'label' => __('Knowledge Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_knowledge_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'life_knowledge_badge', 'type' => 'text', 'default_value' => 'Pillar 01'),
            array('key' => 'field_life_knowledge_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'life_knowledge_heading', 'type' => 'text', 'default_value' => 'Knowledge Acquisition'),
            array('key' => 'field_life_knowledge_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'life_knowledge_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our students will gain comprehensive knowledge across multiple domains to become well-rounded individuals'),
            array('key' => 'field_life_knowledge_cards', 'label' => __('Cards (4)', 'mlzs'), 'name' => 'life_knowledge_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_life_know_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_life_know_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_life_know_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Higher Order Thinking Skills'),
                array('key' => 'field_life_know_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_life_know_link', 'label' => __('Card Link (optional)', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Learn More).', 'mlzs')),
                array('key' => 'field_life_know_link_icon', 'label' => __('Link Icon', 'mlzs'), 'name' => 'link_icon', 'type' => 'text', 'default_value' => 'arrow-right'),
            )),
            array('key' => 'field_life_tab_lifeskills', 'label' => __('Life Skills Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_lifeskills_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'life_lifeskills_badge', 'type' => 'text', 'default_value' => 'Pillar 02'),
            array('key' => 'field_life_lifeskills_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'life_lifeskills_heading', 'type' => 'text', 'default_value' => 'Life Skills Development'),
            array('key' => 'field_life_lifeskills_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'life_lifeskills_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our students will emerge out of school with essential life skills for success in the 21st century'),
            array('key' => 'field_life_lifeskills_items', 'label' => __('Skill Cards (4)', 'mlzs'), 'name' => 'life_lifeskills_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Skill', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_life_skill_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check-circle'),
                array('key' => 'field_life_skill_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Effective Habits'),
                array('key' => 'field_life_skill_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_life_skill_tags', 'label' => __('Tags (comma-separated)', 'mlzs'), 'name' => 'tags', 'type' => 'text', 'instructions' => __('e.g. Discipline, Time Management, Proactivity', 'mlzs')),
            )),
            array('key' => 'field_life_tab_risk', 'label' => __('Risk & Self-Management', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_risk_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'life_risk_badge', 'type' => 'text', 'default_value' => 'Pillar 03'),
            array('key' => 'field_life_risk_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'life_risk_heading', 'type' => 'text', 'default_value' => 'Risk Taking & Self-Management'),
            array('key' => 'field_life_risk_box1_title', 'label' => __('Box 1 Title', 'mlzs'), 'name' => 'life_risk_box1_title', 'type' => 'text', 'default_value' => 'The Courage to Decide'),
            array('key' => 'field_life_risk_box1_icon', 'label' => __('Box 1 Icon', 'mlzs'), 'name' => 'life_risk_box1_icon', 'type' => 'text', 'default_value' => 'shield-alert'),
            array('key' => 'field_life_risk_box1_para', 'label' => __('Box 1 Paragraph', 'mlzs'), 'name' => 'life_risk_box1_para', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_life_risk_box2_title', 'label' => __('Box 2 Title', 'mlzs'), 'name' => 'life_risk_box2_title', 'type' => 'text', 'default_value' => 'Self-Management'),
            array('key' => 'field_life_risk_box2_icon', 'label' => __('Box 2 Icon', 'mlzs'), 'name' => 'life_risk_box2_icon', 'type' => 'text', 'default_value' => 'user-cog'),
            array('key' => 'field_life_risk_box2_para', 'label' => __('Box 2 Paragraph', 'mlzs'), 'name' => 'life_risk_box2_para', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_life_risk_box2_tags', 'label' => __('Box 2 Tags (comma-separated)', 'mlzs'), 'name' => 'life_risk_box2_tags', 'type' => 'text', 'default_value' => 'Goal Setting, Self-Monitoring, Responsibility'),
            array('key' => 'field_life_risk_leader_title', 'label' => __('Leader Card Title', 'mlzs'), 'name' => 'life_risk_leader_title', 'type' => 'text', 'default_value' => 'The 21st Century Leader'),
            array('key' => 'field_life_risk_leader_icon', 'label' => __('Leader Card Header Icon', 'mlzs'), 'name' => 'life_risk_leader_icon', 'type' => 'text', 'default_value' => 'target'),
            array('key' => 'field_life_risk_leader_subtitle', 'label' => __('Leader Card Subtitle', 'mlzs'), 'name' => 'life_risk_leader_subtitle', 'type' => 'text', 'default_value' => 'Our Emergent Student Profile'),
            array('key' => 'field_life_risk_leader_items', 'label' => __('Leader Card Items (4)', 'mlzs'), 'name' => 'life_risk_leader_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_life_leader_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'lightbulb'),
                array('key' => 'field_life_leader_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary-light' => 'Primary Light', 'secondary' => 'Secondary', 'accent' => 'Accent', 'primary-light-2' => 'Primary Light 2'), 'default_value' => 'primary-light'),
                array('key' => 'field_life_leader_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Innovative Thinker'),
                array('key' => 'field_life_leader_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Creates new solutions to complex problems'),
            )),
            array('key' => 'field_life_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_life_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'life_cta_heading', 'type' => 'text', 'default_value' => 'Join Us in Shaping Future Leaders'),
            array('key' => 'field_life_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'life_cta_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'At Mount Litera Zee School, we don\'t just teach subjects - we build character, instill values, and develop life skills that prepare children for success in the 21st century.'),
            array('key' => 'field_life_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'life_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Explore Our Curriculum).', 'mlzs')),
            array('key' => 'field_life_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'life_cta_btn1_icon', 'type' => 'text', 'default_value' => 'book-open'),
            array('key' => 'field_life_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'life_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Schedule a Campus Visit).', 'mlzs')),
            array('key' => 'field_life_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'life_cta_btn2_icon', 'type' => 'text', 'default_value' => 'calendar'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'life.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_life_field_group');

/**
 * ACF Pro: Media / Multimedia Page – Hero, Intro (2 cols), Core Features (3), USP, Creative Team (3), Benefits (student 4 + teacher 3), CTA (Link buttons)
 * Image alt = use attachment alt from Media Library; no separate ACF alt field.
 */
function mlzs_acf_media_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_media',
        'title'                 => __('Multimedia Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_media_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'media_hero_badge', 'type' => 'text', 'default_value' => 'Digital Learning'),
            array('key' => 'field_media_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'media_hero_icon', 'type' => 'text', 'default_value' => 'tv'),
            array('key' => 'field_media_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'media_hero_headline_before', 'type' => 'text', 'default_value' => 'Interactive'),
            array('key' => 'field_media_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'media_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Multimedia Classes'),
            array('key' => 'field_media_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'media_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Pioneering digital education with cutting-edge multimedia classrooms that blend technology with pedagogy for an immersive learning experience.'),
            array('key' => 'field_media_tab_intro', 'label' => __('Introduction', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_intro_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'media_intro_badge', 'type' => 'text', 'default_value' => 'Innovation'),
            array('key' => 'field_media_intro_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'media_intro_icon', 'type' => 'text', 'default_value' => 'zap'),
            array('key' => 'field_media_intro_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'media_intro_heading_before', 'type' => 'text', 'default_value' => 'Revolutionizing Education Through'),
            array('key' => 'field_media_intro_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'media_intro_heading_highlight', 'type' => 'text', 'default_value' => 'Technology'),
            array('key' => 'field_media_intro_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'media_intro_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Mount Litera Zee School is the first school in the city to implement this advanced interactive classroom solution, setting new standards in digital education.'),
            array('key' => 'field_media_intro_left_icon', 'label' => __('Left Card Icon', 'mlzs'), 'name' => 'media_intro_left_icon', 'type' => 'text', 'default_value' => 'globe'),
            array('key' => 'field_media_intro_left_title', 'label' => __('Left Card Title', 'mlzs'), 'name' => 'media_intro_left_title', 'type' => 'text', 'default_value' => 'World-Class Interactive Solution'),
            array('key' => 'field_media_intro_left_para1', 'label' => __('Left Card Paragraph 1', 'mlzs'), 'name' => 'media_intro_left_para1', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_media_intro_left_para2', 'label' => __('Left Card Paragraph 2', 'mlzs'), 'name' => 'media_intro_left_para2', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_media_intro_left_image', 'label' => __('Left Column Image', 'mlzs'), 'name' => 'media_intro_left_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_media_intro_left_image_caption', 'label' => __('Left Image Overlay Caption', 'mlzs'), 'name' => 'media_intro_left_image_caption', 'type' => 'text', 'default_value' => 'Interactive Multimedia Classroom'),
            array('key' => 'field_media_intro_left_image_icon', 'label' => __('Left Image Overlay Icon', 'mlzs'), 'name' => 'media_intro_left_image_icon', 'type' => 'text', 'default_value' => 'tv'),
            array('key' => 'field_media_intro_right_image', 'label' => __('Right Column Image', 'mlzs'), 'name' => 'media_intro_right_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_media_intro_right_image_caption', 'label' => __('Right Image Overlay Caption', 'mlzs'), 'name' => 'media_intro_right_image_caption', 'type' => 'text', 'default_value' => 'Cloud-Based Learning Content'),
            array('key' => 'field_media_intro_right_image_icon', 'label' => __('Right Image Overlay Icon', 'mlzs'), 'name' => 'media_intro_right_image_icon', 'type' => 'text', 'default_value' => 'cloud'),
            array('key' => 'field_media_intro_right_icon', 'label' => __('Right Card Icon', 'mlzs'), 'name' => 'media_intro_right_icon', 'type' => 'text', 'default_value' => 'cloud'),
            array('key' => 'field_media_intro_right_title', 'label' => __('Right Card Title', 'mlzs'), 'name' => 'media_intro_right_title', 'type' => 'text', 'default_value' => 'Advanced Technology Infrastructure'),
            array('key' => 'field_media_intro_right_para1', 'label' => __('Right Card Paragraph 1', 'mlzs'), 'name' => 'media_intro_right_para1', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_media_intro_right_para2', 'label' => __('Right Card Paragraph 2', 'mlzs'), 'name' => 'media_intro_right_para2', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_media_tab_features', 'label' => __('Core Features (3)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_features_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'media_features_badge', 'type' => 'text', 'default_value' => 'Core Technology'),
            array('key' => 'field_media_features_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'media_features_icon', 'type' => 'text', 'default_value' => 'cpu'),
            array('key' => 'field_media_features_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'media_features_heading_before', 'type' => 'text', 'default_value' => 'Cutting-Edge'),
            array('key' => 'field_media_features_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'media_features_heading_highlight', 'type' => 'text', 'default_value' => 'Multimedia Features'),
            array('key' => 'field_media_features_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'media_features_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our multimedia classrooms are equipped with the latest technology to create an engaging and effective learning environment.'),
            array('key' => 'field_media_features_items', 'label' => __('Feature Cards (3)', 'mlzs'), 'name' => 'media_features_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'projector'),
                array('key' => 'field_media_feat_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_media_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Advanced Projector Systems'),
                array('key' => 'field_media_feat_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_media_tab_usp', 'label' => __('USP Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_usp_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'media_usp_badge', 'type' => 'text', 'default_value' => 'Unique Advantages'),
            array('key' => 'field_media_usp_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'media_usp_icon', 'type' => 'text', 'default_value' => 'sparkles'),
            array('key' => 'field_media_usp_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'media_usp_heading_before', 'type' => 'text', 'default_value' => 'Multiple Learning'),
            array('key' => 'field_media_usp_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'media_usp_heading_highlight', 'type' => 'text', 'default_value' => 'Experiences Model'),
            array('key' => 'field_media_usp_items', 'label' => __('USP Items (3)', 'mlzs'), 'name' => 'media_usp_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_usp_icon_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('green' => 'Green', 'blue' => 'Blue', 'purple' => 'Purple'), 'default_value' => 'green'),
                array('key' => 'field_media_usp_icon_name', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'book-open'),
                array('key' => 'field_media_usp_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Lesson Plan Approach'),
                array('key' => 'field_media_usp_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_media_usp_right_title', 'label' => __('Right Card Title', 'mlzs'), 'name' => 'media_usp_right_title', 'type' => 'text', 'default_value' => 'Pioneering Achievement'),
            array('key' => 'field_media_usp_right_items', 'label' => __('Right Card Items (3)', 'mlzs'), 'name' => 'media_usp_right_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_usp_right_item_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'star'),
                array('key' => 'field_media_usp_right_item_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'First in the City'),
                array('key' => 'field_media_usp_right_item_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'text', 'default_value' => 'First school in the city to implement this advanced interactive classroom solution'),
            )),
            array('key' => 'field_media_tab_team', 'label' => __('Creative Team (3)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_team_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'media_team_badge', 'type' => 'text', 'default_value' => 'Behind the Scenes'),
            array('key' => 'field_media_team_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'media_team_icon', 'type' => 'text', 'default_value' => 'users'),
            array('key' => 'field_media_team_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'media_team_heading_before', 'type' => 'text', 'default_value' => 'Our In-House'),
            array('key' => 'field_media_team_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'media_team_heading_highlight', 'type' => 'text', 'default_value' => 'Creative Team'),
            array('key' => 'field_media_team_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'media_team_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A dedicated team of professionals working continuously to develop engaging and effective multimedia content for our students.'),
            array('key' => 'field_media_team_items', 'label' => __('Team Cards (3)', 'mlzs'), 'name' => 'media_team_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_team_card_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'user-check'),
                array('key' => 'field_media_team_card_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_media_team_card_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Experienced Teachers'),
                array('key' => 'field_media_team_card_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_media_team_card_label', 'label' => __('Footer Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Curriculum Experts'),
            )),
            array('key' => 'field_media_team_banner_heading', 'label' => __('Banner Heading', 'mlzs'), 'name' => 'media_team_banner_heading', 'type' => 'text', 'default_value' => 'Continuous Content Development'),
            array('key' => 'field_media_team_banner_para', 'label' => __('Banner Paragraph', 'mlzs'), 'name' => 'media_team_banner_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Our creative team continuously creates, develops, and uploads lesson content, ensuring that students always have access to fresh, relevant, and engaging educational materials tailored to their learning needs.'),
            array('key' => 'field_media_tab_benefits', 'label' => __('Benefits Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_benefits_student_icon', 'label' => __('Student Badge Icon', 'mlzs'), 'name' => 'media_benefits_student_icon', 'type' => 'text', 'default_value' => 'graduation-cap'),
            array('key' => 'field_media_benefits_student_badge', 'label' => __('Student Badge', 'mlzs'), 'name' => 'media_benefits_student_badge', 'type' => 'text', 'default_value' => 'Student Benefits'),
            array('key' => 'field_media_benefits_student_heading', 'label' => __('Student Heading (before highlight)', 'mlzs'), 'name' => 'media_benefits_student_heading', 'type' => 'text', 'default_value' => 'Preparing Students for'),
            array('key' => 'field_media_benefits_student_highlight', 'label' => __('Student Heading (highlighted)', 'mlzs'), 'name' => 'media_benefits_student_highlight', 'type' => 'text', 'default_value' => 'Tomorrow\'s World'),
            array('key' => 'field_media_benefits_student_items', 'label' => __('Student Items (4)', 'mlzs'), 'name' => 'media_benefits_student_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_ben_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Enhanced Engagement'),
                array('key' => 'field_media_ben_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_media_benefits_teacher_icon', 'label' => __('Teacher Badge Icon', 'mlzs'), 'name' => 'media_benefits_teacher_icon', 'type' => 'text', 'default_value' => 'user-plus'),
            array('key' => 'field_media_benefits_teacher_badge', 'label' => __('Teacher Badge', 'mlzs'), 'name' => 'media_benefits_teacher_badge', 'type' => 'text', 'default_value' => 'Teacher Benefits'),
            array('key' => 'field_media_benefits_teacher_heading', 'label' => __('Teacher Heading (before highlight)', 'mlzs'), 'name' => 'media_benefits_teacher_heading', 'type' => 'text', 'default_value' => 'Empowering Our'),
            array('key' => 'field_media_benefits_teacher_highlight', 'label' => __('Teacher Heading (highlighted)', 'mlzs'), 'name' => 'media_benefits_teacher_highlight', 'type' => 'text', 'default_value' => 'Educators'),
            array('key' => 'field_media_benefits_teacher_items', 'label' => __('Teacher Items (3+)', 'mlzs'), 'name' => 'media_benefits_teacher_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 6, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_media_ben_t_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Enhanced Teaching Tools'),
                array('key' => 'field_media_ben_t_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_media_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_media_cta_icon', 'label' => __('CTA Icon', 'mlzs'), 'name' => 'media_cta_icon', 'type' => 'text', 'default_value' => 'video'),
            array('key' => 'field_media_cta_heading_before', 'label' => __('CTA Heading (before highlight)', 'mlzs'), 'name' => 'media_cta_heading_before', 'type' => 'text', 'default_value' => 'Experience Interactive'),
            array('key' => 'field_media_cta_heading_highlight', 'label' => __('CTA Heading (highlighted)', 'mlzs'), 'name' => 'media_cta_heading_highlight', 'type' => 'text', 'default_value' => 'Learning'),
            array('key' => 'field_media_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'media_cta_para', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'See firsthand how our multimedia classrooms are transforming education and preparing students for success in the digital age.'),
            array('key' => 'field_media_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'media_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Schedule a Demo Class).', 'mlzs')),
            array('key' => 'field_media_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'media_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_media_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'media_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Download Brochure).', 'mlzs')),
            array('key' => 'field_media_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'media_cta_btn2_icon', 'type' => 'text', 'default_value' => 'download'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'media.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_media_field_group');

/**
 * ACF Pro: Non-Teaching Staff Page – Hero (stats 3, buttons Link), Table (staff repeater), CTA (Link buttons)
 */
function mlzs_acf_nonteach_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_nonteach',
        'title'                 => __('Non-Teaching Staff Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_nt_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_nt_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'nonteach_hero_badge', 'type' => 'text', 'default_value' => 'Support Team'),
            array('key' => 'field_nt_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'nonteach_hero_headline_before', 'type' => 'text', 'default_value' => 'Meet Our'),
            array('key' => 'field_nt_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'nonteach_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Non-Teaching Staff'),
            array('key' => 'field_nt_hero_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'nonteach_hero_paragraph', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Our dedicated administrative and support team ensures smooth operations and provides essential services to create a seamless learning environment for our students and educators.'),
            array('key' => 'field_nt_hero_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'nonteach_hero_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. View All Staff).', 'mlzs')),
            array('key' => 'field_nt_hero_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'nonteach_hero_btn1_icon', 'type' => 'text', 'default_value' => 'arrow-down'),
            array('key' => 'field_nt_hero_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'nonteach_hero_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Search Staff).', 'mlzs')),
            array('key' => 'field_nt_hero_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'nonteach_hero_btn2_icon', 'type' => 'text', 'default_value' => 'search'),
            array('key' => 'field_nt_hero_stats', 'label' => __('Hero Stat Cards (3)', 'mlzs'), 'name' => 'nonteach_hero_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_nt_stat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'),
                array('key' => 'field_nt_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '11'),
                array('key' => 'field_nt_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Support Staff'),
            )),
            array('key' => 'field_nt_tab_table', 'label' => __('Staff Table', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_nt_search_placeholder', 'label' => __('Search Input Placeholder', 'mlzs'), 'name' => 'nonteach_search_placeholder', 'type' => 'text', 'default_value' => 'Search...'),
            array('key' => 'field_nt_table_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'nonteach_table_heading', 'type' => 'text', 'default_value' => 'Non-Teaching Staff Directory'),
            array('key' => 'field_nt_table_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'nonteach_table_subtext', 'type' => 'text', 'default_value' => 'Complete list of our administrative and support staff with their designations'),
            array('key' => 'field_nt_table_stat_total_label', 'label' => __('Stat: Total Staff Label', 'mlzs'), 'name' => 'nonteach_table_stat_total_label', 'type' => 'text', 'default_value' => 'Total Staff', 'instructions' => __('Numbers are auto-calculated from staff table.', 'mlzs')),
            array('key' => 'field_nt_table_stat_admin_label', 'label' => __('Stat: Administrative Label', 'mlzs'), 'name' => 'nonteach_table_stat_admin_label', 'type' => 'text', 'default_value' => 'Administrative'),
            array('key' => 'field_nt_table_stat_support_label', 'label' => __('Stat: Support Staff Label', 'mlzs'), 'name' => 'nonteach_table_stat_support_label', 'type' => 'text', 'default_value' => 'Support Staff'),
            array('key' => 'field_nt_staff_rows', 'label' => __('Staff Rows', 'mlzs'), 'name' => 'nonteach_staff_rows', 'type' => 'repeater', 'layout' => 'table', 'min' => 0, 'button_label' => __('Add Staff', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_nt_staff_name', 'label' => __('Name', 'mlzs'), 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_nt_staff_designation', 'label' => __('Designation', 'mlzs'), 'name' => 'designation', 'type' => 'select', 'choices' => array(
                    'PRINCIPAL' => 'PRINCIPAL',
                    'Executive Head' => 'Executive Head',
                    'ADMIN INCHARGE' => 'ADMIN INCHARGE',
                    'IT-EXECUTIVE' => 'IT-EXECUTIVE',
                    'ACCOUNTANT' => 'ACCOUNTANT',
                    'TRANSPORT INCHARGE' => 'TRANSPORT INCHARGE',
                    'EXAMINATION CONTROLLER' => 'EXAMINATION CONTROLLER',
                    'COUNSELLOR' => 'COUNSELLOR',
                    'STORE INCHARGE' => 'STORE INCHARGE',
                    'IT EXEC.' => 'IT EXEC.',
                    'NURSING STAFF' => 'NURSING STAFF',
                ), 'default_value' => '', 'allow_null' => 0, 'return_format' => 'value'),
            )),
            array('key' => 'field_nt_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_nt_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'nonteach_cta_heading', 'type' => 'text', 'default_value' => 'Join Our Support Team'),
            array('key' => 'field_nt_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'nonteach_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Are you looking for an opportunity to contribute to education? We\'re always looking for dedicated professionals to join our administrative and support team.'),
            array('key' => 'field_nt_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'nonteach_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. View Open Positions).', 'mlzs')),
            array('key' => 'field_nt_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'nonteach_cta_btn1_icon', 'type' => 'text', 'default_value' => 'arrow-right'),
            array('key' => 'field_nt_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'nonteach_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Contact HR).', 'mlzs')),
            array('key' => 'field_nt_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'nonteach_cta_btn2_icon', 'type' => 'text', 'default_value' => 'mail'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'nonteach.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_nonteach_field_group');

/**
 * ACF Pro: Teaching Staff Page – Hero (stats 3, buttons), Table (staff: name, subject, designation), Department cards (3), CTA
 */
function mlzs_acf_teaching_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_teaching',
        'title'                 => __('Teaching Staff Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_tch_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tch_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'teaching_hero_badge', 'type' => 'text', 'default_value' => 'Our Educators'),
            array('key' => 'field_tch_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'teaching_hero_headline_before', 'type' => 'text', 'default_value' => 'Meet Our'),
            array('key' => 'field_tch_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'teaching_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Teaching Staff'),
            array('key' => 'field_tch_hero_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'teaching_hero_paragraph', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Our dedicated team of educators brings passion, expertise, and innovation to the classroom every day. Meet the professionals who are shaping the future leaders of tomorrow.'),
            array('key' => 'field_tch_hero_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'teaching_hero_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. View All Staff).', 'mlzs')),
            array('key' => 'field_tch_hero_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'teaching_hero_btn1_icon', 'type' => 'text', 'default_value' => 'arrow-down'),
            array('key' => 'field_tch_hero_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'teaching_hero_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Search Staff).', 'mlzs')),
            array('key' => 'field_tch_hero_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'teaching_hero_btn2_icon', 'type' => 'text', 'default_value' => 'search'),
            array('key' => 'field_tch_hero_stats', 'label' => __('Hero Stat Cards (3)', 'mlzs'), 'name' => 'teaching_hero_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tch_stat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'),
                array('key' => 'field_tch_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '70+'),
                array('key' => 'field_tch_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Teaching Professionals'),
            )),
            array('key' => 'field_tch_tab_table', 'label' => __('Staff Table', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tch_search_placeholder', 'label' => __('Search Input Placeholder', 'mlzs'), 'name' => 'teaching_search_placeholder', 'type' => 'text', 'default_value' => 'Search...'),
            array('key' => 'field_tch_table_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'teaching_table_heading', 'type' => 'text', 'default_value' => 'Teaching Staff Directory'),
            array('key' => 'field_tch_table_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'teaching_table_subtext', 'type' => 'text', 'default_value' => 'Complete list of our teaching faculty with their subjects and designations'),
            array('key' => 'field_tch_table_stat_total_label', 'label' => __('Stat: Total Staff Label', 'mlzs'), 'name' => 'teaching_table_stat_total_label', 'type' => 'text', 'default_value' => 'Total Staff', 'instructions' => __('Numbers are auto-calculated from staff table.', 'mlzs')),
            array('key' => 'field_tch_table_stat_pgt_label', 'label' => __('Stat: PGT Teachers Label', 'mlzs'), 'name' => 'teaching_table_stat_pgt_label', 'type' => 'text', 'default_value' => 'PGT Teachers'),
            array('key' => 'field_tch_table_stat_subjects_label', 'label' => __('Stat: Subjects Label', 'mlzs'), 'name' => 'teaching_table_stat_subjects_label', 'type' => 'text', 'default_value' => 'Subjects'),
            array('key' => 'field_tch_table_stat_coaches_label', 'label' => __('Stat: Coaches Label', 'mlzs'), 'name' => 'teaching_table_stat_coaches_label', 'type' => 'text', 'default_value' => 'Coaches'),
            array('key' => 'field_tch_staff_rows', 'label' => __('Staff Rows', 'mlzs'), 'name' => 'teaching_staff_rows', 'type' => 'repeater', 'layout' => 'table', 'min' => 0, 'button_label' => __('Add Staff', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tch_staff_name', 'label' => __('Name', 'mlzs'), 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_tch_staff_subject', 'label' => __('Subject', 'mlzs'), 'name' => 'subject', 'type' => 'text'),
                array('key' => 'field_tch_staff_designation', 'label' => __('Designation', 'mlzs'), 'name' => 'designation', 'type' => 'text', 'instructions' => __('e.g. PGT, TGT, PBT, Coach, Music Teacher', 'mlzs')),
            )),
            array('key' => 'field_tch_tab_dept', 'label' => __('Department Cards', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tch_dept_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'teaching_dept_heading', 'type' => 'text', 'default_value' => 'Department Overview'),
            array('key' => 'field_tch_dept_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'teaching_dept_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our teaching staff is organized into specialized departments to ensure comprehensive coverage of all subjects and activities'),
            array('key' => 'field_tch_dept_cards', 'label' => __('Department Cards (3)', 'mlzs'), 'name' => 'teaching_dept_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tch_dept_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'book-open'),
                array('key' => 'field_tch_dept_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Academic Faculty'),
                array('key' => 'field_tch_dept_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Core Subjects'),
                array('key' => 'field_tch_dept_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_tch_dept_count_label', 'label' => __('Count Label', 'mlzs'), 'name' => 'count_label', 'type' => 'text', 'default_value' => '45+ Teachers'),
                array('key' => 'field_tch_dept_badge_text', 'label' => __('Badge Text', 'mlzs'), 'name' => 'badge_text', 'type' => 'text', 'default_value' => 'Core'),
                array('key' => 'field_tch_dept_color', 'label' => __('Card Color', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('primary' => 'Primary (#3D348B)', 'accent' => 'Accent (#F7B801)', 'cayenne' => 'Cayenne (#F35B04)'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_tch_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tch_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'teaching_cta_heading', 'type' => 'text', 'default_value' => 'Join Our Teaching Team'),
            array('key' => 'field_tch_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'teaching_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Are you passionate about education and want to make a difference? We\'re always looking for talented educators to join our team.'),
            array('key' => 'field_tch_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'teaching_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. View Open Positions).', 'mlzs')),
            array('key' => 'field_tch_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'teaching_cta_btn1_icon', 'type' => 'text', 'default_value' => 'arrow-right'),
            array('key' => 'field_tch_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'teaching_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Contact HR).', 'mlzs')),
            array('key' => 'field_tch_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'teaching_cta_btn2_icon', 'type' => 'text', 'default_value' => 'mail'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'teaching.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_teaching_field_group');

/**
 * ACF Pro: Testimonials Page – Hero, Video grid (6+), More stories + info panel, Stats & CTA
 */
function mlzs_acf_testimonial_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_testimonial',
        'title'                 => __('Testimonials Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_tst_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tst_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'testimonial_hero_badge', 'type' => 'text', 'default_value' => 'Parent Feedback'),
            array('key' => 'field_tst_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'testimonial_hero_icon', 'type' => 'text', 'default_value' => 'message-circle-heart', 'instructions' => __('Lucide icon name.', 'mlzs')),
            array('key' => 'field_tst_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'testimonial_hero_headline_before', 'type' => 'text', 'default_value' => 'Parent'),
            array('key' => 'field_tst_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'testimonial_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Testimonials'),
            array('key' => 'field_tst_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'testimonial_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Hear what our parents have to say about their experience with Mount Litera Zee School'),
            array('key' => 'field_tst_tab_video', 'label' => __('Video Testimonials', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tst_video_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'testimonial_video_heading', 'type' => 'text', 'default_value' => 'Video'),
            array('key' => 'field_tst_video_heading_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'testimonial_video_heading_highlight', 'type' => 'text', 'default_value' => 'Testimonials'),
            array('key' => 'field_tst_video_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'testimonial_video_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Watch parents share their experiences and stories about their children\'s journey at our school'),
            array('key' => 'field_tst_video_items', 'label' => __('Video Cards', 'mlzs'), 'name' => 'testimonial_video_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Video', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tst_vid_video_url', 'label' => __('Video URL', 'mlzs'), 'name' => 'video_url', 'type' => 'oembed', 'return_format' => 'url', 'instructions' => __('Paste YouTube or Vimeo URL. Thumbnail is auto-fetched.', 'mlzs')),
                array('key' => 'field_tst_vid_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Parent Testimonial'),
                array('key' => 'field_tst_vid_hover_title', 'label' => __('Hover Title', 'mlzs'), 'name' => 'hover_title', 'type' => 'text', 'default_value' => 'Parent Experience'),
                array('key' => 'field_tst_vid_badge_style', 'label' => __('Badge Style', 'mlzs'), 'name' => 'badge_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'primary-dark' => 'Primary Dark', 'primary-lighter' => 'Primary Lighter', 'accent-light' => 'Accent Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_tst_tab_more', 'label' => __('More Parent Stories', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tst_more_heading', 'label' => __('Block Heading', 'mlzs'), 'name' => 'testimonial_more_heading', 'type' => 'text', 'default_value' => 'More Parent Stories'),
            array('key' => 'field_tst_more_video', 'label' => __('Extra Video Card', 'mlzs'), 'name' => 'testimonial_more_video', 'type' => 'group', 'sub_fields' => array(
                array('key' => 'field_tst_mv_video_url', 'label' => __('Video URL', 'mlzs'), 'name' => 'video_url', 'type' => 'oembed', 'return_format' => 'url', 'instructions' => __('Paste YouTube or Vimeo URL. Thumbnail is auto-fetched.', 'mlzs')),
                array('key' => 'field_tst_mv_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tst_mv_hover_title', 'label' => __('Hover Title', 'mlzs'), 'name' => 'hover_title', 'type' => 'text', 'default_value' => 'Watch video testimonial'),
            )),
            array('key' => 'field_tst_info_icon', 'label' => __('Info Panel Icon', 'mlzs'), 'name' => 'testimonial_info_icon', 'type' => 'text', 'default_value' => 'volume-2'),
            array('key' => 'field_tst_info_heading', 'label' => __('Info Panel Heading', 'mlzs'), 'name' => 'testimonial_info_heading', 'type' => 'text', 'default_value' => 'Real Stories, Real Experiences'),
            array('key' => 'field_tst_info_paragraph', 'label' => __('Info Panel Paragraph', 'mlzs'), 'name' => 'testimonial_info_paragraph', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Our parents share their genuine experiences and stories about how Mount Litera Zee School has made a positive impact on their children\'s lives.'),
            array('key' => 'field_tst_info_checklist', 'label' => __('Checklist (3)', 'mlzs'), 'name' => 'testimonial_info_checklist', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tst_check_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_tst_tab_cta', 'label' => __('Stats & CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tst_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'testimonial_cta_heading', 'type' => 'text', 'default_value' => 'Share Your Story'),
            array('key' => 'field_tst_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'testimonial_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Are you a parent with a story to share about your child\'s journey at Mount Litera Zee School? We\'d love to hear from you!'),
            array('key' => 'field_tst_cta_btn1', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'testimonial_cta_btn1', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Share Your Testimonial).', 'mlzs')),
            array('key' => 'field_tst_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'testimonial_cta_btn1_icon', 'type' => 'text', 'default_value' => 'message-circle'),
            array('key' => 'field_tst_cta_btn2', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'testimonial_cta_btn2', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Watch All Videos).', 'mlzs')),
            array('key' => 'field_tst_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'testimonial_cta_btn2_icon', 'type' => 'text', 'default_value' => 'play-circle'),
            array('key' => 'field_tst_cta_stats', 'label' => __('Stats (4)', 'mlzs'), 'name' => 'testimonial_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tst_stat_number', 'label' => __('Number/Text', 'mlzs'), 'name' => 'number', 'type' => 'text', 'default_value' => '7+'),
                array('key' => 'field_tst_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Video Testimonials'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'testimonial.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_testimonial_field_group');

/**
 * ACF Pro: Open Air Theatre Page – Hero, Overview (content + image + stats), Features (3), Gallery (3)
 */
function mlzs_acf_theatre_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_theatre',
        'title'                 => __('Open Air Theatre Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_thr_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_thr_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'theatre_hero_badge', 'type' => 'text', 'default_value' => 'Performing Arts'),
            array('key' => 'field_thr_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'theatre_hero_icon', 'type' => 'text', 'default_value' => 'theater'),
            array('key' => 'field_thr_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'theatre_hero_headline_before', 'type' => 'text', 'default_value' => 'Open Air'),
            array('key' => 'field_thr_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'theatre_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Theatre'),
            array('key' => 'field_thr_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'theatre_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A magnificent venue for performances, assemblies, and cultural celebrations under the open sky'),
            array('key' => 'field_thr_tab_overview', 'label' => __('Overview Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_thr_overview_heading', 'label' => __('Section Heading (before highlight)', 'mlzs'), 'name' => 'theatre_overview_heading', 'type' => 'text', 'default_value' => 'The'),
            array('key' => 'field_thr_overview_highlight', 'label' => __('Section Heading (highlighted)', 'mlzs'), 'name' => 'theatre_overview_heading_highlight', 'type' => 'text', 'default_value' => 'Stage'),
            array('key' => 'field_thr_overview_heading_after', 'label' => __('Section Heading (after highlight)', 'mlzs'), 'name' => 'theatre_overview_heading_after', 'type' => 'text', 'default_value' => 'of Excellence'),
            array('key' => 'field_thr_overview_para1', 'label' => __('Paragraph 1', 'mlzs'), 'name' => 'theatre_overview_para1', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_thr_overview_para2', 'label' => __('Paragraph 2', 'mlzs'), 'name' => 'theatre_overview_para2', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_thr_stat1_number', 'label' => __('Stat 1 Number', 'mlzs'), 'name' => 'theatre_stat1_number', 'type' => 'text', 'default_value' => '500+'),
            array('key' => 'field_thr_stat1_label', 'label' => __('Stat 1 Label', 'mlzs'), 'name' => 'theatre_stat1_label', 'type' => 'text', 'default_value' => 'Seating Capacity'),
            array('key' => 'field_thr_stat2_number', 'label' => __('Stat 2 Number', 'mlzs'), 'name' => 'theatre_stat2_number', 'type' => 'text', 'default_value' => '30+'),
            array('key' => 'field_thr_stat2_label', 'label' => __('Stat 2 Label', 'mlzs'), 'name' => 'theatre_stat2_label', 'type' => 'text', 'default_value' => 'Annual Events'),
            array('key' => 'field_thr_main_image', 'label' => __('Main Theatre Image', 'mlzs'), 'name' => 'theatre_main_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_thr_stage_badge_title', 'label' => __('Stage Badge Title', 'mlzs'), 'name' => 'theatre_stage_badge_title', 'type' => 'text', 'default_value' => 'Main Stage'),
            array('key' => 'field_thr_stage_badge_subtitle', 'label' => __('Stage Badge Subtitle', 'mlzs'), 'name' => 'theatre_stage_badge_subtitle', 'type' => 'text', 'default_value' => 'Amphitheater Style'),
            array('key' => 'field_thr_tab_features', 'label' => __('Stage Features', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_thr_features_badge', 'label' => __('Features Badge', 'mlzs'), 'name' => 'theatre_features_badge', 'type' => 'text', 'default_value' => 'Stage Features'),
            array('key' => 'field_thr_features_heading', 'label' => __('Features Heading (before highlight)', 'mlzs'), 'name' => 'theatre_features_heading', 'type' => 'text', 'default_value' => 'World-Class'),
            array('key' => 'field_thr_features_highlight', 'label' => __('Features Heading (highlighted)', 'mlzs'), 'name' => 'theatre_features_heading_highlight', 'type' => 'text', 'default_value' => 'Facilities'),
            array('key' => 'field_thr_features_subtext', 'label' => __('Features Subtext', 'mlzs'), 'name' => 'theatre_features_subtext', 'type' => 'text', 'default_value' => 'Equipped with professional sound, lighting, and seating for exceptional performances'),
            array('key' => 'field_thr_features_list', 'label' => __('Feature Cards (3)', 'mlzs'), 'name' => 'theatre_features_list', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_thr_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'speaker'),
                array('key' => 'field_thr_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_thr_feat_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_thr_feat_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_thr_tab_gallery', 'label' => __('Performance Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_thr_gallery_badge', 'label' => __('Gallery Badge', 'mlzs'), 'name' => 'theatre_gallery_badge', 'type' => 'text', 'default_value' => 'Performance Gallery'),
            array('key' => 'field_thr_gallery_heading', 'label' => __('Gallery Heading (before highlight)', 'mlzs'), 'name' => 'theatre_gallery_heading', 'type' => 'text', 'default_value' => 'Memorable'),
            array('key' => 'field_thr_gallery_highlight', 'label' => __('Gallery Heading (highlighted)', 'mlzs'), 'name' => 'theatre_gallery_heading_highlight', 'type' => 'text', 'default_value' => 'Moments'),
            array('key' => 'field_thr_gallery_subtext', 'label' => __('Gallery Subtext', 'mlzs'), 'name' => 'theatre_gallery_subtext', 'type' => 'text', 'default_value' => 'Capturing the magic of performances in our magnificent open air theatre'),
            array('key' => 'field_thr_gallery_items', 'label' => __('Gallery Items (3)', 'mlzs'), 'name' => 'theatre_gallery_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_thr_gal_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
                array('key' => 'field_thr_gal_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_thr_gal_caption', 'label' => __('Caption', 'mlzs'), 'name' => 'caption', 'type' => 'text'),
                array('key' => 'field_thr_gal_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'badge', 'type' => 'text', 'default_value' => 'Dance', 'instructions' => __('e.g. Dance, Drama, Music', 'mlzs')),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'theatre.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_theatre_field_group');

/**
 * ACF Pro: School Timing Page – Hero, School Timings card, Important Persons, Additional info (3 cards)
 */
function mlzs_acf_timing_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_timing',
        'title'                 => __('School Timing Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_tim_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tim_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'timing_hero_badge', 'type' => 'text', 'default_value' => 'School Information'),
            array('key' => 'field_tim_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'timing_hero_icon', 'type' => 'text', 'default_value' => 'clock'),
            array('key' => 'field_tim_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'timing_hero_headline_before', 'type' => 'text', 'default_value' => 'School'),
            array('key' => 'field_tim_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'timing_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Timing'),
            array('key' => 'field_tim_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'timing_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Find the complete schedule for academic sessions, important contacts, and key personnel at Mount Litera Zee School, Alwar.'),
            array('key' => 'field_tim_tab_timing', 'label' => __('School Timings Card', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tim_card_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'timing_card_title', 'type' => 'text', 'default_value' => 'School Timings'),
            array('key' => 'field_tim_card_subtitle', 'label' => __('Card Subtitle', 'mlzs'), 'name' => 'timing_card_subtitle', 'type' => 'text', 'default_value' => 'Academic Session Schedule'),
            array('key' => 'field_tim_classes_heading', 'label' => __('Classes Heading', 'mlzs'), 'name' => 'timing_classes_heading', 'type' => 'text', 'default_value' => 'Classes I to XII'),
            array('key' => 'field_tim_summer_label', 'label' => __('Summer Label', 'mlzs'), 'name' => 'timing_summer_label', 'type' => 'text', 'default_value' => 'Summer'),
            array('key' => 'field_tim_summer_start', 'label' => __('Summer Start Time', 'mlzs'), 'name' => 'timing_summer_start', 'type' => 'time_picker', 'display_format' => 'g:i A', 'return_format' => 'g:i A'),
            array('key' => 'field_tim_summer_end', 'label' => __('Summer End Time', 'mlzs'), 'name' => 'timing_summer_end', 'type' => 'time_picker', 'display_format' => 'g:i A', 'return_format' => 'g:i A'),
            array('key' => 'field_tim_summer_caption', 'label' => __('Summer Caption', 'mlzs'), 'name' => 'timing_summer_caption', 'type' => 'text', 'default_value' => 'Morning to Early Afternoon Session'),
            array('key' => 'field_tim_winter_label', 'label' => __('Winter Label', 'mlzs'), 'name' => 'timing_winter_label', 'type' => 'text', 'default_value' => 'Winter'),
            array('key' => 'field_tim_winter_start', 'label' => __('Winter Start Time', 'mlzs'), 'name' => 'timing_winter_start', 'type' => 'time_picker', 'display_format' => 'g:i A', 'return_format' => 'g:i A'),
            array('key' => 'field_tim_winter_end', 'label' => __('Winter End Time', 'mlzs'), 'name' => 'timing_winter_end', 'type' => 'time_picker', 'display_format' => 'g:i A', 'return_format' => 'g:i A'),
            array('key' => 'field_tim_winter_caption', 'label' => __('Winter Caption', 'mlzs'), 'name' => 'timing_winter_caption', 'type' => 'text', 'default_value' => 'Late Morning to Afternoon Session'),
            array('key' => 'field_tim_note', 'label' => __('Note Text', 'mlzs'), 'name' => 'timing_note', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_tim_tab_persons', 'label' => __('Important Persons Card', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tim_persons_title', 'label' => __('Card Title', 'mlzs'), 'name' => 'timing_persons_title', 'type' => 'text', 'default_value' => 'Important Persons'),
            array('key' => 'field_tim_persons_subtitle', 'label' => __('Card Subtitle', 'mlzs'), 'name' => 'timing_persons_subtitle', 'type' => 'text', 'default_value' => 'Key Contacts & Administration'),
            array('key' => 'field_tim_persons_list', 'label' => __('Persons', 'mlzs'), 'name' => 'timing_persons_list', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Person', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tim_person_title', 'label' => __('Designation', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tim_person_name', 'label' => __('Name', 'mlzs'), 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_tim_person_email', 'label' => __('Email', 'mlzs'), 'name' => 'email', 'type' => 'email'),
                array('key' => 'field_tim_person_badge', 'label' => __('Badge', 'mlzs'), 'name' => 'badge', 'type' => 'text'),
                array('key' => 'field_tim_person_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('principal' => 'Principal', 'admin' => 'Admin'), 'default_value' => 'admin'),
            )),
            array('key' => 'field_tim_guidelines_heading', 'label' => __('Contact Guidelines Heading', 'mlzs'), 'name' => 'timing_guidelines_heading', 'type' => 'text', 'default_value' => 'Contact Guidelines'),
            array('key' => 'field_tim_guidelines_list', 'label' => __('Guidelines List', 'mlzs'), 'name' => 'timing_guidelines_list', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tim_guide_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_tim_tab_info', 'label' => __('Additional Info Cards', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tim_info_cards', 'label' => __('Info Cards (3)', 'mlzs'), 'name' => 'timing_info_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tim_info_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'calendar'),
                array('key' => 'field_tim_info_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tim_info_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_tim_info_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'gray' => 'Gray'), 'default_value' => 'primary'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'timing.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_timing_field_group');

/**
 * ACF Pro: Transfer Certificate Page – Hero, Search form, Help & Guidelines, Results sidebar
 */
function mlzs_acf_transfer_certificate_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_transfer_certificate',
        'title'                 => __('Transfer Certificate Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_tc_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tc_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'tc_hero_badge', 'type' => 'text', 'default_value' => 'Student Documents'),
            array('key' => 'field_tc_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'tc_hero_icon', 'type' => 'text', 'default_value' => 'file-certificate'),
            array('key' => 'field_tc_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'tc_hero_headline_before', 'type' => 'text', 'default_value' => 'Transfer'),
            array('key' => 'field_tc_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'tc_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Certificate'),
            array('key' => 'field_tc_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'tc_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Search and verify your Transfer Certificate using the unique serial number'),
            array('key' => 'field_tc_tab_search', 'label' => __('Search Form', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tc_search_title', 'label' => __('Search Title', 'mlzs'), 'name' => 'tc_search_title', 'type' => 'text', 'default_value' => 'Search Your TC'),
            array('key' => 'field_tc_search_subtitle', 'label' => __('Search Subtitle', 'mlzs'), 'name' => 'tc_search_subtitle', 'type' => 'text', 'default_value' => 'Find your Transfer Certificate using the serial number'),
            array('key' => 'field_tc_search_placeholder', 'label' => __('Input Placeholder', 'mlzs'), 'name' => 'tc_search_placeholder', 'type' => 'text', 'default_value' => 'TC-2024-XXXXX'),
            array('key' => 'field_tc_search_info_text', 'label' => __('Input Info Text', 'mlzs'), 'name' => 'tc_search_info_text', 'type' => 'text', 'default_value' => 'Format: TC-YEAR-NUMBER (Example: TC-2024-12345)'),
            array('key' => 'field_tc_search_btn_text', 'label' => __('Submit Button Text', 'mlzs'), 'name' => 'tc_search_btn_text', 'type' => 'text', 'default_value' => 'Search Certificate'),
            array('key' => 'field_tc_search_info_boxes', 'label' => __('Info Boxes (3)', 'mlzs'), 'name' => 'tc_search_info_boxes', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'max' => 3, 'button_label' => __('Add Box', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tc_search_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'shield-check', 'instructions' => __('e.g. shield-check, clock, download', 'mlzs')),
                array('key' => 'field_tc_search_box_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tc_search_box_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text'),
                array('key' => 'field_tc_search_box_style', 'label' => __('Color / Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_tc_tab_help', 'label' => __('Help & Guidelines', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tc_help_title', 'label' => __('Help Card Title', 'mlzs'), 'name' => 'tc_help_title', 'type' => 'text', 'default_value' => 'Need Help?'),
            array('key' => 'field_tc_help_paragraph', 'label' => __('Help Paragraph', 'mlzs'), 'name' => 'tc_help_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Can't find your serial number? Contact our administration office for assistance."),
            array('key' => 'field_tc_help_phone', 'label' => __('Help Phone', 'mlzs'), 'name' => 'tc_help_phone', 'type' => 'text', 'default_value' => '+91 9672797979'),
            array('key' => 'field_tc_guidelines_title', 'label' => __('Guidelines Card Title', 'mlzs'), 'name' => 'tc_guidelines_title', 'type' => 'text', 'default_value' => 'TC Guidelines'),
            array('key' => 'field_tc_guidelines_list', 'label' => __('Guidelines List', 'mlzs'), 'name' => 'tc_guidelines_list', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tc_guide_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_tc_tab_results', 'label' => __('Results Sidebar', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tc_results_title', 'label' => __('Results Title', 'mlzs'), 'name' => 'tc_results_title', 'type' => 'text', 'default_value' => 'Search Results'),
            array('key' => 'field_tc_results_initial_heading', 'label' => __('Initial State Heading', 'mlzs'), 'name' => 'tc_results_initial_heading', 'type' => 'text', 'default_value' => 'Search Transfer Certificate'),
            array('key' => 'field_tc_results_initial_text', 'label' => __('Initial State Text', 'mlzs'), 'name' => 'tc_results_initial_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Enter the serial number to verify and view your Transfer Certificate details'),
            array('key' => 'field_tc_results_loading_heading', 'label' => __('Loading State Heading', 'mlzs'), 'name' => 'tc_results_loading_heading', 'type' => 'text', 'default_value' => 'Searching...'),
            array('key' => 'field_tc_results_loading_text', 'label' => __('Loading State Text', 'mlzs'), 'name' => 'tc_results_loading_text', 'type' => 'text', 'default_value' => 'Verifying your Transfer Certificate details'),
            array('key' => 'field_tc_results_error_heading', 'label' => __('Error State Heading', 'mlzs'), 'name' => 'tc_results_error_heading', 'type' => 'text', 'default_value' => 'Certificate Not Found'),
            array('key' => 'field_tc_results_error_text', 'label' => __('Error State Text', 'mlzs'), 'name' => 'tc_results_error_text', 'type' => 'text', 'default_value' => 'Please check the serial number and try again'),
            array('key' => 'field_tc_results_important_notes', 'label' => __('Important Notes (Success State)', 'mlzs'), 'name' => 'tc_results_important_notes', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Note', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tc_note_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_tc_stats_total', 'label' => __('Stats: Total TCs Issued', 'mlzs'), 'name' => 'tc_stats_total', 'type' => 'text', 'default_value' => '2,500+'),
            array('key' => 'field_tc_stats_year', 'label' => __('Stats: This Year', 'mlzs'), 'name' => 'tc_stats_year', 'type' => 'text', 'default_value' => '450+'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'transfer-certificate.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_transfer_certificate_field_group');

/**
 * ACF Pro: Transport Page – Hero, Introduction, Bus Policy (rules with nested points), Bus Rules (with nested points), Fleet, CTA
 * Icon color dropdown where needed. Points ke andar nested points.
 */
function mlzs_acf_transport_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_transport',
        'title'                 => __('Transport Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_trans_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'transport_hero_badge', 'type' => 'text', 'default_value' => 'Safe Transportation'),
            array('key' => 'field_trans_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'transport_hero_icon', 'type' => 'text', 'default_value' => 'bus'),
            array('key' => 'field_trans_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'transport_hero_headline_before', 'type' => 'text', 'default_value' => 'School'),
            array('key' => 'field_trans_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'transport_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Transport'),
            array('key' => 'field_trans_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'transport_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Safe, reliable, and efficient transportation services for our students'),
            array('key' => 'field_trans_tab_intro', 'label' => __('Introduction Notice', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_intro_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'transport_intro_icon', 'type' => 'text', 'default_value' => 'alert-circle'),
            array('key' => 'field_trans_intro_icon_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'transport_intro_icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'primary'),
            array('key' => 'field_trans_intro_title', 'label' => __('Title', 'mlzs'), 'name' => 'transport_intro_title', 'type' => 'text', 'default_value' => 'Important Notice for Parents'),
            array('key' => 'field_trans_intro_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'transport_intro_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Parents are requested to kindly go through the following rules and guidelines regarding school bus transportation.'),
            array('key' => 'field_trans_tab_policy', 'label' => __('Bus Policy & Guidelines', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_policy_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'transport_policy_icon', 'type' => 'text', 'default_value' => 'clipboard-check'),
            array('key' => 'field_trans_policy_icon_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'transport_policy_icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'primary'),
            array('key' => 'field_trans_policy_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'transport_policy_title', 'type' => 'text', 'default_value' => 'Bus Policy & Guidelines'),
            array('key' => 'field_trans_policy_rules', 'label' => __('Policy Rules', 'mlzs'), 'name' => 'transport_policy_rules', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Rule', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_trans_rule_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'shield', 'instructions' => __('e.g. shield, clock, phone, map-pin', 'mlzs')),
                array('key' => 'field_trans_rule_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'primary'),
                array('key' => 'field_trans_rule_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_trans_rule_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_trans_rule_sub_points', 'label' => __('Nested Points', 'mlzs'), 'name' => 'sub_points', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Point', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_trans_sub_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
                )),
            )),
            array('key' => 'field_trans_tab_rules', 'label' => __('Bus Rules & Regulations', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_rules_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'transport_rules_icon', 'type' => 'text', 'default_value' => 'list-checks'),
            array('key' => 'field_trans_rules_icon_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'transport_rules_icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'accent'),
            array('key' => 'field_trans_rules_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'transport_rules_title', 'type' => 'text', 'default_value' => 'Bus Rules & Regulations'),
            array('key' => 'field_trans_rules_list', 'label' => __('Rules List', 'mlzs'), 'name' => 'transport_rules_list', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'button_label' => __('Add Rule', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_trans_rules_item_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_trans_rules_item_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_trans_rules_item_sub', 'label' => __('Nested Points', 'mlzs'), 'name' => 'sub_points', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'button_label' => __('Add Point', 'mlzs'), 'sub_fields' => array(
                    array('key' => 'field_trans_rules_sub_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
                )),
            )),
            array('key' => 'field_trans_tab_fleet', 'label' => __('Transport Fleet', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_fleet_icon', 'label' => __('Section Icon', 'mlzs'), 'name' => 'transport_fleet_icon', 'type' => 'text', 'default_value' => 'image'),
            array('key' => 'field_trans_fleet_icon_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'transport_fleet_icon_style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'primary'),
            array('key' => 'field_trans_fleet_title', 'label' => __('Section Title', 'mlzs'), 'name' => 'transport_fleet_title', 'type' => 'text', 'default_value' => 'Our Transport Fleet'),
            array('key' => 'field_trans_fleet_image', 'label' => __('Fleet Image', 'mlzs'), 'name' => 'transport_fleet_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_trans_fleet_caption', 'label' => __('Image Caption', 'mlzs'), 'name' => 'transport_fleet_caption', 'type' => 'text', 'default_value' => 'Modern, Safe & Comfortable Buses'),
            array('key' => 'field_trans_fleet_features', 'label' => __('Fleet Features (4)', 'mlzs'), 'name' => 'transport_fleet_features', 'type' => 'repeater', 'layout' => 'block', 'min' => 0, 'max' => 6, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_trans_fleet_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'shield'),
                array('key' => 'field_trans_fleet_feat_style', 'label' => __('Icon Color', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'primary-light' => 'Primary Light', 'accent' => 'Accent', 'green' => 'Green'), 'default_value' => 'primary'),
                array('key' => 'field_trans_fleet_feat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
            array('key' => 'field_trans_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_trans_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'transport_cta_heading', 'type' => 'text', 'default_value' => 'Need More Information?'),
            array('key' => 'field_trans_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'transport_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'For detailed bus routes, timings, and registration information, please contact our transport department.'),
            array('key' => 'field_trans_cta_btn1', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'transport_cta_btn1', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_trans_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'transport_cta_btn1_icon', 'type' => 'text', 'default_value' => 'phone'),
            array('key' => 'field_trans_cta_btn2', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'transport_cta_btn2', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_trans_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'transport_cta_btn2_icon', 'type' => 'text', 'default_value' => 'download'),
            array('key' => 'field_trans_cta_stats', 'label' => __('CTA Stats (4)', 'mlzs'), 'name' => 'transport_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 0, 'max' => 6, 'button_label' => __('Add Stat', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_trans_stat_value', 'label' => __('Value', 'mlzs'), 'name' => 'value', 'type' => 'text'),
                array('key' => 'field_trans_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'transport.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_transport_field_group');

/**
 * ACF Pro: Origin / Campus Page – Hero, Campus Overview (4 items), Videos (2), Gallery (6+), Features (4), CTA (Link buttons)
 * Image alt = use attachment alt from Media Library; no separate ACF alt field.
 */
function mlzs_acf_origin_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_origin',
        'title'                 => __('Campus / Origin Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_origin_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_origin_hero_bg_image', 'label' => __('Hero Background Image', 'mlzs'), 'name' => 'origin_hero_bg_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => __('Optional. Matches origin.html hero background.', 'mlzs')),
            array('key' => 'field_origin_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'origin_hero_badge', 'type' => 'text', 'default_value' => 'Campus Tour'),
            array('key' => 'field_origin_hero_icon', 'label' => __('Badge Icon', 'mlzs'), 'name' => 'origin_hero_icon', 'type' => 'text', 'default_value' => 'map-pin'),
            array('key' => 'field_origin_hero_headline_before', 'label' => __('Headline (before highlight)', 'mlzs'), 'name' => 'origin_hero_headline_before', 'type' => 'text', 'default_value' => 'Our'),
            array('key' => 'field_origin_hero_headline_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'origin_hero_headline_highlight', 'type' => 'text', 'default_value' => 'Campus'),
            array('key' => 'field_origin_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'origin_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Discover the vibrant learning environment at Mount Litera Zee School, Alwar - 5 acres of inspiring spaces designed for holistic education.'),
            array('key' => 'field_origin_tab_overview', 'label' => __('Campus Overview', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_origin_overview_section_image', 'label' => __('Campus / Section Image', 'mlzs'), 'name' => 'origin_overview_section_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => __('Optional. Image shown beside overview (matches origin.html).', 'mlzs')),
            array('key' => 'field_origin_overview_heading', 'label' => __('Card Heading', 'mlzs'), 'name' => 'origin_overview_heading', 'type' => 'text', 'default_value' => 'Campus Overview'),
            array('key' => 'field_origin_overview_location', 'label' => __('Location Subtitle', 'mlzs'), 'name' => 'origin_overview_location', 'type' => 'text', 'default_value' => 'Sirmoli Village, Alwar'),
            array('key' => 'field_origin_overview_icon', 'label' => __('Card Icon', 'mlzs'), 'name' => 'origin_overview_icon', 'type' => 'text', 'default_value' => 'building-2'),
            array('key' => 'field_origin_overview_items', 'label' => __('Overview Items (4)', 'mlzs'), 'name' => 'origin_overview_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_origin_ov_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'map'),
                array('key' => 'field_origin_ov_style', 'label' => __('Icon Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
                array('key' => 'field_origin_ov_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Prime Location'),
                array('key' => 'field_origin_ov_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
            )),
            array('key' => 'field_origin_video1_icon', 'label' => __('Video 1 Block Icon', 'mlzs'), 'name' => 'origin_video1_icon', 'type' => 'text', 'default_value' => 'play-circle'),
            array('key' => 'field_origin_video1_title', 'label' => __('Video 1 Title', 'mlzs'), 'name' => 'origin_video1_title', 'type' => 'text', 'default_value' => 'Campus Tour Video'),
            array('key' => 'field_origin_video1_url', 'label' => __('Video 1 URL (optional)', 'mlzs'), 'name' => 'origin_video1_url', 'type' => 'url', 'instructions' => __('Label and duration are auto-derived from the video.', 'mlzs')),
            array('key' => 'field_origin_video2_icon', 'label' => __('Video 2 Block Icon', 'mlzs'), 'name' => 'origin_video2_icon', 'type' => 'text', 'default_value' => 'video'),
            array('key' => 'field_origin_video2_title', 'label' => __('Video 2 Title', 'mlzs'), 'name' => 'origin_video2_title', 'type' => 'text', 'default_value' => 'Virtual Walkthrough'),
            array('key' => 'field_origin_video2_url', 'label' => __('Video 2 URL (optional)', 'mlzs'), 'name' => 'origin_video2_url', 'type' => 'url', 'instructions' => __('Label and duration are auto-derived from the video.', 'mlzs')),
            array('key' => 'field_origin_tab_gallery', 'label' => __('Campus Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_origin_gallery_icon', 'label' => __('Gallery Badge Icon', 'mlzs'), 'name' => 'origin_gallery_icon', 'type' => 'text', 'default_value' => 'image'),
            array('key' => 'field_origin_gallery_badge', 'label' => __('Gallery Badge', 'mlzs'), 'name' => 'origin_gallery_badge', 'type' => 'text', 'default_value' => 'Photo Gallery'),
            array('key' => 'field_origin_gallery_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'origin_gallery_heading_before', 'type' => 'text', 'default_value' => 'Explore Our'),
            array('key' => 'field_origin_gallery_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'origin_gallery_heading_highlight', 'type' => 'text', 'default_value' => 'Campus'),
            array('key' => 'field_origin_gallery_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'origin_gallery_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Take a visual tour through our state-of-the-art facilities and beautiful campus spaces.'),
            array('key' => 'field_origin_gallery_items', 'label' => __('Gallery Cards (6)', 'mlzs'), 'name' => 'origin_gallery_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 6, 'max' => 6, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_origin_gal_image', 'label' => __('Image', 'mlzs'), 'name' => 'image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_origin_gal_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Academic Building'),
                array('key' => 'field_origin_gal_caption', 'label' => __('Caption', 'mlzs'), 'name' => 'caption', 'type' => 'text', 'default_value' => 'Main campus entrance and academic block'),
            )),
            array('key' => 'field_origin_gallery_more_images', 'label' => __('More Images Grid', 'mlzs'), 'name' => 'origin_gallery_more_images', 'type' => 'gallery', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all', 'min' => 0, 'max' => 0, 'instructions' => __('Additional gallery images (grid below the 6 cards). Matches origin.html lines 470–497.', 'mlzs')),
            array('key' => 'field_origin_gallery_btn_link', 'label' => __('View Complete Gallery Button Link', 'mlzs'), 'name' => 'origin_gallery_btn_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label.', 'mlzs')),
            array('key' => 'field_origin_tab_features', 'label' => __('Campus Features (4)', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_origin_features_heading_before', 'label' => __('Heading (before highlight)', 'mlzs'), 'name' => 'origin_features_heading_before', 'type' => 'text', 'default_value' => 'Campus'),
            array('key' => 'field_origin_features_heading_highlight', 'label' => __('Heading (highlighted)', 'mlzs'), 'name' => 'origin_features_heading_highlight', 'type' => 'text', 'default_value' => 'Features'),
            array('key' => 'field_origin_features_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'origin_features_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Discover what makes our campus an ideal learning environment'),
            array('key' => 'field_origin_features_items', 'label' => __('Feature Cards (4)', 'mlzs'), 'name' => 'origin_features_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Feature', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_origin_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'trees'),
                array('key' => 'field_origin_feat_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
                array('key' => 'field_origin_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => '5 Acre Campus'),
                array('key' => 'field_origin_feat_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_origin_tab_cta', 'label' => __('Visit Campus CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_origin_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'origin_cta_heading', 'type' => 'text', 'default_value' => 'Experience Our Campus in Person'),
            array('key' => 'field_origin_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'origin_cta_paragraph', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Schedule a personalized campus tour and see for yourself what makes Mount Litera special.'),
            array('key' => 'field_origin_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'origin_cta_btn1_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Schedule a Tour).', 'mlzs')),
            array('key' => 'field_origin_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'origin_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_origin_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'origin_cta_btn2_link', 'type' => 'link', 'return_format' => 'array', 'instructions' => __('Link Text = button label (e.g. Contact Admissions).', 'mlzs')),
            array('key' => 'field_origin_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'origin_cta_btn2_icon', 'type' => 'text', 'default_value' => 'phone'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'origin.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_origin_field_group');

/**
 * ACF Pro: Principal's Message Page – Hero, Principal info, Message content, Vision (3), CTA
 */
function mlzs_acf_principal_field_group() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group(array(
        'key'                   => 'group_mlzs_principal',
        'title'                 => __('Principal\'s Message Page Sections', 'mlzs'),
        'fields'                => array(
            array('key' => 'field_principal_tab_hero', 'label' => __('Hero Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_principal_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'principal_hero_badge', 'type' => 'text', 'default_value' => 'From the Principal\'s Desk'),
            array('key' => 'field_principal_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'principal_hero_headline', 'type' => 'text', 'default_value' => 'Principal\'s Message'),
            array('key' => 'field_principal_hero_quote', 'label' => __('Quote', 'mlzs'), 'name' => 'principal_hero_quote', 'type' => 'textarea', 'rows' => 2, 'default_value' => '"Education is not preparation for life; education is life itself."'),
            array('key' => 'field_principal_hero_intro', 'label' => __('Intro Paragraph', 'mlzs'), 'name' => 'principal_hero_intro', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Welcome to Mount Litera Zee School, Alwar - where we believe in nurturing minds, building character, and shaping futures. As Principal, I am honored to share our vision and commitment to excellence in education.'),
            array('key' => 'field_principal_name', 'label' => __('Principal Name', 'mlzs'), 'name' => 'principal_name', 'type' => 'text', 'default_value' => 'Abhishek Srivastava', 'instructions' => __('Initials are auto-derived from name (e.g. Abhishek Srivastava → AS).', 'mlzs')),
            array('key' => 'field_principal_title', 'label' => __('Principal Title', 'mlzs'), 'name' => 'principal_title', 'type' => 'text', 'default_value' => 'Principal'),
            array('key' => 'field_principal_school', 'label' => __('School Name', 'mlzs'), 'name' => 'principal_school', 'type' => 'text', 'default_value' => 'Mount Litera Zee School, Alwar'),
            array('key' => 'field_principal_hero_traits', 'label' => __('Hero Traits (3)', 'mlzs'), 'name' => 'principal_hero_traits', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add Trait', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_principal_trait_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'graduation-cap'),
                array('key' => 'field_principal_trait_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text', 'default_value' => 'Educational Leadership'),
            )),
            array('key' => 'field_principal_tab_sidebar', 'label' => __('Principal Sidebar', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_principal_photo', 'label' => __('Principal Photo', 'mlzs'), 'name' => 'principal_photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => __('Optional. If empty, initials are shown.', 'mlzs')),
            array('key' => 'field_principal_leadership_heading', 'label' => __('Leadership Philosophy Heading', 'mlzs'), 'name' => 'principal_leadership_heading', 'type' => 'text', 'default_value' => 'Leadership Philosophy'),
            array('key' => 'field_principal_leadership_para', 'label' => __('Leadership Paragraph', 'mlzs'), 'name' => 'principal_leadership_para', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Believing in the potential of every child and creating environments where they can discover and develop their unique talents.'),
            array('key' => 'field_principal_core_beliefs', 'label' => __('Core Beliefs (4)', 'mlzs'), 'name' => 'principal_core_beliefs', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Belief', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_principal_belief_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text', 'default_value' => 'Every child is unique and gifted'),
            )),
            array('key' => 'field_principal_tab_message', 'label' => __('Message Content', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_principal_welcome_heading', 'label' => __('Welcome Heading', 'mlzs'), 'name' => 'principal_welcome_heading', 'type' => 'text', 'default_value' => 'Welcome to Our School Family'),
            array('key' => 'field_principal_welcome_icon', 'label' => __('Welcome Icon', 'mlzs'), 'name' => 'principal_welcome_icon', 'type' => 'text', 'default_value' => 'school'),
            array('key' => 'field_principal_welcome_highlight', 'label' => __('Welcome Highlight (box)', 'mlzs'), 'name' => 'principal_welcome_highlight', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_principal_welcome_para', 'label' => __('Welcome Paragraph', 'mlzs'), 'name' => 'principal_welcome_para', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_principal_skills_heading', 'label' => __('21st Century Heading', 'mlzs'), 'name' => 'principal_skills_heading', 'type' => 'text', 'default_value' => 'Preparing for the 21st Century'),
            array('key' => 'field_principal_skills_icon', 'label' => __('21st Century Icon', 'mlzs'), 'name' => 'principal_skills_icon', 'type' => 'text', 'default_value' => 'zap'),
            array('key' => 'field_principal_skills_intro', 'label' => __('21st Century Intro', 'mlzs'), 'name' => 'principal_skills_intro', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_principal_skills_cards', 'label' => __('Skill Cards (4)', 'mlzs'), 'name' => 'principal_skills_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_principal_skill_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_principal_skill_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_principal_skill_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Critical Thinking'),
                array('key' => 'field_principal_skill_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_principal_commitment_heading', 'label' => __('Commitment Heading', 'mlzs'), 'name' => 'principal_commitment_heading', 'type' => 'text', 'default_value' => 'Our Educational Commitment'),
            array('key' => 'field_principal_commitment_icon', 'label' => __('Commitment Icon', 'mlzs'), 'name' => 'principal_commitment_icon', 'type' => 'text', 'default_value' => 'target'),
            array('key' => 'field_principal_commitment_items', 'label' => __('Commitment Items (3)', 'mlzs'), 'name' => 'principal_commitment_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Item', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_principal_commit_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'check'),
                array('key' => 'field_principal_commit_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent'), 'default_value' => 'primary'),
                array('key' => 'field_principal_commit_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Experiential Learning'),
                array('key' => 'field_principal_commit_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
            )),
            array('key' => 'field_principal_closing_heading', 'label' => __('Closing Heading', 'mlzs'), 'name' => 'principal_closing_heading', 'type' => 'text', 'default_value' => 'A Personal Invitation'),
            array('key' => 'field_principal_closing_para', 'label' => __('Closing Paragraph', 'mlzs'), 'name' => 'principal_closing_para', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_principal_closing_signature', 'label' => __('Closing Signature', 'mlzs'), 'name' => 'principal_closing_signature', 'type' => 'text', 'default_value' => 'Abhishek Srivastava'),
            array('key' => 'field_principal_closing_title', 'label' => __('Closing Title', 'mlzs'), 'name' => 'principal_closing_title', 'type' => 'text', 'default_value' => 'Principal'),
            array('key' => 'field_principal_closing_school', 'label' => __('Closing School', 'mlzs'), 'name' => 'principal_closing_school', 'type' => 'text', 'default_value' => 'Mount Litera Zee School, Alwar'),
            array('key' => 'field_principal_closing_exp_label', 'label' => __('Experience Label', 'mlzs'), 'name' => 'principal_closing_exp_label', 'type' => 'text', 'default_value' => 'Years of Educational Leadership Experience'),
            array('key' => 'field_principal_tab_vision', 'label' => __('Vision Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_principal_vision_heading', 'label' => __('Vision Heading', 'mlzs'), 'name' => 'principal_vision_heading', 'type' => 'text', 'default_value' => 'Our Vision for Every Student'),
            array('key' => 'field_principal_vision_subtext', 'label' => __('Vision Subtext', 'mlzs'), 'name' => 'principal_vision_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'At Mount Litera Zee School, we envision our students as future leaders equipped with knowledge, character, and compassion'),
            array('key' => 'field_principal_vision_items', 'label' => __('Vision Cards (3)', 'mlzs'), 'name' => 'principal_vision_items', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_principal_vision_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'book-open'),
                array('key' => 'field_principal_vision_gradient', 'label' => __('Gradient', 'mlzs'), 'name' => 'gradient', 'type' => 'select', 'choices' => array('primary' => 'Primary to Primary Light', 'secondary' => 'Secondary to Accent', 'accent' => 'Primary Light to Secondary'), 'default_value' => 'primary'),
                array('key' => 'field_principal_vision_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text', 'default_value' => 'Academic Excellence'),
                array('key' => 'field_principal_vision_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_principal_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_principal_cta_badge', 'label' => __('CTA Badge', 'mlzs'), 'name' => 'principal_cta_badge', 'type' => 'text', 'default_value' => 'Experience Our Campus'),
            array('key' => 'field_principal_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'principal_cta_heading', 'type' => 'text', 'default_value' => 'Visit Us and See the Difference'),
            array('key' => 'field_principal_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'principal_cta_para', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_principal_cta_btn1_link', 'label' => __('Button 1 Link', 'mlzs'), 'name' => 'principal_cta_btn1_link', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_principal_cta_btn1_icon', 'label' => __('Button 1 Icon', 'mlzs'), 'name' => 'principal_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar'),
            array('key' => 'field_principal_cta_btn2_link', 'label' => __('Button 2 Link', 'mlzs'), 'name' => 'principal_cta_btn2_link', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_principal_cta_btn2_icon', 'label' => __('Button 2 Icon', 'mlzs'), 'name' => 'principal_cta_btn2_icon', 'type' => 'text', 'default_value' => 'message-circle'),
        ),
        'location' => array(
            array(array('param' => 'page_template', 'operator' => '==', 'value' => 'principal.php')),
        ),
    ));
}
add_action('acf/init', 'mlzs_acf_principal_field_group');

/**
 * ACF Pro: Reach Us Page – Hero, Contact & Location, Quick Actions, Map, Transportation
 */
function mlzs_acf_reach_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_reach',
        'title' => __('Reach Us Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_reach_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_reach_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'reach_hero_badge', 'type' => 'text', 'default_value' => 'Get in Touch'),
            array('key' => 'field_reach_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'reach_hero_headline', 'type' => 'text', 'default_value' => 'Reach'),
            array('key' => 'field_reach_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'reach_hero_highlight', 'type' => 'text', 'default_value' => 'Us'),
            array('key' => 'field_reach_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'reach_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Connect with us at our campus or city offices. We\'re here to assist you with admissions, queries, and more.'),
            array('key' => 'field_reach_tab_contact', 'label' => __('Contact & Location', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_reach_bg_image', 'label' => __('Section Background Image', 'mlzs'), 'name' => 'reach_bg_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_reach_campus_title', 'label' => __('Main Campus Title', 'mlzs'), 'name' => 'reach_campus_title', 'type' => 'text', 'default_value' => 'Main Campus'),
            array('key' => 'field_reach_campus_address', 'label' => __('Campus Address', 'mlzs'), 'name' => 'reach_campus_address', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_reach_campus_phone', 'label' => __('Campus Phone', 'mlzs'), 'name' => 'reach_campus_phone', 'type' => 'text'),
            array('key' => 'field_reach_campus_emails', 'label' => __('Campus Emails (one per line)', 'mlzs'), 'name' => 'reach_campus_emails', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_reach_city_offices', 'label' => __('City Offices (2)', 'mlzs'), 'name' => 'reach_city_offices', 'type' => 'repeater', 'layout' => 'block', 'min' => 2, 'max' => 2, 'button_label' => __('Add Office', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_reach_office_title', 'label' => __('Office Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_reach_office_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'building'),
                array('key' => 'field_reach_office_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'accent'),
                array('key' => 'field_reach_office_address', 'label' => __('Address', 'mlzs'), 'name' => 'address', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_reach_office_phone', 'label' => __('Phone', 'mlzs'), 'name' => 'phone', 'type' => 'text'),
                array('key' => 'field_reach_office_emails', 'label' => __('Emails (one per line)', 'mlzs'), 'name' => 'emails', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_reach_quick_cards', 'label' => __('Quick Action Cards (4)', 'mlzs'), 'name' => 'reach_quick_cards', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_reach_qc_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'phone-call'),
                array('key' => 'field_reach_qc_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_reach_qc_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'subtext', 'type' => 'text'),
                array('key' => 'field_reach_qc_link', 'label' => __('Link or Text', 'mlzs'), 'name' => 'link', 'type' => 'link', 'return_format' => 'array'),
                array('key' => 'field_reach_qc_style', 'label' => __('Color Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_reach_map_heading', 'label' => __('Map Section Heading', 'mlzs'), 'name' => 'reach_map_heading', 'type' => 'text', 'default_value' => 'View on Map'),
            array('key' => 'field_reach_map_subtext', 'label' => __('Map Subtext', 'mlzs'), 'name' => 'reach_map_subtext', 'type' => 'text', 'default_value' => 'Find our campus location easily. Click for directions.'),
            array('key' => 'field_reach_map', 'label' => __('Campus Location (Map)', 'mlzs'), 'name' => 'reach_map', 'type' => 'google_map', 'instructions' => __('Search and select the campus location. Address will be used for the map bar and copy; embed and Get Directions link are generated automatically.', 'mlzs'), 'center_lat' => '27.6371647', 'center_lng' => '76.6359878', 'zoom' => 15, 'height' => 400),
            array('key' => 'field_reach_transport', 'label' => __('Transportation (3)', 'mlzs'), 'name' => 'reach_transport', 'type' => 'repeater', 'layout' => 'row', 'min' => 3, 'max' => 3, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_reach_trans_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'car'),
                array('key' => 'field_reach_trans_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_reach_trans_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_reach_trans_style', 'label' => __('Color Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'reach.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_reach_field_group');

/**
 * ACF Pro: Safety & Security Page – Hero, Philosophy, Features, CTA
 */
function mlzs_acf_security_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_security',
        'title' => __('Safety & Security Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_sec_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sec_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'security_hero_badge', 'type' => 'text', 'default_value' => 'Priority #1'),
            array('key' => 'field_sec_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'security_hero_headline', 'type' => 'text', 'default_value' => 'Safety &'),
            array('key' => 'field_sec_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'security_hero_highlight', 'type' => 'text', 'default_value' => 'Security'),
            array('key' => 'field_sec_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'security_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Ensuring a protected environment where every child feels secure to learn, grow, and thrive'),
            array('key' => 'field_sec_tab_philosophy', 'label' => __('Safety Philosophy', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sec_philo_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'security_philo_heading', 'type' => 'text', 'default_value' => 'Our Safety Philosophy'),
            array('key' => 'field_sec_philo_cards', 'label' => __('Philosophy Cards (2)', 'mlzs'), 'name' => 'security_philo_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 2, 'max' => 2, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_sec_philo_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'heart'),
                array('key' => 'field_sec_philo_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_sec_philo_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 4),
                array('key' => 'field_sec_philo_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_sec_philo_image', 'label' => __('Side Image', 'mlzs'), 'name' => 'security_philo_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_sec_stat_number', 'label' => __('Stat Number (e.g. 100%)', 'mlzs'), 'name' => 'security_stat_number', 'type' => 'text', 'default_value' => '100%'),
            array('key' => 'field_sec_stat_label', 'label' => __('Stat Label', 'mlzs'), 'name' => 'security_stat_label', 'type' => 'text', 'default_value' => 'Safety Commitment'),
            array('key' => 'field_sec_stat_sub', 'label' => __('Stat Subtext', 'mlzs'), 'name' => 'security_stat_sub', 'type' => 'text', 'default_value' => 'Round-the-clock protection'),
            array('key' => 'field_sec_tab_features', 'label' => __('Security Features', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sec_features_heading', 'label' => __('Features Heading', 'mlzs'), 'name' => 'security_features_heading', 'type' => 'text', 'default_value' => 'Security Features'),
            array('key' => 'field_sec_features_subtext', 'label' => __('Features Subtext', 'mlzs'), 'name' => 'security_features_subtext', 'type' => 'text', 'default_value' => 'Multi-layered security systems and protocols ensuring complete protection'),
            array('key' => 'field_sec_features', 'label' => __('Feature Cards (7)', 'mlzs'), 'name' => 'security_features', 'type' => 'repeater', 'layout' => 'block', 'min' => 7, 'max' => 7, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_sec_feat_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'clock'),
                array('key' => 'field_sec_feat_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_sec_feat_para', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 2),
                array('key' => 'field_sec_feat_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_sec_tab_layers', 'label' => __('Multi-Layered Protection', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sec_layers_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'security_layers_heading', 'type' => 'text', 'default_value' => 'Multi-Layered Protection'),
            array('key' => 'field_sec_layers_items', 'label' => __('Bullet Points (6)', 'mlzs'), 'name' => 'security_layers_items', 'type' => 'repeater', 'layout' => 'row', 'min' => 6, 'max' => 6, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_sec_layer_text', 'label' => __('Text', 'mlzs'), 'name' => 'text', 'type' => 'text'),
            )),
            array('key' => 'field_sec_tab_cta', 'label' => __('CTA Section', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sec_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'security_cta_heading', 'type' => 'text', 'default_value' => 'Your Child\'s Safety is Our Priority'),
            array('key' => 'field_sec_cta_para', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'security_cta_para', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_sec_cta_btn1', 'label' => __('Button 1 (e.g. Download Manual)', 'mlzs'), 'name' => 'security_cta_btn1', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_sec_cta_btn2', 'label' => __('Button 2 (e.g. Contact Officer)', 'mlzs'), 'name' => 'security_cta_btn2', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_sec_cta_stats', 'label' => __('CTA Stat Boxes (4)', 'mlzs'), 'name' => 'security_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_sec_stat_num', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_sec_stat_lab', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
                array('key' => 'field_sec_stat_color', 'label' => __('Color', 'mlzs'), 'name' => 'color', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light', 'accent-dark' => 'Accent Dark'), 'default_value' => 'primary'),
            )),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'security.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_security_field_group');

/**
 * ACF Pro: Sitemap Page – Hero only. Page list is auto-generated from all published pages.
 */
function mlzs_acf_sitemap_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_sitemap',
        'title' => __('Sitemap Page (Hero)', 'mlzs'),
        'fields' => array(
            array('key' => 'field_sitemap_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sitemap_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'sitemap_hero_badge', 'type' => 'text', 'default_value' => 'Site Map'),
            array('key' => 'field_sitemap_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'sitemap_hero_headline', 'type' => 'text', 'default_value' => 'Site'),
            array('key' => 'field_sitemap_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'sitemap_hero_highlight', 'type' => 'text', 'default_value' => 'Map'),
            array('key' => 'field_sitemap_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'sitemap_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Explore all pages of Mount Litera Zee School website. Find information about academics, facilities, admissions, and more.'),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'sitemap.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_sitemap_field_group');

/**
 * ACF Pro: Sports Page – Hero, Overview, Philosophy, Facilities, Gallery
 */
function mlzs_acf_sports_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_sports',
        'title' => __('Sports Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_sports_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sports_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'sports_hero_badge', 'type' => 'text', 'default_value' => 'Athletics & Fitness'),
            array('key' => 'field_sports_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'sports_hero_headline', 'type' => 'text', 'default_value' => 'Games &'),
            array('key' => 'field_sports_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'sports_hero_highlight', 'type' => 'text', 'default_value' => 'Sports'),
            array('key' => 'field_sports_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'sports_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Fostering all-round development through diverse sporting activities and healthy competition'),
            array('key' => 'field_sports_tab_overview', 'label' => __('Overview', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sports_overview_heading', 'label' => __('Overview Heading', 'mlzs'), 'name' => 'sports_overview_heading', 'type' => 'text', 'default_value' => 'Building Champions'),
            array('key' => 'field_sports_card1_text', 'label' => __('Card 1 Text', 'mlzs'), 'name' => 'sports_card1_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_sports_card2_text', 'label' => __('Card 2 Text', 'mlzs'), 'name' => 'sports_card2_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_sports_stat1_number', 'label' => __('Stat 1 Number', 'mlzs'), 'name' => 'sports_stat1_number', 'type' => 'text', 'default_value' => '12+'),
            array('key' => 'field_sports_stat1_label', 'label' => __('Stat 1 Label', 'mlzs'), 'name' => 'sports_stat1_label', 'type' => 'text', 'default_value' => 'Sports Activities'),
            array('key' => 'field_sports_stat2_number', 'label' => __('Stat 2 Number', 'mlzs'), 'name' => 'sports_stat2_number', 'type' => 'text', 'default_value' => '100%'),
            array('key' => 'field_sports_stat2_label', 'label' => __('Stat 2 Label', 'mlzs'), 'name' => 'sports_stat2_label', 'type' => 'text', 'default_value' => 'Student Participation'),
            array('key' => 'field_sports_overview_image', 'label' => __('Overview Image', 'mlzs'), 'name' => 'sports_overview_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_sports_badge_title', 'label' => __('Image Badge Title', 'mlzs'), 'name' => 'sports_badge_title', 'type' => 'text', 'default_value' => 'All-Round Development'),
            array('key' => 'field_sports_badge_subtext', 'label' => __('Image Badge Subtext', 'mlzs'), 'name' => 'sports_badge_subtext', 'type' => 'text', 'default_value' => 'Health & Fitness'),
            array('key' => 'field_sports_tab_philosophy', 'label' => __('Philosophy', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sports_philosophy_heading', 'label' => __('Philosophy Heading', 'mlzs'), 'name' => 'sports_philosophy_heading', 'type' => 'text', 'default_value' => 'Our Sports Philosophy'),
            array('key' => 'field_sports_philosophy_paragraph', 'label' => __('Philosophy Paragraph', 'mlzs'), 'name' => 'sports_philosophy_paragraph', 'type' => 'textarea', 'rows' => 4),
            array('key' => 'field_sports_tab_facilities', 'label' => __('Facilities List', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sports_facilities_badge', 'label' => __('Facilities Badge', 'mlzs'), 'name' => 'sports_facilities_badge', 'type' => 'text', 'default_value' => 'Available Sports'),
            array('key' => 'field_sports_facilities_heading', 'label' => __('Facilities Heading', 'mlzs'), 'name' => 'sports_facilities_heading', 'type' => 'text', 'default_value' => 'Wide Range of Activities'),
            array('key' => 'field_sports_facilities_highlight', 'label' => __('Facilities Highlight Word', 'mlzs'), 'name' => 'sports_facilities_highlight', 'type' => 'text', 'default_value' => 'Activities'),
            array('key' => 'field_sports_facilities_subtext', 'label' => __('Facilities Subtext', 'mlzs'), 'name' => 'sports_facilities_subtext', 'type' => 'text', 'default_value' => 'From outdoor team sports to indoor strategic games, we offer diverse sporting opportunities'),
            array('key' => 'field_sports_items', 'label' => __('Sports Items', 'mlzs'), 'name' => 'sports_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __('Add Sport', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_sports_item_icon', 'label' => __('Icon (Lucide)', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'trophy'),
                array('key' => 'field_sports_item_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_sports_item_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
            )),
            array('key' => 'field_sports_tab_gallery', 'label' => __('Gallery', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_sports_gallery_badge', 'label' => __('Gallery Badge', 'mlzs'), 'name' => 'sports_gallery_badge', 'type' => 'text', 'default_value' => 'Photo Gallery'),
            array('key' => 'field_sports_gallery_heading', 'label' => __('Gallery Heading', 'mlzs'), 'name' => 'sports_gallery_heading', 'type' => 'text', 'default_value' => 'Sports Gallery'),
            array('key' => 'field_sports_gallery_highlight', 'label' => __('Gallery Highlight Word', 'mlzs'), 'name' => 'sports_gallery_highlight', 'type' => 'text', 'default_value' => 'Gallery'),
            array('key' => 'field_sports_gallery_subtext', 'label' => __('Gallery Subtext', 'mlzs'), 'name' => 'sports_gallery_subtext', 'type' => 'text', 'default_value' => 'Capturing moments of excellence, teamwork, and achievement in our sporting activities'),
            array('key' => 'field_sports_gallery_images', 'label' => __('Gallery Images', 'mlzs'), 'name' => 'sports_gallery_images', 'type' => 'gallery', 'return_format' => 'array', 'preview_size' => 'medium'),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'sports.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_sports_field_group');

/**
 * ACF Pro: Spiritual Programme Page – Hero, Intro, Daily Practices, Programme List, Benefits, CTA
 */
function mlzs_acf_spritual_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_spritual',
        'title' => __('Spiritual Programme Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_spritual_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'spritual_hero_badge', 'type' => 'text', 'default_value' => 'Inner Growth'),
            array('key' => 'field_spritual_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'spritual_hero_headline', 'type' => 'text', 'default_value' => 'Spiritual'),
            array('key' => 'field_spritual_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'spritual_hero_highlight', 'type' => 'text', 'default_value' => 'Programme'),
            array('key' => 'field_spritual_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'spritual_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Nurturing inner peace, moral values, and universal harmony through diverse spiritual practices'),
            array('key' => 'field_spritual_tab_intro', 'label' => __('Introduction', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_intro_heading', 'label' => __('Intro Heading', 'mlzs'), 'name' => 'spritual_intro_heading', 'type' => 'text', 'default_value' => 'Interfaith Harmony & Spiritual Development'),
            array('key' => 'field_spritual_intro_paragraph', 'label' => __('Intro Paragraph', 'mlzs'), 'name' => 'spritual_intro_paragraph', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_spritual_faiths', 'label' => __('Four Faiths (4)', 'mlzs'), 'name' => 'spritual_faiths', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_spritual_faith_icon', 'label' => __('Icon (Lucide)', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'sun'),
                array('key' => 'field_spritual_faith_icon_style', 'label' => __('Icon box colour', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('red' => __('Red', 'mlzs'), 'green' => __('Green', 'mlzs'), 'accent' => __('Accent (Amber)', 'mlzs'), 'blue' => __('Blue', 'mlzs')), 'default_value' => 'red'),
                array('key' => 'field_spritual_faith_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_spritual_faith_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'subtitle', 'type' => 'text'),
            )),
            array('key' => 'field_spritual_tab_practices', 'label' => __('Daily Practices', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_practices_heading', 'label' => __('Section Heading', 'mlzs'), 'name' => 'spritual_practices_heading', 'type' => 'text', 'default_value' => 'Daily Spiritual Practices'),
            array('key' => 'field_spritual_practices_subtext', 'label' => __('Section Subtext', 'mlzs'), 'name' => 'spritual_practices_subtext', 'type' => 'text', 'default_value' => 'Regular activities that nurture spiritual growth and moral development'),
            array('key' => 'field_spritual_practice_cards', 'label' => __('Practice Cards (2)', 'mlzs'), 'name' => 'spritual_practice_cards', 'type' => 'repeater', 'layout' => 'block', 'min' => 2, 'max' => 2, 'button_label' => __('Add Card', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_spritual_pc_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'sunrise'),
                array('key' => 'field_spritual_pc_icon_style', 'label' => __('Icon box colour', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('primary' => __('Primary', 'mlzs'), 'accent' => __('Accent', 'mlzs')), 'default_value' => 'primary'),
                array('key' => 'field_spritual_pc_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_spritual_pc_items', 'label' => __('Items', 'mlzs'), 'name' => 'items', 'type' => 'repeater', 'layout' => 'row', 'sub_fields' => array(
                    array('key' => 'field_spritual_pci_icon_style', 'label' => __('Item icon colour', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('green' => __('Green', 'mlzs'), 'blue' => __('Blue', 'mlzs'), 'purple' => __('Purple', 'mlzs'), 'indigo' => __('Indigo', 'mlzs')), 'default_value' => 'green'),
                    array('key' => 'field_spritual_pci_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'mic'),
                    array('key' => 'field_spritual_pci_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_spritual_pci_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
                )),
            )),
            array('key' => 'field_spritual_tab_programme', 'label' => __('Programme List', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_programme_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'spritual_programme_heading', 'type' => 'text', 'default_value' => 'Complete Spiritual Programme'),
            array('key' => 'field_spritual_programme_items', 'label' => __('Programme Items', 'mlzs'), 'name' => 'spritual_programme_items', 'type' => 'repeater', 'layout' => 'row', 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_spritual_pi_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'book-open'),
                array('key' => 'field_spritual_pi_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_spritual_pi_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_spritual_pi_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
            )),
            array('key' => 'field_spritual_tab_benefits', 'label' => __('Benefits', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_benefits', 'label' => __('Benefit Cards (3)', 'mlzs'), 'name' => 'spritual_benefits', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_spritual_ben_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'brain'),
                array('key' => 'field_spritual_ben_icon_style', 'label' => __('Icon colour', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('primary' => __('Primary', 'mlzs'), 'accent' => __('Accent', 'mlzs'), 'primary-light' => __('Primary Light', 'mlzs')), 'default_value' => 'primary'),
                array('key' => 'field_spritual_ben_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_spritual_ben_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3),
            )),
            array('key' => 'field_spritual_tab_cta', 'label' => __('CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_spritual_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'spritual_cta_heading', 'type' => 'text', 'default_value' => 'Join Our Spiritual Journey'),
            array('key' => 'field_spritual_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'spritual_cta_paragraph', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_spritual_cta_btn1', 'label' => __('Button 1', 'mlzs'), 'name' => 'spritual_cta_btn1', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_spritual_cta_btn2', 'label' => __('Button 2', 'mlzs'), 'name' => 'spritual_cta_btn2', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_spritual_cta_stats', 'label' => __('Stats (4)', 'mlzs'), 'name' => 'spritual_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_spritual_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_spritual_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'spritual.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_spritual_field_group');

/**
 * ACF Pro: Teacher Training Page – Hero, Workshops (2), Key Outcomes, CTA
 */
function mlzs_acf_teacher_training_field_group() {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key' => 'group_mlzs_teacher_training',
        'title' => __('Teacher Training Page Sections', 'mlzs'),
        'fields' => array(
            array('key' => 'field_tt_tab_hero', 'label' => __('Hero', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tt_hero_icon', 'label' => __('Hero badge icon', 'mlzs'), 'name' => 'teacher_training_hero_icon', 'type' => 'text', 'default_value' => 'users', 'instructions' => __('Lucide icon name (e.g. users, graduation-cap).', 'mlzs')),
            array('key' => 'field_tt_hero_badge', 'label' => __('Badge Text', 'mlzs'), 'name' => 'teacher_training_hero_badge', 'type' => 'text', 'default_value' => 'Professional Development'),
            array('key' => 'field_tt_hero_headline', 'label' => __('Headline', 'mlzs'), 'name' => 'teacher_training_hero_headline', 'type' => 'text', 'default_value' => 'Teacher'),
            array('key' => 'field_tt_hero_highlight', 'label' => __('Headline (highlighted)', 'mlzs'), 'name' => 'teacher_training_hero_highlight', 'type' => 'text', 'default_value' => 'Training'),
            array('key' => 'field_tt_hero_subtext', 'label' => __('Subtext', 'mlzs'), 'name' => 'teacher_training_hero_subtext', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Empowering educators through continuous professional development and training workshops'),
            array('key' => 'field_tt_tab_workshop1', 'label' => __('Workshop 1', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tt_w1_icon', 'label' => __('Section icon', 'mlzs'), 'name' => 'teacher_training_w1_icon', 'type' => 'text', 'default_value' => 'book-open', 'instructions' => __('Lucide icon name (e.g. book-open, library).', 'mlzs')),
            array('key' => 'field_tt_w1_title', 'label' => __('Title', 'mlzs'), 'name' => 'teacher_training_w1_title', 'type' => 'text'),
            array('key' => 'field_tt_w1_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'teacher_training_w1_subtitle', 'type' => 'text'),
            array('key' => 'field_tt_w1_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'teacher_training_w1_paragraph', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_tt_w1_highlight', 'label' => __('Highlight box text', 'mlzs'), 'name' => 'teacher_training_w1_highlight', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_tt_w1_image', 'label' => __('Image', 'mlzs'), 'name' => 'teacher_training_w1_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_tt_w1_badge', 'label' => __('Badge text', 'mlzs'), 'name' => 'teacher_training_w1_badge', 'type' => 'text', 'default_value' => '4 Teachers Attended'),
            array('key' => 'field_tt_w1_sessions', 'label' => __('Sessions (3)', 'mlzs'), 'name' => 'teacher_training_w1_sessions', 'type' => 'repeater', 'layout' => 'block', 'min' => 3, 'max' => 3, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tt_w1_sess_num', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_tt_w1_sess_style', 'label' => __('Number style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent', 'primary-light' => 'Primary Light'), 'default_value' => 'primary'),
                array('key' => 'field_tt_w1_sess_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tt_w1_sess_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_tt_tab_workshop2', 'label' => __('Workshop 2', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tt_w2_icon', 'label' => __('Section icon', 'mlzs'), 'name' => 'teacher_training_w2_icon', 'type' => 'text', 'default_value' => 'bar-chart-3', 'instructions' => __('Lucide icon name (e.g. bar-chart-3, monitor).', 'mlzs')),
            array('key' => 'field_tt_w2_title', 'label' => __('Title', 'mlzs'), 'name' => 'teacher_training_w2_title', 'type' => 'text'),
            array('key' => 'field_tt_w2_subtitle', 'label' => __('Subtitle', 'mlzs'), 'name' => 'teacher_training_w2_subtitle', 'type' => 'text'),
            array('key' => 'field_tt_w2_paragraph', 'label' => __('Paragraph', 'mlzs'), 'name' => 'teacher_training_w2_paragraph', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_tt_w2_highlight', 'label' => __('Highlight box text', 'mlzs'), 'name' => 'teacher_training_w2_highlight', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_tt_w2_image', 'label' => __('Image', 'mlzs'), 'name' => 'teacher_training_w2_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_tt_w2_badge', 'label' => __('Badge text', 'mlzs'), 'name' => 'teacher_training_w2_badge', 'type' => 'text', 'default_value' => '5 Teachers Attended'),
            array('key' => 'field_tt_w2_focus', 'label' => __('Focus Areas (2)', 'mlzs'), 'name' => 'teacher_training_w2_focus', 'type' => 'repeater', 'layout' => 'block', 'min' => 2, 'max' => 2, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tt_w2_focus_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'edit'),
                array('key' => 'field_tt_w2_focus_style', 'label' => __('Style', 'mlzs'), 'name' => 'style', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'accent' => 'Accent'), 'default_value' => 'primary'),
                array('key' => 'field_tt_w2_focus_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tt_w2_focus_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
            )),
            array('key' => 'field_tt_tab_outcomes', 'label' => __('Key Outcomes', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tt_outcomes_heading', 'label' => __('Heading', 'mlzs'), 'name' => 'teacher_training_outcomes_heading', 'type' => 'text', 'default_value' => 'Key Learning Outcomes'),
            array('key' => 'field_tt_outcomes', 'label' => __('Outcome Cards (4)', 'mlzs'), 'name' => 'teacher_training_outcomes', 'type' => 'repeater', 'layout' => 'block', 'min' => 4, 'max' => 4, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tt_out_icon', 'label' => __('Icon', 'mlzs'), 'name' => 'icon', 'type' => 'text', 'default_value' => 'target'),
                array('key' => 'field_tt_out_icon_style', 'label' => __('Icon colour', 'mlzs'), 'name' => 'icon_style', 'type' => 'select', 'choices' => array('primary' => __('Primary', 'mlzs'), 'primary-light' => __('Primary Light', 'mlzs'), 'accent' => __('Accent', 'mlzs'), 'accent-light' => __('Accent Light', 'mlzs')), 'default_value' => 'primary'),
                array('key' => 'field_tt_out_title', 'label' => __('Title', 'mlzs'), 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_tt_out_description', 'label' => __('Description', 'mlzs'), 'name' => 'description', 'type' => 'text'),
            )),
            array('key' => 'field_tt_tab_cta', 'label' => __('CTA', 'mlzs'), 'name' => '', 'type' => 'tab'),
            array('key' => 'field_tt_cta_heading', 'label' => __('CTA Heading', 'mlzs'), 'name' => 'teacher_training_cta_heading', 'type' => 'text', 'default_value' => 'Continuous Professional Development'),
            array('key' => 'field_tt_cta_paragraph', 'label' => __('CTA Paragraph', 'mlzs'), 'name' => 'teacher_training_cta_paragraph', 'type' => 'textarea', 'rows' => 2),
            array('key' => 'field_tt_cta_btn1_icon', 'label' => __('Button 1 icon', 'mlzs'), 'name' => 'teacher_training_cta_btn1_icon', 'type' => 'text', 'default_value' => 'calendar', 'instructions' => __('Lucide icon name.', 'mlzs')),
            array('key' => 'field_tt_cta_btn1', 'label' => __('Button 1', 'mlzs'), 'name' => 'teacher_training_cta_btn1', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_tt_cta_btn2_icon', 'label' => __('Button 2 icon', 'mlzs'), 'name' => 'teacher_training_cta_btn2_icon', 'type' => 'text', 'default_value' => 'book-open', 'instructions' => __('Lucide icon name.', 'mlzs')),
            array('key' => 'field_tt_cta_btn2', 'label' => __('Button 2', 'mlzs'), 'name' => 'teacher_training_cta_btn2', 'type' => 'link', 'return_format' => 'array'),
            array('key' => 'field_tt_cta_stats', 'label' => __('Stats (4)', 'mlzs'), 'name' => 'teacher_training_cta_stats', 'type' => 'repeater', 'layout' => 'row', 'min' => 4, 'max' => 4, 'button_label' => __('Add', 'mlzs'), 'sub_fields' => array(
                array('key' => 'field_tt_stat_number', 'label' => __('Number', 'mlzs'), 'name' => 'number', 'type' => 'text'),
                array('key' => 'field_tt_stat_label', 'label' => __('Label', 'mlzs'), 'name' => 'label', 'type' => 'text'),
            )),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'teacher_training.php'))),
    ));
}
add_action('acf/init', 'mlzs_acf_teacher_training_field_group');

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
