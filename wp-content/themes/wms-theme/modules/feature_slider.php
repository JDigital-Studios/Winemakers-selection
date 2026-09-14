<div class="feature-slider grid-container" data-module-key="<?php echo $moduleIndex['feature_slider'] ?>" id="feature-slider-<?php echo $moduleIndex['feature_slider']; ?>">
    <div class="feature-slider-container">
        <div class="swiper-wrapper">
            <?php $slideIndex = 0; ?>
            <?php if ( have_rows('slides') ) : ?>
                <?php while( have_rows('slides') ) : the_row(); $slideIndex++; ?>
                    <?php
                        // Only the first slide should be an H1 to avoid duplicate H1s on the page.
                        $heading_tag = ( 1 === $slideIndex ) ? 'h1' : 'h2';
                    ?>
                    <?php if (get_sub_field('type') == 'image'): ?>
                        <div class="swiper-slide feature-content-container">
                            <div class="grid-x small-12 medium-12 large-12">
			                    <div class="cell small-12 large-7 feature-image desktop" style="background: url('<?php echo get_sub_field('image'); ?>') no-repeat;"  role="img">
                                    &nbsp;
                                </div>
                                <div class="cell small-12 large-7 feature-image mobile" style="background: url('<?php echo get_sub_field('mobile_image'); ?>') no-repeat;" role="img">
                                    &nbsp;
                                </div>
                                <div class="cell small-12 large-5 gradient_fill parallax">
                                    <div class="feature-content">
                                    <?php
                                        $image = get_sub_field('logo');
                                        if( !empty( $image ) ): ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" title="<?php echo esc_attr($image['alt']); ?>" class="logo_image" />
                                    <?php endif; ?>
                                    <?php if (get_sub_field('heading')) : ?>
                                        <<?php echo $heading_tag; ?> data-swiper-parallax-y="-20"  data-swiper-parallax-duration="600" data-swiper-parallax-opacity="1"><?php echo get_sub_field('heading'); ?></<?php echo $heading_tag; ?>>
                                    <?php endif; ?>
                                    <?php if (get_sub_field('copy')) : ?>
                                        <p data-swiper-parallax-y="-25" data-swiper-parallax-duration="750" data-swiper-parallax-opacity="1"><?php echo get_sub_field('copy'); ?></p>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (get_sub_field('type') == 'video'): ?>
                        <div class="swiper-slide">
                            <div class="feature-content-container">
                                <div class="image_overlay">&nbsp;</div>
                                <video playsinline="1" muted="1" autoplay="1" loop="1" poster="<?php echo get_sub_field('video_image'); ?>" class="feature-video">
                                    <source src="<?php echo get_sub_field('video_link'); ?>" type="video/mp4">
                                </video>
                                <div class="feature-content">
                                <?php if (get_sub_field('video_heading')) : ?>
                                    <<?php echo $heading_tag; ?> data-swiper-parallax-y="-20"  data-swiper-parallax-duration="600" data-swiper-parallax-opacity="1"><?php echo get_sub_field('video_heading'); ?></<?php echo $heading_tag; ?>>
                                <?php endif; ?>
                                <?php if (get_sub_field('video_copy') != '') : ?>
                                    <p data-swiper-parallax-y="-25" data-swiper-parallax-duration="750" data-swiper-parallax-opacity="1"><?php echo get_sub_field('video_copy'); ?></p>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($slideIndex > 1) : ?>    
        <div class="feature-slider-controls" style="bottom: 20px !important;"></div>
    <?php endif; ?>
</div>