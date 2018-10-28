<?php
/**
 * Template for displaying single news item
 * 
 * @package bootstrap-basic
 */

get_header();

global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request));
?>

<?php
$main_column_size = bootstrapBasicGetMainColumnSize();
?> 
<?php get_sidebar('left'); ?> 
				<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
					<main id="main" class="site-main" role="main">
						<a href="/nieuws">< Terug naar nieuws overzicht</a>
						<div class="single-image" style="background-image:url('<?=get_field('nieuws_afbeelding');?>')"></div>
						<h1><?=the_title()?></h1>
						<span class="news-date"><?=date("d-m-Y", strtotime(get_field('news_date')));?></span>
						<?php
							the_content();
						?> 

						<div class="fb-share-button" data-href="<?=$current_url;?>" data-layout="button" data-size="large" data-mobile-iframe="true">
							<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$current_url;?>&amp;src=sdkpreparse">
								Share
							</a>
						</div>
						<br/><br/>

						<a href="/nieuws">< Terug naar nieuws overzicht</a>
					</main>
				</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?> 
