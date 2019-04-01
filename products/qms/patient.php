<?php

/*
	$details['Name'] = 'Test';
	$details['patGender'] = 'f';
	$details['patAge'] = 20;
	$details['PhoneNum'] = '04012548745';
	$details['PhoneNum2'] = '';
	

//echo json_encode($details);

//exit;

*/
ini_set("display_errors", "off");

extract($_REQUEST);
//$UMRNumber='000123';

//$url = 'http://111.93.2.120/SuvarnaHISWebservices/Patient_Information.asmx/PatientInfo?UMRNO='.$UMRNumber;
//$url = 'http://192.168.1.4/SuvarnaHISWebservices/Patient_Information.asmx/PatientInfo?UMRNO='.$UMRNumber;

// $user = 'CUBE';
// $pass = 'patient@123';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
curl_setopt($ch,CURLOPT_TIMEOUT,1000);
//curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
//curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.0; da; rv:1.9.0.11) Gecko/2009060215 Firefox/3.0.11');
$contents = curl_exec($ch);
 if ($contents === false) {
   trigger_error('Failed to execute cURL session: ' . curl_error($ch), E_USER_ERROR);
} 

//print_r($contents);

$xml=simplexml_load_string($contents);

//$table = $xml->xpath('//Table');
$table = $xml->xpath('//PatientInfo');

$cnt=count($table);

//exit;
if(isset($table[0]))
{
	$details['Name'] = dom_import_simplexml($table[0]->PAT_NAME)->textContent;
	$details['patGender'] = dom_import_simplexml($table[0]->PAT_GENDER)->textContent;
	$details['patAge'] = dom_import_simplexml($table[0]->PAT_AGE)->textContent;
	$details['PhoneNum'] = dom_import_simplexml($table[0]->PAT_PHONENO)->textContent;
	$details['PhoneNum2'] = dom_import_simplexml($table[0]->PAT_MOBILENO)->textContent;
	
	
	
}
else
{

	$details['Name'] = 'Test';
	$details['patGender'] = 'm';
	$details['patAge'] = 20;
	$details['PhoneNum'] = 04012548745;
	$details['PhoneNum2'] = '';
	
}
echo json_encode($details);



		

		

			
			

?>
