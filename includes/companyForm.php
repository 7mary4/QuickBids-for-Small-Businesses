<?php
/*set up defaults*/
$name = '';
$zip  = '';
/* create the value attributes. Avoid XSS by encoding the user values */
if($_GET['coname'] !=''){
	$name=  htmlspecialchars($_GET['coname'], ENT_QUOTES);
	echo $name;
	}
if($_GET['zip'] !=''){
	$zip= 'value="' . htmlspecialchars($_GET['zip'], ENT_QUOTES) .'"';
	echo $zip;
	}	
	
$companyForm = <<<FORM

<form class="pure-form pure-form-stacked " action="/company.php" method="get" class="pure-g spacer">
  <label for="coname">Company Name</label>
  <input type="text" id="coname" required name="coname" value="$name" class="pure-input-1">
  
  
  <label for="zip">Enter company zipcode</label>
  <input type="text" id="zip" name="zip" $zip aria-describedby="zipUse" class="pure-input-1">
	<div class="pure-popover top" id="zipUse">
	Use this if your business has a common name, such as "AAA Dry Cleaners"
	<div class="pure-arrow-border"></div>
	<div class="pure-arrow"></div>
	</div>

  <br>
  <button type="submit" class="pure-button pure-button-primary primary-button-large">Search for your business</button>
  
  </div>
</form>

FORM;


echo $companyForm;

?>
