<?php
    get_header();
?>
<div class="postbody">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article class="post">
                <h2 class="page_header"><?php the_title(); ?></h2>
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p>There are no posts!</p>
    <?php endif; ?>
</div>
<?php
    get_footer();
?>
