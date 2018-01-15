<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i><span t>Floor POI Detail</span></h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="" >
				<a href="<?php print $this -> url('list?id=' . $floor['id']); ?>" t>Floor POI - <?php print $floor['name']; ?></a>
			</li>

			<li class="active" t>
				Floor POI Detail
			</li>

		</ol>
	</div>

</div>
<!-- /page header -->

<div class="main">

	<section class="tile color transparent-black">

		<!-- tile body -->
		<div class="tile-body">

			<form role="form" class="form-horizontal" parsley-validate id="itemForm" method="post" action="<?php print $this -> url('updateDo'); ?>" enctype="multipart/form-data" >

				<input type="hidden" name="actionType" value="<?php print $this -> actionName; ?>" />
				<input type="hidden" name="id" value="<?php print get('id'); ?>" />
				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" t><span>zzzzzzzzz</span> *</label>
				<div class="col-sm-7">
				<input type="text" class="form-control" id="zzzzzzzzzzzzz" name="zzzzzzzzzzzzz" parsley-trigger="change" parsley-required="true" />
				</div>
				</div> -->

				<!--
				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>公司名稱</span></label>
				<div class="col-sm-7">
				<input type="text" class="form-control" id="companyName" name="companyName" />
				</div>
				</div>

				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>公司概況</span></label>
				<div class="col-sm-7">
				<input type="text" class="form-control" id="companySituation" name="companySituation" />
				</div>
				</div>
				-->
				<!--
				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Company</span></label>
				<div class="col-sm-7">
				<input type="text" class="form-control" name="companyName" />
				</div>
				</div> -->
				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>帳號</span></label>
				<div class="col-sm-7">
				<input type="text" class="form-control" name="email" />
				</div>
				</div> -->

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>ID</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="id" readonly/>
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Number</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="number" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span><span class="must">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="name" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>English Name</span><span class="must">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nameEnglish" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Content</span></label>
					<div class="col-sm-10">
						<textarea type="text" class="form-control" name="content" style="height:100px;max-width:100%"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>English Content</span></label>
					<div class="col-sm-10">
						<textarea type="text" class="form-control" name="contentEnglish" style="height:100px;max-width:100%"></textarea>
					</div>
				</div>
				
				
				 
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>X</span><span class="must">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="x" />
					</div>
				</div>
				 
				 
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Y</span><span class="must">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="y" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" >Latitude</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="lat" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" >Longitude</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="lng" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" >Priority From</label>
					<div class="col-sm-10">
						<!-- <input type="text" class="form-control" name="priority" /> -->
<select name="priorityFrom" class="chosen-select form-control search" >
<!-- <option value="">----</option> -->
  <?php

for ($i = 1; $i <= 10; $i++) {
	print '<option value="' . $i . '">' . $i . '</option>';
}

// print $this -> printTypeOption('product.type');
  ?>
</select>

					</div>
				</div>
				
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" >Priority To</label>
					<div class="col-sm-10">
						<!-- <input type="text" class="form-control" name="priority" /> -->
<select name="priorityTo" class="chosen-select form-control search" >
<!-- <option value="">----</option> -->
  <?php

for ($i = 1; $i <= 10; $i++) {
	print '<option value="' . $i . '">' . $i . '</option>';
}

// print $this -> printTypeOption('product.type');
  ?>
</select>

					</div>
				</div>
				
				
				  
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Icon</span><span class="must">*</span></label>
					<div class="col-sm-10">
						
						
<select name="iconID" class="chosen-select form-control search" >
<option value="">----</option>
  <?php

$c = new Criteria;
// $c->condition='postID=:';
// $c->params=array(':postID'=>10);
// $c -> order = 'id DESC';

/*
 if (!$this -> isAdminRole()) {
 $params = null;
 $c -> addCondition('t.adminID = :adminID');
 $params[':adminID'] = $this -> adminID;
 $c -> params = $params;
 }
 */

$items = PoiType::model() -> findAll($c);
// $items = Icon::model() -> findAll($c);
foreach ($items as $x) {
	print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
}

// print $this -> printTypeOption('product.type');
  ?>
</select>

					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Public Facility</span><span class="must">*</span></label>
					<div class="col-sm-10">
						
						
<select name="publicFacilityID" class="chosen-select form-control search" >
<option value="">----</option>
  <?php

$c = new Criteria;
$c -> condition = 'typeID=:typeID';
$c -> params = array(':typeID' => 1);
// $c -> order = 'id DESC';
$items = PoiType::model() -> findAll($c);

foreach ($items as $x) {
	print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
}

// print $this -> printTypeOption('product.type');
  ?>
</select>

					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Vendor</span><span class="must">*</span></label>
					<div class="col-sm-10">
						
						
<select name="vendorID" class="chosen-select form-control search" >
<option value="">----</option>
  <?php

