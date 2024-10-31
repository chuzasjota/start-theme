<?php

/**
 * The template for displaying the front page
 *
 * This is the template that displays the front page of your WordPress site.
 * You can use this template to customize the layout and content of your front page.
 */

get_header(); ?>
<!-- Hero section -->
<main class="front-page">
    <section class="container-fluid position-relative banner">
        <div class="row">
            <div class="col-12 px-0">
                <img class="w-100" src="<?php echo get_template_directory_uri(); ?>/public/images/banner.png" alt="">
                <h3 class="position-absolute banner__title">Blog</h3>
            </div>
        </div>
    </section>
<!-- Search and filter section -->
    <section class="search py-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-6">
                    <h2 class="search__title pb-2">Nuestro Blog</h2>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    <div class="search__input-container d-flex justify-content-end">
                        <input type="text" id="search__input" placeholder="Buscar">
                        <div class="search__icon-container">
                            <img src="<?php echo get_template_directory_uri(); ?>/public/images/search.png"" alt="search" class="search__icon">
                        </div>
                    </div>
                    <div id="category-filters" class="buttons pt-4 d-flex column-gap-3 justify-content-center">
                        <button class="button" data-category="all">Todos</button>
                        <!-- List of categories -->
                        <?php
                            $categories = get_categories();
                            foreach($categories as $category):
                        ?>
                            <button class="button" data-category="<?php echo $category->slug; ?>"><?php echo $category->name; ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- All posts -->
<?php 
    $args = array(
        'post_type'=> 'post',
        'orderby'    => 'ID',
        'post_status' => 'publish',
        'order'    => 'ASC',
        'posts_per_page' => -1
    );
    $result = new WP_Query( $args );
    if ( $result-> have_posts() ) : 
?>              
    <section class="container-xxl py-5" id="posts">
        <div class="row">
            <?php while ( $result->have_posts() ) : $result->the_post(); ?>
            <div class="col-md-6 col-12 pb-4 mb-4 d-flex posts__column" data-category="<?php echo get_the_category(get_the_ID())[0]->slug; ?>">
                <div class="card px-3">
                    <div class="card__image pb-4">
                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="">
                    </div>
                    <div class="card__content">
                        <p class="card__content--info">
                            <span><?php echo get_the_date("F j"); ?></span> - <a href="<?php echo get_category_link(get_the_category(get_the_ID())[0]->term_id); ?>"><?php echo get_the_category(get_the_ID())[0]->name; ?></a>
                        </p>
                        <h5 class="card__title"><?php the_title(); ?></h5>
                        <?php the_content();?>
                        <a href="<?php echo the_guid(); ?>" class="mt-4 button button__card">Leer más →</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; wp_reset_postdata(); ?>
</main>

<?php get_footer();