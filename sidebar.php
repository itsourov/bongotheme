<div id="sidebar">
    <div class="posts-card shadow-sm text-center p-3 mt-3">
        <h5>আমাদের সম্পর্কে</h5>
        <img class="img-fluid logo m-3" src="<?php echo bongotheme_getLogo(); ?>" alt="">
        <p>আমরা বাংলাদেশ ডাক বিভাগের বা নগদ এর সাথে সরাসরি সম্পর্কিত না, আমাদের ব্লগের মাধ্যমে শুধুমাত্র নগদের অফার,
            টিপস-এন্ড-ট্রিকস সম্পর্কে জানা যাবে।</p>

        <a href="/contact"> <button type="button" class="btn btn-danger shadow-none" effect="ripple">
                <i class="fa fa-phone" aria-hidden="true"></i> Contact Us
            </button>
        </a>
    </div>

    <div class="posts-card shadow-sm text-center p-3 mt-3" id="most-viewed-posts">
        <h5>সর্বাধিক পাঠিত</h5>


        <ul>

            <?php
                $popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
                
                
                while ($popularpost->have_posts()) {
                    $popularpost->the_post();

                    ?>

            <li effect="ripple"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

            <?php
                }
                ?>

        </ul>
    </div>
    <div class="posts-card shadow-sm text-center p-3 mt-3">
        <h5>আমাদেরকে ফলো করুন</h5>
        <div class="follow-btns">
            <!-- Facebook -->
            <a effect="ripple" class="btn btn-primary  shadow-none" style="background-color: #3b5998;" href="#!"
                role="button"><i class="fab fa-facebook-f"></i></a>

            <!-- Instagram -->
            <a effect="ripple" class="btn btn-primary  shadow-none" style="background-color: #ac2bac;" href="#!"
                role="button"><i class="fab fa-instagram"></i></a>

            <!-- Youtube -->
            <a effect="ripple" class="btn btn-primary  shadow-none" style="background-color: #ed302f;" href="#!"
                role="button"><i class="fab fa-youtube"></i></a>


            <!-- Whatsapp -->
            <a effect="ripple" class="btn btn-primary  shadow-none" style="background-color: #25d366;" href="#!"
                role="button"><i class="fab fa-whatsapp"></i></a>
        </div>

    </div>

</div>