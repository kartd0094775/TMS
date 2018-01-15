<style>
	.thumb {
		max-width: 200px;
		max-height: 200px;
	}
</style>

<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i><span t>商品資料</span></h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="" >
				<a href="<?php print $this -> url('list?id=' . $producer['id']); ?>" t>商品資料 - <?php print $producer['name']; ?></a>
			</li>

			<li class="active" t>
				商品資料 
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

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span><span class="must">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="name" />
					</div>
				</div>

				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>順序</span><span class="must">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="sequence" />
					</div>
				</div>
				

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>簡述</span><span class="must">*</span></label>
					<div class="col-sm-10">
						<textarea type="text" class="form-control" name="content" style="height:150px" ></textarea>
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

				<hr>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>照片</span><span class="must">*</span>
						<!-- <br><span class="blue">最佳尺寸：800x688</span> -->
						</label>
					<div class="col-sm-10">

						<div name="photo"></div>
						<input type="file" class="form-control" name="photo" style="margin-top: 1em;" />

					</div>
				</div>

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

if (isset($item)) {
	$data = $item -> attributes;

	// unset($data['password']);

	// $data['createUserName'] = $createUser['name'];
	// $data['updateUserName'] = $updateUser['name'];

	$isCreate = false;

	// $data['equipmentJson'] = explode(',', $data['equipmentJson']);
	$photoUrl = $b . '/upload/' . 'product' . '/' . $data['photo'];
	$data['photo'] = '<a href="' . $photoUrl . '" target="_blank"><img src="' . $photoUrl . '" class="thumb"></a>';

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


	$(document).ready(function() {

		// changeType();

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
					html += '<td><input type="hidden" name="photo[' + guid + ']" value="' + x['fileName'] + '.' + x['ext'] + '" />';
					html += '<a href="' + baseUrl + '/upload/' + _controllerName + '/' + x['fileName'] + '.' + x['ext'] + '" target="_blank">';
					html += '<img src="' + baseUrl + '/upload/' + _controllerName + '/' + x['fileName'] + '.' + x['ext'] + '"  class="photoThumb"/></a></td>';
					html += '<td class="text-center hide"><input class="checkbox checkboxMainPhoto" type="checkbox" name="isMainPhoto[' + guid + ']" value="1" checked="checked" /></td>';
					html += '<td><input class="form-control" type="text" name="photoSequence[' + guid + ']" value="9999" /></td>';
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
