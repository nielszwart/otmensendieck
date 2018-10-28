<?php
/*
Template Name: Behandelingen overzicht pagina
@package bootstrap-basic
*/

get_header();
$main_column_size = bootstrapBasicGetMainColumnSize();
?> 

<?php get_sidebar('left'); ?> 
				<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
					<main id="main" class="site-main" role="main">
						<?php 
							while (have_posts()) {
								the_post();
								
								?>
									<header class="entry-header behandelingen-header">
										<h1 class="entry-title"><?= get_the_title();?></h1>
									</header>

									<div class="row">
								<?php						
								wp_nav_menu([
									'theme_location' => 'behandelingen',
								]);

								the_content();
							}	
						?> 
						</div>
					</main>
				</div>
				<div class="spacemaker">&nbsp;</div>
<?php get_sidebar('right'); ?> 

<?php get_footer(); ?> 