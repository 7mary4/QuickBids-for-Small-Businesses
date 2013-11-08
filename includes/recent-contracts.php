<?php
/*$yqlURL = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20atom%20where%20url%3D'https%3A%2F%2Fwww.fpds.gov%2Fezsearch%2Fsearch.do%3Fs%3DFPDSNG.COM%26indexName%3Dawardfull%26templateName%3D1.4.4%26q%3D". $naics . "%26rss%3D1%26feed%3Datom0.3'&format=json&callback=qbids";
$data = My_simplejson_load_file($yqlURL);
echo ($data);*/

// grab json using curl and generate a php data object
function getNAICShistory($naics)
  {
	 
// YQL URL
   $URL="http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20atom%20where%20url%3D'https%3A%2F%2Fwww.fpds.gov%2Fezsearch%2Ffpdsportal%3Fs%3DFPDSNG.COM%26indexName%3Dawardfull%26templateName%3D1.4.4%26q%3DSIGNED_DATE%253A%5B2013%252F07%252F01%252C2013%252F09%252F30%5D%2B%2BPRINCIPAL_NAICS_CODE%253A%2522" . $naics . "%2522%26rss%3D1%26feed%3Datom0.3'&format=json";
	  
  $ch = curl_init($URL);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HEADER, 0);

  $json = json_decode(curl_exec($ch));

  curl_close($ch);
  /*print "$URL<br><pre style='font-size:%80'>";
print_r($json);
print "</pre>";*/
  return $json;
  }



function recentContracts($naics){
	$data = getNAICShistory($naics);
	setlocale(LC_MONETARY, 'en_US');
	
	$historyList =  "<ul>";
	foreach($data->query->results->entry as $award){
		$awardTitle= $award->title;
		$awardDate = $award->content->award->relevantContractDates->effectiveDate;
		$awardDate = date(  'F n, Y', strtotime($awardDate) );
		$awardAmount = '$' . number_format($award->content->award->dollarValues->obligatedAmount);
		$purchaser = ucwords( strtolower($award->content->award->purchaserInformation->fundingRequestingOfficeID->name) );
		$description = ucwords( strtolower($award->content->award->contractData->descriptionOfContractRequirement) );
		$vendor = ucwords( strtolower($award->content->award->vendor->vendorHeader->vendorName) );
		$historyList .= "<li>$vendor was awarded a contract from $purchaser for $description on $awardDate for $awardAmount.</li>";
		
		}
	$historyList .= "</ul>";
	
	$history = <<<HISTORY
	<div id="history">
	<h3>Recently awarded contracts within your business category</h3>
	$historyList
	</div>
	
HISTORY;


/*print "<pre style='font-size:%80'>";
print_r($data->query->results);
print "</pre>";*/

return $history;

	}






?>