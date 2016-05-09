<?php get_header(); ?>

<div class="container page_userlist">
	<div class="content">
		<h1 class="text-center">Seznam ponudnikov</h1>
	</div>
	
	<div class="content users-data">
		<div class="row">
			<?php 

			$posts = query_posts(array_merge(
				array(
					'post_type' => 'location'
				)
			));

			//give each marker an id number
			$i = 0;

			foreach ($posts as $post) { 
				
				global $post;
				$post_slug=$post->post_name;
				?>
				<?php if (get_post_meta(get_the_ID(), 'hisna_stevilka', true)): ?>
				<?php $locAddressNum = get_post_meta( get_the_ID(), 'hisna_stevilka', true); ?>
				<?php endif; ?>
				<?php if (get_post_meta(get_the_ID(), 'naslov', true)): ?>
				<?php $locStreetAddress = get_post_meta( get_the_ID(), 'naslov', true); ?>
				<?php endif; ?>
				<?php if (get_post_meta(get_the_ID(), 'mesto', true)): ?>
				<?php $locCity = get_post_meta( get_the_ID(), 'mesto', true); ?>
				<?php endif; ?>
				<?php if (get_post_meta(get_the_ID(), 'postna_stevilka', true)): ?>
				<?php $locZip = get_post_meta( get_the_ID(), 'postna_stevilka', true); ?>
				<?php endif; ?>
				<?php if (get_post_meta(get_the_ID(), 'telefon', true)): ?>
				<?php $phoneNum = get_post_meta( get_the_ID(), 'telefon', true); ?>
				<?php endif; ?>

				<?php
					$cats = array();
					foreach (get_the_category($post_id) as $c) {
					$cat = get_category($c);
					array_push($cats, $cat->name);
					}

					if (sizeOf($cats) > 0) {
					$post_categories = implode(', ', $cats);
					} else {
						$post_categories = 'Not Assigned';
					}
				?>

				<div class="col-md-4">
					<h3> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h3>
					<div id="location">
						<?php echo $locStreetAddress; ?> <?php echo $locAddressNum; ?> <br /> 
						<?php echo $locZip; ?> <?php echo $locCity; ?><br />
						<abbr title="Phone">Telefon:</abbr> <a href="tel:<?php echo $phoneNum; ?>"><?php echo $phoneNum; ?></a><br /> 
					</div>
					<div id="category">
						<strong>Kategorije:</strong> <?php echo $post_categories; ?>
					</div>

				</div><!-- .col-md-4 -->
			<?php 
				$i++; 
			} 
			?>
		</div><!-- .row -->
	</div><!-- .content -->

</div><!-- .container -->
	

<?php get_footer(); ?>