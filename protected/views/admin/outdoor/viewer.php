<?php

$temp = null;

if (is_array($items)) {
	foreach ($items as $x) {
		$temp[] = $x -> attributes;

	}
}

print $this -> printJson('items', $temp);
print $this -> printJson('type', $this -> getType('outdoor.type'));

$temp = null;
$items = Building::model() -> findAll();

foreach ($items as $x) {
	$temp[$x['id']] = $x['name'];

}

print $this -> printJson('building', $temp);
?>
<style>
	.infoContentLink {
		color: #333;
	}
</style>

<!-- page header -->
<div class="pageheader ">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Outdoor details</h2>

	<div class="breadcrumbs hide">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>" t>Home</a>
			</li>

			<li class="" t>
				<a href="<?php print $this -> getUrl('list'); ?>" t>Author list</a>
			</li>

			<li class="active" t>
				Outdoor details
			</li>

		</ol>
	</div>

</div>
<!-- /page header -->

<div class="main">

	<section class="tile color transparent-black">

		<!-- tile body -->
		<div class="tile-body">

			<!-- <form role="form" class="form-horizontal" parsley-validate id="form" method="post" action="<?php print $this -> url('updateDo'); ?>" enctype="multipart/form-data" > -->

			<input type="hidden" name="id" />
			<!-- <div class="form-group">
			<label for="fullname" class="col-sm-2 control-label" t><span>zzzzzzzzz</span> *</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="zzzzzzzzzzzzz" name="zzzzzzzzzzzzz" parsley-trigger="change" parsley-required="true" />
			</div>
			</div> -->

			<!--
			<div class="form-group">
			<label for="fullname" class="col-sm-2 control-label" ><span t>公司名稱</span></label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="companyName" name="companyName" />
			</div>
			</div>

			<div class="form-group">
			<label for="fullname" class="col-sm-2 control-label" ><span t>公司概況</span></label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="companySituation" name="companySituation" />
			</div>
			</div>
			-->

			<!-- <div class="form-group">
			<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span></label>
			<div class="col-sm-10">
			<input type="text" class="form-control" name="name" />

			</div>
			</div> -->

			<div class="form-group">
				<!-- <label for="fullname" class="col-sm-2 control-label" ><span t>Map</span></label> -->
				<div class="col-sm-2" style="">

					<div class="form-group">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Name</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="name" id="name"/>
						</div>
					</div>
					<div class="form-group">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Building</span></label>
						<div class="col-sm-8">
							<select name="buildingID" id="buildingID" class="chosen-select form-control"  >
								<!-- <option value="">----</option> -->
								<?php
								$c = new Criteria;
								// $c->condition='postID=:';
								// $c->params=array(':postID'=>10);
								// $c -> order = 'id DESC';
								$items = Building::model() -> findAll($c);

								foreach ($items as $x) {
									print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Type</span></label>
						<div class="col-sm-8">
							<select name="typeID" id="typeID"  class="chosen-select form-control" >
								<!-- <option value="">----</option> -->
								<?php print $this -> printTypeOption('outdoor.type'); ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Lat</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="latitude" readonly="" id="latitude" />
						</div>
					</div>
					<div class="form-group">
						<label for="fullname" class="col-sm-4 control-label" ><span t>Lng</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="longitude" readonly="" id="longitude"/>
						</div>
					</div>
					<div class="form-group text-center">
						<button class="btn btn-success" type="button" onclick="createDo()" t>
							Create
						</button>
					</div>

				</div>

				<div class="col-sm-10" style="position:relative">
					<!--
					<a type="button" class="btn btn-success" href="<?php print $this -> getUrl('map'); ?>"> ALL </a>
					<a type="button" class="btn btn-info" href="<?php print $this -> getUrl('map?type=wifi'); ?>"> Wifi </a>
					<a type="button" class="btn btn-danger"  href="<?php print $this -> getUrl('map?type=beacon'); ?>"> Bluetooth beacon </a> -->
					<div style="margin-bottom:10px">
						Filter
						<select name="filterBuildingID" id="filterBuildingID" onchange="onBuildingChange()" class="chosen-select form-control" style="display:inline-block;width:auto;">
							<option value="0">ALL</option>
							<?php
							$c = new Criteria;
							// $c->condition='postID=:';
							// $c->params=array(':postID'=>10);
							// $c -> order = 'id DESC';
							$items = Building::model() -> findAll($c);

							foreach ($items as $x) {
								print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
							}
							?>
						</select>
					</div>
					<div style="margin-bottom:10px">
						Search Address

						<input type="text" id="searchAddress" class=" form-control" style="display:inline-block;max-width:300px;" onkeypress="searchAddressEvent(event)"/>
					</div>

					<div id="map" style="width:100%;height:700px;margin-top:10px"></div>
					<script>
						var map;
						var markers = [];
						var infoWindows = [];
						var geocoder;

						var previousInfoWindow = null;

						var bounds;
						function initMap() {
							geocoder = new google.maps.Geocoder();

							bounds = new google.maps.LatLngBounds();
							map = new google.maps.Map(document.getElementById('map'), {
								center : {
									lat : 24,
									lng : 121.644
								},
								clickableIcons : false,
								zoom : 8
							});

							google.maps.event.addListener(map, "click", function(e) {

								//lat and lng is available in e object
								var latLng = e.latLng;

								// log(latLng);
								// log(latLng.lat());
								// log(latLng.lng());
								var latitude = latLng.lat();
								var longitude = latLng.lng();
								$('#latitude').val(latitude);
								$('#longitude').val(longitude);

								placeMarker(e.latLng);

							});

							for (var i in items) {

								var x = items[i];
								addMarker(x, i);

							}
							map.fitBounds(bounds);

						}

						function addMarker(x, i) {

							var myLatlng = new google.maps.LatLng(x['latitude'], x['longitude']);
							bounds.extend(myLatlng);

							infoWindows[i] = new google.maps.InfoWindow({
								content : '<a target="_blank" href="' + baseUrl + '/admin/macMessage/setMac?mac=' + 'ccc' + '" class="infoContentLink" >Set MAC<br>' + 'xxx' + '</div>'
							});

							markers[i] = new google.maps.Marker({
								position : myLatlng,
								map : map,
								title : x['createTime']
								// icon : markerIcon

							});

							// markers[i].addListener('click', function() {
							// infoWindows[i].open(map, markers[i]);
							// });

							var html = '';
							html += '<div>Name: ' + x['name'] + '</div>';
							html += '<div>Building: ' + building[x['buildingID']] + '</div>';
							html += '<div>Type: ' + v(type[x['typeID']]) + '</div>';
							html += '<div>Latitude: ' + x['latitude'] + '</div>';
							html += '<div>Longitude: ' + x['longitude'] + '</div>';
							html += '<div style="margin-top:10px" class="text-right"><button class="btn btn-danger" onclick="deleteDo(' + x['id'] + ')">delete</button></div>';

							addInfoWindow(markers[i], html);

							markers[i].setMap(map);

						}

						var previewMarker = [];
						function placeMarker(location) {

							clearMarkers();

							var marker = new google.maps.Marker({
								position : location,
								map : map
							});
							previewMarker[0] = marker;
						}

						function setMapOnAll(map) {
							for (var i = 0; i < previewMarker.length; i++) {
								previewMarker[i].setMap(map);
							}
						}

						// Removes the markers from the map, but keeps them in the array.
						function clearMarkers() {
							setMapOnAll(null);
						}

						function addInfoWindow(marker, message) {

							var infoWindow = new google.maps.InfoWindow({
								content : message
							});

							previousInfoWindow = infoWindow;

							google.maps.event.addListener(marker, 'click', function() {

								if (previousInfoWindow != null) {
									previousInfoWindow.close();
								}

								previousInfoWindow = infoWindow;

								infoWindow.open(map, marker);
							});
						}

					</script>
					<script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyBNfbBmMtHh-liPkPDJ2H_liM4RCUohW10&callback=initMap" 	async defer></script>

				</div>
			</div>

			<!-- <div class="form-group form-footer">
			<div class="col-sm-12 text-center">
			<button class="btn btn-default" type="submit" t>
			Save
			</button>

			</div>
			</div> -->
			<!-- </form> -->

		</div>
		<!-- /tile body -->

	</section>

</div>

<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;

	// $data['languageRequireIDs'] = explode(',', $item['languageRequireIDs']);
	// $data['keywordIDs'] = explode(',', $item['keywordIDs']);
	// $data['specialIDs'] = explode(',', $item['specialIDs']);

	// $data['createUserName'] = $createUser['name'];
	// $data['updateUserName'] = $updateUser['name'];

	$isCreate = false;
} else {
	$data = null;
}

