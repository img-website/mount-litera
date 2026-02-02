<?php
/**
 * Template Name: Privacy Policy Page
 * Used when the page is set as Privacy Policy in Settings > Privacy.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main id="content" class="py-12 md:py-16 lg:py-20">
    <div class="container mx-auto px-4 max-w-4xl mlzs-page-content wp-block-post-content">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>
</main>
<?php
get_footer();
