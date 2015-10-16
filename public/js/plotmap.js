var GoogleMaps = {

    plotFromValues: function(){

        //Get latitude and longitude from the meta tags
        this.latitude = $("meta[name='latitude']").attr('content');
        this.longitude = $("meta[name='longitude']").attr('content');

        this.mapcanvas = $('#map-canvas');
        this.map = new google.maps.Map(this.mapcanvas.get(0),{ zoom: 17 });

        pos = new google.maps.LatLng(this.latitude,this.longitude);
        this.map.setCenter(pos);
        
        this.marker = new google.maps.Marker({
            position: pos,
            map: this.map
        });
    }
};

google.maps.event.addDomListener(window, 'load', GoogleMaps.plotFromValues());