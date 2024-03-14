<?php
/*
Template Name: Pro nas
*/
?>
<?php get_header();
$current_lang = ICL_LANGUAGE_CODE; ?>
<div class="first-scr-ssp">
    <?php
    $image = get_field('zobrmy_ps'); // Получение массива изображения из ACF

    if (!empty($image)) {
        $image_url = $image['url']; // URL изображения
        $image_alt = $image['alt']; // Альтернативный текст

        // Вывод изображения с URL и альтернативным текстом
        echo '<img class="smm-h" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
    }
    ?>
    <?php
    $image = get_field('zobrmy_mob'); // Получение массива изображения из ACF

    if (!empty($image)) {
        $image_url = $image['url']; // URL изображения
        $image_alt = $image['alt']; // Альтернативный текст

        // Вывод изображения с URL и альтернативным текстом
        echo '<img class="smm-h-m" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
    }
    ?>
    <div class="f-text1smm">
        <h5 class="text4f"><?php the_field('opysmy'); ?></h5>
        <div class="btn-first-nor">
            <?php
            $data_id = 4;
            if ('en' == $current_lang) {
                $data_id = 6;
            } elseif ('ru' == $current_lang) {
                $data_id = 5;
            }
            ?>
            <button data-form-id="<?php echo $data_id; ?>" class="btn-first cta-b" data-form-name="first-scr-ssp">
                <?php the_field('tekst_na_knopczimy'); ?>
            </button>
        </div>
    </div>
</div>

<div class="scscr-ssp">
    <div class="bread">
        <img id="homebread" src="/wp-content/uploads/2023/04/bread.svg">
        <?php if (function_exists('aioseo_breadcrumbs')) aioseo_breadcrumbs(); ?>
    </div>
</div>
<div class="zagblock">
    <div class="myh1">
        <h1><?php the_field('h1my'); ?></h1>
    </div>
    <div class="row my1bl">
        <div class="col-my-1">
            <h2><?php the_field('pershyj_h2my'); ?></h2>
            <p><?php the_field('opys_pid_1_h2'); ?></p>
        </div>
        <div class="col-my-2">
            <?php
            $image = get_field('zobrazhennya_1_h2my'); // Получение массива изображения из ACF

            if (!empty($image)) {
                $image_url = $image['url']; // URL изображения
                $image_alt = $image['alt']; // Альтернативный текст

                // Вывод изображения с URL и альтернативным текстом
                echo '<img loading="lazy" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
            }
            ?>
        </div>
    </div>

    <?php
    $slider = get_field('slaider');

    if (isset($slider)) : ?>
        <div class='slaider-media swiper'>
            <h3>
                <?php echo $slider['title']; ?>
            </h3>
            <div class="slaider-media-wrapper swiper-wrapper">
                <?php
                $slider_array = $slider['slider'];
                if (!empty($slider_array)) {
                    foreach ($slider_array as $slide) {
                        $image = $slide['image'];
                        $link = !empty($slide['link']['url']) ? $slide['link']['url'] : false;
                ?>
                        <a target="_blank" href="<?php echo $link ? esc_url($link) : 'please install the link '; ?>" class="slider-item swiper-slide">
                            <div class="slider-item-image">
                                <img src="<?php echo !empty($image['url']) ? $image['url'] : ''; ?>" alt="<?php echo !empty($image['alt']) ? $image['alt'] : $image['title'] ?>">
                            </div>
                            <div class="slider-media-content">
                                <?php echo $slide['text']; ?>
                            </div>
                            <span class="line-slider">
                            </span>
                        </a>
                <?php }
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-my-3">
            <h2><?php the_field('drugyj_h2my'); ?></h2>
            <p><?php the_field('korotkyj_opysmy'); ?></p>
        </div>
        <div class="col-my-6">
            <?php
            $image = get_field('zobrazhennya_2_h2my'); // Получение массива изображения из ACF

            if (!empty($image)) {
                $image_url = $image['url']; // URL изображения
                $image_alt = $image['alt']; // Альтернативный текст

                // Вывод изображения с URL и альтернативным текстом
                echo '<img loading="lazy" class="chashka" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
            }
            ?>
        </div>
        <div class="col-my-4">
            <div class="container">
                <div class="row vidy-cenosti">
                    <?php if (have_rows('czinnostimy')) : ?>
                        <?php while (have_rows('czinnostimy')) : the_row(); ?>
                            <div class="col-md-4-cenno">
                                <div class="vidy-ceno">
                                    <div class="vid-cenosti">
                                        <img loading="lazy" class="image-cenosti" src="<?php the_sub_field('ikonka_czinnostimy'); ?>" alt="">
                                        <h4><?php the_sub_field('h3_czinnostimy'); ?></h4>
                                    </div>
                                    <p class="opis-cenosti"><?php the_sub_field('opys_czinnostimy'); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-my-4-m">
            <div class="swiper-container swiper-cenosti">
                <div class="swiper-wrapper">
                    <?php while (have_rows('czinnostimy')) : the_row(); ?>
                        <div class="swiper-slide">
                            <div class="slide-content">
                                <img loading="lazy" style="width:50px;display: block;margin: 0 auto;" src="<?php the_sub_field('ikonka_czinnostimy'); ?>" alt="">
                                <h4><?php the_sub_field('h3_czinnostimy'); ?></h4>
                                <p><?php the_sub_field('opys_czinnostimy'); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="tar-pagination"></div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var swiper = new Swiper('.swiper-cenosti', {
                    loop: true,
                    slidesPerView: 1, // Default
                    spaceBetween: 0, // Default
                    pagination: {
                        el: '.tar-pagination',
                        clickable: true,
                        dynamicBullets: false,
                    },
                });
            });
        </script>
    </div>
