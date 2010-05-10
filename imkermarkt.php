<?php
include('includes/feedreader.php');
include('includes/ausgabe.php');
//wurde noch nicht getestet
$postleitzahlengebiet = '0';
$IMKERMARKTFEEDS = array( 
 "biete_bienen" => "http://www.imkermarkt.de/feeds/2/2/".$postleitzahlengebiet.".atom",
 "biete_honig"  => "http://www.imkermarkt.de/feeds/1/2/".$postleitzahlengebiet.".atom",
 "biete_sonstiges" => "http://www.imkermarkt.de/feeds/4/2/".$postleitzahlengebiet.".atom",
 "biete_zubehoer" => "http://www.imkermarkt.de/feeds/3/2/".$postleitzahlengebiet.".atom",
 "suche_bienen" => "http://www.imkermarkt.de/feeds/2/1/".$postleitzahlengebiet.".atom",
 "suche_honig" => "http://www.imkermarkt.de/feeds/1/1/".$postleitzahlengebiet.".atom",
 "suche_sonstiges" => "http://www.imkermarkt.de/feeds/4/1/".$postleitzahlengebiet.".atom",
 "suche_zubehoer" => "http://www.imkermarkt.de/feeds/1/1/".$postleitzahlengebiet.".atom",
 "tausche_bienen" => "http://www.imkermarkt.de/feeds/2/3/".$postleitzahlengebiet.".atom",
 "tausche_honig" => "http://www.imkermarkt.de/feeds/1/3/".$postleitzahlengebiet.".atom",
 "tausche_sonstiges" => "http://www.imkermarkt.de/feeds/4/3/".$postleitzahlengebiet.".atom",
 "tausche_zubehoer" => "http://www.imkermarkt.de/feeds/3/3/".$postleitzahlengebiet.".atom");

/* diese funktion kann man ganz einfach nutzen indem man zur 
/* Ausgabe angibt imkermarkt('biete_bienen');
/* */ 
function imkermarkt($category) {
  feedausgabe($IMKERMARKTFEEDS[$category]);
}

print "Ausgabe des Feeds \"Biete Bienen im Postleitzahlengebiet 0\": ".$IMKERMARKTFEEDS['biete_bienen']."<br>";
imkermarkt('biete_bienen');


?>