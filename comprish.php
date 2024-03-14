<?php  
/*
Template Name: Kompleksni rishennya
*/
?>
<?php get_header(); ?>
<div class="first-scr-ssp">
		<?php 
$image = get_field('ssp_mainimg'); // Получение массива изображения из ACF

if (!empty($image)) {
    $image_url = $image['url']; // URL изображения
    $image_alt = $image['alt']; // Альтернативный текст

    // Вывод изображения с URL и альтернативным текстом
    echo '<img class="smm-h" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
}
?>
    <?php 
$image = get_field('ssp_mainimg_mob'); // Получение массива изображения из ACF

if (!empty($image)) {
    $image_url = $image['url']; // URL изображения
    $image_alt = $image['alt']; // Альтернативный текст

    // Вывод изображения с URL и альтернативным текстом
    echo '<img class="smm-h-m" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
}
?>
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
	<div class="kompl-rish">
		<h3><?php the_field('h3_komp_rish1'); ?></h3>
		<p><?php the_field('z_komp_rish1'); ?></p>
		<div class="slider-komplr">
	<div class="sliderkompr">
  <?php if ( have_rows('chomu_pidhodyt_komp_rish1') ) : ?>
    <?php while ( have_rows('chomu_pidhodyt_komp_rish1') ) : the_row(); ?>
		<div class="slidekompr">
			<div class="komplr-b">
			<p><?php the_sub_field('nomer_slajdu_chomu_pidhodyt_komp_rish1'); ?></p>
		</div>
		<h4 class="komplr-h4"><?php the_sub_field('h4_chomu_pidhodyt_komp_rish1'); ?></h4>
		<p class="komplr-p"><?php the_sub_field('p_chomu_pidhodyt_komp_rish1'); ?></p>	
			</div>
<?php endwhile; ?>
  <?php endif; ?> 
</div>
</div>
	</div>
<div class="scscr-ssp2" >
<h1 class="h1smm"><?php the_field('nazva_poslugy_ssp'); ?></h1>
	<p class="pscp"><?php the_field('opys_poslugy_ssp'); ?></p>
	<?php 
$image = get_field('soty_posl_ssp_pc'); // Получение массива изображения из ACF

if (!empty($image)) {
    $image_url = $image['url']; // URL изображения
    $image_alt = $image['alt']; // Альтернативный текст

    // Вывод изображения с URL и альтернативным текстом
    echo '<img loading="lazy" class="smm-s" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
}
?>
	<div class="slider-mobsmm">
 <?php 
    $images = get_field('soty_posl_ssp');
    if( $images ): ?>
        <div class="sliderssp">
            <?php foreach( $images as $image ): ?>
                <div class="slidessp">
                    <img loading="lazy" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
	</div>
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
	  $('.sliderssp').slick({
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
            slidesToScroll: 1
          }
			}
			]
      });
	  $('.sliderkompr').slick({
        dots: true,
        vertical: false,
        centerMode: false,
		arrows : false,
		  infinite: false,
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
            slidesToScroll: 1
          }
			}
			]
      });
	  });
</script>
<script>
	$(document).ready(function() {
    function initTarifSlider() {
        if ($(window).width() < 3000) {
            if (!$('.tarif-slider-k').hasClass('slick-initialized')) {
                $('.tarif-slider-k').slick({
                    dots: true,
                    infinite: false,
                    slidesToShow: 3,
                    slidesToScroll: 1,
					autoplay: true,
                    adaptiveHeight: true,
                    arrows: false,
					autoplaySpeed: 3000,
					responsive: [
        			{
         		 	breakpoint: 1440,
          			settings: {
				 	slidesToShow: 2,
            		slidesToScroll: 1
          			}
					}
					]
                });
            }
        } else {
            if ($('.tarif-slider-k').hasClass('slick-initialized')) {
                $('.tarif-sliderk-').slick('unslick');
            }
        }
    }

    initTarifSlider();
    $(window).on('resize', function() {
        initTarifSlider();
    });
		$('.details-toggle').on('click', function() {
        const tarif = $(this).closest('.tarif-k');
        tarif.find('.description').slideToggle(250, function() {
            if ($('.tarif-slider-k').hasClass('slick-initialized')) {
                $('.tarif-slider-k').slick('setHeight');
            }
        });
        tarif.find('.hide-toggle').toggle();
        $(this).toggle();
    });

    $('.hide-toggle').on('click', function() {
        const tarif = $(this).closest('.tarif-k');
        tarif.find('.description').slideToggle(250, function() {
            if ($('.tarif-slider-k').hasClass('slick-initialized')) {
                $('.tarif-slider-k').slick('setHeight');
            }
        });
        tarif.find('.details-toggle').toggle();
        $(this).toggle();
    });
});
</script>

