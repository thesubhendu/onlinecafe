<div>
    <div id="infowindow-content">
        <span id="place-name" class="title"></span><br/>
        <span id="place-address"></span>
    </div>
    <div id="pac-container">
        <input class="form-control" id="pac-input" type="text"
               placeholder="Enter a location"/>
    </div>

    <div id="infowindow-content">
        <span id="place-name" class="title"></span><br/>
        <span id="place-address"></span>
    </div>

    <div id="map" style="height: 340px; "></div>

    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: 40.749933, lng: -73.98633},
                zoom: 13,
                mapTypeControl: false,
            });
            const card = document.getElementById("pac-card");
            const input = document.getElementById("pac-input");
            const options = {
                fields: ["formatted_address", "geometry", "name"],
                strictBounds: false,
                types: ["establishment"],
            };

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

            const autocomplete = new google.maps.places.Autocomplete(input, options);

            autocomplete.bindTo("bounds", map);

            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");

            infowindow.setContent(infowindowContent);

            const marker = new google.maps.Marker({
                map,
                anchorPoint: new google.maps.Point(0, -29),
                draggable: true
            });
            google.maps.event.addListener(marker, 'dragend', function (marker) {
                console.log(marker);
                Livewire.emit('markerPositionChanged', [marker.latLng.lat(), marker.latLng.lng()])
            });

            autocomplete.addListener("place_changed", () => {
                infowindow.close();
                marker.setVisible(false);

                const place = autocomplete.getPlace();

                if (!place.geometry || !place.geometry.location) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                var selectedLocation = place.geometry.location;
                marker.setPosition(selectedLocation);
                Livewire.emit('addressChanged', place.formatted_address)
                Livewire.emit('markerPositionChanged', [selectedLocation.lat(), selectedLocation.lng()])

                marker.setVisible(true);
                infowindowContent.children["place-name"].textContent = place.name;
                infowindowContent.children["place-address"].textContent =
                    place.formatted_address;
                infowindow.open(map, marker);
            });
        }
    </script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVC74RfFXvyIin6Nk6hUP8Nv9MIiCuNnM&callback=initMap&libraries=places&v=weekly&channel=2"
        async
    ></script>
</div>

