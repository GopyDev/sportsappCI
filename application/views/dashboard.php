<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-bar-chart"></i>
              <h3> Stats</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  <div id="big_stats" class="cf">
                    <div class="stat"> <i class="icon-map-marker"></i> <span class="value"><?php echo $events_count; ?></span> </div>
                    <!-- .stat -->
                    
                    <div class="stat"> <i class="icon-user"></i> <span class="value"><?php echo $users_count; ?></span> </div>
                    <!-- .stat -->
                    
                    <div class="stat"> <i class="icon-bell"></i> <span class="value">0</span> </div>
                    <!-- .stat -->
                  </div>
                </div>
                <!-- /widget-content --> 
                
              </div>
            </div>
          </div>
          <!-- /widget -->
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-globe"></i>
              <h3> Map</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div id="mapdiv"><div id="popup"></div></div>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
        </div>
        <!-- /span6 -->
        <div class="span6">
          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Important Shortcuts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="shortcuts">
                <a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-map-marker"></i><span class="shortcut-label">Events</span> </a>
                <a href="<?php echo site_url("users"); ?>" class="shortcut"><i class="shortcut-icon icon-user"></i><span class="shortcut-label">Users</span> </a>
                <a href="javascript:;" class="shortcut disabled" data-toggle="tooltip" data-placement="top" title="Coming soon!"><i class="shortcut-icon icon-bell"></i><span class="shortcut-label">Notifications</span> </a>
                <a href="http://codecanyon.net/user/bandst/portfolio?ref=bandst" class="shortcut" target="_blank"><i class="shortcut-icon icon-link"></i><span class="shortcut-label">B&amp;ST Items</span> </a>
              </div>
              <!-- /shortcuts --> 
            </div>
            <!-- /widget-content --> 
          </div>
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Recent News</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <ul class="news-items">
              </ul>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
        </div>
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
<script>  
function read_news(data) {    
    $.each(data.news, function(index, element) {
        $('.news-items').append(
          '<li><div class="news-item-date"><span class="news-item-day">'+element.day+'</span> <span class="news-item-month">'+element.month+'</span> </div>'+
            '<div class="news-item-detail"> <a href="'+element.url+'" class="news-item-title" target="_blank">'+element.title+'</a>'+
              '<p class="news-item-preview">'+element.description+'</p></div></li>'
        );
    });
}

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();   
  
  $.ajax({ 
      type: 'GET', 
      url: 'http://www.bandst.com/api/news.json', 
      dataType: 'jsonp'
  });
  
  var iconStyle = new ol.style.Style({
    image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
      anchor: [0.5, 1.0],
      anchorXUnits: 'fraction',
      anchorYUnits: 'fraction',
      opacity: 0.9,
      src: '<?php echo base_url(); ?>assets/img/marker1.png'
    }))
  });
  
  var features = [];
  
  <?php foreach ($events as $event) : ?>
  
  features.push(new ol.Feature({
    geometry: new ol.geom.Point(ol.proj.transform([<?php echo $event->lng.','.$event->lat; ?>], 'EPSG:4326', 'EPSG:3857')),
    name: '<?php echo $event->title; ?>',
    data: { poi_id: <?php echo $event->id; ?> },
  }));

  <?php endforeach; ?>
  
  var vectorSource = new ol.source.Vector({
    features: features
  });
  
  var vectorLayer = new ol.layer.Vector({
    source: vectorSource,
    style: iconStyle
  });
  
  var map = new ol.Map({
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          }),
          vectorLayer
        ],
        target: document.getElementById('mapdiv'),
        interactions: ol.interaction.defaults({mouseWheelZoom:false}),
        view: new ol.View({
          center: [0, 0],
          zoom: 3
        })
  });

  var element = document.getElementById('popup');
  
  var popup = new ol.Overlay({
    element: element,
    positioning: 'bottom-center',
    stopEvent: false
  });
  map.addOverlay(popup);
  
  // display popup on click
  map.on('click', function(evt) {
    var pixel = map.getEventPixel(evt.originalEvent);
    var feature = map.forEachFeatureAtPixel(pixel,
        function(feature, layer) {
          return feature;
        });
    if (feature) {console.log()
      location.href='<?php echo site_url('event'); ?>/'+feature.get('data').poi_id;
    } else {
    }
  });
  
  // change mouse cursor when over marker
  $(map.getViewport()).on('mousemove', function(e) {
    var pixel = map.getEventPixel(e.originalEvent);
    var feature = map.forEachFeatureAtPixel(pixel,
        function(feature, layer) {
          return feature;
        });
    if (feature) {
      map.getTarget().style.cursor = 'pointer';
      var geometry = feature.getGeometry();
      var coord = geometry.getCoordinates();
      popup.setPosition(coord);
      $(element).popover({
        'placement': 'top',
        'html': true,
        'content': feature.get('name')
      });
      $(element).popover('show');
    } else {
      map.getTarget().style.cursor = '';
      $(element).popover('destroy');
    }
  });
  
  map.getView().fit(vectorSource.getExtent(), map.getSize()); 
  
});
</script>