$c = new Criteria;
$c -> condition = 'typeID=:typeID';
$c -> params = array(':typeID' => 2);
// $c -> order = 'id DESC';
$items = PoiType::model() -> findAll($c);

foreach ($items as $x) {
	print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
}

// print $this -> printTypeOption('product.type');
  ?>
</select>

					</div>
				</div>
				  
				  
				  
				  	
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" >URL</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="url" />
					</div>
				</div>
				
				
				  <div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Photo 360上傳</span> </label>

					<div class="col-sm-10">
						
						<input type="text" class="form-control" name="photo360" />
						
						<!-- <div name="photo360_img"></div>
						<input type="file" class="form-control" name="photo360"  style="height:auto;" />
						<div >
							(360度圖片)
						</div>
						 -->
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
								<td t>設為主圖片</td>
								<td t>Sequence</td>
								<td t>Delete</td>
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
<a href="' . $baseUrl . '/upload/' . $this -> uploadPath . '/' . $x['photo'] . '" target="_blank">
<img src="' . $baseUrl . '/upload/' . $this -> uploadPath . '/' . $x['photo'] . '"  class="photoThumb"/></a></td>

<td class="text-center"><input class="checkbox checkboxMainPhoto" type="checkbox" name="isMainPhoto[' . $guid . ']" value="1" ' . $checked . '/></td>


<td><input class="form-control" type="text" name="photoSequence[' . $guid . ']" value="' . $x['sequence'] . '" /></td>

<td><button type="button" class="btn btn-danger update" onclick="deletePhotoItem(this)">刪除</button></td>
</tr>';

								}
							}
							?>
							</tbody>
						</table>

					</div>
				</div>

				<hr>
 
				<div class="form-group form-footer">
					<div class="col-sm-12 text-center">
						<button class="btn btn-default update" type="submit" t>
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
	<input type="file" name="files" multiple  accept="image/*">
	<!-- <input type="file" name="files"   accept="image/*"> -->
</form>


<?php

$isCreate = true;

if ($this -> actionName != 'create') {
	if (isset($item)) {
		$data = $item -> attributes;

		// unset($data['password']);

		// $data['createUserName'] = $createUser['name'];
		// $data['updateUserName'] = $updateUser['name'];

		$isCreate = false;

		// $data['equipmentJson'] = explode(',', $data['equipmentJson']);
		$data['photo'] = '<img src="' . $b . '/upload/' . 'floor' . '/' . $data['photo'] . '" class="thumb">';
		$data['photo360_img'] = '<img src="' . $b . '/upload/' . 'floor' . '/' . $data['photo360'] . '" class="thumb">';

	} else {
		$data = null;
	}
} else {
	$data = null;
}

print $this -> printJson('data', $data);
print $this -> printJson('isCreate', $isCreate);
print $this -> printJson('isRead', $this -> isItemRead);
?>
<script>
	function changeType() {

		var v = $('#typeID').val();

		$('.typeField').hide();

		$('.typeField' + v).fadeIn();

	}


	$(document).ready(function() {

		// changeType();

		//set is read
		setIsRead('itemForm', isRead);

	});

	$(document).ready(function() {

		setCheckboxMainPhoto();

		//assign equipment
		/*
		 for (var i in data['equipmentJson']) {
		 var x = data['equipmentJson'][i];
		 $('*[name="equipmentJson[]"][value="' + x + '"]').prop('checked', true);
		 }

		 for (var i in data['roomIDs']) {
		 var x = data['roomIDs'][i];
		 $('*[name="roomIDs[]"][value="' + x + '"]').prop('checked', true);
		 }
		 */

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
				var html = '';

				// $('#tablePhoto tbody *').remove();

				for (var i in fileUploadData) {

					var x = fileUploadData[i];

					var guid = getGuid();

					// var guid = getGuid();
					html += '<tr>';
					html += '<td><input type="hidden" name="photo[' + guid + ']" value="' + x['fileName'] + '.' + x['ext'] + '" />';
					html += '<a href="' + baseUrl + '/upload/' + 'floor' + '/' + x['fileName'] + '.' + x['ext'] + '" target="_blank">';
					html += '<img src="' + baseUrl + '/upload/' + 'floor' + '/' + x['fileName'] + '.' + x['ext'] + '"  class="photoThumb"/></a></td>';
					html += '<td class="text-center  "><input class="checkbox checkboxMainPhoto" type="checkbox" name="isMainPhoto[' + guid + ']" value="1"  /></td>';
					html += '<td><input class="form-control" type="text" name="photoSequence[' + guid + ']" value="1" /></td>';
					html += '<td><button type="button" class="btn btn-danger" onclick="deletePhotoItem(this)">刪除</button></td>';
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

		// initPhotoItems();

		$('#formFileUpload_youtube input[type=file]').change(function() {
			setTimeout("$('#formFileUpload_youtube').submit();", 100);
		});

	});

</script>
