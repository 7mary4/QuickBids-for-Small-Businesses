<?php
/*
Business display file.
This will have three possible outcomes.
1. 	The search result returns a single business. This is possible if the business has a pretty unique name or the query was sufficiently specific. 
	If this happens we will display the business information and start an additional search for related information. Ideally we will check if they have already registered with SAM.
	This instance can also occur if they have narrowed the search result.
2. 	There could be multiple results. This will be displayed as a series of radio buttons for the user to select their business. The page will refresh with the businesse's information.
3. 	There are no results. Prompt the user that there was a problem and they should try another search. Also suggest they may need to register with Duns and Bradstreet and provide link.
	
*/
$gName = ( $_GET['coname'] != '' ? 'name='. str_replace(' ', '+', strtolower($_GET['coname']) ) : '');// this will not be printed on the page, only used for a query.
$gZip  = ( $_GET['zip']    != '' ? '&zip=' . $_GET['zip'] : '');
$gId  = ( $_GET['id']    != '' ? 'id=' . $_GET['id'] : '');


// pass the potential get variables to the lookup. use name and zip for initial search results and id for the final choice. 
function sangriaLookup($name, $zip, $duns) {
		include('variables/variables.php');
		if($duns !=''){
			$sangriaURL = $sangria_url.$duns;
			}
		else{
			$sangriaURL = $sangria_url.$name.$zip;
			}	
		
		//echo 'sangria: ' . $sangriaURL;
		$response = file_get_contents($sangriaURL);
		$response = json_decode($response);
		return $response;
	}

$results = sangriaLookup($gName, $gZip, $gId);

if($results == "") {
        $results = "No Results";
}
$resultNumber = $results->numMerchants;

/*==============

The displayCompanyInformation function will display the information about a company when there is only a single result. 

================*/
function displayCompanyInformation($results){	
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
	

	
	/*setcookie('qbid[name]',      $name,          time()+36000, '/', '.qbids.fyvr.net');	
	setcookie('qbid[id]',        $id,            time()+36000, '/', '.qbids.fyvr.net');
	setcookie('qbid[naics]',     $naics,         time()+36000, '/', '.qbids.fyvr.net');*/
	//print "<pre>"; print_r($_POST); print "</pre>";
 
	
echo "	
    <script>
    // Create a YUI instance and use the cookie module.
	YUI().use('cookie', function(Y) {
		Y.Cookie.set(\"naics\", \"$naics\");
		Y.Cookie.set(\"duns\", \"$id\");
		Y.Cookie.set(\"name\", \"$name\");
	});</script>";
    
	
	
	
	// send request for SAM
	// send request to see if company is registered as special 
	// create the module with definition list
	$companyInfo = <<<INFO
	<div id="companyInfo">
	<h3 class="pure-ribbon pure-ribbon-success">You are one step closer to the finish line</h3>
	<p>Here is the information we found on your business. You'll need this information for the next stage: Registering with System for Award Management. Don't worry, this will be pretty easy.</p>
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
if($url != ''){ 
	$companyInfo .= "	
	<dt>Web Site</dt>
	<dd>$url</dd>
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
	
	echo $companyInfo;
	
    include('recent-contracts.php');
    print recentContracts($naics);
	
	}

/*=======================

The chooseFromList function will appear when there are multiple results. It will display a set of possible results 

==========================*/
function chooseFromList($results){
	/*print "<pre style=\"text-size:80%\">";
print_r($results->merchants);
print "</pre>";*/

$companyForm = '<form action="/company.php" method="get" class="pure-form">
<fieldset>
<legend>Choose your company</legend>
<ul>';
foreach($results->merchants as $company){
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
	
	$compChoice = <<<ITEM
	<li>
	<input type="radio" name="id" value="$id" id="c$id"> <label for="c$id">$name, $address</label>
	</li>
	
ITEM;
	$companyForm .= $compChoice;	
}
	$companyForm .="</ul><button class=\"pure-button pure-button-primary\">Submit</button></form>";
	echo $companyForm;
	print "<h3>Try searching again</h3>";
	print "<p>Add a zipcode or check your company name for spelling mistakes</p>";
	include('includes/companyForm.php');
		
	}

switch ($resultNumber) {
    case 0:
        echo "<h2>We couldn't find your business</h2>";
		echo "<p>Please try searching again.</p>";
		include('includes/companyForm.php');
		$step2status = NO;
        break;
    case 1:
        echo displayCompanyInformation($results);
		$step2status = YES;
		$duns = $results->merchants[0]->id;
        break;
    default:
        echo chooseFromList($results);
		$step2status = NO;
}




/*print "<pre style=\"text-size:80%\">";
print_r($results-merchants);
print "</pre>";
*/
?>