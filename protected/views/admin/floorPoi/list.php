<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i><span t> <?php

	if ($floor) {
		print 'Floor POI - ' . $floor['name'];

	} else {
		print 'Floor POI';
	}
		?> </span></h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="active" t>
				<?php

				if ($floor) {
					print 'Floor POI - ' . $floor['name'];

				} else {
					print 'Floor POI';
				}
				?>

			</li>
		</ol>
	</div>

</div>
<!-- /page header -->

<!-- content main container -->
<div class="main">

	<!-- row -->
	<div class="row">

		<!-- col 12 -->
		<div class="col-md-12">

			<section class="tile color transparent-black" id="list">

				<!-- tile widget -->
				<div class="tile-widget bg-transparent-black-2">
					<div class="row">
						<div class="col-md-6">
							<a class="btn btn-default btn-success create " href="<?php print $this -> url('create?id=' . get('id')); ?>" t>Create</a>

							<!-- <a class="btn btn-default btn-danger export " href="<?php print $this -> url('exportExcelDo'); ?>" t>Export</a> -->
						</div>

						<div class="col-md-6 text-right">
							<label>
								<select class="chosen-select form-control itemPerPage" >
									<option value="10">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100" selected="selected">100</option>
									<option value="500" >500</option>
								</select> </label>
							<label t> Records per page </label>
						</div>

					</div>
				</div>
				<!-- /tile widget -->

				<!-- tile body -->
				<div class="tile-body nopadding">

					<table class="table table-bordered table-sortable table-striped">
						<thead>
							<tr>
								<th class="sortable sort-alpha" orderField="id" style="width:60px">ID</th>
								<th class="sortable sort-alpha"  style="width:60px">Photo</th>
								<th class="sortable sort-alpha" orderField="iconID"   style="width:60px">Icon</th>
								<th class="sortable sort-alpha" orderField="name" t>Name</th>
								<th class="sortable sort-alpha" orderField="nameEnglish" t>Name English</th>
								<th class="sortable sort-alpha" orderField="number" t>Number</th>
								<th class="sortable sort-alpha" orderField="buildingID" t>Building</th>
								<th class="sortable sort-alpha" orderField="priorityFrom" t>Priority From</th>
								<th class="sortable sort-alpha" orderField="priorityTo" t>Priority To</th>
								<!-- <th class="sortable sort-alpha" orderField="email" t>email</th> -->
								<!-- <th class="sortable sort-alpha" orderField="createTime" t>註冊時間</th> -->

								<!-- <th class="sortable sort-alpha" orderField="addressBuilding" t>棟</th>
								<th class="sortable sort-alpha" orderField="addressNumber" t>號</th>
								<th class="sortable sort-alpha" orderField="addressFloor" t>樓</th> -->

								<th ></th>
							</tr>

							<tr>

								<th >
								<input type="hidden" class="form-control search" name="floorID" value="<?php print get('id'); ?>" />
								<input type="text" class="form-control search" name="id" />
								</th>

								<th></th>
								<th></th>
								<th >
								<input type="text" class="form-control search" name="name" />
								</th>
								<th >
								<input type="text" class="form-control search" name="nameEnglish" />
								</th>
								<th >
								<input type="text" class="form-control search" name="number" />
								</th>
								<th ><!-- <input type="text" class="form-control search" name="priorityFrom" /> --></th>
								<th >
								<input type="text" class="form-control search" name="priorityFrom" />
								</th>
								<th >
								<input type="text" class="form-control search" name="priorityTo" />
								</th>

								<!--
								<th >
								<input type="text" class="form-control search" name="email" />
								</th>

								<th >
								<input type="text" class="form-control search" name="createTime" />
								</th> -->
								<!-- <th >
								<input type="text" class="form-control search" name="addressBuilding" />
								</th>
								<th >
								<input type="text" class="form-control search" name="addressNumber" />
								</th>
								<th >
								<input type="text" class="form-control search" name="addressFloor" />
								</th> -->
								<!-- <th >
								<input type="text" class="form-control search" name="phoneMobile" />
								</th>

								<th >
								<select name="isIn" class="chosen-select form-control search" >
								<option value="">----</option>
								<?php
								print $this -> printTypeOption('is');
								?>
								</select></th>

								<th>
								<input type="text" class="form-control search " name="address" />
								</th>

								<th>
								<input type="text" class="form-control search datepicker" name="date" />
								</th> -->
								<!-- <th >
								<input type="text" class="form-control search" name="address" />
								</th> -->

								<!-- <th >
								<input type="text" class="form-control search" name="memo" />
								</th> -->

								<th >
								<button type="button"  class="btn btn-info buttonSearch" t>
									Search
								</button></th>
							</tr>

						</thead>
						<tbody class="list">

						</tbody>
					</table>

				</div>
				<!-- /tile body -->

				<!-- tile footer -->
				<div class="tile-footer bg-transparent-black-2 rounded-bottom-corners">
					<div class="row dataTables_length">

						<div class="col-sm-4">

							<!-- <label>
							<div class="input-group " style="">
							<input type="text" class="form-control" placeholder="go to page.." style="width:100px;">
							<span class="input-group-btn">
							<button type="button" class="btn btn-default">
							Go!
							</button> </span>
							</div> </label> -->

							<div class="input-group table-options">
								<input class="form-control goToPage" style="min-height:25px;width:100px;font-size:12px;" t placeholder="go to page..">

								<span class="input-group-btn pull-left">
									<button type="button" class="btn btn-default buttonGoToPage" t>
										Go
									</button> </span>
							</div>

						</div>

						<div class="col-sm-4 text-center">
							<small class="inline table-options paging-info" ><span t>showing page</span> <span class="currentPage"></span><span t> of </span><span class="totalItem"></span> <span t>items</span></small>

						</div>

						<div class="col-sm-4 text-right sm-center">
							<ul class="pagination pagination-xs nomargin pagination-custom pageFrame">
								<!--
								<li class="disabled">
								<a href="#"><i class="fa fa-angle-double-left"></i></a>
								</li>
								<li class="active">
								<a href="#">1</a>
								</li>
								<li>
								<a href="#">2</a>
								</li>
								<li>
								<a href="#">3</a>
								</li>
								<li>
								<a href="#">4</a>
								</li>
								<li>
								<a href="#">5</a>
								</li>
								<li>
								<a href="#"><i class="fa fa-angle-double-right"></i></a>
								</li> -->
							</ul>
						</div>

					</div>
				</div>
				<!-- /tile footer -->

			</section>

		</div>
		<!-- /col 12 -->

	</div>
	<!-- /row -->

