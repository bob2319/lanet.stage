<?php  
/*
Template Name: COPYWRITING
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
      });
	  });
</script>
<script>
$(document).ready(function() {
    function initTarifSlider() {
        if ($(window).width() < 3000) {
            if (!$('.tarif-slider').hasClass('slick-initialized')) {
                $('.tarif-slider').slick({
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
                                arrows : false,
								slidesToScroll: 1
                            }
                        }
                    ]
                });
            }
        } else {
            if ($('.tarif-slider').hasClass('slick-initialized')) {
                $('.tarif-slider').slick('unslick');
            }
        }
    }

    function updateSliderHeight() {
        var windowWidth = $(window).width();
        if (windowWidth < 768) {
            var $expandedSlide = $('.tarif-slider .slick-slide.expanded');
            if ($expandedSlide.length === 0) {
                var $slickList = $('.tarif-slider').find('.slick-list.draggable');
                var $currentSlide = $('.tarif-slider').find('.slick-current');
                $slickList.height($currentSlide.height());
            }
        } else {
            $('.tarif-slider .slick-slide').each(function() {
                var $expandedSlide = $(this).find('.expanded');
                if ($expandedSlide.length === 0) {
                    var $slickList = $(this).find('.slick-list.draggable');
                    var $currentSlide = $(this);
                    $slickList.height($currentSlide.height());
                }
            });
        }
    }

    function toggleTarifDetails() {
		console.log('Function called');
        const tarif = $(this).closest('.tarif');
        tarif.find('.description').slideToggle(200);
		tarif.find('.service').slideDown(250).promise().done(function() {
            tarif.find('.service').css('display', 'flex');
        });
        tarif.find('.details-toggle').toggle();
        $(this).toggle();
        setTimeout(function() {
            updateSliderHeight();
            var $expandedTarifs = $('.tarif-slider .tarif.expanded');
            if ($expandedTarifs.length === 0) {
                $('.tarif-slider').slick('setHeight');
            }
        }, 210);
    }

    initTarifSlider();

    $(window).on('resize', function() {
        initTarifSlider();
        updateSliderHeight();
    });

    $('.details-toggle').on('click', toggleTarifDetails);

    $('.hide-toggle').on('click', function() {
        const tarif = $(this).closest('.tarif');
        tarif.find('.description').slideToggle(200);
		tarif.find('.service').slice(3).slideUp(200).css('display', 'none');
        if ($('.tarif-slider').hasClass('slick-initialized')) {
            $('.tarif-slider').slick('setHeight');
            setTimeout(updateSliderHeight, 260);
        }
        tarif.find('.hide-toggle').toggle();
        $(this).toggle();
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
						<img loading="lazy" class="tarif-image" src="/wp-content/uploads/2023/03/sotahov.svg" alt="" style="display:none;">
                        <h3><?php the_sub_field('nazva_taryfu_tsina'); ?></h3>
                        <div class="services">
                            <?php
                            $counter = 0;
                            if (have_rows('poslugy_shho_vhodyat_tsina')):
                                while (have_rows('poslugy_shho_vhodyat_tsina')): the_row();
                                    $is_visible = $counter < 3 ? '' : ' style="display:none;"';
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
                        <div><a class="order-btn cta-b" data-form-name="tarif-ssp"><?php _e('Order', 'lanetclick');?></a></div>
                        <span class="hide-toggle" style="display:none;"><?php _e('Hide', 'lanetclick');?></span>
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
                        			<span class="details-toggle"><?php _e('More', 'lanetclick');?></span>
									<div class="price"><?php the_sub_field('vartist_tsina'); ?></div>
                        			<div><a class="order-btn cta-b" data-form-name="tarif-ssp"><?php _e('Order', 'lanetclick');?></a></div>
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
<div class="opty-copy">
	<h3><?php the_field('h3_opti_copy'); ?></h3>
	<p><?php the_field('p_opti_copy'); ?></p>
	<div class="container">
		<div class="swiper-container opti-slider" data-activate-swiper="false">
			<div class="swiper-wrapper"> 
				<?php if (have_rows('poslugy_opti_copy')) : ?>
					<?php while (have_rows('poslugy_opti_copy')) : the_row(); ?>
						<div class="swiper-slide col-md-4"> 
							<div class="optim-copy">
								<div class="o-c"><img loading="lazy" class="opty-image" src="/wp-content/uploads/2023/03/sotahov.svg" alt=""></div>
								<h4><?php the_sub_field('nazva_poslugy_opti_copy'); ?></h4>
								<p><?php the_sub_field('opis_poslugy_opti_copy'); ?></p>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<div class="tar-pagination"></div>
		</div>
	</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let swiper;
    const swiperContainer = document.querySelector('.opti-slider');

    function initSwiper() {
        if (window.innerWidth < 1365 && !swiper) {
            swiper = new Swiper('.opti-slider', {
                direction: 'horizontal',
      			loop: true,
     			slidesPerView: 1, // Default
      			spaceBetween: 0, // Default
      			centeredSlides: false,
      			autoHeight: true,
                pagination: {
                    el: '.tar-pagination',
                    clickable: true,
					dynamicBullets: false,
                },
            });
        } else if (window.innerWidth >= 1365 && swiper) {
            swiper.destroy(true, true);
            swiper = null;
        }
    }

    initSwiper();
    window.addEventListener('resize', initSwiper);
});
</script>

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

<div class="etapy-ssp">
	<h2><?php the_field('zag_et_ssp'); ?></h2>
	<p class="etapy-pz"><?php the_field('pidzag_et_ssp'); ?></p>
	<div class="hardline-sota">
	<img loading="lazy" class="line-etap" src="/wp-content/uploads/2023/07/arrowetap.svg" alt="">
	<img loading="lazy" class="line-etap-m" src="/wp-content/uploads/2023/07/arrowetapm.svg" alt="">
	<div class="row">
      <div class="col-md-7-1">
		<img loading="lazy" class="sota-etap" src="/wp-content/uploads/2023/03/sotahov.svg" alt="">
		 <p class="etap-nam"><?php the_field('etap1'); ?></p> 
		</div>
		<div class="col-md-7-1">
		<img loading="lazy" class="sota-etap" src="/wp-content/uploads/2023/03/sotahov.svg" alt="">
		 <p class="etap-nam"><?php the_field('etap2'); ?></p> 
		</div>
		<div class="col-md-7-1">
		<img loading="lazy" class="sota-etap" src="/wp-content/uploads/2023/03/sotahov.svg" alt="">
		 <p class="etap-nam"><?php the_field('etap3'); ?></p> 
		</div>
		<div class="col-md-7-1">
		<img loading="lazy" class="sota-etap" src="/wp-content/uploads/2023/03/sotahov.svg" alt="">
		 <p class="etap-nam"><?php the_field('etap4'); ?></p> 
		</div>
		<div class="col-md-7-1">
		<img loading="lazy" class="sota-etap" src="/wp-content/uploads/2023/03/sotahov.svg" alt="">
		 <p class="etap-nam"><?php the_field('etap5'); ?></p> 
		</div>
		<div class="col-md-7-1">
		<img loading="lazy" class="sota-etap" src="/wp-content/uploads/2023/03/sotahov.svg" alt="">
		 <p class="etap-nam"><?php the_field('etap6'); ?></p> 
		</div>
		<div class="col-md-7-1">
		<img loading="lazy" class="sota-etap" src="/wp-content/uploads/2023/03/sotahov.svg" alt="">
		 <p class="etap-nam"><?php the_field('etap7'); ?></p> 
		</div>
		</div>
	</div>
	<div class="masthev-ssp">
	<div class="row">
      <div class="col-md-m-1">
		<?php 
$image = get_field('foto_komandy_ssp'); // Получение массива изображения из ACF

if (!empty($image)) {
    $image_url = $image['url']; // URL изображения
    $image_alt = $image['alt']; // Альтернативный текст

    // Вывод изображения с URL и альтернативным текстом
    echo '<img loading="lazy" class="masthave-team" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
}
?>
		</div>
		<div class="col-md-m-2">
			<h4><?php the_field('why_zag_ssp'); ?></h4>
			<p class="masthev-t"><?php the_field('why_its_tekst_ssp'); ?></p>
			<button class="btn-first masthev-b cta-b" data-form-name="masthev-ssp"><?php the_field('tekst_na_knopczi'); ?></button>
		</div>
</div></div>
	<script>
		$(document).ready(function() {
    $('.effective').each(function() {
        const h2 = $(this).find('h2');
        if (!h2.text().trim()) {
            $(this).css('display', 'none');
        }
    });
});
		</script>
	<div class="effective">
		<h2><?php the_field('h2_effect_ppc'); ?></h2>
			<p class="efect-pz"><?php the_field('h2_effect_ppc_pz'); ?></p>
		<div class="container">
    <div class="row">
        <?php if (have_rows('col_effect_ppc')) : ?>
            <?php while (have_rows('col_effect_ppc')) : the_row(); ?>
                <div class="col-md-4-ppc">
                    <div class="effect-slide">
                        <h3><?php the_sub_field('col_effect_ppc_z'); ?></h3>
						<p class="efect-p"><?php the_sub_field('col_effect_ppc_pz'); ?></p>
						<a href="<?php the_sub_field('col_effect_ppc_link'); ?>"><img loading="lazy" class="effect-image" src="/wp-content/uploads/2023/05/arrowbl.svg" alt=""></a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
		<button class="btn-effective"><?php the_field('tekst_na_knopczi'); ?></button>
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
</div>	</div>
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
	jQuery(document).ready(function($) {

    function adjustImageHeight() {
        var maxHeight = 0;
        
        $('.sota-etap').each(function() {
            var thisHeight = $(this).offset().top + $(this).height();
            maxHeight = (thisHeight > maxHeight) ? thisHeight : maxHeight;
        });
        
        var parentOffset = $('.line-etap-m').parent().offset().top;
        $('.line-etap-m').height(maxHeight - parentOffset + 40);
    }
    
    adjustImageHeight();
    
    $(window).on('resize', adjustImageHeight);
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
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .tarif-ssp, .opty-copy, .prop-ssp, .etapy-ssp, .vidhuki, .faq, .prosdod, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
    sspDivs.forEach(function(div) {
        var computedStyle = getComputedStyle(div);
        var paddingTop = computedStyle.paddingTop;
        var paddingBottom = computedStyle.paddingBottom;
        div.style.padding = paddingTop + ' ' + newPadding + 'px ' + paddingBottom + ' ' + newPadding + 'px';
    });
}

function resetPadding() {
    var sspDivs = document.querySelectorAll('.scscr-ssp, .scscr-ssp2, .tarif-ssp, .opty-copy, .prop-ssp, .etapy-ssp, .vidhuki, .faq, .prosdod, .cta, .contact-f, .cont-s, .menu-f, .s-menu-1, .s-menu-2');
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