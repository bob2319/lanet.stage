<?php  
/*
Template Name: FB-ads, ASO-opti, FB-promotion
*/
?>
<?php get_header(); ?>
<div class="first-scr-sama">
    <div class="scr-sama">
        <h1>
            <div class="h1-sama"><?php the_field('h1_sama'); ?></div>
        </h1>
        </div>
    <div class="f-text1smm">
        <h5 class="text4f"><?php the_field('opys_zag_ssp'); ?></h5>
        <div class="btn-first-nor"><button class="btn-first cta-b" data-form-name="first-scr-ssp"><?php the_field('tekst_knopky_sli_ssp'); ?></button></div>
</div>
    </div>
<div class="scscr-ssp" >
<div class="bread">
    <img id="homebread" src="/wp-content/uploads/2023/04/bread.svg">
<?php if( function_exists( 'aioseo_breadcrumbs' ) ) aioseo_breadcrumbs(); ?>
    </div>
    </div>
<div class="scscr-ssp2" >
<h2 class="h1smm"><?php the_field('nazva_poslugy_sn'); ?></h2>
    <div class="row">
        <div class="col-md-m-2sn">
            <h4><?php the_field('why_zag_ssp'); ?></h4>
            <p class="why-p-sn"><?php the_field('opys_poslugy_sn'); ?> </p>
            <button class="btn-first masthev-b"><?php the_field('btn_poslugy_sn'); ?></button>
        </div>
      <div class="col-md-m-1sn">
		  <?php 
$image = get_field('foto_komandy_sn'); // Получение массива изображения из ACF

if (!empty($image)) {
    $image_url = $image['url']; // URL изображения
    $image_alt = $image['alt']; // Альтернативный текст

    // Вывод изображения с URL и альтернативным текстом
    echo '<img loading="lazy" class="masthave-team" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
}
?>
     </div>      
</div></div>

<!-- Блок с классами Swiper -->
<div class="vidy-sama-s">
    <h2><?php the_field('h2_vidy_sama'); ?></h2>
    <p><?php the_field('p_vidy_sama'); ?></p>
    <div class="container">
        <div class="swiper-vidy-sama-pve">
            <div class="swiper-wrapper">
                <?php if (have_rows('vidy_sama_pve')) : ?>
                    <?php while (have_rows('vidy_sama_pve')) : the_row(); ?>
                        <div class="swiper-slide col-md-4-vidy-s">
                            <div class="vidy-sama-pva">
                                <div class="vidy-sama-sub">
                                    <img loading="lazy" class="sama-pva-image" src="/wp-content/uploads/2023/06/sotawawe2.svg" alt="">
                                    <h4><?php the_sub_field('h4_vidy_sama_pve'); ?></h4>
                                </div>
                                <p class="vidy-sama-p"><?php the_sub_field('p_vidy_sama_pve'); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="tar-pagination"></div>
        </div>
    </div>
</div>

