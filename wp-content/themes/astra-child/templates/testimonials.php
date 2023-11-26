<div class="testimonials owl-carousel owl-theme hidden-el from-down">
    <?php
    $args = array(
        'post_type' => 'partners',
        'posts_per_page' => -1,
    );

    $testimonial_query = new WP_Query($args);

    while ($testimonial_query->have_posts()) : $testimonial_query->the_post();
        $testimonial_name = get_the_title();
        $testimonial_content = get_the_content();
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); // 'thumbnail' is the image size, you can change it to your preferred size
    ?>
        <div class="testimonial-card px-10 gap-7 text-center flex flex-col justify-center items-center">
            <div class="w-full flex justify-center">
                <img src="<?php echo get_field('logo'); ?>" alt="<?php echo esc_attr($testimonial_name); ?>">
            </div>
        </div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>