<div class="main">	
	<div class="main-inner">
	    <div class="container">
			
		<?php if (isset($message) && $message!='') { ?>
		<div class="alert">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?php echo $message; ?>
		</div>
		<?php } ?>
		
	      <div class="row">
	      	<div class="span12">      		
	      		<div class="widget ">
	      			<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3>Create event <small>Please enter the event information below.</small></h3>
	  				</div> <!-- /widget-header -->
					<div class="widget-content">
						
<?php echo form_open("pois/create_poi", array("class"=>"form-horizontal"));?>
      <fieldset>										
            <div class="control-group">											
                <label class="control-label" for="title">Title</label>
                <div class="controls">
                    <input type="text" name="title" class="span6" id="title" value="<?php echo $poititle["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->					
            <div class="control-group">											
                <label class="control-label" for="brief_description">Short description</label>
                <div class="controls">
                    <input type="text" name="brief_description" class="span6" id="brief_description" value="<?php echo $brief_description["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->		
            <div class="control-group">											
                <label class="control-label" for="description">Description</label>
                <div class="controls">
                    <textarea placeholder="Write here..." name="description" class="span6" id="description"><?php echo $description["value"]; ?></textarea>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            <div class="control-group">											
                <label class="control-label" for="location">Location</label>
                <div class="controls">
					<div id="mapdiv"></div>
					<small>Click on the map to place the marker or write an address below and press Locate</small>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label" for="address">Address</label>
                <div class="controls">
                    <input type="text" name="address" class="span5" id="address" value="<?php echo $address["value"]; ?>">
					<button class="btn btn-info" type="button" id="locate">Locate</button>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label" for="url">URL</label>
                <div class="controls">
                    <input type="text" name="url" class="span6" id="url" value="<?php echo $url["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label" for="phone">Phone</label>
                <div class="controls">
                    <input type="text" name="phone" class="span6" id="phone" value="<?php echo $phone["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label" for="email">E-mail</label>
                <div class="controls">
                    <input type="email" name="email" class="span6" id="email" value="<?php echo $email["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label" for="start_date_time">Start time</label>
                <div class="controls">
					<input type='text' id="start_date_time" name="start_date_time" value="<?php echo $start_date_time["value"]; ?>" />
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label" for="end_date_time">End time</label>
                <div class="controls">
					<input type='text' id="end_date_time" name="end_date_time" value="<?php echo $end_date_time["value"]; ?>" />
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label"></label>
                <div class="controls">
                 <button type="submit" class="btn btn-success">Create event</button>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->                        
      </fieldset>
    
		<?php echo form_input(array('name' => 'lat', 'type'=>'hidden', 'id' =>'lat', 'value'=>$lat['value'])); ?>
        <?php echo form_input(array('name' => 'lng', 'type'=>'hidden', 'id' =>'lng', 'value'=>$lng['value'])); ?>

<?php echo form_close();?>	
						
					</div> <!-- /widget-content -->
				</div> <!-- /widget -->
		    </div> <!-- /span8 -->
	      </div> <!-- /row -->
	    </div> <!-- /container -->
	</div> <!-- /main-inner -->
</div> <!-- /main -->
<script>
	$(document).ready(function() {
        $('#description').wysihtml5({image:false, html:true});
		$('#start_date_time').datetimepicker();
		$('#end_date_time').datetimepicker();
		
		$(window).keydown(function(event){
			if(event.keyCode == 13) {
			  event.preventDefault();
			  return false;
			}
		});
		
		function locate() {			
			$.ajax({ 
				type: 'GET', 
				url: 'http://nominatim.openstreetmap.org/search?q='+$('#address').val()+'&format=json&limit=1&polygon=0&addressdetails=1', 
				dataType: 'json',
				success: function(data) {
					if (data.length>=1) {
                        var poi = data[0];
						$("#lat").val(poi.lat);
						$("#lng").val(poi.lon);
						
						vectorSource.clear();
						var feature = new ol.Feature({
							geometry: new ol.geom.Point(ol.proj.transform([parseFloat(poi.lon), parseFloat(poi.lat)], 'EPSG:4326', 'EPSG:3857')),
						});
						vectorSource.addFeature(feature);
						console.log(feature)
						map.getView().fit(vectorSource.getExtent(), map.getSize()); 
						map.getView().setZoom(16);
                    }
				}
			});
		}
		
		$('#address').keydown(function(e) {
			if(e.keyCode == 13) {
			  e.preventDefault();
			  locate();
			}
		});
		
		$('#locate').click(function() {
			locate();
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
		
		<?php if (isset($lat["value"]) &&  $lat["value"]!='' && isset($lng["value"]) && $lng["value"]!='') { ?>
		var feature = new ol.Feature({
			geometry: new ol.geom.Point(ol.proj.transform([<?php echo $lng["value"].','.$lat["value"]; ?>], 'EPSG:4326', 'EPSG:3857')),
		});
		<?php } ?>
  
		var vectorSource = new ol.source.Vector({
		  features: [ <?php if (isset($lat["value"]) &&  $lat["value"]!='' && isset($lng["value"]) && $lng["value"]!='') { ?>feature<?php } ?> ]
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
				zoom: 1
			  })
		});
		
		map.on('click', function(evt) {
			vectorSource.clear();
			var feature = new ol.Feature({
				geometry: new ol.geom.Point(evt.coordinate),
			});
			vectorSource.addFeature(feature);
			var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
			var lon = lonlat[0];
			var lat = lonlat[1];
			$('#lat').val(lat);
			$('#lng').val(lon);
		});
		
		<?php if (isset($lat["value"]) &&  $lat["value"]!='' && isset($lng["value"]) && $lng["value"]!='') { ?>
		map.getView().fit(vectorSource.getExtent(), map.getSize()); 
		map.getView().setZoom(16);
		<?php } ?>
    });
</script>
