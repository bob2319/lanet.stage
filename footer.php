<!--FOOTER-->
<?php
/**
 * The template for displaying the footer.
 *
 * @package lanetclic
 */
?>
<footer>
    <div class="contact-f">
        <div class="container">
            <div class="row-f">
                <div class="col-md-4-1">
                    <div class="cont-fh2"><?php the_field('h2_footer', 'options'); ?></div>
                    <?php if (have_rows('info_footer', 'options')) : ?>
                        <?php while (have_rows('info_footer', 'options')) : the_row(); ?>
                            <div class="h4-f"><?php the_sub_field('h4_footer', 'options'); ?></div>
                            <p class="op-f"><?php the_sub_field('opys_h4_footer', 'options'); ?></p>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-4-2">
                    <div class="h3-bf"><?php the_field('h3_beforeform', 'options'); ?></div>
                    <?php echo do_shortcode('[contact-form-7 id="600" title="Контактна форма 1"]'); ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var urlParams = new URLSearchParams(window.location.search);
                            var formIdFromUrl = urlParams.get('form_id');
                            if (formIdFromUrl) {
                                var hiddenField = document.querySelector('input[name="form_id"]');
                                if (hiddenField) {
                                    hiddenField.value = formIdFromUrl;
                                }
                            }
                            // Закрываем попап
                            document.querySelectorAll('.close-btn').forEach(function(closeBtn) {
                                closeBtn.addEventListener('click', function() {
                                    document.querySelector('#popup-formf').style.display = 'none';
                                });
                            });
                            let formInteracted = false;
                            let form = document.querySelector('.contact-f .wpcf7-form');

                            if (form) {
                                form.addEventListener('focusin', function(e) {
                                    if (!formInteracted) {
                                        formInteracted = true; // Устанавливаем флаг в true

                                        // Получаем ID и имя формы из скрытых полей
                                        let formId = form.querySelector('input[name="form_id"]').value || 'unknown';
                                        let formName = form.querySelector('input[name="form_name"]').value || 'unknown';
                                        console.log('test1');
                                        console.log(formId);
                                        // Отправляем данные в dataLayer
                                        window.dataLayer.push({
                                            'event': 'form_start',
                                            'form_id': formId,
                                            'form_name': formName
                                        });
                                    }
                                });

                                form.addEventListener('submit', function(e) {
                                    e.preventDefault();

                                    // Перед отправкой AJAX-запроса
                                    document.getElementById("loading-indicator").style.display = "flex";

                                    document.querySelectorAll('.wpcf7-not-valid-tip').forEach(function(element) {
                                        element.remove();
                                    });

                                    let isValid = true;
                                    document.querySelectorAll('.wpcf7-validates-as-required').forEach(function(input) {
                                        if (!input.value) {
                                            isValid = false;
                                            let errorElement = document.createElement('span');
                                            errorElement.className = 'wpcf7-not-valid-tip';
                                            errorElement.textContent = '<?php _e("Required field", "lanetclick"); ?>';
                                            input.parentNode.appendChild(errorElement);
                                        }
                                    });

                                    // Валидация и AJAX для телефона
                                    let phoneField = form.querySelector('input[type="tel"]');
                                    let phoneValue = phoneField ? phoneField.value.replace(/\D/g, '') : '';
                                    let phoneErrorElement = phoneField ? phoneField.nextElementSibling : null;

                                    let xhrPhoneValidation = new XMLHttpRequest();
                                    xhrPhoneValidation.open('POST', ajax_url, true);
                                    xhrPhoneValidation.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                                    xhrPhoneValidation.onreadystatechange = function() {
                                        if (xhrPhoneValidation.readyState === 4 && xhrPhoneValidation.status === 200) {
                                            // Скрываем индикатор загрузки
                                            document.getElementById("loading-indicator").style.display = "none";
                                            let response = JSON.parse(xhrPhoneValidation.responseText);
                                            if (response.isValid) {
                                                // Phone is valid
                                            } else {
                                                if (!phoneErrorElement) {
                                                    phoneErrorElement = document.createElement('span');
                                                    phoneErrorElement.className = 'wpcf7-not-valid-tip';
                                                    if (phoneField) {
                                                        phoneField.parentNode.appendChild(phoneErrorElement);
                                                    }
                                                }
                                                phoneErrorElement.textContent = '<?php _e("Wrong phone number", "lanetclick"); ?>';
                                            }
                                        }
                                    };
                                    xhrPhoneValidation.send(`action=validate_phone&phone=${phoneValue}&nonce=${ajax_nonce}`);

                                    // Валидация и AJAX для email
                                    let emailField = form.querySelector('input[type="email"]');
                                    let emailValue = emailField ? emailField.value : '';
                                    let errorElement = emailField ? emailField.nextElementSibling : null;

                                    let xhrValidation = new XMLHttpRequest();
                                    xhrValidation.open('POST', ajax_url, true);
                                    xhrValidation.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                                    xhrValidation.onreadystatechange = function() {
                                        if (xhrValidation.readyState === 4 && xhrValidation.status === 200) {
                                            document.getElementById("loading-indicator").style.display = "none";
                                            let response = JSON.parse(xhrValidation.responseText);
                                            if (response.isValid) {
                                                // Валидация и AJAX для телефона
                                                let phoneField = form.querySelector('input[type="tel"]');
                                                let phoneValue = phoneField ? phoneField.value.replace(/\D/g, '') : '';
                                                let phoneErrorElement = phoneField ? phoneField.nextElementSibling : null;

                                                let xhrPhoneValidation = new XMLHttpRequest();
                                                xhrPhoneValidation.open('POST', ajax_url, true);
                                                xhrPhoneValidation.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                                                xhrPhoneValidation.onreadystatechange = function() {
                                                    if (xhrPhoneValidation.readyState === 4 && xhrPhoneValidation.status === 200) {
                                                        // Скрываем индикатор загрузки
                                                        document.getElementById("loading-indicator").style.display = "none";
                                                        let response = JSON.parse(xhrPhoneValidation.responseText);
                                                        if (response.isValid) {
                                                            // Phone is valid

                                                            // Ваш код для успешной отправки формы
                                                            // Показываем индикатор загрузки перед отправкой формы
                                                            document.getElementById("loading-indicator").style.display = "flex";
                                                            let formData = new FormData(form);
                                                            let xhr = new XMLHttpRequest();
                                                            xhr.open('POST', form.action, true);

                                                            xhr.onreadystatechange = function() {
                                                                if (xhr.readyState === 4 && xhr.status === 200) {
                                                                    document.getElementById("loading-indicator").style.display = "none";
                                                                    document.querySelector('#popup-formf').style.display = 'block';
                                                                    document.querySelector('#popup-formf .popup-content-tnxf').style.display = 'block';
                                                                } else if (xhr.readyState === 4 && xhr.status !== 200) {
                                                                    if (errorElement) {
                                                                        errorElement.textContent = '<?php _e("There was a sending error", "lanetclick"); ?>';
                                                                    }
                                                                }
                                                            };

                                                            xhr.send(formData);

                                                            let formId = form.querySelector('input[name="form_id"]').value || 'unknown';
                                                            let formName = form.querySelector('input[name="form_name"]').value || 'unknown';
                                                            let emailValue = emailField ? emailField.value : 'unknown';
                                                            let phoneValue = form.querySelector('input[type="tel"]').value || 'unknown';
                                                            console.log('1');
                                                            window.dataLayer.push({
                                                                'event': 'form_submit',
                                                                'form_id': formId,
                                                                'email': emailValue,
                                                                'phone': phoneValue,
                                                                'form_name': formName
                                                            });
                                                            // Отображаем индикатор загрузки
                                                            document.getElementById("loading-indicator").style.display = "flex";
                                                        } else {
                                                            if (!phoneErrorElement) {
                                                                phoneErrorElement = document.createElement('span');
                                                                phoneErrorElement.className = 'wpcf7-not-valid-tip';
                                                                if (phoneField) {
                                                                    phoneField.parentNode.appendChild(phoneErrorElement);
                                                                }
                                                            }
                                                            phoneErrorElement.textContent = '<?php _e("Wrong phone number", "lanetclick"); ?>';
                                                        }
                                                    }
                                                };
                                                xhrPhoneValidation.send(`action=validate_phone&phone=${phoneValue}&nonce=${ajax_nonce}`);
                                            } else {
                                                // Если email не валиден, показываем сообщение об ошибке
                                                document.getElementById("loading-indicator").style.display = "none";
                                                if (!errorElement) {
                                                    errorElement = document.createElement('span');
                                                    errorElement.className = 'wpcf7-not-valid-tip';
                                                    if (emailField) {
                                                        emailField.parentNode.appendChild(errorElement);
                                                    }
                                                }
                                                errorElement.textContent = '<?php _e("Wrong email", "lanetclick"); ?>';
                                            }
                                        }
                                    };
                                    xhrValidation.send('action=validate_email&email=' + emailValue + '&nonce=' + ajax_nonce);
                                });
                            }
                        });
                    </script>
                </div>
                <div id="popup-formf" class="popup">
                    <div class="popup-content-tnxf" style="display: none;">
                        <span class="close-btn"><?php _e('Close', 'lanetclick'); ?></span>
                        <div class="h1pptnx"><?php the_field('h1pptnx', 'options'); ?></div>
                        <p class="ppptnx"><?php the_field('p_hopup_tnx', 'options'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="cont-s">
            <div class="container">
                <div class="row-f">
                    <div class="col-md-5-1">
                        <div class="logo">
                            <?php if (is_front_page() || is_home()) : ?>
                                <img loading="lazy" src="/wp-content/uploads/2023/03/logo-bl.svg" alt="Logo">
                            <?php else : ?>
                                <a href="<?php echo home_url(); ?>">
                                    <img loading="lazy" src="/wp-content/uploads/2023/03/logo-bl.svg" alt="Logo">
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-5-1">
                        <?php if (have_rows('soczmerezhi_footer', 'options')) : ?>
                            <?php while (have_rows('soczmerezhi_footer', 'options')) : the_row(); ?>
                                <a rel="nofollow" href="<?php the_sub_field('link_soc_footer', 'options'); ?>"><img loading="lazy" class="soc-f" src="<?php the_sub_field('ikonka', 'options'); ?>"></a>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php wp_nav_menu(array(
            'theme_location'  => 'footer-menu',
            'container'       => 'div',
            'container_class' => 'menu-ff',
            'container_id'    => '',
            'menu_class'      => 'menu-f',
            'menu_id'         => '',
        )); ?>
        <div id="s-menu">
            <div class="s-menu-1">
                <div class="container">
                    <div class="row-f">
                        <div class="col-md-6-1">
                            <nav class="s-m-z"><a href="<?php the_field('zag_col1_url', 'options'); ?>"><?php the_field('zag_col1', 'options'); ?></a></nav>
                            <?php if (have_rows('link_1_blok', 'options')) : ?>
                                <?php while (have_rows('link_1_blok', 'options')) : the_row(); ?>
                                    <nav class="s-m-s"><a href="<?php the_sub_field('link_1_blok', 'options'); ?>"><?php the_sub_field('name_1_blok', 'options'); ?></a></nav>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6-1">
                            <nav class="s-m-z"><a href="<?php the_field('zag_col2_url', 'options'); ?>"><?php the_field('zag_col2', 'options'); ?></a></nav>
                            <?php if (have_rows('link_2_blok', 'options')) : ?>
                                <?php while (have_rows('link_2_blok', 'options')) : the_row(); ?>
                                    <nav class="s-m-s"><a href="<?php the_sub_field('link_2_blok', 'options'); ?>"><?php the_sub_field('name_2_blok', 'options'); ?></a></nav>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6-1">
                            <nav class="s-m-z"><a href="<?php the_field('zag_col3_url', 'options'); ?>"><?php the_field('zag_col3', 'options'); ?></a></nav>
                            <?php if (have_rows('posylannya_tret_kolonky', 'options')) : ?>
                                <?php while (have_rows('posylannya_tret_kolonky', 'options')) : the_row(); ?>
                                    <nav class="s-m-s"><a href="<?php the_sub_field('link_3col', 'options'); ?>"><?php the_sub_field('nazva_link_3col', 'options'); ?></a></nav>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6-1">
                            <nav class="s-m-z"><a href="<?php the_field('zag_col4_url', 'options'); ?>"><?php the_field('zag_col4', 'options'); ?></a></nav>
                            <?php if (have_rows('posylannya_four_kolonky', 'options')) : ?>
                                <?php while (have_rows('posylannya_four_kolonky', 'options')) : the_row(); ?>
                                    <nav class="s-m-s"><a href="<?php the_sub_field('link_4col', 'options'); ?>"><?php the_sub_field('nazva_link_4col', 'options'); ?></a></nav>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="s-menu-2">
                <div class="container">
                    <div class="row-f">
                        <div class="col-md-6-1">
                            <nav class="s-m-z"><a href="<?php the_field('2zag_col1_url', 'options'); ?>"><?php the_field('2zag_col1', 'options'); ?></a></nav>
                            <nav class="s-m-z"><a href="<?php the_field('3zag_col1_url', 'options'); ?>"><?php the_field('3zag_col1', 'options'); ?></a></nav>
                            <nav class="s-m-z"><a href="<?php the_field('4zag_col1_url', 'options'); ?>"><?php the_field('4zag_col1', 'options'); ?></a></nav>
                        </div>
                        <div class="col-md-6-1">
                            <nav class="s-m-z"><a href="<?php the_field('2zag_col2_url', 'options'); ?>"><?php the_field('2zag_col2', 'options'); ?></a></nav>
                            <nav class="s-m-z"><a href="<?php the_field('3zag_col2_url', 'options'); ?>"><?php the_field('3zag_col2', 'options'); ?></a></nav>
                            <nav class="s-m-z"><a href="<?php the_field('4zag_col2_url', 'options'); ?>"><?php the_field('4zag_col2', 'options'); ?></a></nav>
                        </div>
                        <div class="col-md-6-1">
                            <nav class="s-m-z"><a href="<?php the_field('2zag_col3_url', 'options'); ?>"><?php the_field('2zag_col3', 'options'); ?></a></nav>
                            <?php if (have_rows('posylannya_tret_kolonky2', 'options')) : ?>
                                <?php while (have_rows('posylannya_tret_kolonky2', 'options')) : the_row(); ?>
                                    <nav class="s-m-s"><a href="<?php the_sub_field('link_3col2', 'options'); ?>"><?php the_sub_field('nazva_link_3col2', 'options'); ?></a></nav>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button id="show-services-btn"><img loading="lazy" class="op-cl-btn" src="/wp-content/uploads/2023/03/open-btn.svg" alt=""><br><?php _e('All services', 'lanetclick'); ?></button>

        <script>
            window.onload = function() {
                if (window.location.href.substr(-1) !== '/') {
                    history.replaceState(null, null, window.location.href + '/');
                }
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Получаем ссылки на блок и кнопки
                const servicesBlock = document.getElementById('s-menu');
                const showServicesBtn = document.getElementById('show-services-btn');
                const closeServicesBtn = document.createElement('button');
                const closeServicesImg = document.createElement('img');
                const closeServicesText = document.createTextNode('<?php _e('All services', 'lanetclick'); ?>');

                // Функция для установки высоты в зависимости от ширины экрана
                const setInitialHeight = () => {
                    if (window.matchMedia('(max-width: 660px)').matches) {
                        servicesBlock.style.height = '360px';
                    } else if (window.matchMedia('(max-width: 1360px)').matches) {
                        servicesBlock.style.height = '220px';
                    } else {
                        servicesBlock.style.height = '120px';
                    }
                };

                // Устанавливаем начальную высоту
                setInitialHeight();

                // Обработчик изменения размера окна
                window.addEventListener('resize', setInitialHeight);

                // Добавляем обработчик событий на кнопку "Всі послуги"
                showServicesBtn.addEventListener('click', () => {
                    // Показываем скрытый контент
                    servicesBlock.style.height = '100%';

                    // Добавляем кнопку "Закрыть"
                    closeServicesImg.src = '/wp-content/uploads/2023/03/close-btn.svg';
                    closeServicesImg.alt = '<?php _e('All servises', 'lanetclick'); ?>';
                    closeServicesBtn.appendChild(closeServicesImg);
                    closeServicesBtn.appendChild(document.createElement('br'));
                    closeServicesBtn.appendChild(closeServicesText);
                    closeServicesBtn.id = 'close-services-btn';
                    servicesBlock.appendChild(closeServicesBtn);

                    // Скрываем кнопку "Все услуги"
                    showServicesBtn.style.display = 'none';
                });

                // Добавляем обработчик событий на кнопку "Закрыть"
                servicesBlock.addEventListener('click', (event) => {
                    if (event.target.id === 'close-services-btn' || event.target === closeServicesImg || event.target === closeServicesText) {
                        // Возвращаем высоту к начальному значению
                        setInitialHeight();

                        // Удаляем кнопку "Закрыть"
                        servicesBlock.removeChild(closeServicesBtn);

                        // Показываем кнопку "Всі послуги"
                        showServicesBtn.style.display = 'block';
                    }
                });
            });
        </script>
		<script>
   const textareas = document.querySelectorAll('textarea');
	function preventEnterKey(e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      return false;
    }
  }
  textareas.forEach(textarea => {
    textarea.addEventListener('keydown', preventEnterKey);
  });
