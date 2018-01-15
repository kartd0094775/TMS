<style>
	.memoTitle {
		font-size: 14px;
		margin-bottom: 10px;
	}
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!-- page header -->
<div class="pageheader ">

	<h2><i class="fa fa-file-o" style="line-height: 48px;padding-left: 2px;"></i> 使用者數量/調用次數</h2>

	<div class="breadcrumbs  ">
		<ol class="breadcrumb">
			<li t>
				You are here
			</li>
			<li>
				<a href="<?php print $this -> getUrl('index', 'dashboard'); ?>" t>Home</a>
			</li>

			<!-- <li class="" t>
			<a href="<?php print $this -> getUrl('list'); ?>" t>Author list</a>
			</li> -->

			<li class="active" t>
				使用者數量/調用次數
			</li>

		</ol>
	</div>

</div>
<!-- /page header -->

<div class="main">

	<section class="tile color transparent-black">
		<div class="tile-body">
			<?php ?>

			<div class="row">
				<div class="col-md-12">
					<div class="memoTitle">
						A.累計至今不重複使用者數量總數和 (使用左邊縱軸數量刻度) (不重複總用戶數)
					</div>
					<div class="memoTitle">
						B.單日不重複使用者數量 (使用左邊縱軸數量刻度) (不重複日活躍數)
					</div>
					<div class="memoTitle">
						C.單日API呼叫次數(可重複同個ID)  (API日活躍數) (使用右邊縱軸數量刻度)
					</div>
					<div class="memoTitle">
						D.上述C的七日平均線  (API日活躍數均線) (使用右邊縱軸數量刻度)
					</div>
					<div class="memoTitle">
						E.上述B的資料但只計算navEnable: 1的部分 (每日不重複有使用導航功能用戶數) (使用左邊縱軸數量刻度)
					</div>

					<hr>
					<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					<hr>
					<div style="height:20px"></div>
					<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php

print $this -> printJson('dataA', $a);
print $this -> printJson('dataB', $B);
print $this -> printJson('dataC', $c);
print $this -> printJson('dataD', $d);
print $this -> printJson('dataE', $e);

$today = new DateTime();
$qq = $today -> modify('-' . '7' . ' day');
$startYear = $qq -> format('Y');
$startMonth = $qq -> format('m');
$startDay = $qq -> format('d');

print $this -> printJson('startYear', $startYear);
print $this -> printJson('startMonth', $startMonth);
print $this -> printJson('startDay', $startDay);
?>
<script>
	// Data retrieved from http://vikjavev.no/ver/index.php?spenn=2d&sluttid=16.06.2015.
	$(function() {
		//
		// var seriesA = {
		// name : 'A',
		// data : [0.2, 0.8, 0.8, 0.8, 1, 1.3, 1.5, 2.9, 1.9, 2.6, 1.6, 3, 4, 3.6, 4.5, 4.2, 4.5, 4.5, 4, 3.1, 2.7, 4, 2.7, 2.3, 2.3, 4.1, 7.7, 7.1, 5.6, 6.1, 5.8, 8.6, 7.2, 9, 10.9, 11.5, 11.6, 11.1, 12, 12.3, 10.7, 9.4, 9.8, 9.6, 9.8, 9.5, 8.5, 7.4, 7.6]
		//
		// }
		//

		var seriesA = {
			name : 'A',
			data : dataA
		}

		var seriesB = {
			name : 'B',
			data : dataB
		}

		var seriesC = {
			name : 'C',
			data : dataC
		}

		var seriesD = {
			name : 'D',
			data : dataD
		}

		var seriesE = {
			name : 'E',
			data : dataE
		}

		$('#container1').highcharts({
			chart : {
				type : 'spline'
			},
			title : {
				// text : 'qqqqqqqqqq'
				text : ''
			},
			subtitle : {
				// text : 'Mzzzzzzzzzzz'
				text : ''
			},
			xAxis : {
				type : 'datetime',
				labels : {
					overflow : 'justify'
				}
			},
			yAxis : {
				title : {
					text : 'Quantity'
				},
				minorGridLineWidth : 0,
				gridLineWidth : 0,
				alternateGridColor : null

			},
			tooltip : {
				// valueSuffix : ' m/s'
			},
			plotOptions : {
				spline : {
					lineWidth : 4,
					states : {
						hover : {
							lineWidth : 5
						}
					},
					marker : {
						enabled : false
					},
					pointInterval : 86400000, // one hour
					pointStart : Date.UTC(startYear, startMonth, startDay, 0, 0, 0)
				}
			},
			series : [seriesA, seriesB],
			navigation : {
				menuItemStyle : {
					fontSize : '10px'
				}
			}
		});

		$('#container2').highcharts({
			chart : {
				type : 'spline'
			},
			title : {
				// text : 'qqqqqqqqqq'
				text : ''
			},
			subtitle : {
				// text : 'Mzzzzzzzzzzz'
				text : ''
			},
			xAxis : {
				type : 'datetime',
				labels : {
					overflow : 'justify'
				}
			},
			yAxis : {
				title : {
					text : 'Quantity'
				},
				minorGridLineWidth : 0,
				gridLineWidth : 0,
				alternateGridColor : null

			},
			tooltip : {
				// valueSuffix : ' m/s'
			},
			plotOptions : {
				spline : {
					lineWidth : 4,
					states : {
						hover : {
							lineWidth : 5
						}
					},
					marker : {
						enabled : false
					},
					pointInterval : 86400000, // one hour
					pointStart : Date.UTC(startYear, startMonth, startDay, 0, 0, 0)
				}
			},
			series : [seriesD, seriesE],
			navigation : {
				menuItemStyle : {
					fontSize : '12px'
				}
			}
		});

	});

</script>