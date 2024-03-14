<!DOCTYPE html>
<html dir="ltr" lang="<?php echo icl_t('lanetclick', 'page_lang', 'en-US'); ?>" prefix="og: https://ogp.me/ns#">

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="Content-type" content="text/html; charset=<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="format-detection" content="telephone=no">
  <link rel="preload" href="/wp-content/themes/lanetclick/css/reset.css" as="style" onload="this.rel='stylesheet'">
  <!---<link rel="stylesheet" type="text/css" media="all" href="/wp-content/themes/lanetclick/css/reset.css" />-->
  <!--<link rel="stylesheet" type="text/css" href="/wp-content/themes/lanetclick/style-min.css"/ media="all" type="text/css"/>-->
  <link rel="preload" href="/wp-content/themes/lanetclick/style-min.css" as="style" media="all" onload="this.rel='stylesheet'">
  <link rel="preload" href="/wp-content/themes/lanetclick/css/slick.css" as="style" onload="this.rel='stylesheet'">
  <!--<link rel="stylesheet" href="/wp-content/themes/lanetclick/css/responsive-min.css" media="all" type="text/css"/>-->
  <link rel="preload" href="/wp-content/themes/lanetclick/css/responsive-min.css" as="style" media="(max-width: 1800px)" onload="this.rel='stylesheet'">
  <link rel="preload" href="<?php echo get_template_directory_uri()?>/css/responsive-style.css" as="style" onload="this.rel='stylesheet'">
  <link rel="preload" href="/wp-content/themes/lanetclick/css/slick-theme.css" as="style" onload="this.rel='stylesheet'">
  <link rel="preload" href="/wp-content/themes/lanetclick/css/swiper-bundle.min.css" as="style" onload="this.rel='stylesheet'">
  <!--<link rel="stylesheet" type="text/css" href="/wp-content/themes/lanetclick/css/slick-theme.css"/>-->
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>
<!-- Последняя версия jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Последняя версия Cleave.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>

  <script src="/wp-content/themes/lanetclick/js/swiper-bundle.min.js"></script>
  <script defer type="text/javascript" src="/wp-content/themes/lanetclick/js/slick.min.js"></script>
  <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- Ваш HTML-файл -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script defer type="text/javascript" src="/wp-content/themes/lanetclick/js/my-script.js"></script>

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-P9SRHJM');
  </script>
  <!-- End Google Tag Manager -->
  <?php if (is_page('blog') || is_category()) : ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <?php endif; ?>
  <?php 
    $current_lang = ICL_LANGUAGE_CODE;
   ?>
</head>

