<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> <span t>商家資料</span></h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>" t>Home</a>
			</li>

			<li class="" >
				<a href="<?php print $this -> getUrl('list'); ?>" t>商家管理</a>
			</li>

			<li class="active" t>
				商家資料
			</li>

		</ol>
	</div>

</div>
<!-- /page header -->

<div class="main">

	<section class="tile color transparent-black">

		<!-- tile body -->
		<div class="tile-body">

			<form role="form" id="itemForm" class="form-horizontal" parsley-validate id="form" method="post" action="<?php print $this -> url('updateDo'); ?>" enctype="multipart/form-data" >

				<input type="hidden" name="id" />
				
				 
				
				 
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>名稱</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="name" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>帳號</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="account" />
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
					<label for="fullname" class="col-sm-2 control-label" ><span t>重設密碼</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="password" name="password" />
						<br>
						
						<input type="text" class="form-control" id="password2" name="password2" />
						<div>要重設密碼才輸入</div>
						
					</div>
				</div>
				
					
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>店長名字</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nickname" />
					</div>
				</div>
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>電話</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="tel" />
					</div>
				</div>
				
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>區域</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control"  name="area"  />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>地址</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control"  name="address"  />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>休假</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control"  name="vacation"  />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>網站</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control"  name="website"  />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>Facebook</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control"  name="fburl"  />
					</div>
				</div>
				
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>簡述</span></label>
					<div class="col-sm-10">
						<textarea type="text" class="form-control"  name="description" style="height:200px" ></textarea>
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

							$photoJson = json_decode($item['photos'], true);

							// print_r($photoJson);
							// die();

							if (is_array($photoJson)) {
								foreach ($photoJson as $k => $x) {

									$guid = getGuid();
									// $guid = $x['id'];

									/*
									 id
									 "fff18a76-7655-4495-ba94-56141b50f856"
									 mime

									 "image/jpeg"
									 name

									 "13101401_1226934283984411_357923752_n.jpg"
									 size

									 102819
									 url

									 "http://mobuy-s.xtremeapp.com.tw/files/photo/fff18a76-7655-4495-ba94-56141b50f856"
									 */

									/*
									 if (isset($x['isMainPhoto']) && $x['isMainPhoto'] == '1') {
									 $checked = ' checked="checked" ';
									 }

									 if (isset($x['isOpenPhoto']) && $x['isOpenPhoto'] == '1') {
									 $checked2 = ' checked="checked" ';
									 }
									 */
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

								}
							}
							?>
						</table>

					</div>
				</div>
				
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>拍賣資訊</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control"  name="onsaleInformation"  />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>經度</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control"  name="lat"  />
					</div>
				</div>
				
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>緯度</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control"  name="lon"  />
					</div>
				</div>
				
				<!-- <div class="form-group">
				<label for="fullname" class="col-sm-2 control-label" ><span t>Active</span></label>
				<div class="col-sm-10">
	<select name="isActive"  class="chosen-select form-control" >
							<option value="">----</option>
							<?php print $this -> printTypeOption('is'); ?>
						</select>


				</div>
			</div> -->
			
			

			
			

			<div class="form-group form-footer">
				<div class="col-sm-12 text-center">
					<button class="btn btn-default update" type="button" t onclick="checkForm()">
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
</form>
 


<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;

	unset($data['password']);

	// $data['languageRequireIDs'] = explode(',', $item['languageRequireIDs']);
	// $data['keywordIDs'] = explode(',', $item['keywordIDs']);
	// $data['specialIDs'] = explode(',', $item['specialIDs']);

	// $data['createUserName'] = $createUser['name'];
	// $data['updateUserName'] = $updateUser['name'];

	// $data['genderID'] = $this -> getTypeText('gender', $item['genderID']);
	// $data['mostID'] = $this -> getTypeText('catalog.most', $item['mostID']);
	// $data['planID'] = $this -> getTypeText('catalog.plan', $item['planID']);
	// $data['howToKnowID'] = $this -> getTypeText('catalog.howToKnow', $item['howToKnowID']);

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
	$('#itemForm').submit();
	return;

		//create
		var name = $('*[name=name]').val();

		var isOk = true;
		var message = '';

		if (name == '') {
			message += "請輸入名稱\n";
			isOk = false;
		}
		　

		if (isOk) {
			$('#itemForm').submit();

		} else {
			alert(message);
		}

	}


	$(document).ready(function() {
		
		// $('*[name=name]').attr('disabled', true);
		
		if (data != null) {
			assignFormValue('itemForm', data);

			setCheckboxMainPhoto();

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

	}); </script>

	<script>
		$(document).ready(function() {

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

		});

		function setCheckboxMainPhoto() {

			$('.checkboxMainPhoto').click(function() {

				$('.checkboxMainPhoto').prop('checked', false);
				$(this).prop('checked', true);
			});

		}

		function deletePhotoItem(e) {
			$(e).parent().parent().remove();
		}

</script>

