<?php
/*
Template Name: Головна
*/
?>
<?php get_header(); ?>
<?php 
    $current_lang = ICL_LANGUAGE_CODE;
   ?>
<div class="first-scr">
  <div class="f-text1">
    <a href="<?php the_field('fraza1url'); ?>" class="f-1"><?php
                                                            $my_textarea = get_field('fraza_slajderu1');
                                                            if ($my_textarea) {
                                                              echo $my_textarea;
                                                            }
                                                            ?>
    </a>
    <a href="<?php the_field('fraza2url'); ?>" class="f-2"><?php
                                                            $my_textarea = get_field('fraza_slajderu2');
                                                            if ($my_textarea) {
                                                              echo $my_textarea;
                                                            }
                                                            ?>
    </a>
  </div>
  <div class="f-text2">
    <a href="<?php the_field('fraza3url'); ?>" class="f-3"><?php
                                                            $my_textarea = get_field('fraza_slajderu3');
                                                            if ($my_textarea) {
                                                              echo $my_textarea;
                                                            }
                                                            ?>
    </a>
    <a href="<?php the_field('fraza4url'); ?>" class="f-4"><?php
                                                            $my_textarea = get_field('fraza_slajderu4');
                                                            if ($my_textarea) {
                                                              echo $my_textarea;
                                                            }
                                                            ?>
    </a>
  </div>
  <div class="f-text3">
    <?php
    $image = get_field('zobrazhennya-home'); // Получение массива изображения из ACF

    if (!empty($image)) {
      $image_url = $image['url']; // URL изображения
      $image_alt = $image['alt']; // Альтернативный текст

      // Вывод изображения с URL и альтернативным текстом
      echo '<img class="bjola1" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
    }
    ?>
    <img class="str1" src="/wp-content/uploads/2023/03/strelka1.svg">
    <a href="<?php the_field('fraza5url'); ?>" class="f-5">
      <?php
      $my_textarea = get_field('fraza_slajderu5');
      if ($my_textarea) {
        echo $my_textarea;
      }
      ?>
    </a>
  </div>
  <div class="f-text4">
    <h5 class="text4f"><?php the_field('tekstdop_dlya_slajderu_home'); ?></h5>
    <div class="btn-first-nor">
      <?php
      $data_id = 1;
      if ('en' == $current_lang) {
        $data_id = 3;
      } elseif ('ru' == $current_lang) {
        $data_id = 2;
      }
      ?>
      <button class="btn-mfirst" data-form-id="<?php echo $data_id; ?>" data-form-name="first-scr" href="<?php the_field('posylannya_knopky_slajdera_home'); ?>"><?php the_field('tekst_knopky_slajderu_home'); ?>
      </button>
    </div>
  </div>
  <div class="f-text5">
    <div class="f-text5-l"></div>
    <div class="f-text5-r"><a class="h-email" href="mailto:<?php the_field('email_slajderu_home'); ?>"><?php the_field('email_slajderu_home'); ?></a>
      <a class="h-phone" href="tel:<?php the_field('tel_slajderu_home'); ?>"><?php the_field('tel_slajderu_home'); ?></a>
    </div>
  </div>
</div>
<div class="scscr">
  <h1 class="h1hol"><?php the_field('h1_golovnoyi'); ?></h1>
  <p class="psc"><?php the_field('tekst_pid_h1'); ?></p>
  <div class="sliderf">
    <?php if (have_rows('poslugy')) : ?>
      <?php while (have_rows('poslugy')) : the_row(); ?>
        <div class="slidef" onclick="window.location.href='<?php the_sub_field('url_na_poslugu_home'); ?>';">
          <h2><?php the_sub_field('h2nazva_poslugy_home'); ?></h2>
          <p><?php the_sub_field('opis_poslugy_home'); ?></p>
          <a href="<?php the_sub_field('url_na_poslugu_home'); ?>"><img loading="lazy" class="strelkasc" src="/wp-content/uploads/2023/03/strelkaw.svg"></a>

        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>

