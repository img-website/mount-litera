<?php
/**
 * Theme setup, WebP conversion, and asset enqueue.
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
 * Convert uploaded image to WebP before saving to media library.
 * Disabled by default: conversion was causing images not to display on many servers (XAMPP/Windows).
 * To enable, add in wp-config.php: define( 'MLZS_CONVERT_UPLOADS_TO_WEBP', true );
 */
function mlzs_convert_upload_to_webp($upload) {
    if (!defined('MLZS_CONVERT_UPLOADS_TO_WEBP') || !MLZS_CONVERT_UPLOADS_TO_WEBP) {
        return $upload;
    }
    if (empty($upload['file']) || empty($upload['type']) || strpos($upload['type'], 'image/') !== 0) {
        return $upload;
    }
    $mime = $upload['type'];
    $allowed = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');
    if (!in_array($mime, $allowed, true)) {
        return $upload;
    }
    if ($mime === 'image/webp') {
        return $upload;
    }
    $file_path = $upload['file'];
    if (!is_file($file_path) || !is_readable($file_path)) {
        return $upload;
    }
    $webp_path = preg_replace('/\.(jpe?g|png|gif)$/i', '.webp', $file_path);
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

    // Tailwind CDN (script loads CSS via CDN) – typography for Privacy/Terms pages
    wp_enqueue_script(
        'tailwindcss',
        'https://cdn.tailwindcss.com?plugins=forms,container-queries,typography',
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
                    typography: ({ theme }) => ({
                        DEFAULT: {
                            css: {
                                fontFamily: theme('fontFamily.body').join(', '),
                                color: theme('colors.slate.900'),
                                maxWidth: 'none',
                                'h1, h2, h3, h4': { fontFamily: theme('fontFamily.display').join(', ') },
                                a: { color: theme('colors.primary'), fontWeight: '500' },
                                'a:hover': { color: theme('colors.primary-dark') },
                                strong: { color: theme('colors.slate.900') },
                            },
                        },
                    }),
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

    // Theme main JS (header scroll, menu toggle, Lucide, Hero/Approach Swiper, Academics tabs, footer contact)
    wp_enqueue_script(
        'mlzs-main',
        $theme_uri . '/assets/Js/main.js',
        array('swiper-bundle', 'lucide-icons'),
        $theme_version,
        true
    );
    wp_localize_script('mlzs-main', 'mlzsAjax', array(
        'url' => admin_url('admin-ajax.php'),
    ));

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
 * Add popup controls in Appearance > Customize.
 */
function mlzs_register_popup_customizer_settings($wp_customize) {
    $wp_customize->add_section('mlzs_popup_settings', array(
        'title'       => __('Site Popup', 'mlzs'),
        'priority'    => 160,
        'description' => __('Configure delayed image popup.', 'mlzs'),
    ));

    $wp_customize->add_setting('mlzs_popup_enabled', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('mlzs_popup_enabled', array(
        'label'   => __('Enable popup', 'mlzs'),
        'section' => 'mlzs_popup_settings',
        'type'    => 'checkbox',
    ));

    $wp_customize->add_setting('mlzs_popup_image_id', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'mlzs_popup_image_id', array(
        'label'       => __('Popup image', 'mlzs'),
        'section'     => 'mlzs_popup_settings',
        'mime_type'   => 'image',
        'button_labels' => array(
            'select'       => __('Select Image', 'mlzs'),
            'change'       => __('Change Image', 'mlzs'),
            'default'      => __('Default', 'mlzs'),
            'remove'       => __('Remove', 'mlzs'),
            'placeholder'  => __('No image selected', 'mlzs'),
            'frame_title'  => __('Select popup image', 'mlzs'),
            'frame_button' => __('Use this image', 'mlzs'),
        ),
    )));

    $wp_customize->add_setting('mlzs_popup_open_delay', array(
        'default'           => 2000,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('mlzs_popup_open_delay', array(
        'label'       => __('Open delay (milliseconds)', 'mlzs'),
        'section'     => 'mlzs_popup_settings',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 30000,
            'step' => 100,
        ),
    ));

    $wp_customize->add_setting('mlzs_popup_display_scope', array(
        'default'           => 'home',
        'sanitize_callback' => 'mlzs_sanitize_popup_scope',
    ));
    $wp_customize->add_control('mlzs_popup_display_scope', array(
        'label'   => __('Show popup on', 'mlzs'),
        'section' => 'mlzs_popup_settings',
        'type'    => 'select',
        'choices' => array(
            'home'     => __('Only home page', 'mlzs'),
            'all'      => __('All pages', 'mlzs'),
            'specific' => __('Specific pages', 'mlzs'),
        ),
    ));

    $wp_customize->add_setting('mlzs_popup_specific_pages', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mlzs_popup_specific_pages', array(
        'label'       => __('Specific page IDs or slugs', 'mlzs'),
        'description' => __('Use comma separated values. Example: 12, 45, about-us, contact', 'mlzs'),
        'section'     => 'mlzs_popup_settings',
        'type'        => 'text',
    ));

    $wp_customize->add_setting('mlzs_popup_click_page_id', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('mlzs_popup_click_page_id', array(
        'label'       => __('Popup click destination page', 'mlzs'),
        'description' => __('When user clicks popup image, it will open selected page.', 'mlzs'),
        'section'     => 'mlzs_popup_settings',
        'type'        => 'dropdown-pages',
    ));
}
add_action('customize_register', 'mlzs_register_popup_customizer_settings');

/**
 * Sanitize popup scope option.
 */
function mlzs_sanitize_popup_scope($value) {
    $allowed = array('home', 'all', 'specific');
    return in_array($value, $allowed, true) ? $value : 'home';
}

/**
 * Resolve whether popup should be shown on current request.
 */
function mlzs_should_show_popup() {
    $scope = get_theme_mod('mlzs_popup_display_scope', 'home');

    if ($scope === 'all') {
        return true;
    }
    if ($scope === 'home') {
        return is_front_page() || is_home();
    }

    $raw_values = (string) get_theme_mod('mlzs_popup_specific_pages', '');
    if ($raw_values === '' || (!is_page() && !is_front_page() && !is_home())) {
        return false;
    }

    $parts = array_filter(array_map('trim', explode(',', $raw_values)));
    if (empty($parts)) {
        return false;
    }

    $page_ids = array();
    $slugs = array();
    foreach ($parts as $part) {
        if (is_numeric($part)) {
            $page_ids[] = (int) $part;
        } else {
            $slugs[] = sanitize_title($part);
        }
    }

    $matches_id = !empty($page_ids) && is_page($page_ids);
    if ($matches_id) {
        return true;
    }

    if (!empty($slugs)) {
        $queried = get_queried_object();
        if ($queried && !empty($queried->post_name) && in_array((string) $queried->post_name, $slugs, true)) {
            return true;
        }
    }

    return false;
}

/**
 * Render delayed image popup in footer.
 */
function mlzs_render_site_popup() {
    if (is_admin() || wp_doing_ajax() || !get_theme_mod('mlzs_popup_enabled', 0)) {
        return;
    }

    $image_id = (int) get_theme_mod('mlzs_popup_image_id', 0);
    if ($image_id <= 0 || !mlzs_should_show_popup()) {
        return;
    }

    $image_url = wp_get_attachment_image_url($image_id, 'full');
    if (!$image_url) {
        return;
    }

    $click_page_id = (int) get_theme_mod('mlzs_popup_click_page_id', 0);
    $click_url = $click_page_id > 0 ? get_permalink($click_page_id) : '';

    $delay = (int) get_theme_mod('mlzs_popup_open_delay', 2000);
    $delay = max(0, min(30000, $delay));
    ?>
    <div class="mlzs-site-popup-backdrop" data-mlzs-popup data-delay="<?php echo esc_attr((string) $delay); ?>" aria-hidden="true">
        <div class="mlzs-site-popup-modal" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e('Promotional popup', 'mlzs'); ?>">
            <button type="button" class="mlzs-site-popup-close" data-mlzs-popup-close aria-label="<?php esc_attr_e('Close popup', 'mlzs'); ?>">
                &times;
            </button>
            <?php if (!empty($click_url)) : ?>
                <a href="<?php echo esc_url($click_url); ?>" class="mlzs-site-popup-link">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr_e('Popup image', 'mlzs'); ?>" class="mlzs-site-popup-image" />
                </a>
            <?php else : ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr_e('Popup image', 'mlzs'); ?>" class="mlzs-site-popup-image" />
            <?php endif; ?>
        </div>
    </div>
    <script>
        (function () {
            var popup = document.querySelector('[data-mlzs-popup]');
            if (!popup) return;

            var modal = popup.querySelector('.mlzs-site-popup-modal');
            var closeBtn = popup.querySelector('[data-mlzs-popup-close]');
            var delay = Number(popup.getAttribute('data-delay') || 0);

            function closePopup() {
                if (!popup.classList.contains('is-visible')) return;
                popup.classList.add('is-hiding');
                popup.classList.remove('is-visible');
                window.setTimeout(function () {
                    popup.style.display = 'none';
                    popup.setAttribute('aria-hidden', 'true');
                }, 320);
            }

            window.setTimeout(function () {
                popup.style.display = 'flex';
                popup.setAttribute('aria-hidden', 'false');
                window.requestAnimationFrame(function () {
                    popup.classList.add('is-visible');
                });
            }, Math.max(0, delay));

            if (closeBtn) {
                closeBtn.addEventListener('click', closePopup);
            }
            popup.addEventListener('click', function (event) {
                if (event.target === popup) {
                    closePopup();
                }
            });
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closePopup();
                }
            });

            if (modal) {
                modal.addEventListener('click', function (event) {
                    event.stopPropagation();
                });
            }
        })();
    </script>
    <?php
}
add_action('wp_footer', 'mlzs_render_site_popup');

