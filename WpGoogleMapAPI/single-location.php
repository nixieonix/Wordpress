<?php get_header(); ?>

	<div class="single_page_location">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php if (get_post_meta(get_the_ID(), 'ime', true)): ?>
		<?php $firstName = get_post_meta( get_the_ID(), 'ime', true); ?>
		<?php endif; ?>
		<?php if (get_post_meta(get_the_ID(), 'priimek', true)): ?>
		<?php $lastName = get_post_meta( get_the_ID(), 'priimek', true); ?>
		<?php endif; ?>
		<?php if (get_post_meta(get_the_ID(), 'telefon', true)): ?>
		<?php $phoneNum = get_post_meta( get_the_ID(), 'telefon', true); ?>
		<?php endif; ?>
		<?php if (get_post_meta(get_the_ID(), 'e-mail', true)): ?>
		<?php $email = get_post_meta( get_the_ID(), 'e-mail', true); ?>
		<?php endif; ?>


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
		<?php if (get_post_meta(get_the_ID(), 'latitude', true)): ?>
		<?php $locLat = get_post_meta( get_the_ID(), 'latitude', true); ?>
		<?php endif; ?>
		<?php if (get_post_meta(get_the_ID(), 'longitude', true)): ?>
		<?php $locLong = get_post_meta( get_the_ID(), 'longitude', true); ?>
		<?php endif; ?>

<!--================ Single Location Google Map ==================-->
		<div class="container-fluid single-map">
			<div id="map">
				<iframe
					class="embed-responsive-item"
					frameborder="0"
					width="100%" 
					height="300" 
        			scrolling="no" 
        			marginheight="0" 
        			marginwidth="0"
					src="https://maps.google.it/maps?q=<?php echo $locAddressNum.$locStreetAddress.$locZip.$locCity ?>&output=embed"  allowfullscreen>
				</iframe>
			</div>
		</div>

<!--=================== User inforamtion =========================-->
		<div class="container">
			<div class="content user-data">
				<div>
					<h1 class="blog-title text-center"><?php the_title(); ?></h1>
				</div>
				<div class="blog-post">
					<?php the_content(); ?>
				</div>
				<br/>
				<div>
					<strong><?php echo $firstName; ?> <?php echo $lastName; ?></strong><br>
					<?php echo $locStreetAddress;?>  <?php echo $locAddressNum;?> <br /> 
					<?php echo $locZip; ?> <?php echo $locCity; ?><br />
					<abbr title="Phone">Telefon:</abbr> <a href="tel:<?php echo $phoneNum; ?>"><?php echo $phoneNum; ?></a><br /> 
					<abbr title="Email">E-mail:</abbr> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
				</div>	
			</div>
		</div>


<hr class="featurette-divider">

<!--======================= Ponudba ==========?==================-->
		<div class="continer">
			<h1 class="text-center">Ponudba</h1>
			<div id="kategorije" class="content">
				<div class="row">
					<div class="col-md-6">
						<div id="sadje">
							<?php if( get_field('jabolka') || get_field('hruske') ): ?>
								<dl class="dl-horizontal">
									<dt><h4 class="text-center"><?php echo "Sadje" ?></h4></dt>
									<br/>
									<?php if( get_field('jabolka') ): ?>
										<dd>
											<?php echo "Jabolka" ?>
											<?php the_field('jabolka'); ?> &euro;/kg
										</dd>
									<?php endif; ?>
									<?php if( get_field('hruske') ): ?>
										<dd>
											<?php echo "Hruške" ?>
											<?php the_field('hruske'); ?> &euro;/kg
										</dd>
									<?php endif; ?>
								</dl>
							<?php endif; ?>
						</div><!-- .sadje -->
					</div><!-- .col-md-5 -->
					
					<div class="col-md-6">
						<div id="zelenjava">
							<?php if( get_field('solata') || get_field('krompir') ): ?>
								<dl class="dl-horizontal">
									<dt><h4 class="text-center"><?php echo "Zelenjava" ?></h4></dt>
									<br/>
									<?php if( get_field('solata') ): ?>
										<dd>
											<?php echo "Solata" ?>
											<?php the_field('solata'); ?> &euro;/kg
										</dd>
									<?php endif; ?>
									<?php if( get_field('krompir') ): ?>
										<dd>
											<?php echo "Krompir" ?>
											<?php the_field('krompir'); ?> &euro;/kg
										</dd>
									<?php endif; ?>
								</dl>
							<?php endif; ?>
						</div><!-- .zelenjava -->
					</div><!-- .col-md-5 -->

					<div class="col-md-6">
						<div id="meso">
							<?php if( get_field('perutnina') || get_field('govedina') ): ?>
								<dl class="dl-horizontal">
									<dt><h4 class="text-center"><?php echo "Meso" ?></h4></dt>
									<br />
									<?php if( get_field('perutnina') ): ?>
										<dd>
											<?php echo "Perutnina" ?>
											<?php the_field('perutnina'); ?> &euro;/kg
										</dd>
									<?php endif; ?>
									<?php if( get_field('govedina') ): ?>
										<dd>
											<?php echo "Govedina" ?>
											<?php the_field('govedina'); ?> &euro;/kg
										</dd>
									<?php endif; ?>
								</dl>
							<?php endif; ?>
						</div><!-- .meso -->
					</div><!-- .col-md-5 -->
					
					<div class="col-md-6">
						<div id="mlecni_izdelki">
							<?php if( get_field('mleko') || get_field('jogurt') || get_field('skuta') ): ?>
								<dl class="dl-horizontal">
									<dt><h4><?php echo "Mlečni izdelki" ?></h4></dt>
									<br/>
									<?php if( get_field('mleko') ): ?>
										<dd>
											<?php echo "Mleko" ?>
											<?php the_field('mleko'); ?> &euro;/kg
										</dd>
									<?php endif; ?>
									<?php if( get_field('jogurt') ): ?>
										<dd>
											<?php echo "Jogurt" ?>
											<?php the_field('jogurt'); ?> &euro;/kg
										</dd>
									<?php endif; ?>
									<?php if( get_field('skuta') ): ?>
										<dd>
											<?php echo "Skuta" ?>
											<?php the_field('skuta'); ?> &euro;/kg
										</dd>
									<?php endif; ?>
								</dl>
							<?php endif; ?>
						</div><!-- .mlecni_izdelki -->
					</div><!-- .col-md-5 -->



				</div><!--  .row -->
			</div><!-- #kategorije .content -->
		</div><!-- .continer -->
		<?php endwhile; else: ?>
			<p><?php _e('Sorry, this page does not exist.'); ?></p>
		<?php endif; ?>

<!--================ Kontaktni podatki ======================-->



	</div><!--  single_page_location -->
<?php get_footer(); ?>