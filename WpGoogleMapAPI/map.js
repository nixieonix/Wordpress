//<![CDATA[

	// this variable will collect the html which will eventually be placed in the side_bar 
	var side_bar_html = ""; 

	// arrays to hold copies of the markers and html used by the side_bar 
	// because the function closure trick doesnt work there 
	var gmarkers = []; 
	var htmls = [];

	// arrays to hold variants of the info window html with get direction forms open
	var to_htmls = [];
	var from_htmls = [];

	// global "map" variable
	var map = null;

	var infowindow = new google.maps.InfoWindow(
	{
		size: new google.maps.Size(300,300)
	});
	
	
// A function to create the marker and set up the event window function 

function createMarker(latlng, name, html, categories, link) {
	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		zIndex: Math.round(latlng.lat()*-100000)<<5,
	});


	var i = gmarkers.length;

	// The inactive version of the direction info
	html = '<b>' + name + '</b><br>' + html + '<br/ > <b>Kategorije: </b>' + categories + '<br><a href="http://localhost/www/location/'+link+'">Več...<\/a>';

	var contentString = html;

	google.maps.event.addListener(marker, 'click', function() {
		infowindow.setContent(html); 
		infowindow.open(map,marker);
	});

	// save the info we need to use later for the side_bar
	gmarkers.push(marker);
	htmls[i] = html;

	// add a line to the side_bar html
	side_bar_html += '<a class="side_bar_link" href="javascript:myclick(' + (gmarkers.length-1) + ')">' + name + '<\/a><br>';

}

// This function picks up the click and opens the corresponding info window
function myclick(i) {
	google.maps.event.trigger(gmarkers[i], "click");
}
	

function initialize() {
	
	// create the map
	var myOptions = {
		zoom: 13,
		center: new google.maps.LatLng(0, 0),
		mapTypeControl: true,
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
		navigationControl: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}

	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	google.maps.event.addListener(map, 'click', function() {
		infowindow.close();
	});

	// Read the data from example.xml (http://nikagrabnar-portfolio.net46.net/map-xml/)
	downloadUrl("http://localhost/www/mapxml/", function(doc) {

		var xmlDoc = xmlParse(doc);
		var markers = xmlDoc.documentElement.getElementsByTagName("marker");

		for (var i = 0; i < markers.length; i++) {

			// obtain the attribues of each marker
			var lat = parseFloat(markers[i].getAttribute("lat"));
			var lng = parseFloat(markers[i].getAttribute("lng"));
			var point = new google.maps.LatLng(lat, lng);
			//var point;

			var user = map.getCenter();
			var distance = google.maps.geometry.spherical.computeDistanceBetween(user, point);

			/*Kliče info posameznega markerja*/
			var label = markers[i].getAttribute("name");
			var html = markers[i].getAttribute("address1")+"&nbsp;"+markers[i].getAttribute("addressNum")+"<br />"
					+ markers[i].getAttribute("postcode")+"&nbsp;"
					+ markers[i].getAttribute("city");
			var categories = markers[i].getAttribute("categories");
			
			var link = markers[i].getAttribute("link");
			
			/*getCoordinates( html, function(coords){
				point = new google.maps.LatLng(coords[0], coords[1]);
			})*/

			// create the marker (in radius 5km)
			if (distance < 5000){ 
				var marker = createMarker(point,label,html,categories,link); 
			}
			

			//Google map iFrame na točno določen naslov. (ga ne kličemo) 
			//var embed ="<iframe width='425' height='350' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='https://maps.google.com/maps?&amp;q="+ encodeURIComponent( markers[i].getAttribute("address1") + " " + markers[i].getAttribute("address1") + " " + markers[i].getAttribute("city") ) +"&amp;output=embed'></iframe>";

		}

		// put the assembled side_bar_html contents into the side_bar div
		document.getElementById("side_bar").innerHTML = side_bar_html;

	});

	// Check if the browser supports geolocation
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(currentPositionCallback);
	} else {
		alert('The browser does not support geolocation');
	}

	//posluša ali je bil kliknjen gumb submit in nato izvede funkcijo geocodeAddress
	var geocoder = new google.maps.Geocoder();
	document.getElementById('submit').addEventListener('click', function() {
		geocodeAddress(geocoder, map);
	});

}


// kliče našo pozicijo
function currentPositionCallback(position) {
	// Create a new latlng based on the latitude and longitude from the user's position
	var user_lat_long = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	var star = 'https://cdn2.iconfinder.com/data/icons/diagona/icon/16/031.png';
	// Add a marker using the user_lat_long position
	var marker = new google.maps.Marker({
		position: user_lat_long,
		map: map,
		icon: star
	});

	// Set the center of the map to the user's position and zomm into a more detailed level
	map.setCenter(user_lat_long);
}
var geocoder = new google.maps.Geocoder();

function getCoordinates (address, callback){

	var coodrinates;
	geocoder.geocode({address: address}, function (results, status){
		coords_obj = results[0].geometry.location;
		coordinates = [coords_obj.nb, coords_obj.ob];

		callback(coordinates);
	})
}


//Poišče zahtevano pozicijo iskalnega okna!
function geocodeAddress(geocoder, resultsMap) {
	var address = document.getElementById('address').value;
	geocoder.geocode({'address': address}, function(results, status) {
		if (status === google.maps.GeocoderStatus.OK) {
			resultsMap.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
				map: resultsMap,
				icon: none,
				position: results[0].geometry.location
			});
		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});
}
	// This Javascript is based on code provided by the
	// Community Church Javascript Team
	// http://www.bisphamchurch.org.uk/   
	// http://econym.org.uk/gmap/
	// from the v2 tutorial page at:
	// http://econym.org.uk/gmap/basic3.htm 

//]]>