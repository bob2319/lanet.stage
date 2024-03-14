<?php  
/*
Template Name: Contacts
*/
?>
<?php get_header(); ?>
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
	</div>

<div class="scscr-ssp" >
<div class="bread">
	<img id="homebread" src="/wp-content/uploads/2023/04/bread.svg">
<?php if( function_exists( 'aioseo_breadcrumbs' ) ) aioseo_breadcrumbs(); ?>
	</div>
	</div>

<div class="contact-m">
	<h1><?php the_field('h1kon'); ?></h1>
	<p class="conth1p"><?php the_field('opys_pid_1_h1k'); ?></p>
	<div class="row my1bl">
		<div class="col-my-1">
			<div class="cont-data">
			<p class="contafp"><?php the_field('adresa_kont'); ?></p></div>
		</div>
		<div class="col-my-5">
            <?php 
$image = get_field('zobrazhennya_bzj'); // Получение массива изображения из ACF

if (!empty($image)) {
    $image_url = $image['url']; // URL изображения
    $image_alt = $image['alt']; // Альтернативный текст

    // Вывод изображения с URL и альтернативным текстом
    echo '<img loading="lazy" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
}
?>
			</div>
	</div>
</div>

<div class="team-k">
	<div class="slider-container-t">
	<div class="slider-t">
  <?php if ( have_rows('komanda') ) : ?>
    <?php while ( have_rows('komanda') ) : the_row(); ?>
		<div class="slide-t">
			<div class="komanda-container">
			<img loading="lazy" class="komanda-img" src="<?php the_sub_field('foto_komanda'); ?>" alt="">
		<p class="imya-k"><?php the_sub_field('imya_komanda'); ?></p>
		<p class="posada-k"><?php the_sub_field('posada_komanda'); ?></p>
				<a class="email-k" href="mailto:<?php the_sub_field('email_kom'); ?>"><?php the_sub_field('email_kom'); ?></a>
			</div></div>
<?php endwhile; ?>
  <?php endif; ?> 
</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    // Инициализация Slick Slider
     $('.slider-t').slick({
        dots: true,
        vertical: false,
        centerMode: false,
		arrows : false,
		autoplay: true,
		infinite: true,
		adaptiveHeight: true,
		variableWidth: true,
  		autoplaySpeed: 3000,
        slidesToShow: 2,
        slidesToScroll: 1,
		responsive: [
			{
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
			},
			{
          breakpoint: 500,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
			}
			]
      });
});
	
</script>
<style>
	.contact-f{display:none;}
</style>
<div class="contact-fk">
	<div class="container">
		<div class="row-f">
			<div class="col-md-4-2k">
				<div class="cont-kh2"><?php the_field('futer_zagolovok_k'); ?></div>
				<div class="kon-for">
				<?php echo do_shortcode( '[contact-form-7 id="600" title="Контактна форма 1"]' ); ?>
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
    let form = document.querySelector('.contact-fk .wpcf7-form');
	
	if (form) {
        form.addEventListener('focusin', function(e) {
            if (!formInteracted) {
                formInteracted = true; // Устанавливаем флаг в true

                // Получаем ID и имя формы из скрытых полей
                let formId = form.querySelector('input[name="form_id"]').value || 'unknown';
                let formName = form.querySelector('input[name="form_name"]').value || 'unknown';

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
                    errorElement.textContent = '<?php _e("Required field", "lanetclick");?>';
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
                        phoneErrorElement.textContent = '<?php _e("Wrong phone number", "lanetclick");?>';
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
                        errorElement.textContent = '<?php _e("There was a sending error", "lanetclick");?>';
                    }
                }
            };

            xhr.send(formData);

            let formId = form.querySelector('input[name="form_id"]').value || 'unknown';
            let formName = form.querySelector('input[name="form_name"]').value || 'unknown';
            let emailValue = emailField ? emailField.value : 'unknown';
            let phoneValue = form.querySelector('input[type="tel"]').value || 'unknown';

            window.dataLayer.push({
                'event': 'form_submit',
                'form_id': formId,
                'email': emailValue,
                'phone': phoneValue
            });
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
            errorElement.textContent = '<?php _e("Wrong email", "lanetclick");?>';
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
		<span class="close-btn"><?php _e('Close', 'lanetclick');?></span>
		<div class="h1pptnx"><?php the_field('h1pptnx', 'options'); ?></div>
		<p class="ppptnx"><?php the_field('p_hopup_tnx', 'options'); ?></p>
			</div>
</div></div>
			<div class="col-md-4-1k">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2540.043142022199!2d30.36001263876189!3d50.45892131207455!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cdfb30df01f1%3A0xc62819ecad1391e5!2z0JvQsNC90LXRgiBDTElDSyDigJMgZGlnaXRhbC3QsNCz0LXQvdGC0YHRgtCy0L4!5e0!3m2!1sru!2sua!4v1689151018916!5m2!1sru!2sua" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
			
		</div>
	</div>
</div>
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
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .contact-m, .team-k,  .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        var computedStyle = getComputedStyle(div);
        var paddingTop = computedStyle.paddingTop;
        var paddingBottom = computedStyle.paddingBottom;
        div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
}

function resetPadding() {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .contact-m, .team-k, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
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