<!-- Блок без классов Swiper -->
<div class="vidy-sama">
    <h2><?php the_field('h2_vidy_sama'); ?></h2>
    <p><?php the_field('p_vidy_sama'); ?></p>
    <div class="container">
    <div class="row vidy-sama-pve">
        <?php if (have_rows('vidy_sama_pve')) : ?>
            <?php while (have_rows('vidy_sama_pve')) : the_row(); ?>
                <div class="col-md-4-vidy">
                    <div class="vidy-sama-pva">
                        <div class="vidy-sama-sub">
                        <img loading="lazy" class="sama-pva-image" src="/wp-content/uploads/2023/06/sotawawe2.svg" alt="">
                        <h4><?php the_sub_field('h4_vidy_sama_pve'); ?></h4>
                            </div>
                        <p class="vidy-sama-p"><?php the_sub_field('p_vidy_sama_pve'); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Подсчет количества повторяющихся полей в каждом блоке
    var countVidySama = $('.vidy-sama .col-md-4-vidy h4').length;
    var countVidySamaS = $('.vidy-sama-s .col-md-4-vidy-s h4').length;

    // Проверка условий и показ/скрытие блоков
    if (countVidySama <= 3) {
        $('.vidy-sama').show();
        $('.vidy-sama-s').hide();
    } else if (countVidySamaS >= 4) {
        $('.vidy-sama').hide();
        $('.vidy-sama-s').show();
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  setTimeout(function() {
    let swiper = new Swiper('.swiper-vidy-sama-pve', {
      direction: 'horizontal',
      loop: true,
      slidesPerView: 4, // Default
      spaceBetween: 0, // Default
      centeredSlides: false,
      autoHeight: true,
      mousewheel: {
        invert: false,
        forceToAxis: true,
        sensitivity: 0.5,
        releaseOnEdges: true,
      },
      pagination: {
        el: '.tar-pagination',
        clickable: true,
        dynamicBullets: false,
      },
      breakpoints: {
          280: {
          slidesPerView: 1,
          spaceBetween: 0,
        },
        680: {
          slidesPerView: 1,
          spaceBetween: 0,
        },
        690: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1180: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    // Функция для обновления mousewheel
    function updateMousewheel() {
      if (window.innerWidth > 1180) {
        swiper.mousewheel.disable();
      } else {
        swiper.mousewheel.enable();
      }
    }

    // Обновляем mousewheel при загрузке страницы
    updateMousewheel();

    // Обновляем mousewheel при изменении размера окна
    window.addEventListener('resize', updateMousewheel);
  }, 200); // Задержка в 1000 миллисекунд (1 секунда)
});
</script>
<script>
$(document).ready(function() {
    var $window = $(window);

    function adjustBlocks() {
        // находим все блоки .col-md-4-vidy в контейнере .vidy-sama-pve
        var blocks = $('.vidy-sama-pve .col-md-4-vidy');
        
        if ($window.width() > 1440) {
            var paddingRight = 30; // отступ справа в пикселях

            // вычисляем ширину каждого блока
            var width = 98 / blocks.length;

            // вычисляем отступ справа в процентах
            var paddingRightPercent = paddingRight / $('.vidy-sama-pve').width() * 98;

            // устанавливаем ширину каждого блока и отступ справа
            blocks.css({
                'width': 'calc(' + width + '% - ' + paddingRightPercent + '%)',
                'padding-right': paddingRight + 'px'
            });

            // для последнего блока отступ справа не нужен
            blocks.last().css('padding-right', '0');
        } else {
            // если ширина окна меньше 1440, устанавливаем свойства обратно в их первоначальные значения
            blocks.css({
                'width': '',
                'padding-right': ''
            });
        }
    }

    // Вызываем функцию adjustBlocks при загрузке страницы
    adjustBlocks();

    // Отслеживаем изменение размера окна
    $window.resize(adjustBlocks);
});
</script>

<script type="text/javascript">
  $(document).on('ready', function() {
      $('.slidersm').slick({
        dots: true,
        vertical: false,
        centerMode: false,
        arrows : false,
        autoplay: true,
        infinite: true,
        adaptiveHeight: true,
        variableWidth: true,
        autoplaySpeed: 3000,
        slidesToShow: 5,
        slidesToScroll: 2,
        responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
              arrows : false,
            slidesToScroll: 1
          }
            }
            ]
      });
      $('.sliderprop').slick({
        dots: true,
        vertical: false,
        centerMode: false,
        arrows : false,
        autoplay: true,
        infinite: true,
        adaptiveHeight: false,
        variableWidth: true,
        autoplaySpeed: 3000,
        slidesToShow: 6,
        slidesToScroll: 2,
        responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
              arrows : false,
            slidesToScroll: 1
          }
            }
            ]
      });
      $('.slider3').slick({
        dots: true,
        vertical: false,
        centerMode: false,
        arrows : false,
          infinite: true,
          adaptiveHeight: true,
          autoplaySpeed: 3000,
          autoplay: true,
          variableWidth: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
              arrows : false,
            slidesToScroll: 1
          }
            }
            ]
      });
      $('.slider8').slick({
        dots: true,
        vertical: false,
        centerMode: false,
        arrows : false,
        autoplay: false,
        infinite: false,
        adaptiveHeight: true,
        variableWidth: true,
        autoplaySpeed: 3000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
              arrows : false,
            slidesToScroll: 1
          }
            }
            ]
      });
      });