/**
 * Output social icon markup: Lucide by default, or custom WhatsApp SVG when icon is "whatsapp".
 * Use same $class as other social icons (e.g. size-5 or w-4 h-4 sm:w-5 sm:h-5).
 *
 * @param string $icon_name Icon name from ACF (e.g. instagram, whatsapp).
 * @param string $class     CSS classes for size (default size-5).
 */
function mlzs_social_icon_svg($icon_name, $class = 'size-5') {
    $icon_name = $icon_name !== null && $icon_name !== '' ? strtolower(trim((string) $icon_name)) : 'circle';
    $brand_svgs = array(
        'whatsapp' => '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" class="%s" xmlns="http://www.w3.org/2000/svg"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg>',
        'instagram' => '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" class="%s" xmlns="http://www.w3.org/2000/svg"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>',
        'facebook' => '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512" class="%s" xmlns="http://www.w3.org/2000/svg"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>',
        'linkedin' => '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" class="%s" xmlns="http://www.w3.org/2000/svg"><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path></svg>',
        'twitter' => '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="%s" xmlns="http://www.w3.org/2000/svg"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path></svg>',
        'x' => '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="%s" xmlns="http://www.w3.org/2000/svg"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path></svg>',
        'youtube' => '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" class="%s" xmlns="http://www.w3.org/2000/svg"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>',
    );

    if (isset($brand_svgs[$icon_name])) {
        echo sprintf($brand_svgs[$icon_name], esc_attr($class));
        return;
    }
    echo '<i data-lucide="' . esc_attr($icon_name) . '" class="' . esc_attr($class) . '"></i>';
}
