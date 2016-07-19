/*
 * Copyright (c) 2015 webware,Inc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
(function(global) {
    "use strict";

    function OpenppMap(mapId) {
        this._mapId = mapId;
        this._map = null;

        this._viewProjection = 'EPSG:3857';
        this._geoProjection = 'EPSG:4326';
        this._initialCenter = [139.699103, 35.659528];
        this._initialZoom = 16;
        this._pointer = null;
        this._circle = null;
        this._geoJSON = null;
    }

    var p = OpenppMap.prototype;

    p.initialize = function() {
        this._map = new ol.Map({
            target: document.getElementById(this._mapId),
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                })
            ],
            view: new ol.View({
                center: ol.proj.transform(
                    this._initialCenter,
                    this._geoProjection,
                    this._viewProjection
                ),
                zoom: this._initialZoom
            })
        });

        this._geoJSON = new ol.format.GeoJSON();
    };

    p.addPointer = function(lonLat, geometryInputId, rgeocodeInputId, fixed) {
        if (lonLat) {
            lonLat = ol.proj.transform(
                lonLat,
                this._geoProjection,
                this._viewProjection
            );
            this._map.getView().setCenter(lonLat);
        }

        var point = new ol.geom.Point(this._map.getView().getCenter(), 'XY');
        this._pointer = new ol.Feature({
            geometry: point
        });

        var iconStyle = new ol.style.Style({
            image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                anchor: [0.5, 1],
                anchorXUnits: 'fraction',
                anchorYUnits: 'fraction',
                opacity: 0.85,
                src: '/bundles/openppmap/images/marker.png'
            }))
        });

        this._pointer.setStyle(iconStyle);

        var vectorSource = new ol.source.Vector({
            features: [this._pointer]
        });

        var vectorLayer = new ol.layer.Vector({
            source: vectorSource
        });

        this._map.addLayer(vectorLayer);

        var pt = new ol.geom.Point(this._map.getView().getCenter(), 'XY').transform(
            this._viewProjection,
            this._geoProjection);

        if (geometryInputId) {
            this._setGeoJSON(geometryInputId, pt);
        }

        if (rgeocodeInputId) {
            this._setRgeocode(rgeocodeInputId, pt);
        }

        if (!fixed) {
            this._map.on("click", function(event) {
                var po = new ol.geom.Point(event.coordinate, 'XY');
                this._pointer.setGeometry(po);
                vectorSource.clear();
                vectorSource.addFeature(this._pointer);

                var pi = new ol.geom.Point(event.coordinate, 'XY').transform(
                        this._viewProjection,
                        this._geoProjection);

                if (geometryInputId) {
                    this._setGeoJSON(geometryInputId, pi);
                }

                if (rgeocodeInputId) {
                    this._setRgeocode(rgeocodeInputId, pi);
                }

                if (this._circle) {
                    this.drawCircle();
                }
            }, this);
        }
    };

    p._setGeoJSON = function(geometryInputId, geometry) {
        var geoJsonStr = this._geoJSON.writeGeometry(geometry);
        $("#" + geometryInputId).val(geoJsonStr);
    };

    p._setRgeocode = function(rgeocodeInputId, point) {
        var coor = point.getCoordinates();
        this._rgeocoding(coor[0], coor[1], function(data) {
            $("#" + rgeocodeInputId).val(data);
        })
    };

    p._rgeocoding = function(lon, lat, callback) {
        var self = this;
        $.ajax({
            type:'GET',
            url: 'http://www.finds.jp/ws/rgeocode.php',
            data: {
                "json": true,
                "lon" : lon,
                "lat" : lat,
                "lr"  : 100,
            },
            dataType: "json"
        }).done(function(data) {
            callback(self._findsJpRgeoJSONToAddress(data));
        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.status + ' ' +  errorThrown);
            callback(null);
        });
    };

    p._findsJpRgeoJSONToAddress = function(json) {
        var result = json.result;
        if (result) {
            var address = result.prefecture.pname + result.municipality.mname.replace(' ', '');
            if (result.local != undefined) {
                address = address + result.local[0].section + result.local[0].homenumber;
            }

            return address;
        }

        return null;
    };

    p.drawCircle = function(center, radiusInMeter) {
        if (!center) {
            if (this._pointer) {
                center = this._pointer.getGeometry().getCoordinates();
            } else {
                return;
            }
        } else {
            center = ol.proj.transform(
                center,
                this._geoProjection,
                this._viewProjection
            );
        }

        var radius;
        if (!radiusInMeter) {
            if (this._circle) {
                radius = this._circle.getGeometry().getRadius();
            } else {
                return;
            }
        } else {
            var view = this._map.getView();
            var projection = view.getProjection();
            var resolutionAtEquator = view.getResolution();
            var pointResolution = projection.getPointResolution(resolutionAtEquator, center);
            var resolutionFactor = resolutionAtEquator/pointResolution;
            radius = (radiusInMeter / ol.proj.METERS_PER_UNIT.m) * resolutionFactor;
        }

        if (this._circle) {
            this._circle.getGeometry().setCenter(center);
            this._circle.getGeometry().setRadius(radius);
        } else {
            this._circle = new ol.Feature(
                new ol.geom.Circle(center, radius)
            );

            var opacity = 0.85;
            var circleStyle = new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'rgba(255, 0, 0, ' + opacity + ')',
                    width: 1,
                    opacity: opacity
                })
            });

            this._circle.setStyle(circleStyle);

            var vectorSource = new ol.source.Vector({
                features: [this._circle]
            });

            var vectorLayer = new ol.layer.Vector({
                source: vectorSource
            });

            this._map.addLayer(vectorLayer);
        }
    }

    global.OpenppMap = OpenppMap;

})((this || 0).self || global);