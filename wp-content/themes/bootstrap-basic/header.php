<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 */
$isNews = 'nieuws' == get_post_type();
$sHeaderImageUrl = $isNews ? '/wp-content/themes/bootstrap-basic/img/nieuws.png' : get_field('header_image');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	


	<?php wp_head(); ?>

	<?php if ($isNews) { ?>
	<meta property="og:image" content="<?=get_field('nieuws_afbeelding');?>" />
	<?php } ?>	
	
</head>
<body <?php body_class(); ?>>
	<!--[if lt IE 8]>
		<p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
	<![endif]-->
	
	<?php do_action('before'); ?> 

	<?php
		if ($isNews) {
			?>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>	
			<?php
		}
	?>

	<header role="banner">
		<div class="row site-branding">
			<div class="col-md-12">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" class="main-logo" />
				</a>
			</div>				
		</div>
	</header>

	<div class="container page-container">
		<div class="row">
			<div class="col-md-12 nav-wrapper">
				<div class="header-image" style="background-image: url(<?=$sHeaderImageUrl;?>);">
					<nav class="navbar navbar-static-top">


						<div class="navbar-header" id="nav-header">
				            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarr">
				                <span class="sr-only">Toggle navigation</span>
				                <span class="icon-bar"></span>
				                <span class="icon-bar"></span>
				                <span class="icon-bar"></span>
				            </button>						
						</div>



						<div id="navbarr" class="collapse navbar-collapse" aria-expanded="false">
							<?php 		
								wp_nav_menu([
										'theme_location' => 'primary', 
										'container' => false, 
										'menu_class' => 'nav nav-justified', 
										'walker' => new BootstrapBasicMyWalkerNavMenu()
								]);
							?> 
						</div>
					</nav>
				</div>
			</div>				
		</div>
	
		<div id="content" class="row site-content">	
