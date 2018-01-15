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


$items = City::model() -> findAll();

$temp = null;
foreach ($items as $x) {
	// $a = null;
	// $a['id'] = $x['id'];
	// $a['name'] = $x['name'];
	$temp[$x['id']] = $x['name'];
}
print $this -> printJson('city', $temp);

?>

<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Building list</h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="active" t>
				Building list
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

				<input type="hidden" class="search" name="buildingID" value="<?php print get('id'); ?>">

				<!-- tile widget -->
				<div class="tile-widget bg-transparent-black-2">
					<div class="row">
						<div class="col-md-6">
							<a class="btn btn-default btn-success create" href="<?php print $this -> url('create'); ?>" t>Create</a>
						</div>

						<div class="col-md-6 text-right">
							<label>
								<select class="chosen-select form-control itemPerPage" >
									<option value="10" >10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100" selected="selected">100</option>
								</select> </label>
							<label> Records per page </label>
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
								<!-- <th class="sortable sort-alpha" orderField="companyID">Company</th> -->
								<th class="sortable sort-alpha" orderField="cityID">City</th>
								<th class="sortable sort-alpha" orderField="code">BuildingID</th>
								<th class="sortable sort-alpha" orderField="name">Name</th>

								<th ></th>
							</tr>

							<tr>

								<th >
								<input type="text" class="form-control search" name="id" />
								</th>

								<th >
								<select class="form-control search" name="companyID" id="companyID">
									<option value="">----</option>
									<?php
									$items = City::model() -> findAll();
									foreach ($items as $x) {
										print '<option value="' . $x['id'] . '">' . $x['name'] . '</option>';
									}
									?>
								</select></th>

								<th >
								<input type="text" class="form-control search" name="code" />
								</th>

								<th >
								<input type="text" class="form-control search" name="name" />
								</th>

								<th >
								<button type="button"  class="btn btn-default buttonSearch" t>
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
								<input class="form-control goToPage" style="min-height:25px;width:100px;font-size:12px;" placeholder="go to page..">

								<span class="input-group-btn pull-left">
									<button type="button" class="btn btn-default buttonGoToPage" t>
										Go
									</button> </span>
							</div>

						</div>

						<div class="col-sm-4 text-center">
							<small class="inline table-options paging-info">showing page <span class="currentPage"></span> of <span class="totalItem"></span> items</small>

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

$companyID = get('id');

print $this -> printJson('companyID', $companyID);
?>
<script>
	function getListHtml(data) {
		var html = '';
		for (var i in data) {
			var x = data[i];

			html += '<tr>';

			html += '<td>' + v(x['id']) + '</td>';
			html += '<td>' + v(city[x['cityID']]) + '</td>';
			html += '<td>' + v(x['code']) + '</td>';
			html += '<td>' + v(x['name']) + '</td>';

			html += '<td>';
			html += '<a class="btn btn-default btn-success btn-xs update" href="' + baseUrl + '/' + controllerName + '/update?id=' + x['id'] + '" t>Edit</a> ';
			// html += '<a class="btn btn-default btn-info btn-xs" href="' + baseUrl + '/' + '/admin/indoor' + '/item?id=' + x['id'] + '" t>View</a> ';
			html += '<a class="btn btn-default btn-info btn-xs   floorRead" href="' + baseUrl + '/' + 'admin/floor' + '/list?id=' + x['id'] + '" t>Floor</a> ';

			html += '<a class="btn btn-default btn-primary btn-xs update floorRead" onclick="bundleDo(' + x['id'] + ')" t>重新打包zip</a> ';
			html += '<a class="btn btn-default btn-warning btn-xs update floorRead" href="' + baseUrl + '/resource/' + x['code'] + '.zip" t>下載zip</a> ';

			// html += '<button type="button" class="btn btn-info btn-xs delete" onclick="deleteItem(' + x['id'] + ', this)" t>View</button> ';
			html += '<button type="button" class="btn btn-danger update btn-xs delete" onclick="deleteItem(' + x['id'] + ', this)" t>Delete</button> ';
			html += '</td>';

			html += '</tr>';

		}
		return html;
	}

	function bundleDo(id) {

		var url = getUrl('bundleDo');
		$.ajax({
			url : url,
			type : 'post',
			// dataType : 'json',
			data : {
				id : id
			},
			success : function(r) {
				//qqq
				alert('打包完成');

			}
		});

	}

	$(function() {

		if (companyID != '') {
			$('#companyID').val(companyID);
		}

		//init list page
		initListPage();

		//get list when ready
		getList();

	}); 
</script>

