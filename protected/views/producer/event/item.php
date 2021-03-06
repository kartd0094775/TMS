<?php
//get all producer type

$items = ProducerType::model() -> findAll();

$tmep = null;

if (is_array($items)) {
	foreach ($items as $x) {
		$temp[$x['mainId']][$x['id']] = $x['name'];

	}
}

print $this -> printJson('producerType', $temp);
?>

<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i><span t>Event Detail</span></h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="active" t>
				Event Detail
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

				<!-- <span class="must">*</span> -->
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>名稱</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="name" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>狀態</span></label>
					<div class="col-sm-10">
						<select name="status" class="chosen-select form-control search" >
							<option value="1">上架</option>
							<option value="0">下架</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>主分類</span></label>
					<div class="col-sm-10">

						<select name="mainType" id="mainType" class=" form-control search" onchange="setSubType()" ></select>
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>次分類</span></label>
					<div class="col-sm-10">

						<select name="subType" id="subType" class=" form-control search" ></select>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>區域</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="area" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>總數</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="total" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>加入數量</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="countJoined" readonly="" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>點擊數量</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="countSold" readonly="" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>收藏數量</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="countSold" readonly="" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>認可日期</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control datepicker" name="approvedAt"  />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>抽獎開始</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control datepicker" name="lotteryRunAt"  />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>抽獎數量</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control " name="lotteryAmount"  />
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>簡述</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control " name="brief"  />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>內容</span></label>
					<div class="col-sm-10">
						<textarea type="text" class="form-control" name="description" style="height:150px"  /></textarea>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>開始日期</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control datepicker" name="start"  />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>結束日期</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control datepicker" name="end"  />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>照片</span></label>
					<div class="col-sm-10">

						<button  class="btn btn-default" type="button" id="buttonUpload" onclick="$('#formFileUpload_photo input[type=file]').click()">
							上傳照片
						</button>
						<!-- (建議傳最大寬度在750px以內的圖片, 尤其最忌諱沒有縮圖過的原始照片檔) -->
						<table class="table table-bordered table-sortable table-striped" id="tablePhoto" >
							<tr>
								<td>照片</td>
								<!-- <td>設為列表圖片</td> -->
								<!-- <td>設為開箱列表圖片</td> -->
								<!-- <td>順序</td> -->
								<td>刪除</td>
							</tr>
							<?php

							if (isset($item)) {
								$photoJson = json_decode($item['photo'], true);

								// print_r($photoJson);
								// die();

								if (is_array($photoJson)) {
									// foreach ($photoJson as $k => $x) {
									$x = $photoJson;

									$guid = getGuid();
									// $guid = $x['id'];

									print '
<tr>
<td>
<input type="hidden" name="photoID[' . $guid . ']" value="' . $x['id'] . '" />
<input type="hidden" name="url[' . $guid . ']" value="' . $x['url'] . '" />
<input type="hidden" name="mime[' . $guid . ']" value="' . $x['mime'] . '" />
<input type="hidden" name="size[' . $guid . ']" value="' . $x['size'] . '" />
<input type="hidden" name="photo[' . $guid . ']" value="' . $x['id'] . '" />
<a href="' . $x['url'] . '" target="_blank">
<img src="' . $x['url'] . '"  class="photoThumb"/></a></td>

<!--
<td><input class="form-control" type="text" name="photoSequence[' . $guid . ']" value="' . $x['id'] . '" /></td>
-->
<td><button type="button" class="btn btn-danger" onclick="deletePhotoItem(this)">刪除</button></td>
</tr>';

									// }
								}
							}
							?>
						</table>

					</div>
				</div>

				<!--

				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>類型</span></label>
				<div class="col-sm-7">
				<select name="typeID" id="typeID" class="chosen-select form-control" onchange="changeType()" >
				<?php print $this -> printTypeOption('promotion.type'); ?>
				</select>
				</div>
				</div> -->

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
	<!-- <input type="file" name="files" multiple  accept="image/*"> -->
	<input type="file" name="files"   accept="image/*">
</form>

<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;

	// unset($data['password']);

	// $data['createUserName'] = $createUser['name'];
	// $data['updateUserName'] = $updateUser['name'];

	$isCreate = false;

	// $data['equipmentJson'] = explode(',', $data['equipmentJson']);
	$data['photo'] = '<img src="' . $b . '/upload/' . 'event' . '/' . $data['photo'] . '" class="thumb">';

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

	function changeType() {

		var v = $('#typeID').val();

		$('.typeField').hide();

		$('.typeField' + v).fadeIn();

	}

	function setSubType() {
		var v = $('#mainType').val();

		var html = '';
		for (var i in producerType[v]) {
			var x = producerType[v][i];
			html += '<option value="' + i + '">' + x + '</option>';
		}

		$('#subType').html(html);
	}

	function initMainType() {

		var html = '';
		for (var i in producerType[0]) {
			var x = producerType[0][i];
			html += '<option value="' + i + '">' + x + '</option>';
		}

		$('#mainType').html(html);
	}


	$(document).ready(function() {

		// changeType();

		initMainType();

		if (data != null) {
			assignFormValue('form', data);

			setSubType();

			$('#subType').val(data['subType']);

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

	$(document).ready(function() {

		//assign equipment
		/*
		 for (var i in data['equipmentJson']) {
		 var x = data['equipmentJson'][i];
		 $('*[name="equipmentJson[]"][value="' + x + '"]').prop('checked', true);
		 }
		 */
		for (var i in data['roomIDs']) {
			var x = data['roomIDs'][i];
			$('*[name="roomIDs[]"][value="' + x + '"]').prop('checked', true);
		}

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

				$('#tablePhoto tbody *').remove();

				for (var i in fileUploadData) {

					var x = fileUploadData[i];

					var guid = getGuid();

					// var guid = getGuid();
					html += '<tr>';
					html += '<td>';

					html += '<input type="hidden" name="photoID[' + guid + ']" value="' + x['id'] + '" />';
					html += '<input type="hidden" name="url[' + guid + ']" value="' + x['url'] + '" />';
					html += '<input type="hidden" name="mime[' + guid + ']" value="' + x['mime'] + '" />';
					html += '<input type="hidden" name="size[' + guid + ']" value="' + x['size'] + '" />';
					html += '<input type="hidden" name="photo[' + guid + ']" value="' + x['photo'] + '" />';

					html += '<a href="' + x['url'] + '" target="_blank">';
					html += '<img src="' + x['url'] + '"  class="photoThumb"/></a></td>';
					// html += '<td class="text-center hide"><input class="checkbox checkboxMainPhoto" type="checkbox" name="isMainPhoto[' + guid + ']" value="1" checked="checked" /></td>';
					// html += '<td><input class="form-control" type="text" name="photoSequence[' + guid + ']" value="9999" /></td>';
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

	function deletePhotoItem(e) {
		$(e).parent().parent().remove();
	}

</script>
