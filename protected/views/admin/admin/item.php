<!-- page header -->
<div class="pageheader">




	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i><span t>Admin details</span></h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li >
				<a href="<?php print $this -> url('list'); ?>" t>Admin list</a>
			</li>

			<li class="active" t>
				Admin details
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
					<label for="fullname" class="col-sm-2 control-label" ><span t>Username</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="account" />
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Email</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="email" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nickname" />
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Password</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="password" />
						<div>
							(需要重設密碼才輸入)
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>API Key</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" readonly name="apiKey" />

						<label class="btn btn-primary">
							<input type="checkbox" name="isChangeApiKey" value="1"/>
							更換Api Key</label>
					</div>
				</div>

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Buildings</span></label>
					<div class="col-sm-10">
						<!-- <input type="text" class="form-control" name="password" /> -->

						<select name="buildingIDs[]" id="buildingIDs" multiple="" select2 class="form-control">
							<?php
							if (is_array($buildings)) {
								foreach ($buildings as $x) {
									print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
								}
							}
							?>
						</select>
						<div>
							(選擇可以查詢的資料)
						</div>
					</div>
				</div>

				<!--
				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span></label>
				<div class="col-sm-10">
				<input type="text" class="form-control" name="name" />
				</div>
				</div> -->

				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Base Value</span></label>
				<div class="col-sm-10">
				<input type="text" class="form-control" name="baseValue" />
				</div>
				</div> -->

				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>公司照片</span></label>
				<div class="col-sm-10">

				<span class="btn btn-success fileinput-button" onclick="$('#uploadPhoto').click()"> <i class="fa fa-plus"></i> <span> 選擇照片</span> </span>
				<input type="file" class="form-control hide"  name="uploadPhoto" id="uploadPhoto">

				</div>
				</div> -->

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Role</span></label>
					<div class="col-sm-10">

						<select class="form-control" name="roleID">
							<?php
							print $this -> printTypeOption('admin.role');
							?>
						</select>
					</div>
				</div>

				<div class="form-group   ">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Permission</span></label>
					<div class="col-sm-10">

						<table class="table table-bordered table-sortable table-striped" id="permissionTable">
							<thead>
								<tr >

									<th class="" t>Module</th>
									<th class="" ></th>
									<th class="" ><label>
										<input type="checkbox" class="selectColumnAll" permissionType="read" />
										<span t>Read</span></label></th>
									<th class="" ><label>
										<input type="checkbox" class="selectColumnAll" permissionType="create"  />
										<span t>Create</span></label></th>
									<th class="" ><label>
										<input type="checkbox" class="selectColumnAll" permissionType="update" />
										<span t>Update</span></label></th>
									<th class="" ><label>
										<input type="checkbox" class="selectColumnAll" permissionType="delete"  />
										<span t>Delete</span></label></th>

								</tr>

							</thead>

							<tbody>

								<?php

								$controllers = null;

								function getRow($modelName, $controllerName) {
									print '
<tr>
<td t>' . $modelName . '</td>
<td><label class="btn btn-default"><input type="checkbox" class="selectSideAll" /> <span t>Select all</span></label></td>
<td><label class="btn btn-warning"><input type="checkbox" permissionType="read" name="permissionJson[' . $controllerName . '][read]" value="1"/> <span t>' . t('Read') . '</span></label></td>
<td><label class="btn btn-success"><input type="checkbox" permissionType="create" name="permissionJson[' . $controllerName . '][create]" value="1"/> <span t>' . t('Create') . '</span></label></td>
<td><label class="btn btn-info"><input type="checkbox" permissionType="update" name="permissionJson[' . $controllerName . '][update]" value="1"/> <span t>' . t('Update') . '</span></label></td>
<td><label class="btn btn-danger"><input type="checkbox" permissionType="delete" name="permissionJson[' . $controllerName . '][delete]" value="1"/> <span t>' . t('Delete') . '</span></label></td>
</tr>';
								}

								foreach ($this->controllers as $x) {

									getRow($x['modelName'], $x['controllerName']);

								}
								?>
							</tbody>

						</table>

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

<?php

$isCreate = true;

// print_r($item);
// die();

if (isset($item)) {
	$data = $item -> attributes;

	// unset($data['password']);

	// $data['createUserName'] = $createUser['name'];
	// $data['buildingIDs'] = explode(',', $item['buildingIDs']);

	unset($data['password']);
	$isCreate = false;
} else {
	$data = null;
}

// $permissionJson = json_decode($item['permissionJson'], true);

print $this -> printJson('permissionJson', $item['permissionJson']);
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
			buildingIDs

			$('#buildingIDs').val(data['buildingIDs']).change();

			/*
			for (var i in data['buildingIDs']) {
			var x = data['buildingIDs'][i];
			$('*[name="buildingIDs[]"][value="' + x + '"]').prop('checked', true);
			}
			*/

			//set permission

			if (permissionJson != null) {
				for (var i in permissionJson) {
					var x = permissionJson[i];

					if (x['create'] == 1) {
						$('#permissionTable').find('*[name="permissionJson[' + i + '][create]"]').prop('checked', true);
					}

					if (x['read'] == 1) {
						$('#permissionTable').find('*[name="permissionJson[' + i + '][read]"]').prop('checked', true);
					}

					if (x['update'] == 1) {
						$('#permissionTable').find('*[name="permissionJson[' + i + '][update]"]').prop('checked', true);
					}

					if (x['delete'] == 1) {
						$('#permissionTable').find('*[name="permissionJson[' + i + '][delete]"]').prop('checked', true);
					}

				}

				// setOptionItem();
			}

		} else {

		}

		//permission table event

		$('.selectSideAll').click(function() {
			var v = $(this).prop('checked');

			if (v) {
				$(this).parent().parent().parent().find('input').prop('checked', true);
			} else {
				$(this).parent().parent().parent().find('input').prop('checked', false);
			}
		});

		$('.selectColumnAll').click(function() {
			var permissionType = $(this).attr('permissionType');
			var v = $(this).prop('checked');

			if (v) {
				$('#permissionTable').find('*[permissionType="' + permissionType + '"]').prop('checked', true);
			} else {
				$('#permissionTable').find('*[permissionType="' + permissionType + '"]').prop('checked', false);
			}
		});
		//set is read
		setIsRead('itemForm', isRead);

	}); 
</script>
