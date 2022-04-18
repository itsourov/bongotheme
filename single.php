<?php
get_header();

?>

    <div class="row">

        <div class="col-12 col-md-8">

       

            <h2><?php the_title();?></h2>
            <div class="breadcrumb "><?php get_breadcrumb(); ?></div>
            <div class="date mb-3">
                <svg fill="currentColor" viewBox="0 0 24 19">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                </svg></span>
                <span><?php echo get_the_date(get_option('date_format')); ?> .</span>
                <span> <?php  echo wpb_get_post_views(get_the_ID()); ?></span>
            </div>


            <a href="<?php echo get_the_post_thumbnail_url(); ?>" data-toggle="lightbox">
                <img class="img-fluid posts-card shadow" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
            </a>
            <div class="content mt-4" id="content">
                <?php echo the_content(); ?>
            </div>

            <div class="tags">
                <?php the_tags('Tags: ','','') ?>
            </div>

<div class="comments">
    <?php

// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) :
    comments_template();
endif;

?>
</div>


        </div>
        <div class="col-12 col-md-4">
            <?php get_sidebar();?>
        </div>

    </div>



<?php
  
get_footer();
?>