<?php
// company info summary that can sit in the right column on the SAM page.
/*==============

The displayCompanyInformation function will display the information about a company when there is only a single result. 

================*/


$gId  = ( $_GET['id']    != '' ? 'id=' . $_GET['id'] : '');

function dunsLookup($duns) {
		include('variables/variables.php');
		$sangriaURL = $sangria_url.$duns;
		//echo 'sangria: ' . $sangriaURL;
		$response = file_get_contents($sangriaURL);
		$response = json_decode($response);
		return $response;
	}

$dunsResults = dunsLookup($gId);

function displayCompanysummary($results){	

/*print "<pre style=\"text-size:80%\">";
print_r($results->merchants[0]);
print "</pre>";*/

	$company 	= $results->merchants[0];
	// save company information to the cookies.
	// create the variables needed for displaying the content.
	$name 		= $company->legalName;
	$id			= $company->id;
	$address 	= $company->street . ', ' . $company->city . ' ' . $company->state . ' ' . $company->zip;
	$phone		= $company->phoneNumber;
	if(  preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $phone,  $matches ) )
	  {
		  $phone = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
	  } 
	$naics		= $company->naics;
	$naicsName	= $company->naicsName;
	$sic		= $company->sic;
	$industry	= $company->qboIndustryType;
	$ceo		= $company->ceoFirstName . $company->ceoLastName;
	$numemp		= $company->employeesTotal;
	$founded	= $company->yearStarted;
	$url		= '<a href="http://' . $company->url .'">' . $company->url . '</a>';
	

	
	
	
	// send request for SAM
	// send request to see if company is registered as special 
	// create the module with definition list
	$companyInfo = <<<INFO
	<div id="companySummary">
	<h3>Company Summary</h3>
	<p>This information will be needed for the SAM application.</p>
	<dl class="h-card">
INFO;
if($name != ''){ 
	$companyInfo .= "	
	<dt>Company Name</dt>
	<dd class=\"p-org\">$name</dd>
	";}
if($address != ''){ 
	$companyInfo .= "	
	<dt>Address</dt>
	<dd class=\"p-adr\">$address</dd>
	";}
	
if($phone != ''){ 
	$companyInfo .= "
	<dt>Phone</dt>
	<dd class=\"p-tel\">$phone</dd>
	";}
if($id != ''){ 
	$companyInfo .= "
	<dt><abbr title=\"Data Universal Numbering System\">DUNS</abbr></dt>
	<dd>$id</dd>
	";}
if($url != ''){
	$companyInfo .= " 
	<dt><abbr title=\"North American Industry Classification System\">NAICS</abbr></dt>
	<dd>$naics - $naicsName</dd>
	";}
if($sic != ''){
	$companyInfo .= " 
	<dt><abbr title=\"Standard Industrial Classification\">SIC</abbr></dt>
	<dd>$sic</dd>
	";}
if($industry != ''){
	$companyInfo .= " 
	<dt>Industry Type</dt>
	<dd>$industry</dd>
	";}
if($ceo != ''){
	$companyInfo .= " 
	<dt>CEO</dt>
	<dd>$ceo</dd>
	";}
if($numemp != ''){
	$companyInfo .= " 
	<dt>Number of Employees</dt>
	<dd>$numemp</dd>
	";}
if($rounded != ''){
	$companyInfo .= " 
	<dt>Founded</dt>
	<dd>$founded</dd>
	";}
	$companyInfo .= "
	</dl>
	</div>
	";
	

	
	
	// return the list
	
	return $companyInfo;
	
	}
echo displayCompanysummary($dunsResults);
?>