</div>
<!-- /content container -->

<?php
print $this -> printJson('is', $this -> getType('is'));
?>

<script>
	function getListHtml(data) {
		var html = '';
		for (var i in data) {
			var x = data[i];

			html += '<tr>';

			html += '<td>' + v(x['id']) + '</td>';

			html += '<td><img onerror="$(this).hide()" class="listThumb" src="' + baseUrl + '/upload/floor/' + v(x['photo']) + '" /></td>';
			html += '<td><img onerror="$(this).hide()" class="listThumb" src="' + baseUrl + '/resource/icon/icon_' + v(x['iconCode']) + '.png" /></td>';

			html += '<td>' + v(x['name']) + '</td>';
			html += '<td>' + v(x['nameEnglish']) + '</td>';
			html += '<td>' + v(x['number']) + '</td>';
			// html += '<td><a href="'+baseUrl+'/admin/" target="_blank">' + v(x['buildingName']) + '</a></td>';
			html += '<td>' + v(x['buildingName']) + '</td>';
			html += '<td>' + v(x['priorityFrom']) + '</td>';
			html += '<td>' + v(x['priorityTo']) + '</td>';

			// html += '<td>' + v(x['email']) + '</td>';
			// html += '<td>' + v(x['phoneMobile']) + '</td>';
			// html += '<td>' + v(is[x['isIn']]) + '</td>';

			// html += '<td>' + v(x['createTime']) + '</td>';

			// html += '<td>' + v(x['memo']) + '</td>';

			html += '<td>';
			html += '<a class="btn btn-default btn-success btn-xs read" href="' + baseUrl + '/' + controllerName + '/update?id=' + x['id'] + '" t>Edit</a> ';
			//html += '<a class="btn btn-default btn-warning btn-xs read" href="' + baseUrl + '/' + 'admin/hotelRoom' + '/list?id=' + x['id'] + '" t>房間管理</a> ';
			// html += '<a class="btn btn-default btn-warning btn-xs read" href="' + baseUrl + '/' + controllerName + '/record?id=' + x['id'] + '" t>Rent record</a> ';
			html += '<button type="button" class="btn btn-danger btn-xs delete" onclick="deleteItem(' + x['id'] + ', this)" t>Delete</button> ';
			html += '</td>';

			html += '</tr>';

		}
		return html;
	}

	$(function() {
		//init list page
		initListPage();

		//get list when ready
		getList();

	}); 
</script>