<body data-lang="<?php echo $current_lang;?>" <?php body_class(); ?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P9SRHJM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <?php if (is_page('blog')) : ?>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <?php endif; ?>

  <div class="wrapper">
    <div id="page">
      <!-- Шапка -->
      <header>
        <div class='container'>
          <div class="logo-wrapp">
            <div class="logo">
              <?php if (is_front_page() || is_home()) : ?>
                <img src="/wp-content/uploads/2023/03/logo-blue-1.svg" alt="Logo">
              <?php else : ?>
                <a href="<?php echo home_url(); ?>">
                  <img src="/wp-content/uploads/2023/03/logo-blue-1.svg" alt="Logo">
                </a>
              <?php endif; ?>
            </div>
          </div>
          <div class='header-right-content'>
            <div class="menu-wrapper">
              <?php //if (!is_front_page()) : 
              ?>
              <div class="dop-menu">
                <ul>
                  <li><a href="<?php the_field('link_1_p_head_d', 'options'); ?>">
                      <?php the_field('1_p_head_d', 'options'); ?>
                    </a></li>
                  <li><a href="<?php the_field('link_2_p_head_d', 'options'); ?>">
                      <?php the_field('2_p_head_d', 'options'); ?>
                    </a></li>
                  <li><a href="<?php the_field('link_3_p_head_d', 'options'); ?>">
                      <?php the_field('3_p_head_d', 'options'); ?>
                    </a></li>
                  <li><a href="<?php the_field('link_4_p_head_d', 'options'); ?>">
                      <?php the_field('4_p_head_d', 'options'); ?>
                    </a></li>
                </ul>
              </div>
              <?php //endif; 
              ?>
            </div>
                <?php
                  $data_id = 10;
                  if( 'en' == $current_lang ){
                    $data_id = 11;
                  }
                  elseif( 'ru' == $current_lang ){
                    $data_id = 12;
                  }
                ?>
            <div class="header-btn-wrapper">
              <span data-form-ID="<?php echo $data_id;?>" data-form-name='header-right-content' class='header-btn'>
                <p>
                  <?php echo __('Get audit', 'idol'); ?>
                </p>
                <i class='phone-icon'></i>
              </span>
              <a id="menu">
                <img class="m-menu-bt" src="/wp-content/uploads/2024/01/m-menu.svg">
              </a>
            </div>
          </div>
          <div id="popup-menu">
            <div class="popup-menu-content">
              <div class="l1-bntsm">
                <div class="popup-menu-language">
                  <!-- Переключатель языка WPML -->
                  <?php do_action('wpml_language_switcher'); ?>
                </div>
                <div class="btn-back"><button class="popup-menu-close-btn" id="close-popup">
                    <?php _e('BACK', 'lanetclick'); ?>
                  </button></div>
              </div>
              <div class="popup-menu-navigation1">
                <?php
                // Выводим оба меню
                wp_nav_menu(
                  array(
                    'theme_location' => 'mobile-menu',
                    'container' => 'nav',
                    'container_class' => 'mobile-menu',
                  )
                );

                wp_nav_menu(
                  array(
                    'theme_location' => 'main-menu',
                    'container' => 'div',
                    'container_class' => 'menu-mm',
                    'container_id' => '',
                    'menu_class' => 'menu-m',
                    'menu_id' => '',
                  )
                );
                ?>
              </div>
              <script>
                document.addEventListener("DOMContentLoaded", function() {
                  const popup = document.getElementById("popup-menu");
                  const openPopup = document.getElementById("menu");
                  const closePopup = document.getElementById("close-popup");

                  openPopup.addEventListener("click", function() {
                    popup.style.display = "block";
                    document.body.style.overflow = "hidden";
                  });

                  closePopup.addEventListener("click", function() {
                    popup.style.display = "none";
                    document.body.style.overflow = "";
                  });
                });
              </script>
              <script>
                jQuery(document).ready(function($) {
                  // Функция для изменения текста кнопки
                  function changeButtonText() {
                    if ($(window).width() <= 1360) { // Проверяем ширину экрана меньше или равно 1360 пикселей
                      $('.popup-menu-close-btn').text(''); // Заменяем текст кнопки на пустую строку
                    } else {
                      $('.popup-menu-close-btn').text('<?php _e('BACK', 'lanetclick'); ?>'); // Возвращаем исходный текст кнопки (если нужно)
                    }
                  }

                  // Вызываем функцию при загрузке страницы
                  changeButtonText();

                  // Вызываем функцию при изменении размера окна
                  $(window).resize(function() {
                    changeButtonText();
                  });
                });
              </script>
              <script>
                jQuery(document).ready(function($) {
                  $('.mobile-menu').find('li:has(ul)').addClass('has-submenu');
                  $('.has-submenu > a').on('click', function(e) {
                    e.preventDefault();

                    var $this = $(this);
                    var $parent = $this.parent();
                    var $siblings = $parent.siblings();

                    if ($this.next().hasClass('sub-menu')) {
                      $siblings.hide();
                      $parent.addClass('current');
                      $this.hide(); // Скрываем нажатый пункт меню
                      $this.next().show();
                      $('<li><a class="back-button" href="#"><?php _e('Back', 'lanetclick'); ?></a></li>').prependTo($this.next()); // Добавляем кнопку "Назад"
                    }
                  });

                  $('body').on('click', '.back-button', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var $current = $this.closest('.current');
                    var $siblings = $current.siblings();

                    $this.parent().remove(); // Удаляем кнопку "Назад"
                    $current.removeClass('current');
                    $current.children('.sub-menu').hide();
                    $current.children('a').show(); // Показываем нажатый пункт меню
                    $siblings.show();
                  });
                });
              </script>
              <script>
                const menuItems = document.querySelectorAll('.menu-item-has-children');

                menuItems.forEach(item => {
                  const link = item.querySelector('a');
                  const observer = new MutationObserver(mutations => {
                    mutations.forEach(mutation => {
                      if (mutation.attributeName === 'style' && mutation.target.getAttribute('style') === 'display: none;') {
                        item.classList.add('hidden-before');
                      } else if (mutation.attributeName === 'style' && mutation.target.getAttribute('style') !== 'display: none;') {
                        item.classList.remove('hidden-before');
                        link.classList.add('has-arrow'); // добавляем класс для ссылки
                      }
                    });
                  });

                  observer.observe(link, {
                    attributes: true
                  });
                });
              </script>

              <div class="popup-menu-navigation2">
                <div class="popup-menu-contact">
                  <a class="email-mh">lanetclick@lanet.ua</a>
                  <a href="tel:+380442251900">+38 (044) 225-19-00</a>
                </div>
              </div>
            </div>

            <script>
              // Получаем ссылки на элементы
              const menuBtn = document.getElementById('menu');
              const popupMenu = document.getElementById('popup-menu');
              const closeBtn = document.querySelector('.popup-menu-close-btn');

              // Добавляем обработчик событий на клик по кнопке "Меню"
              menuBtn.addEventListener('click', () => {
                // Открываем поп-ап меню
                popupMenu.style.display = 'block';
              });

              // Добавляем обработчик событий на клик по кнопке "Назад"
              closeBtn.addEventListener('click', () => {
                // Закрываем поп-ап меню
                popupMenu.style.display = 'none';
              });
            </script>
            <script>
              $(document).ready(function() {
                // Создаем контейнер m4-mm-c
                var $container = $('<li class="m4-mm-c"></li>');

                // Находим все li элементы с классом m4-mm
                var $m4mmElements = $('ul.menu-m li.m4-mm');

                // Перемещаем li с классом m4-mm в контейнер m4-mm-c
                $m4mmElements.appendTo($container);

                // Находим ul.menu
                var $menu = $('ul.menu-m');

                // Добавляем пустой li в конце меню с классом menu-m
                var $emptyLi = $('<li class="empty"></li>');
                $menu.append($emptyLi);

                // Находим последний li в меню с классом menu-m
                var $lastLi = $menu.find('li.empty');

                // Вставляем контейнер m4-mm-c перед последним li
                $container.insertBefore($lastLi);
              });
            </script>
          </div>
        </div>
      </header>