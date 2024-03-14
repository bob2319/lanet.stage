<?php  
/*
Template Name: category
*/
?>
<?php get_header(); ?>
<div class="first-scr-ssp">
		<?php $category_id = get_queried_object_id();
		$imgcat = get_field( 'shapka_kategoriyi', 'category_'.$category_id);
		if ($imgcat) {
   			echo '<img class="smm-h" src="' . $imgcat . '"/>';
		} ?>
		
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
                <a class="nav-link active" data-category="all"><?php _e('All', 'lanetclick');?></a>
            </li>
            <?php 
            $categories = get_categories(array('exclude' => 1));
            foreach ($categories as $category) :
            ?>
            <li class="nav-item">
                <a class="nav-link" data-category="<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
            </li>
            <?php 
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
$(document).ready(function() {
    var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var currentCategory = window.location.pathname.split('/category/')[1];
    currentCategory = currentCategory ? currentCategory.split('/')[0] : null;

    if (currentCategory) {
        $.post(ajaxUrl, {
            action: 'get_category_name_by_slug',
            slug: currentCategory
        }, function(response) {
            document.title = 'Категория: ' + response;
            var initialCategoryName = response;
            initializePage(initialCategoryName);
        });
    } else {
        var initialCategoryName = 'Блог';
        initializePage(initialCategoryName);
    }

    function initializePage(initialCategoryName) {
        var page = 1;
        var category = currentCategory || 'all';
        var initialLoad = true;
        var tabChange = false;

        var langPath = window.location.pathname.split('/')[1];
        var langCode = langPath.length === 2 ? langPath : 'default';
        localStorage.setItem('langCode', langCode);

        function setActiveTab(category) {
            $('.nav-link').removeClass('active');
            $('.nav-link[data-category="' + category + '"]').addClass('active');
        }

        setActiveTab(category);

        $('body').on('click', '.nav-link', function(e) {
            e.preventDefault();
            category = $(this).data('category');
            categoryName = $(this).text();

            var langPath = window.location.pathname.split('/')[1];
            var langCode = langPath.length === 2 ? langPath : 'default';
            localStorage.setItem('langCode', langCode);

            if (category === 'all') {
                window.location.href = 'https://lanet.click/blog/';
                return;
            }

            setActiveTab(category);
            page = 1;
            tabChange = true;
            loadPosts(category, page, categoryName, true);

            var langCode = localStorage.getItem('langCode') || 'default';
            var newUrl = window.location.origin;
            if (langCode !== 'default') {
                newUrl += '/' + langCode;
            }
            newUrl += '/category/' + category + '/';
            history.pushState(null, null, newUrl);
        });

        $('body').on('click', '.page-numbers', function(e) {
            e.preventDefault();
            page = parseInt($(this).text());
            tabChange = false;
            loadPosts(category, page, null, false);
        });

        function loadPosts(category, page, categoryName, updateBreadcrumbs) {
            var langCode = localStorage.getItem('langCode') || 'default';

            var labels = {
                'en': { mainLabel: 'Main', blogLabel: 'Blog' },
                'ru': { mainLabel: 'Головна', blogLabel: 'Блог' },
                'default': { mainLabel: 'Головна', blogLabel: 'Блог' }
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
                    security: '<?php echo wp_create_nonce("load_more_posts"); ?>'
                },
                success: function(response) {
                    var result = response.split('<!-- pagination divide -->');
                    $('#tab-posts-container').html(result[0]);
                    $('#pagination-nav').html(result[1]);
                    if (!initialLoad && !tabChange) {
                        $('html, body').animate({
                            scrollTop: $('#tab-posts-container').offset().top
                        }, 800);
                    }
                    initialLoad = false;
                }
            });
        }

        loadPosts(category, page, initialCategoryName, true);
    }
});
</script>
<div class="cta">
	<div class="container">
		<div class="row-b">
			<div class="col-md-3-1">
				<p class="cta-zyall"><?php the_field('zhovtyj_tekst_b', 'options'); ?></p>
				<p class="cta-b-0"><?php the_field('bilyj_tekst_b', 'options'); ?></p>
				<img loading="lazy" class="cta-bl" src="<?php the_field('strilka_b', 'options'); ?>">
				<img loading="lazy" class="cta-blm" src="/wp-content/uploads/2023/09/sota-blue.svg">
			</div>
			<div class="col-md-3-2">
				<h4 class="cta-b-1"><?php the_field('pershyj_tekst_b', 'options'); ?></h4>
				<p class="cta-b-2"><?php the_field('drugyj_tekst_b', 'options'); ?></p>
				<?php echo do_shortcode('[mp_subscribe_form_shortcode]'); ?>
			</div>
</div>
</div>
	</div>

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