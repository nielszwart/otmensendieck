<?php
/**
 * Template for displaying pages
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
						<?php 
							while (have_posts()) {
								the_post();
								
								?>
									<header class="entry-header">
										<h1 class="entry-title"><?= get_the_title();?></h1>
									</header>
								<?php
								the_content();
							}	
						?> 
					</main>
				</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?> 