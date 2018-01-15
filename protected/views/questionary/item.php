<h1>Mobuy問卷調查</h1>
<h2><?php print $item['name']; ?></h2>
<form action="<?php print url('submitDo'); ?>" method="post" id="form">

	<input type="hidden" name="id" value="<?php print $questionaryList['id']; ?>" />

	<?php

	$jsonData = json_decode($item['jsonData'], true);
	if (is_array($jsonData)) {
		foreach ($jsonData as $k => $x) {

			$answers = explode(';;;', $x['answer']);

			if (count($answers) > 0) {
				print '
<div class="question">
	' . $x['name'] . '
</div>
<div class="answerFrame">
	<ol>';

				if (is_array($answers)) {
					$i = 0;
					foreach ($answers as $xx) {

						if (isset($x['isMultiple'])) {

							print '
		<li>
			<label>
				<input type="checkbox" name="' . $k . '[]" value="' . $i . '" /> ' . $xx . '</label>
		</li>
		';

						} else {

							print '
		<li>
			<label>
				<input type="radio" name="' . $k . '" value="' . $i . '" /> ' . $xx . '</label>
		</li>
		';

						}

						$i++;

					}
				}

				print '
	</ol>
</div>
';
			}

		}
	}
?>

	<div style="text-align:center">
		<!-- <input type="submit" value="OK"/> -->
		<input type="button" value="OK" onclick="sendData()"/>
	</div>
</form>

<script>
	function sendData() {
		var url = getUrl('submitDo');
		$.ajax({
			url : url,
			type : 'post',
			// dataType : 'json',
			data : $('#form').serialize(),
			success : function(r) {
				//qqq
				alert('提交完成');
				window.close();

			}
		});

	}	
</script>
