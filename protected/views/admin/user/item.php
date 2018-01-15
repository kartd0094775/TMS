<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i><span t>User details</span></h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="" >
				<a href="<?php print $this -> url('list'); ?>" t>User list</a>
			</li>

			<li class="active" t>
				User details
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
					<label for="fullname" class="col-sm-2 control-label" ><span t>Company</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="companyName" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>帳號</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="email" />
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>密碼</span></label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="password" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="name" />
					</div>
				</div>

				<!--
				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Facebook</span></label>
				<div class="col-sm-10">
				<div type="text" class="form-control" name="fbID"  ></div>
				</div>
				</div> -->
				<!--
				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Birthday</span></label>
				<div class="col-sm-10">
				<input type="text" class="form-control datepicker" name="birthday" />
				</div>
				</div> -->
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Phone home</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="phoneHome" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Phone mobile</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="phoneMobile" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Address</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="address" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Is in</span></label>
					<div class="col-sm-10">
						<select name="isIn"  class="chosen-select form-control" >
							<!-- <option value="">----</option> -->
							<?php print $this -> printTypeOption('is'); ?>
						</select>

					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>管理者備註</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="memo" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>是否完成驗證</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="isEmailVerify" disabled="" />
					</div>
				</div>

				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Password</span></label>
				<div class="col-sm-10">
				<input type="text" class="form-control" name="password" />
				</div>
				</div>
				-->

				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>公司照片</span></label>
				<div class="col-sm-10">

				<span class="btn btn-success fileinput-button" onclick="$('#uploadPhoto').click()"> <i class="fa fa-plus"></i> <span> 選擇照片</span> </span>
				<input type="file" class="form-control hide"  name="uploadPhoto" id="uploadPhoto">

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

<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;

	unset($data['password']);

	$data['isEmailVerify'] = $this -> getTypeText('is', $data['isEmailVerify']);

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
