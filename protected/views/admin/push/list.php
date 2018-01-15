<!-- page header -->
<div class="pageheader">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> <span t>Rent list</span></h2>

	<div class="breadcrumbs">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> url('index', 'admin/dashboard'); ?>" t>Home</a>
			</li>

			<li class="active" t>
				Rent list
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
							<a class="btn btn-default btn-success create " href="<?php print $this -> url('create'); ?>" t>Create</a>

							<a class="btn btn-default btn-danger export " href="<?php print $this -> url('exportExcelDo'); ?>" t>Export</a>

						</div>

						<div class="col-md-6 text-right">
							<label>
								<select class="chosen-select form-control itemPerPage" >
									<option value="10" selected="selected">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
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
								<th class="sortable sort-alpha" orderField="name" t>姓名</th>
								<th class="sortable sort-alpha" orderField="companyName" t>公司行號</th>
								<th class="sortable sort-alpha" orderField="typeID" t>需求類型</th>
								<th class="sortable sort-alpha" orderField="sizeID" t>坪數需求</th>
								<th class="sortable sort-alpha" orderField="phoneHome" t>聯絡電話(室內)</th>
								<th class="sortable sort-alpha" orderField="phoneMobile" t>聯絡電話(手機)</th>
								<th class="sortable sort-alpha" orderField="email" t>信箱</th>
								<th class="sortable sort-alpha" orderField="createTime" t>申請日期</th>
								<th class="sortable sort-alpha" orderField="memo" t>客戶備註</th>
								<th class="sortable sort-alpha" orderField="statusID" t>狀態</th>
								<th class="sortable sort-alpha" orderField="memoAdmin" t>管理者註記</th>

								<th ></th>
							</tr>

							<tr>

								<th >
								<input type="text" class="form-control search" name="id" />
								</th>
								<!-- <th >
								<input type="text" class="form-control search" name="password" />
								</th> -->
								<th >
								<input type="text" class="form-control search" name="name" />
								</th>

								<th >
								<input type="text" class="form-control search" name="companyName" />
								</th>


								<th >
								<select name="typeID" class="chosen-select form-control search" style="width:120px" >
									<option value="">----</option>
									<?php
									print $this -> printTypeOption('rent.type');
									?>
								</select></th>

								<th >
								<select name="sizeID" class="chosen-select form-control search"  style="width:130px">
									<option value="">----</option>
									<?php
									print $this -> printTypeOption('rent.size');
									?>
								</select></th>
								

								<th >
								<input type="text" class="form-control search" name="phoneHome" />
								</th>

								<th >
								<input type="text" class="form-control search" name="phoneMobile" />
								</th>
								<th >
								<input type="text" class="form-control search" name="email" />
								</th>

								<!-- <th >
								<input type="text" class="form-control search datepicker" name="date" />
								</th> -->
									<th>
								<input type="text" class="form-control search datepicker" name="dateFrom" style="display:inline-block; width:100px;" /> ~ 
								<input type="text" class="form-control search datepicker" name="dateTo" style="display:inline-block; width:100px;" />
								
								</th>

								<th >
								<input type="text" class="form-control search" name="memo" />
								</th>

								<th >
								<select name="statusID" class="chosen-select form-control search" style="min-width:100px">
									<option value="">----</option>
									<?php
									print $this -> printTypeOption('rent.status');
									?>
								</select></th>

								<th >
								<input type="text" class="form-control search" name="memoAdmin" />
								</th>

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
print $this -> printJson('rentType', $this -> getType('rent.type'));
print $this -> printJson('rentStatus', $this -> getType('rent.status'));
print $this -> printJson('rentSize', $this -> getType('rent.size'));
?>

<script>
	function getListHtml(data) {
		var html = '';
		for (var i in data) {
			var x = data[i];

			html += '<tr>';

			html += '<td>' + v(x['id']) + '</td>';
			html += '<td>' + v(x['name']) + '</td>';

			html += '<td>' + v(x['companyName']) + '</td>';
			html += '<td>' + v(rentType[x['typeID']]) + '</td>';
			html += '<td>' + v(rentSize[x['sizeID']]) + '</td>';
			html += '<td>' + v(x['phoneHome']) + '</td>';
			html += '<td>' + v(x['phoneMobile']) + '</td>';
			html += '<td>' + v(x['email']) + '</td>';
			html += '<td>' + v(x['createTime']) + '</td>';
			html += '<td>' + v(x['memo']) + '</td>';
			html += '<td>' + v(rentStatus[x['statusID']]) + '</td>';
			html += '<td>' + v(x['memoAdmin']) + '</td>';

			html += '<td>';
			html += '<a class="btn btn-default btn-success btn-xs read" href="' + baseUrl + '/' + controllerName + '/update?id=' + x['id'] + '" t>Edit</a> ';
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

