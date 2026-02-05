<?php
/**
 * Template Name: CBSE Mandate Page
 * CBSE Mandate: Hero, Related Documents (filters, document cards, stats) – ACF dynamic
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$theme_uri = get_template_directory_uri();
$home_url = home_url('/');
$opt = function_exists('get_field');

// ——— Hero ———
$hero_badge     = $opt ? get_field('cbse_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('cbse_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('cbse_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('cbse_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('cbse_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'CBSE Compliance';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'shield-check';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'CBSE';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Mandate';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'Essential documents, certificates, and academic planners for students, parents, and stakeholders';

// ——— Documents section header ———
$section_badge      = $opt ? get_field('cbse_section_badge', $page_id) : null;
$section_heading   = $opt ? get_field('cbse_section_heading', $page_id) : null;
$section_highlight = $opt ? get_field('cbse_section_heading_highlight', $page_id) : null;
$section_desc      = $opt ? get_field('cbse_section_description', $page_id) : null;
$section_icon      = $opt ? get_field('cbse_section_icon', $page_id) : null;

$section_badge      = ($section_badge !== '' && $section_badge !== null) ? (string) $section_badge : 'Important Documents';
$section_heading   = ($section_heading !== '' && $section_heading !== null) ? (string) $section_heading : 'Related';
$section_highlight = ($section_highlight !== '' && $section_highlight !== null) ? (string) $section_highlight : 'Documents';
$section_desc      = ($section_desc !== '' && $section_desc !== null) ? (string) $section_desc : 'Essential documents, certificates, and academic planners for students, parents, and stakeholders';
$section_icon      = (is_string($section_icon) && trim($section_icon) !== '') ? trim($section_icon) : 'folder-open';

// ——— Filter buttons (all, fee, certificate, result, safety) ———
$filters_raw = $opt ? get_field('cbse_filters', $page_id) : null;
$default_filters = array(
    array('label' => 'All Documents', 'slug' => 'all', 'icon' => 'folder'),
    array('label' => 'Fee Structure', 'slug' => 'fee', 'icon' => 'file-text'),
    array('label' => 'Certificates', 'slug' => 'certificate', 'icon' => 'shield-check'),
    array('label' => 'Results', 'slug' => 'result', 'icon' => 'award'),
    array('label' => 'Safety & Compliance', 'slug' => 'safety', 'icon' => 'shield'),
);
$filters = (is_array($filters_raw) && !empty($filters_raw)) ? $filters_raw : $default_filters;

// ——— Documents repeater ———
$documents_raw = $opt ? get_field('cbse_documents', $page_id) : null;
$default_documents = array(
    array('title' => 'Building Safety', 'description' => 'Safety compliance certificate', 'link' => array('url' => 'https://www.mlzsalwar.ac.in/mlz-admin/webroot/uploads/cbsepdf/cbsepdf465128.pdf', 'target' => '_blank'), 'category' => 'safety', 'icon' => 'shield', 'button_text' => 'View Document'),
    array('title' => 'Affiliation', 'description' => 'CBSE affiliation certificate', 'link' => array('url' => '#', 'target' => '_blank'), 'category' => 'certificate', 'icon' => 'school', 'button_text' => 'View Document'),
    array('title' => 'Reg. Society', 'description' => 'Society registration document', 'link' => array('url' => '#', 'target' => '_blank'), 'category' => 'certificate', 'icon' => 'building', 'button_text' => 'View Document'),
    array('title' => 'MLZS F.S. CLASS 11th TO 12th SCIENCE (2024-25)', 'description' => 'Fee structure for Science stream', 'link' => array('url' => 'https://www.mlzsalwar.ac.in/mlz-admin/webroot/uploads/cbsepdf/cbsepdf212465.pdf', 'target' => '_blank'), 'category' => 'fee', 'icon' => 'book-open', 'button_text' => 'View Document'),
    array('title' => 'MLZS F.S. CLASS 9th TO 10th (2024-25)', 'description' => 'Fee structure for classes 9-10', 'link' => array('url' => 'https://www.mlzsalwar.ac.in/mlz-admin/webroot/uploads/cbsepdf/cbsepdf166653.pdf', 'target' => '_blank'), 'category' => 'fee', 'icon' => 'book', 'button_text' => 'View Document'),
    array('title' => 'MLZS F.S. CLASS 3rd TO 5th (2024-25)', 'description' => 'Fee structure for classes 3-5', 'link' => array('url' => 'https://www.mlzsalwar.ac.in/mlz-admin/webroot/uploads/cbsepdf/cbsepdf613145.pdf', 'target' => '_blank'), 'category' => 'fee', 'icon' => 'book-open', 'button_text' => 'View Document'),
    array('title' => 'CBSE XII Result 2021-22', 'description' => 'Class 12 board results', 'link' => array('url' => 'https://www.mlzsalwar.ac.in/mlz-admin/webroot/uploads/cbsepdf/cbsepdf959093.pdf', 'target' => '_blank'), 'category' => 'result', 'icon' => 'trophy', 'button_text' => 'View Results'),
    array('title' => 'MLZS F.S. CLASS 11th TO 12th COMMERCE (2024-25)', 'description' => 'Fee structure for Commerce', 'link' => array('url' => 'https://www.mlzsalwar.ac.in/mlz-admin/webroot/uploads/cbsepdf/cbsepdf701177.pdf', 'target' => '_blank'), 'category' => 'fee', 'icon' => 'calculator', 'button_text' => 'View Document'),
    array('title' => 'CBSE XII Result 2022-23', 'description' => 'Class 12 board results', 'link' => array('url' => 'https://www.mlzsalwar.ac.in/mlz-admin/webroot/uploads/cbsepdf/cbsepdf415448.pdf', 'target' => '_blank'), 'category' => 'result', 'icon' => 'award', 'button_text' => 'View Results'),
    array('title' => 'SMC', 'description' => 'School Management Committee', 'link' => array('url' => 'https://www.mlzsalwar.ac.in/mlz-admin/webroot/uploads/cbsepdf/cbsepdf231038.pdf', 'target' => '_blank'), 'category' => 'certificate', 'icon' => 'users', 'button_text' => 'View Document'),
);
$documents = (is_array($documents_raw) && !empty($documents_raw)) ? $documents_raw : $default_documents;

// ——— Stats ———
$stats_raw = $opt ? get_field('cbse_stats', $page_id) : null;
$default_stats = array(
    array('number' => '24+', 'label' => 'Documents Available'),
    array('number' => '5', 'label' => 'Categories'),
    array('number' => '2020-25', 'label' => 'Updated Period'),
    array('number' => '100%', 'label' => 'Verified Documents'),
);
$stats = (is_array($stats_raw) && count($stats_raw) >= 4) ? $stats_raw : $default_stats;

// Icon style classes by category (for corner badge)
$icon_style_map = array(
    'safety'    => 'primary',
    'certificate' => 'accent',
    'fee'       => 'primary-light',
    'result'    => 'primary-light',
);
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

    <!-- Related Documents Section -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-20 bg-gradient-to-b from-background-light to-white overflow-x-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] pointer-events-none opacity-60"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-accent/5 rounded-full blur-[100px] pointer-events-none opacity-60"></div>

        <div class="mx-auto max-w-7xl w-full relative z-10">
            <!-- Section Header -->
            <div class="mb-8 sm:mb-10 md:mb-12 text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 border border-primary/30 text-primary text-xs font-bold uppercase tracking-wider mb-3 sm:mb-4">
                    <i data-lucide="<?php echo esc_attr($section_icon); ?>" class="w-4 h-4"></i>
                    <?php echo esc_html($section_badge); ?>
                </div>
                <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-text-main-light mb-3 sm:mb-4">
                    <?php echo esc_html($section_heading); ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-primary-light to-accent"><?php echo esc_html($section_highlight); ?></span>
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent rounded-full mx-auto mb-4 sm:mb-6"></div>
                <p class="text-sm text-text-secondary-light max-w-3xl mx-auto">
                    <?php echo esc_html($section_desc); ?>
                </p>
            </div>

            <!-- Category Filters -->
            <div class="mb-8 md:mb-12">
                <div class="flex flex-wrap justify-center gap-2 sm:gap-3 md:gap-4" id="cbseFilterButtons">
                    <?php foreach ($filters as $filter) :
                        $label = isset($filter['label']) ? (string) $filter['label'] : '';
                        $slug  = isset($filter['slug']) ? (string) $filter['slug'] : 'all';
                        $icon  = (isset($filter['icon']) && trim((string) $filter['icon']) !== '') ? trim((string) $filter['icon']) : 'folder';
                        $is_active = ($slug === 'all');
                    ?>
                    <button type="button" class="document-filter px-4 py-2 rounded-full text-sm font-medium hover:bg-primary/5 hover:border-primary/30 transition-all duration-300 flex items-center gap-2<?php echo $is_active ? ' document-filter-active bg-primary text-white' : ' bg-white border border-border-light text-text-main-light'; ?>" data-filter="<?php echo esc_attr($slug); ?>">
                        <i data-lucide="<?php echo esc_attr($icon); ?>" class="w-4 h-4"></i>
                        <?php echo esc_html($label); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Documents Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 md:gap-8" id="documentsGrid">
                <?php foreach ($documents as $doc) :
                    $title = isset($doc['title']) ? (string) $doc['title'] : '';
                    $desc  = isset($doc['description']) ? (string) $doc['description'] : '';
                    // Prefer uploaded PDF; fallback to link URL
                    $link = array('url' => '#', 'target' => '_blank');
                    if (!empty($doc['pdf_file']) && is_array($doc['pdf_file']) && !empty($doc['pdf_file']['url'])) {
                        $link = array('url' => $doc['pdf_file']['url'], 'target' => '_blank');
                    } elseif (isset($doc['link']) && is_array($doc['link']) && !empty($doc['link']['url'])) {
                        $link = $doc['link'];
                    }
                    $category = isset($doc['category']) ? (string) $doc['category'] : 'certificate';
                    $icon   = (isset($doc['icon']) && trim((string) $doc['icon']) !== '') ? trim((string) $doc['icon']) : 'file-text';
                    $btn_text = (isset($doc['button_text']) && (string) $doc['button_text'] !== '') ? (string) $doc['button_text'] : 'View Document';
                    $icon_style = isset($icon_style_map[$category]) ? $icon_style_map[$category] : 'primary';
                    $icon_class = $icon_style === 'primary' ? 'text-primary group-hover:text-white' : ($icon_style === 'accent' ? 'text-accent group-hover:text-white' : 'text-primary-light group-hover:text-white');
                    $bg_class = $icon_style === 'primary' ? 'bg-primary/10 group-hover:bg-primary' : ($icon_style === 'accent' ? 'bg-accent/10 group-hover:bg-accent' : 'bg-primary-light/10 group-hover:bg-primary-light');
                ?>
                <div class="document-card group relative bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft hover:shadow-xl border border-border-light hover:border-primary/30 transition-all duration-300 hover:-translate-y-2" data-category="<?php echo esc_attr($category); ?>">
                    <div class="absolute -top-3 -right-3 w-12 h-12 rounded-full <?php echo esc_attr($bg_class); ?> flex items-center justify-center transition-colors">
                        <i data-lucide="<?php echo esc_attr($icon); ?>" class="w-5 h-5 <?php echo esc_attr($icon_class); ?>"></i>
                    </div>
                    <div class="flex flex-col items-center text-center h-full">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 mb-4 flex items-center justify-center">
                            <i data-lucide="file-text" class="w-16 h-16 sm:w-20 sm:h-20 text-primary"></i>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-text-main-light mb-2 group-hover:text-primary transition-colors line-clamp-2"><?php echo esc_html($title); ?></h3>
                        <p class="text-xs text-text-secondary-light mb-4 grow"><?php echo esc_html($desc); ?></p>
                        <a href="<?php echo esc_url($link['url']); ?>" <?php echo !empty($link['target']) ? ' target="' . esc_attr($link['target']) . '"' : ''; ?> class="w-full px-4 py-2 rounded-lg bg-primary/10 text-primary font-medium hover:bg-primary hover:text-white transition-all duration-300 flex items-center justify-center gap-2 group/link text-sm">
                            <span><?php echo esc_html($btn_text); ?></span>
                            <i data-lucide="external-link" class="w-3 h-3 sm:w-4 sm:h-4 group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Document Statistics -->
            <div class="mt-8 sm:mt-12 md:mt-16 grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
                <?php
                $stat_colors = array('text-primary', 'text-accent', 'text-primary-light', 'text-accent-dark');
                foreach (array_slice($stats, 0, 4) as $idx => $stat) :
                    $num = isset($stat['number']) ? (string) $stat['number'] : '';
                    $lbl = isset($stat['label']) ? (string) $stat['label'] : '';
                    $col = isset($stat_colors[$idx]) ? $stat_colors[$idx] : 'text-primary';
                ?>
                <div class="bg-white rounded-xl sm:rounded-2xl p-3 sm:p-4 md:p-6 text-center shadow-soft border border-border-light">
                    <div class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold <?php echo esc_attr($col); ?> mb-1 sm:mb-2"><?php echo esc_html($num); ?></div>
                    <div class="text-xs font-medium text-text-secondary-light"><?php echo esc_html($lbl); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <script>
    (function() {
        function initCbseFilters() {
            if (typeof lucide !== 'undefined') lucide.createIcons();
            var filterButtons = document.querySelectorAll('#cbseFilterButtons .document-filter');
            var documentCards = document.querySelectorAll('#documentsGrid .document-card');
            filterButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    filterButtons.forEach(function(b) {
                        b.classList.remove('bg-primary', 'text-white', 'document-filter-active');
                        b.classList.add('bg-white', 'border', 'border-border-light', 'text-text-main-light');
                    });
                    this.classList.add('bg-primary', 'text-white', 'document-filter-active');
                    this.classList.remove('bg-white', 'border', 'border-border-light', 'text-text-main-light');
                    var filter = this.getAttribute('data-filter');
                    documentCards.forEach(function(card) {
                        var cat = card.getAttribute('data-category');
                        var show = filter === 'all' || cat === filter;
                        card.style.display = show ? 'block' : 'none';
                        card.classList.toggle('opacity-100', show);
                        card.classList.toggle('opacity-0', !show);
                    });
                });
            });
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCbseFilters);
        } else {
            initCbseFilters();
        }
    })();
    </script>

<?php get_footer(); ?>
