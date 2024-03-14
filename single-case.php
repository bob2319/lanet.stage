<?php  
/*
Template Name: Single-case
*/
?>
<?php get_header(); ?>
<div class="first-scr-case">
    <h1><?php the_field('zags_ks'); ?></h1>
    <p class="caseh1pz"><?php the_field('korotkyj_opys_kejsu'); ?></p>
    <?php
$tags = get_the_tags();
if ( $tags ) : ?>
    <p>
        <a href="#" class="case-cat" data-tag="<?php echo $tags[0]->slug; ?>">
            #<?php echo $tags[0]->name; ?>
        </a>
    </p>
<?php endif; ?>
    </div>

<div class="scscr-ks" >
<div class="bread">
    <img id="homebread" src="/wp-content/uploads/2023/04/bread.svg">
<?php if( function_exists( 'aioseo_breadcrumbs' ) ) aioseo_breadcrumbs(); ?>
    </div>
    </div>
<div class="vhidni">
    <div class="container">
    <div class="row">
        <div class="col-ks-1">
            <div class="zag-ks"><?php the_field('zag1_ks'); ?></div>
            <p><?php the_field('pzag1_ks'); ?></p>
        </div>
        <div class="col-ks-2">
			<?php 
$image = get_field('imgzag1_ks'); // Получение массива изображения из ACF

if (!empty($image)) {
    $image_url = $image['url']; // URL изображения
    $image_alt = $image['alt']; // Альтернативный текст

    // Вывод изображения с URL и альтернативным текстом
    echo '<img loading="lazy" class="ks_img-1" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
}
?>
</div>
    </div>
    </div>
</div>
<div class="zavdannya">
    <div class="zag-ks"><?php the_field('zag_za_ks'); ?></div>
    
    <?php
$zavd_ks = get_field('zavd_ks');

$count = (is_array($zavd_ks) || $zavd_ks instanceof Countable) ? count($zavd_ks) : 0;

if( have_rows('zavd_ks') ):
    echo '<div class="k-sli" data-slidecount="' . $count . '">';
    while ( have_rows('zavd_ks') ) : the_row();
        $t_zavd_ks = get_sub_field('t_zavd_ks');
        if( $t_zavd_ks ): ?>
            <div class="k-slide">
                <div class="slide-cks">
                    <div class="sot-kscore"><img loading="lazy" class="sot-ks" src="/wp-content/uploads/2023/07/sota-ksu.svg" alt=""></div>
                    <div class="t_zavd_ks"><?php echo $t_zavd_ks; ?></div>
                </div>
            </div>
        <?php endif;
    endwhile;
    echo '</div>';
endif;
?>
</div>
<script>
    jQuery(document).ready(function($){

    // Инициализация слайдера
    function initSlider() {
        var slideCount = $('.k-sli').data('slidecount');

        // Проверка на наличие данных в слайдере
        if (slideCount === 0 || slideCount === undefined) {
            return; // Остановить выполнение, если данных нет
        }

        var showDotsDesktop = slideCount >= 4;
        var showDotsMobile = true;

        $('.k-sli').slick({
            dots: showDotsDesktop,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: showDotsDesktop
                    }
                },
                {
                    breakpoint: 976,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        dots: showDotsMobile
                    }
                },
                {
                    breakpoint: 770,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: showDotsMobile
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: showDotsMobile
                    }
                }
            ]
        });
    }

    // Инициализируйте слайдер при загрузке страницы
    initSlider();

    // Обновите слайдер при изменении размера окна
    $(window).on('resize', function() {
        $('.k-sli').slick('refresh');
    });
});
</script>

