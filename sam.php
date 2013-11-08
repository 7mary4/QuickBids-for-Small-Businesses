<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Making government bids easy">
<title>Step 2. Registering with S.A.M. | QuickBids - Making government bids easy</title>
<?php include('includes/css.php');
$getId  = ( $_GET['id']    != '' ? 'id=' . $_GET['id'] : '');
?>
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
  <div class="pure-u-1">
    <div class="content"> 
      <!-- A wrapper for all the blog posts -->
      <div class="posts pure-g">
        <h1 class="content-subhead pure-u-1">Step 2. Register for the  System for Award Management</h1>
        
        <!-- search form -->
        <section class="post pure-u-2-3">
          <header class="post-header"> 
            <h2 class="post-title">Tell the Government you are Interested</h2>
            <p class="post-meta">S.A.M. is the registry for all business that want to participate in government contracts.</p>
          </header>
          <div class="post-description">
            <ol>
              <li>
                Go to <a href="http://www.sam.gov">System for Award Management</a> website</li>
              <li>Create a Individual Account and Login                </li>
              <li>Click “Register New Entity” under “Register/Update E
                ntity” on your
                “My SAM” page                </li>
              <li>Select your type of Entity                </li>
              <li>Select “Yes” to “Do you wish to bid on contracts?”                </li>
              <li>Complete “Core Data”
                Validate your DUNS information
                Enter Business Information (TIN, etc.)
                Enter CAGE code if you have one. If not, one will be assigned to
                you after your registration is completed. Foreign registrants must
                enter NCAGE code.
                Enter General Information (business types, organization structure,
                etc)
                Financial Information (Electronic Funds Transfer (EFT )Information)
                Executive Compensation
                Proceedings Details</li>
              <li>Complete “Assertions”
                Goods and Services (NAICS, PSC, etc.)
                Size Metrics
                EDI Information
                Disaster Relief Information                </li>
              <li>Complete “Representations and Certifications”
                FAR Responses
                Architect-Engineer Responses
                DFARS Responses                </li>
              <li> Complete “Points of Contact”                </li>
              <li>Your entity registration will become active after 3
                -5 days when the
                IRS validates your TIN information. </li>
            </ol>
            <a href="http://www.sam.gov" class="pure-button pure-button-xlarge pure-button-primary" target="_new">Start Registering with S.A.M.</a>
          </div>
        </section>
        <div class="pure-u-1-3">
        <img alt="" src="https://www.sam.gov/SAMPortal/img/logo.gif" > 
        <div class="pure-alert">
        <h3>Step 2 Time</h3>
        <p>Filling out the SAM form should take about an hour. The process to approve your application should take a week to process.</p>
        </div>
        <a href="/past-performance.php?id=<?php echo $getId?>" class="pure-button pure-button-primary">Go to Step 3</a>
        <?php
		include('includes/company-summary.php');
		?>
        </div>
      </div>
      
      <footer class="footer">
        <div class="pure-menu pure-menu-horizontal pure-menu-open">
          <?php include('includes/footerText.php');?>
        </div>
      </footer>
    </div>
  </div>
</div>

</body>
</html>
