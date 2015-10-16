var GoogleMaps = {

    init: function(){

        this.locationSearchBox = $('#location-text-box');
        this.locationFormInput = $('input[name=location]');
        this.latitudeFormInput = $('input[name=latitude]');
        this.longitudeFormInput = $('input[name=longitude]');

        this.mapcanvas = $('#map-canvas');
        this.map = new google.maps.Map(this.mapcanvas.get(0),{ zoom: 12 });

        //Fill the location search box with form input
        this.locationSearchBox.val(this.locationFormInput.val());
        this.marker = null;

        this.autocomplete = new google.maps.places.Autocomplete(this.locationSearchBox.get(0));
        this.autocomplete.bindTo('bounds', this.map);

        if(this.latitudeFormInput.val() && this.longitudeFormInput.val()){
            this.plotMapFromFormValues();
        }
        else{
            console.log('Try plotting map from geolocation...');
            this.tryPlottingFromGeolocation();
        }

        this.bindevents();
    },

    bindevents:function(){
        google.maps.event.addListener(this.autocomplete, 'place_changed',$.proxy(this.locationTextChangedEventHandler,this));
    },

    locationTextChangedEventHandler:function(){
        var infowindow = new google.maps.InfoWindow();
        this.locationFormInput.val(this.locationSearchBox.val());
        infowindow.close();
        
        this.marker.setVisible(false);
        var place = this.autocomplete.getPlace();
        if (!place.geometry) {
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            this.map.fitBounds(place.geometry.viewport);
        } else {
            this.map.setCenter(place.geometry.location);
            this.map.setZoom(17); // Why 17? Because it looks good.
        }
        
        this.marker.setPosition(place.geometry.location);
        this.marker.setVisible(true);
    },

    tryPlottingFromGeolocation:function(){

        // Get GEOLOCATION
        if (navigator.geolocation){
            console.log('Plotting for geolocation....');

            var self = this;
            
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = new google.maps.LatLng(position.coords.latitude,
                    position.coords.longitude);

                self.map.setCenter(pos);
                self.marker = new google.maps.Marker({
                    position: pos,
                    map: self.map,
                    draggable: true
                });

                //Once plotted from geolocation update the form inputs
                self.latitudeFormInput.val(self.marker.position.lat());
                self.longitudeFormInput.val(self.marker.position.lng());

                google.maps.event.addListener(self.marker, 'position_changed',$.proxy(self.markerPositionChangedEventHandler,self));

            },function() {
                self.handleNoGeolocation(true);
            });
        } 
        else {
            console.log('Browser does not support geolocation....');
            this.handleNoGeolocation(false);
        }
    },

    handleNoGeolocation:function(errorFlag){
        if (errorFlag){
            var content = 'Error: The Geolocation service failed.';
        }
        else{
            var content = 'Error: Your browser doesn\'t support geolocation.';
        }

        var options = {
            map: this.map,
            position: new google.maps.LatLng(28.552511, 77.270807),
            content: content
        };

        this.map.setCenter(options.position);
        this.marker = new google.maps.Marker({
            position: options.position,
            map: this.map,
            draggable: true
        });

        google.maps.event.addListener(this.marker, 'position_changed',$.proxy(this.markerPositionChangedEventHandler,this));

    },

    plotMapFromFormValues:function(){
        console.log('Plotting map for form values...');
        pos = new google.maps.LatLng(this.latitudeFormInput.val(),this.longitudeFormInput.val());
        this.map.setZoom(17);
        this.map.setCenter(pos);
        
        this.marker = new google.maps.Marker({
            position: pos,
            map: this.map,
            draggable: true
        });

        google.maps.event.addListener(this.marker, 'position_changed',$.proxy(this.markerPositionChangedEventHandler,this));
    },

    markerPositionChangedEventHandler:function(){
        this.latitudeFormInput.val(this.marker.position.lat());
        this.longitudeFormInput.val(this.marker.position.lng());
    }
};

google.maps.event.addDomListener(window, 'load', GoogleMaps.init());