<div class="tarif-ssp">
	<h2 class="tarif-h2"><?php the_field('zagolovok_tsina'); ?></h2>
	<div class="container">
    <div class="row tarif-slider-k">
        <?php if (have_rows('czina_tsina')) : ?>
            <?php while (have_rows('czina_tsina')) : the_row(); ?>
                <div class="col-md-4">
					<?php if (get_sub_field('top_taryf') == 'yes') : ?>
                            <img loading="lazy" class="top-tarif-i" src="<?php _e( '/wp-content/uploads/2023/10/top-def.svg', 'lanetclick' ); ?>" alt="">
                        <?php endif; ?>
                    <div class="tarif-k">
						<div class="subnab">
							<div class="sub-nab"><?php the_sub_field('dop_tekst_bilya_soty_kompl'); ?></div>
							<img loading="lazy" class="tarif-image-v" src="/wp-content/uploads/2023/03/sotahov.svg" alt="">
						</div>
                        <h3><?php the_sub_field('nazva_taryfu_tsina'); ?></h3>
                        <img loading="lazy" class="tarif-image" src="/wp-content/uploads/2023/03/sotahov.svg" alt="" style="display:none;">
                        <div class="services">
                            <?php
                            $counter = 0;
                            if (have_rows('poslugy_shho_vhodyat_tsina')):
                                while (have_rows('poslugy_shho_vhodyat_tsina')): the_row();
                                    $is_visible = $counter < 9 ? '' : ' style="display:none;"';
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
                        <div class="description"><?php the_sub_field('tekst_dodatkovyj_tsina'); ?></div>
						<div class="price"><?php the_sub_field('vartist_tsina'); ?></div>
                        <div class="o-b-kompl" style="margin-top: auto;"><a class="k-order-btn cta-b" data-form-name="tarif-ssp"><?php _e('Order', 'lanetclick');?></a></div>
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
        <div class="swiper-container tarif-slider556">
            <div class="swiper-wrapper">
                <?php if (have_rows('czina_tsina')) : ?>
                    <?php while (have_rows('czina_tsina')) : the_row(); ?>
                        <div class="swiper-slide">
                            <div class="col-md-455">
                                <?php if (get_sub_field('top_taryf') == 'yes') : ?>
                                    <img loading="lazy" class="top-tarif-i" src="<?php _e( '/wp-content/uploads/2023/10/top-def.svg', 'lanetclick' ); ?>" alt="">
                                <?php endif; ?>
                                <div class="tarif">
									<div class="subnab">
							<div class="sub-nab"><?php the_sub_field('dop_tekst_bilya_soty_kompl'); ?></div>
							<img loading="lazy" class="tarif-image-v" src="/wp-content/uploads/2023/03/sotahov.svg" alt="">
						</div>
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
                                    <span class="details-toggle"><?php _e('More', 'lanetclick');?></span>
                                    <div class="price"><?php the_sub_field('vartist_tsina'); ?></div>
                                     <div><a class="order-btn" data-form-name="tarif-ssp"><?php _e('Order', 'lanetclick');?></a></div>
                                    <span class="hide-toggle" style="display:none;"><?php _e('Hide', 'lanetclick');?></span>
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
        var mySwiper = new Swiper('.tarif-slider556', {
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
				},
			
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
<div class="nab-rish">
<div class="container">
		<div class="row">
			<div class="col-md-n-1">
				<p class="cta-z"><?php the_field('h2_nab_r_w'); ?></p>
				<p class="cta-zyall"><?php the_field('h2_nab_r_y'); ?></p>
				<p class="cta-pzall"><?php the_field('p_nab_r'); ?></p>
				<img loading="lazy" class="bjola-nab" src="<?php the_field('bdzhola_iz_shlyahomp_nab_r'); ?>">
				<img loading="lazy" class="bjola-nab-m" src="<?php the_field('bdzhola_iz_shlyahom_nab_r_m'); ?>">
			</div>
			<div class="col-md-n-2 select-list">
				<?php if( have_rows('1nab_nab_r') ): ?>
    <?php $index = 0; ?>
    <?php while( have_rows('1nab_nab_r') ): the_row(); 
        $nazva = get_sub_field('nazva_naboru_nab_r');
    ?>
        <div class="select-title-mobile select-title-mobile-<?php echo $index; ?>"><?php echo $nazva; ?></div>
        <select id="control-select-<?php echo $index; ?>" name="<?php echo $nazva; ?>" class="dynamic-select dynamic-select-<?php echo $index; ?>">
            <option class="default-option" selected><?php echo $nazva; ?></option>
            <?php if( have_rows('varianty_naboru_nab_r') ): ?>
                <?php while( have_rows('varianty_naboru_nab_r') ): the_row();
                    $variant = get_sub_field('variant_naboru_nab_rs');
                ?>
                    <option value="<?php echo $variant; ?>"><?php echo $variant; ?></option>
                <?php endwhile; ?>
            <?php endif; ?>
        </select>
    <?php $index++; ?>
    <?php endwhile; ?>
<?php endif; ?>
				<a class="cta-b" data-form-name="nab-rish"><?php _e('Wanna order', 'lanetclick');?></a>
				</div>
</div>
</div>	
</div>
<script>
	$(document).ready(function() {
  function checkWidth() {
    var windowSize = $(window).width();

    $('.dynamic-select').each(function(index) {
      $(this).find('.default-option').remove();
      $(this).find('.mobile-default').remove();

      if (windowSize <= 768) {
        $(this).prepend('<option class="mobile-default" selected><?php _e('Choose an option', 'lanetclick');?></option>');
      } else {
        var title = $('.select-title-mobile-' + index).text();
        $(this).prepend('<option class="default-option" selected>' + title + '</option>');
      }
    });
  }

  // Execute on load
  checkWidth();
  // Bind event listener
  $(window).resize(checkWidth);
});
	</script>
<div id="popup-form2" class="popup">
    <div class="popup-content2">
        <span class="close-btn"><?php _e('Close', 'lanetclick');?></span>
		<div class="h1pp1"><?php the_field('h1pp2', 'options'); ?></div>
		<div id="dialog-form" title="Замовити">
  <div id="user-form">
	  <?php echo do_shortcode( '[contact-form-7 id="c6aa5ae" title="form kompleksni rishennya"]' ); ?>
     </div>
</div>
		</div>
	<div class="popup-content-tnx2" style="display: none;">
		<span class="close-btn"><?php _e('Close', 'lanetclick');?></span>
		<div class="h1pptnx"><?php the_field('h1pptnx', 'options'); ?></div>
		<p class="ppptnx"><?php the_field('p_hopup_tnx', 'options'); ?></p>
			</div>
</div>
<div class="case_nab">
	<h2 class="case-nab-h2"><?php the_field('n2_case_nab'); ?></h2>
	<p class="case-nab-p"><?php the_field('p_case_nab'); ?></p>
	<div class="case_nab_posts">
    <?php
    $paged = $_POST['page'];
    $default_page_id = 32588; // ID страницы на дефолтном языке
    $current_page_id = icl_object_id($default_page_id, 'page', true);

    $args = array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_parent' => $current_page_id,
        'posts_per_page' => '2',
        'paged' => $paged,
    );

    $my_query = new WP_Query($args);

    if ($my_query->have_posts()) : 
        while ($my_query->have_posts()) : $my_query->the_post(); ?>
            <div class="custom-column">
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>"><img loading="lazy" class="com-case-img" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></a>
            <?php endif; ?>
            <h3><a class="com-case-h3" href="<?php the_permalink(); ?>"><?php the_field('zag_case'); ?></a></h3>
            </div>
        <?php endwhile; 
    endif;

    wp_reset_query();
    ?>
