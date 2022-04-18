<?php
get_header();
?>
 <div class="breadcrumb"><?php get_breadcrumb(); ?></div>
<h2 class="text-center my-3"><?php the_archive_title()?></h2>
<?php

include('inc/template-parts/post-loop.php');

get_footer();
?>