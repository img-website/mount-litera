<?php
/**
 * Template Name: Spiritual Programme Page
 * Spiritual: Hero, Intro, Daily Practices, Programme List, Benefits, CTA. UI matches spritual.html exactly (font-size, border-radius, rounded).
 */
if (!defined('ABSPATH')) exit;
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge = $opt ? get_field('spritual_hero_badge', $page_id) : null;
$hero_headline = $opt ? get_field('spritual_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('spritual_hero_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('spritual_hero_subtext', $page_id) : null;
$hero_badge = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Inner Growth';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Spiritual';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Programme';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Nurturing inner peace, moral values, and universal harmony through diverse spiritual practices';

// ——— Intro ———
$intro_heading = $opt ? get_field('spritual_intro_heading', $page_id) : null;
$intro_paragraph = $opt ? get_field('spritual_intro_paragraph', $page_id) : null;
$faiths = $opt ? get_field('spritual_faiths', $page_id) : null;
$intro_heading = ($intro_heading !== '' && $intro_heading !== null) ? (string) $intro_heading : 'Interfaith Harmony & Spiritual Development';
$intro_paragraph = ($intro_paragraph !== '' && $intro_paragraph !== null) ? (string) $intro_paragraph : 'Recital of Prayers by students of four different faiths – Hindu, Muslim, Sikh, Christian in morning assembly, fostering unity, respect, and understanding among diverse religious traditions.';
$faith_icon_styles = array('red' => 'bg-red-100 text-red-600', 'green' => 'bg-green-100 text-green-600', 'accent' => 'bg-accent/20 text-accent', 'blue' => 'bg-blue-100 text-blue-600');
$default_faiths = array(
    array('icon' => 'sun', 'icon_style' => 'red', 'title' => 'Hindu', 'subtitle' => 'Prayers & Vedic Chanting'),
    array('icon' => 'moon', 'icon_style' => 'green', 'title' => 'Muslim', 'subtitle' => 'Quran Recitation'),
    array('icon' => 'sword', 'icon_style' => 'accent', 'title' => 'Sikh', 'subtitle' => 'Gurbani & Shabads'),
    array('icon' => 'cross', 'icon_style' => 'blue', 'title' => 'Christian', 'subtitle' => 'Hymns & Prayers'),
);
$faiths = (is_array($faiths) && count($faiths) >= 4) ? $faiths : $default_faiths;

// ——— Daily Practices ———
$practices_heading = $opt ? get_field('spritual_practices_heading', $page_id) : null;
$practices_subtext = $opt ? get_field('spritual_practices_subtext', $page_id) : null;
$practice_cards = $opt ? get_field('spritual_practice_cards', $page_id) : null;
$practices_heading = ($practices_heading !== '' && $practices_heading !== null) ? (string) $practices_heading : 'Daily Spiritual Practices';
$practices_subtext = ($practices_subtext !== '' && $practices_subtext !== null) ? (string) $practices_subtext : 'Regular activities that nurture spiritual growth and moral development';
$practice_card_styles = array('primary' => 'bg-primary/10 text-primary', 'accent' => 'bg-accent/10 text-accent');
$practice_item_styles = array('green' => 'bg-green-100 text-green-600', 'blue' => 'bg-blue-100 text-blue-600', 'purple' => 'bg-purple-100 text-purple-600', 'indigo' => 'bg-indigo-100 text-indigo-600');
$default_practice_cards = array(
    array('icon' => 'sunrise', 'icon_style' => 'primary', 'title' => 'Morning Assembly Activities', 'items' => array(
        array('icon_style' => 'green', 'icon' => 'mic', 'title' => 'Daily Prayers and Assembly Talks', 'description' => 'Starting the day with collective prayers and inspirational talks'),
        array('icon_style' => 'blue', 'icon' => 'lightbulb', 'title' => 'Thought for the Day', 'description' => 'Daily inspirational quotes and philosophical thoughts to ponder'),
    )),
    array('icon' => 'leaf', 'icon_style' => 'accent', 'title' => 'Mindfulness Practices', 'items' => array(
        array('icon_style' => 'purple', 'icon' => 'wind', 'title' => 'Bhajan Singing', 'description' => 'Devotional singing that creates an atmosphere of peace and devotion'),
        array('icon_style' => 'indigo', 'icon' => 'brain', 'title' => 'Pranayama and Meditation', 'description' => 'Breathing exercises and meditation techniques for mental clarity'),
    )),
);
$practice_cards = (is_array($practice_cards) && count($practice_cards) >= 2) ? $practice_cards : $default_practice_cards;

// ——— Programme List ———
$programme_heading = $opt ? get_field('spritual_programme_heading', $page_id) : null;
$programme_items = $opt ? get_field('spritual_programme_items', $page_id) : null;
$programme_heading = ($programme_heading !== '' && $programme_heading !== null) ? (string) $programme_heading : 'Complete Spiritual Programme';
$default_programme = array(
    array('icon' => 'book-open', 'style' => 'primary', 'title' => 'Vedic Chanting', 'description' => 'Learning and reciting ancient Vedic mantras'),
    array('icon' => 'book-open-text', 'style' => 'primary', 'title' => 'Quran Recitation', 'description' => 'Recitation and understanding of Quranic verses'),
    array('icon' => 'users', 'style' => 'primary', 'title' => 'Spiritual Talks', 'description' => 'Discourses by learned spiritual personalities'),
    array('icon' => 'circle', 'style' => 'accent', 'title' => 'Circles of Confidence', 'description' => 'Discussions on Ethical and Spiritual Issues'),
    array('icon' => 'theater', 'style' => 'accent', 'title' => 'Role Plays', 'description' => 'Dramatization of moral stories and ethical dilemmas'),
    array('icon' => 'scale', 'style' => 'accent', 'title' => 'Moral Value Classes', 'description' => 'Structured classes focusing on character building'),
    array('icon' => 'landmark', 'style' => 'primary-light', 'title' => 'Indian Culture Classes', 'description' => 'Learning about India\'s rich cultural heritage'),
    array('icon' => 'brain', 'style' => 'primary-light', 'title' => 'Philosophy Classes', 'description' => 'Understanding Indian philosophical traditions'),
    array('icon' => 'heart', 'style' => 'primary-light', 'title' => 'Universal Values', 'description' => 'Emphasizing compassion, truth, and non-violence'),
);
$programme_items = (is_array($programme_items) && !empty($programme_items)) ? $programme_items : $default_programme;

// ——— Benefits ———
$benefits = $opt ? get_field('spritual_benefits', $page_id) : null;
$benefit_icon_styles = array('primary' => 'bg-primary/10 text-primary', 'accent' => 'bg-accent/10 text-accent', 'primary-light' => 'bg-primary-light/10 text-primary-light');
$default_benefits = array(
    array('icon' => 'brain', 'icon_style' => 'primary', 'title' => 'Inner Peace', 'paragraph' => 'Develops mental calmness, reduces stress, and enhances emotional stability through regular spiritual practices.'),
    array('icon' => 'users', 'icon_style' => 'accent', 'title' => 'Interfaith Harmony', 'paragraph' => 'Promotes respect, understanding, and unity among students from different religious backgrounds.'),
    array('icon' => 'award', 'icon_style' => 'primary-light', 'title' => 'Moral Foundation', 'paragraph' => 'Builds strong character, ethical values, and responsible citizenship from a young age.'),
);
$benefits = (is_array($benefits) && count($benefits) >= 3) ? $benefits : $default_benefits;

// ——— CTA ———
$cta_heading = $opt ? get_field('spritual_cta_heading', $page_id) : null;
$cta_paragraph = $opt ? get_field('spritual_cta_paragraph', $page_id) : null;
$cta_btn1 = $opt ? get_field('spritual_cta_btn1', $page_id) : null;
$cta_btn2 = $opt ? get_field('spritual_cta_btn2', $page_id) : null;
$cta_stats = $opt ? get_field('spritual_cta_stats', $page_id) : null;
$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Join Our Spiritual Journey';
$cta_paragraph = ($cta_paragraph !== '' && $cta_paragraph !== null) ? (string) $cta_paragraph : 'Experience the transformative power of spiritual practices and moral education in shaping well-rounded individuals.';
$cta_btn1_url = $cta_btn1_title = '#';
if (!empty($cta_btn1) && is_array($cta_btn1)) {
    $cta_btn1_url = isset($cta_btn1['url']) ? $cta_btn1['url'] : '#';
    $cta_btn1_title = isset($cta_btn1['title']) && trim($cta_btn1['title']) !== '' ? $cta_btn1['title'] : 'View Programme Schedule';
} else { $cta_btn1_title = 'View Programme Schedule'; }
$cta_btn2_url = $cta_btn2_title = '#';
if (!empty($cta_btn2) && is_array($cta_btn2)) {
    $cta_btn2_url = isset($cta_btn2['url']) ? $cta_btn2['url'] : '#';
    $cta_btn2_title = isset($cta_btn2['title']) && trim($cta_btn2['title']) !== '' ? $cta_btn2['title'] : 'Spiritual Resources';
} else { $cta_btn2_title = 'Spiritual Resources'; }
$default_cta_stats = array(
    array('number' => '4', 'label' => 'Faiths Represented'),
    array('number' => 'Daily', 'label' => 'Practices'),
    array('number' => '10+', 'label' => 'Activities'),
    array('number' => 'All', 'label' => 'Students Included'),
);
$cta_stats = (is_array($cta_stats) && count($cta_stats) >= 4) ? $cta_stats : $default_cta_stats;
?>
    <!-- Hero Section (classes exactly as spritual.html) -->
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-slate-900 px-4 sm:px-6 lg:px-8 pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="heart" class="w-4 h-4 sm:w-5 sm:h-5 text-accent"></i>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 tracking-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame to-tiger-orange"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-slate-200 max-w-3xl mx-auto leading-relaxed">
                    <?php echo esc_html($hero_subtext); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Content Section (classes exactly as spritual.html) -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 md:py-20 bg-background-light">
        <div class="max-w-7xl mx-auto">
            <!-- Introduction -->
            <div class="mb-8 sm:mb-12">
                <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 border border-primary/10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center">
                            <i data-lucide="heart" class="w-6 h-6 text-primary"></i>
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light">
                                <?php echo esc_html($intro_heading); ?>
                            </h2>
                        </div>
                    </div>
                    <p class="text-sm text-text-secondary-light leading-relaxed mb-6">
                        <?php echo esc_html($intro_paragraph); ?>
                    </p>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
                        <?php foreach ($faiths as $f) :
                            $f_icon = isset($f['icon']) && trim($f['icon']) !== '' ? trim($f['icon']) : 'sun';
                            $f_style_key = isset($f['icon_style']) && trim($f['icon_style']) !== '' ? $f['icon_style'] : 'red';
                            $f_style = isset($faith_icon_styles[$f_style_key]) ? $faith_icon_styles[$f_style_key] : $faith_icon_styles['red'];
                            $f_title = isset($f['title']) ? (string) $f['title'] : '';
                            $f_sub = isset($f['subtitle']) ? (string) $f['subtitle'] : '';
                        ?>
                        <div class="bg-white rounded-lg p-4 text-center shadow-sm border border-primary/10">
                            <div class="w-10 h-10 rounded-full <?php echo esc_attr($f_style); ?> flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-5 h-5"></i>
                            </div>
                            <div class="text-sm font-medium text-text-main-light"><?php echo esc_html($f_title); ?></div>
                            <div class="text-xs text-text-secondary-light"><?php echo esc_html($f_sub); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Daily Practices -->
            <div class="mb-8 sm:mb-12">
                <div class="text-center mb-8">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-text-main-light mb-4">
                        Daily Spiritual <span class="text-primary">Practices</span>
                    </h3>
                    <p class="text-sm sm:text-base text-text-secondary-light max-w-2xl mx-auto">
                        <?php echo esc_html($practices_subtext); ?>
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($practice_cards as $card) :
                        $c_icon = isset($card['icon']) && trim($card['icon']) !== '' ? trim($card['icon']) : 'sunrise';
                        $c_style_key = isset($card['icon_style']) && trim($card['icon_style']) !== '' ? $card['icon_style'] : 'primary';
                        $c_style = isset($practice_card_styles[$c_style_key]) ? $practice_card_styles[$c_style_key] : $practice_card_styles['primary'];
                        $c_title = isset($card['title']) ? (string) $card['title'] : '';
                        $c_items = isset($card['items']) && is_array($card['items']) ? $card['items'] : array();
                    ?>
                    <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft border border-border-light">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-lg <?php echo esc_attr($c_style); ?> flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($c_icon); ?>" class="w-6 h-6"></i>
                            </div>
                            <h4 class="text-base sm:text-lg md:text-xl font-bold text-text-main-light"><?php echo esc_html($c_title); ?></h4>
                        </div>
                        <div class="space-y-4">
                            <?php foreach ($c_items as $item) :
                                $i_style_key = isset($item['icon_style']) && trim($item['icon_style']) !== '' ? $item['icon_style'] : 'green';
                                $i_style = isset($practice_item_styles[$i_style_key]) ? $practice_item_styles[$i_style_key] : $practice_item_styles['green'];
                                $i_icon = isset($item['icon']) ? trim($item['icon']) : 'mic';
                                $i_title = isset($item['title']) ? (string) $item['title'] : '';
                                $i_desc = isset($item['description']) ? (string) $item['description'] : '';
                            ?>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full <?php echo esc_attr($i_style); ?> flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="<?php echo esc_attr($i_icon); ?>" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-text-main-light mb-1"><?php echo esc_html($i_title); ?></h5>
                                    <p class="text-sm text-text-secondary-light"><?php echo esc_html($i_desc); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Spiritual Activities List -->
            <div class="mb-8 sm:mb-12">
                <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 border border-primary/10">
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light mb-6 text-center">
                        <?php echo esc_html($programme_heading); ?>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                        <?php
                        $style_icons = array('primary' => 'bg-primary/10 text-primary', 'accent' => 'bg-accent/10 text-accent', 'primary-light' => 'bg-primary-light/10 text-primary-light');
                        foreach (array_chunk($programme_items, 3) as $col) : ?>
                        <div class="space-y-4">
                            <?php foreach ($col as $pi) :
                                $pi_icon = isset($pi['icon']) ? trim($pi['icon']) : 'book-open';
                                $pi_style = isset($pi['style']) && isset($style_icons[$pi['style']]) ? $style_icons[$pi['style']] : $style_icons['primary'];
                                $pi_title = isset($pi['title']) ? (string) $pi['title'] : '';
                                $pi_desc = isset($pi['description']) ? (string) $pi['description'] : '';
                            ?>
                            <div class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full <?php echo esc_attr($pi_style); ?> flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="<?php echo esc_attr($pi_icon); ?>" class="w-3 h-3"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-text-main-light mb-1"><?php echo esc_html($pi_title); ?></h4>
                                    <p class="text-xs sm:text-sm text-text-secondary-light"><?php echo esc_html($pi_desc); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Benefits Section -->
            <div class="mb-8 sm:mb-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($benefits as $b) :
                        $b_icon = isset($b['icon']) ? trim($b['icon']) : 'brain';
                        $b_style_key = isset($b['icon_style']) && trim($b['icon_style']) !== '' ? $b['icon_style'] : 'primary';
                        $b_style = isset($benefit_icon_styles[$b_style_key]) ? $benefit_icon_styles[$b_style_key] : $benefit_icon_styles['primary'];
                        $b_title = isset($b['title']) ? (string) $b['title'] : '';
                        $b_para = isset($b['paragraph']) ? (string) $b['paragraph'] : '';
                    ?>
                    <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft border border-border-light text-center">
                        <div class="w-12 h-12 rounded-lg <?php echo esc_attr($b_style); ?> flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="<?php echo esc_attr($b_icon); ?>" class="w-6 h-6"></i>
                        </div>
                        <h4 class="text-base sm:text-lg font-bold text-text-main-light mb-3"><?php echo esc_html($b_title); ?></h4>
                        <p class="text-sm text-text-secondary-light">
                            <?php echo esc_html($b_para); ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-primary to-primary-dark rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 text-white">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                    <div>
                        <h2 class="text-base sm:text-lg md:text-xl font-bold mb-4"><?php echo esc_html($cta_heading); ?></h2>
                        <p class="text-sm text-white/80 mb-6">
                            <?php echo esc_html($cta_paragraph); ?>
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="<?php echo esc_url($cta_btn1_url); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-primary rounded-full font-bold hover:bg-white/90 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="calendar" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn1_title); ?>
                            </a>
                            <a href="<?php echo esc_url($cta_btn2_url); ?>" class="px-4 py-2 sm:px-6 sm:py-3 bg-white/20 border border-white/30 text-white rounded-full font-bold hover:bg-white/30 transition-all flex items-center justify-center gap-2 group text-sm">
                                <i data-lucide="book-open" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                <?php echo esc_html($cta_btn2_title); ?>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($cta_stats as $s) :
                            $s_num = isset($s['number']) ? (string) $s['number'] : '';
                            $s_lab = isset($s['label']) ? (string) $s['label'] : '';
                        ?>
                        <div class="bg-white/10 rounded-xl p-3 sm:p-4 text-center border border-white/20">
                            <div class="text-base sm:text-lg md:text-xl font-bold mb-2"><?php echo esc_html($s_num); ?></div>
                            <div class="text-xs font-medium text-white/80"><?php echo esc_html($s_lab); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