<div class="perelik">
  <div class="zag-ks"><?php the_field('zag2_ks'); ?></div>
  <p><?php the_field('pzag2_ks'); ?></p>
  
  <?php if( have_rows('roboty_ks') ): ?>
    <div class="swiper-per">
      <div class="swiper-wrapper">
      
        <?php while( have_rows('roboty_ks') ): the_row(); ?>
          <div class="swiper-slide swiper-per-s">
            <div class="slide-content-v">
              <div class="czyfra_rks"><?php the_sub_field('czyfra_rks'); ?></div>
              <div class="separator">/</div>
              <div class="opys_rks"><?php the_sub_field('opys_rks'); ?></div>
            </div>
          </div>
        <?php endwhile; ?>
       
      </div>
      <!-- Add Pagination -->
       <div class="tar-pagination"></div>
    </div>
  <?php endif; ?>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
  setTimeout(function() {
    let swiper = new Swiper('.swiper-per', {
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
<div class="results">
    <div class="zag-ks"><?php the_field('zag3_ks'); ?></div>
    <p><?php the_field('pzag3_ks'); ?></p>
    <?php if( have_rows('rezultat_ks') ): ?>

    <?php 
    $i = 0; // инициализация счетчика
    while( have_rows('rezultat_ks') ): the_row(); 

        // извлечение полей
        $img_rezul_ks = get_sub_field('img_rezul_ks');
        $zag_rezul_ks = get_sub_field('zag_rezul_ks');
        $opys_rezul_ks = get_sub_field('opys_rezul_ks');
    ?>

    <div class="custom-row">
        <?php if($i % 2 == 0) { // для нечетных итераций выводим сначала изображение, затем текст ?>
            <div class="custom-col1">
                <?php echo '<img loading="lazy" src="' . $img_rezul_ks . '" alt="some alt text">'; ?>
            </div>
            <div class="custom-col2">
                <?php echo '<div class="rez-zag">' . $zag_rezul_ks . '</div>'; ?>
                <?php echo '<p>' . $opys_rezul_ks . '</p>'; ?>
            </div>
        <?php } else { // для четных итераций выводим сначала текст, затем изображение ?>
            <div class="custom-col2">
                <?php echo '<div class="rez-zag">' . $zag_rezul_ks . '</div>'; ?>
                <?php echo '<p>' . $opys_rezul_ks . '</p>'; ?>
            </div>
            <div class="custom-col1">
                <?php echo '<img loading="lazy" src="' . $img_rezul_ks . '" alt="some alt text">'; ?>
            </div>
        <?php } ?>
    </div>

    <?php
        $i++; // увеличиваем счетчик
    endwhile; 
    ?>

<?php endif; ?>
</div>
<div class="results-m">
    <div class="zag-ks"><?php the_field('zag3_ks'); ?></div>
    <div class="swiper-resul">
    <div class="swiper-wrapper">
        <?php if (have_rows('rezultat_ks')): ?>
            <?php while (have_rows('rezultat_ks')): the_row(); ?>
                <div class="swiper-slide">
                    <img loading="lazy" src="<?php the_sub_field('img_rezul_ks'); ?>" alt="">
                    <p class="rez-zag"><?php the_sub_field('zag_rezul_ks'); ?></p>
                    <p><?php the_sub_field('opys_rezul_ks'); ?></p>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <!-- Add Pagination -->
    <div class="tar-pagination"></div>
</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
  setTimeout(function() {
    let swiper = new Swiper('.swiper-resul', {
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
<?php 
$zag4_ks = get_field('zag4_ks');
$vysnov_ks = get_field('vysnov_ks');

// Проверка наличия заполненных полей
if (!empty($zag4_ks) || !empty($vysnov_ks)): ?>

<div class="vysnovok">
    <div class="zag-ksv"><?php echo $zag4_ks; ?></div>
    
    <?php
    $count = count($vysnov_ks); // Добавлено для подсчета количества слайдов
    
    if (have_rows('vysnov_ks')): ?>
        <!-- Swiper container -->
        <div class="swiper-vys k-slis" data-slidecount="<?php echo $count; ?>" >
            <div class="swiper-wrapper">
                <?php while (have_rows('vysnov_ks')): the_row();
                    $opys_visn_ks = get_sub_field('opys_visn_ks');
                    if ($opys_visn_ks): ?>
                        <div class="swiper-slide ks-slide">
                            <div class="slide-ckv">
                                <div class="sot-kscorev"><img loading="lazy" class="sot-ksv" src="/wp-content/uploads/2023/07/sota-w-ksu.svg" alt=""></div>
                                <div class="opys-visn-ks"><?php echo $opys_visn_ks; ?></div>
                            </div>
                        </div>
                    <?php endif;
                endwhile; ?>
            </div>
            <div class="tar-pagination"></div>
        </div>
    <?php endif; ?>
</div>
<?php endif; ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const slideContainer = document.querySelector('.swiper-vys');
  const slideCount = parseInt(slideContainer.getAttribute('data-slidecount'), 10);
  let slidesToShow;

  if (slideCount <= 4) {
    slidesToShow = slideCount;
  } else {
    slidesToShow = 4;
  }

  let swiper = new Swiper('.swiper-vys', {
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
<div class="propositon">
    <h3><?php the_field('zag_ks_b'); ?></h3>
     <div class="row">
         <div class="col-sa-2">
            <img loading="lazy" class="sama-why-img" src="<?php the_field('bzhola_ks'); ?>" alt="">
             <img loading="lazy" class="sama-why-img-m" src="<?php the_field('bzhola_ks_m'); ?>" alt="">
         </div>
         <div class="col-sa-3">
             <div class="why-sama_bl">
             <p><?php the_field('pzag_ks_b'); ?></p>
            <a class="btn-firststat cta-b" data-form-name="proposition"><?php the_field('btn_ks_b'); ?></a>
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
    var sspDivs = document.querySelectorAll('.first-scr-case, .scscr-ks, .vhidni, .zavdannya, .perelik, .results, .vysnovok, .propositon, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        var computedStyle = getComputedStyle(div);
        var paddingTop = computedStyle.paddingTop;
        var paddingBottom = computedStyle.paddingBottom;
        div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
}

function resetPadding() {
    var sspDivs = document.querySelectorAll('.first-scr-case, .scscr-ks, .vhidni, .zavdannya, .perelik, .results, .vysnovok, .propositon, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
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
<script>
    $(document).ready(function() {
  $('.vhidni').each(function() {
    var $etapNam = $(this).find('.zag-ks');
    if ($etapNam.text().trim() === '') {
      $(this).hide();
    }
  });
});
</script>

<script>
    $(document).ready(function() {
  $('.vysnovok').each(function() {
    var $etapNam = $(this).find('.zag-ksv');
    
    // Проверка наличия элемента и его содержимого
    if ($etapNam.length === 0 || $etapNam.text().trim() === '') {
      $(this).hide();
    }
  });
});
</script>
<script>
    $(document).ready(function() {
  $('.perelik').each(function() {
    var $etapNam = $(this).find('.zag-ks');
    
    // Проверка наличия элемента и его содержимого
    if ($etapNam.length === 0 || $etapNam.text().trim() === '') {
      $(this).hide();
    }
  });
});
</script>
<script>
    $(document).ready(function() {
  $('.zavdannya').each(function() {
    var $etapNam = $(this).find('.zag-ks');
    if ($etapNam.text().trim() === '') {
      $(this).hide();
    }
  });
});
</script>
<style>
    .aioseo-breadcrumb:last-child{display:flex;margin-top: 10px;}
    </style>
<?php get_footer(); ?>