<div class="trih">
  <h2 class="trih-h2"><?php the_field('h2_yakmi'); ?></h2>
  <p class="trih-p"><?php the_field('opys_yak_my'); ?></p>
  <section id="blocks-pc">
    <div class="container">
      <div class="row">
        <div class="col-md-1-1">
          <div class="block-content2">
            <div class="trih-zag">
              <p class="trih-num">2.</p>
            </div>
            <div>
              <h4 class="trih-h4"><?php the_field('2_yakmi'); ?></h4>
              <p class="trih-p2"><?php the_field('2_yakmi_opis'); ?></p>
            </div>
          </div>
          <div class="block-content4">
            <div class="trih-zag">
              <p class="trih-num">4.</p>
            </div>
            <div>
              <h4 class="trih-h4"><?php the_field('4_yakmi'); ?></h4>
              <p class="trih-p2"><?php the_field('4_yakmi_opis'); ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-1-2">
          <img loading="lazy" src="/wp-content/uploads/2023/08/howwew.svg" alt="">
        </div>
        <div class="col-md-1-1">
          <div class="block-content1">
            <div class="trih-zag">
              <p class="trih-num">1.</p>
            </div>
            <div>
              <h4 class="trih-h4"><?php the_field('1_yakmi'); ?></h4>
              <p class="trih-p2"><?php the_field('1_yakmi_opis'); ?></p>
            </div>
          </div>
          <div class="block-content3">
            <div class="trih-zag">
              <p class="trih-num">3.</p>
            </div>
            <div>
              <h4 class="trih-h4"><?php the_field('3_yakmi'); ?></h4>
              <p class="trih-p2"><?php the_field('3_yakmi_opis'); ?></p>
            </div>
          </div>
          <div class="block-content5">
            <div class="trih-zag">
              <p class="trih-num">5.</p>
            </div>
            <div>
              <h4 class="trih-h4"><?php the_field('5_yakmi'); ?></h4>
              <p class="trih-p2"><?php the_field('5_yakmi_opis'); ?></p>
            </div>
          </div>
        </div>
        <?php
        $data_id = 4;
        if ('en' == $current_lang) {
          $data_id = 6;
        } elseif ('ru' == $current_lang) {
          $data_id = 5;
        }
        ?>
        <a class="cta-b" data-form-id="<?php echo $data_id;?>" href="#" data-form-name="blocks-pc-main-page">
          <?php echo __('Contact us', 'idol'); ?>
        </a>

      </div>
    </div>
  </section>
  <section id="blocks-mob">
    <div class="container">
      <div class="row">
        <div class="mob-col-md-1-2">
          <img loading="lazy" src="/wp-content/uploads/2023/08/howwewmob.svg" alt="">
        </div>
        <div class="mob-col-md-1-1">
          <div class="block-content1">
            <div class="trih-zag">
              <p class="trih-num">1.</p>
            </div>
            <div>
              <h4 class="trih-h4"><?php the_field('1_yakmi'); ?></h4>
              <p class="trih-p2"><?php the_field('2_yakmi_opis'); ?></p>
            </div>
          </div>
          <div class="block-content2">
            <div class="trih-zag">
              <p class="trih-num">2.</p>
            </div>
            <div>
              <h4 class="trih-h4"><?php the_field('2_yakmi'); ?></h4>
              <p class="trih-p2"><?php the_field('2_yakmi_opis'); ?></p>
            </div>
          </div>
          <div class="block-content3">
            <div class="trih-zag">
              <p class="trih-num">3.</p>
            </div>
            <div>
              <h4 class="trih-h4"><?php the_field('3_yakmi'); ?></h4>
              <p class="trih-p2"><?php the_field('2_yakmi_opis'); ?></p>
            </div>
          </div>
          <div class="block-content4">
            <div class="trih-zag">
              <p class="trih-num">4.</p>
            </div>
            <div>
              <h4 class="trih-h4"><?php the_field('4_yakmi'); ?></h4>
              <p class="trih-p2"><?php the_field('2_yakmi_opis'); ?></p>
            </div>
          </div>
          <div class="block-content5">
            <div class="trih-zag">
              <p class="trih-num">5.</p>
            </div>
            <div>
              <h4 class="trih-h4"><?php the_field('5_yakmi'); ?></h4>
              <p class="trih-p2"><?php the_field('2_yakmi_opis'); ?></p>
            </div>
          </div>
        </div>
      </div>
      <?php
      $data_id = 0;
      if ('en' == $current_lang) {
        $data_id = 0;
      } elseif ('ru' == $current_lang) {
        $data_id = 0;
      }
      ?>
      <a data-form-name="how-we-worck" data-form-id="<?php echo 0;?>" class="cta-b" href="#">
        <?php echo __('Contact us', 'idol'); ?>
      </a>
    </div>
  </section>
