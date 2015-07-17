/*!
 * donde.js 0.2
 * Copyright 2013 Agustin Diaz @hiroagustin
 * Released under the MIT license
 */
;(function () {
    'use strict';

    var infWindow = new google.maps.InfoWindow();    
    
    var default_options = {
        idMap: 'map',
        zoom: 15,
        defaultLocation: {latitude: -34.8937720817105, longitude: -56.1659574508667}
    },
        Donde = function Donde(options) {
            this.options = _.extend({}, default_options, options);
            this.markers = this.options.markers;
            return this;
        };

    _.extend(Donde.prototype, {

        createMap: function (container) {
          return new google.maps.Map(container, {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                streetViewControl: false, 
                mapTypeControl: false, 
                zoom: this.options.zoom
          });
        },
        //4 createMarker
        createMarker: function (marker){
            var esTuPosicion = false;
            if(!marker){esTuPosicion= true;}
            marker = marker || {};

            var mrkr = new google.maps.Marker({
                icon: marker.icon,
                map: this.map,
                position: this.toLatLng(marker),
                title: marker.titulo,
                direccion: marker.direccion,
                tel: marker.tel,
                paginaWeb: marker.paginaWeb,
                rampa: marker.rampa,
                banios: marker.banios,
                ascensor: marker.ascensor,
                accesibilidadVisual: marker.rampa
            });
            
                
            
            google.maps.event.addListener(mrkr, 'click', function() {
                if (esTuPosicion){
                    var vContent = '<div style="display: inline-block; overflow: auto; max-height: 563px; max-width: 654px;">	<div class="gm-iw gm-sm"><div class="gm-title">' + this.title + '</div></div>';
                    infWindow.setContent(vContent);
                    infWindow.open(this.map, mrkr);
                }else {
                    var vContent = '<div style="display: inline-block; overflow: auto; max-height: 563px; max-width: 654px;">	<div class="gm-iw gm-sm"><div class="gm-title">' + this.title + '</div><div class="gm-basicinfo"><div class="gm-addr">' + this.direccion + '</div><div class="gm-website"><a target="_blank" href="'+ this.paginaWeb + '">Sitio web</a> / '+ this.tel + '</div><div class="gm-addr">';
                    //RAMPA
                    vContent = vContent + '<span title="Rampa" class="fa-stack fa-lg"><i class="fa icon-rampa fa-stack-2x ';
                    vContent = this.rampa ==='NO'? vContent + 'accessNO"></i></span>' : vContent +'accessYES"></i></span>';
                    //BAÑOS
                    vContent = vContent + '<span title="Baños" class="fa-stack fa-lg"><i class="fa icon-banos fa-stack-2x ';
                    vContent = this.banios ==='NO'? vContent + 'accessNO"></i></span>' : vContent +'accessYES"></i></span>';
                    //ASCENSOR
                    vContent = vContent + '<span title="Ascensor" class="fa-stack fa-lg"><i class="fa icon-ascensor fa-stack-2x ';
                    vContent = this.ascensor ==='NO'? vContent + 'accessNO"></i></span>' : vContent +'accessYES"></i></span>';
                    //ACCESIBILIDAD VISUAL
                    vContent = vContent + '<span title="Accesibilidad visual" class="fa-stack fa-lg"><i class="fa icon-visual fa-stack-2x '; 
                    vContent = this.accesibilidadVisual ==='NO'? vContent + 'accessNO"></i></span>' : vContent +'accessYES"></i></span>';

                    vContent = vContent + '</div></div></div></div>';
                    infWindow.setContent(vContent);
                    infWindow.open(this.map, mrkr);
                }
            });
            
            google.maps.event.addListener(this.map, 'click', function () {infWindow.close(); });

            return mrkr;
        },
        toLatLng: function (position){
          return position instanceof google.maps.LatLng ? position : new google.maps.LatLng(position.latitude, position.longitude);
        },
        setInitialPosition: function (position) {
            position = this.toLatLng(position);

            this.initialPosition = position;

            this.map.setCenter(position);
            this.userLocationMarker.setPosition(position);
            return this;
        },
        handleInitialLocationError: function () {
            this.setInitialPosition(this.options.defaultLocation);
            this.options.errorMessage && alert(this.options.errorMessage);
            console.log('Initial location not found.');
            return this;
        },
        panToPosition: function (position) {position = this.toLatLng(position); this.map.panTo(position); return this; },
        panToInitialPosition : function () {this.panToPosition(this.initialPosition); return this; },
        //3 Add marker
        addMarker: function (marker) {
            if (!(marker.type in this.groups)) {
                this.groups[marker.type] = {};
            }

            if (!this.groups[marker.type].markers) {
                this.groups[marker.type].markers = [];
            }

            marker.icon = this.groups[marker.type].icon;

            this.groups[marker.type].markers.push(
                this.createMarker(marker)
            );

            return this;
        },
        getUserPosition: function () {
            var self = this;
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    self.setInitialPosition(position.coords);
                },
                function () {
                    self.handleInitialLocationError(arguments);
                },
                {
                    enableHighAccuracy: true,
                    timeout: 8000
                }
            );
            return this;
        },
        //2 mapAttributes
        mapAttributes: function (item) {
            if (this.options.mapping) {
                _.each(this.options.mapping, function (map, key) {
                item[key] = map(item);
                });
            }
            return item;
        },
        //1 addMarkers
        addMarkers: function () {
            var self = this;
            if (!this.markers) {
                console.log('No markers found.');
            }
            _.each(this.markers, function (item) {
                self.addMarker(self.mapAttributes(item));
            });
            return this;
        },
        createIcons: function () {
            var self = this;
            _.each(this.options.icons, function (item, key) {
                if (!(key in self.groups)) {
                    self.groups[key] = {};
                }

                self.groups[key].icon = new google.maps.MarkerImage(self.options.icons[key], null, null, null, new google.maps.Size(27, 34));
            });

            return this;
        },
        searchPlace: function (parameters) {
            var placeService = new google.maps.places.PlacesService(this.map),
                self = this;
      
            navigator.geolocation.getCurrentPosition(function (position) {
                placeService.textSearch({
                    query: parameters.query,
                    radius: parameters.radius || 1000,
                    location: new google.maps.LatLng(
                        position.coords.latitude,
                        position.coords.longitude
                    )
                },
                function (results, status) {
                    var i = 0;
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                            for (i = 0, place; place = results[i]; i++) {
                                var location = place.geometry.location;
                                self.createMarker({latitude: location.hb, longitude: location.ib, icon: parameters.icon});
                            }
                        }
                });

            });
        },
        toggleType: function (type) {
            var group = this.groups[type];

            _.each(group.markers, function (marker) {
                marker.setVisible(!!group.isHidden);
            });

            group.isHidden = !group.isHidden;
        },
        listen: function (container) {
            var self = this;
            container.addEventListener('click', function (e) {
                infWindow.close();
                self.toggleType(e.target.dataset.type);
                e.target.dataset.isActive = e.target.dataset.isActive === 'true' ? 'false' : 'true';
            }, false);
        },
        addControls: function (container) {
            var list = document.createElement('ul'),
                element;
            _.each(this.groups, function (group, key) {
                element = document.createElement('li');
                element.dataset.type = key;
                element.dataset.isActive = !group.isHidden;
                element.appendChild(document.createTextNode(key));
                list.appendChild(element);
            });
            container.appendChild(list);
            this.listen(container);
        },
        init: function () {
            if (document.getElementById(this.options.idMap)) {
                this.map = this.createMap(document.getElementById(this.options.idMap));
          
                this.userLocationMarker = this.createMarker();
                this.userLocationMarker.setClickable(true);
                this.userLocationMarker.icon = this.options.myLocationImgUrl;
                this.userLocationMarker.title = 'Estás acá';
                
                
                this.map.setCenter(this.toLatLng(this.options.defaultLocation).coords);
                this.groups = {};

                if ('geolocation' in navigator) {
                    this.getUserPosition();
                } else {
                    this.handleInitialLocationError();
                }

                this.createIcons();
                this.addMarkers();
            } else {
                console.error('Map placeholder not found.');
            }
            if (this.options.idControls && document.getElementById(this.options.idControls)) {
                this.addControls(document.getElementById(this.options.idControls));
            }

            return this;
        }
    });

    window.Donde = Donde;

}());