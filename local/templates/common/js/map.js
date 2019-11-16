ymaps.ready(function(){
    let map = new obMap({
        mapId: "map",
        mapCenter: [52.62885564, 39.5280958],
        mapZoom: 17
    });
    map.setMarkerInfo([
        {
            coords: [52.62885564, 39.5280958]
        }
    ]);
    map.initMap();
    map.obMap.behaviors.disable('scrollZoom');
});
