<?php
require_once("../config/init.php");
$projectController = ProjectController::getInstance();
$projects = $projectController->getProjects("*");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Modern Architecture | Projects</title>

		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>
	<body>
		
		<div id="site-content">
			<div class="site-header">
				<div class="container">
					<a href="index.html" id="branding">
						<img src="images/logo.png" alt="" class="logo">
						<div class="logo-text">
							<h1 class="site-title">ARCHI DESIGN</h1>
						</div>
					</a> <!-- #branding -->

					<!-- Default snippet for navigation -->
					<div class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item "><a href="index.html">Home</a></li>
							<li class="menu-item current-menu-item"><a href="projects.php">our Projects</a></li>
							<li class="menu-item "><a href="about.html">About</a></li>
							<li class="menu-item"><a href="contact.html">Contact</a></li>
						</ul> <!-- .menu -->
					</div> <!-- .main-navigation -->

					<div class="mobile-navigation"></div>
				</div>
			</div> <!-- .site-header -->

			<main class="main-content">

				<div class="page">
					<div class="container">
						<h2 class="entry-title">Here are some of our projects.</h2>
						<p>We get our clients through different mediums such as design competitions, bids and other client recommendations, therefore our customers vary ranging from governmental organizations, non-governmental organizations, share companies to private investors which also come from various age group and locations.</p>
						<!---->
                        <div class="filter-links filterable-nav">
                            <select class="mobile-filter">
                                <option value="*">Show all</option>
                                <option value=".skyscraper">skyscraper</option>
                                <option value=".shopping-center">shopping-center</option>
                                <option value=".apartment">apartment</option>
                            </select>
                            <a href="#" class="current wow fadeInRight" data-filter="*">Show all</a>
                            <a href="#" class="wow fadeInRight" data-wow-delay=".2s" data-filter=".skyscraper">skyscraper</a>
                            <a href="#" class="wow fadeInRight" data-wow-delay=".4s" data-filter=".shopping-center">shopping-center</a>
                            <a href="#" class="wow fadeInRight" data-wow-delay=".6s" data-filter=".apartment">apartment</a>
                        </div>
                        <div class="filterable-items">
                            <?php if (isset($projects) && is_array($projects) && count($projects) > 0): ?>
                                <?php foreach ($projects  as $project): ?>
                                <div class="project-item filterable-item shopping-center">
                                    <figure class="featured-image">
                                        <a href="project.php"><img src="<?=PROJECT_IMAGES_DIR .$project["image_name"]?>" alt="<?=$project["name"]?>"></a>
                                        <figcaption>
                                            <h2 class="project-title"><a href="project.php"><?=$project["name"]?></a></h2>
<!--                                            <p>--><?//=$project["description"]?><!--</p>-->
                                            <a class="button" href="">More</a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!--Just load these in case database connection fails-->
                                <div class="project-item filterable-item skyscrapper">
                                    <figure class="featured-image">
                                        <a href="project.php"><img src="dummy/large-thumb-2.jpg" alt="#"></a>
                                        <figcaption>
                                            <h2 class="project-title"><a href="project.php">Consectetur adipisicing elit</a></h2>
                                            <p class="project-subtotle">Maecenas dictum suscipit</p>
                                            <p>Sed ut perspiciatis unde omnis iste natus accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                            <a class="button" href="">More</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            <?php endif; ?>
						</div>
					</div>
				</div> <!-- .page -->

			</main> <!-- .main-content -->

			<footer class="site-footer">
				<div class="container">
					<div class="pull-left">
						<address>
							<strong>Archi Design.</strong>
							<p>Mezid Plaza, office no. 705, Addis Ababa Ethiopia</p>
						</address>
						<a href="#" class="phone">+251911751553</a>
					</div> <!-- .pull-left -->

					<div class="pull-right">

						<div class="social-links">

							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-google-plus"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-pinterest"></i></a>

						</div>

					</div> <!-- .pull-right -->

					<div class="colophon">Copyright 2018 Archi Design. Designed by
						<a href="https://labacreatives.com" title="Designed by Laba creatives" target="_blank">
							Labacreatives.com
						</a>. All rights reserved.
					</div>
					<!--            <a class="button" href="about.html">Go To CMS</a>-->
				</div> <!-- .container -->
			</footer> <!-- .site-footer -->
		</div>

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>