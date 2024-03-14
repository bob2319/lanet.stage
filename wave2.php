<?php  
/*
Template Name: Seo-audit, media-ads
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
        <div class="btn-first-nor"><button class="btn-first cta-b" data-form-name="first-scr-sama"><?php the_field('tekst_knopky_sli_ssp'); ?></button></div>
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
            <button class="btn-first masthev-b cta-b" data-form-name="masthave-ssp"><?php the_field('btn_poslugy_sn'); ?></button>
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
<script>
    $(document).ready(function() {
  $('.col-md-7-1').each(function() {
    var $etapNam = $(this).find('.etap-nam');
    if ($etapNam.text().trim() === '') {
      $(this).hide();
    }
  });
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

<div class="tarif-sn">
    <h2 class="tarif-h2"><?php the_field('zagolovok_tsina'); ?></h2>
    <div class="container">
    <div class="row">
        <?php if (have_rows('czina_tsina')) : ?>
            <?php while (have_rows('czina_tsina')) : the_row(); ?>
                <div class="col-md-12-sn">
                    <?php if (get_sub_field('top_taryf') == 'yes') : ?>
                        <img loading="lazy" class="top-tarif-i" src="<?php _e( '/wp-content/uploads/2023/10/top-def.svg', 'lanetclick' ); ?>" alt="">
                    <?php endif; ?>
                    <div class="tarif">
                        <h3><?php the_sub_field('nazva_taryfu_tsina'); ?></h3>
                        <div class="services row">
                            <?php
                            $counter = 0;
                            $services = [];
                            if (have_rows('poslugy_shho_vhodyat_tsina')):
                                while (have_rows('poslugy_shho_vhodyat_tsina')): the_row();
                                    $services[] = '<span>'.strip_tags(get_sub_field('mitka_posluha_tsina')).'</span> '.strip_tags(get_sub_field('posluga_tsina'));
                                    $counter++;
                                endwhile;

                                $cols = array_chunk($services, ceil($counter / 3));

                                foreach ($cols as $i => $col) {
                                    echo '<div class="service-col">';
                                    foreach ($col as $j => $service) {
                                        echo '<div class="service">'.$service.'</div>';
                                    }
                                    echo '</div>';
                                }

                            endif;
                            ?>
                        </div>
                        <div class="description"><?php the_sub_field('tekst_dodatkovyj_tsina'); ?></div>
                        <span class="details-toggle" style="display:none;"><?php _e( 'More', 'lanetclick' ); ?></span>
                        <div class="price"><?php the_sub_field('vartist_tsina'); ?></div>
                        <div style="text-align:center"><a class="order-btn cta-b" data-form-name="tarif-sn"><?php _e( 'Order', 'lanetclick' ); ?></a></div>
                        <span class="hide-toggle" style="display:none;"><?php _e( 'Hide', 'lanetclick' ); ?></span>
                    </div>
                </div>
                <?php break; // this will stop the loop after the first tarif ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
</div>

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

<div class="prop-ssp">
<h2 class="prop-h2"><?php the_field('zagolovok_prop_ssp'); ?></h2>
<p class="prop-p"><?php the_field('pidzagolovok_prop_ssp'); ?></p>
<div class="slider-container">
    <div class="slider8">
  <?php if ( have_rows('slide_prop_ssp') ) : ?>
    <?php while ( have_rows('slide_prop_ssp') ) : the_row(); ?>
 <div class="slide8" data-show-image="true">      
        <img loading="lazy" class="prop-img" src="<?php the_sub_field('ikonka_sli_ssp'); ?>" alt="">
            <h3><a class="prop-h3" href="<?php the_sub_field('link_sli_prosp_ssp'); ?>"><?php the_sub_field('tekst_sli_prosp_ssp'); ?></a></h3> 
     </div>
<?php endwhile; ?>
  <?php endif; ?> 
        </div>
</div>  
        </div>
<div class="mob-only">
<div class="prop-ssp">
    <h2 class="prop-h2"><?php the_field('zagolovok_prop_ssp'); ?></h2>
    <p class="prop-p"><?php the_field('pidzagolovok_prop_ssp'); ?></p>
    <div class="swiper-container prop-m">
        <div class="swiper-wrapper">
            <?php if (have_rows('slide_prop_ssp')) : ?>
                <?php while (have_rows('slide_prop_ssp')) : the_row(); ?>
                    <div class="swiper-slide">
                        <img loading="lazy" class="prop-img" src="<?php the_sub_field('ikonka_sli_ssp'); ?>" alt="">
                        <h3><a class="prop-h3" href="<?php the_sub_field('link_sli_prosp_ssp'); ?>"><?php the_sub_field('tekst_sli_prosp_ssp'); ?></a></h3>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <!-- Add Pagination -->
        <div class="tar-pagination"></div>
        </div>
</div>
    </div>
<script defer>
    jQuery(document).ready(function($) {
        var mySwiper = new Swiper('.prop-m', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            slidesPerView: 2, // Display only one slide at a time
            spaceBetween: 10,  // No space between slides
            centeredSlides: false,
            

            // If we need pagination
            pagination: {
                el: '.tar-pagination',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
        // Обработка клика на hide-toggle
    document.querySelectorAll('.hide-toggle').forEach(function(button) {
        button.addEventListener('click', function() {
            var tarifContainer = this.closest('.tarif');
            tarifContainer.classList.add('details-cl');
            // Другие действия при закрытии
        });
    });
    // Обработка клика на details-toggle
    document.querySelectorAll('.details-toggle').forEach(function(button) {
        button.addEventListener('click', function() {
            var tarifContainer = this.closest('.tarif');
            tarifContainer.classList.remove('details-cl');
            // Другие действия при открытии
        });
    });
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
                <p class="cta-o"><?php the_field('opys_cta'); ?></p>
                <a class="cta-b"><?php the_field('tekst_na_knopczi_sta'); ?></a>
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
      $(this).hide();
    }
  });
});
</script>
<script>
    $(document).ready(function() {
  $('.faq').each(function() {
    var $h2 = $(this).find('h2');
    if ($h2.text().trim() === '') {
      $(this).hide();
    }
  });
});
</script>
<script>
    var originalSlider, tableSlider;

function checkAndConvertSlider() {
  var windowWidth = $(window).width();

  if (windowWidth > 1024) { // Проверка, является ли устройство десктопом
    var slides = $('.slider8 .slide8');
    var slidesCount = slides.length; // Получение количества слайдов

    if (slidesCount >= 6) {
        return; // Если слайдов 6 или больше, прекращаем выполнение функции
    } else if (slidesCount < 6) { // Проверка, меньше ли количества слайдов, чем 6
      if (!originalSlider) {
        originalSlider = $('.slider8').clone(); // сохраняем оригинальное содержимое слайдера
      }
      if (!tableSlider) {
        tableSlider = $('<div></div>').addClass('slider8-table'); // Создание контейнера
        slides.each(function(index, slide) {
          var cell = $(slide).clone().addClass('slide8tab'); // Добавление нового класса к слайду
          tableSlider.append(cell); // Добавление слайда в контейнер
        });
        tableSlider.insertAfter('.slider8'); // Добавление таблицы после слайдера
        tableSlider.css({
          display: 'flex',
          justifyContent: 'center', 
          alignItems: 'center'
        }); // Центрирование контейнера
      }
      $('.slider8').hide(); // Скрываем слайдер
      $('.slider8-table').show(); // Показываем таблицу
    }
  } else {
    if (!$('.slider8').hasClass('slick-initialized')) { // Проверка, инициализирован ли слайдер
      $('.slider8').slick();
    }
    $('.slider8').show(); // Показываем слайдер
    if (tableSlider) $('.slider8-table').hide(); // Скрываем таблицу
  }
}

$(document).ready(checkAndConvertSlider);
$(window).resize(checkAndConvertSlider);
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
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .vidy-sama, .vidy-sama-s, .tarif-sn, .zavd-sama, .prop-ssp, .why-sama, .vidhuki, .faq, .prosdod, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        var computedStyle = getComputedStyle(div);
        var paddingTop = computedStyle.paddingTop;
        var paddingBottom = computedStyle.paddingBottom;
        div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
}

function resetPadding() {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .vidy-sama, .vidy-sama-s, .tarif-sn, .zavd-sama, .prop-ssp, .why-sama, .vidhuki, .faq, .prosdod, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceItems = document.querySelectorAll('.service');
    const detailsToggle = document.querySelector('.details-toggle');
    const hideToggle = document.querySelector('.hide-toggle');
    const tarif = document.querySelector('.tarif');

    function updateServiceItems() {
        if (window.innerWidth <= 767) {
            detailsToggle.style.display = 'flex';
            Array.from(serviceItems).forEach((item, i) => {
                if (i >= 5) {
                    item.style.display = 'none';
                }
            });
        } else {
            detailsToggle.style.display = 'none';
            Array.from(serviceItems).forEach((item, i) => {
                item.style.display = 'flex';
            });
        }
    }

    updateServiceItems();

    window.addEventListener('resize', updateServiceItems);

    detailsToggle.addEventListener('click', function() {
        Array.from(serviceItems).forEach(item => {
            item.style.display = 'flex';
        });
        tarif.classList.add('expanded');
        this.style.display = 'none';
        hideToggle.style.display = 'block';
    });

    hideToggle.addEventListener('click', function() {
        Array.from(serviceItems).forEach((item, i) => {
            if (window.innerWidth <= 767 && i >= 5) {
                item.style.display = 'none';
            }
        });
        tarif.classList.remove('expanded');
        this.style.display = 'none';
        detailsToggle.style.display = 'block';
    });
});
</script>