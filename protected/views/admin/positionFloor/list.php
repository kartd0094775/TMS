<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> Position Floor</h2>

	<div class="breadcrumbs hide">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>" t>Home</a>
			</li>

			<li class="active" t>
				Position Floor
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
							<!-- <a class="btn btn-default btn-success " href="<?php print $this -> url('create'); ?>" t>Create</a> -->
						</div>

						<div class="col-md-6 text-right">
							<label>
								<select class="chosen-select form-control itemPerPage" >
									<option value="10" selected="selected">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
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
								<th class="sortable sort-alpha" orderField="deviceID">deviceID</th>
								<th class="sortable sort-alpha" orderField="ts">ts</th>
								<th class="sortable sort-alpha" orderField="buildingCode">buildingCode</th>
								<th class="sortable sort-alpha" orderField="navEnable">navEnable</th>
								<th class="sortable sort-alpha" orderField="gpsLat">gpsLat</th>
								<th class="sortable sort-alpha" orderField="gpsLng">gpsLng</th>
								<th class="sortable sort-alpha" orderField="gpsAcc">gpsAcc</th>
								<th class="sortable sort-alpha" orderField="locX">locX</th>
								<th class="sortable sort-alpha" orderField="locY">locY</th>
								<th class="sortable sort-alpha" orderField="locZ">locZ</th>
								<th class="sortable sort-alpha" orderField="locAcc">locAcc</th>
								<th class="sortable sort-alpha" orderField="ip">ip</th>
								<th class="sortable sort-alpha" orderField="createTime">createTime</th>

								<th ></th>
							</tr>

							<tr class="hide">
								<th >
								<input type="text" class="form-control search" name="id" />
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
print $this -> printJson('productType', $this -> getType('product.type'));
print $this -> printJson('is', $this -> getType('is'));
?>

<script>
	function getListHtml(data) {
		var html = '';
		for (var i in data) {
			var x = data[i];

			if (x['buildingCode'] == 'n/a') {
				continue;
			}

			html += '<tr>';

			// html += '<td><img src="' + baseUrl + '/upload/sticker/' + v(x['photo']) + '" class="listThumb"/></td>';

			html += '<td>' + v(x['id']) + '</td>';
			html += '<td>' + v(x['deviceID']) + '</td>';
			html += '<td>' + v(x['ts']) + '</td>';
			html += '<td>' + v(x['buildingCode']) + '</td>';
			html += '<td>' + v(x['navEnable']) + '</td>';
			html += '<td>' + v(x['gpsLat']) + '</td>';
			html += '<td>' + v(x['gpsLng']) + '</td>';
			html += '<td>' + v(x['gpsAcc']) + '</td>';
			html += '<td>' + v(x['locX']) + '</td>';
			html += '<td>' + v(x['locY']) + '</td>';
			html += '<td>' + v(x['locZ']) + '</td>';
			html += '<td>' + v(x['locAcc']) + '</td>';
			html += '<td>' + v(x['ip']) + '</td>';
			html += '<td>' + v(x['createTime']) + '</td>';

			html += '<td>';
			html += '<a class="btn btn-default btn-success btn-xs update" href="' + getUrl('view?building=' + x['buildingCode'] + '&floor=' + x['locZ']) + '" t>View</a> ';
			html += '</td>';

			// html += '<td>' + v(productType[x['typeID']]) + '</td>';

			/*
			 html += '<td>';
			 html += '<a class="btn btn-default btn-success btn-xs update" href="' + getUrl('update?id=' + x['id']) + '" t>Edit</a> ';
			 html += '<button type="button" class="btn btn-danger btn-xs delete" onclick="deleteItem(' + x['id'] + ', this)" t>Delete</button> ';
			 html += '</td>';
			 */
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

