<?php
$items = Company::model() -> findAll();

$temp = null;
foreach ($items as $x) {
	// $a = null;
	// $a['id'] = $x['id'];
	// $a['name'] = $x['name'];
	$temp[$x['id']] = $x['name'];
}
print $this -> printJson('company', $temp);

$items = Building::model() -> findAll();

$temp = null;
foreach ($items as $x) {
	// $a = null;
	// $a['id'] = $x['id'];
	// $a['name'] = $x['name'];
	// $temp[$x['id']] = $x['name'];
	$temp[$x['companyID']][$x['id']] = $x['name'];
}
print $this -> printJson('building', $temp);
?>

<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Floor details</h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="" t>
				<a href="<?php print $this -> url('list'); ?>" t>Floor details</a>
			</li>

			<li class="active" t>
				Floor details
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
						<input type="text" class="form-control" name="name" id="name" />
					</div>
				</div>

				<!-- <div class="form-group hide">
				<label for="fullname" class="col-sm-2 control-label" ><span t>in Company</span></label>
				<div class="col-sm-10">
				<select class="form-control" name="companyID" onchange="filterBuilding()" id="companyID">
				<?php
				$items = Company::model() -> findAll();
				foreach ($items as $x) {
				print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
				}
				?>
				</select>
				</div>
				</div> -->

                                <!-- 2018/1/12 wayne -->
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
                                <div class ="form-group">
                                   <label for="fullname" class="col-sm-2 control-label" ><span t>Building</span></label>
                                   <div class="col-sm-10">
                                    <select id="buildingID" name="buildingID" class="selectpicker" data-live-search="true" data-width="fit" class="form-control" data-size="8">
                                      <option value='-1'>----</option>
                                    </select>
                                   </div>
                                </div>
                                <!--
                                <div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>in Building</span></label>
					<div class="col-sm-10">
						<select class="form-control" name="buildingID" id="buildingID">
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
                                -->
                                <!-- 2018/1/17 Wayne -->
                                <input type="hidden" name="cityID" id="cityID" />
                                <input type="hidden" name="address" id="address" />
                                <input type="hidden" name="building_id" id="building_id" />
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Floor</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="floor"  id="floor"/>
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Block</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="block"  id="block"/>
					</div>
				</div>


				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Offset X</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="offsetX" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Offset Y</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="offsetY" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Ratio</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="ratio" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Max</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="mapMax" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Min</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="mapMin" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>is assign RSSI</span></label>
					<div class="col-sm-10">
						<select class="form-control" name="isUseValue" id="isUseValue">
							<?php
							print $this -> printTypeOption('is');
							?>
						</select>
					</div>
				</div>

				<div class="form-group hide">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Upload map</span> </label>

					<div class="col-sm-10">
						<input type="file" class="form-control" name="photo" />
						<br>
						(upload png file, reupload will reset svg)
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Upload SVG</span> </label>

					<div class="col-sm-10">
						<div name="svg"></div>
						<input type="file" class="form-control" name="svg" style="height:auto;" />
						<!-- <br> -->
						<!-- (upload png file, reupload will reset svg) -->
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>定位指紋資料檔案1</span> </label>

					<div class="col-sm-10">
						<div name="fileFinger1"></div>
						<input type="file" class="form-control" name="fileFinger1"  style="height:auto;" />
						<div >
							(xxx_loc.dat)
						</div>
						<!-- <br> -->
						<!-- (upload png file, reupload will reset svg) -->
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>定位指紋資料檔案2</span> </label>

					<div class="col-sm-10">
						<div name="fileFinger2"></div>
						<input type="file" class="form-control" name="fileFinger2"  style="height:auto;" />
						<div >
							(xxx_s.dat)
						</div>
						<!-- <br> -->
						<!-- (upload png file, reupload will reset svg) -->
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>定位指紋資料檔案3</span> </label>

					<div class="col-sm-10">
						<div name="fileFinger3"></div>
						<input type="file" class="form-control" name="fileFinger3"  style="height:auto;" />
						<div >
							(xxx.dat)
						</div>
						<!-- <br> -->
						<!-- (upload png file, reupload will reset svg) -->
					</div>
				</div>

				<div class="form-group hide">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Upload json</span></label>
					<div class="col-sm-10">
						<input type="file" class="form-control" name="json" />
						<br>
						(upload txt file)
					</div>
				</div>

				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>公司照片</span></label>
				<div class="col-sm-10">

				<span class="btn btn-success fileinput-button" onclick="$('#uploadPhoto').click()"> <i class="fa fa-plus"></i> <span> 選擇照片</span> </span>
				<input type="file" class="form-control hide"  name="uploadPhoto" id="uploadPhoto">

				</div>
				</div> -->

				<div class="form-group form-footer">
					<div class="col-sm-12 text-center">
						<button class="btn btn-default" type="button" onclick="checkForm()" t>
							Save
						</button>

					</div>
				</div>

			</form>

		</div>
		<!-- /tile body -->

	</section>

