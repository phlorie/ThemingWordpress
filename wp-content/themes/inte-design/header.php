<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">

	<title><?php bloginfo('name'); ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="author" content="<?php bloginfo('name'); ?>">
	<meta name="viewport" content="initial-scale = 1, user-scalable=no,maximum-scale=1.0">
	<meta name="HandheldFriendly">

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" type="application/rss+xml" />

	<?php
		if(is_singular() && get_option('thread_comments'))
			wp_enqueue_script('comment_reply');
		wp_head();
	?>

</head>
<body>
	<div id="wrapper">
		<header>
			<div class="header-wrapper">
				<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
				
				<!--<ul id="nav">
					<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
					<?php wp_list_pages('depth=1&title_li='); ?>
					<?php wp_list_cats('sort_column=menu_order&depth=1&title_li=&show_count=0'); ?>
				</ul>-->
				
			</div>
		</header>
	<div class="content-wrap">