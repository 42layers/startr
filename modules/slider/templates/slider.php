<?php
global $theme_options;
//echo '<pre>';
//var_dump($theme_options);
//echo '</pre>';

/*
 * Só mostra se tiver algum slider
 */

if (!empty($theme_options['home-slider'])) :
    ?>
    <!-- Slider -->
    <div id="slider" class="swiper-container">
        <div class="slider-container swiper-wrapper">

            <?php
            /*
             * Slides Loops
             */
            foreach ($theme_options['home-slider'] as $slide) :
                ?>
                <!-- Slide -->
                <div class="slider-slide swiper-slide" style="background-image: url('<?php echo $slide['image']; ?>');">
                    
                </div>
                <!-- FIM Slide -->
            <?php endforeach; ?>

        </div>

        <div class="slider-pagination"></div>
    </div>
    <!-- FIM Slider -->
<?php endif; ?>