print $this -> printJson('data', $data);
print $this -> printJson('isCreate', $isCreate);
print $this -> printJson('isRead', $this -> isItemRead);
?>
<script>
	function onBuildingChange() {

		var buildingID = $('#filterBuildingID').val();

		for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(null);
		}

		for (var i in items) {

			var x = items[i];

			if (buildingID == '0') {
				addMarker(x, i);
			} else {
				if (x['buildingID'] == buildingID) {
					addMarker(x, i);
				}

			}
		}

	}

	function createDo() {

		var name = $('#name').val();
		var latitude = $('#latitude').val();
		var longitude = $('#longitude').val();
		var typeID = $('#typeID').val();
		var buildingID = $('#buildingID').val();

		var isOK = true;
		var message = '';
		if (name == '') {
			isOK = false;
			message = "請輸入名稱\n";
		}
		if (latitude == '' || longitude == '') {
			isOK = false;
			message = "請選擇位置\n";
		}
		if (typeID == '') {
			isOK = false;
			message = "請輸入種類\n";
		}

		if (isOK) {
			var url = getUrl('updateDo');
			$.ajax({
				url : url,
				type : 'post',
				// dataType : 'json',
				data : {
					id : 0,
					name : name,
					latitude : latitude,
					longitude : longitude,
					typeID : typeID,
					buildingID : buildingID
				},
				success : function(r) {
					//qqq
					alert('新增成功');
					location.reload();

				}
			});
		} else {
			alert(message);

		}
	}

	function deleteDo(id) {

		if (confirm('確認刪除?')) {
			var url = getUrl('deleteDo');
			$.ajax({
				url : url,
				type : 'post',
				dataType : 'json',
				data : {
					id : id
				},
				success : function(r) {
					//qqq
					alert('已刪除');

				}
			});

		}
	}

	function searchAddressEvent(e) {

		if (e.which == 13) {

			var address = $('#searchAddress').val();

			geocoder.geocode({
				'address' : address
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {

					placeMarker(results[0].geometry.location);

					var latLng = results[0].geometry.location;

					//move map
					map.setCenter(results[0].geometry.location);

					// log(results[0].geometry.location);

					$('#latitude').val(latLng.lat());
					$('#longitude').val(latLng.lng());
					

				} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
			});

		}
	}


	$(document).ready(function() {

		if (data != null) {
			assignFormValue('form', data);

			// for (var i in data['specialIDs']) {
			// var x = data['specialIDs'][i];
			// $('*[name="specialIDs[]"][value="' + x + '"]').prop('checked', true);
			// }
			//
			// for (var i in data['languageRequireIDs']) {
			// var x = data['languageRequireIDs'][i];
			// $('*[name="languageRequireIDs[]"][value="' + x + '"]').prop('checked', true);
			// }
			//
			// for (var i in data['keywordIDs']) {
			// var x = data['keywordIDs'][i];
			// $('*[name="keywordIDs[]"][value="' + x + '"]').prop('checked', true);
			// }

		} else {

		}

		//set is read
		setIsRead('itemForm', isRead);

	}); 
</script>
