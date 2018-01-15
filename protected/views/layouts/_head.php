<!-- BASICS -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Unipapa</title>

<?php
print $this -> metaTitle;
print "\n";
print $this -> metaDescription;
print "\n";
print $this -> metaKeywords;
print "\n";
// print $this -> metaImage;
print "\n";
print $this -> metaUrl;
?>

<meta name="google-site-verification" content="XpSLq-OCmJXOVPnlxNTts3TtlLHpapuiGADjEjratOo" />

<meta name="og:image:width" content="1200">
<meta name="og:image:height" content="630">
<meta name="og:image" content="<?php print $b; ?>/img/fbCover.png"/>

<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link rel="icon" type="image/ico" href="<?php print $b; ?>/assets/images/favicon.ico" /> -->
<link rel="icon" type="image/ico" href="<?php print $b; ?>/img/favicon.png" />

<!-- Bootstrap Core CSS -->
<link href="<?php print $b; ?>/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="<?php print $b; ?>/css/main.css">
<link rel="stylesheet" href="<?php print $b; ?>/css/rwd.css">

<!-- <script src="https://code.jquery.com/jquery.js"></script> -->
<script src="<?php print $b; ?>/js/jquery-1.12.1.min.js"></script>

<?php
print '<script>';
if ($this -> isUserLogin()) {
	print ' var userID = "' . $this -> userID . '";';
	if (!empty($this -> user['name'])) {
		print 'var name = "' . $this -> user['name'] . '";';
	} else {
		print 'var name = "' . $this -> user['username'] . '";';
	}
	print 'var username = "' . $this -> user['username'] . '";';
	print 'var isUserLogin = true; ';

} else {
	print 'var isUserLogin = false; ';
}
print 'var baseUrl = "' . $this -> baseUrl . '";';
print 'var controllerName = "' . $this -> controllerName . '";';
print 'var actionName = "' . $this -> actionName . '";';
print 'var fbAppID = "' . $this -> fbAppID . '";';
// print ' var fbID = "' . $this -> fbID . '";';
print '</script>';

$languageTemp = $this -> getLanguageSource();
print $this -> printJson('language', $languageTemp);
?>

<script src="<?php print $b; ?>/js/main.js"></script>

<link href='//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

<link href='//fonts.googleapis.com/css?family=Raleway:400,700,600' rel='stylesheet' type='text/css'>

<link href='//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,700,600' rel='stylesheet' type='text/css'>

