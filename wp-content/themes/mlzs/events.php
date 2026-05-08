<?php
/**
 * Template Name: Events Page
 * Events: Hero, Upcoming Events tab, Events tab - ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// --- Hero ---
$hero_badge     = $opt ? get_field('events_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('events_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('events_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('events_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('events_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'School Calendar';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'calendar-days';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'School';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Events';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Stay updated with all upcoming and completed school events at Mount Litera Zee School.';

// --- Event section ---
$section_icon     = $opt ? get_field('events_section_icon', $page_id) : null;
$section_title    = $opt ? get_field('events_section_title', $page_id) : null;
$section_subtitle = $opt ? get_field('events_section_subtitle', $page_id) : null;
$events_raw       = $opt ? get_field('events_items', $page_id) : null;

$section_icon     = (is_string($section_icon) && trim($section_icon) !== '') ? trim($section_icon) : 'calendar-check-2';
$section_title    = ($section_title !== '' && $section_title !== null) ? (string) $section_title : 'Events';
$section_subtitle = ($section_subtitle !== '' && $section_subtitle !== null) ? (string) $section_subtitle : 'Explore upcoming and completed school events';

$events_raw = is_array($events_raw) ? $events_raw : array();
$today_ymd = (int) current_time('Ymd');
$upcoming_events = array();
$past_or_current_events = array();

foreach ($events_raw as $event_item) {
    $date_raw = isset($event_item['event_date']) ? (string) $event_item['event_date'] : '';
    $date_ymd = (int) preg_replace('/[^0-9]/', '', $date_raw);
    if ($date_ymd <= 0) {
        continue;
    }

    $event_item['_date_ymd'] = $date_ymd;
    if ($date_ymd > $today_ymd) {
        $upcoming_events[] = $event_item;
    } else {
        $past_or_current_events[] = $event_item;
    }
}

usort($upcoming_events, function ($a, $b) {
    return (int) $a['_date_ymd'] <=> (int) $b['_date_ymd'];
});

usort($past_or_current_events, function ($a, $b) {
    return (int) $b['_date_ymd'] <=> (int) $a['_date_ymd'];
});

if (!function_exists('mlzs_events_image_url')) {
    function mlzs_events_image_url($image_field) {
        if (is_array($image_field) && !empty($image_field['url'])) {
            return (string) $image_field['url'];
        }
        if (is_numeric($image_field)) {
            return wp_get_attachment_image_url((int) $image_field, 'full') ?: '';
        }
        if (is_string($image_field)) {
            return $image_field;
        }
        return '';
    }
}

if (!function_exists('mlzs_events_date_label')) {
    function mlzs_events_date_label($date_ymd) {
        $dt = DateTime::createFromFormat('Ymd', (string) $date_ymd, wp_timezone());
        if (!$dt) {
            return '';
        }
        return wp_date('d M Y', $dt->getTimestamp());
    }
}
?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_sub); ?>
                </p>
            </div>
        </div>
    </section>

    <section class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-20 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                    <i data-lucide="<?php echo esc_attr($section_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 text-primary"></i>
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900"><?php echo esc_html($section_title); ?></h2>
                    <p class="text-sm sm:text-base text-gray-600"><?php echo esc_html($section_subtitle); ?></p>
                </div>
            </div>

            <div class="mb-6 sm:mb-8 overflow-x-auto">
                <div class="flex space-x-2 pb-2">
                    <button type="button" class="events-tab px-4 py-2 sm:px-6 sm:py-3 rounded-full font-bold text-xs sm:text-sm transition-all whitespace-nowrap bg-primary text-white" data-events-tab="upcoming-events">
                        <?php esc_html_e('Upcoming Events', 'mlzs'); ?>
                    </button>
                    <button type="button" class="events-tab px-4 py-2 sm:px-6 sm:py-3 rounded-full font-bold text-xs sm:text-sm transition-all whitespace-nowrap bg-gray-100 text-gray-700 hover:bg-gray-200" data-events-tab="all-events">
                        <?php esc_html_e('Events', 'mlzs'); ?>
                    </button>
                </div>
            </div>

            <div class="events-tab-panel" data-events-panel="upcoming-events">
                <?php if (!empty($upcoming_events)) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($upcoming_events as $event_item) :
                            $title = isset($event_item['event_title']) ? (string) $event_item['event_title'] : '';
                            $img = isset($event_item['event_image']) ? $event_item['event_image'] : null;
                            $img_url = mlzs_events_image_url($img);
                            $date_label = mlzs_events_date_label((int) $event_item['_date_ymd']);
                            if ($title === '' || $img_url === '') continue;
                        ?>
                        <article class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-soft hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="overflow-hidden bg-gray-100">
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                            </div>
                            <div class="p-4 sm:p-5">
                                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2"><?php echo esc_html($title); ?></h3>
                                <?php if ($date_label !== '') : ?>
                                <p class="inline-flex items-center gap-2 text-sm font-semibold text-primary">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                    <?php echo esc_html($date_label); ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-soft text-center text-gray-600">
                        <?php esc_html_e('No upcoming events right now.', 'mlzs'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="events-tab-panel hidden" data-events-panel="all-events">
                <?php if (!empty($past_or_current_events)) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($past_or_current_events as $event_item) :
                            $title = isset($event_item['event_title']) ? (string) $event_item['event_title'] : '';
                            $img = isset($event_item['event_image']) ? $event_item['event_image'] : null;
                            $img_url = mlzs_events_image_url($img);
                            $date_label = mlzs_events_date_label((int) $event_item['_date_ymd']);
                            if ($title === '' || $img_url === '') continue;
                        ?>
                        <article class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-soft hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="aspect-[9/12.7] overflow-hidden bg-gray-100">
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                            </div>
                            <div class="p-4 sm:p-5">
                                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2"><?php echo esc_html($title); ?></h3>
                                <?php if ($date_label !== '') : ?>
                                <p class="inline-flex items-center gap-2 text-sm font-semibold text-primary">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                    <?php echo esc_html($date_label); ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-soft text-center text-gray-600">
                        <?php esc_html_e('No events found yet.', 'mlzs'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script>
    (function() {
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined' && lucide.createIcons) {
                lucide.createIcons();
            }

            var tabs = document.querySelectorAll('.events-tab');
            var panels = document.querySelectorAll('.events-tab-panel');
            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    var target = this.getAttribute('data-events-tab');
                    tabs.forEach(function(item) {
                        item.classList.remove('bg-primary', 'text-white');
                        item.classList.add('bg-gray-100', 'text-gray-700');
                    });
                    this.classList.remove('bg-gray-100', 'text-gray-700');
                    this.classList.add('bg-primary', 'text-white');

                    panels.forEach(function(panel) {
                        panel.classList.toggle('hidden', panel.getAttribute('data-events-panel') !== target);
                    });
                });
            });
        });
    })();
    </script>

<?php get_footer(); ?>
