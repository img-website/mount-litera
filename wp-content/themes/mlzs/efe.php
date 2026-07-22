<?php
/**
 * Template Name: Eco Friendly Environment Page
 * EFE: Hero, Top 3 Cards, No Smoking Zone, Three Column, World Conservation, Community (ACF dynamic, icons dynamic)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$theme_uri = get_template_directory_uri();
$home_url = home_url('/');
$opt = function_exists('get_field');

$default_list_icon = 'check-circle';

// ——— Hero ———
$hero_badge     = $opt ? get_field('efe_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('efe_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('efe_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('efe_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('efe_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Sustainability Initiative';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'leaf';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Eco Friendly';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Environment';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Committed to creating a sustainable future through innovative environmental practices and community awareness';

// ——— Top 3 Cards ———
$top_cards = $opt ? get_field('efe_top_cards', $page_id) : null;
$default_top = array(
    array('icon' => 'trash-2', 'title' => 'Zero Garbage', 'description' => 'Our school aims at creating a ZERO garbage zone. Dustbins of various colours for segregating garbage at source have been placed at various points. Green coloured dustbin is for Paper and Blue coloured dustbin is for Non-Biodegradable waste and the non-biodegradable waste is picked up by the rag pickers and we do not throw anything in the Municipal Corporation.'),
    array('icon' => 'recycle', 'title' => 'Paper Recycling', 'description' => 'A paper-recycling unit has been functioning in our school premises for the last ten years. It has a capacity of 10 kgs. The waste paper from the green dustbins is recycled and various stationery items like files, folders, envelopes, writing pads, school letterheads, scribbling pads, bags and certificates are made from the recycled paper.'),
    array('icon' => 'palette', 'title' => 'Holding Exhibitions', 'description' => 'Art exhibitions of paper products (made out of waste) as held every year. This is in order to sensitize the children that waste paper can be recycled thus saving our trees. School Nursery: The school has a Nursery, which is maintained by Eco club members. Time and again, potted plants are gifted to our guests because we believe in preservation and not destruction.'),
);
$top_cards = (is_array($top_cards) && count($top_cards) >= 3) ? $top_cards : $default_top;

// ——— No Smoking Zone ———
$smoking_icon   = $opt ? get_field('efe_smoking_icon', $page_id) : null;
$smoking_title  = $opt ? get_field('efe_smoking_title', $page_id) : null;
$smoking_text   = $opt ? get_field('efe_smoking_text', $page_id) : null;
$smoking_b1_icon  = $opt ? get_field('efe_smoking_box1_icon', $page_id) : null;
$smoking_b1_title = $opt ? get_field('efe_smoking_box1_title', $page_id) : null;
$smoking_b1_text  = $opt ? get_field('efe_smoking_box1_text', $page_id) : null;
$smoking_b2_icon  = $opt ? get_field('efe_smoking_box2_icon', $page_id) : null;
$smoking_b2_title = $opt ? get_field('efe_smoking_box2_title', $page_id) : null;
$smoking_b2_text  = $opt ? get_field('efe_smoking_box2_text', $page_id) : null;

$smoking_icon   = (is_string($smoking_icon) && trim($smoking_icon) !== '') ? trim($smoking_icon) : 'ban';
$smoking_title  = ($smoking_title !== '' && $smoking_title !== null) ? (string) $smoking_title : 'No Smoking Zone';
$smoking_text   = ($smoking_text !== '' && $smoking_text !== null) ? (string) $smoking_text : 'We have declared our school as a "No Smoking Zone". All visitors and employees including DTC bus drivers and conductors, are not allowed to smoke within the school premises.';
$smoking_b1_icon  = (is_string($smoking_b1_icon) && trim($smoking_b1_icon) !== '') ? trim($smoking_b1_icon) : 'shield';
$smoking_b1_title = ($smoking_b1_title !== '' && $smoking_b1_title !== null) ? (string) $smoking_b1_title : 'Anti Poly Bag Campaign';
$smoking_b1_text  = ($smoking_b1_text !== '' && $smoking_b1_text !== null) ? (string) $smoking_b1_text : 'Students and teachers have been sensitized not to bring poly bags to school. A rally is also organized to create awareness amongst the general public of the harmful disadvantages of poly bags.';
$smoking_b2_icon  = (is_string($smoking_b2_icon) && trim($smoking_b2_icon) !== '') ? trim($smoking_b2_icon) : 'book-open';
$smoking_b2_title = ($smoking_b2_title !== '' && $smoking_b2_title !== null) ? (string) $smoking_b2_title : 'Environment Quotient';
$smoking_b2_text  = ($smoking_b2_text !== '' && $smoking_b2_text !== null) ? (string) $smoking_b2_text : 'Environment quotient is raised by incorporating environment related questions in the school examination. Environment education as per CBSE guidelines has also being followed.';

// ——— Three Column (Rakhi / Earth Watch / Van Mahotsav) ———
$three_cards = $opt ? get_field('efe_three_cards', $page_id) : null;
$default_three = array(
    array('icon' => 'heart', 'title' => 'Rakhi Tying', 'description' => 'Students are encouraged to tie Rakhi on trees in order to sensitize and have bondage with the trees.', 'sub_boxes' => array(
        array('icon' => 'sparkles', 'title' => 'Anti Cracker Campaign', 'text' => 'Our school organizes an Anti-cracker Rally annually before the festival of Diwali. Children and teachers from various schools attached to our school, regularly participate at this rally.'),
        array('icon' => 'droplets', 'title' => 'Water Conservation', 'text' => 'Waste water from the "Wash Basins" which does not contain any pollutants is recycled to water the lawns and to recharge the ground water. We have also constituted a "Water Brigade" comprising of school students to check leakage and wastage.'),
    ), 'list_items' => array()),
    array('icon' => 'calendar', 'title' => 'Earth Watch Week', 'description' => 'Week long activities are organized. Each day of the week is dedicated for a special cause. For example:', 'sub_boxes' => array(), 'list_items' => array(
        array('icon' => 'check-circle', 'text' => 'Paper Conservation Day, Banner making, Skits'),
        array('icon' => 'check-circle', 'text' => 'Water Conservation, Slogan & Poster making'),
        array('icon' => 'check-circle', 'text' => 'Electricity Conservation, Sticker Making'),
        array('icon' => 'check-circle', 'text' => 'Anti-Pollution Day, Pollution check of vehicles'),
    )),
    array('icon' => 'trees', 'title' => 'Van Mahotsav Week', 'description' => 'Each day, various activities such as Eco Quiz, Symposium, Scroll Making, Card Making, Planting of Saplings in and outside the School Campus designing of pamphlets on MS Word, etc.', 'sub_boxes' => array(
        array('icon' => 'sun', 'title' => 'Solar Panel', 'text' => 'Solar panel is allover the school campus.'),
        array('icon' => 'refresh-cw', 'title' => 'Water Recycling Process', 'text' => 'Water recycling process implemented throughout campus.'),
    ), 'list_items' => array()),
);
$three_cards = (is_array($three_cards) && count($three_cards) >= 3) ? $three_cards : $default_three;

// ——— World Conservation Day ———
$world_icon   = $opt ? get_field('efe_world_icon', $page_id) : null;
$world_title  = $opt ? get_field('efe_world_title', $page_id) : null;
$world_text   = $opt ? get_field('efe_world_text', $page_id) : null;
$world_boxes  = $opt ? get_field('efe_world_boxes', $page_id) : null;

$world_icon   = (is_string($world_icon) && trim($world_icon) !== '') ? trim($world_icon) : 'globe';
$world_title  = ($world_title !== '' && $world_title !== null) ? (string) $world_title : 'World Conservation Day';
$world_text   = ($world_text !== '' && $world_text !== null) ? (string) $world_text : 'On this day, we lay stress on conservation of Resources (electricity, water and paper) by organizing visits to landfills (Bhalsawa) and Thermal Power Plant (Indraprastha). Our students are also taken to observe the paper recycling plant where they actively participate in tearing the waste paper being recycled. They are also shown the compost pit in the school where the fallen leaves are decomposed.';
$default_world_boxes = array(
    array('icon' => 'users', 'title' => 'Inter School Debate', 'text' => 'Every year, our school organizes a debate on environmental issues in which many prominent schools of ALWAR participate. The topics are chosen with care on the present-day burning issues.'),
    array('icon' => 'map-pin', 'title' => 'Eco Tour', 'text' => 'Every year, an Eco Tour is organized for the members of Eco Club in order to sensitize them regarding biodiversity of the different regions, e.g. Churdhar in Mount Abu in Rajasthan.'),
);
$world_boxes = (is_array($world_boxes) && count($world_boxes) >= 2) ? $world_boxes : $default_world_boxes;

// ——— Community Involvement ———
$community_icon  = $opt ? get_field('efe_community_icon', $page_id) : null;
$community_title = $opt ? get_field('efe_community_title', $page_id) : null;
$community_text  = $opt ? get_field('efe_community_text', $page_id) : null;
$community_boxes = $opt ? get_field('efe_community_boxes', $page_id) : null;

$community_icon  = (is_string($community_icon) && trim($community_icon) !== '') ? trim($community_icon) : 'users';
$community_title = ($community_title !== '' && $community_title !== null) ? (string) $community_title : 'Community Involvement';
$community_text  = ($community_text !== '' && $community_text !== null) ? (string) $community_text : 'Pamphlets made by children with important messages on conservation, e.g. water, electricity, paper, etc. are sent periodically to parents. Saplings are distributed to children who take them home for planting, thus sensitizing the whole community on preserving trees. Inter school debates are organized. The topic for the Debate is chosen with care to create awareness in the young minds that sensitize the society at large. A newsletter (Dewdrops) is printed at our school to spread the environmental message to the community.';
$default_community_boxes = array(
    array('icon' => 'file-text', 'label' => 'Pamphlets Distribution'),
    array('icon' => 'sprout', 'label' => 'Saplings Distribution'),
    array('icon' => 'newspaper', 'label' => 'Dewdrops Newsletter'),
);
$community_boxes = (is_array($community_boxes) && count($community_boxes) >= 3) ? $community_boxes : $default_community_boxes;
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

    <!-- Content Section -->
    <section class="px-4 sm:px-6 lg:px-8 py-12 md:py-20 bg-background-light">
        <div class="max-w-7xl mx-auto w-full">
            <!-- Top 3 Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 mb-12">
                <?php
                $top_icon_colors = array('trash-2' => 'green', 'recycle' => 'blue', 'palette' => 'amber');
                foreach ($top_cards as $idx => $card) :
                    $c_icon = (isset($card['icon']) && trim((string) $card['icon']) !== '') ? trim($card['icon']) : 'trash-2';
                    $c_title = isset($card['title']) ? (string) $card['title'] : '';
                    $c_desc  = isset($card['description']) ? (string) $card['description'] : '';
                    $color = isset($top_icon_colors[$c_icon]) ? $top_icon_colors[$c_icon] : 'green';
                    $box_cls = $color === 'green' ? 'bg-green-100 text-green-600' : ($color === 'blue' ? 'bg-blue-100 text-blue-600' : 'bg-amber-100 text-amber-600');
                ?>
                <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light hover:border-primary/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg <?php echo esc_attr($box_cls); ?> flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($c_icon); ?>" class="w-5 h-5"></i>
                        </div>
                        <h2 class="text-lg sm:text-xl font-bold text-text-main-light"><?php echo esc_html($c_title); ?></h2>
                    </div>
                    <p class="text-sm text-text-secondary-light leading-relaxed"><?php echo esc_html($c_desc); ?></p>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- No Smoking Zone -->
            <div class="bg-gradient-to-r from-primary/5 to-accent/5 rounded-xl sm:rounded-2xl p-6 sm:p-8 mb-12 border border-primary/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center">
                        <i data-lucide="<?php echo esc_attr($smoking_icon); ?>" class="w-6 h-6 text-red-600"></i>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-text-main-light"><?php echo esc_html($smoking_title); ?></h2>
                </div>
                <p class="text-sm text-text-secondary-light leading-relaxed mb-4"><?php echo esc_html($smoking_text); ?></p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="space-y-3">
                        <h3 class="font-bold text-text-main-light flex items-center gap-2">
                            <i data-lucide="<?php echo esc_attr($smoking_b1_icon); ?>" class="w-4 h-4 text-primary"></i>
                            <?php echo esc_html($smoking_b1_title); ?>
                        </h3>
                        <p class="text-sm text-text-secondary-light"><?php echo esc_html($smoking_b1_text); ?></p>
                    </div>
                    <div class="space-y-3">
                        <h3 class="font-bold text-text-main-light flex items-center gap-2">
                            <i data-lucide="<?php echo esc_attr($smoking_b2_icon); ?>" class="w-4 h-4 text-primary"></i>
                            <?php echo esc_html($smoking_b2_title); ?>
                        </h3>
                        <p class="text-sm text-text-secondary-light"><?php echo esc_html($smoking_b2_text); ?></p>
                    </div>
                </div>
            </div>

            <!-- Three Column Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 mb-12">
                <?php
                $three_colors = array(0 => array('box' => 'bg-purple-100', 'icon' => 'text-purple-600'), 1 => array('box' => 'bg-green-100', 'icon' => 'text-green-600'), 2 => array('box' => 'bg-emerald-100', 'icon' => 'text-emerald-600'));
                foreach ($three_cards as $idx => $card) :
                    $tc_icon = (isset($card['icon']) && trim((string) $card['icon']) !== '') ? trim($card['icon']) : 'heart';
                    $tc_title = isset($card['title']) ? (string) $card['title'] : '';
                    $tc_desc  = isset($card['description']) ? (string) $card['description'] : '';
                    $tc_sub   = isset($card['sub_boxes']) && is_array($card['sub_boxes']) ? $card['sub_boxes'] : array();
                    $tc_list  = isset($card['list_items']) && is_array($card['list_items']) ? $card['list_items'] : array();
                    $st = isset($three_colors[$idx]) ? $three_colors[$idx] : array('box' => 'bg-primary/10', 'icon' => 'text-primary');
                ?>
                <div class="bg-white rounded-xl sm:rounded-2xl p-6 shadow-soft border border-border-light">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg <?php echo esc_attr($st['box']); ?> flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($tc_icon); ?>" class="w-5 h-5 <?php echo esc_attr($st['icon']); ?>"></i>
                        </div>
                        <h2 class="text-lg sm:text-xl font-bold text-text-main-light"><?php echo esc_html($tc_title); ?></h2>
                    </div>
                    <p class="text-sm text-text-secondary-light leading-relaxed"><?php echo esc_html($tc_desc); ?></p>
                    <?php if (!empty($tc_sub)) : ?>
                    <div class="mt-4 space-y-3">
                        <?php foreach ($tc_sub as $sub) :
                            $si = (isset($sub['icon']) && trim((string) $sub['icon']) !== '') ? trim($sub['icon']) : $default_list_icon;
                            $stitle = isset($sub['title']) ? (string) $sub['title'] : '';
                            $stext  = isset($sub['text']) ? (string) $sub['text'] : '';
                            if ($stitle === '' && $stext === '') continue;
                        ?>
                        <h3 class="font-bold text-text-main-light flex items-center gap-2">
                            <i data-lucide="<?php echo esc_attr($si); ?>" class="w-4 h-4 text-accent flex-shrink-0"></i>
                            <?php echo esc_html($stitle); ?>
                        </h3>
                        <?php if ($stext !== '') : ?><p class="text-sm text-text-secondary-light"><?php echo esc_html($stext); ?></p><?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($tc_list)) : ?>
                    <div class="mt-4 space-y-2">
                        <?php foreach ($tc_list as $li) :
                            $li_icon = (isset($li['icon']) && trim((string) $li['icon']) !== '') ? trim($li['icon']) : $default_list_icon;
                            $li_text = isset($li['text']) ? (string) $li['text'] : '';
                            if ($li_text === '') continue;
                        ?>
                        <div class="flex items-start gap-2">
                            <i data-lucide="<?php echo esc_attr($li_icon); ?>" class="w-4 h-4 text-green-500 mt-1 flex-shrink-0"></i>
                            <span class="text-sm text-text-secondary-light"><?php echo esc_html($li_text); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- World Conservation Day -->
            <div class="bg-gradient-to-r from-accent/5 to-green-500/5 rounded-xl sm:rounded-2xl p-6 sm:p-8 mb-12 border border-accent/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-lg bg-accent/10 flex items-center justify-center">
                        <i data-lucide="<?php echo esc_attr($world_icon); ?>" class="w-6 h-6 text-accent"></i>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-text-main-light"><?php echo esc_html($world_title); ?></h2>
                </div>
                <p class="text-sm text-text-secondary-light leading-relaxed mb-6"><?php echo esc_html($world_text); ?></p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($world_boxes as $wb) :
                        $wb_icon = (isset($wb['icon']) && trim((string) $wb['icon']) !== '') ? trim($wb['icon']) : 'users';
                        $wb_title = isset($wb['title']) ? (string) $wb['title'] : '';
                        $wb_text  = isset($wb['text']) ? (string) $wb['text'] : '';
                    ?>
                    <div class="space-y-4">
                        <h3 class="font-bold text-text-main-light flex items-center gap-2">
                            <i data-lucide="<?php echo esc_attr($wb_icon); ?>" class="w-4 h-4 text-primary"></i>
                            <?php echo esc_html($wb_title); ?>
                        </h3>
                        <p class="text-sm text-text-secondary-light"><?php echo esc_html($wb_text); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Community Involvement -->
            <div class="bg-white rounded-xl sm:rounded-2xl p-6 sm:p-8 shadow-soft border border-border-light">
                <h2 class="text-lg sm:text-xl font-bold text-text-main-light mb-4 flex items-center gap-2">
                    <i data-lucide="<?php echo esc_attr($community_icon); ?>" class="w-5 h-5 text-primary"></i>
                    <?php echo esc_html($community_title); ?>
                </h2>
                <p class="text-sm text-text-secondary-light leading-relaxed mb-6"><?php echo esc_html($community_text); ?></p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
                    <?php
                    $comm_styles = array(0 => array('bg' => 'bg-primary/5', 'border' => 'border-primary/10', 'icon' => 'text-primary'), 1 => array('bg' => 'bg-accent/5', 'border' => 'border-accent/10', 'icon' => 'text-accent'), 2 => array('bg' => 'bg-green-500/5', 'border' => 'border-green-500/10', 'icon' => 'text-green-600'));
                    foreach ($community_boxes as $cb_idx => $cb) :
                        $cb_icon = (isset($cb['icon']) && trim((string) $cb['icon']) !== '') ? trim($cb['icon']) : 'file-text';
                        $cb_label = isset($cb['label']) ? (string) $cb['label'] : '';
                        if ($cb_label === '') continue;
                        $cs = isset($comm_styles[$cb_idx]) ? $comm_styles[$cb_idx] : $comm_styles[0];
                    ?>
                    <div class="text-center p-4 rounded-lg <?php echo esc_attr($cs['bg']); ?> border <?php echo esc_attr($cs['border']); ?>">
                        <i data-lucide="<?php echo esc_attr($cb_icon); ?>" class="w-8 h-8 <?php echo esc_attr($cs['icon']); ?> mx-auto mb-2"></i>
                        <div class="text-sm font-medium text-text-main-light"><?php echo esc_html($cb_label); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
