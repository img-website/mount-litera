<?php
/**
 * Template Name: Life & Development Page
 * Life: Hero (ESP 4), Intro, Knowledge (4), Life Skills (4), Risk (2 boxes + leader 4), CTA – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge   = $opt ? get_field('life_hero_badge', $page_id) : null;
$hero_headline = $opt ? get_field('life_hero_headline', $page_id) : null;
$hero_quote   = $opt ? get_field('life_hero_quote', $page_id) : null;
$hero_para    = $opt ? get_field('life_hero_paragraph', $page_id) : null;
$hero_cards   = $opt ? get_field('life_hero_cards', $page_id) : null;

$hero_badge   = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Emergent Student Profile';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'ESP of Child';
$hero_quote   = ($hero_quote !== '' && $hero_quote !== null) ? (string) $hero_quote : '"Knowledge is of no value unless you put it into practice."';
$hero_para    = ($hero_para !== '' && $hero_para !== null) ? (string) $hero_para : 'Emergent Student Profile is our promise and our goal. Everything we do in the school strives to achieve this for each child. While each child will take a different path towards this profile, we run the school with the firm belief that it is this profile that will enable our children to be leaders of the 21st century.';

$default_hero_cards = array(
    array('icon' => 'brain', 'title' => 'Knowledge', 'subtitle' => 'Higher order thinking & real understanding'),
    array('icon' => 'heart', 'title' => 'Life Skills', 'subtitle' => 'Adaptive & positive behavior for life'),
    array('icon' => 'target', 'title' => 'Risk Taking', 'subtitle' => 'Decision making & self-management'),
    array('icon' => 'users', 'title' => 'Core Values', 'subtitle' => 'What\'s Right For the Child (WRFC)'),
);
$hero_cards = (is_array($hero_cards) && count($hero_cards) >= 4) ? $hero_cards : $default_hero_cards;

// ——— Intro ———
$intro_heading_before  = $opt ? get_field('life_intro_heading_before', $page_id) : null;
$intro_heading_highlight = $opt ? get_field('life_intro_heading_highlight', $page_id) : null;
$intro_para1 = $opt ? get_field('life_intro_para1', $page_id) : null;
$intro_para2 = $opt ? get_field('life_intro_para2', $page_id) : null;
$intro_para3 = $opt ? get_field('life_intro_para3', $page_id) : null;
$intro_mantra_heading = $opt ? get_field('life_intro_mantra_heading', $page_id) : null;
$intro_mantra_icon   = $opt ? get_field('life_intro_mantra_icon', $page_id) : null;
$intro_mantra_quote  = $opt ? get_field('life_intro_mantra_quote', $page_id) : null;
$intro_life_heading  = $opt ? get_field('life_intro_life_skills_heading', $page_id) : null;
$intro_life_para     = $opt ? get_field('life_intro_life_skills_para', $page_id) : null;

$intro_heading_before  = ($intro_heading_before !== '' && $intro_heading_before !== null) ? (string) $intro_heading_before : 'Our Philosophy:';
$intro_heading_highlight = ($intro_heading_highlight !== '' && $intro_heading_highlight !== null) ? (string) $intro_heading_highlight : 'Child at the Center';
$intro_para1 = ($intro_para1 !== '' && $intro_para1 !== null) ? (string) $intro_para1 : 'Knowledge is familiarity, awareness or understanding of someone or something. Such as facts, information, descriptions or skills, this is acquired through experience or education by perceiving, discovering or learning.';
$intro_para2 = ($intro_para2 !== '' && $intro_para2 !== null) ? (string) $intro_para2 : 'Value education does not form a separate dimension of the curriculum but is integrally interwoven into the entire fabric of the curriculum. Stress is laid on developing a methodical & disciplined approach to life, to have discriminating mind, the courage to tread new paths & to follow the dictates of one\'s own conscience even if it means being different.';
$intro_para3 = ($intro_para3 !== '' && $intro_para3 !== null) ? (string) $intro_para3 : 'Core values are the fundamental beliefs for a person or organization. A principle that guides an organization\'s internal conduct as well as its relationship with the external world. Core value is usually summarized in the mission statement or in a statement of the value. Core value can help school to know what\'s right for the child (WRFC).';
$intro_mantra_heading = ($intro_mantra_heading !== '' && $intro_mantra_heading !== null) ? (string) $intro_mantra_heading : 'Our Mantra';
$intro_mantra_icon   = (is_string($intro_mantra_icon) && trim($intro_mantra_icon) !== '') ? trim($intro_mantra_icon) : 'star';
$intro_mantra_quote  = ($intro_mantra_quote !== '' && $intro_mantra_quote !== null) ? (string) $intro_mantra_quote : '"This is the mantra through which we place the child at the centre of everything that we do & ensures single-minded devotion to the growth & development."';
$intro_life_heading  = ($intro_life_heading !== '' && $intro_life_heading !== null) ? (string) $intro_life_heading : 'Life Skills Education';
$intro_life_para     = ($intro_life_para !== '' && $intro_life_para !== null) ? (string) $intro_life_para : 'Life skills education is the study of abilities for adaptive & positive behavior that enable individuals to deal effectively with the demands & the challenges of everyday life.';

// ——— Knowledge ———
$know_badge   = $opt ? get_field('life_knowledge_badge', $page_id) : null;
$know_heading = $opt ? get_field('life_knowledge_heading', $page_id) : null;
$know_subtext = $opt ? get_field('life_knowledge_subtext', $page_id) : null;
$know_cards   = $opt ? get_field('life_knowledge_cards', $page_id) : null;

$know_badge   = ($know_badge !== '' && $know_badge !== null) ? (string) $know_badge : 'Pillar 01';
$know_heading = ($know_heading !== '' && $know_heading !== null) ? (string) $know_heading : 'Knowledge Acquisition';
$know_subtext = ($know_subtext !== '' && $know_subtext !== null) ? (string) $know_subtext : 'Our students will gain comprehensive knowledge across multiple domains to become well-rounded individuals';

$default_know_cards = array(
    array('icon' => 'brain', 'style' => 'primary', 'title' => 'Higher Order Thinking Skills', 'paragraph' => 'Students gain real understanding of each subject they take. This enables them to not only retain and apply but also create new knowledge and ideas from this understanding.', 'link' => array(), 'link_icon' => 'arrow-right'),
    array('icon' => 'trophy', 'style' => 'secondary', 'title' => 'Sports & Fitness', 'paragraph' => 'Students are encouraged to take up sports, not only for fitness and health but to ingrain the values of sportsmanship and teamwork.', 'link' => array(), 'link_icon' => 'arrow-right'),
    array('icon' => 'briefcase', 'style' => 'accent', 'title' => 'Entrepreneurship', 'paragraph' => 'Students will see the world as an owner. They\'ll develop an ability to reach a goal by making choices and sequencing actions.', 'link' => array(), 'link_icon' => 'arrow-right'),
    array('icon' => 'dollar-sign', 'style' => 'primary-light', 'title' => 'Financial Literacy', 'paragraph' => 'Students will develop a strong and empowering relationship with money and managing it responsibly.', 'link' => array(), 'link_icon' => 'arrow-right'),
);
$know_cards = (is_array($know_cards) && count($know_cards) >= 4) ? $know_cards : $default_know_cards;

// ——— Life Skills ———
$skill_badge   = $opt ? get_field('life_lifeskills_badge', $page_id) : null;
$skill_heading = $opt ? get_field('life_lifeskills_heading', $page_id) : null;
$skill_subtext = $opt ? get_field('life_lifeskills_subtext', $page_id) : null;
$skill_items   = $opt ? get_field('life_lifeskills_items', $page_id) : null;

$skill_badge   = ($skill_badge !== '' && $skill_badge !== null) ? (string) $skill_badge : 'Pillar 02';
$skill_heading = ($skill_heading !== '' && $skill_heading !== null) ? (string) $skill_heading : 'Life Skills Development';
$skill_subtext = ($skill_subtext !== '' && $skill_subtext !== null) ? (string) $skill_subtext : 'Our students will emerge out of school with essential life skills for success in the 21st century';

$default_skill_items = array(
    array('icon' => 'check-circle', 'title' => 'Effective Habits', 'paragraph' => 'Our character is a composite of our habits. Inspired by Stephen Covey\'s 7 Habits of Highly Effective People, Mount Litera Schools have a series of programs during the duration of student\'s stay that build effective habits for leading life.', 'tags' => 'Discipline, Time Management, Proactivity'),
    array('icon' => 'tv', 'title' => 'Media Literacy', 'paragraph' => 'Media literacy develops the ability to analyze, critique and effectively use the media to gather information and make informed decisions in the digital age.', 'tags' => 'Critical Thinking, Digital Literacy, Information Analysis'),
    array('icon' => 'eye', 'title' => 'Aesthetic Sense', 'paragraph' => 'Aesthetic sense helps students appreciate the beauty that exists around them and contribute to it through creative expression and artistic endeavors.', 'tags' => 'Creativity, Appreciation, Expression'),
    array('icon' => 'brain-circuit', 'title' => 'Metacognition', 'paragraph' => 'Metacognition is the skill of knowing how we learn and our peculiar style of learning. This gives us access to removing the hidden barriers to our learning and maximizing our potential.', 'tags' => 'Self-awareness, Learning Strategies, Growth Mindset'),
);
$skill_items = (is_array($skill_items) && count($skill_items) >= 4) ? $skill_items : $default_skill_items;

// ——— Risk ———
$risk_badge   = $opt ? get_field('life_risk_badge', $page_id) : null;
$risk_heading = $opt ? get_field('life_risk_heading', $page_id) : null;
$risk_box1_title = $opt ? get_field('life_risk_box1_title', $page_id) : null;
$risk_box1_icon  = $opt ? get_field('life_risk_box1_icon', $page_id) : null;
$risk_box1_para = $opt ? get_field('life_risk_box1_para', $page_id) : null;
$risk_box2_title = $opt ? get_field('life_risk_box2_title', $page_id) : null;
$risk_box2_icon  = $opt ? get_field('life_risk_box2_icon', $page_id) : null;
$risk_box2_para = $opt ? get_field('life_risk_box2_para', $page_id) : null;
$risk_box2_tags = $opt ? get_field('life_risk_box2_tags', $page_id) : null;
$risk_leader_title   = $opt ? get_field('life_risk_leader_title', $page_id) : null;
$risk_leader_icon    = $opt ? get_field('life_risk_leader_icon', $page_id) : null;
$risk_leader_subtitle = $opt ? get_field('life_risk_leader_subtitle', $page_id) : null;
$risk_leader_items   = $opt ? get_field('life_risk_leader_items', $page_id) : null;

$risk_badge   = ($risk_badge !== '' && $risk_badge !== null) ? (string) $risk_badge : 'Pillar 03';
$risk_heading = ($risk_heading !== '' && $risk_heading !== null) ? (string) $risk_heading : 'Risk Taking & Self-Management';
$risk_box1_title = ($risk_box1_title !== '' && $risk_box1_title !== null) ? (string) $risk_box1_title : 'The Courage to Decide';
$risk_box1_para = ($risk_box1_para !== '' && $risk_box1_para !== null) ? (string) $risk_box1_para : 'This is the skill of making your own decisions at the risk of making a mistake, rather than simply doing what you are told to by others. We encourage calculated risk-taking and learning from experiences.';
$risk_box2_title = ($risk_box2_title !== '' && $risk_box2_title !== null) ? (string) $risk_box2_title : 'Self-Management';
$risk_box2_para = ($risk_box2_para !== '' && $risk_box2_para !== null) ? (string) $risk_box2_para : 'Self-management plans are used to teach students to independently complete tasks and take an active role in monitoring and reinforcing their own behaviour. An important goal in education is to foster self-reliance and independence.';
$risk_box2_tags = ($risk_box2_tags !== '' && $risk_box2_tags !== null) ? (string) $risk_box2_tags : 'Goal Setting, Self-Monitoring, Responsibility';
$risk_leader_title   = ($risk_leader_title !== '' && $risk_leader_title !== null) ? (string) $risk_leader_title : 'The 21st Century Leader';
$risk_leader_icon    = (is_string($risk_leader_icon) && trim($risk_leader_icon) !== '') ? trim($risk_leader_icon) : 'target';
$risk_leader_subtitle = ($risk_leader_subtitle !== '' && $risk_leader_subtitle !== null) ? (string) $risk_leader_subtitle : 'Our Emergent Student Profile';

$default_leader_items = array(
    array('icon' => 'lightbulb', 'style' => 'primary-light', 'title' => 'Innovative Thinker', 'subtitle' => 'Creates new solutions to complex problems'),
    array('icon' => 'heart', 'style' => 'secondary', 'title' => 'Emotionally Intelligent', 'subtitle' => 'Understands self and others with empathy'),
    array('icon' => 'globe', 'style' => 'accent', 'title' => 'Global Citizen', 'subtitle' => 'Respects diversity and contributes globally'),
    array('icon' => 'trending-up', 'style' => 'primary-light-2', 'title' => 'Lifelong Learner', 'subtitle' => 'Continuously grows and adapts to change'),
);
$risk_leader_items = (is_array($risk_leader_items) && count($risk_leader_items) >= 4) ? $risk_leader_items : $default_leader_items;

// ——— CTA ———
$cta_heading = $opt ? get_field('life_cta_heading', $page_id) : null;
$cta_para    = $opt ? get_field('life_cta_para', $page_id) : null;
$cta_btn1_link = $opt ? get_field('life_cta_btn1_link', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('life_cta_btn1_icon', $page_id) : null;
$cta_btn2_link = $opt ? get_field('life_cta_btn2_link', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('life_cta_btn2_icon', $page_id) : null;

$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Join Us in Shaping Future Leaders';
$cta_para    = ($cta_para !== '' && $cta_para !== null) ? (string) $cta_para : 'At Mount Litera Zee School, we don\'t just teach subjects - we build character, instill values, and develop life skills that prepare children for success in the 21st century.';
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'book-open';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'calendar';

$cta_btn1_url = $cta_btn1_target = $cta_btn1_text = '';
if (!empty($cta_btn1_link) && is_array($cta_btn1_link)) {
    $cta_btn1_url   = isset($cta_btn1_link['url']) ? esc_url($cta_btn1_link['url']) : '#';
    $cta_btn1_target = isset($cta_btn1_link['target']) ? $cta_btn1_link['target'] : '_self';
    $cta_btn1_text  = isset($cta_btn1_link['title']) && trim((string) $cta_btn1_link['title']) !== '' ? (string) $cta_btn1_link['title'] : 'Explore Our Curriculum';
} else {
    $cta_btn1_url = '#'; $cta_btn1_target = '_self'; $cta_btn1_text = 'Explore Our Curriculum';
}

$cta_btn2_url = $cta_btn2_target = $cta_btn2_text = '';
if (!empty($cta_btn2_link) && is_array($cta_btn2_link)) {
    $cta_btn2_url   = isset($cta_btn2_link['url']) ? esc_url($cta_btn2_link['url']) : '#';
    $cta_btn2_target = isset($cta_btn2_link['target']) ? $cta_btn2_link['target'] : '_self';
    $cta_btn2_text  = isset($cta_btn2_link['title']) && trim((string) $cta_btn2_link['title']) !== '' ? (string) $cta_btn2_link['title'] : 'Schedule a Campus Visit';
} else {
    $cta_btn2_url = '#'; $cta_btn2_target = '_self'; $cta_btn2_text = 'Schedule a Campus Visit';
}
?>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 md:pt-40 md:pb-28 px-4 sm:px-6 lg:px-8 overflow-hidden bg-gradient-to-br from-indigo-velvet via-primary to-primary-dark">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 left-10 w-64 h-64 rounded-full bg-secondary/20 blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-80 h-80 rounded-full bg-accent/10 blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-secondary"></span>
                        </span>
                        <span class="text-xs font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        <?php echo esc_html($hero_headline); ?>
                    </h1>
                    <div class="relative pl-8 border-l-4 border-secondary mb-8">
                        <p class="text-xl text-slate-200 italic font-serif">
                            <?php echo esc_html($hero_quote); ?>
                        </p>
                    </div>
                    <p class="text-lg text-slate-200 mb-8 leading-relaxed">
                        <?php echo esc_html($hero_para); ?>
                    </p>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <div class="absolute -top-6 -right-6 w-72 h-72 bg-secondary/20 rounded-full blur-2xl"></div>
                        <div class="relative bg-white/10 backdrop-blur-md rounded-[1rem] p-8 border border-white/20 shadow-2xl">
                            <div class="grid grid-cols-2 gap-6">
                                <?php foreach ($hero_cards as $card) :
                                    $c_icon = isset($card['icon']) ? trim((string) $card['icon']) : 'brain';
                                    $c_title = isset($card['title']) ? (string) $card['title'] : '';
                                    $c_sub = isset($card['subtitle']) ? (string) $card['subtitle'] : '';
                                ?>
                                <div class="bg-white/20 rounded-xl p-6 text-center backdrop-blur-sm border border-white/10">
                                    <i data-lucide="<?php echo esc_attr($c_icon); ?>" class="w-12 h-12 text-secondary mx-auto mb-4"></i>
                                    <h3 class="text-white font-bold text-lg mb-2"><?php echo esc_html($c_title); ?></h3>
                                    <p class="text-slate-200 text-sm"><?php echo esc_html($c_sub); ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                        <?php echo esc_html($intro_heading_before); ?> <span class="text-primary"><?php echo esc_html($intro_heading_highlight); ?></span>
                    </h2>
                    <div class="space-y-4 text-slate-600">
                        <p><?php echo esc_html($intro_para1); ?></p>
                        <p><?php echo esc_html($intro_para2); ?></p>
                        <p><?php echo esc_html($intro_para3); ?></p>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative bg-gradient-to-br from-primary-light/10 to-secondary/10 rounded-[1rem] p-8 border border-primary/20 shadow-soft">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($intro_mantra_icon); ?>" class="w-7 h-7 text-primary"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900"><?php echo esc_html($intro_mantra_heading); ?></h3>
                        </div>
                        <p class="text-lg text-slate-700 italic mb-6"><?php echo esc_html($intro_mantra_quote); ?></p>
                        <div class="bg-white rounded-xl p-6 border border-slate-200">
                            <h4 class="font-bold text-primary mb-3"><?php echo esc_html($intro_life_heading); ?></h4>
                            <p class="text-slate-600"><?php echo esc_html($intro_life_para); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Knowledge Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-slate-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-bold uppercase tracking-wider mb-4"><?php echo esc_html($know_badge); ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4"><?php echo esc_html($know_heading); ?></h2>
                <p class="text-lg text-slate-600 max-w-3xl mx-auto"><?php echo esc_html($know_subtext); ?></p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($know_cards as $card) :
                    $k_icon = isset($card['icon']) ? trim((string) $card['icon']) : 'brain';
                    $k_style = isset($card['style']) && in_array($card['style'], array('primary', 'secondary', 'accent', 'primary-light'), true) ? $card['style'] : 'primary';
                    $k_title = isset($card['title']) ? (string) $card['title'] : '';
                    $k_para = isset($card['paragraph']) ? (string) $card['paragraph'] : '';
                    $k_link = isset($card['link']) && is_array($card['link']) ? $card['link'] : array();
                    $k_link_icon = isset($card['link_icon']) && trim((string) $card['link_icon']) !== '' ? trim($card['link_icon']) : 'arrow-right';
                    $k_link_url = !empty($k_link['url']) ? esc_url($k_link['url']) : '';
                    $k_link_target = !empty($k_link['target']) ? $k_link['target'] : '_self';
                    $k_link_text = (!empty($k_link['title']) && trim((string) $k_link['title']) !== '') ? (string) $k_link['title'] : 'Learn More';
                    $k_bg = $k_style === 'secondary' ? 'bg-secondary/10' : ($k_style === 'accent' ? 'bg-accent/10' : ($k_style === 'primary-light' ? 'bg-primary-light/10' : 'bg-primary/10'));
                    $k_text = $k_style === 'secondary' ? 'text-secondary' : ($k_style === 'accent' ? 'text-accent' : ($k_style === 'primary-light' ? 'text-primary-light' : 'text-primary'));
                    $k_hover = $k_style === 'secondary' ? 'group-hover:bg-secondary' : ($k_style === 'accent' ? 'group-hover:bg-accent' : ($k_style === 'primary-light' ? 'group-hover:bg-primary-light' : 'group-hover:bg-primary'));
                ?>
                <div class="group bg-white rounded-[1rem] p-8 border border-slate-200 shadow-soft hover:shadow-xl hover:border-primary/30 transition-all duration-300">
                    <div class="w-16 h-16 rounded-xl <?php echo esc_attr($k_bg); ?> flex items-center justify-center mb-6 <?php echo esc_attr($k_hover); ?> group-hover:text-white transition-colors">
                        <i data-lucide="<?php echo esc_attr($k_icon); ?>" class="w-8 h-8 <?php echo esc_attr($k_text); ?> group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4"><?php echo esc_html($k_title); ?></h3>
                    <p class="text-slate-600 mb-4"><?php echo esc_html($k_para); ?></p>
                    <div class="flex items-center text-primary font-medium group-hover:translate-x-2 transition-transform">
                        <?php if ($k_link_url !== '') : ?>
                        <a href="<?php echo $k_link_url; ?>" target="<?php echo esc_attr($k_link_target); ?>" class="inline-flex items-center gap-2">
                            <span><?php echo esc_html($k_link_text); ?></span>
                            <i data-lucide="<?php echo esc_attr($k_link_icon); ?>" class="w-4 h-4"></i>
                        </a>
                        <?php else : ?>
                        <span><?php echo esc_html($k_link_text); ?></span>
                        <i data-lucide="<?php echo esc_attr($k_link_icon); ?>" class="w-4 h-4 ml-2"></i>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Life Skills Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-primary-dark via-primary to-primary-light">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-sm text-white text-sm font-bold uppercase tracking-wider mb-4"><?php echo esc_html($skill_badge); ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4"><?php echo esc_html($skill_heading); ?></h2>
                <p class="text-lg text-slate-200 max-w-3xl mx-auto"><?php echo esc_html($skill_subtext); ?></p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-8">
                <?php foreach ($skill_items as $item) :
                    $s_icon = isset($item['icon']) ? trim((string) $item['icon']) : 'check-circle';
                    $s_title = isset($item['title']) ? (string) $item['title'] : '';
                    $s_para = isset($item['paragraph']) ? (string) $item['paragraph'] : '';
                    $s_tags = isset($item['tags']) ? (string) $item['tags'] : '';
                    $s_tags_arr = $s_tags !== '' ? array_map('trim', explode(',', $s_tags)) : array();
                ?>
                <div class="group bg-white/10 backdrop-blur-md rounded-[1rem] p-8 border border-white/20 hover:border-white/40 transition-all duration-300">
                    <div class="flex items-start gap-6">
                        <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                            <i data-lucide="<?php echo esc_attr($s_icon); ?>" class="w-7 h-7 text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-3"><?php echo esc_html($s_title); ?></h3>
                            <p class="text-slate-200 mb-4"><?php echo esc_html($s_para); ?></p>
                            <?php if (!empty($s_tags_arr)) : ?>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($s_tags_arr as $tag) : if (trim($tag) === '') continue; ?>
                                <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs font-medium"><?php echo esc_html(trim($tag)); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Risk Taking & Self-Management -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full bg-accent/10 text-accent-dark text-sm font-bold uppercase tracking-wider mb-4"><?php echo esc_html($risk_badge); ?></span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6"><?php echo esc_html($risk_heading); ?></h2>
                    <div class="space-y-6">
                        <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                            <h3 class="text-xl font-bold text-slate-900 mb-3 flex items-center gap-3">
                                <i data-lucide="<?php echo esc_attr($risk_box1_icon); ?>" class="w-6 h-6 text-accent"></i>
                                <?php echo esc_html($risk_box1_title); ?>
                            </h3>
                            <p class="text-slate-600"><?php echo esc_html($risk_box1_para); ?></p>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                            <h3 class="text-xl font-bold text-slate-900 mb-3 flex items-center gap-3">
                                <i data-lucide="<?php echo esc_attr($risk_box2_icon); ?>" class="w-6 h-6 text-primary"></i>
                                <?php echo esc_html($risk_box2_title); ?>
                            </h3>
                            <p class="text-slate-600"><?php echo esc_html($risk_box2_para); ?></p>
                            <?php
                            $risk_tags_arr = array_map('trim', explode(',', $risk_box2_tags));
                            if (!empty($risk_tags_arr)) :
                            ?>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <?php foreach ($risk_tags_arr as $t) : if ($t === '') continue; ?>
                                <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-medium"><?php echo esc_html($t); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative bg-gradient-to-br from-slate-900 to-slate-800 rounded-[1rem] p-8 text-white shadow-xl">
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 rounded-full bg-secondary/20 flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="<?php echo esc_attr($risk_leader_icon); ?>" class="w-10 h-10 text-secondary"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-2"><?php echo esc_html($risk_leader_title); ?></h3>
                            <p class="text-slate-300"><?php echo esc_html($risk_leader_subtitle); ?></p>
                        </div>
                        <div class="space-y-6">
                            <?php foreach ($risk_leader_items as $li) :
                                $li_icon = isset($li['icon']) ? trim((string) $li['icon']) : 'lightbulb';
                                $li_style = isset($li['style']) ? $li['style'] : 'primary-light';
                                $li_title = isset($li['title']) ? (string) $li['title'] : '';
                                $li_sub = isset($li['subtitle']) ? (string) $li['subtitle'] : '';
                                $li_bg = $li_style === 'secondary' ? 'bg-secondary/20' : ($li_style === 'accent' ? 'bg-accent/20' : ($li_style === 'primary-light-2' ? 'bg-primary-light/20' : 'bg-primary/20'));
                                $li_text = $li_style === 'secondary' ? 'text-secondary' : ($li_style === 'accent' ? 'text-accent' : ($li_style === 'primary-light-2' ? 'text-primary-light' : 'text-primary-light'));
                            ?>
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                                <div class="w-12 h-12 rounded-lg <?php echo esc_attr($li_bg); ?> flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($li_icon); ?>" class="w-6 h-6 <?php echo esc_attr($li_text); ?>"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white"><?php echo esc_html($li_title); ?></h4>
                                    <p class="text-sm text-slate-300"><?php echo esc_html($li_sub); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-primary to-primary-dark [&_+_footer]:rounded-t-[0px]">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6"><?php echo esc_html($cta_heading); ?></h2>
            <p class="text-xl text-slate-200 mb-8 max-w-2xl mx-auto"><?php echo esc_html($cta_para); ?></p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo $cta_btn1_url; ?>" target="<?php echo esc_attr($cta_btn1_target); ?>" class="inline-flex items-center justify-center px-4 py-2 sm:px-8 sm:py-4 bg-white text-primary font-bold rounded-full hover:bg-slate-100 transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-xl text-sm sm:text-base">
                    <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 mr-2"></i>
                    <?php echo esc_html($cta_btn1_text); ?>
                </a>
                <a href="<?php echo $cta_btn2_url; ?>" target="<?php echo esc_attr($cta_btn2_target); ?>" class="inline-flex items-center justify-center px-4 py-2 sm:px-8 sm:py-4 bg-secondary text-white font-bold rounded-full hover:bg-accent-dark transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-xl text-sm sm:text-base">
                    <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 mr-2"></i>
                    <?php echo esc_html($cta_btn2_text); ?>
                </a>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
