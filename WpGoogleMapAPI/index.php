<?php get_header(); ?>

<!-- =======. carousel ===========-->

<?php if( is_front_page() ) { ?>
	<?php 
		$posts = query_posts(array_merge(
		array(
			'post_type' => 'carousel'
		)
	));?>
<?php $posts('showposts=3&post_type=post'); ?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="background-color:yellow; height:250px;">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">

		<?php if( have_posts() ) : while ( have_posts() ) : the_post(); $i++; ?>
		<?php if ($i == 1) { ?>
		<div class="item active">
		<?php } else { ?>
		<div class="item">
		<?php } ?>

			<?php if ( has_post_thumbnail() ) { 
				$url = wp_get_attachment_url( get_post_thumbnail_id() );
			?>
			<img src="<?php echo $url; ?>" alt="<?php the_title(); ?>">
			<?php } ?>
			<div class="container">
				<div class="carousel-caption">
					<h1><?php the_title(); ?></h1>
					<p class="text-center"><?php the_content(); ?></p>
					<p class="text-center"><a class="btn btn-primary btn-lg" href="<?php the_prema_link(); ?>" role="button">Read...</a></p>
				</div>
			</div>
		</div>
		<?php endwhile; endif; ?>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<?php } wp_reset_query(); ?>
<!-- /.carousel -->

<!--===================.jumbotron ======================-->

	<div class="jumbotron">
		<div class="title-container">
			<h1 class="text-center">Hello, world!</h1>
			<p class="text-center">...</p>
			<!--<p class="text-center"><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>-->
		
			<div class="arrow">
				<a href="#step-by-step">
					<h1 class="text-center">
						<i class="glyphicon glyphicon-chevron-down"></i>
					</h1>
				</a>
			</div>
		</div>
	</div><!-- /.jumbothron -->

<!-- ============ Step by step  =========================== -->
	<div class="container" id="step-by-step">
	<!-- Three columns of text below the carousel -->
		<div class="row">
			<?php $loop = new WP_Query( array( 'order' => 'asc', 'post_type' => 'post') ); ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<div class="col-lg-4 ">
				<h3 class="text-center"><?php the_title(); ?></h3>
				<p class="text-center"><?php the_content(); ?></p>
			</div><!-- /.col-lg-4 -->
			<?php endwhile; ?>
		</div><!-- /.row -->
	</div><!-- /.step-by-step -->



<!--================== Google map =================================-->	

	<div class="container-fluid index-map" style="">
		<div id="map_canvas"></div>
		<div id="side_bar"></div>
	</div>

<!--================= Subscription ================================-->

	<div class="container subscribe">
		<div class="content"></div>
	</div>

<?php get_footer(); ?>