</div>

<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;

	// unset($data['password']);

	// $data['createUserName'] = $createUser['name'];
	// $data['updateUserName'] = $updateUser['name'];

	if (!empty($data['svg'])) {
		//$data['svg'] = '<a href="' . $b . '/upload/floor/' . $data['svg'] . '" target="_blank">檔案下載: ' . $item['floor'] . '.svg</a>';
		$data['svg'] = '<a href="' . $b . '/resource/' . $building['code'] . '/map/' . $data['floor'] . '.svg" target="_blank">檔案下載: ' . $item['floor'] . '.svg</a>';
	}

	if (!empty($data['fileFinger1'])) {
		//$data['fileFinger1'] = '<a href="' . $b . '/upload/floor/' . $data['fileFinger1'] . '" target="_blank">檔案下載: floor' . $data['floor'] . '_loc.dat</a>';
		$data['fileFinger1'] = '<a href="' . $b . '/resource/' . $building['code'] . '/map/floor' . $data['floor'] . '_loc.dat" target="_blank">檔案下載: floor' . $data['floor'] . '_loc.dat</a>';
	}

	if (!empty($data['fileFinger2'])) {
		//$data['fileFinger2'] = '<a href="' . $b . '/upload/floor/' . $data['fileFinger2'] . '" target="_blank">檔案下載: floor' . $data['floor'] . '_s.dat</a>';
		$data['fileFinger2'] = '<a href="' . $b . '/resource/' . $building['code'] . '/map/floor' . $data['floor'] . '_s.dat" target="_blank">檔案下載: floor' . $data['floor'] . '_s.dat</a>';

	}

	if (!empty($data['fileFinger3'])) {
		//$data['fileFinger3'] = '<a href="' . $b . '/upload/floor/' . $data['fileFinger3'] . '" target="_blank">檔案下載: floor' . $data['floor'] . '.dat</a>';
		$data['fileFinger3'] = '<a href="' . $b . '/resource/' . $building['code'] . '/map/floor' . $data['floor'] . '.dat" target="_blank">檔案下載: floor' . $data['floor'] . '.dat</a>';
	}

	$isCreate = false;
} else {
	$data = null;
}

print $this -> printJson('data', $data);
print $this -> printJson('isCreate', $isCreate);
print $this -> printJson('isRead', $this -> isItemRead);
?>
<script>
        var buildingOptions
	function checkForm() {

                //create
		var floor = $('#floor').val();
		var name = $('#name').val();
                var buildingID = $('#buildingID').val();

		var isOk = true;
		var message = '';

		if (name == '') {
			message += "Please fill in name.\n";
			isOk = false;
		}
		if (floor == '') {
			message += "Please fill in floor.\n";
			isOk = false;
		}
                if (buildingID == -1) {
                        message += "Please select the building.\n";
                        isOk = false;
                }
		if (isOk) {

			$('#form').submit();
			return;

		} else {
			alert(message);
		}

	}

	function filterBuilding() {
		var v = $('#companyID').val();

		// var html = '<option value="">Select City</option>';
		var html = '';
		for (var i in building[v]) {
			var x = building[v][i];
			html += '<option value="' + i + '">' + x + '</option>';

		}

		$('#buildingID').html(html);

        }
	$(document).ready(function() {

		// filterBuilding();
               let response = fetch(`http://192.168.1.109:80/yanjing/api/poi/building/`).then(response => {
                  return response.json()
                }).then(function(value){
                  buildingOptions = value
                  value.map(function(obj, index){
                    $('#buildingID')
                      .append('<option value="' + obj.id + '">' + obj.name + ': ' + obj.address + '</option>')

                    })
                  $('#buildingID').selectpicker('refresh');
                })

                $('#buildingID').change(function(event){
                  let index = $('#buildingID')[0].selectedIndex
                  let building = buildingOptions[index]
                  let city_id = building.location_id.split(" ")[1]
                  let address = building.address
                  let building_id = building.id
                  $('#cityID').val(city_id)
                  $('#address').val(address)
                  $('#building_id').val(building_id)

                })
               if (data != null) {
                   assignFormValue('form', data);
			// filterBuilding();

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
