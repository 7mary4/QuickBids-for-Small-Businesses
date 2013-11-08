<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Making government bids easy">
<title>QuickBids - Making government bids easy</title>
<?php include('includes/css.php');?>
<script src="http://use.typekit.net/gis6vng.js"></script>
<script>
    try { Typekit.load(); } catch (e) {}
</script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-41480445-1', 'purecss.io');
ga('send', 'pageview');
</script>
	
<script>
	var xmlhttp;
	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	function search() {
		var zipObj  = document.getElementById('zip');
		var companyNameObj = document.getElementById('coname');

		if(companyNameObj.value.trim() == "") {
			alert('PLEASE PROVIDE YOUR COMPANY NAME');
		}
		else {
                	var list = document.getElementById('output');
                        while(list.childNodes[0]) {
                        	list.removeChild(list.childNodes[0])
                        }
                                        
			var url = "/includes/businessLookup.php?business=" + companyNameObj.value.trim()  + "&state=" + zipObj.value.trim();
	                xmlhttp.open("GET", url, true);
        	        xmlhttp.onreadystatechange = displayResults;
          	 	xmlhttp.send();
		}
	}

	function displayResults() {      
        	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var response = xmlhttp.responseText;
                        var divTag = document.createElement('div');
                        divTag.id = "div" + Math.floor(Math.random() * 51);
                        divTag.innerHTML = response;
                        document.getElementById('output').appendChild(divTag);
		}
	}


</script>
</head>
<body>
<div class="pure-g-r pure-type" id="layout">
  <div class="sidebar pure-u">
    <header class="header">
      <hgroup>
        <h1 class="brand-title">QuickBids</h1>
        <h2 class="brand-tagline">3 steps to bidding</h2>
      </hgroup>
      <?php 
	  include('includes/navigation.php');
	  include('includes/steps.php'); 
	  ?>
    </header>
  </div>
  <div class="pure-u-2-3">
    <div class="content"> 
      <!-- A wrapper for all the blog posts -->
      <div class="posts">
        <h1 class="content-subhead">Step 1. Confirm your business information</h1>
        
        <!-- search form -->
        <section class="post">
          <header class="post-header"> 
            <h2 class="post-title">Start with your business information</h2>
            <p class="post-meta">We will collect as much information as possible to simplify the process. </p>
          </header>
          <div class="post-description">
            <? include('includes/companyForm.php');?>
          </div>
        </section>
      </div>
      
      <footer class="footer">
        <div class="pure-menu pure-menu-horizontal pure-menu-open">
          <?php include('includes/footerText.php');?>
        </div>
      </footer>
    </div>
  </div>
  <div class="pure-u-1-3">
  
  </div>
</div>

</body>
</html>