</div>
<div class="case_h">
  <h2 class="case-h2"><?php the_field('h2_keisy'); ?></h2>
  <p class="case-p"><?php the_field('opys_keisy'); ?></p>
  <div class="slider-container">
    <div class="slider1">
      <?php if (have_rows('keisy')) : ?>
        <?php while (have_rows('keisy')) : the_row();
          $image = get_sub_field('img_kejsu_h'); // Получаем массив изображения
          $image_url = $image['url']; // URL изображения
          $image_alt = $image['alt']; ?>
          <div class="slide1">
            <div class="container">
              <div class="row">
                <div class="col-md-2-1">
                  <img loading="lazy" class="case-img" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                </div>
                <div class="col-md-2-2">
                  <a class="case-cat" href="<?php the_sub_field('posylannya_tegukategoriyi_kejsu_h'); ?>">#<?php the_sub_field('tegkategoriya_kejsu_h'); ?></a>
                  <h3><a class="case-h3" href="<?php the_sub_field('posylannya_na_kejs_h'); ?>"><?php the_sub_field('zagolovok_kejsu_h'); ?></a></h3>
                  <p class="klient"><?php _e('Сlient:', 'lanetclick'); ?> "<?php the_sub_field('kliyent_kejsu_h'); ?>".</p>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="btn-case1">
    <a class="btn-case" href="<?php the_field('link_knopky_kejsu_h'); ?>"><?php the_field('tekst_knopky_kejsu_h'); ?></a>
  </div>
</div>
<div class="pro-nas">
  <h2 class="pronas-h2"><?php the_field('h2_pronas'); ?></h2>
  <p class="pronas-p"><?php the_field('opys_pro_nas'); ?></p>
  <img loading="lazy" class="pronas-imgs-pc" src="<?php the_field('honeycombs_main'); ?>">
  <img loading="lazy" class="pronas-imgs-m" src="<?php the_field('soty-pri-mob'); ?>">
  <div class="sert-pc">
    <?php
    $images = get_field('sertyfikaczii');
    if ($images) : ?>
      <ul>
        <?php foreach ($images as $image) : ?>
          <li>
            <img loading="lazy" src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                           <p><?php echo esc_html($image['caption']); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
  <div class="sert-m">
    <?php
    $images = get_field('sertyfikaczii');
    if ($images) : ?>
      <div class="slidersert">
        <?php foreach ($images as $image) : ?>
          <div class="slidesert">
            <img loading="lazy" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<div class="vidhuki">
  <h2 class="case-h2"><?php the_field('h2_vidguki'); ?></h2>
  <p class="vidhuk-p"><?php the_field('vidguki_opis'); ?></p>
  <div class="slider-container3">
    <img loading="lazy" class="mnogog" src="/wp-content/uploads/2023/03/mnogogr.svg">
    <div class="slider3">
      <?php if (have_rows('vidguk')) : ?>
        <?php while (have_rows('vidguk')) : the_row(); ?>
          <div class="slide3">
            <img loading="lazy" class="lapki" src="/wp-content/uploads/2023/03/lapki.svg">
            <div class="stars"><img loading="lazy" class="rating" src="<?php the_sub_field('rejtyng'); ?>" alt=""></div>
            <p class="vidguk-t"><?php the_sub_field('vidguk_text'); ?></p>
            <p class="consumer"><?php the_sub_field('avtor_vidguku'); ?></p>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="namdov">
    <h2 class="case-h2"><?php the_field('h2_namdovirjaut'); ?></h2>
    <p class="namdov-p"><?php the_field('opys_namdovirjaut'); ?></p>
    <?php
    $images = get_field('zobrazhennya_brendiv');
    if ($images) : ?>
      <div class="slider4">
        <?php foreach ($images as $image) : ?>
          <div class="slide4">
            <img loading="lazy" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<div class="team">
  <h2 class="pronas-h2"><?php the_field('h2_komanda'); ?></h2>
  <div class="slider-container5">
    <div class="slider5">
      <?php if (have_rows('komanda')) : ?>
        <?php while (have_rows('komanda')) : the_row();
          $image = get_sub_field('foto_komanda');
          $image_url = $image['url'];
          $image_alt = $image['alt'];
        ?>
          <div class="slide5">
            <div class="komanda-container">
              <img loading="lazy" class="komanda-img" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
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
        <?php
      $data_id = 4;
      if ('en' == $current_lang) {
        $data_id = 6;
      } elseif ('ru' == $current_lang) {
        $data_id = 5;
      }
      ?>
        <a class="cta-b" data-form-name="cta" data-form-id="<?php echo $data_id;?>">
          <?php the_field('tekst_na_knopczi_sta'); ?>
        </a>
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

