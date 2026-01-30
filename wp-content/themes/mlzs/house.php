<?php
/**
 * Template Name: House System Page
 * House: Hero (pills), Intro, 4 Houses (Blue/Green/Red/Ochre), Points & Achievements – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$home_url = home_url('/');
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge     = $opt ? get_field('house_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('house_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('house_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('house_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('house_hero_subheadline', $page_id) : null;
$hero_pills     = $opt ? get_field('house_hero_pills', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'School Life';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'home';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'House';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'System';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Fostering leadership, teamwork, and healthy competition through our four-house system, each named after legendary individuals who shaped history.';
$default_pills  = array(
    array('label' => 'Blue House', 'dot_color' => 'bg-blue-500'),
    array('label' => 'Green House', 'dot_color' => 'bg-green-500'),
    array('label' => 'Red House', 'dot_color' => 'bg-red-500'),
    array('label' => 'Ochre House', 'dot_color' => 'bg-yellow-500'),
);
$hero_pills = (is_array($hero_pills) && count($hero_pills) >= 4) ? $hero_pills : $default_pills;

// ——— Intro ———
$intro_badge    = $opt ? get_field('house_intro_badge', $page_id) : null;
$intro_icon     = $opt ? get_field('house_intro_icon', $page_id) : null;
$intro_heading  = $opt ? get_field('house_intro_heading', $page_id) : null;
$intro_highlight = $opt ? get_field('house_intro_highlight', $page_id) : null;
$intro_para1    = $opt ? get_field('house_intro_para1', $page_id) : null;
$intro_para2    = $opt ? get_field('house_intro_para2', $page_id) : null;
$intro_image    = $opt ? get_field('house_intro_image', $page_id) : null;
$intro_overlay_icon    = $opt ? get_field('house_intro_overlay_icon', $page_id) : null;
$intro_overlay_title   = $opt ? get_field('house_intro_overlay_title', $page_id) : null;
$intro_overlay_subtitle = $opt ? get_field('house_intro_overlay_subtitle', $page_id) : null;

$intro_badge    = ($intro_badge !== '' && $intro_badge !== null) ? (string) $intro_badge : 'Our Philosophy';
$intro_icon     = (is_string($intro_icon) && trim($intro_icon) !== '') ? trim($intro_icon) : 'users';
$intro_heading  = ($intro_heading !== '' && $intro_heading !== null) ? (string) $intro_heading : 'Building Character Through';
$intro_highlight = ($intro_highlight !== '' && $intro_highlight !== null) ? (string) $intro_highlight : 'Healthy Competition';
$intro_para1    = ($intro_para1 !== '' && $intro_para1 !== null) ? $intro_para1 : 'All students in the school are divided into four Houses, named after individuals who contributed to a larger cause. They were rational thinkers whose actions were driven by reason rather than assumption. They were ethical and sensitive human beings who were not afraid to do what was right.';
$intro_para2    = ($intro_para2 !== '' && $intro_para2 !== null) ? $intro_para2 : 'Each house represents a different field - science, arts, philosophy, or exploration - allowing every student to realize their unique potential, bring about positive changes, and build a harmonious society.';
$intro_overlay_icon    = (is_string($intro_overlay_icon) && trim($intro_overlay_icon) !== '') ? trim($intro_overlay_icon) : 'award';
$intro_overlay_title   = ($intro_overlay_title !== '' && $intro_overlay_title !== null) ? (string) $intro_overlay_title : 'Inter-House Competitions';
$intro_overlay_subtitle = ($intro_overlay_subtitle !== '' && $intro_overlay_subtitle !== null) ? (string) $intro_overlay_subtitle : 'Sports • Arts • Academics • Leadership';

$intro_image_url = '';
if (!empty($intro_image)) {
    if (is_array($intro_image) && !empty($intro_image['url'])) $intro_image_url = $intro_image['url'];
    elseif (is_numeric($intro_image)) $intro_image_url = wp_get_attachment_image_url((int) $intro_image, 'full') ?: '';
}
if ($intro_image_url === '') $intro_image_url = 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=1200&h=675&fit=crop';

// ——— House blocks (4) ———
$house_blocks = $opt ? get_field('house_blocks', $page_id) : null;
$default_blocks = array(
    array(
        'name' => 'Blue House', 'color' => 'blue', 'image' => array('url' => 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=800&h=800&fit=crop'),
        'card_icon' => 'compass', 'card_subtitle' => 'Exploration & Discovery', 'badge_icon' => 'navigation', 'badge_text' => 'Christopher Columbus',
        'heading' => 'Christopher Columbus (1451-1506)', 'image_position' => 'left',
        'content' => '<p>Christopher Columbus was an explorer and trader who crossed the Atlantic Ocean and reached the Americas on October 12th 1492 under the flag of Castilian Spain.</p><p>He believed that the earth was a relatively small sphere, and argued that a ship could reach the Far East via a westward course. Christopher Columbus is one of the best-known of all explorers.</p><p>He is famous for his voyage in 1492, when he "discovered" America while looking for a way to sail to Asia. Columbus had this strong courage of conviction to pursue his dreams against all odds with a strong sense of perseverance.</p>',
        'values' => array(array('label' => 'Courage'), array('label' => 'Exploration'), array('label' => 'Perseverance'), array('label' => 'Discovery')),
    ),
    array(
        'name' => 'Green House', 'color' => 'green', 'image' => array('url' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&h=800&fit=crop'),
        'card_icon' => 'leaf', 'card_subtitle' => 'Peace & Compassion', 'badge_icon' => 'heart-handshake', 'badge_text' => 'Mahatma Gandhi',
        'heading' => 'Mahatma Gandhi (1869-1948)', 'image_position' => 'right',
        'content' => '<p>Gandhi was a gentle man who had a heart full of compassion for people, animals and nature. He believed in non-violent resolution of conflicts and devoted his life to peace and to making the world a more just place.</p><p>Through his actions, leadership and willpower, he managed to inspire Indian people to join in his non-violent protests, and together they freed India from British rule. He possessed limitless physical and moral strength.</p><p>Gandhi ji was a person who believed in the dignity of man and left us all a legacy of ahimsa, love and tolerance. He developed a method of action based upon the principles of courage, nonviolence and truth called Satyagraha. He believed that the way people behave is more important than what they achieve.</p>',
        'values' => array(array('label' => 'Peace'), array('label' => 'Compassion'), array('label' => 'Non-violence'), array('label' => 'Truth')),
    ),
    array(
        'name' => 'Red House', 'color' => 'red', 'image' => array('url' => 'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?w=800&h=800&fit=crop'),
        'card_icon' => 'palette', 'card_subtitle' => 'Creativity & Innovation', 'badge_icon' => 'lightbulb', 'badge_text' => 'Leonardo Da Vinci',
        'heading' => 'Leonardo Da Vinci (1452-1519)', 'image_position' => 'left',
        'content' => '<p>Leonardo was known as the ultimate Renaissance man because he was perhaps the most widely talented person ever to have lived. Da Vinci is a favourite with the children studying art history because of this Renaissance quality.</p><p>Not only was he a consummate painter and sculptor, he was a great inventor, military engineer, scientist, botanist, and mathematician. Leonardo was left to himself quite often, and perhaps this solitude is what we\'re still grateful for five centuries later, as he spent his days outdoors studying birds, plants, and nature.</p><p>Leonardo grew up to be a great artist and a great scientist. He was one of the first artists to draw things exactly as he saw them in nature. His keen sense of observation is what shaped him as the best painter of all times.</p>',
        'values' => array(array('label' => 'Creativity'), array('label' => 'Observation'), array('label' => 'Innovation'), array('label' => 'Curiosity')),
    ),
    array(
        'name' => 'Ochre House', 'color' => 'yellow', 'image' => array('url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=800&fit=crop'),
        'card_icon' => 'brain', 'card_subtitle' => 'Science & Wisdom', 'badge_icon' => 'atom', 'badge_text' => 'Albert Einstein',
        'heading' => 'Albert Einstein (1879-1955)', 'image_position' => 'right',
        'content' => '<p>Einstein is considered by many as the greatest astrophysicist. Einstein\'s many visionary scientific contributions include the equivalence of mass and energy (E=mc^2), how the maximum speed limit of light affects measurements of time and space (special relativity), and a more accurate theory of gravity based on simple geometric concepts (general relativity).</p><p>Albert Einstein was a thoughtful person, he loved to think about things. As a boy, he constantly wondered what made things work. Albert would think about electricity and be amazed.</p><p>Once when he was sick, his father gave him a compass. Albert was mystified when his father told him that the needle of the compass would always point to the north. This started him on the path of questing for scientific knowledge. Albert\'s father explained that there were magnetic forces that drew the needle to the north pole of Earth.</p>',
        'values' => array(array('label' => 'Curiosity'), array('label' => 'Knowledge'), array('label' => 'Innovation'), array('label' => 'Discovery')),
    ),
);
$house_blocks = (is_array($house_blocks) && count($house_blocks) >= 4) ? $house_blocks : $default_blocks;

// Color class maps for house blocks (badge, heading span, content area, values tags)
$house_color_classes = array(
    'blue'   => array('bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'tag_bg' => 'bg-blue-50', 'tag_text' => 'text-blue-700', 'tag_border' => 'border-blue-100', 'card_sub' => 'text-blue-100'),
    'green'  => array('bg' => 'bg-green-100', 'text' => 'text-green-600', 'tag_bg' => 'bg-green-50', 'tag_text' => 'text-green-700', 'tag_border' => 'border-green-100', 'card_sub' => 'text-green-100'),
    'red'    => array('bg' => 'bg-red-100', 'text' => 'text-red-600', 'tag_bg' => 'bg-red-50', 'tag_text' => 'text-red-700', 'tag_border' => 'border-red-100', 'card_sub' => 'text-red-100'),
    'yellow' => array('bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'tag_bg' => 'bg-yellow-50', 'tag_text' => 'text-yellow-700', 'tag_border' => 'border-yellow-100', 'card_sub' => 'text-yellow-100'),
);

// ——— Points ———
$points_badge   = $opt ? get_field('house_points_badge', $page_id) : null;
$points_icon    = $opt ? get_field('house_points_icon', $page_id) : null;
$points_heading = $opt ? get_field('house_points_heading', $page_id) : null;
$points_highlight = $opt ? get_field('house_points_highlight', $page_id) : null;
$points_subtext = $opt ? get_field('house_points_subtext', $page_id) : null;
$points_cards   = $opt ? get_field('house_points_cards', $page_id) : null;

$points_badge   = ($points_badge !== '' && $points_badge !== null) ? (string) $points_badge : 'Current Standings';
$points_icon    = (is_string($points_icon) && trim($points_icon) !== '') ? trim($points_icon) : 'trophy';
$points_heading = ($points_heading !== '' && $points_heading !== null) ? (string) $points_heading : 'House';
$points_highlight = ($points_highlight !== '' && $points_highlight !== null) ? (string) $points_highlight : 'Points & Achievements';
$points_subtext = ($points_subtext !== '' && $points_subtext !== null) ? (string) $points_subtext : 'Track the ongoing competition between houses through various academic, sports, and cultural events';
$default_points_cards = array(
    array('house_name' => 'Blue House', 'namesake' => 'Christopher Columbus', 'icon' => 'compass', 'color' => 'blue', 'total_points' => '1,250', 'academic' => '420', 'sports' => '380', 'cultural' => '450'),
    array('house_name' => 'Green House', 'namesake' => 'Mahatma Gandhi', 'icon' => 'leaf', 'color' => 'green', 'total_points' => '1,180', 'academic' => '390', 'sports' => '350', 'cultural' => '440'),
    array('house_name' => 'Red House', 'namesake' => 'Leonardo Da Vinci', 'icon' => 'palette', 'color' => 'red', 'total_points' => '1,320', 'academic' => '450', 'sports' => '420', 'cultural' => '450'),
    array('house_name' => 'Ochre House', 'namesake' => 'Albert Einstein', 'icon' => 'brain', 'color' => 'yellow', 'total_points' => '1,410', 'academic' => '520', 'sports' => '410', 'cultural' => '480'),
);
$points_cards = (is_array($points_cards) && count($points_cards) >= 4) ? $points_cards : $default_points_cards;

// Helper: image URL from house block
if (!function_exists('mlzs_house_block_img_url')) {
    function mlzs_house_block_img_url($block) {
        if (empty($block) || !isset($block['image'])) return '';
        $img = $block['image'];
        if (is_array($img) && !empty($img['url'])) return $img['url'];
        if (is_numeric($img)) return wp_get_attachment_image_url((int) $img, 'full') ?: '';
        return '';
    }
}
?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary/90 via-primary to-primary-dark text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-72 h-72 bg-accent/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-primary-light/20 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-10 md:pt-40 md:pb-24">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 sm:px-4 sm:py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-4 sm:mb-6 animate-fade-in-up">
                    <i data-lucide="<?php echo esc_attr($hero_icon); ?>" class="w-3 h-3 sm:w-4 sm:h-4"></i>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                    <?php echo esc_html($hero_headline); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg text-slate-200 mb-8 max-w-2xl leading-relaxed">
                    <?php echo esc_html($hero_sub); ?>
                </p>
                <div class="flex flex-wrap gap-4">
                    <?php foreach ($hero_pills as $pill) :
                        $plabel = isset($pill['label']) ? (string) $pill['label'] : '';
                        $pdot   = isset($pill['dot_color']) && trim((string) $pill['dot_color']) !== '' ? trim($pill['dot_color']) : 'bg-blue-500';
                    ?>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full <?php echo esc_attr($pdot); ?> animate-pulse"></div>
                        <span class="text-xs sm:text-sm font-medium"><?php echo esc_html($plabel); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="py-16 md:py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 text-primary mb-4 sm:mb-6">
                        <i data-lucide="<?php echo esc_attr($intro_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($intro_badge); ?></span>
                    </div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                        <?php echo esc_html($intro_heading); ?> <span class="text-primary"><?php echo esc_html($intro_highlight); ?></span>
                    </h2>
                    <p class="text-sm sm:text-base text-slate-600 mb-6 leading-relaxed">
                        <?php echo $intro_para1; ?>
                    </p>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                        <?php echo $intro_para2; ?>
                    </p>
                </div>

                <div class="relative">
                    <div class="relative rounded-[1rem] overflow-hidden shadow-2xl">
                        <div class="aspect-video relative overflow-hidden">
                            <img src="<?php echo esc_url($intro_image_url); ?>" alt="<?php echo esc_attr($intro_overlay_title); ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
                            <div class="flex items-center gap-3 sm:gap-4 mb-3 sm:mb-4">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($intro_overlay_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-white"><?php echo esc_html($intro_overlay_title); ?></h3>
                                    <p class="text-slate-200 text-xs sm:text-sm md:text-base"><?php echo esc_html($intro_overlay_subtitle); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-6 -right-6 w-40 h-40 bg-accent/10 rounded-full blur-xl -z-10"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-primary/10 rounded-full blur-xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Houses (4 blocks) -->
    <section class="py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php foreach ($house_blocks as $idx => $block) :
                $bname   = isset($block['name']) ? (string) $block['name'] : '';
                $bcolor  = isset($block['color']) && in_array($block['color'], array('blue','green','red','yellow'), true) ? $block['color'] : 'blue';
                $bimg    = mlzs_house_block_img_url($block);
                if ($bimg === '') $bimg = 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=800&h=800&fit=crop';
                $bcard_icon    = isset($block['card_icon']) && trim((string) $block['card_icon']) !== '' ? trim($block['card_icon']) : 'compass';
                $bcard_sub    = isset($block['card_subtitle']) ? (string) $block['card_subtitle'] : '';
                $bbadge_icon  = isset($block['badge_icon']) && trim((string) $block['badge_icon']) !== '' ? trim($block['badge_icon']) : 'navigation';
                $bbadge_text  = isset($block['badge_text']) ? (string) $block['badge_text'] : '';
                $bheading    = isset($block['heading']) ? (string) $block['heading'] : '';
                $bcontent    = isset($block['content']) ? $block['content'] : '';
                $bvalues     = isset($block['values']) && is_array($block['values']) ? $block['values'] : array();
                $bimg_pos    = isset($block['image_position']) && $block['image_position'] === 'right' ? 'right' : 'left';
                $cl          = $house_color_classes[$bcolor];
                $is_last     = ($idx === count($house_blocks) - 1);
                $mb_class    = $is_last ? '' : 'mb-20';
                $img_col     = 'lg:col-span-5';
                $text_col    = 'lg:col-span-7';
                $order_img   = $bimg_pos === 'left' ? '' : 'order-1 lg:order-2';
                $order_text  = $bimg_pos === 'left' ? '' : 'order-2 lg:order-1';
            ?>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center <?php echo esc_attr($mb_class); ?>">
                <div class="<?php echo esc_attr($img_col . ' ' . $order_img); ?>">
                    <div class="rounded-[1rem] overflow-hidden shadow-xl">
                        <div class="aspect-square relative overflow-hidden">
                            <img src="<?php echo esc_url($bimg); ?>" alt="<?php echo esc_attr($bname); ?>" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
                                <div class="text-center">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto mb-4 sm:mb-6">
                                        <i data-lucide="<?php echo esc_attr($bcard_icon); ?>" class="w-8 h-8 sm:w-10 sm:h-10 text-white"></i>
                                    </div>
                                    <h3 class="text-base sm:text-xl md:text-2xl font-bold text-white mb-2"><?php echo esc_html($bname); ?></h3>
                                    <p class="<?php echo esc_attr($cl['card_sub']); ?> text-xs sm:text-sm"><?php echo esc_html($bcard_sub); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="<?php echo esc_attr($text_col . ' ' . $order_text); ?>">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg <?php echo esc_attr($cl['bg']); ?> flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($bbadge_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 <?php echo esc_attr($cl['text']); ?>"></i>
                        </div>
                        <span class="text-xs sm:text-sm font-bold <?php echo esc_attr($cl['text']); ?> uppercase tracking-wider"><?php echo esc_html($bbadge_text); ?></span>
                    </div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                        <?php
                        $hpos = strpos($bheading, ' (');
                        if ($hpos !== false && substr($bheading, -1) === ')') {
                            echo esc_html(substr($bheading, 0, $hpos)) . ' <span class="' . esc_attr($cl['text']) . '">(' . esc_html(substr($bheading, $hpos + 2, -1)) . ')</span>';
                        } else {
                            echo esc_html($bheading);
                        }
                        ?>
                    </h2>
                    <div class="space-y-4 text-slate-600">
                        <?php echo wp_kses_post($bcontent); ?>
                    </div>
                    <div class="mt-6 sm:mt-8 pt-6 sm:pt-8 border-t border-slate-200">
                        <h4 class="text-xs sm:text-sm font-bold text-slate-500 uppercase tracking-wider mb-3 sm:mb-4">House Values</h4>
                        <div class="flex flex-wrap gap-2 sm:gap-3">
                            <?php foreach ($bvalues as $v) :
                                $vlabel = isset($v['label']) ? (string) $v['label'] : '';
                                if ($vlabel === '') continue;
                            ?>
                            <span class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-full <?php echo esc_attr($cl['tag_bg'] . ' ' . $cl['tag_text']); ?> text-xs sm:text-sm font-medium border <?php echo esc_attr($cl['tag_border']); ?>"><?php echo esc_html($vlabel); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- House Points & Achievements -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 text-primary mb-4 sm:mb-6">
                    <i data-lucide="<?php echo esc_attr($points_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($points_badge); ?></span>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                    <?php echo esc_html($points_heading); ?> <span class="text-primary"><?php echo esc_html($points_highlight); ?></span>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 max-w-2xl mx-auto">
                    <?php echo esc_html($points_subtext); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <?php foreach ($points_cards as $card) :
                    $cname   = isset($card['house_name']) ? (string) $card['house_name'] : '';
                    $cnamesake = isset($card['namesake']) ? (string) $card['namesake'] : '';
                    $cicon   = isset($card['icon']) && trim((string) $card['icon']) !== '' ? trim($card['icon']) : 'compass';
                    $ccolor  = isset($card['color']) && in_array($card['color'], array('blue','green','red','yellow'), true) ? $card['color'] : 'blue';
                    $ctotal  = isset($card['total_points']) ? (string) $card['total_points'] : '0';
                    $cacad   = isset($card['academic']) ? (string) $card['academic'] : '0';
                    $csport  = isset($card['sports']) ? (string) $card['sports'] : '0';
                    $ccult   = isset($card['cultural']) ? (string) $card['cultural'] : '0';
                    $pc      = $house_color_classes[$ccolor];
                ?>
                <div class="bg-white rounded-[1rem] p-4 sm:p-6 border border-slate-200 shadow-soft hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg <?php echo esc_attr($pc['bg']); ?> flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($cicon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 <?php echo esc_attr($pc['text']); ?>"></i>
                            </div>
                            <div>
                                <h3 class="text-sm sm:text-base font-bold text-slate-900"><?php echo esc_html($cname); ?></h3>
                                <p class="text-xs text-slate-500"><?php echo esc_html($cnamesake); ?></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-lg sm:text-xl md:text-2xl font-bold <?php echo esc_attr($pc['text']); ?>"><?php echo esc_html($ctotal); ?></span>
                            <p class="text-xs text-slate-500">Points</p>
                        </div>
                    </div>
                    <div class="space-y-2 sm:space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs sm:text-sm text-slate-600">Academic Events</span>
                            <span class="text-xs sm:text-sm font-semibold text-slate-900"><?php echo esc_html($cacad); ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs sm:text-sm text-slate-600">Sports Events</span>
                            <span class="text-xs sm:text-sm font-semibold text-slate-900"><?php echo esc_html($csport); ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs sm:text-sm text-slate-600">Cultural Events</span>
                            <span class="text-xs sm:text-sm font-semibold text-slate-900"><?php echo esc_html($ccult); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
