
<script>
	function xxx() {
		var url = 'http://app.mobuy.tw/new/api/addPark';

		var carLicense = '55667788';
		var place = 'place';
		var email = 'qweqwe@qweqwe.com';

		$.ajax({
			url : url,
			type : 'post',
			dataType : 'json',
			data : {
				carLicense : carLicense,
				place : place,
				email : email

			},
			success : function(r) {
				//qqq

				alert('qq');

			}
		});

	}

	xxx();

</script>