</div>
				<a class="btn-nab-case" target="blank" href="<?php the_field('link_knopky_case_nab'); ?>"><?php the_field('tekst_knopky_case_nab'); ?></a>
	
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
  $('.prosdod').each(function() {
    var $h3 = $(this).find('h3');
    if ($h3.text().trim() === '') {
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
	$(document).ready(function() {
  $('.kompl-rish').each(function() {
    var $h3 = $(this).find('h3');
    if ($h3.text().trim() === '') {
      $(this).hide();
    }
  });
});
</script>
<script>
	function setPadding() {
    var basePadding = 70;
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

    var sspDivs = document.querySelectorAll('.scscr-ssp, .kompl-rish, .scscr-ssp2, .tarif-ssp, .nab-rish, .case_nab, .vidhuki, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
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
	
    // Открываем попап при клике на кнопку
    document.querySelectorAll('.cta-b-a').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('#popup-form2 .popup-content2').style.display = 'block';
            document.querySelector('#popup-form2 .popup-content-tnx2').style.display = 'none';
            document.querySelector('#popup-form2').style.display = 'block';
		// Получаем значение атрибута data-form-name
            formName = this.getAttribute('data-form-name') || 'unknown';
			
			// Получаем ID формы из скрытого поля
    	var hiddenFieldopen = form.querySelector('input[name="form_id"]');
    	var formIdopen = hiddenFieldopen ? hiddenFieldopen.value : 'unknown';
        // Отправляем данные в dataLayer
    
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
            document.querySelector('#popup-form2').style.display = 'none';
        });
    });

    // Получаем форму
    let form = document.querySelector('#dialog-form .wpcf7-form');

    // Обработка отправки формы
    form.addEventListener('submit', function(e) {
        e.preventDefault();

		// Перед отправкой AJAX-запроса
			document.getElementById("loading-indicators2").style.display = "flex";
		
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
                errorElement.textContent = '<?php _e('Required field', 'lanetclick');?>';
                input.parentNode.appendChild(errorElement);
            }
        });

			
        // Валидация email на сервере
        let emailField = form.querySelector('input[type="email"]');
        let emailValue = emailField ? emailField.value : '';
        let errorElement = emailField.nextElementSibling; // Предполагаем, что элемент для ошибки находится сразу после поля email

        let xhrValidation = new XMLHttpRequest();
        xhrValidation.open('POST', ajax_url, true);  // ajax_url определен в вашем PHP-коде
        xhrValidation.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
        xhrValidation.onreadystatechange = function() {
            if (xhrValidation.readyState === 4 && xhrValidation.status === 200) {
				document.getElementById("loading-indicators2").style.display = "none";
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
			document.getElementById("loading-indicators2").style.display = "none";
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
                            document.getElementById("loading-indicatorb2").style.display = "flex";
                            document.querySelector('#popup-form2 .popup-content2').style.display = 'none';
                            document.querySelector('#popup-form2 .popup-content-tnx2').style.display = 'block';
                        } else if (xhr.readyState === 4 && xhr.status !== 200) {
                            errorElement.textContent = '<?php _e('There was a sending error', 'lanetclick');?>';
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
    window.dataLayer.push({
        'event': 'form_submit',
        'form_id': formId,
        'form_name': formName,
		'email': emailValuesent,
        'phone': phoneValuesent
    });
				// Отображаем индикатор загрузки
    document.getElementById("loading-indicators2").style.display = "flex";
				} else {
                // Если телефон не валиден, показываем сообщение об ошибке
                if (!phoneErrorElement) {
                    phoneErrorElement = document.createElement('span');
                    phoneErrorElement.className = 'wpcf7-not-valid-tip';
                    if (phoneField) {
                        phoneField.parentNode.appendChild(phoneErrorElement);
                    }
                }
                phoneErrorElement.textContent = '<?php _e('Wrong phone number', 'lanetclick');?>';
            }
        }
    };
    xhrPhoneValidation.send(`action=validate_phone&phone=${phoneValue}&nonce=${ajax_nonce}`);
                } else {
                    // Если email не валиден, показываем сообщение об ошибке
                    document.getElementById("loading-indicators2").style.display = "none";
                    errorElement.textContent = '<?php _e('Wrong email', 'lanetclick');?>';
                }
            }
        };
        xhrValidation.send('action=validate_email&email=' + emailValue + '&nonce=' + ajax_nonce);  // ajax_nonce определен в вашем PHP-коде
    });
});
</script>