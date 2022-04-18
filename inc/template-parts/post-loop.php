<div class="row g-3">

    <?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>

    <div class="col-12 col-sm-6 col-lg-4">
        <div class="posts-card shadow " effect="ripple">
            <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
                <div class="imgbox">
                    <img src="<?php
if (has_post_thumbnail()) {
            the_post_thumbnail_url('bongo-thumbnail');
        } else {
            echo 'https://gptips.itsourov.com/wp-content/uploads/2021/07/nagadtips-300x169.png';
        }
        ?>" alt="" class="img-fluid post-thumbnail">
                </div>
            </a>

            <div class="post-title-box p-3 pb-0">
                <h3 class="post-title">

                    <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a>
                </h3>
            </div>
            <hr class="bg-secondary m-1">
            <div class="post-meta ">
                <?php echo get_the_date(get_option('date_format')) . ' . ' . get_comments_number() . ' comments' . ' . ' . wpb_get_post_views(get_the_ID()); ?>
            </div>
        </div>
    </div>
    <?php
}
}
?>

</div>

<div class="mt-5 d-flex justify-content-center">
<?php bootstrap_pagination(); ?>
</div>