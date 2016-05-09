<?php get_header(); ?> 
<div class="container-fluid page-map" >
	<div id="floating-panel">
		<input id="address" type="textbox" value="Išči drugo likacijo">
		<input id="submit" type="button" value="Geocode">
	</div>

	<div class="row">
		<div class="col-md-10">
			<div id="map_canvas"></div>
		</div>
		<div class="col-md-2">
			<div id="side_bar"></div>
		</div>
	</div>
</div>

<?php get_footer(); ?>