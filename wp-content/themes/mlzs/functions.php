<?php
/**
 * Mount Litera Zee School (MLZS) Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
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

    // Theme main JS (header scroll, menu toggle, Lucide init, optional Swiper)
    wp_enqueue_script(
        'mlzs-main',
        $theme_uri . '/assets/js/main.js',
        array('swiper-bundle', 'lucide-icons'),
        $theme_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'mlzs_enqueue_assets');
