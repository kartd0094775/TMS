<script src="<?php print $b; ?>/js/highcharts/highcharts.js"></script>
<script src="<?php print $b; ?>/js/highcharts/modules/data.js"></script>
<script src="<?php print $b; ?>/js/highcharts/modules/drilldown.js"></script>
<script src="<?php print $b; ?>/js/highcharts/modules/exporting.js"></script>
<script type="text/javascript">
	$(function() {

	}); 
</script>

<!-- <script language="javascript" type="text/javascript" src="<?php print $b; ?>/js/jquery.js"></script> -->
<script language="javascript" type="text/javascript" src="<?php print $b; ?>/js/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="<?php print $b; ?>/js/jquery.flot.categories.js"></script>

<?php

print $this -> printJson('points', $data);
print $this -> printJson('floorName', $item['name']);
print $this -> printJson('floorID', $item['id']);

// print $this -> printJson('wifiCount', $wifiCount);
// print $this -> printJson('beaconCount', $beaconCount);
?>
<style>
	.demo-placeholder {
		width: 100%;
		height: 300px;
		font-size: 14px;
		line-height: 1.2em;
	}

	.infoContentLink {
		color: #333;
	}
	#exportResult {
		display: none;
		/*height: 500px;*/
		/*overflow: auto;*/
	}
</style>

<!-- page header -->
<div class="pageheader ">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Floor Statistics</h2>

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
				Floor Statistics
			</li>

		</ol>
	</div>

</div>
<!-- /page header -->

<div class="main">

	<section class="tile color transparent-black">

		<!-- tile body -->
		<div class="tile-body">

			<div id="zzz" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

			<form role="form" class="form-horizontal" parsley-validate id="form" method="post"  enctype="multipart/form-data" >

				<input type="hidden" name="id" id="id"/>
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

						<div class="form-control fieldDisplay">
							<?php print $item['name']; ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Export Date From</span></label>
					<div class="col-sm-10">

						<input type="text" class="form-control datepicker" name="exportFrom" id="exportFrom"/>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Export Date To</span></label>
					<div class="col-sm-10">

						<input type="text" class="form-control datepicker" name="exportTo" id="exportTo"/>

					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t></span></label>
					<div class="col-sm-10">

						<button class="btn btn-success" type="button" onclick="displayExcel()">
							Display
						</button>
						<button class="btn btn-info" type="button" onclick="displayPie()">
							Pie Chart
						</button>
						<button class="btn btn-danger" type="button" onclick="displayBar()">
							Bar Chart
						</button>
						<button class="btn btn-primary" type="button" onclick="displayGantt()">
							Gantt Chart
						</button>
						<span style="margin:0px 10px">|</span>
						<button class="btn btn-warning" type="button" onclick="exportExcel()" >
							Export Excel
						</button>

						<div style="height:20px"></div>
						<div id="chartUnit" style="display:none">
							單位: 小時
						</div>

						<div id="exportResult" style="margin-top:5px;border-radius:10px">

							<div id="pieChartContainer"  style="background:#fff; display:none; padding:20px 20px;height:300px;padding:20px 0px;" >

							</div>

							<div id="barChartContainerFrame" style="background:#fff;padding:20px 20px;">
								<div id="barChartContainer" style="background:#fff;display:none; " class="demo-placeholder"></div>
							</div>

							<table class="table table-bordered table-sortable table-striped" id="tableExport" style="display:none">
								<thead>
									<tr>
										<td>Date</td>
										<td>Floor</td>
										<td>Name</td>
										<td>First</td>
										<td>Last</td>
										<td>Length</td>
										<!-- <td>History</td> -->
									</tr>
								</thead>

								<tbody>

								</tbody>

							</table>

						</div>

					</div>
				</div>

				<hr>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Total Count</span></label>
					<div class="col-sm-10">

						<div class="form-control fieldDisplay">
							<?php print count($data); ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Type</span></label>
					<div class="col-sm-10">

						<a type="button" class="btn btn-success" onclick="generateChart('all')"> ALL </a>
						<a type="button" class="btn btn-danger"  onclick="generateChart('wifi')"> Wifi </a>
						<a type="button" class="btn btn-info"  onclick="generateChart('ble')"> Bluetooth beacon </a>

					</div>
				</div>

				<div class="form-group">

					<label for="fullname" class="col-sm-2 control-label" ><span t>Chart</span></label>
					<div class="col-sm-10" style="position:relative;">

						<div id="donut-example" style="background:#fff; height: 400px;padding:20px;;border-radius:10px"></div>

					</div>
				</div>

				<!-- <div class="form-group form-footer">
				<div class="col-sm-12 text-center">
				<button class="btn btn-default" type="submit" t>
				Save
				</button>

				</div>
				</div> -->

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

