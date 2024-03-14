<?php
/*
Template Name: Custom Search
*/
?>
<?php get_header(); ?>
<div class="first-scr-ssp">
    <img class="smm-h" src="/wp-content/uploads/2023/05/blogh.svg">
    <div class="search-blog">
        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <label>
                <input type="search" class="search-field" placeholder="<?php echo esc_attr( 'Search', 'lanetclick' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
            </label>
            <input type="submit" class="search-submit" value="<?php echo esc_attr( 'Search', 'lanetclick' ); ?>" />
            <input type="hidden" name="post_type" value="post" /> <!-- Добавляем скрытое поле для указания типа постов -->
        </form>
    </div>
</div>

<div class="scscr-ssp" >
<div class="bread">
    <img id="homebread" src="/wp-content/uploads/2023/04/bread.svg">
    <?php if( function_exists( 'aioseo_breadcrumbs' ) ) aioseo_breadcrumbs(); ?>
</div>
</div>
<div id="primary" class="blog-m">
    <main id="main" class="site-main" role="main">
        <?php if ( have_posts() ) : ?>

            <div class="row">
                <?php
                // Start the Loop.
                $i = 0;
                while ( have_posts() && $i < 6 ) : //limit to 6 posts
                    the_post();
                ?>

                <div class="col-md-4 post-item">
                    <div class="post" onclick="window.location.href='<?php the_permalink(); ?>';">
                        <?php if (has_post_thumbnail()): ?>
                            <img loading="lazy" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        <?php endif; ?>

                        <div class="post-meta">
                            <span class="post-author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
        <?php echo get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name'); ?>
    </a></span>
                            <span class="post-date"><?php the_date(); ?></span>
                        </div>

                        <h2><a href="<?php the_permalink(); ?>"><?php echo highlight_search_term(get_the_title()); ?></a></h2>
                        <div class="p-excerpt"><?php echo highlight_search_term(wp_trim_words( get_the_content(), 55 )); ?></div>
                    </div>
                </div>

                <?php
                    $i++;
                // End the loop.
                endwhile;
                ?>
            
    </main><!-- #main -->
</div><!-- #primary -->
            <?php
            // Previous/next page navigation.
            the_posts_pagination(
                array(
                    'prev_text' => __( 'Prevous', 'lanetclick' ),
                    'next_text' => __( 'Next', 'lanetclick' ),
                )
            );
        // If no content, include the "No posts found" template.
        else :
            get_template_part( 'post', 'none' );
        endif;
        ?>


<script>
var resizeTimer;
var baseWidth = 1439;
var sliderSettings = {};  // Объект для хранения настроек слайдера

function setPadding() {
    var basePadding = 70;
    var targetPadding = 680;
    var targetWidth = 2800;

    var windowWidth = window.innerWidth;

    var newPadding;
    if (windowWidth <= baseWidth) {
        newPadding = basePadding;
    } else if (windowWidth >= targetWidth) {
        newPadding = targetPadding;
    } else {
        var widthRatio = (windowWidth - baseWidth) / (targetWidth - baseWidth);
        newPadding = basePadding + widthRatio * (targetPadding - basePadding);
    }

    setNewPadding(newPadding);
    
    if (windowWidth <= baseWidth) {
        resetPadding();
    }
}

function setNewPadding(newPadding) {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .blog-m, .blog-sf, .blog-s, .cta-post, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        var computedStyle = getComputedStyle(div);
        var paddingTop = computedStyle.paddingTop;
        var paddingBottom = computedStyle.paddingBottom;
        div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
}

function resetPadding() {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .blog-m, .blog-sf, .blog-s, .cta-post, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        div.style.padding = "";
    });
}

window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(setPadding, 500);
});

window.addEventListener('load', setPadding);
</script>
<?php
get_footer();