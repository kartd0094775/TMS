<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;

	// unset($data['password']);

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

<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Outdoor details</h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="" t>
				<a href="<?php print $this -> url('list'); ?>" t>Outdoor list</a>
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

			<form role="form" class="form-horizontal" parsley-validate id="form" method="post" action="<?php print $this -> url('updateDo'); ?>" enctype="multipart/form-data" >

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

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="name" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Building</span></label>
					<div class="col-sm-10">
						<select name="buildingID"  class="chosen-select form-control" >
							<!-- <option value="">----</option> -->
							<?php
							$c = new Criteria;
							if (!$this -> isAdminRole()) {
								$buildingIDs = explode(',', $this -> admin['buildingIDs']);
								$c -> addInCondition('t.id', $buildingIDs);
							}
							$items = Building::model() -> findAll($c);

							foreach ($items as $x) {
								print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Type</span></label>
					<div class="col-sm-10">
						<select name="typeID"  class="chosen-select form-control" >
							<!-- <option value="">----</option> -->
							<?php print $this -> printTypeOption('outdoor.type'); ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Latitude</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="latitude"  readonly="" id="latitude" />
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Longitude</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="longitude"  readonly="" id="longitude"/>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Map</span></label>
					<div class="col-sm-10" >

						<div style="margin-bottom:10px">
							Search Address

							<input type="text" id="searchAddress" class=" form-control" style="display:inline-block;max-width:300px;" onkeypress="searchAddressEvent(event)"/>

						</div>

						<div id="map" style="width:100%;height:500px;margin-top:10px"></div>
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

								if (data != null) {
									map = new google.maps.Map(document.getElementById('map'), {
										center : {
											lat : parseFloat(data.latitude),
											lng : parseFloat(data.longitude)
										},
										clickableIcons : false,
										zoom : 8
									});
								} else {

									map = new google.maps.Map(document.getElementById('map'), {
										center : {
											lat : 24,
											lng : 121.644
										},
										zoom : 8
									});
								}

								// map.fitBounds(bounds);

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

								if (data != null) {
									//add marker
									var latitude = data.latitude;
									var longitude = data.longitude;

									latitude = parseFloat(data.latitude);
									longitude = parseFloat(data.longitude);
									var myLatlng = new google.maps.LatLng(latitude, longitude);
									placeMarker(myLatlng);

								}

							}

							function setMapOnAll(map) {
								for (var i = 0; i < markers.length; i++) {
									markers[i].setMap(map);
								}
							}

							// Removes the markers from the map, but keeps them in the array.
							function clearMarkers() {
								setMapOnAll(null);
							}

							function placeMarker(location) {

								clearMarkers();

								var marker = new google.maps.Marker({
									position : location,
									map : map
								});
								markers[0] = marker;
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

					</div>
				</div>

				<hr>

				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>公司照片</span></label>
				<div class="col-sm-10">

				<span class="btn btn-success fileinput-button" onclick="$('#uploadPhoto').click()"> <i class="fa fa-plus"></i> <span> 選擇照片</span> </span>
				<input type="file" class="form-control hide"  name="uploadPhoto" id="uploadPhoto">

				</div>
				</div> -->

				<div class="form-group form-footer">
					<div class="col-sm-12 text-center">
						<button class="btn btn-default" type="submit" t>
							Save
						</button>

					</div>
				</div>

			</form>

		</div>
		<!-- /tile body -->

	</section>

</div>

<script>
	//
	// function checkForm() {
	// $('#itemForm').submit();
	// return;
	//
	// if (isCreate) {
	//
	// //create
	// var email = $('#email').val();
	// var password = $('#password').val();
	// var name = $('#name').val();
	// var divisionID = $('#divisionID').val();
	//
	// var isOk = true;
	// var message = '';
	//
	// if (divisionID == '') {
	// message += "Please select Agency.\n";
	// isOk = false;
	// }
	// if (email == '') {
	// message += "Please fill in Email.\n";
	// isOk = false;
	// }
	//
	// if (password == '') {
	// message += "Please fill in Password.\n";
	// isOk = false;
	// }
	//
	// if (name == '') {
	// message += "Please fill in Full Name.\n";
	// isOk = false;
	// }
	//
	// if ($('#tableLicense tbody tr').length <= 0) {
	// message += "Please fill in License at least one.\n";
	// isOk = false;
	// }
	//
	// if ($('#tableDuty tbody tr').length <= 0) {
	// message += "Please fill in Document at least one.\n";
	// isOk = false;
	// }
	//
	// if (isOk) {
	//
	// var email = $('#email').val();
	//
	// var url = baseUrl + '/' + controllerName + '/checkEmail';
	// $.ajax({
	// url : url,
	// type : 'post',
	// // dataType : 'json',
	// data : {
	// email : email
	// },
	// success : function(r) {
	// if (r == 'true') {
	// $('#itemForm').submit();
	// } else {
	// alert('Email has been taken.');
	// }
	//
	// }
	// });
	//
	// } else {
	// alert(message);
	// }
	//
	// } else {
	//
	// //update
	// var email = $('#email').val();
	// var id = $('#id').val();
	//
	// var url = baseUrl + '/' + controllerName + '/checkEmail';
	// $.ajax({
	// url : url,
	// type : 'post',
	// // dataType : 'json',
	// data : {
	// email : email,
	// id : id
	// },
	// success : function(r) {
	// if (r == 'true') {
	// $('#itemForm').submit();
	// } else {
	// alert('Email has been taken.');
	// }
	//
	// }
	// });
	//
	// }
	//
	// }

	function searchAddressEvent(e) {

		if (e.which == 13) {
			e.preventDefault();

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

		} else {

		}

		$('#companyIntroduce').summernote({
			toolbar : [['style', ['style']], // no style button
			['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['insert', ['picture', 'link']], // no insert buttons
			['table', ['table']], // no table button
			['help', ['help']] //no help button
			],
			height : 500 //set editable area's height
		});

		//set is read
		setIsRead('itemForm', isRead);

	}); 
</script>
<script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyBNfbBmMtHh-liPkPDJ2H_liM4RCUohW10&callback=initMap" async defer></script>
