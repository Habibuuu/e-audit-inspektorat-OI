<?php
if(empty($_FILES['file']))
{
	exit();
}
$temp = explode(".", $_FILES["file"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$destinationFilePath = "../storage/images/".$newfilename ;
$url_destFilePath = "/storage/images/".$newfilename;
// $url_destFilePath = "{{ URL::asset('storage/images/post/') }}".$newfilename;
if(!move_uploaded_file($_FILES['file']['tmp_name'], $destinationFilePath)){
	echo $errorImgFile;
}
else{
	echo $url_destFilePath;
}

?>
