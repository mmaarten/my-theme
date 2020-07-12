/**
 * Google Map
 */
(function( $ )
{
    "use strict";

    window.theme = window.theme || {};

    function Map( canvasId, options )
    {
        this.canvas  = document.getElementById( canvasId );
        this.options = Object.assign( {}, Map.defaultOptions, options );

        this.markers = [];
        this.bounds  = new google.maps.LatLngBounds();

        // Get markers out of options

        var markers = [];

        if ( this.options.hasOwnProperty( 'markers' ) )
        {
            markers = this.options.markers;

            delete this.options.markers;
        };

        // Create map

        this.map = new google.maps.Map( this.canvas, this.options );

        // Add markers

        for ( var i in markers )
        {
            var marker = this.addMarker( markers[i] );

            this.bounds.extend( marker.position );
        };

        if ( markers.length > 1 )
        {
            this.map.fitBounds( this.bounds );
        }

        else
        {
            this.map.setCenter( this.bounds.getCenter() );
        };

        // Notify

        $( document.body ).trigger( 'theme.map.init', [ this ] );
    };

    Map.defaultOptions =
    {
        zoom : 8, // Required
    };

    Map.prototype.addMarker = function( options )
    {
        options = Object.assign( {}, options );

        // Set map

        options.map = this.map;

        // Get infoWindowData out of options

        var infoWindowData;

        if ( options.hasOwnProperty( 'infoWindowData' ) )
        {
            infoWindowData = Object.assign( {}, options.infoWindowData );

            delete options.infoWindowData;
        }

        // Create marker

        var marker = new google.maps.Marker( options );

        // Create Info Window

        if ( infoWindowData )
        {
            var infowindow = new google.maps.InfoWindow( infoWindowData );

            marker.addListener( 'click', function( event )
            {
                infowindow.open( this.map, marker );

            }.bind( this ) );
        };

        // Add marker

        this.markers.push( marker );

        // Notify

        $( this ).trigger( 'theme.map.markerAdded', [ marker, this ] );

        // Return

        return marker;
    };

    window.theme.GoogleMap = Map;

})( jQuery );
