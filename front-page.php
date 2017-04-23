<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php the_post_thumbnail('full'); ?>


<div id="page_content" role="main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                
                <!-- Home Carousel -->
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="http://placehold.it/1270x530/76a9ce/ffffff" alt="Sample">
                            <div class="carousel-caption">
                                Caption
                            </div>
                        </div>
                        <div class="item">
                            <img src="http://placehold.it/1270x530/6699fe/ffffff" alt="Sample">
                            <div class="carousel-caption">
                                Caption
                            </div>
                        </div>
                    ...
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no pages matched your criteria.', 'cs' ); ?></p>
<?php endif; ?>


<?php get_footer(); ?>