</script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var tarifs = document.querySelectorAll('.tarif');

                tarifs.forEach(function(tarif) {
                    var detailsToggle = tarif.querySelector('.details-toggle');
                    var hideToggle = tarif.querySelector('.hide-toggle');
                    var tarifImage = tarif.querySelector('.tarif-image');
                    var services = tarif.querySelectorAll('.service');
                    var description = tarif.querySelector('.description');

                    detailsToggle.addEventListener('click', function() {
                        tarif.classList.add('expanded');
                        detailsToggle.style.display = 'none';
                        hideToggle.style.display = 'block';
                        tarifImage.style.display = 'block';
                        description.style.display = 'block';
                        services.forEach(function(service, index) {
                            service.style.display = 'block';
                        });
                    });

                    hideToggle.addEventListener('click', function() {
                        tarif.classList.remove('expanded');
                        detailsToggle.style.display = 'block';
                        hideToggle.style.display = 'none';
                        tarifImage.style.display = 'none';
                        description.style.display = 'none';
                        services.forEach(function(service, index) {
                            if (index < 5) {
                                service.style.display = 'block';
                            } else {
                                service.style.display = 'none';
                            }
                        });
                    });
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var formName;

                // Получаем значение form_id из GET-параметров и устанавливаем его в скрытое поле
                var urlParams = new URLSearchParams(window.location.search);
                var formIdFromUrl = urlParams.get('form_id');
                if (formIdFromUrl) {
                    var hiddenField = document.querySelector('input[name="form_id"]');
                    if (hiddenField) {
                        hiddenField.value = formIdFromUrl;
                    }
                }
                function initPopupForm(buttonClass) {
                    document.querySelectorAll(buttonClass).forEach(function(btn) {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            document.querySelector('#popup-formm .popup-contentm').style.display = 'block';
                            document.querySelector('#popup-formm .popup-content-tnxm').style.display = 'none';
                            document.querySelector('#popup-formm').style.display = 'block';
                            // Получаем значение атрибута data-form-name
                             formName = this.getAttribute('data-form-name') || 'unknown';

                            // Получаем форму для извлечения ID. Убедитесь, что у вас есть доступ к форме отсюда.
                            var form = document.querySelector('#popup-formm');
                            var hiddenField = form.querySelector('input[name="form_id"]');
                            var formId = hiddenField ? hiddenField.value : 'unknown';

                            // Отправляем данные в dataLayer
                            window.dataLayer = window.dataLayer || [];
                            window.dataLayer.push({
                                'event': 'form_start',
                                'form_id': formId,
                                'form_name': formName
                            });
                        });

                    });

                }


                initPopupForm('.btn-mfirst');
                initPopupForm('.header-btn');

                // Закрываем попап
                document.querySelectorAll('.close-btn').forEach(function(closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        document.querySelector('#popup-formm').style.display = 'none';
                    });
                });

                // Получаем форму
                let form = document.querySelector('#popup-formm .wpcf7-form');

                // Обработка отправки формы
                form.addEventListener('submit', function(e) {
                    e.preventDefault();


                    // Перед отправкой AJAX-запроса
                    document.getElementById("loading-indicatorb").style.display = "flex";


                    // Удаление существующих сообщений об ошибках
                    document.querySelectorAll('.wpcf7-not-valid-tip').forEach(function(element) {
                        element.remove();
                    });

                    // Проверка на заполнение обязательных полей
                    let isValid = true;
                    document.querySelectorAll('.wpcf7-validates-as-required').forEach(function(input) {
                        if (!input.value) {
                            isValid = false;
                            let errorElement = document.createElement('span');
                            errorElement.className = 'wpcf7-not-valid-tip';
                            errorElement.textContent = '<?php _e('Required field', 'lanetclick'); ?>';
                            input.parentNode.appendChild(errorElement);
                        }
                    });

                    // Валидация email на сервере
                    let emailField = form.querySelector('input[type="email"]');
                    let emailValue = emailField ? emailField.value : '';
                    let errorElement = emailField.nextElementSibling; // Предполагаем, что элемент для ошибки находится сразу после поля email

                    let xhrValidation = new XMLHttpRequest();
                    xhrValidation.open('POST', ajax_url, true); // ajax_url определен в вашем PHP-коде
                    xhrValidation.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                    xhrValidation.onreadystatechange = function() {
                        if (xhrValidation.readyState === 4 && xhrValidation.status === 200) {
                            document.getElementById("loading-indicatorb").style.display = "none";
                            let response = JSON.parse(xhrValidation.responseText);
                            if (response.isValid) {
                                // Если email валиден, продолжаем с отправкой формы
                                // Валидация телефона на сервере
                                let phoneField = form.querySelector('input[type="tel"]');
                                let phoneValue = phoneField ? phoneField.value.replace(/\D/g, '') : '';
                                let phoneErrorElement = phoneField ? phoneField.nextElementSibling : null;

                                let xhrPhoneValidation = new XMLHttpRequest();
                                xhrPhoneValidation.open('POST', ajax_url, true);
                                xhrPhoneValidation.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                                xhrPhoneValidation.onreadystatechange = function() {
                                    if (xhrPhoneValidation.readyState === 4 && xhrPhoneValidation.status === 200) {
                                        // Скрываем индикатор загрузки
                                        document.getElementById("loading-indicatorb").style.display = "none";
                                        let response = JSON.parse(xhrPhoneValidation.responseText);
                                        console.log('Debug:', response.debug);
                                        if (response.isValid) {
                                            // Если телефон валиден, продолжаем с отправкой формы или другими действиями
                                            let formData = new FormData(form);
                                            let xhr = new XMLHttpRequest();
                                            xhr.open('POST', form.action, true);

                                            xhr.onreadystatechange = function() {
                                                if (xhr.readyState === 4 && xhr.status === 200) {
                                                    // Ваш код для обработки успешной отправки
                                                    // Показываем индикатор загрузки перед отправкой формы
                                                    document.getElementById("loading-indicatorb").style.display = "flex";
                                                    document.querySelector('#popup-formm .popup-contentm').style.display = 'none';
                                                    document.querySelector('#popup-formm .popup-content-tnxm').style.display = 'block';
                                                } else if (xhr.readyState === 4 && xhr.status !== 200) {
                                                    errorElement.textContent = '<?php _e('There was a sending error', 'lanetclick'); ?>';
                                                }
                                            };

                                            xhr.send(formData);
                                            // Получаем ID формы из скрытого поля
                                            var hiddenField = form.querySelector('input[name="form_id"]');
                                            var formId = hiddenField ? hiddenField.value : 'unknown';

                                            // Получаем значения полей email и phone
                                            var emailFieldsent = form.querySelector('input[type="email"]');
                                            var emailValuesent = emailFieldsent ? emailFieldsent.value : 'unknown';

                                            var phoneFieldsent = form.querySelector('input[type="tel"]');
                                            var phoneValuesent = phoneFieldsent ? phoneFieldsent.value : 'unknown';

                                            // Отправляем данные в dataLayer
                                            console.log(formName);
                                            window.dataLayer.push({
                                                'event': 'form_submit',
                                                'form_id': formId,
                                                'form_name': formName,
                                                'email': emailValuesent,
                                                'phone': phoneValuesent
                                            });

                                            // Отображаем индикатор загрузки
                                            document.getElementById("loading-indicatorb").style.display = "flex";
                                        } else {
                                            // Если телефон не валиден, показываем сообщение об ошибке
                                            if (!phoneErrorElement) {
                                                phoneErrorElement = document.createElement('span');
                                                phoneErrorElement.className = 'wpcf7-not-valid-tip';
                                                if (phoneField) {
                                                    phoneField.parentNode.appendChild(phoneErrorElement);
                                                }
                                            }
                                            phoneErrorElement.textContent = '<?php _e('Wrong phone number', 'lanetclick'); ?>';
                                        }
                                    }
                                };
                                xhrPhoneValidation.send(`action=validate_phone&phone=${phoneValue}&nonce=${ajax_nonce}`);
                            } else {
                                // Если email не валиден, показываем сообщение об ошибке
                                document.getElementById("loading-indicatorb").style.display = "none";
                                if (errorElement) {
                                    errorElement.textContent = '<?php _e("Wrong email", "lanetclick"); ?>';
                                } else {
                                    // Создаем новый элемент для сообщения об ошибке, если он не существует
                                    errorElement = document.createElement('span');
                                    errorElement.className = 'wpcf7-not-valid-tip';
                                    errorElement.textContent = '<?php _e("Wrong email", "lanetclick"); ?>';
                                    if (emailField) {
                                        emailField.parentNode.appendChild(errorElement);
                                    }
                                }
                            }
                        }
                    };
                    xhrValidation.send('action=validate_email&email=' + emailValue + '&nonce=' + ajax_nonce); // ajax_nonce определен в вашем PHP-коде
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Находим все кнопки с классом 'order-btn' и 'cta-b'
                let orderButtons = document.querySelectorAll('.order-btn.cta-b');

                // Добавляем событие 'click' на каждую кнопку
                orderButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        // Находим ближайший родительский элемент с классом 'tarif'
                        let closestTarif = button.closest('.tarif');

                        // Если такой элемент найден
                        if (closestTarif) {
                            // Находим внутри него элемент 'h3'
                            let tarifH3 = closestTarif.querySelector('h3');

                            // Если элемент 'h3' найден
                            if (tarifH3) {
                                // Получаем его текст
                                let tarifText = tarifH3.textContent || tarifH3.innerText;

                                // Находим скрытое поле 'comments_add2' в форме
                                let hiddenField = document.querySelector('input[name="comments_add2"]');

                                // Если скрытое поле найдено
                                if (hiddenField) {
                                    // Устанавливаем его значение
                                    hiddenField.value = "Назва обранного тарифу: " + tarifText;
                                }
                            }
                        }
                    });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Получаем значение form_id из GET-параметров и устанавливаем его в скрытое поле
                var urlParams = new URLSearchParams(window.location.search);
                var formIdFromUrl = urlParams.get('form_id');
                if (formIdFromUrl) {
                    var hiddenField = document.querySelector('input[name="form_id"]');
                    if (hiddenField) {
                        hiddenField.value = formIdFromUrl;
                    }
                }
                // Открываем попап при клике на кнопку
                document.querySelectorAll('.cta-b').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();

                        document.querySelector('#popup-form .popup-content').style.display = 'block';
                        document.querySelector('#popup-form .popup-content-tnx').style.display = 'none';
                        document.querySelector('#popup-form').style.display = 'block';
                        // Получаем значение атрибута data-form-name
                        formName = this.getAttribute('data-form-name') || 'unknown';
                        var hiddenFieldopen = form.querySelector('input[name="form_id"]');
                        var formIdopen = hiddenFieldopen ? hiddenFieldopen.value : 'unknown';
                        // Отправляем данные в dataLayer;
                        console.log({
                            'event': 'form_start',
                            'form_id': formIdopen,
                            'form_name': formName
                        });
                        window.dataLayer.push({
                            'event': 'form_start',
                            'form_id': formIdopen,
                            'form_name': formName
                        });
                    });

                });

                // Закрываем попап
                document.querySelectorAll('.close-btn').forEach(function(closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        document.querySelector('#popup-form').style.display = 'none';
                    });
                });

                // Получаем форму
                let form = document.querySelector('.formpp .wpcf7-form');

                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    // Перед отправкой AJAX-запроса
                    document.getElementById("loading-indicatorb1").style.display = "flex";

                    // Удаление существующих сообщений об ошибках
                    document.querySelectorAll('.wpcf7-not-valid-tip').forEach(function(element) {
                        element.remove();
                    });

                    // Проверка на заполнение обязательных полей
                    let isValid = true;
                    document.querySelectorAll('.wpcf7-validates-as-required').forEach(function(input) {
                        if (!input.value) {
                            isValid = false;
                            let errorElement = document.createElement('span');
                            errorElement.className = 'wpcf7-not-valid-tip';
                            errorElement.textContent = '<?php _e('Required field', 'lanetclick'); ?>';
                            input.parentNode.appendChild(errorElement);
                        }
                    });

                    // Валидация email и телефона на сервере
                    let emailField = form.querySelector('input[type="email"]');
                    let emailValue = emailField ? emailField.value : '';
                    let errorElement = emailField.nextElementSibling; // Предполагаем, что элемент для ошибки находится сразу после поля email

                    let xhrValidation = new XMLHttpRequest();
                    xhrValidation.open('POST', ajax_url, true); // ajax_url определен в вашем PHP-коде
                    xhrValidation.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                    xhrValidation.onreadystatechange = function() {
                        if (xhrValidation.readyState === 4 && xhrValidation.status === 200) {
                            // Показываем индикатор загрузки перед отправкой формы
                            document.getElementById("loading-indicatorb1").style.display = "flex";
                            let response = JSON.parse(xhrValidation.responseText);
                            if (response.isValid) {
                                // Если email валиден, продолжаем с отправкой формы
                                // Валидация телефона на сервере
                                let phoneField = form.querySelector('input[type="tel"]');
                                let phoneValue = phoneField ? phoneField.value.replace(/\D/g, '') : '';
                                let phoneErrorElement = phoneField ? phoneField.nextElementSibling : null;

                                let xhrPhoneValidation = new XMLHttpRequest();
                                xhrPhoneValidation.open('POST', ajax_url, true);
                                xhrPhoneValidation.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                                xhrPhoneValidation.onreadystatechange = function() {
                                    if (xhrPhoneValidation.readyState === 4 && xhrPhoneValidation.status === 200) {
                                        // Скрываем индикатор загрузки
                                        document.getElementById("loading-indicatorb1").style.display = "none";
                                        let response = JSON.parse(xhrPhoneValidation.responseText);
                                        console.log('Debug:', response.debug);
                                        if (response.isValid) {
                                            // Если телефон валиден, продолжаем с отправкой формы или другими действиями
                                            let formData = new FormData(form);
                                            let xhr = new XMLHttpRequest();
                                            xhr.open('POST', form.action, true);

                                            xhr.onreadystatechange = function() {
                                                if (xhr.readyState === 4 && xhr.status === 200) {
                                                    // Ваш код для обработки успешной отправки
                                                    // // Показываем индикатор загрузки перед отправкой формы
                                                    document.getElementById("loading-indicators1").style.display = "none";
                                                    document.querySelector('#popup-form .popup-content').style.display = 'none';
                                                    document.querySelector('#popup-form .popup-content-tnx').style.display = 'block';
                                                } else if (xhr.readyState === 4 && xhr.status !== 200) {
                                                    errorElement.textContent = '<?php _e('There was a sending error', 'lanetclick'); ?>';
                                                }
                                            };

                                            xhr.send(formData);
                                            // Получаем ID формы из скрытого поля
                                            var hiddenField = form.querySelector('input[name="form_id"]');
                                            var formId = hiddenField ? hiddenField.value : 'unknown';

                                            // Получаем значения полей email и phone
                                            var emailFieldsent = form.querySelector('input[type="email"]');
                                            var emailValuesent = emailFieldsent ? emailFieldsent.value : 'unknown';

                                            var phoneFieldsent = form.querySelector('input[type="tel"]');
                                            var phoneValuesent = phoneFieldsent ? phoneFieldsent.value : 'unknown';

                                            // Отправляем данные в dataLayer
                                            console.log('3');
                                            window.dataLayer.push({
                                                'event': 'form_submit',
                                                'form_id': formId,
                                                'form_name': formName,
                                                'email': emailValuesent,
                                                'phone': phoneValuesent
                                            });
                                            // Отображаем индикатор загрузки
                                            document.getElementById("loading-indicatorb1").style.display = "flex";
                                        } else {
                                            // Если телефон не валиден, показываем сообщение об ошибке
                                            if (!phoneErrorElement) {
                                                phoneErrorElement = document.createElement('span');
                                                phoneErrorElement.className = 'wpcf7-not-valid-tip';
                                                if (phoneField) {
                                                    phoneField.parentNode.appendChild(phoneErrorElement);
                                                }
                                            }
                                            phoneErrorElement.textContent = '<?php _e('Wrong phone number', 'lanetclick'); ?>';
                                        }
                                    }
                                };
                                xhrPhoneValidation.send(`action=validate_phone&phone=${phoneValue}&nonce=${ajax_nonce}`);
                            } else {
                                // Если email не валиден, показываем сообщение об ошибке
                                document.getElementById("loading-indicatorb1").style.display = "none";
                                if (errorElement) {
                                    errorElement.textContent = '<?php _e("Wrong email", "lanetclick"); ?>';
                                } else {
                                    // Создаем новый элемент для сообщения об ошибке, если он не существует
                                    errorElement = document.createElement('span');
                                    errorElement.className = 'wpcf7-not-valid-tip';
                                    errorElement.textContent = '<?php _e("Wrong email", "lanetclick"); ?>';
                                    if (emailField) {
                                        emailField.parentNode.appendChild(errorElement);
                                    }
                                }
                            }
                        }
                    };
                    xhrValidation.send('action=validate_email&email=' + emailValue + '&nonce=' + ajax_nonce); // ajax_nonce определен в вашем PHP-коде
                });
            });
            // Получение данных из локального хранилища
var utmData = localStorage.getItem('b24_crm_guest_utm');
// Проверка наличия данных
if (utmData) {
    // Парсинг данных из формата JSON
    utmData = JSON.parse(utmData);
    
    console.log(utmData);
    // Создание объекта FormData
    var formData = new FormData();
    formData.append('action', 'handle_utm_ajax');
    formData.append('utm_data', JSON.stringify(utmData));

    // Создание объекта XMLHttpRequest
    var xhr = new XMLHttpRequest();
    
    // Настройка запроса
    xhr.open('POST', '/wp-admin/admin-ajax.php', true);

    // Определение функции обратного вызова для обработки ответа сервера
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Обработка успешного ответа сервера
                var response = JSON.parse(xhr.responseText);
                console.log(response);
            } else {
                console.error('Request failed');
            }
        }
    };

    // Отправка запроса
    xhr.send(formData);
} else {
    console.error('No UTM data found in local storage');
}

        </script>

        <div class="line-f"></div>
        <p class="copywrite"><?php the_field('kopirajt', 'options'); ?></p>
    </div>

</footer>
</div>
</div>
</body>

</html>