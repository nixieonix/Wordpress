<?php
/*
Template Name: Location Map XML
*/
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<markers>';
$posts = query_posts(array_merge(
	array(
		'post_type' => 'location'
	)
));

//give each marker an id number
$i = 0;

foreach ($posts as $post){ ?>
	<?php
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
	<?php if (get_post_meta(get_the_ID(), 'latitude', true)): ?>
	<?php $locLat = get_post_meta( get_the_ID(), 'latitude', true); ?>
	<?php endif; ?>
	<?php if (get_post_meta(get_the_ID(), 'longitude', true)): ?>
	<?php $locLong = get_post_meta( get_the_ID(), 'longitude', true); ?>
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
	
	<marker id="<?php echo $i; ?>" name="<?php the_title(); ?>" address1="<?php echo $locStreetAddress; ?>" addressNum="<?php echo $locAddressNum; ?>" postcode="<?php echo $locZip; ?>" city="<?php echo $locCity; ?>" categories="<?php echo $post_categories; ?>" lat="<?php echo $locLat; ?>" lng="<?php echo $locLong; ?>" link="<?php echo $post_slug; ?>">
<?php $i++; } ?> 
</markers>