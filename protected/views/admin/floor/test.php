<?php



$ifle = $this->basePath.'/../upload/svg/10.svg';


// echo readfile($ifle);


$myfile = fopen($ifle, "r") or die("Unable to open file!");
echo fread($myfile,filesize($ifle));
fclose($myfile);



?>