<!-- <script src="<?php print $b; ?>/assetsAdmin/js/vendor/flot/jquery.flot.min.js"></script> -->
<!-- <script src="<?php print $b; ?>/assetsAdmin/js/vendor/flot/jquery.flot.categories.min.js"></script> -->
<!-- <script src="<?php print $b; ?>/assetsAdmin/js/vendor/flot/jquery.flot.pie.min.js"></script> -->
<!-- <script src="<?php print $b; ?>/assetsAdmin/js/vendor/flot/jquery.flot.stack.min.js"></script> -->
<!-- <script src="<?php print $b; ?>/assetsAdmin/js/vendor/graphtable/jquery.graphTable-0.3.js"></script> -->
<!-- <script src="<?php print $b; ?>/assetsAdmin/js/vendor/flot/jquery.flot.tooltip.min.js"></script> -->
<script src="<?php print $b; ?>/assetsAdmin/js/vendor/rickshaw/raphael-min.js"></script>
<!-- <script src="<?php print $b; ?>/assetsAdmin/js/vendor/rickshaw/d3.v2.js"></script> -->
<!-- <script src="<?php print $b; ?>/assetsAdmin/js/vendor/rickshaw/rickshaw.min.js"></script> -->

<script src="<?php print $b; ?>/assetsAdmin/js/vendor/morris/morris.min.js"></script>