</div>

<div class="team">
    <h2 class="pronas-h2"><?php the_field('h2_komanda'); ?></h2>
    <div class="slider-container5">
        <div class="slider5">
            <?php if (have_rows('komanda')) : ?>
                <?php while (have_rows('komanda')) : the_row(); ?>
                    <div class="slide5">
                        <div class="komanda-container">
                            <img loading="lazy" class="komanda-img" src="<?php the_sub_field('foto_komanda'); ?>" alt="">
                            <div class="colaps-k">
                                <img loading="lazy" class="bjola-k" src="/wp-content/uploads/2023/05/bjolateamn.svg" alt="">
                                <p class="dodat-k"><?php the_sub_field('dodatkova_informacziya_komanda'); ?></p>
                            </div>
                        </div>
                        <div>
                            <p class="imya-k"><?php the_sub_field('imya_komanda'); ?></p>
                            <p class="posada-k"><?php the_sub_field('posada_komanda'); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // Инициализация Slick Slider
        $('.slider5').slick({
            dots: true,
            vertical: false,
            centerMode: false,
            arrows: false,
            autoplay: false,
            infinite: false,
            adaptiveHeight: true,
            variableWidth: true,
            autoplaySpeed: 3000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });
    });
</script>
<div class="cta">
    <div class="container">
        <div class="row">
            <div class="col-md-3-1">
                <p class="cta-z"><?php the_field('zagolovok_cta'); ?></p>
                <p class="cta-zy"><?php the_field('zagolovok_cta_y'); ?></p>
                <p class="cta-pz"><?php the_field('pid_zagolovkom_cta'); ?></p>
            </div>
            <div class="col-md-3-2">
                <div class="cta-o"><?php the_field('opys_cta'); ?></div>
                <a class="cta-b" data-form-name="cta"><?php the_field('tekst_na_knopczi_sta'); ?></a>
            </div>
        </div>
    </div>
</div>
<section>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
    <?php endwhile;
    endif; ?>
</section>
<script>
    var resizeTimer;
    var baseWidth = 1439;
    var sliderSettings = {}; // Объект для хранения настроек слайдера

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
        var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .zagblock, .team, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
        sspDivs.forEach(function(div) {
            var computedStyle = getComputedStyle(div);
            var paddingTop = computedStyle.paddingTop;
            var paddingBottom = computedStyle.paddingBottom;
            div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
        });
    }

    function resetPadding() {
        var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .zagblock, .team, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
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