<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Making government bids easy">
<?php $title = (isset($_COOKIE['name']) ? $_COOKIE['name'] . ' Information'  : 'Company Information');?>

<title><?php echo $title ?> | QuickBids - Making government bids easy</title>
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
            <? include('includes/business-search.php');?>
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
  <section class="pure-u-1-3">
  <header>
  <h2>What's Next</h2>
  </header>
  <div class="special">
  <h3>Special Considerations</h3>
  <p>
  The US Government provides special consideration to small businesses that fall into certain categories. Does your business qualify for any of these situations?</p>
  <ul>
  <li><a href="http://www.va.gov/osdbu/veteran/verificationInstructions.asp">Veteran Owned Small Business</a></li>
  <li><a href="http://www.sba.gov/content/contracting-opportunities-women-owned-small-businesses">Women Owned Small Businesses</a></li>
  <li><a href="http://www.sba.gov/Hubzone">HUBZone location</a></li>
  </ul>
  </div>
  <?php 

  if ($step2status == YES){?>

  <div class="next">
  <h3>Step 2: Register</h3>
  <p>The next stage is to register with the Government's System for Award Management.</p>
  <a href="sam.php?duns=<?php print $duns?>" class="pure-button pure-button-primary">Go to Step 2</a>
  </div>
<?php
  }
  ?>
  </section>
  
  </div>
</div>

</body>
</html>
