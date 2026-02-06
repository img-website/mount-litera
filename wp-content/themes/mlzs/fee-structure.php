<?php
/**
 * Template Name: Fee Structure Page
 * Hero + Documents section (PDFs from CBSE Mandate page – fee category only). All content dynamic from CMS.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$page_id = get_queried_object_id();
$theme_uri = get_template_directory_uri();
$home_url = home_url('/');
$opt = function_exists('get_field');

// ——— Hero (from this page ACF) ———
$hero_badge     = $opt ? get_field('fs_hero_badge', $page_id) : null;
$hero_icon      = $opt ? get_field('fs_hero_icon', $page_id) : null;
$hero_headline  = $opt ? get_field('fs_hero_headline', $page_id) : null;
$hero_highlight = $opt ? get_field('fs_hero_highlight', $page_id) : null;
$hero_sub       = $opt ? get_field('fs_hero_subheadline', $page_id) : null;

$hero_badge     = ($hero_badge !== '' && $hero_badge !== null) ? (string) $hero_badge : 'Fee Information';
$hero_icon      = (is_string($hero_icon) && trim($hero_icon) !== '') ? trim($hero_icon) : 'file-text';
$hero_headline  = ($hero_headline !== '' && $hero_headline !== null) ? (string) $hero_headline : 'Fee';
$hero_highlight = ($hero_highlight !== '' && $hero_highlight !== null) ? (string) $hero_highlight : 'Structure';
$hero_sub       = ($hero_sub !== '' && $hero_sub !== null) ? (string) $hero_sub : 'View and download fee structure PDFs for different classes. Data is managed from the CBSE Mandate page (Fee category).';

// ——— Documents section header (from this page ACF) ———
$section_badge      = $opt ? get_field('fs_section_badge', $page_id) : null;
$section_heading   = $opt ? get_field('fs_section_heading', $page_id) : null;
$section_highlight = $opt ? get_field('fs_section_heading_highlight', $page_id) : null;
$section_desc      = $opt ? get_field('fs_section_description', $page_id) : null;
$section_icon      = $opt ? get_field('fs_section_icon', $page_id) : null;

$section_badge      = ($section_badge !== '' && $section_badge !== null) ? (string) $section_badge : 'Fee PDFs';
$section_heading   = ($section_heading !== '' && $section_heading !== null) ? (string) $section_heading : 'Fee';
$section_highlight = ($section_highlight !== '' && $section_highlight !== null) ? (string) $section_highlight : 'Documents';
$section_desc      = ($section_desc !== '' && $section_desc !== null) ? (string) $section_desc : 'Download fee structure PDFs for various classes. Add or edit these documents from the CBSE Mandate page under the Fee category.';
$section_icon      = (is_string($section_icon) && trim($section_icon) !== '') ? trim($section_icon) : 'file-text';

// ——— Documents: from CBSE Mandate page, fee category only ———
$cbse_page_id = 0;
$cbse_pages = get_pages(array(
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'cbse.php',
    'number'     => 1,
));
if (!empty($cbse_pages)) {
    $cbse_page_id = (int) $cbse_pages[0]->ID;
}
$documents_raw = ($opt && $cbse_page_id) ? get_field('cbse_documents', $cbse_page_id) : null;
$default_fee_docs = array(
    array('title' => 'MLZS F.S. CLASS 11th TO 12th SCIENCE (2024-25)', 'description' => 'Fee structure for Science stream', 'link' => array('url' => '#', 'target' => '_blank'), 'category' => 'fee', 'icon' => 'book-open', 'button_text' => 'View Document'),
    array('title' => 'MLZS F.S. CLASS 9th TO 10th (2024-25)', 'description' => 'Fee structure for classes 9-10', 'link' => array('url' => '#', 'target' => '_blank'), 'category' => 'fee', 'icon' => 'book', 'button_text' => 'View Document'),
    array('title' => 'MLZS F.S. CLASS 3rd TO 5th (2024-25)', 'description' => 'Fee structure for classes 3-5', 'link' => array('url' => '#', 'target' => '_blank'), 'category' => 'fee', 'icon' => 'book-open', 'button_text' => 'View Document'),
    array('title' => 'MLZS F.S. CLASS 11th TO 12th COMMERCE (2024-25)', 'description' => 'Fee structure for Commerce', 'link' => array('url' => '#', 'target' => '_blank'), 'category' => 'fee', 'icon' => 'calculator', 'button_text' => 'View Document'),
);
$all_docs = (is_array($documents_raw) && !empty($documents_raw)) ? $documents_raw : $default_fee_docs;
$documents = array_filter($all_docs, function ($doc) {
    $cat = isset($doc['category']) ? (string) $doc['category'] : '';
    return $cat === 'fee';
});
if (empty($documents)) {
    $documents = $default_fee_docs;
}
$documents = array_values($documents);
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

    <!-- Fee Documents Section (data from CBSE Mandate page – fee only) -->
    <section class="relative px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-20 bg-gradient-to-b from-background-light to-white overflow-x-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] pointer-events-none opacity-60"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-accent/5 rounded-full blur-[100px] pointer-events-none opacity-60"></div>
        <div class="mx-auto max-w-7xl w-full relative z-10">
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 md:gap-8" id="feeDocumentsGrid">
                <?php
                $icon_class = 'text-primary-light group-hover:text-white';
                $bg_class = 'bg-primary-light/10 group-hover:bg-primary-light';
                foreach ($documents as $doc) :
                    $title = isset($doc['title']) ? (string) $doc['title'] : '';
                    $desc  = isset($doc['description']) ? (string) $doc['description'] : '';
                    $link = array('url' => '#', 'target' => '_blank');
                    if (!empty($doc['pdf_file']) && is_array($doc['pdf_file']) && !empty($doc['pdf_file']['url'])) {
                        $link = array('url' => $doc['pdf_file']['url'], 'target' => '_blank');
                    } elseif (isset($doc['link']) && is_array($doc['link']) && !empty($doc['link']['url'])) {
                        $link = $doc['link'];
                    }
                    $icon   = (isset($doc['icon']) && trim((string) $doc['icon']) !== '') ? trim((string) $doc['icon']) : 'file-text';
                    $btn_text = (isset($doc['button_text']) && (string) $doc['button_text'] !== '') ? (string) $doc['button_text'] : 'View Document';
                ?>
                <div class="document-card group relative bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft hover:shadow-xl border border-border-light hover:border-primary/30 transition-all duration-300 hover:-translate-y-2">
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
        </div>
    </section>

<?php get_footer(); ?>
