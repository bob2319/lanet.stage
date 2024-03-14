<?php
/**
Template Name: Single post
 */
?>

<?php
get_header();
while (have_posts()) : the_post();
?>
<div class="first-scr-ssp">
        <img class="smm-h" src="<?php the_field('img_zapysu_bloga', 'options'); ?>">
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
<?php if( function_exists( 'custom_breadcrumbs' ) ) custom_breadcrumbs(); ?>
    </div>
    </div>
<div class="blog-m">
		<h1><?php the_title();?></h1>
<div class="container">
    <div class="row-pos">
        <!-- First Block -->
        <div class="col-blp-1">
            <div class="post-meta">
                <p class="autor-p"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
        <?php echo get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name'); ?><?php 
$author_id = get_the_author_meta('ID');  // ID автора текущего поста
$custom_author_point = get_field('point_avtora', 'user_' . $author_id); // Получаем значение из пользовательского поля ACF

if (function_exists('icl_t')) {
    $custom_author_point = icl_t('ACF', 'point_avtora_' . $author_id, $custom_author_point);
}

echo '' . $custom_author_point . '';
?>
    </a></p>
                <p class="date-p"><?php the_date(); ?></p>
                <!-- Add code to display star rating here -->
            </div>
            <?php if (has_post_thumbnail()): ?>
                <img src="<?php the_post_thumbnail_url(); ?>" width="640" height="482" alt="<?php the_title(); ?>">
            <?php endif; ?>
        </div>
       <div class="col-blp-2">
    <h3><?php _e('Content', 'lanetclick'); ?></h3>
    <div class="scroll-list">
        <?php
$content = apply_filters('the_content', get_the_content());
$pattern = '/<h([23])><span id="toc-\1-(.*?)">(.*?)<\/span><\/h[23]>/';
preg_match_all($pattern, $content, $matches);

$list = [];
$hasH2 = false;

foreach ($matches[1] as $index => $tag) {
    $headingText = $matches[3][$index];
    $headingID = $matches[2][$index];
    if ($tag === '2') {
        $hasH2 = true;
        $list[] = ['text' => $headingText, 'id' => $headingID, 'level' => 2, 'subs' => []];
    } elseif ($tag === '3') {
        $lastH2 = end($list);
        if ($hasH2 && $lastH2) {
            $list[key($list)]['subs'][] = ['text' => $headingText, 'id' => $headingID, 'level' => 3];
        } else {
            $list[] = ['text' => $headingText, 'id' => $headingID, 'level' => 3, 'subs' => []];
        }
    }
}

if (!empty($list)) {
    echo '<ol style="list-style-type: none;" class="custom-list">';
    foreach ($list as $item) {
        echo '<li><a href="#toc-' . $item['level'] . '-' . $item['id'] . '">' . $item['text'] . '</a>';
        if (!empty($item['subs'])) {
            echo '<ol style="list-style-type: none;">';
            foreach ($item['subs'] as $sub) {
                echo '<li><a href="#toc-' . $sub['level'] . '-' . $sub['id'] . '">' . $sub['text'] . '</a></li>';
            }
            echo '</ol>';
        }
        echo '</li>';
    }
    echo '</ol>';
}
?>

    </div>
</div>
</div>
<script>
$(document).ready(function() {
    var onlyH3 = true;

    $('.custom-list > li > a').each(function() {
        if ($(this).attr('href').indexOf('toc-2-') !== -1) {
            onlyH3 = false;
            return false;
        }
    });

    $('.custom-list').each(function(i, ol) {
        $(ol).children('li').each(function(i, li) {
            var h2Index = i + 1;

            if (onlyH3) {
                $(li).prepend('<span class="custom-counter">' + h2Index + '. </span>');
            } else {
                if ($(li).children('a').attr('href').indexOf('toc-2-') !== -1) {
                    $(li).prepend('<span class="custom-counter">' + h2Index + '. </span>');
                }

                $(li).children('ol').children('li').each(function(i, li) {
                    var h3Index = i + 1;
                    $(li).prepend('<span class="custom-counter">' + h2Index + '.' + h3Index + ' </span>');
                });
            }
        });
    });
});
</script>

    </div>  </div>

    <!-- Second Block -->
