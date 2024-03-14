<?php
/**
 * Шаблон, отображаемый при отсутствии результатов поиска (content-none.php)
 */
?>

<div class="nothing-f">
    <h2>УВАГА!</h2>
    <p>За вашим запитом, на жаль, нічого не знайдено.. <br> Спробуйте ще раз переглянути всі доступні статті у розділі <a href="/blog">Блог</a>
    </p>
</div><!-- .page-content -->
</section><!-- .no-results -->
</main><!-- #main -->
</div><!-- #primary -->
<!-- Varto chitaty-->
<div class="blog-sf">
    <div class="row">
        <div class="col-12-m">
            <h3>Останні записи в блозі</h3>
       
        <?php
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $related_posts = new WP_Query($args);
        $count = 0;
        while ($related_posts->have_posts()) : $related_posts->the_post();
        ?>
            
            <!-- Code for displaying each related post -->
            <div class="col-md-4p">
                <div class="post" onclick="window.location.href='<?php the_permalink(); ?>';">
                    <?php if (has_post_thumbnail()): ?>
                        <img loading="lazy" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>

                    <div class="post-meta">
                        <span class="post-author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
        <?php echo get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name'); ?>
    </a></span>
                        <span class="post-date"><?php the_date(); ?></span>
                    </div>

                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="p-excerpt"><?php the_excerpt(); ?></div>
                </div>
            </div>
            
            <!-- Inserting a break after the third post -->
            <?php
            $count++;
            if ($count === 3) {
                // Close the current div elements
                echo '</div></div></div>'; 
                
                ?>
                
                <!-- Your Code -->
                <div class="cta-post">
                    <div class="container">
                        <div class="row-b">
                            <div class="col-md-3-1">
                                <p class="cta-zyall"><?php the_field('zhovtyj_tekst_b', 'options'); ?></p>
                                <p class="cta-b-0"><?php the_field('bilyj_tekst_b', 'options'); ?></p>
                                <img loading="lazy" class="cta-bl" src="<?php the_field('strilka_b', 'options'); ?>">
                            </div>
                            <div class="col-md-3-2">
                                <h4 class="cta-b-1"><?php the_field('pershyj_tekst_b', 'options'); ?></h4>
                                <p class="cta-b-2"><?php the_field('drugyj_tekst_b', 'options'); ?></p>
                                <?php echo do_shortcode(get_field('shortkod_mailchimp', 'options')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Your Code -->
                
                <!-- Reopen the div elements for the next posts -->
                <div class="blog-s">
                    <div class="row">
                        <div class="col-12-m">
                <?php
            }
            ?>
            
        <?php endwhile; wp_reset_postdata(); ?>
        
        <!-- Close the div elements after the loop -->
        </div>
    </div>
</div>

<script>document.querySelectorAll('.col-md-4p')[1].style.padding = "0 30px";</script>