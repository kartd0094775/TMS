<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> <span t>問卷設定</span></h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>" t>Home</a>
			</li>

			<li class="" >
				<a href="<?php print $this -> getUrl('list'); ?>" t>問卷管理</a>
			</li>

			<li class="active" t>
				問卷設定
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
					<label for="fullname" class="col-sm-2 control-label" ><span t>Name</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" />
					</div>
				</div>
				

				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>日期起</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control datepicker"  name="dateFrom"   />
					</div>
				</div>
				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>日期迄</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control datepicker"  name="dateTo"   />
					</div>
				</div>
				
				

				
				<div class="form-group">
					<label for="fullname" class="col-sm-2 control-label" ><span t>問卷</span></label>
					<div class="col-sm-10">

						<div>
							<a class="btn btn-default btn-success create " onclick="addQuestion()" t>新增問題</a>

						</div>

						<table class="table table-bordered table-sortable table-striped" id="tableQuestionary">

							<thead>			
								<tr>
									<td>問題</td>
									<td>選項(使用;;;隔開)</td>
									<td>選擇方式</td>
									<td></td>

								</tr>

							</thead>
							<tbody>
							</tbody>


						</table>

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
	<!-- <input type="file" name="files" multiple  accept="image/*"> -->
	<input type="file" name="files"   accept="image/*">
</form>


<?php

$isCreate = true;

if (isset($item)) {
	$data = $item -> attributes;


	$data['jsonData'] = json_decode($data['jsonData'], true);
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

function addQuestion(guid){


	var html = '';

	if(typeof(guid) == 'undefined'){
		guid = getGuid();
	}

	html += '<tr>';
	html += '<td><input type="text" class="form-control" name="jsonData['+guid+'][name]" /></td>';
	html += '<td><input type="text" class="form-control" name="jsonData['+guid+'][answer]" /></td>';
	html += '<td><label><input type="checkbox" class="" name="jsonData['+guid+'][isMultiple]" /> 複選</label></td>';
	html += '<td><button class="btn btn-danger" onclick="deleteQuestion(this)">刪除</button></td>';
	html += '</tr>';

	$('#tableQuestionary tbody').append(html);

}


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

			// setCheckboxMainPhoto();


			for(var i in data['jsonData']){

				addQuestion(i);
				
				var x = data['jsonData'][i];
				
				//set value
				$('#tableQuestionary tr:last td:eq(0) input').val(x['name']);
				$('#tableQuestionary tr:last td:eq(1) input').val(x['answer']);
				
			}



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

				$('#tablePhoto tbody *').remove();

				for (var i in fileUploadData) {

					var x = fileUploadData[i];

					var guid = getGuid();

					// var guid = getGuid();
					html += '<tr>';
					html += '<td><input type="hidden" name="photo[' + guid + ']" value="' + x['fileName'] + '.' + x['ext'] + '" />';
					html += '<a href="' + baseUrl + '/upload/slider/' + x['fileName'] + '.' + x['ext'] + '" target="_blank">';
					html += '<img src="' + baseUrl + '/upload/slider/' + x['fileName'] + '.' + x['ext'] + '"  class="photoThumb"/></a></td>';
					html += '<td class="text-center hide"><input class="checkbox checkboxMainPhoto" type="checkbox" name="isMainPhoto[' + guid + ']" value="1" checked="checked" /></td>';
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
function deleteQuestion(e) {
	$(e).parent().parent().remove();
}

</script>