<div class="blog-m2">
    <div class="row-b">
        <div class="col-12-c">
            <div class="content-with-padding">
            <?php 
            global $post;

            // Check if the specific more tag is in the content
            if (strpos($post->post_content, '<p><span id="more-') !== false) {
                // Split the content by the specific more tag
                $content_parts = explode('<p><span id="more-', $post->post_content);
                // Removing the first part after the split as it's invalid
                array_shift($content_parts);
                // Joining the remaining parts with a placeholder, then splitting by the placeholder
                $content_parts = explode('<--split-here-->', join('<--split-here-->', $content_parts));
            } else {
                // Fallback if the specific more tag is not found
                $content_parts = explode('<!--more-->', $post->post_content);
            }

            // Process the content_parts array
            if (count($content_parts) >= 3) { ?>
                <div class="blog-m2cu">
                    <?php echo apply_filters('the_content', $content_parts[0]); ?>
                </div></div>
                <div class="cta-post">
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
                                <?php echo do_shortcode(get_field('shortkod_mailchimp')); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-with-padding">
                    <div class="blog-m2cu">
                    <?php echo apply_filters('the_content', $content_parts[1]); ?>
                </div></div>

                <div class="why-sama">
                    <h3><?php the_field('h3_why_sama'); ?></h3>
                    <div class="row">
                        <div class="col-sa-2">
                            <img loading="lazy" class="sama-why-img" src="<?php the_field('img_why_sama'); ?>" alt="">
                            <img loading="lazy" class="sama-why-img-m" src="<?php the_field('img_why_sama_m'); ?>" alt="">
                        </div>
                        <div class="col-sa-3">
                            <div class="why-sama_bl">
                                <h4><?php the_field('h4_why_sama'); ?></h4>
                                <p><?php the_field('p_why_sama'); ?></p>
                                <button class="btn-first masthev-b" href="<?php the_field('link_why_sama'); ?>"><?php the_field('btn_why_sama'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-with-padding">
                    <?php echo apply_filters('the_content', $content_parts[2]); ?>
                </div>

            <?php } else {
                // Fallback if there are less than two breaks
                the_content();
            } ?>
        </div>
        
    </div>
</div>


    <!-- Third Block -->
<div class="content-with-padding">
    <div class="row">
        <div class="col-12-s">
            <?php $current_url = get_permalink(); ?>
<a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($current_url); ?>" target="_blank"><img loading="lazy" class="soc-f" src="/wp-content/uploads/2023/04/facebook-1.svg"></a>
<a rel="nofollow" href="https://twitter.com/share?url=<?php echo urlencode($current_url); ?>&text=[your-message]" target="_blank"><img loading="lazy" class="soc-f" src="/wp-content/uploads/2023/10/twit.svg"></a>
<a rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($current_url); ?>" target="_blank"><img loading="lazy" class="soc-f" src="/wp-content/uploads/2023/04/linkd.svg"></a>
<a rel="nofollow" href="https://pinterest.com/pin/create/bookmarklet/?media=[image-url]&url=<?php echo urlencode($current_url); ?>&description=[your-description]" target="_blank"><img loading="lazy" class="soc-f" src="/wp-content/uploads/2023/10/pinterest.svg"></a>
<a rel="nofollow" href="https://telegram.me/share/url?url=<?php echo urlencode($current_url); ?>" target="_blank"><img loading="lazy" class="soc-f" src="https://lanet.click/wp-content/uploads/2023/04/telegrame-1.svg"></a>
<a rel="nofollow" href="https://wa.me/?text=<?php echo urlencode($current_url); ?>" target="_blank"><img loading="lazy" class="soc-f" src="/wp-content/uploads/2023/10/whatsup.svg"></a>
<a rel="nofollow" href="viber://forward?text=<?php echo urlencode($current_url); ?>" target="_blank"><img loading="lazy" class="soc-f" src="/wp-content/uploads/2023/10/viber.svg"></a>
        </div>
    </div>
</div>

    <!-- Fourth Block -->
<div class="blog-m">
    <div class="row">
        <div class="col-12-m">
           <h3><?php _e( 'Worth a read', 'lanetclick' ); ?></h3>

       
        <?php
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'post__not_in' => array(get_the_ID()), // Exclude the current post
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $related_posts = new WP_Query($args);
        while ($related_posts->have_posts()) : $related_posts->the_post();
        ?>
            
            <!-- Code for displaying each related post -->
            <div class="col-md-4p">
                <div class="post" onclick="window.location.href='<?php the_permalink(); ?>';">
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
        <?php endwhile; wp_reset_query(); ?>
    </div>
        </div>
 </div>
<script>document.querySelectorAll('.col-md-4p')[1].style.padding = "0 30px";</script>
<script>
var resizeTimer;
var baseWidth = 1439;
var sliderSettings = {};

function setPadding() {
    var basePadding = 70;
    var targetPadding = 680;
    var targetWidth = 2800;

    // Specific values for content-with-padding
    var contentBasePadding = 181;
    var contentTargetPadding = 790;

    var windowWidth = window.innerWidth;

    var newPadding;
    var newContentPadding;
    if (windowWidth <= baseWidth) {
        newPadding = basePadding;
        newContentPadding = contentBasePadding;
    } else if (windowWidth >= targetWidth) {
        newPadding = targetPadding;
        newContentPadding = contentTargetPadding;
    } else {
        var widthRatio = (windowWidth - baseWidth) / (targetWidth - baseWidth);
        newPadding = basePadding + widthRatio * (targetPadding - basePadding);
        newContentPadding = contentBasePadding + widthRatio * (contentTargetPadding - contentBasePadding);
    }

    setNewPadding(newPadding, newContentPadding);

    if (windowWidth <= baseWidth) {
        resetPadding();
    }
}

function setNewPadding(newPadding, newContentPadding) {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .blog-m, .cta-post, .why-sama, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2, .content-with-padding');
    sspDivs.forEach(function(div) {
        var computedStyle = getComputedStyle(div);
        var paddingTop = computedStyle.paddingTop;
        var paddingBottom = computedStyle.paddingBottom;

        if (div.classList.contains('content-with-padding')) {
            div.style.padding = paddingTop + ' ' + newContentPadding + 'px ' + paddingBottom + ' ' + newContentPadding + 'px';
        } else {
            div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
        }
    });
}

function resetPadding() {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .blog-m, .cta-post, .why-sama, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2, .content-with-padding');
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

<?php endwhile; get_footer(); ?>

<script>
function isMobileDevice() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

function setPaddingAndMargin() {
  const ctaPost = document.querySelector('.cta-post');
  const windowWidth = window.innerWidth;

  if (windowWidth <= 900) {
    ctaPost.style.paddingLeft = '16px';
    ctaPost.style.paddingRight = '16px';
    ctaPost.style.paddingTop = '60px';
    ctaPost.style.paddingBottom = '60px';
    ctaPost.style.marginLeft = '-16px';
    ctaPost.style.marginRight = '-16px';
  } else if (windowWidth <= 1439) {
    ctaPost.style.padding = '40px';
    ctaPost.style.paddingRight = '40px';
    ctaPost.style.paddingTop = '50px';
    ctaPost.style.paddingBottom = '50px';
    ctaPost.style.marginLeft = '-40px';
    ctaPost.style.marginRight = '-40px';
  } else {
    // Удалить инлайн-стили, если они были установлены
    ctaPost.style.paddingLeft = '';
    ctaPost.style.paddingRight = '';
    ctaPost.style.paddingTop = '';
    ctaPost.style.paddingBottom = '';
    ctaPost.style.marginLeft = '';
    ctaPost.style.marginRight = '';
  }
}

// Вызов функции при загрузке страницы
window.addEventListener('load', function() {
  if (isMobileDevice()) {
    // Установить паддинги для мобильного устройства и не добавлять обработчик resize
    const ctaPost = document.querySelector('.cta-post');
    ctaPost.style.paddingLeft = '16px';
    ctaPost.style.paddingRight = '16px';
    ctaPost.style.paddingTop = '60px';
    ctaPost.style.paddingBottom = '60px';
    ctaPost.style.marginLeft = '-16px';
    ctaPost.style.marginRight = '-16px';
  } else {
    // Если это не мобильное устройство, добавить обработчик события resize
    setPaddingAndMargin();
    window.addEventListener('resize', setPaddingAndMargin);
  }
});
</script>