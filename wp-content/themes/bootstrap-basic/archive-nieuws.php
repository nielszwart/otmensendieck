<?php 
/**
 * Displaying news archive page
 * 
 * @package bootstrap-basic
 */

get_header(); 

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?> 
<?php get_sidebar('left'); ?> 

<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
	<main id="main" class="site-main" role="main">
		<?php if (have_posts()) { ?> 

			<header class="page-header">
				<h1 class="page-title">Nieuws</h1>
			</header>
			
			<?php while (have_posts()) { the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
							</header>

							<div class="entry-content list-item">
								<a href="<?php the_permalink(); ?>">
									<div class="list-image" style="background-image:url('<?=get_field('nieuws_afbeelding');?>')"></div>
								</a>
								<div class="excerpt">
									<span class="news-date"><?=date("d-m-Y", strtotime(get_field('news_date')));?></span>
									<?php the_excerpt(bootstrapBasicMoreLinkText()); ?> 
								</div>
								<div class="clearfix"></div>
							</div>
					</article>
			<?php } ?> 

			<?php bootstrapBasicPagination(); ?> 

		<?php } else { ?> 

			Er is even geen nieuws!

		<?php } //endif; ?> 
	</main>
</div>
<div class="spacemaker">&nbsp;</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?> 