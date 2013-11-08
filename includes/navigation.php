<?php
$step1 = (isset($_COOKIE['duns']) ? '' : 'pure-button-disabled');
$step2 = (isset($step2)           ? '' : 'pure-button-disabled');

$nav = <<<NAVIGATION
<nav class="nav" role="navigation" class="pure-type">
        <ul class="nav-list">
          <li class="nav-item"> <a class="pure-button pure-button-block $step1" href="/index.php">1. Company Info</a> </li>
          <li class="nav-item"> <a class="pure-button pure-button-block $step2" href="/sam.php">2. S.A.M.</a> </li>
          <li class="nav-item"> <a class="pure-button pure-button-block pure-button-disabled" href="/past-performance.php">3. Past Performance</a> </li>
        </ul>
      </nav>

NAVIGATION;

echo $nav;

?>