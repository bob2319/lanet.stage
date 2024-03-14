<?php  
/*
Template Name: blog
*/
?>
<?php get_header(); ?>
<div class="first-scr-ssp">
	<?php 
$image = get_field('ssp_mainimg'); // Получение массива изображения из ACF

if (!empty($image)) {
    $image_url = $image['url']; // URL изображения
    $image_alt = $image['alt']; // Альтернативный текст

    // Вывод изображения с URL и альтернативным текстом
    echo '<img class="blo-h" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
}
?>
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
<div class="blog-m">
    <div class="tabs">
        <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-category="all"><?php _e('All', 'lanetclick'); ?></a>
    </li>
    <?php
    $current_language = apply_filters('wpml_current_language', NULL);
    $args = array(
        'exclude' => 1,
        'lang' => $current_language,
        'hide_empty' => 1  // Скрывать пустые категории
    );
    $categories = get_categories($args);

    // Вставьте эту строку для отладки
    // var_dump($categories);

    foreach ($categories as $category) :
        if($category->count > 0):  // Проверка, есть ли посты в этой категории
    ?>
        <li class="nav-item">
            <a class="nav-link" data-category="<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
        </li>
    <?php 
        endif;
    endforeach; 
    ?>
</ul>



        <div class="tab-content">
            <div id="tab-posts-container">
                <!-- Ajax Posts will be loaded here -->
            </div>
        </div>
        <nav id="pagination-nav">
            <!-- Pagination will be loaded here -->
        </nav>
    </div>
</div>

<script>
var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
var page = 1;
var category = 'all';
var initialLoad = true;
var tabChange = false;

$('body').on('click', '.nav-link', function(e) {
    e.preventDefault();
    $('.nav-link').removeClass('active');
    $(this).addClass('active');
    category = $(this).data('category');
    categoryName = $(this).text();
    page = 1;
    tabChange = true;
    loadPosts(category, page, categoryName, true);
});

$('body').on('click', '.page-numbers', function(e) {
    e.preventDefault();
    page = parseInt($(this).text());
    tabChange = false;
    loadPosts(category, page, null, false);
});

function loadPosts(category, page, categoryName, updateBreadcrumbs) {
    var langPath = window.location.pathname.split('/')[1];
    var langCode = langPath.length === 2 ? langPath : 'default';
	var lang = "<?php echo ICL_LANGUAGE_CODE; ?>";;
    var labels = {
        'en': { mainLabel: 'Main', blogLabel: 'Blog' },
        'ru': { mainLabel: 'Головна', blogLabel: 'Блог' },
        'default': { mainLabel: 'Головна', blogLabel: 'Блог' } // язык по умолчанию
    };
    var mainLabel = labels[langCode].mainLabel;
    var blogLabel = labels[langCode].blogLabel;

	
    $.ajax({
        url: ajaxUrl,
        type: 'post',
        data: {
            action: 'load_posts_by_ajax',
            category_id: category,
            page: page,
            security: '<?php echo wp_create_nonce("load_more_posts"); ?>',
			lang: lang
        },
        success: function(response) {
            var result = response.split('<!-- pagination divide -->');
            $('#tab-posts-container').html(result[0]);
            $('#pagination-nav').html(result[1]);
            if (!initialLoad && !tabChange) {
                $('html, body').animate({
                    scrollTop: $('.blog-m').offset().top
                }, 100);
            }
            initialLoad = false;

            var newUrl = (lang === 'uk' ? window.location.origin : window.location.origin + '/' + lang) + (category === 'all' ? '/blog/' : '/category/' + category + '/');
            if(page !== 1) {
                newUrl += "page/" + page + '/';
            }
            history.pushState(null, null, newUrl);

            if (updateBreadcrumbs) {
                if (category !== 'all') {
                    $('.aioseo-breadcrumbs').html('<span class="aioseo-breadcrumb"><a href="https://lanet.click" title="' + mainLabel + '">' + mainLabel + '</a></span><span class="aioseo-breadcrumb-separator">/</span><a href="https://lanet.click/blog/" title="Блог">' + blogLabel + '</a></span><span class="aioseo-breadcrumb-separator">/</span><span class="aioseo-breadcrumb"><a href="https://lanet.click/category/' + category + '">' + categoryName + '</a></span>');
                } else {
                    $('.aioseo-breadcrumbs').html('<span class="aioseo-breadcrumb"><a href="https://lanet.click" title="' + mainLabel + '">' + mainLabel + '</a></span><span class="aioseo-breadcrumb-separator">/</span><span class="aioseo-breadcrumb">' + blogLabel + '</span>');
                }
            }
        }
    });
}


// Load posts on page load
loadPosts(category, page, null, false);
</script>


<div class="cta">
	<div class="container">
		<div class="row-b">
			<div class="col-md-3-1">
				<p class="cta-zyall"><?php the_field('zhovtyj_tekst_b'); ?></p>
				<p class="cta-b-0"><?php the_field('bilyj_tekst_b'); ?></p>
				<img loading="lazy" class="cta-bl" src="<?php the_field('strilka_b'); ?>">
				<img loading="lazy" class="cta-blm" src="/wp-content/uploads/2023/09/sota-blue.svg">
			</div>
			<div class="col-md-3-2">
				<h4 class="cta-b-1"><?php the_field('pershyj_tekst_b'); ?></h4>
				<p class="cta-b-2"><?php the_field('drugyj_tekst_b'); ?></p>
				<?php echo do_shortcode('[mp_subscribe_form_shortcode]'); ?>
			</div>
</div>
</div>
	</div>
<section>
	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
</section>
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
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .blog-m, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        var computedStyle = getComputedStyle(div);
        var paddingTop = computedStyle.paddingTop;
        var paddingBottom = computedStyle.paddingBottom;
        div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
}

function resetPadding() {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .blog-m, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
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