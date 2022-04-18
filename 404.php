<?php
get_header();
?>

<div class="row">

    <div class="col-12 col-md-8">

        <div class="four_zero_four_bg"
            style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/error.gif);">
            <h1 class="text-center ">404</h1>
        </div>
        <div class="contant_box_404 text-center">
            <h3 class="h2">
                Look like you're lost
            </h3>

            <p>the page you are looking for not avaible!</p>

            <a href="<?php echo home_url(); ?>" class="link_404">Go to Home</a>
        </div>


    </div>
    <div class="col-12 col-md-4">
        <?php get_sidebar();?>
    </div>

</div>





<
<style>
/*======================
    404 page
=======================*/


.four_zero_four_bg {
    height: 400px;
    background-position: center;
}


.four_zero_four_bg h1 {
    font-size: 80px;
}

.four_zero_four_bg h3 {
    font-size: 80px;
}

.link_404 {
    color: #fff !important;
    padding: 10px 20px;
    background: #39ac31;
    margin: 20px 0;
    display: inline-block;
}

.contant_box_404 {
    margin-top: -50px;
}
</style>

<?php
get_footer();
?>