<?php
/**
 * Template Name: Principal's Message Page
 * Principal: Hero, Principal info sidebar, Message content, Vision (3), CTA – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge    = $opt ? get_field('principal_hero_badge', $page_id) : null;
$hero_headline = $opt ? get_field('principal_hero_headline', $page_id) : null;
$hero_quote    = $opt ? get_field('principal_hero_quote', $page_id) : null;
$hero_intro    = $opt ? get_field('principal_hero_intro', $page_id) : null;
$principal_name = $opt ? get_field('principal_name', $page_id) : null;
$principal_title = $opt ? get_field('principal_title', $page_id) : null;
$principal_school = $opt ? get_field('principal_school', $page_id) : null;
$hero_traits   = $opt ? get_field('principal_hero_traits', $page_id) : null;

$hero_badge    = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'From the Principal\'s Desk';
$hero_headline = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Principal\'s Message';
$hero_quote    = ($hero_quote !== '' && $hero_quote !== null) ? (string) $hero_quote : '"Education is not preparation for life; education is life itself."';
$hero_intro    = ($hero_intro !== '' && $hero_intro !== null) ? (string) $hero_intro : 'Welcome to Mount Litera Zee School, Alwar - where we believe in nurturing minds, building character, and shaping futures. As Principal, I am honored to share our vision and commitment to excellence in education.';
$principal_name = ($principal_name !== '' && $principal_name !== null) ? (string) $principal_name : 'Abhishek Srivastava';
// Initials auto-derived from principal name (e.g. "Abhishek Srivastava" → "AS")
$principal_initials = '';
$name_parts = array_filter(array_map('trim', preg_split('/\s+/', $principal_name, 3)));
if (count($name_parts) >= 2) {
    $principal_initials = strtoupper(mb_substr($name_parts[0], 0, 1) . mb_substr($name_parts[1], 0, 1));
} elseif (count($name_parts) === 1 && $name_parts[0] !== '') {
    $principal_initials = strtoupper(mb_substr($name_parts[0], 0, 2));
}
if ($principal_initials === '') $principal_initials = 'AS';
$principal_title = ($principal_title !== '' && $principal_title !== null) ? (string) $principal_title : 'Principal';
$principal_school = ($principal_school !== '' && $principal_school !== null) ? (string) $principal_school : 'Mount Litera Zee School, Alwar';

$default_traits = array(
    array('icon' => 'graduation-cap', 'label' => 'Educational Leadership'),
    array('icon' => 'award', 'label' => 'Years of Experience'),
    array('icon' => 'heart', 'label' => 'Student-Centered Approach'),
);
$hero_traits = (is_array($hero_traits) && count($hero_traits) >= 3) ? $hero_traits : $default_traits;

// ——— Sidebar ———
$principal_photo = $opt ? get_field('principal_photo', $page_id) : null;
$leadership_heading = $opt ? get_field('principal_leadership_heading', $page_id) : null;
$leadership_para = $opt ? get_field('principal_leadership_para', $page_id) : null;
$core_beliefs = $opt ? get_field('principal_core_beliefs', $page_id) : null;

$principal_photo_url = '';
if (!empty($principal_photo) && is_array($principal_photo) && !empty($principal_photo['url'])) {
    $principal_photo_url = $principal_photo['url'];
}
$leadership_heading = ($leadership_heading !== '' && $leadership_heading !== null) ? (string) $leadership_heading : 'Leadership Philosophy';
$leadership_para = ($leadership_para !== '' && $leadership_para !== null) ? (string) $leadership_para : 'Believing in the potential of every child and creating environments where they can discover and develop their unique talents.';
$default_beliefs = array(
    array('text' => 'Every child is unique and gifted'),
    array('text' => 'Education should be holistic'),
    array('text' => 'Character building is fundamental'),
    array('text' => 'Innovation in teaching is essential'),
);
$core_beliefs = (is_array($core_beliefs) && count($core_beliefs) >= 4) ? $core_beliefs : $default_beliefs;

// ——— Message content ———
$welcome_heading = $opt ? get_field('principal_welcome_heading', $page_id) : null;
$welcome_icon = $opt ? get_field('principal_welcome_icon', $page_id) : null;
$welcome_highlight = $opt ? get_field('principal_welcome_highlight', $page_id) : null;
$welcome_para = $opt ? get_field('principal_welcome_para', $page_id) : null;
$skills_heading = $opt ? get_field('principal_skills_heading', $page_id) : null;
$skills_icon = $opt ? get_field('principal_skills_icon', $page_id) : null;
$skills_intro = $opt ? get_field('principal_skills_intro', $page_id) : null;
$skills_cards = $opt ? get_field('principal_skills_cards', $page_id) : null;
$commitment_heading = $opt ? get_field('principal_commitment_heading', $page_id) : null;
$commitment_icon = $opt ? get_field('principal_commitment_icon', $page_id) : null;
$commitment_items = $opt ? get_field('principal_commitment_items', $page_id) : null;
$closing_heading = $opt ? get_field('principal_closing_heading', $page_id) : null;
$closing_para = $opt ? get_field('principal_closing_para', $page_id) : null;
$closing_signature = $opt ? get_field('principal_closing_signature', $page_id) : null;
$closing_title = $opt ? get_field('principal_closing_title', $page_id) : null;
$closing_school = $opt ? get_field('principal_closing_school', $page_id) : null;
$closing_exp_label = $opt ? get_field('principal_closing_exp_label', $page_id) : null;

$welcome_heading = ($welcome_heading !== '' && $welcome_heading !== null) ? (string) $welcome_heading : 'Welcome to Our School Family';
$welcome_icon = (is_string($welcome_icon) && trim($welcome_icon) !== '') ? trim($welcome_icon) : 'school';
$welcome_highlight = ($welcome_highlight !== '' && $welcome_highlight !== null) ? (string) $welcome_highlight : 'Mount Litera Zee School Alwar is committed to providing a nurturing and inspiring educational program for all students. It is our goal that each student realizes his/her potential through our challenging program and rigorous experiential teaching.';
$welcome_para = ($welcome_para !== '' && $welcome_para !== null) ? (string) $welcome_para : 'At Mount Litera Zee School, we believe that education extends far beyond textbooks and classrooms. We are dedicated to creating an environment where curiosity is encouraged, creativity is nurtured, and character is built. Our approach combines academic rigor with emotional intelligence, ensuring that our students are not only knowledgeable but also compassionate and resilient individuals.';
$skills_heading = ($skills_heading !== '' && $skills_heading !== null) ? (string) $skills_heading : 'Preparing for the 21st Century';
$skills_icon = (is_string($skills_icon) && trim($skills_icon) !== '') ? trim($skills_icon) : 'zap';
$skills_intro = ($skills_intro !== '' && $skills_intro !== null) ? (string) $skills_intro : 'We look forward to developing the skills that students will need in the 21st century: effective learning, critical thinking, collaboration, creativity, and most importantly, Character. These skills form the foundation upon which successful futures are built.';
$default_skills = array(
    array('icon' => 'brain', 'style' => 'primary', 'title' => 'Critical Thinking', 'paragraph' => 'Developing analytical minds that can evaluate information, solve complex problems, and make informed decisions.'),
    array('icon' => 'users', 'style' => 'secondary', 'title' => 'Collaboration', 'paragraph' => 'Fostering teamwork and interpersonal skills essential for success in today\'s interconnected world.'),
    array('icon' => 'sparkles', 'style' => 'accent', 'title' => 'Creativity', 'paragraph' => 'Encouraging innovative thinking and original ideas that drive progress and innovation.'),
    array('icon' => 'heart', 'style' => 'primary-light', 'title' => 'Character', 'paragraph' => 'Building strong moral values, integrity, and ethical foundations that guide lifelong decisions.'),
);
$skills_cards = (is_array($skills_cards) && count($skills_cards) >= 4) ? $skills_cards : $default_skills;
$commitment_heading = ($commitment_heading !== '' && $commitment_heading !== null) ? (string) $commitment_heading : 'Our Educational Commitment';
$commitment_icon = (is_string($commitment_icon) && trim($commitment_icon) !== '') ? trim($commitment_icon) : 'target';
$default_commitment = array(
    array('icon' => 'check', 'style' => 'primary', 'title' => 'Experiential Learning', 'paragraph' => 'We believe that the most profound learning happens through experience. Our curriculum is designed to provide hands-on learning opportunities that connect theoretical knowledge with real-world applications.'),
    array('icon' => 'check', 'style' => 'secondary', 'title' => 'Personalized Attention', 'paragraph' => 'Recognizing that each child learns differently, we provide individualized support and guidance to help every student discover their unique strengths and overcome challenges.'),
    array('icon' => 'check', 'style' => 'accent', 'title' => 'Safe & Nurturing Environment', 'paragraph' => 'We prioritize creating a safe, inclusive, and supportive atmosphere where students feel valued, respected, and empowered to express themselves freely.'),
);
$commitment_items = (is_array($commitment_items) && count($commitment_items) >= 3) ? $commitment_items : $default_commitment;
$closing_heading = ($closing_heading !== '' && $closing_heading !== null) ? (string) $closing_heading : 'A Personal Invitation';
$closing_para = ($closing_para !== '' && $closing_para !== null) ? (string) $closing_para : 'Thanks for visiting our website. I look forward to welcoming you in the portals of our school, where together we can embark on an educational journey that will shape not just successful students, but exceptional human beings ready to make a positive impact on the world.';
$closing_signature = ($closing_signature !== '' && $closing_signature !== null) ? (string) $closing_signature : 'Abhishek Srivastava';
$closing_title = ($closing_title !== '' && $closing_title !== null) ? (string) $closing_title : 'Principal';
$closing_school = ($closing_school !== '' && $closing_school !== null) ? (string) $closing_school : 'Mount Litera Zee School, Alwar';
$closing_exp_label = ($closing_exp_label !== '' && $closing_exp_label !== null) ? (string) $closing_exp_label : 'Years of Educational Leadership Experience';

// ——— Vision ———
$vision_heading = $opt ? get_field('principal_vision_heading', $page_id) : null;
$vision_subtext = $opt ? get_field('principal_vision_subtext', $page_id) : null;
$vision_items = $opt ? get_field('principal_vision_items', $page_id) : null;

$vision_heading = ($vision_heading !== '' && $vision_heading !== null) ? (string) $vision_heading : 'Our Vision for Every Student';
$vision_subtext = ($vision_subtext !== '' && $vision_subtext !== null) ? (string) $vision_subtext : 'At Mount Litera Zee School, we envision our students as future leaders equipped with knowledge, character, and compassion';
$default_vision = array(
    array('icon' => 'book-open', 'gradient' => 'primary', 'title' => 'Academic Excellence', 'paragraph' => 'Developing deep understanding, critical thinking, and a lifelong love for learning through our challenging academic program.'),
    array('icon' => 'heart', 'gradient' => 'secondary', 'title' => 'Character Building', 'paragraph' => 'Instilling strong values, empathy, resilience, and ethical foundations that guide students throughout their lives.'),
    array('icon' => 'globe', 'gradient' => 'accent', 'title' => 'Global Readiness', 'paragraph' => 'Preparing students to thrive in a rapidly changing world with cross-cultural understanding and 21st-century skills.'),
);
$vision_items = (is_array($vision_items) && count($vision_items) >= 3) ? $vision_items : $default_vision;

// ——— CTA ———
$cta_badge = $opt ? get_field('principal_cta_badge', $page_id) : null;
$cta_heading = $opt ? get_field('principal_cta_heading', $page_id) : null;
$cta_para = $opt ? get_field('principal_cta_para', $page_id) : null;
$cta_btn1_link = $opt ? get_field('principal_cta_btn1_link', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('principal_cta_btn1_icon', $page_id) : null;
$cta_btn2_link = $opt ? get_field('principal_cta_btn2_link', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('principal_cta_btn2_icon', $page_id) : null;

$cta_badge = ($cta_badge !== '' && $cta_badge !== null) ? (string) $cta_badge : 'Experience Our Campus';
$cta_heading = ($cta_heading !== '' && $cta_heading !== null) ? (string) $cta_heading : 'Visit Us and See the Difference';
$cta_para = ($cta_para !== '' && $cta_para !== null) ? (string) $cta_para : 'Experience firsthand how Mount Litera Zee School transforms education and shapes future leaders. Schedule a visit to meet our faculty, see our facilities, and understand our educational philosophy.';
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'calendar';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'message-circle';

$cta_btn1_url = $cta_btn1_target = $cta_btn1_text = '#';
if (!empty($cta_btn1_link) && is_array($cta_btn1_link)) {
    $cta_btn1_url = isset($cta_btn1_link['url']) ? esc_url($cta_btn1_link['url']) : '#';
    $cta_btn1_target = isset($cta_btn1_link['target']) ? $cta_btn1_link['target'] : '_self';
    $cta_btn1_text = isset($cta_btn1_link['title']) && trim((string) $cta_btn1_link['title']) !== '' ? (string) $cta_btn1_link['title'] : 'Schedule a Campus Tour';
} else { $cta_btn1_text = 'Schedule a Campus Tour'; }
$cta_btn2_url = $cta_btn2_target = $cta_btn2_text = '#';
if (!empty($cta_btn2_link) && is_array($cta_btn2_link)) {
    $cta_btn2_url = isset($cta_btn2_link['url']) ? esc_url($cta_btn2_link['url']) : '#';
    $cta_btn2_target = isset($cta_btn2_link['target']) ? $cta_btn2_link['target'] : '_self';
    $cta_btn2_text = isset($cta_btn2_link['title']) && trim((string) $cta_btn2_link['title']) !== '' ? (string) $cta_btn2_link['title'] : 'Contact the Principal\'s Office';
} else { $cta_btn2_text = 'Contact the Principal\'s Office'; }
?>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 md:pt-40 md:pb-28 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-dark to-slate-900 opacity-95"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full bg-secondary/30 blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full bg-accent/20 blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-2/3">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-secondary"></span>
                        </span>
                        <span class="text-xs font-semibold text-white uppercase tracking-wider"><?php echo esc_html($hero_badge); ?></span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6"><?php echo esc_html($hero_headline); ?></h1>
                    <div class="relative pl-8 border-l-4 border-secondary mb-8">
                        <p class="text-xl text-slate-200 italic font-serif"><?php echo esc_html($hero_quote); ?></p>
                    </div>
                    <p class="text-lg text-slate-200 mb-8 leading-relaxed"><?php echo esc_html($hero_intro); ?></p>
                </div>
                <div class="lg:w-1/3">
                    <div class="relative">
                        <div class="absolute -top-6 -right-6 w-72 h-72 bg-secondary/20 rounded-full blur-2xl"></div>
                        <div class="relative bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl">
                            <div class="text-center mb-6">
                                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-primary-light to-secondary mx-auto mb-4 flex items-center justify-center text-white text-4xl font-bold"><?php echo esc_html($principal_initials); ?></div>
                                <h3 class="text-2xl font-bold text-white"><?php echo esc_html($principal_name); ?></h3>
                                <p class="text-secondary font-medium"><?php echo esc_html($principal_title); ?></p>
                                <p class="text-slate-300 text-sm mt-2"><?php echo esc_html($principal_school); ?></p>
                            </div>
                            <div class="space-y-3">
                                <?php foreach ($hero_traits as $t) :
                                    $t_icon = isset($t['icon']) ? trim((string) $t['icon']) : 'graduation-cap';
                                    $t_label = isset($t['label']) ? (string) $t['label'] : '';
                                    if ($t_label === '') continue;
                                ?>
                                <div class="flex items-center gap-3 text-slate-300">
                                    <i data-lucide="<?php echo esc_attr($t_icon); ?>" class="w-5 h-5 text-secondary"></i>
                                    <span class="text-sm"><?php echo esc_html($t_label); ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Message Section -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Principal's Photo & Info -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <div class="relative mb-8">
                            <div class="aspect-square rounded-2xl overflow-hidden shadow-soft">
                                <?php if ($principal_photo_url) : ?>
                                <img src="<?php echo esc_url($principal_photo_url); ?>" alt="<?php echo esc_attr($principal_name); ?>" class="w-full h-full object-cover">
                                <?php else : ?>
                                <div class="w-full h-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                    <div class="text-white text-center p-8">
                                        <div class="text-6xl font-bold mb-4"><?php echo esc_html($principal_initials); ?></div>
                                        <h3 class="text-2xl font-bold"><?php echo esc_html($principal_name); ?></h3>
                                        <p class="text-secondary font-medium mt-2"><?php echo esc_html($principal_title); ?></p>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-full bg-accent/20 blur-xl"></div>
                        </div>
                        <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-6 border border-slate-200 shadow-soft">
                            <h4 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                                <i data-lucide="target" class="w-5 h-5 text-primary"></i>
                                <?php echo esc_html($leadership_heading); ?>
                            </h4>
                            <p class="text-slate-600 text-sm mb-4"><?php echo esc_html($leadership_para); ?></p>
                            <div class="pt-4 border-t border-slate-200">
                                <h5 class="text-sm font-bold text-slate-900 mb-2">Core Beliefs:</h5>
                                <ul class="space-y-2">
                                    <?php foreach ($core_beliefs as $b) :
                                        $b_text = isset($b['text']) ? (string) $b['text'] : '';
                                        if ($b_text === '') continue;
                                    ?>
                                    <li class="flex items-center gap-2 text-slate-600 text-sm">
                                        <i data-lucide="check-circle" class="w-4 h-4 text-secondary"></i>
                                        <?php echo esc_html($b_text); ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Message Content -->
                <div class="lg:col-span-2">
                    <div class="prose prose-lg max-w-none">
                        <div class="mb-12">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($welcome_icon); ?>" class="w-6 h-6 text-primary"></i>
                                </div>
                                <h2 class="text-3xl font-bold text-slate-900"><?php echo esc_html($welcome_heading); ?></h2>
                            </div>
                            <div class="bg-gradient-to-r from-primary/5 to-transparent rounded-2xl p-8 mb-8 border-l-4 border-primary">
                                <p class="text-lg text-slate-700 leading-relaxed"><?php echo esc_html($welcome_highlight); ?></p>
                            </div>
                            <p class="text-slate-600 mb-6 leading-relaxed"><?php echo esc_html($welcome_para); ?></p>
                        </div>
                        <div class="mb-12">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl bg-secondary/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($skills_icon); ?>" class="w-6 h-6 text-secondary"></i>
                                </div>
                                <h2 class="text-3xl font-bold text-slate-900"><?php echo esc_html($skills_heading); ?></h2>
                            </div>
                            <p class="text-slate-600 mb-6 leading-relaxed"><?php echo esc_html($skills_intro); ?></p>
                            <div class="grid md:grid-cols-2 gap-6 mb-8">
                                <?php foreach ($skills_cards as $sc) :
                                    $sc_icon = isset($sc['icon']) ? trim((string) $sc['icon']) : 'brain';
                                    $sc_style = isset($sc['style']) ? $sc['style'] : 'primary';
                                    $sc_title = isset($sc['title']) ? (string) $sc['title'] : '';
                                    $sc_para = isset($sc['paragraph']) ? (string) $sc['paragraph'] : '';
                                    $sc_bg = $sc_style === 'secondary' ? 'bg-secondary/10' : ($sc_style === 'accent' ? 'bg-accent/10' : ($sc_style === 'primary-light' ? 'bg-primary-light/10' : 'bg-primary/10'));
                                    $sc_text = $sc_style === 'secondary' ? 'text-secondary' : ($sc_style === 'accent' ? 'text-accent' : ($sc_style === 'primary-light' ? 'text-primary-light' : 'text-primary'));
                                ?>
                                <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 rounded-lg <?php echo esc_attr($sc_bg); ?> flex items-center justify-center">
                                            <i data-lucide="<?php echo esc_attr($sc_icon); ?>" class="w-5 h-5 <?php echo esc_attr($sc_text); ?>"></i>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-900"><?php echo esc_html($sc_title); ?></h3>
                                    </div>
                                    <p class="text-slate-600 text-sm"><?php echo esc_html($sc_para); ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="mb-12">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center">
                                    <i data-lucide="<?php echo esc_attr($commitment_icon); ?>" class="w-6 h-6 text-accent"></i>
                                </div>
                                <h2 class="text-3xl font-bold text-slate-900"><?php echo esc_html($commitment_heading); ?></h2>
                            </div>
                            <div class="space-y-6">
                                <?php foreach ($commitment_items as $ci) :
                                    $ci_icon = isset($ci['icon']) ? trim((string) $ci['icon']) : 'check';
                                    $ci_style = isset($ci['style']) ? $ci['style'] : 'primary';
                                    $ci_title = isset($ci['title']) ? (string) $ci['title'] : '';
                                    $ci_para = isset($ci['paragraph']) ? (string) $ci['paragraph'] : '';
                                    $ci_bg = $ci_style === 'secondary' ? 'bg-secondary/10' : ($ci_style === 'accent' ? 'bg-accent/10' : 'bg-primary/10');
                                    $ci_text = $ci_style === 'secondary' ? 'text-secondary' : ($ci_style === 'accent' ? 'text-accent' : 'text-primary');
                                ?>
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full <?php echo esc_attr($ci_bg); ?> flex items-center justify-center shrink-0 mt-1">
                                        <i data-lucide="<?php echo esc_attr($ci_icon); ?>" class="w-4 h-4 <?php echo esc_attr($ci_text); ?>"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-900 mb-2"><?php echo esc_html($ci_title); ?></h3>
                                        <p class="text-slate-600"><?php echo esc_html($ci_para); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl p-8 border border-primary/20">
                            <div class="flex items-center gap-3 mb-4">
                                <i data-lucide="message-square" class="w-6 h-6 text-primary"></i>
                                <h3 class="text-xl font-bold text-slate-900"><?php echo esc_html($closing_heading); ?></h3>
                            </div>
                            <p class="text-slate-700 mb-6 leading-relaxed"><?php echo esc_html($closing_para); ?></p>
                            <div class="pt-6 border-t border-primary/20">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div>
                                        <p class="font-bold text-slate-900">Warm regards,</p>
                                        <p class="font-serif italic text-2xl text-primary mt-2"><?php echo esc_html($closing_signature); ?></p>
                                        <p class="text-secondary font-medium"><?php echo esc_html($closing_title); ?></p>
                                        <p class="text-slate-600 text-sm"><?php echo esc_html($closing_school); ?></p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                                            <i data-lucide="calendar" class="w-6 h-6 text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-slate-600"><?php echo esc_html($closing_exp_label); ?></p>
                                            <p class="font-bold text-slate-900">Leadership Experience</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision for Students -->
    <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-50 to-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4"><?php echo esc_html($vision_heading); ?></h2>
                <p class="text-lg text-slate-600 max-w-3xl mx-auto"><?php echo esc_html($vision_subtext); ?></p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <?php foreach ($vision_items as $vi) :
                    $vi_icon = isset($vi['icon']) ? trim((string) $vi['icon']) : 'book-open';
                    $vi_grad = isset($vi['gradient']) ? $vi['gradient'] : 'primary';
                    $vi_title = isset($vi['title']) ? (string) $vi['title'] : '';
                    $vi_para = isset($vi['paragraph']) ? (string) $vi['paragraph'] : '';
                    $vi_from = $vi_grad === 'secondary' ? 'from-secondary to-accent' : ($vi_grad === 'accent' ? 'from-primary-light to-secondary' : 'from-primary to-primary-light');
                ?>
                <div class="group text-center">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br <?php echo esc_attr($vi_from); ?> mx-auto flex items-center justify-center text-white text-2xl mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="<?php echo esc_attr($vi_icon); ?>" class="w-10 h-10"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3"><?php echo esc_html($vi_title); ?></h3>
                    <p class="text-slate-600"><?php echo esc_html($vi_para); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 [&_+_footer]:rounded-t-[0px] md:py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-primary to-primary-dark">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                <i data-lucide="school" class="w-5 h-5 text-secondary"></i>
                <span class="text-sm font-semibold text-white"><?php echo esc_html($cta_badge); ?></span>
            </div>
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