<?php get_footer(); ?>

<script type="text/javascript">
  // Получаем все ссылки
  const links = document.querySelectorAll('.f-1, .f-2, .f-3, .f-4, .f-5');

  // Получаем элемент h5
  const h5 = document.querySelector('.text4f');

  // Функция для изменения содержимого элемента h5
  function changeH5Content(event) {
    // Определяем ссылку, на которую наведен курсор мыши
    const link = event.target;

    // Определяем новое содержимое в зависимости от класса ссылки
    let newContent;
    if (link.classList.contains('f-1')) {
      newContent = '<?php the_field('tekstdop_dlya_slajderu_home_seo'); ?>';
    } else if (link.classList.contains('f-2')) {
      newContent = '<?php the_field('tekstdop_dlya_slajderu_home_pref'); ?>';
    } else if (link.classList.contains('f-3')) {
      newContent = '<?php the_field('tekstdop_dlya_slajderu_home_ppc'); ?>';
    } else if (link.classList.contains('f-4')) {
      newContent = '<?php the_field('tekstdop_dlya_slajderu_home_smm'); ?>';
    } else if (link.classList.contains('f-5')) {
      newContent = '<?php the_field('tekstdop_dlya_slajderu_home_targ'); ?>';
    }

    // Меняем содержимое элемента h5
    h5.textContent = newContent;
  }

  // Функция для возврата элемента h5 в первоначальное состояние
  function resetH5Content() {
    h5.textContent = '<?php the_field('tekstdop_dlya_slajderu_home'); ?>';
  }

  // Добавляем обработчик события на наведение мыши для каждой ссылки
  links.forEach(link => {
    link.addEventListener('mouseover', changeH5Content);
    link.addEventListener('mouseout', resetH5Content);
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    // Инициализация Slick Slider
    $('.sliderf').slick({
      dots: true,
      arrows: false,
      vertical: false,
      centerMode: false,
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplaySpeed: 3000,
      autoplay: true,
      infinite: false,
      adaptiveHeight: true,
      variableWidth: false,
      responsive: [{
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    });

    $('.slider3').slick({
      dots: true,
      vertical: false,
      centerMode: false,
      arrows: false,
      infinite: true,
      adaptiveHeight: true,
      autoplaySpeed: 3000,
      autoplay: true,
      variableWidth: true,
      slidesToShow: 2,
      slidesToScroll: 1,
      responsive: [{
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }

      ]
    });
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
    $('.slidersert').slick({
      dots: true,
      vertical: false,
      centerMode: false,
      arrows: false,
      autoplay: true,
      infinite: false,
      adaptiveHeight: true,
      variableWidth: true,
      autoplaySpeed: 3000,
      slidesToShow: 2,
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
<script>
  jQuery(document).ready(function() {
    jQuery('.slider1').slick({
      dots: true,
      arrows: false,
      autoplay: false,
      infinite: false,
      autoplaySpeed: 3000,
      adaptiveHeight: false,
      variableWidth: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [{
          breakpoint: 1439,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  });
</script>
<script>
  function setPadding() {
    var basePadding = 55;
    var baseWidth = 1440;
    var targetPadding = 680;
    var targetWidth = 2800;

    var windowWidth = window.innerWidth;
    // Если размер окна меньше базовой ширины, ничего не делаем
    if (windowWidth <= baseWidth) {
      return;
    }

    var newPadding;
    if (windowWidth <= baseWidth) {
      newPadding = basePadding;
    } else if (windowWidth >= targetWidth) {
      newPadding = targetPadding;
    } else {
      var widthRatio = (windowWidth - baseWidth) / (targetWidth - baseWidth);
      newPadding = basePadding + widthRatio * (targetPadding - basePadding);
    }

    var scscrDivs = document.querySelectorAll('.scscr');
    scscrDivs.forEach(function(div) {
      var computedStyle = getComputedStyle(div);
      var paddingTop = computedStyle.paddingTop;
      var paddingBottom = computedStyle.paddingBottom;
      div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
  }

  window.addEventListener('resize', setPadding);
  window.addEventListener('load', setPadding);
</script>
<script>
  var resizeTimer;
  var baseWidth = 1440;
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
    reinitializeSlickSliders();

    if (windowWidth <= baseWidth) {
      resetPadding();
    }
  }

  function setNewPadding(newPadding) {
    var sspDivs = document.querySelectorAll('.trih, .case_h, .pro-nas, .vidhuki, .team, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
      var computedStyle = getComputedStyle(div);
      var paddingTop = computedStyle.paddingTop;
      var paddingBottom = computedStyle.paddingBottom;
      div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
  }

  function resetPadding() {
    var sspDivs = document.querySelectorAll('.trih, .case_h, .pro-nas, .vidhuki, .team, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
      div.style.padding = "";
    });
  }

  function reinitializeSlickSliders() {
    $('.slick-slider').each(function() {
      var $slider = $(this);
      var sliderId = $slider.attr('id'); // Получаем id слайдера
      if ($slider.hasClass('slick-initialized')) {
        sliderSettings[sliderId] = $slider[0].slick.options; // Сохраняем настройки слайдера
        $slider.slick('unslick'); // Удаляем слайдер
      }
      $slider.slick(sliderSettings[sliderId]); // Переинициализируем слайдер с сохраненными настройками
    });
  }

  function updateSlickTrackWidth() {
    $('.slick-slider').each(function() {
      var $slider = $(this);
      var $slickTrack = $slider.find('.slick-track');
      var windowWidth = $(window).width();

      // Устанавливаем ширину slick-track в процентном соотношении от ширины окна
      // Здесь 100% - это пример, вы можете установить другое значение в зависимости от ваших потребностей
      $slickTrack.css('width', '100%');

      // Обновляем позицию слайдов после изменения ширины slick-track
      $slider.slick('setPosition');
    });
  }

  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      setPadding();
      updateSlickTrackWidth(); // Вызываем функцию после изменения размера окна
    }, 500);
  });

  window.addEventListener('load', function() {
    setPadding();
    updateSlickTrackWidth(); // Вызываем функцию при загрузке страницы
  });
</script>
<script>
  $(window).on("load", function() {
    $('.slider4').slick({
      dots: true,
      vertical: false,
      centerMode: false,
      arrows: false,
      autoplay: false,
      infinite: true,
      adaptiveHeight: true,
      variableWidth: true,
      autoplaySpeed: 3000,
      slidesToShow: 5,
      slidesToScroll: 2,
      responsive: [{
        breakpoint: 768,
        settings: {
          centerMode: true,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    });

    handleSliderVisibility();
  });

  function handleSliderVisibility() {
    const slider = $('.slider4')[0];

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          $('.slider4').slick('slickSetOption', 'autoplay', true, true);
          $('.slider4').slick('slickPlay');
        } else {
          $('.slider4').slick('slickSetOption', 'autoplay', false, true);
          $('.slider4').slick('slickPause');
        }
      });
    }, {
      threshold: 0.1
    });

    observer.observe(slider);
  }
</script>