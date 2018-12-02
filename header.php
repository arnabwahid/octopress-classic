<?php
/**
 * Part: header.php
 *
 * @package    WordPress
 * @subpackage wp-octopress
 * @since      1.0
 */

?><!DOCTYPE html>
<!--[if IEMobile 7 ]>
<html class="no-js iem7"><![endif]-->
<!--[if lt IE 9]>
<html class="no-js lte-ie8"><![endif]-->
<!--[if (gt IE 8)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
		<!--Fonts from Google's Web font directory at http://google.com/webfonts -->
		<link href='http://fonts.googleapis.com/css?family=PT+Serif:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'><?php // @codingStandardsIgnoreLine: @TODO Enqueue this. ?>
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'><?php // @codingStandardsIgnoreLine: @TODO Enqueue this. ?>

		<!-- http://t.co/dKP3o1e -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="/favicon.ico" rel="icon">
		<link href="<?php echo get_template_directory_uri(); ?>/style.css" media="screen, projection" rel="stylesheet" type="text/css"><?php // @codingStandardsIgnoreLine: @TODO Enqueue this. ?>
		<script src="<?php echo get_template_directory_uri(); ?>/javascripts/modernizr-2.0.js"></script><?php // @codingStandardsIgnoreLine: @TODO Enqueue this. ?>
		<script src="<?php echo get_template_directory_uri(); ?>/javascripts/ender.js"></script><?php // @codingStandardsIgnoreLine: @TODO Enqueue this. ?>
		<script src="<?php echo get_template_directory_uri(); ?>/javascripts/octopress.js" type="text/javascript"></script><?php // @codingStandardsIgnoreLine: @TODO Enqueue this. ?>

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<header role="banner">
			<hgroup>
				<?php octopress_avatar(); ?>
				<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<h2><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
		</header>

		<nav role="navigation">

			<!-- Mobile Nav -->
			<ul class="subscription" data-subscription="rss">
					<li><a href="/atom.xml" rel="subscribe-rss" title="subscribe via RSS">RSS</a></li>
			</ul>

			<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<fieldset role="search">
					<input class="search" type="text" placeholder="Search" value="" name="s" id="s">
					<input hidden type="submit" results="0" id="searchsubmit" placeholder="" value="Search">
				</fieldset> <!-- Mobile Nav End -->
			</form>

			<ul class="main-navigation">
				<?php wp_nav_menu( array( 'items_wrap' => '%3$s' ) ); ?>
			</ul>
		</nav>
