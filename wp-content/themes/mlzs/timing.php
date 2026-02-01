<?php
/**
 * Template Name: School Timing Page
 * School Timing: Hero, School Timings card, Important Persons card, Additional info (3 cards). UI matches timing.html exactly.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('timing_hero_badge', $page_id) : null;
$hero_icon = $opt ? get_field('timing_hero_icon', $page_id) : null;
$hero_before = $opt ? get_field('timing_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('timing_hero_headline_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('timing_hero_subtext', $page_id) : null;

$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'School Information';
$hero_icon = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'clock';
$hero_before = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'School';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Timing';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Find the complete schedule for academic sessions, important contacts, and key personnel at Mount Litera Zee School, Alwar.';

// ——— School Timings Card ———
$timing_title = $opt ? get_field('timing_card_title', $page_id) : null;
$timing_subtitle = $opt ? get_field('timing_card_subtitle', $page_id) : null;
$classes_heading = $opt ? get_field('timing_classes_heading', $page_id) : null;
$summer_label = $opt ? get_field('timing_summer_label', $page_id) : null;
$summer_start = $opt ? get_field('timing_summer_start', $page_id) : null;
$summer_end = $opt ? get_field('timing_summer_end', $page_id) : null;
$summer_caption = $opt ? get_field('timing_summer_caption', $page_id) : null;
$winter_label = $opt ? get_field('timing_winter_label', $page_id) : null;
$winter_start = $opt ? get_field('timing_winter_start', $page_id) : null;
$winter_end = $opt ? get_field('timing_winter_end', $page_id) : null;
$winter_caption = $opt ? get_field('timing_winter_caption', $page_id) : null;
$timing_note = $opt ? get_field('timing_note', $page_id) : null;

$timing_title = ($timing_title !== '' && $timing_title !== null) ? (string) $timing_title : 'School Timings';
$timing_subtitle = ($timing_subtitle !== '' && $timing_subtitle !== null) ? (string) $timing_subtitle : 'Academic Session Schedule';
$classes_heading = ($classes_heading !== '' && $classes_heading !== null) ? (string) $classes_heading : 'Classes I to XII';
$summer_label = ($summer_label !== '' && $summer_label !== null) ? (string) $summer_label : 'Summer';
$summer_start = ($summer_start !== '' && $summer_start !== null) ? (string) $summer_start : '7:30 AM';
$summer_end = ($summer_end !== '' && $summer_end !== null) ? (string) $summer_end : '1:30 PM';
$summer_caption = ($summer_caption !== '' && $summer_caption !== null) ? (string) $summer_caption : 'Morning to Early Afternoon Session';
$winter_label = ($winter_label !== '' && $winter_label !== null) ? (string) $winter_label : 'Winter';
$winter_start = ($winter_start !== '' && $winter_start !== null) ? (string) $winter_start : '8:30 AM';
$winter_end = ($winter_end !== '' && $winter_end !== null) ? (string) $winter_end : '2:00 PM';
$winter_caption = ($winter_caption !== '' && $winter_caption !== null) ? (string) $winter_caption : 'Late Morning to Afternoon Session';
$timing_note = ($timing_note !== '' && $timing_note !== null) ? (string) $timing_note : 'Note: Timings are subject to change during special events, examinations, or unforeseen circumstances. Parents will be notified in advance of any changes.';

// ——— Important Persons Card ———
$persons_title = $opt ? get_field('timing_persons_title', $page_id) : null;
$persons_subtitle = $opt ? get_field('timing_persons_subtitle', $page_id) : null;
$persons_list = $opt ? get_field('timing_persons_list', $page_id) : null;
$guidelines_heading = $opt ? get_field('timing_guidelines_heading', $page_id) : null;
$guidelines_list = $opt ? get_field('timing_guidelines_list', $page_id) : null;

$persons_title = ($persons_title !== '' && $persons_title !== null) ? (string) $persons_title : 'Important Persons';
$persons_subtitle = ($persons_subtitle !== '' && $persons_subtitle !== null) ? (string) $persons_subtitle : 'Key Contacts & Administration';
$guidelines_heading = ($guidelines_heading !== '' && $guidelines_heading !== null) ? (string) $guidelines_heading : 'Contact Guidelines';

$default_persons = array(
    array('title' => 'Principal', 'name' => 'Dr. Vivek Srivastava', 'email' => 'principalalwar.mlzs@gmail.com', 'badge' => 'Head of Institution', 'style' => 'principal'),
    array('title' => 'Dean of Admin', 'name' => 'Mr. Deependra Choudhary', 'email' => 'mlzsalwardm@gmail.com', 'badge' => 'Administration', 'style' => 'admin'),
);
$persons_list = (is_array($persons_list) && !empty($persons_list)) ? $persons_list : $default_persons;

$default_guidelines = array(
    array('text' => 'Please use official email addresses for formal communication'),
    array('text' => 'Allow 24-48 hours for response during working days'),
    array('text' => 'For urgent matters, please contact the school reception'),
);
$guidelines_list = (is_array($guidelines_list) && !empty($guidelines_list)) ? $guidelines_list : $default_guidelines;

// ——— Additional Info Cards ———
$info_cards = $opt ? get_field('timing_info_cards', $page_id) : null;

$default_info = array(
    array('icon' => 'calendar', 'title' => 'Academic Calendar', 'paragraph' => 'Complete academic year schedule including holidays, exams, and special events.', 'style' => 'primary'),
    array('icon' => 'bell', 'title' => 'Notification System', 'paragraph' => 'Stay updated with school announcements through our parent portal and mobile app.', 'style' => 'accent'),
    array('icon' => 'help-circle', 'title' => 'Need Help?', 'paragraph' => 'Contact school reception for immediate assistance or visit our help desk.', 'style' => 'gray'),
);
$info_cards = (is_array($info_cards) && count($info_cards) >= 3) ? $info_cards : $default_info;

$info_style_classes = array(
    'primary' => array('border' => 'border-primary/20', 'gradient' => 'from-primary/5 to-primary/10', 'icon_bg' => 'bg-primary/20', 'icon_text' => 'text-primary'),
    'accent' => array('border' => 'border-accent/20', 'gradient' => 'from-accent/5 to-accent/10', 'icon_bg' => 'bg-accent/20', 'icon_text' => 'text-accent'),
    'gray' => array('border' => 'border-gray-200', 'gradient' => 'from-slate-100 to-gray-100', 'icon_bg' => 'bg-gray-200', 'icon_text' => 'text-gray-600'),
);
?>

    <!-- Hero Banner -->
    <section class="relative px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 bg-gradient-to-br from-primary-dark via-primary to-primary-light overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-64 h-64 rounded-full bg-accent blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-accent-light blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-5 h-5 text-accent"></i>
                    <span class="text-sm font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
                    <?php echo esc_html($hero_before); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-accent-light"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-base sm:text-lg text-slate-200 mb-8 max-w-2xl mx-auto">
                    <?php echo esc_html($hero_subtext); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                
                <!-- School Timing Card -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-soft border border-gray-100 hover:border-primary/20 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center gap-3 mb-6 sm:mb-8">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                            <i data-lucide="clock" class="w-5 h-5 sm:w-6 sm:h-6 text-primary"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900"><?php echo esc_html($timing_title); ?></h2>
                            <p class="text-xs sm:text-sm text-gray-500"><?php echo esc_html($timing_subtitle); ?></p>
                        </div>
                    </div>

                    <div class="mb-6 sm:mb-8">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-primary"></span>
                            <?php echo esc_html($classes_heading); ?>
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            <div class="group relative p-4 sm:p-6 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 hover:border-primary/30 transition-all">
                                <div class="absolute top-3 right-3 sm:top-4 sm:right-4">
                                    <i data-lucide="sun" class="w-5 h-5 sm:w-6 sm:h-6 text-amber-500"></i>
                                </div>
                                <div class="mb-2">
                                    <span class="inline-block px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-full bg-blue-100 text-blue-700 text-[10px] sm:text-xs font-bold uppercase tracking-wide"><?php echo esc_html($summer_label); ?></span>
                                </div>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl sm:text-3xl font-bold text-gray-900"><?php echo esc_html($summer_start); ?></span>
                                    <i data-lucide="arrow-right" class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400"></i>
                                    <span class="text-2xl sm:text-3xl font-bold text-gray-900"><?php echo esc_html($summer_end); ?></span>
                                </div>
                                <p class="text-xs sm:text-sm text-gray-600 mt-3"><?php echo esc_html($summer_caption); ?></p>
                            </div>
                            <div class="group relative p-4 sm:p-6 rounded-xl bg-gradient-to-br from-slate-50 to-gray-50 border border-slate-100 hover:border-primary/30 transition-all">
                                <div class="absolute top-3 right-3 sm:top-4 sm:right-4">
                                    <i data-lucide="snowflake" class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400"></i>
                                </div>
                                <div class="mb-2">
                                    <span class="inline-block px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-full bg-slate-100 text-slate-700 text-[10px] sm:text-xs font-bold uppercase tracking-wide"><?php echo esc_html($winter_label); ?></span>
                                </div>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl sm:text-3xl font-bold text-gray-900"><?php echo esc_html($winter_start); ?></span>
                                    <i data-lucide="arrow-right" class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400"></i>
                                    <span class="text-2xl sm:text-3xl font-bold text-gray-900"><?php echo esc_html($winter_end); ?></span>
                                </div>
                                <p class="text-xs sm:text-sm text-gray-600 mt-3"><?php echo esc_html($winter_caption); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 sm:p-4 rounded-xl bg-primary/5 border border-primary/10">
                        <div class="flex items-start gap-2 sm:gap-3">
                            <i data-lucide="info" class="w-4 h-4 sm:w-5 sm:h-5 text-primary mt-0.5 shrink-0"></i>
                            <div>
                                <p class="text-xs sm:text-sm text-gray-700"><?php echo esc_html($timing_note); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Important Persons Card -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-soft border border-gray-100 hover:border-accent/20 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center gap-3 mb-6 sm:mb-8">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-accent/10 flex items-center justify-center">
                            <i data-lucide="users" class="w-5 h-5 sm:w-6 sm:h-6 text-accent"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900"><?php echo esc_html($persons_title); ?></h2>
                            <p class="text-xs sm:text-sm text-gray-500"><?php echo esc_html($persons_subtitle); ?></p>
                        </div>
                    </div>

                    <div class="space-y-4 sm:space-y-6">
                        <?php foreach ($persons_list as $p) :
                            $p_title = isset($p['title']) ? (string) $p['title'] : '';
                            $p_name = isset($p['name']) ? (string) $p['name'] : '';
                            $p_email = isset($p['email']) ? (string) $p['email'] : '';
                            $p_badge = isset($p['badge']) ? (string) $p['badge'] : '';
                            $p_style = isset($p['style']) ? $p['style'] : 'admin';
                            $is_principal = ($p_style === 'principal');
                        ?>
                        <div class="group p-4 sm:p-6 rounded-xl border border-gray-100 <?php echo $is_principal ? 'hover:border-primary/30 hover:bg-primary/5' : 'hover:border-accent/30 hover:bg-accent/5'; ?> transition-all duration-300">
                            <div class="flex items-start gap-3 sm:gap-4">
                                <div class="relative shrink-0">
                                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-gradient-to-br <?php echo $is_principal ? 'from-primary/20 to-primary/10' : 'from-accent/20 to-accent/10'; ?> flex items-center justify-center border-2 <?php echo $is_principal ? 'border-primary/30' : 'border-accent/30'; ?> group-hover:border-primary/50 transition-colors">
                                        <i data-lucide="<?php echo $is_principal ? 'user-circle' : 'user-check'; ?>" class="w-6 h-6 sm:w-8 sm:h-8 <?php echo $is_principal ? 'text-primary' : 'text-accent'; ?>"></i>
                                    </div>
                                    <?php if ($is_principal) : ?>
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-accent flex items-center justify-center">
                                        <i data-lucide="crown" class="w-2.5 h-2.5 sm:w-3 sm:h-3 text-white"></i>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                        <h3 class="text-lg sm:text-xl font-bold text-gray-900"><?php echo esc_html($p_title); ?></h3>
                                        <?php if ($p_badge !== '') : ?>
                                        <span class="px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-full <?php echo $is_principal ? 'bg-primary/10 text-primary' : 'bg-accent/10 text-accent'; ?> text-[10px] sm:text-xs font-bold uppercase tracking-wide whitespace-nowrap"><?php echo esc_html($p_badge); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-base sm:text-lg font-semibold text-gray-800 mb-2"><?php echo esc_html($p_name); ?></p>
                                    <?php if ($p_email !== '') : ?>
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <i data-lucide="mail" class="w-3.5 h-3.5 sm:w-4 sm:h-4 shrink-0"></i>
                                        <a href="mailto:<?php echo esc_attr($p_email); ?>" class="text-xs sm:text-sm hover:text-primary hover:underline transition-colors break-all"><?php echo esc_html($p_email); ?></a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-6 sm:mt-8 p-3 sm:p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <h4 class="text-xs sm:text-sm font-bold text-gray-900 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i data-lucide="phone-call" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                            <?php echo esc_html($guidelines_heading); ?>
                        </h4>
                        <ul class="space-y-2 text-xs sm:text-sm text-gray-600">
                            <?php foreach ($guidelines_list as $g) :
                                $g_text = isset($g['text']) ? (string) $g['text'] : '';
                                if ($g_text === '') continue;
                            ?>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-0.5 shrink-0"></i>
                                <span><?php echo esc_html($g_text); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="mt-12 sm:mt-16 grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                <?php foreach ($info_cards as $info) :
                    $i_style = isset($info['style']) ? $info['style'] : 'primary';
                    $ic = isset($info_style_classes[$i_style]) ? $info_style_classes[$i_style] : $info_style_classes['primary'];
                    $i_icon = isset($info['icon']) ? trim((string) $info['icon']) : 'calendar';
                    $i_title = isset($info['title']) ? (string) $info['title'] : '';
                    $i_para = isset($info['paragraph']) ? (string) $info['paragraph'] : '';
                ?>
                <div class="p-5 sm:p-6 rounded-2xl bg-gradient-to-br <?php echo esc_attr($ic['gradient']); ?> border <?php echo esc_attr($ic['border']); ?>">
                    <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg <?php echo esc_attr($ic['icon_bg']); ?> flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($i_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 <?php echo esc_attr($ic['icon_text']); ?>"></i>
                        </div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900"><?php echo esc_html($i_title); ?></h3>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-600"><?php echo esc_html($i_para); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
