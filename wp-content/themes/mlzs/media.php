<?php
/**
 * Template Name: Multimedia Page
 * Media: Hero, Intro (2 cols), Core Features (3), USP, Creative Team (3), Benefits (student 4 + teacher 3), CTA – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$opt = function_exists('get_field');

function mlzs_media_img_url($img) {
    if (empty($img)) return '';
    if (is_array($img) && !empty($img['url'])) return $img['url'];
    if (is_numeric($img)) return wp_get_attachment_image_url((int) $img, 'full') ?: '';
    return '';
}

// ——— Hero ———
$hero_badge   = $opt ? get_field('media_hero_badge', $page_id) : null;
$hero_icon    = $opt ? get_field('media_hero_icon', $page_id) : null;
$hero_before  = $opt ? get_field('media_hero_headline_before', $page_id) : null;
$hero_highlight = $opt ? get_field('media_hero_headline_highlight', $page_id) : null;
$hero_subtext = $opt ? get_field('media_hero_subtext', $page_id) : null;

$hero_badge   = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Digital Learning';
$hero_icon    = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'tv';
$hero_before  = ($hero_before !== '' && $hero_before !== null) ? (string) $hero_before : 'Interactive';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Multimedia Classes';
$hero_subtext = ($hero_subtext !== '' && $hero_subtext !== null) ? (string) $hero_subtext : 'Pioneering digital education with cutting-edge multimedia classrooms that blend technology with pedagogy for an immersive learning experience.';

// ——— Intro ———
$intro_badge   = $opt ? get_field('media_intro_badge', $page_id) : null;
$intro_icon    = $opt ? get_field('media_intro_icon', $page_id) : null;
$intro_heading_before  = $opt ? get_field('media_intro_heading_before', $page_id) : null;
$intro_heading_highlight = $opt ? get_field('media_intro_heading_highlight', $page_id) : null;
$intro_subtext = $opt ? get_field('media_intro_subtext', $page_id) : null;
$intro_left_icon  = $opt ? get_field('media_intro_left_icon', $page_id) : null;
$intro_left_title = $opt ? get_field('media_intro_left_title', $page_id) : null;
$intro_left_para1 = $opt ? get_field('media_intro_left_para1', $page_id) : null;
$intro_left_para2 = $opt ? get_field('media_intro_left_para2', $page_id) : null;
$intro_left_image = $opt ? get_field('media_intro_left_image', $page_id) : null;
$intro_left_image_caption = $opt ? get_field('media_intro_left_image_caption', $page_id) : null;
$intro_left_image_icon    = $opt ? get_field('media_intro_left_image_icon', $page_id) : null;
$intro_right_image = $opt ? get_field('media_intro_right_image', $page_id) : null;
$intro_right_image_caption = $opt ? get_field('media_intro_right_image_caption', $page_id) : null;
$intro_right_image_icon    = $opt ? get_field('media_intro_right_image_icon', $page_id) : null;
$intro_right_icon  = $opt ? get_field('media_intro_right_icon', $page_id) : null;
$intro_right_title = $opt ? get_field('media_intro_right_title', $page_id) : null;
$intro_right_para1 = $opt ? get_field('media_intro_right_para1', $page_id) : null;
$intro_right_para2 = $opt ? get_field('media_intro_right_para2', $page_id) : null;

$intro_badge   = ($intro_badge !== '' && $intro_badge !== null) ? (string) $intro_badge : 'Innovation';
$intro_icon    = (is_string($intro_icon) && trim($intro_icon) !== '') ? trim($intro_icon) : 'zap';
$intro_heading_before  = ($intro_heading_before !== '' && $intro_heading_before !== null) ? (string) $intro_heading_before : 'Revolutionizing Education Through';
$intro_heading_highlight = ($intro_heading_highlight !== '' && $intro_heading_highlight !== null) ? (string) $intro_heading_highlight : 'Technology';
$intro_subtext = ($intro_subtext !== '' && $intro_subtext !== null) ? (string) $intro_subtext : 'Mount Litera Zee School is the first school in the city to implement this advanced interactive classroom solution, setting new standards in digital education.';
$intro_left_icon  = (is_string($intro_left_icon) && trim($intro_left_icon) !== '') ? trim($intro_left_icon) : 'globe';
$intro_left_title = ($intro_left_title !== '' && $intro_left_title !== null) ? (string) $intro_left_title : 'World-Class Interactive Solution';
$intro_left_para1 = ($intro_left_para1 !== '' && $intro_left_para1 !== null) ? (string) $intro_left_para1 : 'Mount Litera Zee School has implemented an interactive classroom solution to provide world-class education for their students. Classes developed by Interactive Systems for the Mount Litera School help teachers deliver high-quality instruction with an effective blend of classroom activities and interactive multimedia demonstrations.';
$intro_left_para2 = ($intro_left_para2 !== '' && $intro_left_para2 !== null) ? (string) $intro_left_para2 : 'The Mount Litera is the first school in the city to implement this solution for the benefit of the students to make them better equipped for tomorrow\'s world.';
$intro_right_icon  = (is_string($intro_right_icon) && trim($intro_right_icon) !== '') ? trim($intro_right_icon) : 'cloud';
$intro_right_title = ($intro_right_title !== '' && $intro_right_title !== null) ? (string) $intro_right_title : 'Advanced Technology Infrastructure';
$intro_right_para1 = ($intro_right_para1 !== '' && $intro_right_para1 !== null) ? (string) $intro_right_para1 : 'The multimedia classes solution consists of the latest technology equipment viz. projector, updation of content via cloud computing so that real-time updates are possible in the classroom.';
$intro_right_para2 = ($intro_right_para2 !== '' && $intro_right_para2 !== null) ? (string) $intro_right_para2 : 'Apart from technology, the biggest USP is the way in which multimedia classes have been conceptualized i.e., Multiple Learning Experiences Model and empowering teachers with the Lesson Plan approach.';

$intro_left_image_caption  = ($intro_left_image_caption !== '' && $intro_left_image_caption !== null) ? (string) $intro_left_image_caption : 'Interactive Multimedia Classroom';
$intro_left_image_icon     = (is_string($intro_left_image_icon) && trim($intro_left_image_icon) !== '') ? trim($intro_left_image_icon) : 'tv';
$intro_right_image_caption = ($intro_right_image_caption !== '' && $intro_right_image_caption !== null) ? (string) $intro_right_image_caption : 'Cloud-Based Learning Content';
$intro_right_image_icon    = (is_string($intro_right_image_icon) && trim($intro_right_image_icon) !== '') ? trim($intro_right_image_icon) : 'cloud';

$intro_left_img_url  = mlzs_media_img_url($intro_left_image);
if ($intro_left_img_url === '') $intro_left_img_url = 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1200&h=900&fit=crop';
$intro_right_img_url = mlzs_media_img_url($intro_right_image);
if ($intro_right_img_url === '') $intro_right_img_url = 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1200&h=900&fit=crop';
$intro_left_alt  = (is_array($intro_left_image) && isset($intro_left_image['alt']) && trim((string) $intro_left_image['alt']) !== '') ? trim($intro_left_image['alt']) : $intro_left_title;
$intro_right_alt = (is_array($intro_right_image) && isset($intro_right_image['alt']) && trim((string) $intro_right_image['alt']) !== '') ? trim($intro_right_image['alt']) : $intro_right_title;

// ——— Core Features ———
$feat_badge   = $opt ? get_field('media_features_badge', $page_id) : null;
$feat_icon    = $opt ? get_field('media_features_icon', $page_id) : null;
$feat_before  = $opt ? get_field('media_features_heading_before', $page_id) : null;
$feat_highlight = $opt ? get_field('media_features_heading_highlight', $page_id) : null;
$feat_subtext = $opt ? get_field('media_features_subtext', $page_id) : null;
$feat_items   = $opt ? get_field('media_features_items', $page_id) : null;

$feat_badge   = ($feat_badge !== '' && $feat_badge !== null) ? (string) $feat_badge : 'Core Technology';
$feat_icon    = (is_string($feat_icon) && trim($feat_icon) !== '') ? trim($feat_icon) : 'cpu';
$feat_before  = ($feat_before !== '' && $feat_before !== null) ? (string) $feat_before : 'Cutting-Edge';
$feat_highlight = ($feat_highlight !== '' && $feat_highlight !== null) ? (string) $feat_highlight : 'Multimedia Features';
$feat_subtext = ($feat_subtext !== '' && $feat_subtext !== null) ? (string) $feat_subtext : 'Our multimedia classrooms are equipped with the latest technology to create an engaging and effective learning environment.';

$default_feat_items = array(
    array('icon' => 'projector', 'style' => 'primary', 'title' => 'Advanced Projector Systems', 'paragraph' => 'State-of-the-art projectors installed in every multimedia classroom for crystal-clear display of educational content, diagrams, and multimedia presentations.'),
    array('icon' => 'cloud', 'style' => 'accent', 'title' => 'Cloud Computing Integration', 'paragraph' => 'Real-time content updates via cloud computing ensure that classroom materials are always current and relevant to the latest curriculum standards.'),
    array('icon' => 'users', 'style' => 'primary-light', 'title' => 'Creative Content Team', 'paragraph' => 'In-house team of teachers, instructional designers, and software programmers continuously create, develop, and upload engaging lesson content.'),
);
$feat_items = (is_array($feat_items) && count($feat_items) >= 3) ? $feat_items : $default_feat_items;

// ——— USP ———
$usp_badge   = $opt ? get_field('media_usp_badge', $page_id) : null;
$usp_icon    = $opt ? get_field('media_usp_icon', $page_id) : null;
$usp_before  = $opt ? get_field('media_usp_heading_before', $page_id) : null;
$usp_highlight = $opt ? get_field('media_usp_heading_highlight', $page_id) : null;
$usp_items   = $opt ? get_field('media_usp_items', $page_id) : null;
$usp_right_title = $opt ? get_field('media_usp_right_title', $page_id) : null;
$usp_right_items = $opt ? get_field('media_usp_right_items', $page_id) : null;

$usp_badge   = ($usp_badge !== '' && $usp_badge !== null) ? (string) $usp_badge : 'Unique Advantages';
$usp_icon    = (is_string($usp_icon) && trim($usp_icon) !== '') ? trim($usp_icon) : 'sparkles';
$usp_before  = ($usp_before !== '' && $usp_before !== null) ? (string) $usp_before : 'Multiple Learning';
$usp_highlight = ($usp_highlight !== '' && $usp_highlight !== null) ? (string) $usp_highlight : 'Experiences Model';
$usp_right_title = ($usp_right_title !== '' && $usp_right_title !== null) ? (string) $usp_right_title : 'Pioneering Achievement';

$default_usp_items = array(
    array('icon_style' => 'green', 'icon' => 'book-open', 'title' => 'Lesson Plan Approach', 'paragraph' => 'Empowering teachers with structured lesson plans that integrate multimedia elements seamlessly into traditional teaching methodologies.'),
    array('icon_style' => 'blue', 'icon' => 'refresh-cw', 'title' => 'Real-time Content Updates', 'paragraph' => 'Cloud-based system allows instant updates to educational content, ensuring students always have access to the most current information.'),
    array('icon_style' => 'purple', 'icon' => 'layers', 'title' => 'Blended Learning Design', 'paragraph' => 'Effective integration of classroom activities with interactive multimedia demonstrations for a comprehensive learning experience.'),
);
$usp_items = (is_array($usp_items) && count($usp_items) >= 3) ? $usp_items : $default_usp_items;

$default_usp_right = array(
    array('icon' => 'star', 'title' => 'First in the City', 'paragraph' => 'First school in the city to implement this advanced interactive classroom solution'),
    array('icon' => 'target', 'title' => 'Future-Ready Students', 'paragraph' => 'Equipping students with skills and knowledge for tomorrow\'s world'),
    array('icon' => 'trending-up', 'title' => 'Quality Instruction', 'paragraph' => 'Enabling teachers to deliver high-quality instruction with multimedia support'),
);
$usp_right_items = (is_array($usp_right_items) && count($usp_right_items) >= 3) ? $usp_right_items : $default_usp_right;

// ——— Creative Team ———
$team_badge   = $opt ? get_field('media_team_badge', $page_id) : null;
$team_icon    = $opt ? get_field('media_team_icon', $page_id) : null;
$team_before  = $opt ? get_field('media_team_heading_before', $page_id) : null;
$team_highlight = $opt ? get_field('media_team_heading_highlight', $page_id) : null;
$team_subtext = $opt ? get_field('media_team_subtext', $page_id) : null;
$team_items   = $opt ? get_field('media_team_items', $page_id) : null;
$team_banner_heading = $opt ? get_field('media_team_banner_heading', $page_id) : null;
$team_banner_para   = $opt ? get_field('media_team_banner_para', $page_id) : null;

$team_badge   = ($team_badge !== '' && $team_badge !== null) ? (string) $team_badge : 'Behind the Scenes';
$team_icon    = (is_string($team_icon) && trim($team_icon) !== '') ? trim($team_icon) : 'users';
$team_before  = ($team_before !== '' && $team_before !== null) ? (string) $team_before : 'Our In-House';
$team_highlight = ($team_highlight !== '' && $team_highlight !== null) ? (string) $team_highlight : 'Creative Team';
$team_subtext = ($team_subtext !== '' && $team_subtext !== null) ? (string) $team_subtext : 'A dedicated team of professionals working continuously to develop engaging and effective multimedia content for our students.';
$team_banner_heading = ($team_banner_heading !== '' && $team_banner_heading !== null) ? (string) $team_banner_heading : 'Continuous Content Development';
$team_banner_para   = ($team_banner_para !== '' && $team_banner_para !== null) ? (string) $team_banner_para : 'Our creative team continuously creates, develops, and uploads lesson content, ensuring that students always have access to fresh, relevant, and engaging educational materials tailored to their learning needs.';

$default_team_items = array(
    array('icon' => 'user-check', 'style' => 'primary', 'title' => 'Experienced Teachers', 'paragraph' => 'Seasoned educators who understand classroom dynamics and student learning patterns.', 'label' => 'Curriculum Experts'),
    array('icon' => 'layout', 'style' => 'accent', 'title' => 'Instructional Designers', 'paragraph' => 'Specialists in creating effective learning experiences through multimedia design.', 'label' => 'Learning Experience Design'),
    array('icon' => 'code', 'style' => 'primary-light', 'title' => 'Software Programmers', 'paragraph' => 'Technical experts who develop and maintain the digital infrastructure and content platforms.', 'label' => 'Technology Development'),
);
$team_items = (is_array($team_items) && count($team_items) >= 3) ? $team_items : $default_team_items;

// ——— Benefits ———
$ben_student_icon    = $opt ? get_field('media_benefits_student_icon', $page_id) : null;
$ben_student_badge   = $opt ? get_field('media_benefits_student_badge', $page_id) : null;
$ben_student_heading = $opt ? get_field('media_benefits_student_heading', $page_id) : null;
$ben_student_highlight = $opt ? get_field('media_benefits_student_highlight', $page_id) : null;
$ben_student_items   = $opt ? get_field('media_benefits_student_items', $page_id) : null;
$ben_teacher_icon    = $opt ? get_field('media_benefits_teacher_icon', $page_id) : null;
$ben_teacher_badge   = $opt ? get_field('media_benefits_teacher_badge', $page_id) : null;
$ben_teacher_heading = $opt ? get_field('media_benefits_teacher_heading', $page_id) : null;
$ben_teacher_highlight = $opt ? get_field('media_benefits_teacher_highlight', $page_id) : null;
$ben_teacher_items   = $opt ? get_field('media_benefits_teacher_items', $page_id) : null;

$ben_student_icon    = (is_string($ben_student_icon) && trim($ben_student_icon) !== '') ? trim($ben_student_icon) : 'graduation-cap';
$ben_student_badge   = ($ben_student_badge !== '' && $ben_student_badge !== null) ? (string) $ben_student_badge : 'Student Benefits';
$ben_student_heading = ($ben_student_heading !== '' && $ben_student_heading !== null) ? (string) $ben_student_heading : 'Preparing Students for';
$ben_student_highlight = ($ben_student_highlight !== '' && $ben_student_highlight !== null) ? (string) $ben_student_highlight : 'Tomorrow\'s World';
$ben_teacher_icon    = (is_string($ben_teacher_icon) && trim($ben_teacher_icon) !== '') ? trim($ben_teacher_icon) : 'user-plus';
$ben_teacher_badge   = ($ben_teacher_badge !== '' && $ben_teacher_badge !== null) ? (string) $ben_teacher_badge : 'Teacher Benefits';
$ben_teacher_heading = ($ben_teacher_heading !== '' && $ben_teacher_heading !== null) ? (string) $ben_teacher_heading : 'Empowering Our';
$ben_teacher_highlight = ($ben_teacher_highlight !== '' && $ben_teacher_highlight !== null) ? (string) $ben_teacher_highlight : 'Educators';

$default_ben_student = array(
    array('title' => 'Enhanced Engagement', 'paragraph' => 'Interactive multimedia content keeps students engaged and motivated throughout lessons.'),
    array('title' => 'Better Understanding', 'paragraph' => 'Visual and interactive elements help students grasp complex concepts more easily.'),
    array('title' => 'Digital Literacy', 'paragraph' => 'Exposure to advanced technology prepares students for the digital future.'),
    array('title' => 'Personalized Learning', 'paragraph' => 'Multimedia content can be tailored to different learning styles and paces.'),
);
$ben_student_items = (is_array($ben_student_items) && count($ben_student_items) >= 4) ? $ben_student_items : $default_ben_student;

$default_ben_teacher = array(
    array('title' => 'Enhanced Teaching Tools', 'paragraph' => 'Access to a wide range of multimedia resources to make lessons more effective.'),
    array('title' => 'Time Efficiency', 'paragraph' => 'Ready-made multimedia content reduces preparation time for complex topics.'),
    array('title' => 'Flexible Delivery', 'paragraph' => 'Ability to switch between traditional and digital teaching methods seamlessly.'),
    array('title' => 'Professional Development', 'paragraph' => 'Opportunities to develop digital teaching skills and stay current with educational technology.'),
);
$ben_teacher_items = (is_array($ben_teacher_items) && !empty($ben_teacher_items)) ? $ben_teacher_items : $default_ben_teacher;

// ——— CTA ———
$cta_icon    = $opt ? get_field('media_cta_icon', $page_id) : null;
$cta_before  = $opt ? get_field('media_cta_heading_before', $page_id) : null;
$cta_highlight = $opt ? get_field('media_cta_heading_highlight', $page_id) : null;
$cta_para   = $opt ? get_field('media_cta_para', $page_id) : null;
$cta_btn1_link = $opt ? get_field('media_cta_btn1_link', $page_id) : null;
$cta_btn1_icon = $opt ? get_field('media_cta_btn1_icon', $page_id) : null;
$cta_btn2_link = $opt ? get_field('media_cta_btn2_link', $page_id) : null;
$cta_btn2_icon = $opt ? get_field('media_cta_btn2_icon', $page_id) : null;

$cta_icon    = (is_string($cta_icon) && trim($cta_icon) !== '') ? trim($cta_icon) : 'video';
$cta_before  = ($cta_before !== '' && $cta_before !== null) ? (string) $cta_before : 'Experience Interactive';
$cta_highlight = ($cta_highlight !== '' && $cta_highlight !== null) ? (string) $cta_highlight : 'Learning';
$cta_para   = ($cta_para !== '' && $cta_para !== null) ? (string) $cta_para : 'See firsthand how our multimedia classrooms are transforming education and preparing students for success in the digital age.';
$cta_btn1_icon = (is_string($cta_btn1_icon) && trim($cta_btn1_icon) !== '') ? trim($cta_btn1_icon) : 'calendar';
$cta_btn2_icon = (is_string($cta_btn2_icon) && trim($cta_btn2_icon) !== '') ? trim($cta_btn2_icon) : 'download';

$cta_btn1_url = $cta_btn1_target = $cta_btn1_text = '';
if (!empty($cta_btn1_link) && is_array($cta_btn1_link)) {
    $cta_btn1_url   = isset($cta_btn1_link['url']) ? esc_url($cta_btn1_link['url']) : '#';
    $cta_btn1_target = isset($cta_btn1_link['target']) ? $cta_btn1_link['target'] : '_self';
    $cta_btn1_text  = isset($cta_btn1_link['title']) && trim((string) $cta_btn1_link['title']) !== '' ? (string) $cta_btn1_link['title'] : 'Schedule a Demo Class';
} else { $cta_btn1_url = '#'; $cta_btn1_target = '_self'; $cta_btn1_text = 'Schedule a Demo Class'; }

$cta_btn2_url = $cta_btn2_target = $cta_btn2_text = '';
if (!empty($cta_btn2_link) && is_array($cta_btn2_link)) {
    $cta_btn2_url   = isset($cta_btn2_link['url']) ? esc_url($cta_btn2_link['url']) : '#';
    $cta_btn2_target = isset($cta_btn2_link['target']) ? $cta_btn2_link['target'] : '_self';
    $cta_btn2_text  = isset($cta_btn2_link['title']) && trim((string) $cta_btn2_link['title']) !== '' ? (string) $cta_btn2_link['title'] : 'Download Brochure';
} else { $cta_btn2_url = '#'; $cta_btn2_target = '_self'; $cta_btn2_text = 'Download Brochure'; }
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
                    <?php echo esc_html($hero_before); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-flame via-tiger-orange to-cayenne-red"><?php echo esc_html($hero_highlight); ?></span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg text-slate-200 mb-8 max-w-2xl leading-relaxed">
                    <?php echo esc_html($hero_subtext); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="py-16 md:py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 text-primary mb-4 sm:mb-6">
                    <i data-lucide="<?php echo esc_attr($intro_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($intro_badge); ?></span>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-4 sm:mb-6">
                    <?php echo esc_html($intro_heading_before); ?> <span class="text-primary"><?php echo esc_html($intro_heading_highlight); ?></span>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 max-w-3xl mx-auto">
                    <?php echo esc_html($intro_subtext); ?>
                </p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
                <div class="space-y-8">
                    <div class="bg-white rounded-[1rem] p-4 sm:p-6 md:p-8 border border-slate-200 shadow-soft hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($intro_left_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 text-primary"></i>
                            </div>
                            <h3 class="text-base sm:text-lg md:text-xl font-bold text-slate-900"><?php echo esc_html($intro_left_title); ?></h3>
                        </div>
                        <div class="space-y-3 sm:space-y-4 text-sm sm:text-base text-slate-600 leading-relaxed">
                            <p><?php echo esc_html($intro_left_para1); ?></p>
                            <p><?php echo esc_html($intro_left_para2); ?></p>
                        </div>
                    </div>
                    <div class="relative rounded-[1rem] overflow-hidden shadow-xl group">
                        <div class="aspect-[4/3] relative overflow-hidden">
                            <img src="<?php echo esc_url($intro_left_img_url); ?>" alt="<?php echo esc_attr($intro_left_alt); ?>" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 md:p-8">
                                <div class="text-center">
                                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto mb-3 sm:mb-4">
                                        <i data-lucide="<?php echo esc_attr($intro_left_image_icon); ?>" class="w-6 h-6 sm:w-8 sm:h-8 text-white"></i>
                                    </div>
                                    <p class="text-white text-sm sm:text-base font-medium"><?php echo esc_html($intro_left_image_caption); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-8">
                    <div class="relative rounded-[1rem] overflow-hidden shadow-xl group">
                        <div class="aspect-[4/3] relative overflow-hidden">
                            <img src="<?php echo esc_url($intro_right_img_url); ?>" alt="<?php echo esc_attr($intro_right_alt); ?>" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 md:p-8">
                                <div class="text-center">
                                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto mb-3 sm:mb-4">
                                        <i data-lucide="<?php echo esc_attr($intro_right_image_icon); ?>" class="w-6 h-6 sm:w-8 sm:h-8 text-white"></i>
                                    </div>
                                    <p class="text-white text-sm sm:text-base font-medium"><?php echo esc_html($intro_right_image_caption); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-[1rem] p-4 sm:p-6 md:p-8 border border-slate-200 shadow-soft hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-accent/10 flex items-center justify-center">
                                <i data-lucide="<?php echo esc_attr($intro_right_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 text-accent"></i>
                            </div>
                            <h3 class="text-base sm:text-lg md:text-xl font-bold text-slate-900"><?php echo esc_html($intro_right_title); ?></h3>
                        </div>
                        <div class="space-y-3 sm:space-y-4 text-sm sm:text-base text-slate-600 leading-relaxed">
                            <p><?php echo esc_html($intro_right_para1); ?></p>
                            <p><?php echo esc_html($intro_right_para2); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Features Section -->
    <section class="py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-accent/10 text-accent mb-4 sm:mb-6">
                    <i data-lucide="<?php echo esc_attr($feat_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($feat_badge); ?></span>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-4 sm:mb-6">
                    <?php echo esc_html($feat_before); ?> <span class="text-primary"><?php echo esc_html($feat_highlight); ?></span>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 max-w-3xl mx-auto">
                    <?php echo esc_html($feat_subtext); ?>
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($feat_items as $item) :
                    $f_icon = isset($item['icon']) ? trim((string) $item['icon']) : 'projector';
                    $f_style = isset($item['style']) && in_array($item['style'], array('primary', 'accent', 'primary-light'), true) ? $item['style'] : 'primary';
                    $f_title = isset($item['title']) ? (string) $item['title'] : '';
                    $f_para = isset($item['paragraph']) ? (string) $item['paragraph'] : '';
                    $f_border = $f_style === 'accent' ? 'hover:border-accent/30' : ($f_style === 'primary-light' ? 'hover:border-primary-light/30' : 'hover:border-primary/30');
                    $f_grad = $f_style === 'accent' ? 'from-accent to-accent-dark' : ($f_style === 'primary-light' ? 'from-primary-light to-slate-blue' : 'from-primary to-primary-dark');
                ?>
                <div class="group relative bg-gradient-to-b from-white to-slate-50 rounded-[1rem] p-4 sm:p-6 md:p-8 border border-slate-200 <?php echo esc_attr($f_border); ?> transition-all duration-300 hover:-translate-y-2 hover:shadow-xl overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-primary/5 group-hover:bg-primary/10 transition-colors duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 sm:w-14 sm:h-16 rounded-xl bg-gradient-to-br <?php echo esc_attr($f_grad); ?> flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="<?php echo esc_attr($f_icon); ?>" class="w-6 h-6 sm:w-8 text-white"></i>
                        </div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-slate-900 mb-3 sm:mb-4"><?php echo esc_html($f_title); ?></h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed"><?php echo esc_html($f_para); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- USP Section -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 text-primary mb-4 sm:mb-6">
                        <i data-lucide="<?php echo esc_attr($usp_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($usp_badge); ?></span>
                    </div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                        <?php echo esc_html($usp_before); ?> <span class="text-primary"><?php echo esc_html($usp_highlight); ?></span>
                    </h2>
                    <div class="space-y-6">
                        <?php foreach ($usp_items as $u) :
                            $u_style = isset($u['icon_style']) ? $u['icon_style'] : 'green';
                            $u_icon = isset($u['icon']) ? trim((string) $u['icon']) : 'book-open';
                            $u_title = isset($u['title']) ? (string) $u['title'] : '';
                            $u_para = isset($u['paragraph']) ? (string) $u['paragraph'] : '';
                            $u_bg = $u_style === 'blue' ? 'bg-blue-100' : ($u_style === 'purple' ? 'bg-purple-100' : 'bg-green-100');
                            $u_text = $u_style === 'blue' ? 'text-blue-600' : ($u_style === 'purple' ? 'text-purple-600' : 'text-green-600');
                        ?>
                        <div class="flex items-start gap-3 sm:gap-4 p-4 sm:p-6 bg-white rounded-[1rem] border border-slate-200 shadow-soft hover:shadow-md transition-all">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg <?php echo esc_attr($u_bg); ?> flex items-center justify-center flex-shrink-0">
                                <i data-lucide="<?php echo esc_attr($u_icon); ?>" class="w-5 h-5 sm:w-6 sm:h-6 <?php echo esc_attr($u_text); ?>"></i>
                            </div>
                            <div>
                                <h4 class="text-sm sm:text-base font-bold text-slate-900 mb-1 sm:mb-2"><?php echo esc_html($u_title); ?></h4>
                                <p class="text-xs sm:text-sm text-slate-600"><?php echo esc_html($u_para); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-primary to-primary-dark rounded-[1rem] p-4 sm:p-6 md:p-8 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                        <div class="relative z-10">
                            <div class="size-16 shrink-0 sm:w-20 sm:h-20 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mb-6 sm:mb-8">
                                <i data-lucide="award" class="size-8 sm:size-10 text-white"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6"><?php echo esc_html($usp_right_title); ?></h3>
                            <div class="space-y-4 sm:space-y-6">
                                <?php foreach ($usp_right_items as $ri) :
                                    $ri_icon = isset($ri['icon']) ? trim((string) $ri['icon']) : 'star';
                                    $ri_title = isset($ri['title']) ? (string) $ri['title'] : '';
                                    $ri_para = isset($ri['paragraph']) ? (string) $ri['paragraph'] : '';
                                ?>
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <div class="size-8 sm:size-10 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                                        <i data-lucide="<?php echo esc_attr($ri_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm sm:text-base font-bold"><?php echo esc_html($ri_title); ?></h4>
                                        <p class="text-white/80 text-xs sm:text-sm"><?php echo esc_html($ri_para); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Creative Team Section -->
    <section class="py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 text-primary mb-4 sm:mb-6">
                    <i data-lucide="<?php echo esc_attr($team_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($team_badge); ?></span>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-4 sm:mb-6">
                    <?php echo esc_html($team_before); ?> <span class="text-primary"><?php echo esc_html($team_highlight); ?></span>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 max-w-3xl mx-auto">
                    <?php echo esc_html($team_subtext); ?>
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($team_items as $t) :
                    $t_icon = isset($t['icon']) ? trim((string) $t['icon']) : 'user-check';
                    $t_style = isset($t['style']) ? $t['style'] : 'primary';
                    $t_title = isset($t['title']) ? (string) $t['title'] : '';
                    $t_para = isset($t['paragraph']) ? (string) $t['paragraph'] : '';
                    $t_label = isset($t['label']) ? (string) $t['label'] : '';
                    $t_grad = $t_style === 'accent' ? 'from-accent to-accent-dark' : ($t_style === 'primary-light' ? 'from-primary-light to-slate-blue' : 'from-primary to-primary-dark');
                ?>
                <div class="group text-center">
                    <div class="size-16 shrink-0 sm:w-20 sm:h-24 rounded-full bg-gradient-to-br <?php echo esc_attr($t_grad); ?> flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="<?php echo esc_attr($t_icon); ?>" class="size-8 sm:w-10 sm:h-12 text-white"></i>
                    </div>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-slate-900 mb-1 sm:mb-2"><?php echo esc_html($t_title); ?></h3>
                    <p class="text-xs sm:text-sm text-slate-600 mb-3 sm:mb-4"><?php echo esc_html($t_para); ?></p>
                    <?php if ($t_label !== '') : ?>
                    <div class="inline-flex items-center gap-2 text-primary text-xs sm:text-sm font-medium">
                        <span><?php echo esc_html($t_label); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-8 sm:mt-12 bg-gradient-to-r from-primary/5 to-accent/5 rounded-[1rem] p-4 sm:p-6 md:p-8 border border-primary/10">
                <div class="flex flex-col md:flex-row items-center gap-4 sm:gap-6">
                    <div class="size-16 shrink-0 sm:w-20 sm:h-20 rounded-full bg-white flex items-center justify-center shadow-lg">
                        <i data-lucide="refresh-cw" class="size-8 sm:size-10 text-primary"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-slate-900 mb-1 sm:mb-2 text-center sm:text-left"><?php echo esc_html($team_banner_heading); ?></h3>
                        <p class="text-xs sm:text-sm text-slate-600 text-center sm:text-left"><?php echo esc_html($team_banner_para); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-accent/10 text-accent mb-4 sm:mb-6">
                        <i data-lucide="graduation-cap" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($ben_student_badge); ?></span>
                    </div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                        <?php echo esc_html($ben_student_heading); ?> <span class="text-primary"><?php echo esc_html($ben_student_highlight); ?></span>
                    </h2>
                    <div class="space-y-6">
                        <?php foreach ($ben_student_items as $si) :
                            $si_title = isset($si['title']) ? (string) $si['title'] : '';
                            $si_para = isset($si['paragraph']) ? (string) $si['paragraph'] : '';
                        ?>
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div class="size-8 sm:size-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="check-circle" class="w-4 h-4 sm:w-5 sm:h-5 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="text-sm sm:text-base font-bold text-slate-900 mb-1"><?php echo esc_html($si_title); ?></h4>
                                <p class="text-xs sm:text-sm text-slate-600"><?php echo esc_html($si_para); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-primary/10 text-primary mb-4 sm:mb-6">
                        <i data-lucide="<?php echo esc_attr($ben_teacher_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        <span class="text-xs sm:text-sm font-bold uppercase tracking-wider"><?php echo esc_html($ben_teacher_badge); ?></span>
                    </div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-900 mb-6">
                        <?php echo esc_html($ben_teacher_heading); ?> <span class="text-primary"><?php echo esc_html($ben_teacher_highlight); ?></span>
                    </h2>
                    <div class="space-y-4 sm:space-y-6">
                        <?php foreach ($ben_teacher_items as $ti) :
                            $ti_title = isset($ti['title']) ? (string) $ti['title'] : '';
                            $ti_para = isset($ti['paragraph']) ? (string) $ti['paragraph'] : '';
                        ?>
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div class="size-8 sm:size-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="check-circle" class="w-4 h-4 sm:w-5 sm:h-5 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="text-sm sm:text-base font-bold text-slate-900 mb-1"><?php echo esc_html($ti_title); ?></h4>
                                <p class="text-xs sm:text-sm text-slate-600"><?php echo esc_html($ti_para); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 sm:py-16 md:py-20 bg-gradient-to-r from-primary/90 via-primary to-primary-dark text-white [&_+_footer]:rounded-t-[0px]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="size-16 shrink-0 sm:w-20 sm:h-20 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto mb-6 sm:mb-8">
                <i data-lucide="<?php echo esc_attr($cta_icon); ?>" class="size-8 sm:size-10 text-white"></i>
            </div>
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mb-4 sm:mb-6">
                <?php echo esc_html($cta_before); ?> <span class="text-accent"><?php echo esc_html($cta_highlight); ?></span>
            </h2>
            <p class="text-sm sm:text-base text-slate-200 mb-6 sm:mb-8 max-w-2xl mx-auto">
                <?php echo esc_html($cta_para); ?>
            </p>
            <div class="flex flex-row gap-3 sm:gap-4 justify-center">
                <a href="<?php echo $cta_btn1_url; ?>" target="<?php echo esc_attr($cta_btn1_target); ?>" class="inline-flex items-center gap-2 px-4 py-2 sm:px-8 sm:py-4 bg-accent text-white rounded-full font-bold text-sm sm:text-base md:text-lg hover:bg-accent-dark transition-all transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
                    <i data-lucide="<?php echo esc_attr($cta_btn1_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <?php echo esc_html($cta_btn1_text); ?>
                </a>
                <a href="<?php echo $cta_btn2_url; ?>" target="<?php echo esc_attr($cta_btn2_target); ?>" class="inline-flex items-center gap-2 px-4 py-2 sm:px-8 sm:py-4 bg-white/10 backdrop-blur-sm border border-white/30 text-white rounded-full font-bold text-sm sm:text-base md:text-lg hover:bg-white/20 transition-all transform hover:-translate-y-0.5">
                    <i data-lucide="<?php echo esc_attr($cta_btn2_icon); ?>" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                    <?php echo esc_html($cta_btn2_text); ?>
                </a>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
