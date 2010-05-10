<?php
require("includes/feedreader.php");
require("includes/ausgabe.php");
// tragen Sie hier den ATOM Feed wie unter 
// http://www.imkermarkt/services/ beschrieben ein
// z.B. $myfeedcontent = parseFeed("http://www.imkermarkt.de/kleinanzeigen.atom");
$myfeedcontent = parseFeed("http://www.imkermarkt.de/feeds/1/3/0.atom");
//$myfeedcontent = parseFeed("<ihratomfeed>");
?>


<h1 style="margin:0 0 10px 0">Tausche Honig</h1>

<?php
  feedausgabe($myfeedcontent);
?>