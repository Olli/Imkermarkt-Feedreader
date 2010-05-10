<?php

function feedausgabe($myentries) {

  if(count($myentries['entry']) == 0) {
    print("<strong>Es sind derzeit keine Inserate vorhanden.</strong>");
  } else  {
    	  
	  
	 foreach(array_reverse($myentries['entry']) as $entry) { 

	   $html =  "<div class=\"entry\">  \n";
	 $html .= "<div>\n";
	   $html .= "&raquo;<a onclick=\"window.open(this.href,'_blank'); return false;\" href=\"".$entry['link']['href']."\" title=\"".htmlentities($entry['title'])."\" style=\"font-weight:bold;color:#165B0C;\">";
	   $html .= $entry['title'];
	   $html .= "</a> in ".$entry['zip']." ".$entry['city'];  "\n\n" ;
	   $html .= "</div>\n";

	  // $html .= "in ".$entry['zip']." ".$entry['city'];
	
	   $html .= $entry['summary'];
	   $html .= "</div>\n\n";
	   print($html);
	 }
  }
}
?>