<script>
	function exportExcel() {

		var floorID = $('#id').val();
		var exportFrom = $('#exportFrom').val();
		var exportTo = $('#exportTo').val();

		if (exportFrom != '' && exportTo != '') {

			var url = getUrl('exportExcelDo?floorID=' + floorID + '&exportFrom=' + exportFrom + '&exportTo=' + exportTo);
			var win = window.open(url, '_blank');
			win.focus();

		} else {
			alert('please enter export date.');
		}

	}

	function displayGantt() {

		alert('yada');

		var floorID = $('#id').val();
		var exportFrom = $('#exportFrom').val();
		var exportTo = $('#exportTo').val();

		if (exportFrom != '' && exportTo != '') {

			var url = getUrl('displayGantt');
			$.ajax({
				url : url,
				type : 'post',
				dataType : 'json',
				data : {
					floorID : floorID,
					exportFrom : exportFrom,
					exportTo : exportTo

				},
				success : function(r) {

				},
				error : function() {
				}
			});

		} else {
			alert('please enter export date.');
		}

	}

	function displayBar() {
		// $('#pieChartContainer').hide();

		var floorID = $('#id').val();
		var exportFrom = $('#exportFrom').val();
		var exportTo = $('#exportTo').val();

		if (exportFrom != '' && exportTo != '') {

			var url = getUrl('displayBar');
			$.ajax({
				url : url,
				type : 'post',
				dataType : 'json',
				data : {
					floorID : floorID,
					exportFrom : exportFrom,
					exportTo : exportTo

				},
				success : function(r) {
					$('#barChartContainerFrame').show();
					$('#barChartContainer').show();
					$('#chartUnit').show();
					$('#exportResult').show();

					var data = [];

					for (var i in r.data) {
						var x = r.data[i];

						var a = [];
						a[0] = x.label;
						a[1] = x.value;

						data[i] = a;

					}

					// var data = [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]];

					$.plot("#barChartContainer", [data], {
						series : {
							bars : {
								show : true,
								barWidth : 0.6,
								align : "center"
							}
						},
						xaxis : {
							mode : "categories",
							tickLength : 0
						}
					});

				},
				error : function() {
				}
			});

		} else {
			alert('please enter export date.');
		}

	}

	function displayPie() {
		// $('#barChartContainer').hide();
		var floorID = $('#id').val();
		var exportFrom = $('#exportFrom').val();
		var exportTo = $('#exportTo').val();

		if (exportFrom != '' && exportTo != '') {
			var url = getUrl('displayPie');
			$.ajax({
				url : url,
				type : 'post',
				dataType : 'json',
				data : {
					floorID : floorID,
					exportFrom : exportFrom,
					exportTo : exportTo

				},
				success : function(r) {

					$('#exportResult').show();
					$('#pieChartContainer').show();
					$('#chartUnit').show();

					/*
					 Morris.Donut({
					 element : 'pieChartContainer',
					 data : r['data'],
					 colors : r['color']
					 });
					 */

					$('#zzz').highcharts({
						chart : {
							type : 'column'
						},
						title : {
							text : 'World\'s largest cities per 2014'
						},
						subtitle : {
							text : 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
						},
						xAxis : {
							type : 'category',
							labels : {
								rotation : -45,
								style : {
									fontSize : '13px',
									fontFamily : 'Verdana, sans-serif'
								}
							}
						},
						yAxis : {
							min : 0,
							title : {
								text : 'Population (millions)'
							}
						},
						legend : {
							enabled : false
						},
						tooltip : {
							pointFormat : 'Population in 2008: <b>{point.y:.1f} millions</b>'
						},
						series : [{
							name : 'Population',
							data : [['Shanghai', 23.7], ['Lagos', 16.1], ['Istanbul', 14.2], ['Karachi', 14.0], ['Mumbai', 12.5], ['Moscow', 12.1], ['São Paulo', 11.8], ['Beijing', 11.7], ['Guangzhou', 11.1], ['Delhi', 11.1], ['Shenzhen', 10.5], ['Seoul', 10.4], ['Jakarta', 10.0], ['Kinshasa', 9.3], ['Tianjin', 9.3], ['Tokyo', 9.0], ['Cairo', 8.9], ['Dhaka', 8.9], ['Mexico City', 8.9], ['Lima', 8.9]],
							dataLabels : {
								enabled : true,
								rotation : -90,
								color : '#FFFFFF',
								align : 'right',
								format : '{point.y:.1f}', // one decimal
								y : 10, // 10 pixels down from the top
								style : {
									fontSize : '13px',
									fontFamily : 'Verdana, sans-serif'
								}
							}
						}]
					});
				},
				error : function() {
				}
			});

		} else {
			alert('please enter export date.');
		}

	}

	function displayExcel() {

		var floorID = $('#id').val();
		var exportFrom = $('#exportFrom').val();
		var exportTo = $('#exportTo').val();

		if (exportFrom != '' && exportTo != '') {
			$('#tableExport tbody tr').remove();

			var url = getUrl('displayData');
			$.ajax({
				url : url,
				type : 'post',
				dataType : 'json',
				data : {
					floorID : floorID,
					exportFrom : exportFrom,
					exportTo : exportTo

				},
				success : function(r) {

					$('#exportResult').show();

					for (var i in r.list) {
						var x = r.list[i];

						var users = x.users;

						var isDisplayDate = false;

						for (var ii in users) {
							var html = '';
							var user = users[ii];

							html += '<tr>';

							if (!isDisplayDate) {
								isDisplayDate = true;
								html += '<td>' + x['date'] + '</td>';
							} else {
								html += '<td></td>';
							}

							html += '<td>' + v(r.users[user['userID']]) + '</td>';
							html += '<td>' + floorName + '</td>';
							html += '<td>' + user.firstTime + '</td>';
							html += '<td>' + user.lastTime + '</td>';
							html += '<td>' + user.length + '</td>';
							// html += '<td><a class="btn btn-danger" target="_blank" type="button" href="' + getUrl('userHistory?floorID=' + floorID + '&date=' + x['date'] + '&userID=' + user['userID']) + '">History</button></td>';

							html += '</tr>';

							$('#tableExport tbody').append(html);
						}

					}
					$('#tableExport').show();
				},
				error : function() {
				}
			});
		} else {
			alert('please enter export date.');
		}

	}

	function toHistory(floorID, date, userID) {
		toPage('userHistory?floorID=' + floorID + '&date=' + date + '&userID=' + userID);
	}

	var totalCount = [];
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

		//calculate points

		generateChart('all');

	});

	function generateChart(typeID) {

		totalCount[0] = 0;
		totalCount[1] = 0;
		totalCount[2] = 0;
		totalCount[3] = 0;
		totalCount[4] = 0;

		if (typeID == 'all') {
			for (var i in points) {
				var rssi = points[i]['rssi'];
				var type = points[i]['type'];

				rssi *= -1;
				switch (true) {
				case (rssi<21):
					totalCount[0] += 1;
					break;
				case (rssi<41):
					totalCount[1] += 1;
					break;
				case (rssi<61):
					totalCount[2] += 1;
					break;
				case (rssi<81):
					totalCount[3] += 1;
					break;
				default:
					totalCount[4]++;
				}

			}
		} else {
			for (var i in points) {
				var rssi = points[i]['rssi'];
				var type = points[i]['type'];

				if (type == typeID) {

					rssi *= -1;
					switch (true) {
					case (rssi<21):
						totalCount[0] += 1;
						break;
					case (rssi<41):
						totalCount[1] += 1;
						break;
					case (rssi<61):
						totalCount[2] += 1;
						break;
					case (rssi<81):
						totalCount[3] += 1;
						break;
					default:
						totalCount[4]++;
					}
				}

			}
		}

		// alert('asd');
		Morris.Donut({
			element : 'donut-example',
			data : [{
				label : "0 ~ 20",
				value : totalCount[0]
			}, {
				label : "21 ~ 40",
				value : totalCount[1]
			}, {
				label : "41 ~ 60",
				value : totalCount[2]
			}, {
				label : "61 ~ 80",
				value : totalCount[3]
			}, {
				label : "81 ~ 100",
				value : totalCount[4]
			}],
			colors : ['#e92a2a', '#e37115', '#fcff00', '#26d3d1', '#39d944']
		});

	}

	/*
	 Morris.Donut({
	 element : 'donut-example',
	 data : [{
	 label : "Wifi Count",
	 value : wifiCount
	 }, {
	 label : "Beacon Count",
	 value : beaconCount
	 }],
	 colors : ['#0088cc', '#e5618d']
	 });
	 */

</script>
