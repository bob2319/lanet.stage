<?php get_header(); ?>
<div class="first-scr-ssp">
	<img class="smm-h" src="/wp-content/uploads/2023/05/blogh.svg">
	<div class="search-blog">
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label>
				<input type="search" class="search-field" placeholder="<?php echo esc_attr( 'Пошук' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
			</label>
			<input type="submit" class="search-submit" value="<?php echo esc_attr( 'Пошук' ); ?>" />
			<input type="hidden" name="post_type" value="post" /> <!-- Добавляем скрытое поле для указания типа постов -->
		</form>
	</div>
</div>

<div class="scscr-ssp">
	<div class="bread">
		<img id="homebread" src="/wp-content/uploads/2023/04/bread.svg">
		<?php if( function_exists( 'aioseo_breadcrumbs' ) ) aioseo_breadcrumbs(); ?>
	</div>
</div>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) : ?>

		<div class="page-header">
			<div class="author-profile">
				<div class="author-image">
					<?php 
$user_id = get_the_author_meta('ID');
$image_id = get_field('foto_avtora', 'user_' . $user_id);
if ($image_id) {
    $image_url = wp_get_attachment_image_src($image_id, 'full');
    if ($image_url && is_array($image_url)) {
        echo '<img loading="lazy" src="' . $image_url[0] . '">';
    } else {
        echo "Невозможно получить URL изображения.";
    }
} else {
    echo "У пользователя нет загруженного изображения.";
}
?>


				</div>
				<div class="author-info">
					<h1 class="author-name">
    
        <?php 
            $user_id = get_the_author_meta('ID');
            $first_name_key = 'first_name_' . $user_id;
            $last_name_key = 'last_name_' . $user_id;

            $first_name = get_the_author_meta('first_name');
            $last_name = get_the_author_meta('last_name');

            $first_name_translated = apply_filters('wpml_translate_single_string', $first_name, 'authors', $first_name_key);
            $last_name_translated = apply_filters('wpml_translate_single_string', $last_name, 'authors', $last_name_key);

            echo $first_name_translated . ' ' . $last_name_translated;
        ?>
    

</h1>
					<div class="autor-desc">
						<?php 
$author_id = get_the_author_meta('ID');  // ID автора текущего поста
$custom_author_description = get_field('bio_aut_', 'user_' . $author_id); // Получаем значение из пользовательского поля ACF

if (function_exists('icl_t')) {
    $custom_author_description = icl_t('ACF', 'bio_aut_' . $author_id, $custom_author_description);
}

echo '<p>' . $custom_author_description . '</p>';
?>

					</div>
					<div class="author-social">
						<?php 
						$user_id = get_the_author_meta('ID');
					$linkedin = get_field('posylannya_na_linkedin', 'user_' . $user_id);
					
// теперь вы можете вывести их в HTML
if ($linkedin) {
    echo '<a href="' . $linkedin . '" target="_blank"><img loading="lazy" class="soc-f" src="https://lanet.click/wp-content/uploads/2023/04/linkd.svg"></a>';
}
// и так далее для каждой социальной сети

						?>
					</div>
				</div>
			</div>
		</div><!-- .page-header -->

		<div class="blog-sf">
			<div class="row">
				<div class="col-12-m">
					<h3><?php _e('The author&#39s latest articles', 'lanetclick');?></h3>

					<?php
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => 12,
						'orderby' => 'date',
						'order' => 'DESC',
						'paged' => $paged,
						'author' => get_queried_object_id()
					);
					$author_posts = new WP_Query($args);
					$count = 0;
					while ($author_posts->have_posts()) : $author_posts->the_post();
					?>

					<!-- Code for displaying each author's post -->
					<div class="col-md-4p">
						<div class="post-block" onclick="window.location.href='<?php the_permalink(); ?>';">
							<?php if (has_post_thumbnail()): ?>
								<img loading="lazy" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
							<?php endif; ?>

							<div class="post-meta">
								<span class="post-author"><?php the_author_posts_link(); ?></span>
								<span class="post-date"><?php the_date(); ?></span>
							</div>

							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="p-excerpt"><?php the_excerpt(); ?></div>
						</div>
					</div>

					<?php
					$count++;
					if ($count === 3) {
						echo '</div></div></div>';

						// Inserted code
						echo '<div class="cta-post">
								<div class="container">
									<div class="row-b">
										<div class="col-md-3-1">
											<p class="cta-zyall">'.get_field('zhovtyj_tekst_b', 'options').'</p>
											<p class="cta-b-0">'.get_field('bilyj_tekst_b', 'options').'</p>
											<img loading="lazy" class="cta-bl" src="'.get_field('strilka_b', 'options').'">
										</div>
										<div class="col-md-3-2">
											<h4 class="cta-b-1">'.get_field('pershyj_tekst_b', 'options').'</h4>
											<p class="cta-b-2">'.get_field('drugyj_tekst_b', 'options').'</p>
											'.do_shortcode('[mp_subscribe_form_shortcode]').'
										</div>
									</div>
								</div>
							</div>';

						echo '<div class="blog-sff"><div class="row"><div class="col-12-m">';
					}
					endwhile;
					wp_reset_postdata();
					?>
</div>
			</div>
		</div>
<nav id="pagination-nav">
					<!-- The pagination component -->
					<?php
					echo paginate_links( array(
					'total'        => $author_posts->max_num_pages,
					'current'      => max( 1, get_query_var('paged') ),
					'format'       => 'page/%#%/', // Изменим формат на 'page/%#%/'
					'show_all'     => false,
					'type'         => 'plain',
					'end_size'     => 2,
					'mid_size'     => 1,
					'prev_next'    => true,
					'prev_text'    => __( 'Prevous', 'lanetclick' ),
					'next_text'    => __( 'Next', 'lanetclick' ),
					'add_args'     => false,
					'add_fragment' => '',
					) );
					?>
		</nav>

		<?php
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );
		endif;
		?>
	</main><!-- .site-main -->
</div><!-- .content-area -->
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
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .page-header, .blog-sf, .blog-sff, .cta-post, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        var computedStyle = getComputedStyle(div);
        var paddingTop = computedStyle.paddingTop;
        var paddingBottom = computedStyle.paddingBottom;
        div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
}

function resetPadding() {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .page-header, .blog-sf, .blog-sff, .cta-post, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
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
<?php get_footer(); ?>
