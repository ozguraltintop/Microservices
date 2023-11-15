<?php



#UTF-8 Dönüştürme İşlemleri
function convertToISO($data){
return mb_convert_encoding($data, "UTF-8", "ISO-8859-9");
}
function convertToUTF8($data){
return mb_convert_encoding($data, "ISO-8859-9", "UTF-8");
}





function download($loginToken,$FormId,$toplamDosyam,$totalFilekey)
{

	$postField = 'EntegrationKey='.$FormId.'&FileKey=filekey1';
	$controlDownload  = false;
	$m = 1;
	$fileImp   = "C:/Doc/imzali/".$FormId;
	if (file_exists($fileImp))
	{
		echo "klasör mevcut"; 
	}
	else
	{
		mkdir($fileImp);
	}

	for($i=0;$i<$toplamDosyam;$i++)
	{
		
		$fileNamet = fopen("C:/Doc/imzali/".$FormId."/filekey".$m.".pdf","w+");
		$postField = 'EntegrationKey='.$FormId.'&FileKey=filekey'.($m);
		echo $postField;


		
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => '',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $postField,
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/x-www-form-urlencoded',
			'Authorization: Bearer '.$loginToken
		  ),
		));
		curl_setopt($curl, CURLOPT_FILE, $fileNamet);

		$response = curl_exec($curl);

		curl_close($curl);

		$m++;
		$controlDownload  = true;

	}

	


		
}




?>