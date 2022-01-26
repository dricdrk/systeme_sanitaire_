<?php  
function show_map_if_user_give_location(){$hig='50%';
$wid='70%';
 ?>

	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0Im6YcLYWlIOuSeRXuPO0iMsk-RTagco&libraries=places"></script>
	 <style type="text/css">
	html, body {
	 width: 100%;
	 height: 100%;
	}
	body {
	 margin: 0;
	 position: absolute;
	}
	#maps {
	 margin-top: 2%;
	 margin-left: 5%;
	 width: <?php echo $wid; ?> ;
	 height: <?php echo $hig; ?> ; 
	 position: absolute;
	 left: 1;
	 top: 2;
	}
	</style>
	<script type="text/javascript">
		var objLocation, objMaps, objCurrentLocationMarker, objInfoWindow, objService;
	if (navigator.geolocation) {

	 navigator.geolocation.getCurrentPosition(function(position) {
	    objLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

	 objMaps = new google.maps.Map(document.querySelector("#maps"), {
	 zoom: 16, 
	 center: objLocation, 
	 mapTypeControl: false,
	 scaleControl: false,
	 streetViewControl: false,
	 overviewMapControl: false,
	 zoomControl: true,
	 navigationControlOptions: { style: google.maps.NavigationControlStyle.SMALL },
	 mapTypeId: google.maps.MapTypeId.ROADMAP
	 });
	 
	 objCurrentLocationMarker = new google.maps.Marker({
	 position: objLocation,
	 map: objMaps,
	 title: "Vous êtes ici !" 
	 });

	 google.maps.event.addListener(objCurrentLocationMarker, 'click', function() {
	 objInfoWindow.setContent("Vous");
	 objInfoWindow.open(objMaps, this);
	 });
		objInfoWindow = new google.maps.InfoWindow();
		objService = new google.maps.places.PlacesService(objMaps);       
		google.maps.event.addListenerOnce(objMaps, 'bounds_changed', doSearch);
		doSearch();
	 }, 
		function(msg) {
	 alert("Erreur : " + msg);
	 });
	}
	function doSearch() {
	    objService.nearbySearch({
	        location: objLocation,
	        radius: 105000,
	        types: ['pharmacy', 'hopital']
	    }, function(results, status) {
	        if (status == google.maps.places.PlacesServiceStatus.OK) {
	            for (var i = 0; i < results.length; i++) {
	            createMarker(results[i]);
	                console.log((results[i]));
	            }       
	        } 
	    });
	}


	function createMarker(objPlace) {
	    if (objPlace.types[0] !== "hopital" && objPlace.types[0] !== "pharmacy") {
	        return;   
	    }
	    
	    var objMarker = new google.maps.Marker({
	        position: objPlace.geometry.location,
	        map: objMaps,
	        icon: "http://www.google.com/mapfiles/ms/micons/purple-dot.png",
	        title: objPlace.name
	    });

	    google.maps.event.addListener(objMarker, 'click', function() {
	        var strHTML = "<b>" + objPlace.name + "</b><br />";
	        if (objPlace.types[0] == "hopital") {
	            strHTML += "hopital";
	        } else if (objPlace.types[0] == "pharmacie") {
	            strHTML += "pharmacie";
	        }else {
	            strHTML += "Inconnu (" + objPlace.types[0] + ")";   
	        }
	        
	        objInfoWindow.setContent(strHTML);
	        objInfoWindow.open(objMaps, this);
	    }); 
	}
	 </script>
	 <div id="maps"></div>
 <?php 
}?>