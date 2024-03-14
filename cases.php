<?php  
/*
Template Name: Сases
*/
?>
<?php get_header(); ?>
<div class="first-scr-ssp">
		<h1 class="h1-cks"><?php the_field('h1_cks'); ?><img class="h1-cks-img" src="<?php the_field('case_mainimg'); ?>"></h1>
		</div>

<div class="scscr-sspc" >
<div class="bread">
	<img id="homebread" src="/wp-content/uploads/2023/07/home-w-bred.svg">
<?php if( function_exists( 'aioseo_breadcrumbs' ) ) aioseo_breadcrumbs(); ?>
	</div>
	</div>
<div class="case-m">
<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-tag="all"><?php _e('All', 'lanetclick');?></a>
        </li>
        <?php 
        // Получить все теги
        $tags = get_tags();
        foreach ($tags as $tag) :
        ?>
        <li class="nav-item">
            <a class="nav-link" data-tag="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a>
        </li>
        <?php 
        endforeach; 
        ?>
    </ul>
    <div class="tab-content">
        <div id="tab-pages-container">
            <!-- Ajax Pages will be loaded here -->
        </div>
    </div>
	<button id="load-more" data-page="2" data-url="<?php echo admin_url('admin-ajax.php')?>"><?php _e('Load more', 'lanetclick');?></button>
</div>
</div>
<script>
var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
var page = 1;
var tag = 'all';
var initialLoad = true;
var tabChange = false;

$('body').on('click', '.nav-link', function(e) {
    e.preventDefault();
    $('.nav-link').removeClass('active');
    $(this).addClass('active');
    tag = $(this).data('tag');
    page = 1;
    tabChange = true;
    loadPages(tag, page);
	$('#load-more').text('<?php _e('Load more', 'lanetclick');?>').data('page', 2).prop('disabled', false);
});

$('body').on('click', '.page-numbers', function(e) {
    e.preventDefault();
    page = parseInt($(this).text());
    tabChange = false;
    loadPages(tag, page);
	});

function loadPages(tag, page) {
    $.ajax({
        url: ajaxUrl,
        type: 'post',
        data: {
            action: 'load_pages_by_ajax',
            tag: tag,
            page: page,
            security: '<?php echo wp_create_nonce("load_more_pages"); ?>'
        },
        success: function(response) {
            var result = response.split('<!-- pagination divide -->');
            $('#tab-pages-container').html(result[0]);
            $('#pagination-nav').html(result[1]);
            if (!initialLoad && !tabChange && $(window).width() >= 1180) {
                $('html, body').animate({
                    scrollTop: $('#tab-pages-container').offset().top
                }, 800);
            }
            initialLoad = false;
        }
    });
}

loadPages(tag, page);
</script>

<script>
$('#load-more').on('click', function(e) {
    e.preventDefault();
    var button = $(this);
    var page = button.data('page');
    var url = button.data('url');
    var totalItems = $('#tab-pages-container .col-ca-4').length;
    

    $.ajax({
        url : url,
        type : 'post',
        data : {
            page : page,
            tag : tag,
            totalItems: totalItems,
            action : 'load_pages_by_ajax',
            security: '<?php echo wp_create_nonce("load_more_pages"); ?>'
        },
        beforeSend : function() {
            button.text('<?php _e('Loading...', 'lanetclick');?>');
        },
        success : function(response) {
            if(response.trim() == '') {
                button.text('<?php _e('We dont have more cases yet.', 'lanetclick');?>');
                button.prop('disabled', true);
            } else {
                button.text('<?php _e('Load more', 'lanetclick');?>').data('page', page+1);
                $('#tab-pages-container').append(response);
            }
        },
        error : function(response) {
            console.log(response);
        }
    });
});
</script>

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
    var sspDivs = document.querySelectorAll('.scscr-sspc, .scscr-ssp2, .case-m, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        var computedStyle = getComputedStyle(div);
        var paddingTop = computedStyle.paddingTop;
        var paddingBottom = computedStyle.paddingBottom;
        div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
}

function resetPadding() {
    var sspDivs = document.querySelectorAll('.scscr-sspc, .scscr-ssp2, .case-m, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
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