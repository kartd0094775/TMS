<!-- <script src="<?php print $baseUrl; ?>/js/snazzymaps.js"></script> -->

<?php

print $this -> printJson('items', $items);
?>

<style>
	.littleSpace {

		height: 2px;
	}

</style>

<!-- page header -->
<div class="pageheader ">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Outdoor heatmap</h2>

	<div class="breadcrumbs hide">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>" t>Home</a>
			</li>

			<!-- <li class="" t>
				<a href="<?php print $this -> getUrl('list'); ?>" t>Author list</a>
			</li> -->

			<li class="active" t>
				Outdoor heatmap
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

				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span></label>
				<div class="col-sm-10">
				<input type="text" class="form-control" name="name" />

				</div>
				</div> -->

			 

				

				<div class="form-group">

					<label for="fullname" class="col-sm-2 control-label" ><span t>Map</span></label>
					<div class="col-sm-10" style="position:relative">

						<!-- <button type="button" class="btn btn-danger" onclick="toggleHeatmap()">
						Toggle Heatmap
						</button> -->

						<div id="map" style="width:100%;height:700px;"></div>

						<script>
							function filterRecord() {

								var MSG = $('#msg').val();

								//get new data
								var url = getUrl('getGps');
								$.ajax({
									url : url,
									type : 'post',
									dataType : 'json',
									data : {
										MSG : MSG
									},
									success : function(r) {
										// items = r;

										heatmap.setMap(null);
										var qqq = r;

										var temp = [];

										for (var i in qqq) {
											temp.push(new google.maps.LatLng(qqq[i]['latitude'], qqq[i]['longitude']));
										}

										heatmap = new google.maps.visualization.HeatmapLayer({
											data : temp,
											map : map
										});

										// heatmap.setMap(null);
										// heatmap.setMap(temp);

										// resetHeatMapData();

									}
								});

							}

							function resetHeatMapData() {
								heatmap.setMap(null);

								heatmap.setMap(getPoints());

							}

							function changeGradient() {

								var gradient = ['rgba(0, 255, 255, 0)', 'rgba(0, 255, 255, 1)', 'rgba(0, 191, 255, 1)', 'rgba(0, 127, 255, 1)', 'rgba(0, 63, 255, 1)', 'rgba(0, 0, 255, 1)', 'rgba(0, 0, 223, 1)', 'rgba(0, 0, 191, 1)', 'rgba(0, 0, 159, 1)', 'rgba(0, 0, 127, 1)', 'rgba(63, 0, 91, 1)', 'rgba(127, 0, 63, 1)', 'rgba(191, 0, 31, 1)', 'rgba(255, 0, 0, 1)']

								gradient = [];
								$('*[name="gradient"]').each(function() {

									var v = $(this).val();
									gradient.push(v);

								});

								heatmap.set('gradient', gradient);
								// heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
							}

							var map;
							var heatmap;
							var markers = [];

							var bounds;
							function initMap() {
								bounds = new google.maps.LatLngBounds();
								map = new google.maps.Map(document.getElementById('map'), {
									center : {
										lat : 24,
										lng : 121.644
									},
									zoom : 8,
									styles : [{
										featureType : 'all',
										stylers : [{
											saturation : -80
										}]
									}, {
										featureType : 'road.arterial',
										elementType : 'geometry',
										stylers : [{
											hue : '#00ffee'
										}, {
											saturation : 50
										}]
									}, {
										featureType : 'poi.business',
										elementType : 'labels',
										stylers : [{
											visibility : 'off'
										}]
									}]

								});

								heatmap = new google.maps.visualization.HeatmapLayer({
									data : getPoints(),
									map : map,
									radius : 25

								});

								// for (var i in items) {
								//
								// var x = items[i];
								// var myLatlng = new google.maps.LatLng(x['latitude'], x['longitude']);
								// bounds.extend(myLatlng);
								//
								// markers[i] = new google.maps.Marker({
								// position : myLatlng,
								// map : map,
								// title : x['createTime'] + ' ' + x['memo']
								// });
								//
								// markers[i].setMap(map);
								//
								// }
								// map.fitBounds(bounds);

								/*
								 var myLatlng = new google.maps.LatLng(-25.363882, 131.044922);

								 var marker = new google.maps.Marker({
								 position : myLatlng,
								 map : map,
								 title : 'Hello World!'
								 });

								 marker.setMap(map);
								 */
							}

							// Heatmap data: 500 Points
							function getPoints() {

								var temp = [];

								for (var i in items) {

									temp.push(new google.maps.LatLng(items[i]['latitude'], items[i]['longitude']));
								}
								// log(temp);

								// return [new google.maps.LatLng(37.782551, -122.445368), new google.maps.LatLng(37.752986, -122.403112), new google.maps.LatLng(37.751266, -122.403355)];

								return temp;

							}

							function toggleHeatmap() {
								heatmap.setMap(heatmap.getMap() ? null : map);
							}

							function changeRadius() {
								var v = $('#radius').val();
								var radius = parseFloat(v);

								// heatmap.set('radius', heatmap.get('radius') ? null : 20);
								heatmap.set('radius', v);
							}

							function changeOpacity() {
								var v = $('#opacity').val();
								var opacity = parseFloat(v);

								// heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
								heatmap.set('opacity', opacity);
							}

						</script>
						<script async defer 		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNfbBmMtHh-liPkPDJ2H_liM4RCUohW10&signed_in=true&libraries=visualization&callback=initMap"></script>

					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Change Gradient</span></label>
					<div class="col-sm-10" >

						<input type="text" class="form-control" name="gradient" value="rgba(0, 255, 255, 0)">
						<div class="littleSpace"></div>
						<input type="text" class="form-control" name="gradient" value="rgba(0, 191, 255, 1)">
						<div class="littleSpace"></div>
						<input type="text" class="form-control" name="gradient" value="rgba(0, 127, 255, 1)">
						<div class="littleSpace"></div>
						<input type="text" class="form-control" name="gradient" value="rgba(0, 63, 255, 1)">
						<div class="littleSpace"></div>
						<!--
						<input type="text" class="form-control" name="gradient" value="rgba(0, 0, 255, 1)">
						<div class="littleSpace"></div>
						<input type="text" class="form-control" name="gradient" value="rgba(0, 0, 223, 1)">
						<div class="littleSpace"></div>
						<input type="text" class="form-control" name="gradient" value="rgba(0, 0, 191, 1)">
						<div class="littleSpace"></div>
						<input type="text" class="form-control" name="gradient" value="rgba(0, 0, 159, 1)">
						<div class="littleSpace"></div>

						<input type="text" class="form-control" name="gradient" value="rgba(0, 0, 127, 1)">
						<div class="littleSpace"></div>

						<input type="text" class="form-control" name="gradient" value="rgba(63, 0, 91, 1)">
						<div class="littleSpace"></div>

						<input type="text" class="form-control" name="gradient" value="rgba(127, 0, 63, 1)">
						<div class="littleSpace"></div>

						<input type="text" class="form-control" name="gradient" value="rgba(191, 0, 31, 1)">
						<div class="littleSpace"></div>

						<input type="text" class="form-control" name="gradient" value="rgba(255, 0, 0, 1)">
						<div class="littleSpace"></div> -->

						<button type="button" class="btn btn-info" onclick="changeGradient()">
							Change gradient
						</button>

					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Heatmap radius</span></label>
					<div class="col-sm-10" >

						<input type="number" class="form-control" name="radius" id="radius" value="20">
						<button type="button" class="btn btn-success" onclick="changeRadius()">
							Change radius
						</button>

					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Heatmap opacity</span></label>
					<div class="col-sm-10" >

						<input type="number" class="form-control" name="opacity" id="opacity" value="0.5">
						<button type="button" class="btn btn-warning" onclick="changeOpacity()">
							Change opacity
						</button>

					</div>
				</div>
				
		</div>

		<!-- <div class="form-group form-footer">
		<div class="col-sm-12 text-center">
		<button class="btn btn-default" type="submit" t>
		Save
		</button>

		</div>
		</div> -->
		</form>

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