</script>
<script>
$(document).ready(function() {
    var tarifSlider = $('.tarif-slider');

    function initTarifSlider() {
        if ($(window).width() < 1440) {
            tarifSlider.slick({
                dots: true,
                infinite: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                adaptiveHeight: true,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            arrows: false,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        } else if(tarifSlider.hasClass('slick-initialized')) {
            tarifSlider.slick('unslick');
        }
    }

    initTarifSlider();

    $(window).on('resize', function() {
        initTarifSlider();
    });
$('.details-toggle').on('click', function() {
        const tarif = $(this).closest('.tarif');
        tarif.find('.description').slideDown(250);
        tarif.find('.service').slideDown(250).promise().done(function() {
            tarif.find('.service').css('display', 'flex');
        });
        if ($('.tarif-slider').hasClass('slick-initialized')) {
            $('.tarif-slider').slick('setHeight');
            setTimeout(function() {
    var windowWidth = $(window).width();
    if (windowWidth < 768) {  // Проверяем, является ли ширина окна меньше 768 пикселей
        // Используем версию функции для мобильных устройств
        var $slickList = $('.tarif-slider').find('.slick-list.draggable');
        var $currentSlide = $('.tarif-slider').find('.slick-current');
        $slickList.height($currentSlide.height());
    } else {
        // Используем версию функции для настольных устройств
        tarif.find('.slick-slide').each(function() {
            var $slickList = $(this).find('.slick-list.draggable');
            var $currentSlide = $(this);
            $slickList.height($currentSlide.height());
        });
    }
}, 260);
        }
        tarif.find('.hide-toggle').toggle();
        $(this).toggle();
    });

    $('.hide-toggle').on('click', function() {
        const tarif = $(this).closest('.tarif');
        tarif.find('.description').slideToggle(200);
        tarif.find('.service').slice(5).slideUp(200).css('display', 'none');
        tarif.find('.details-toggle').toggle();
        $(this).toggle();
        setTimeout(function() {
            var $slickList = $('.tarif-slider').find('.slick-list.draggable');
            var $currentSlide = $('.tarif-slider').find('.slick-current');
            $slickList.height($currentSlide.height());
        }, 210);
    });

   $('.tarif').on('touchstart', function() {
    $(this).addClass('hover');
});

$('.tarif').on('touchend', function() {
    $(this).removeClass('hover');
});

});
</script>

<div class="tarif-ssp">
    <h2 class="tarif-h2"><?php the_field('zagolovok_tsina'); ?></h2>
    <div class="container">
    <div class="row tarif-slider">
        <?php if (have_rows('czina_tsina')) : ?>
            <?php while (have_rows('czina_tsina')) : the_row(); ?>
                <div class="col-md-4">
                    <?php if (get_sub_field('top_taryf') == 'yes') : ?>
                            <img loading="lazy" class="top-tarif-i" src="<?php _e( '/wp-content/uploads/2023/10/top-def.svg', 'lanetclick' ); ?>" alt="">
                        <?php endif; ?>
                    <div class="tarif">
                        <h3><?php the_sub_field('nazva_taryfu_tsina'); ?></h3>
                        <img loading="lazy" class="tarif-image" src="/wp-content/uploads/2023/03/sotahov.svg" alt="" style="display:none;">
                        <div class="services">
                            <?php
                            $counter = 0;
                            if (have_rows('poslugy_shho_vhodyat_tsina')):
                                while (have_rows('poslugy_shho_vhodyat_tsina')): the_row();
                                    $is_visible = $counter < 5 ? '' : ' style="display:none;"';
                            ?>
                                    <div class="service"<?php echo $is_visible; ?>>
                                        <span><?php echo strip_tags(get_sub_field('mitka_posluha_tsina')); ?></span> <?php echo strip_tags(get_sub_field('posluga_tsina')); ?>
                                    </div>
                            <?php
                                    $counter++;
                                endwhile;
                            endif;
                            ?>
                        </div>
                        <div class="description" style="display:none;"><?php the_sub_field('tekst_dodatkovyj_tsina'); ?></div>
                        <span class="details-toggle"><?php _e( 'More', 'lanetclick' ); ?></span>
                        <div class="price"><?php the_sub_field('vartist_tsina'); ?></div>
                        <div><a class="order-btn cta-b" data-form-name="tarif-ssp"><?php _e( 'Order', 'lanetclick' ); ?></a></div>
                        <span class="hide-toggle" style="display:none;"><?php _e( 'Hide', 'lanetclick' ); ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
</div>
<div class="mob-only">
<div class="tarif-ssp">
    <h2 class="tarif-h2"><?php the_field('zagolovok_tsina'); ?></h2>
    <div class="container">
        <div class="swiper-container tarif-slider555">
            <div class="swiper-wrapper">
                <?php if (have_rows('czina_tsina')) : ?>
                    <?php while (have_rows('czina_tsina')) : the_row(); ?>
                        <div class="swiper-slide">
                            <div class="col-md-455">
                                <?php if (get_sub_field('top_taryf') == 'yes') : ?>
                                    <img loading="lazy" class="top-tarif-i" src="<?php _e( '/wp-content/uploads/2023/10/top-def.svg', 'lanetclick' ); ?>" alt="">
                                <?php endif; ?>
                                <div class="tarif">
                                    <img loading="lazy" class="tarif-image-ppc" src="/wp-content/uploads/2023/03/sotahov.svg" alt="" style="display:none;">
                                    <h3><?php the_sub_field('nazva_taryfu_tsina'); ?></h3>
                                    <div class="services">
                                        <?php
                                        $counter = 0;
                                        if (have_rows('poslugy_shho_vhodyat_tsina')):
                                            while (have_rows('poslugy_shho_vhodyat_tsina')): the_row();
                                                $is_visible = $counter < 5 ? '' : ' style="display:none;"';
                                        ?>
                                                <div class="service"<?php echo $is_visible; ?>>
                                                    <span><?php echo strip_tags(get_sub_field('mitka_posluha_tsina')); ?></span> <?php echo strip_tags(get_sub_field('posluga_tsina')); ?>
                                                </div>
                                        <?php
                                                $counter++;
                                            endwhile;
                                        endif;
                                        ?>
                                    </div>
                                    <div class="description" style="display:none;"><?php the_sub_field('tekst_dodatkovyj_tsina'); ?></div>
                                    <span class="details-toggle"><?php _e( 'More', 'lanetclick' ); ?></span>
                                    <div class="price"><?php the_sub_field('vartist_tsina'); ?></div>
                                    <div><a class="order-btn cta-b" data-form-name="tarif-ssp"><?php _e( 'Order', 'lanetclick' ); ?></a></div>
                                    <span class="hide-toggle" style="display:none;"><?php _e( 'Hide', 'lanetclick' ); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <!-- Add Pagination -->
            <div class="tar-pagination"></div>
           </div>
    </div>
</div>
</div>
<script defer>
    jQuery(document).ready(function($) {
        var mySwiper = new Swiper('.tarif-slider555', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            slidesPerView: 1, // Display only one slide at a time
            spaceBetween: 0,  // No space between slides
            centeredSlides: false,
            mousewheel: true,
            

            // If we need pagination
            pagination: {
                el: '.tar-pagination',
                clickable: true,
                dynamicBullets: false,
                },
            
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
<div class="zavd-sama">
    <h3><?php the_field('h3_sama'); ?></h3>
    <p><?php the_field('p_sama'); ?></p>
    <div class="container z-sama">
    <div class="row">
        <?php if (have_rows('zavdanya_sama')) : ?>
            <?php while (have_rows('zavdanya_sama')) : the_row(); ?>
                <div class="col-sa-1">
                    <div class="sama-block">
                        <img loading="lazy" class="sama-image" src="/wp-content/uploads/2023/06/romb.svg" alt="">
                        <h4><?php the_sub_field('p4_sama'); ?></h4>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
</div>

<?php 
$zag4_ks = get_field('zagolovok_prop_ssp');
$slide_prop_ssp = get_field('slide_prop_ssp');

// Проверка наличия заполненных полей
if (!empty($zag4_ks) || !empty($slide_prop_ssp)): ?>

<div class="prop-ssp">
<h2 class="prop-h2"><?php echo $zag4_ks; ?></h2>
<p class="prop-p"><?php the_field('pidzagolovok_prop_ssp'); ?></p>
    
    <?php
    $count = count($slide_prop_ssp); // Добавлено для подсчета количества слайдов
    
    if (have_rows('slide_prop_ssp')): ?>
        <!-- Swiper container -->
        <div class="swiper-prop" data-slidecount="<?php echo $count; ?>" >
            <div class="swiper-wrapper">
                <?php while (have_rows('slide_prop_ssp')): the_row();
                    $opys_visn_ks = get_sub_field('tekst_sli_prosp_ssp');
                    if ($opys_visn_ks): ?>
                        <div class="swiper-slide">
                            <div class="slide-ckv">
                                <img loading="lazy" class="prop-imgs" src="<?php the_sub_field('ikonka_sli_ssp'); ?>" alt="">
                                <h3><a class="prop-h3" href="<?php the_sub_field('link_sli_prosp_ssp'); ?>"><?php the_sub_field('tekst_sli_prosp_ssp'); ?></a></h3> 
                            </div>
                        </div>
                    <?php endif;
                endwhile; ?>
            </div>
            <div class="tar-pagination"></div>
        </div>
    <?php endif; ?>
</div>
<div class="mob-only">
<div class="prop-ssp">
<h2 class="prop-h2"><?php echo $zag4_ks; ?></h2>
<p class="prop-p"><?php the_field('pidzagolovok_prop_ssp'); ?></p>
    
    <?php
    $count = count($slide_prop_ssp); // Добавлено для подсчета количества слайдов
    
    if (have_rows('slide_prop_ssp')): ?>
        <!-- Swiper container -->
        <div class="swiper-prop" data-slidecount="<?php echo $count; ?>" >
            <div class="swiper-wrapper">
                <?php while (have_rows('slide_prop_ssp')): the_row();
                    $opys_visn_ks = get_sub_field('tekst_sli_prosp_ssp');
                    if ($opys_visn_ks): ?>
                        <div class="swiper-slide">
                            <div class="slide-ckv">
                                <img loading="lazy" class="prop-imgs" src="<?php the_sub_field('ikonka_sli_ssp'); ?>" alt="">
                                <h3><a class="prop-h3" href="<?php the_sub_field('link_sli_prosp_ssp'); ?>"><?php the_sub_field('tekst_sli_prosp_ssp'); ?></a></h3> 
                            </div>
                        </div>
                    <?php endif;
                endwhile; ?>
            </div>
            <div class="tar-pagination"></div>
        </div>
    <?php endif; ?>
    </div></div>
<?php endif; ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const slideContainer = document.querySelector('.swiper-prop');
  const slideCount = parseInt(slideContainer.getAttribute('data-slidecount'), 10);
  let slidesToShow;

  if (slideCount <= 4) {
    slidesToShow = slideCount;
  } else {
    slidesToShow = 4;
  }

  let swiper = new Swiper('.swiper-prop', {
    direction: 'horizontal',
    loop: true,
    slidesPerView: 1, // Default
    spaceBetween: 0, // Default
    centeredSlides: false,
    autoHeight: true,
    mousewheel: {
      invert: false,
      forceToAxis: true,
      sensitivity: 0.5,
      releaseOnEdges: true,
    },
    pagination: {
      el: '.tar-pagination',
      clickable: true,
      dynamicBullets: false,
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1000: {
        slidesPerView: 2,
        spaceBetween: 40,
      },
      1180: {
        slidesPerView: slidesToShow,
        spaceBetween: 40,
      },
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  // Функция для обновления mousewheel и количества слайдов
  function updateSwiper() {
    if (window.innerWidth > 1180) {
      swiper.mousewheel.disable();
      swiper.params.slidesPerView = slidesToShow;
    } else {
      swiper.mousewheel.enable();
    }
    swiper.update();
  }

  // Обновляем Swiper и mousewheel при загрузке страницы
  updateSwiper();

  // Обновляем Swiper и mousewheel при изменении размера окна
  window.addEventListener('resize', updateSwiper);
});
</script>


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
            <a class="btn-firststat masthev-b" href="<?php the_field('link_why_sama'); ?>"><?php the_field('btn_why_sama'); ?></a>
         </div>
    </div>
</div>
</div>
<div class="vidhuki">
    <h2 class="case-h2"><?php the_field('h2_vidguki', 'options'); ?></h2>
    <p class="vidhuk-p"><?php the_field('vidguki_opis', 'options'); ?></p>
    <div class="slider-container3">
    <img loading="lazy" class="mnogog" src="/wp-content/uploads/2023/03/mnogogr.svg">
    <div class="slider3">
  <?php if ( have_rows('vidguk', 'options') ) : ?>
    <?php while ( have_rows('vidguk', 'options') ) : the_row(); ?>
        <div class="slide3">
        <img loading="lazy" class="lapki" src="/wp-content/uploads/2023/03/lapki.svg">
            <div class="stars"></div>
        <p class="vidguk-t"><?php the_sub_field('vidguk_text', 'options'); ?></p>
        <p class="consumer"> - <?php the_sub_field('avtor_vidguku', 'options'); ?></p>  
            </div>
<?php endwhile; ?>
  <?php endif; ?> 
</div>
</div>  </div>
<div class="faq">
    <h2><?php the_field('zagolovok_faq'); ?></h2>
    <p><?php the_field('pidzagolovok_faq'); ?></p>
    <div class="faq-container">
  <?php
    $faqs = get_field('pytannya');
    foreach ($faqs as $faq):
      $question = $faq['pytannya_faq'];
      $answer = $faq['vidpovid_faq'];
  ?>
  <div class="faq-item">
    <div class="faq-question">
      <h4><?php echo $question; ?></h4>
      <img loading="lazy" src="https://lanet.click/wp-content/uploads/2023/04/faq-arrow.svg" class="faq-arrow">
    </div>
    <div class="faq-answer">
      <img loading="lazy" src="https://lanet.click/wp-content/uploads/2023/03/sotahov.svg" class="faq-answer-img">
        <p class="answers"><?php echo $answer; ?></p>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<script>
  var faqs = document.querySelectorAll('.faq-item');
  faqs.forEach(function(faq) {
    var question = faq.querySelector('.faq-question');
    var answer = faq.querySelector('.faq-answer');
    var arrow = faq.querySelector('.faq-arrow');
    question.addEventListener('click', function() {
      answer.classList.toggle('show');
      arrow.classList.toggle('rotate');
    });
  });
</script>

</div>
<div class="prosdod">
    <h3><?php the_field('h3_pros_dod'); ?></h3>
    <div class="prosdod-p">
        <p><?php the_field('tekst_pros_dod'); ?></p></div>
</div>
<div class="cta">
    <div class="container">
        <div class="row">
            <div class="col-md-3-1">
                <p class="cta-z"><?php the_field('zagolovok_cta'); ?></p>
                <p class="cta-zyall"><?php the_field('zagolovok_cta_y'); ?></p>
                <p class="cta-z"><?php the_field('zagolovok_cta2'); ?></p>
                <p class="cta-pzall"><?php the_field('pid_zagolovkom_cta'); ?></p>
            </div>
            <div class="col-md-3-2">
                <div class="cta-o"><?php the_field('opys_cta'); ?></div>
                <a class="cta-b" data-form-name="cta"><?php the_field('tekst_na_knopczi_sta'); ?></a>
            </div>
</div>
</div>
    </div>
<section>
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
<script>
    $(document).ready(function() {
  $('.cta').each(function() {
    var $etapNam = $(this).find('.cta-z');
    if ($etapNam.text().trim() === '') {
      $(this).hide();
    }
  });
});
</script>
<script>
    $(document).ready(function() {
  $('.prop-ssp').each(function() {
    var $etapNam = $(this).find('.prop-h2');
    if ($etapNam.text().trim() === '') {
      $(this).hide();
    }
  });
});
</script>
<script>
    $(document).ready(function() {
  $('.nab-rish').each(function() {
    var $etapNam = $(this).find('.cta-z');
    if ($etapNam.text().trim() === '') {
      $(this).hide();
    }
  });
});
</script>
<script>
    $(document).ready(function() {
  $('.opty-copy').each(function() {
    var $h3 = $(this).find('h3');
    if ($h3.text().trim() === '') {
      $(this).hide();
    }
  });
});

</script>
<script>
    $(document).ready(function() {
  $('.etapy-ssp').each(function() {
    var $h2 = $(this).find('h2');
    if ($h2.text().trim() === '') {
      $($h2).hide();
    }
  });
});
</script>
<script>
</script>
<script type="text/javascript">
  var slider8Settings = {
    dots: true,
    vertical: false,
    centerMode: false,
    arrows: false,
    autoplay: false,
    infinite: false,
    adaptiveHeight: true,
    variableWidth: true,
    autoplaySpeed: 3000,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          arrows: false,
          slidesToScroll: 1
        }
      }
    ]
  };

  $(document).ready(function() {
    manageSlider();
  });

  $(window).resize(function() {
    manageSlider();
  });

  function manageSlider() {
    if ($(window).width() < 899) {
      // Если размер окна меньше 899px, инициализируем слайдер
      initializeSlider();
    } else {
      // Если размер окна 899px или больше, удаляем слайдер
      destroySlider();
    }
  }

  function initializeSlider() {
    if (!$('.slider8-ppc').hasClass('slick-initialized')) {
      // Если слайдер еще не инициализирован, инициализируем его
      $('.slider8-ppc').slick(slider8Settings);
    }
  }

  function destroySlider() {
    if ($('.slider8-ppc').hasClass('slick-initialized')) {
      // Если слайдер инициализирован, удаляем его
      $('.slider8-ppc').slick('unslick');
    }
  }

  // Подписываемся на событие переинициализации слайдеров
  $(document).on('reinitializeSlickSliders', function() {
    // Переинициализируем наш слайдер
    $('.slider8-ppc').slick('unslick');
    $('.slider8-ppc').slick(slider8Settings);
  });
</script>


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
    reinitializeSlickSliders();

    if (windowWidth <= baseWidth) {
        resetPadding();
    }
}

function setNewPadding(newPadding) {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .vidy-sama, .vidy-sama-s, .tarif-ssp, .zavd-sama, .prop-ssp, .why-sama, .vidhuki, .faq, .prosdod, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        var computedStyle = getComputedStyle(div);
        var paddingTop = computedStyle.paddingTop;
        var paddingBottom = computedStyle.paddingBottom;
        div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
}

function resetPadding() {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .vidy-sama, .vidy-sama-s, .tarif-ssp, .zavd-sama, .prop-ssp, .why-sama, .vidhuki, .faq, .prosdod, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        div.style.padding = "";
    });
}

function reinitializeSlickSliders() {
    $('.slick-slider').each(function(){
        var $slider = $(this);
        var sliderId = $slider.attr('id'); // Получаем id слайдера
        if ($slider.hasClass('slick-initialized')) {
            sliderSettings[sliderId] = $slider[0].slick.options; // Сохраняем настройки слайдера
            $slider.slick('unslick'); // Удаляем слайдер
        }
        $slider.slick(sliderSettings[sliderId]); // Переинициализируем слайдер с сохраненными настройками
    });
}

window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(setPadding, 500);
});

window.addEventListener('load', setPadding);
</script>


    <?php
    $h3_min_height = get_field('css-min-height');
    if( $h3_min_height ):
?>
        <style>
            @media (min-width: 768px) { 
                .tarif h3 {
                    min-height: <?php echo $h3_min_height; ?>px;
                }
            }
        </style>
<?php 
    endif;
?>