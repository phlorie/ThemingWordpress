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

	<link rel="icon" type="image/png" href="favicon.png" />
	<link rel="icon" type="image/x-icon" href="favicon.ico" />

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-40016759-1', 'lareinedespommes.fr');
	  ga('send', 'pageview');

	</script>

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
				
				<ul id="nav">
					<li><a href="<?php bloginfo('url'); ?>">Accueil</a></li>
					<?php wp_list_pages('depth=1&title_li='); ?>
					<?php wp_list_cats('sort_column=menu_order&depth=1&title_li=&show_count=0'); ?>
				</ul>
				
			</div>
		</header>
	<div class="content-wrap">