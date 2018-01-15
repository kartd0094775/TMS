<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Building details</h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="" t>
				<a href="<?php print $this -> url('list'); ?>" t>Building details</a>
			</li>

			<li class="active" t>
				Building details
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
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>BuildingID</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="code" id="code" />
					</div>
				</div>

				<div class="form-group hide">
					<label for="fullname" class="col-sm-2 control-label" ><span t>in Company</span></label>
					<div class="col-sm-10">
						<select class="form-control" name="companyID">
							<?php
							$items = Company::model() -> findAll();
							foreach ($items as $x) {
								print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group  ">
					<label for="fullname" class="col-sm-2 control-label" ><span t>is Public</span></label>
					<div class="col-sm-10">
						<select class="form-control" name="isPublic">
							<?php
							print $this -> printTypeOption('is');
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>in City</span></label>
					<div class="col-sm-10">
						<select class="form-control" name="cityID" id="cityID">
							<?php
							$items = City::model() -> findAll();
							foreach ($items as $x) {
								print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>API_Building_01
							<br>
							(FreeAmount)</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="API_Building_01" id="API_Building_01" />
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>API_Building_02
							<br>
							(ParkingInfo)</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="API_Building_02" id="API_Building_02" />
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>API_Building_03
							<br>
							(FreeParkingSpaceInFloor)</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="API_Building_03" id="API_Building_03" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>API_Building_04
							<br>
						</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="API_Building_04" id="API_Building_04" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>API_Building_05
							<br>
						</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="API_Building_05" id="API_Building_05" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>txt上傳</span> </label>

					<div class="col-sm-10">
						<div name="txt"></div>
						<input type="file" class="form-control" name="txt"  style="height:auto;" />
						<div >
							(STOSensorMapKeelungEastBankParkingLot_TEST_Android_Settings.txt)
						</div>
						<!-- <br> -->
						<!-- (upload png file, reupload will reset svg) -->
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Photo</span></label>
					<div class="col-sm-10">

						<button t  id="fileUploadButton" class="btn btn-default update" type="button" onclick="$('#formFileUpload_photo input[type=file]').click()">
							Upload photo
						</button>

						<table class="table table-bordered table-sortable table-striped" id="tablePhoto" >
							<thead>
								<tr>
									<td t>Photo</td>
									<!-- <td t>設為主圖片</td> -->
									<!-- <td t>Sequence</td> -->
									<!-- <td t>Delete</td> -->
								</tr>
							</thead>
							<tbody>
								<?php

								$photoJson = json_decode($item['photoJson'], true);
								if (is_array($photoJson)) {
									foreach ($photoJson as $x) {

										$guid = getGuid();

										$checked = '';
										if (isset($x['isMainPhoto']) && $x['isMainPhoto'] == '1') {
											$checked = ' checked="checked" ';
										}

										print '
<tr>
<td><input type="hidden" name="photo[' . $guid . ']" value="' . $x['photo'] . '" />
<a href="' . $baseUrl . '/resource/' . $item['code'] . '/' . $x['photo'] . '" target="_blank">
<img src="' . $baseUrl . '/resource/' . $item['code'] . '/' . $x['photo'] . '"  class="photoThumb"/></a></td>

<td class="text-center hide"><input class="checkbox checkboxMainPhoto" type="checkbox" name="isMainPhoto[' . $guid . ']" value="1" ' . $checked . '/></td>

<td class="hide"><input class="form-control" type="text" name="photoSequence[' . $guid . ']" value="' . $x['sequence'] . '" /></td>

<td class="hide"><button type="button" class="btn btn-danger update" onclick="deletePhotoItem(this)">刪除</button></td>
</tr>';

									}
								}
								?>
							</tbody>
						</table>

					</div>
				</div>

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

<form id="formFileUpload_photo" action="<?php print $this -> getUrl('uploadPhotoDo'); ?>" method="post" style="display:none" enctype="multipart/form-data" >
	<input type="file" name="files"    accept="image/*">
	<!-- <input type="file" name="files"   accept="image/*"> -->
</form>

<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;

	// unset($data['password']);

	// $data['createUserName'] = $createUser['name'];
	// $data['updateUserName'] = $updateUser['name'];

	if (!empty($data['txt'])) {
		$data['txt'] = '<a href="' . $b . '/resource/' . $data['code'] . '/STOSensorMapKeelungEastBankParkingLot_TEST_Android_Settings.txt" target="_blank">STOSensorMapKeelungEastBankParkingLot_TEST_Android_Settings.txt</a>';
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
	function checkForm() {
		var message = '';
		var isOk = true;

		if ($.trim($('#name').val()) == '') {
			isOk = false;
			message += 'Please fill in Name\n';
		}
		if ($.trim($('#code').val()) == '') {
			isOk = false;
			message += 'Please fill in BuildingID\n';
		}

		if ($.trim($('#cityID').val()) == '') {
			isOk = false;
			message += 'Please select City\n';
		}
		if ($.trim($('#API_Building_01').val()) == '') {
			isOk = false;
			message += 'Please fill in API_Building_01\n';
		}

		if (isOk) {
			$('#form').submit();
		} else {
			alert(message);
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

		$('#formFileUpload_photo input[type=file]').change(function() {
			setTimeout("$('#formFileUpload_photo').submit();", 100);
		});

		var fileUploadData = null;
		$('#formFileUpload_photo').fileUpload({
			uploadData : {
				// 'extra_data' : 'blah'
			}, // Append POST data to the upload
			submitData : {
				// 'moar_extra_data' : 'blah'
			}, // Append POST data to the form submit
			uploadOptions : {
				dataType : 'json'
			}, // Customise the parameters passed to the $.ajax() call on uploads. You can use any of the normal $.ajax() params
			submitOptions : {
				dataType : 'json'
			}, // Customise the parameters passed to the $.ajax() call on the form submit. You can use any of the normal $.ajax() params
			before : function() {
			}, // Run stuff before the upload happens
			beforeSubmit : function(uploadData) {
				fileUploadData = uploadData.files;
				return true;
			}, // access the data returned by the upload return false to stop the submit ajax call

			success : function(data, textStatus, jqXHR) {

				$('#tablePhoto').html('');

				var html = '';

				// $('#tablePhoto tbody *').remove();

				for (var i in fileUploadData) {

					var x = fileUploadData[i];

					var guid = getGuid();

					// var guid = getGuid();
					html += '<tr>';
					html += '<td><input type="hidden" name="photo[' + guid + ']" value="' + x['fileName'] + '.' + x['ext'] + '" />';
					html += '<a href="' + baseUrl + '/upload/' + 'building' + '/' + x['fileName'] + '.' + x['ext'] + '" target="_blank">';
					html += '<img src="' + baseUrl + '/upload/' + 'building' + '/' + x['fileName'] + '.' + x['ext'] + '"  class="photoThumb"/></a></td>';
					html += '<td class="hide text-center  "><input class="checkbox checkboxMainPhoto" type="checkbox" name="isMainPhoto[' + guid + ']" value="1"  /></td>';
					html += '<td class="hide"><input class="form-control" type="text" name="photoSequence[' + guid + ']" value="1" /></td>';
					html += '<td class="hide"><button type="button" class="btn btn-danger" onclick="deletePhotoItem(this)">刪除</button></td>';
					html += '</tr>';

				}

				$('#tablePhoto').append(html);

				setCheckboxMainPhoto();

			}, // Callback for the submit success ajax call

			error : function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
			}, // Callback if an error happens with your upload call or the submit call
			complete : function(jqXHR, textStatus) {
				console.log(jqXHR);
			} // Callback on completion
		});

	}); 
</script>
