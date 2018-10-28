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
			<?php while (have_posts()) { ?>
				<header class="entry-header">
					<h1 class="entry-title"><?= get_the_title();?></h1>
				</header>
				<div class="row">
					<div id="map" class="col-md-5">&nbsp;</div>
				    <div class="col-md-7">
				    	<?php
								the_post();
								the_content();
						?>
					</div>
				</div>
			<?php } ?> 
		</main>
	</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?> 

<script>
	function initMap() {
		var zaandam = {lat: 52.4439029, lng: 4.8398546};
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 16,
			center: zaandam
		});
		var marker = new google.maps.Marker({
			position: zaandam,
			map: map
		});
	}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1d_Ekegxss-2DiCByJSriVKYn4C-UPyU&callback=initMap"></script>