<?php

ini_set("display_errors", 1);
set_time_limit(3600);



function bbcode_to_html($bbtext){

  $bbtags = array(
    '[heading1]' => '<h1>','[/heading1]' => '</h1>',
    '[heading2]' => '<h2>','[/heading2]' => '</h2>',
    '[heading3]' => '<h3>','[/heading3]' => '</h3>',
    '[h1]' => '<h1>','[/h1]' => '</h1>',
    '[h2]' => '<h2>','[/h2]' => '</h2>',
    '[h3]' => '<h3>','[/h3]' => '</h3>',

    '[paragraph]' => '<p>','[/paragraph]' => '</p>',
    '[para]' => '<p>','[/para]' => '</p>',
    '[p]' => '<p>','[/p]' => '</p>',
    '[left]' => '<p style="text-align:left;">','[/left]' => '</p>',
    '[right]' => '<p style="text-align:right;">','[/right]' => '</p>',
    '[center]' => '<p style="text-align:center;">','[/center]' => '</p>',
    '[justify]' => '<p style="text-align:justify;">','[/justify]' => '</p>',

    '[bold]' => '<span style="font-weight:bold;">','[/bold]' => '</span>',
    '[italic]' => '<span style="font-weight:bold;">','[/italic]' => '</span>',
    '[underline]' => '<span style="text-decoration:underline;">','[/underline]' => '</span>',
    '[b]' => '<span style="font-weight:bold;">','[/b]' => '</span>',
    '[i]' => '<i>','[/i]' => '</i>',
    '[u]' => '<span style="text-decoration:underline;">','[/u]' => '</span>',
    '[break]' => '<br>',
    '[br]' => '<br>',
    '[newline]' => '<br>',
    '[nl]' => '<br>',
    
    '[unordered_list]' => '<ul>','[/unordered_list]' => '</ul>',
    '[list]' => '<ul>','[/list]' => '</ul>',
    '[ul]' => '<ul>','[/ul]' => '</ul>',

    '[ordered_list]' => '<ol>','[/ordered_list]' => '</ol>',
    '[ol]' => '<ol>','[/ol]' => '</ol>',
    '[list_item]' => '<li>','[/list_item]' => '</li>',
    '[li]' => '<li>','[/li]' => '</li>',
    
    '[*]' => '<li>','[/*]' => '</li>',
    '[code]' => '<code>','[/code]' => '</code>',
    '[preformatted]' => '<pre>','[/preformatted]' => '</pre>',
    '[pre]' => '<pre>','[/pre]' => '</pre>',	    
  );

  $bbtext = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);

  $bbextended = array(
    "/\[url](.*?)\[\/url]/i" => "<a href=\"http://$1\" title=\"$1\">$1</a>",
    "/\[url=(.*?)\](.*?)\[\/url\]/i" => "<a href=\"$1\" title=\"$1\">$2</a>",
    "/\[email=(.*?)\](.*?)\[\/email\]/i" => "<a href=\"mailto:$1\">$2</a>",
    "/\[mail=(.*?)\](.*?)\[\/mail\]/i" => "<a href=\"mailto:$1\">$2</a>",
    "/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
    "/\[image\]([^[]*)\[\/image\]/i" => "<img src=\"$1\" alt=\" \" />",
    "/\[image_left\]([^[]*)\[\/image_left\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_left\" />",
    "/\[image_right\]([^[]*)\[\/image_right\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_right\" />",
  );

  foreach($bbextended as $match=>$replacement){
    $bbtext = preg_replace($match, $replacement, $bbtext);
  
  }
  return $bbtext;
}





function getCounter($c)
{
	if ($c<10) $sc="000" . ($c);
			elseif ($c<100) $sc="00" . ($c);
				elseif ($c<1000) $sc="0" . ($c);
	return $sc;
}




function insertMissingRows($filesArray)
{
	
	$i=0;
	$newArray=array();
	$newArrayCounter = 0;

	if ( strpos($filesArray[0], "0001_") === false )
	{
		array_unshift($filesArray, "0001_");
	}
	

	while($i < count($filesArray) - 1)
	{
		$missingRows=array();
			
		$firstStr  = $filesArray[$i];
		$secondStr = $filesArray[$i+1];
		$num1=$num2=0;
	
		$counter="";
	

		for($j=1; $j<=999; $j++)
		{
			$counter=getCounter($j);
			if (strpos($firstStr, $counter . "_") !== false) $num1 = (int)$counter;
		}
		

		$counter="";
	
		for($j=1; $j<=999; $j++)
		{
			$counter=getCounter($j);
			if (strpos($secondStr, $counter . "_") !== false) $num2 = (int)$counter;
		}




		$newArray[] = $firstStr;
	
		$y=$num2-$num1;
		
		if ($y>1)	
			for($j=$num1+1; $j<$num2; $j++)
				$newArray[]="";		
		$i++;
	}

	return $newArray;
}



function pvd($str){
	echo "<pre>";
	var_dump($str);
	echo "</pre>";
}




function pimpGetHotlinkUrls( $bbcode ){
	$bbcode = preg_replace("/\[\/URL\] /i", "[/URL]@@@", $bbcode);
	$bbcode = preg_replace("/medium/i", "original", $bbcode);
	$bbcode = preg_replace("/_0\.jpg/i", ".jpg", $bbcode);
	$bbcode = explode("@@@", $bbcode);
	return $bbcode;
}



function getIntFromUrl($url, $fileType){
	$fileType = $fileType == "gif" ? "g_i_f_" : "s_c_r_";
	$start = strpos($url, $fileType);
	$start += 6;
	$index = intval(substr($url, $start, 4));
	return $index;
}



/**
* Example of inertion sort
*/
function insertionSort($urls){
	$arrayLength = count($urls);
	for($i=1; $i<$arrayLength; $i++){
		$key = $urls[$i];
		$j = $i - 1;
		while($j >= 0 && $urls[$j] > $key){
			$urls[$j+1] = $urls[$j];
			$j--;
		}
		$urls[$j+1] = $key;
	}
	return $urls;
}




function sortUrls($urls, $fileType){
	$arrayLength = count($urls);
	for($i=1; $i<$arrayLength; $i++){
		$key = getIntFromUrl($urls[$i], $fileType);
		$keyUrl = $urls[$i];
		$j = $i - 1;
		while($j >= 0 && getIntFromUrl($urls[$j], $fileType) > $key){
			$urls[$j+1] = $urls[$j];
			$j--;
		}
		$urls[$j+1] = $keyUrl;
	}
	return $urls;
}




function addBreaksToGifUrls($urls){
	$urlsResult = [];
	$index = 0;
	$urlsResult[0] = $urls[0];

	for($i = 0; $i <= count($urls) - 2; $i++){

		$line1 = $urls[$i];
		$line2 = $urls[$i + 1];
		$gifNumber1 = getIntFromUrl($line1, "gif");
		$gifNumber2 = getIntFromUrl($line2, "gif");
		
		if($gifNumber1 == $gifNumber2){
			$urlsResult[$index] .= " " . $line2;

		} else {
			$index++;
			$urlsResult[$index] = $line2;
		}
	}
	return $urlsResult;
}



$tags			=$_POST['tags'];
$genre			=$_POST['genre'];
$gifs			=$_POST['gifs'];
$screenshots		=$_POST['screenshots'];
$screenshots_small	=$_POST['screenshots_small'];
$filesinfo		=$_POST['fileinfo'];
$urls			=$_POST['urls'];
$titles			=$_POST['titles'];
$hoster 		=$_POST['hoster'];
$thema 			=isset($_POST['thema']);
$write 			=isset($_POST['write']);
$addDatePrefixSuzy 	=isset($_POST['date-prefix-suzy']);
$addDatePrefixPhilia	=isset($_POST['date-prefix-philia']);
$addDatePrefixRegular	=isset($_POST['date-prefix-regular']);


/* ---------- PREPARE GIFS ---------- */

$gifs = pimpGetHotlinkUrls(trim($gifs));
$gifs = sortUrls($gifs, "gif");
$gifs = addBreaksToGifUrls($gifs);
$gifs = insertMissingRows($gifs);
$gifs = str_replace(array("\r", "\n", "\t"), "", $gifs);

/* ---------- PREPARE TITLES ---------- */

$titles = preg_replace("/\.torrent/", "", $titles);
$titles = preg_replace("/\.loaded/", "", $titles);
$titles = preg_replace("/megapack/i", "", $titles);
$titles = preg_replace("/siterip/i", "", $titles);
$titles	= explode("\n", $titles);
$titles = insertMissingRows($titles);
$titles = preg_replace("/^....../i", "", $titles);
$titles = str_replace(array("\r", "\n", "\t"), "", $titles);

/* ---------- PREPARE FILESINFO ---------- */
$filesinfo = trim($filesinfo);
$filesinfo = explode("\n", $filesinfo);
$filesinfo = insertMissingRows($filesinfo);

$pattern = array("/#.+#/", "/@@@/");

$replacement_text = array("", PHP_EOL);
$replacement_html = array("", "<BR>");

$filesinfo_text = str_replace(array("\r", "\n", "\t"), "", $filesinfo);
$filesinfo_text = preg_replace($pattern, $replacement_text, $filesinfo_text);

$filesinfo_html = preg_replace($pattern, $replacement_html, $filesinfo);
$filesinfo_html = str_replace(array("\r", "\n", "\t"), "", $filesinfo_html);




/* ---------- PREPARE SCREENSHOTS ---------- */
$screenshots = explode(" ", trim($screenshots));
$screenshots = sortUrls($screenshots, "jpg");
$screenshots = insertMissingRows($screenshots);
$screenshots = str_replace(array("\r", "\n", "\t"), "", $screenshots);


/* ---------- PREPARE SMALL SCREENSHOTS ---------- */
$screenshots_small = explode(" ", trim($screenshots_small));
$screenshots_small = sortUrls($screenshots_small, "jpg");
//pvd($screenshots_small);die();
$screenshots_small = insertMissingRows($screenshots_small);
$screenshots_small = str_replace(array("\r", "\n", "\t"), "", $screenshots_small);
//pvd($screenshots_small);die();


/* ---------- PREPARE URLS ---------- */
$urls = explode("\n", $urls);
$urls = str_replace(array("\r", "\n", "\t"), "", $urls);
$new_urls="";
$new_urls_thema="";
$new_urls_imacros="";


for ($pos=0; $pos<count($urls); $pos++)
{
	if( strpos($urls[$pos], "rar") && strpos($urls[$pos+1], "rar") ){ 
		$rarPartX = substr($urls[$pos], -11, 1);
		$rarPartY = substr($urls[$pos+1], -11, 1);
		if($rarPartX < $rarPartY || $rarPartY == 0 ) {
			$new_urls_thema .= $urls[$pos] . PHP_EOL;
			$new_urls_imacros .= $urls[$pos] . "<BR>";
		} else {
			$new_urls_thema .= $urls[$pos] . "xxxxx";
			$new_urls_imacros .= $urls[$pos] . "xxxxx";
		} 
		echo $rarPartX . " => " . $rarPartY . "<br>";
	} else {
	
		$new_urls_thema .= $urls[$pos] . "xxxxx";
		$new_urls_imacros .= $urls[$pos] . "xxxxx";
	}
}

$new_urls_thema = explode("xxxxx", $new_urls_thema);
$new_urls_thema = insertMissingRows($new_urls_thema);

$new_urls_imacros = explode("xxxxx", $new_urls_imacros);
$new_urls_imacros = insertMissingRows($new_urls_imacros);

//pvd($new_urls_thema);
//pvd($new_urls_imacros);die();

$i=0;
$all_posts="";
$curent_post="";
$preview = "";
$breaks=array("\r\n", "\n", "\r");


$datasource=trim(substr(file_get_contents("/fo/uplvids/scr/upldir"), 0, strlen(file_get_contents("/fo/uplvids/scr/upldir"))-2));


$filehoster_logo = ($hoster == "RAPIDGATOR") ? "[img]http://rapidgator.net/images/pics/409_6.gif[/img]" :
				     "[img]http://static.keep2share.cc/images/i/00240x0032-10.png[/img]";

define("THEMA_POSTS_PATH", "/fo/uplvids/posts/thema");
define("IMACROS_POSTS_PATH", "/fo/uplvids/posts/imacros");
define("IMACROS_POSTS_PATH_2", "/home/alul/iMacros/Datasources");


$post="";
$post_html_all = $post_imacros_all = $post_thema_single_line = "";
$post_thema_all = array();

$post_html = "[b]%s[/b]<BR><BR>";
$post_html .= "%s<BR><BR>";
$post_html .= "[b]Tags:[/b]<BR>";
$post_html .= "[i]%s[/i]<BR><BR>";
$post_html .= "[b]Information:[/b]<BR>";
$post_html .= "%s<BR><BR>";
$post_html .= "[b]Download " . $genre . " sex video [/b]<BR><BR>";
$post_html .= "%s<BR>";
$post_html .= "%s<BR><BR>";
$post_html .= "%s<BR><BR><hr><BR><BR>";

$post_imacros = "\"" . $genre . " sex %s\",";
$post_imacros .= "\"[b]%s[/b]<BR><BR>";
$post_imacros .= "%s<BR><BR>";
$post_imacros .= "[b]Tags:[/b]<BR>";
$post_imacros .= "[i]%s[/i]<BR><BR>";
$post_imacros .= "[b]Information:[/b]<BR>";
$post_imacros .= "%s<BR><BR>";
$post_imacros .= "[b]Download " . $genre . " sex video[/b]<BR><BR>";
$post_imacros .= "%s<BR><BR>";
$post_imacros .= "%s<BR><BR>";
$post_imacros .= "%s\"";

$post_thema = "<subject>" . $genre . " sex %s</subject>\n\n";
$post_thema .= "[b]%s[/b]\n\n";
$post_thema .= "%s\n\n";
$post_thema .= "[b]Tags:[/b]\n";
$post_thema .= "[i]%s[/i]\n\n";
$post_thema .= "[b]Information:[/b]\n";
$post_thema .= "%s\n\n";
$post_thema .= "[b]Download " . $genre . " sex video [/b]\n\n";
$post_thema .= "%s\n\n";
$post_thema .= "%s\n\n";
$post_thema .= "%s";

#$logo_ks = "http://ist3-6.filesor.com/pimpandhost.com/1/_/_/_/1/4/o/a/C/4oaC7/animated-download-button_small.gif";
#$logo_ks = "http://ist3-6.filesor.com/pimpandhost.com/1/_/_/_/1/4/o/W/N/4oWNV/right-down-arrow-green_small.gif";
$logo_ks = "http://ist3-6.filesor.com/pimpandhost.com/1/_/_/_/1/4/o/W/Q/4oWQw/right-down-arrow-green_small_2.gif";

$i = 0;

foreach ($new_urls_thema as $url)
{

	if($url==""){$i++; continue;}
	if($filesinfo[$i]==""){$i++; continue;}
		
	//HTML
	$post_html_all .= sprintf($post_html, $titles[$i], $screenshots[$i], $tags, $filesinfo_html[$i], $filehoster_logo, $new_urls_imacros[$i], $screenshots_small[$i]);


	//IMACROS
	$post_imacros_single_line = sprintf($post_imacros, $titles[$i], $titles[$i], $screenshots[$i], $tags, $filesinfo_html[$i], $filehoster_logo, $new_urls_imacros[$i], $screenshots_small[$i]);
	$post_imacros_single_line .= PHP_EOL;
	$post_imacros_all .= $post_imacros_single_line;


	//THEMA
	$post_thema_single_line = sprintf($post_thema, $titles[$i], $titles[$i], $screenshots[$i], $tags, $filesinfo_text[$i], $filehoster_logo, $url, $screenshots_small[$i]);
	$post_thema_all[] = $post_thema_single_line;


	$i++;
}


$post_html_all = bbcode_to_html($post_html_all) ;
echo $post_html_all;

$i = 0;

if($write){

	file_put_contents(IMACROS_POSTS_PATH . "/" . $genre . "/" . $genre . "_" . date("Y-m-d_H-i") . ".html", $post_html_all);
	file_put_contents(IMACROS_POSTS_PATH . "/" . $genre . "/" . $genre . "_" . date("Y-m-d_H-i") . ".csv", $post_imacros_all);

	$datePrefixSuzy = $addDatePrefixSuzy ? "_" . date("Y-m-d_H-i") : "";
	$datePrefixPhilia = $addDatePrefixPhilia ? "_" . date("Y-m-d_H-i") : "";
	$datePrefixRegular = $addDatePrefixRegular ? "_" . date("Y-m-d_H-i") : "";
	file_put_contents(IMACROS_POSTS_PATH_2 . "/" . $genre . "_suzy" . $datePrefixSuzy . ".csv", $post_imacros_all);
	file_put_contents(IMACROS_POSTS_PATH_2 . "/" . $genre . "_philia" . $datePrefixPhilia . ".csv", $post_imacros_all);
	file_put_contents(IMACROS_POSTS_PATH_2 . "/" . $genre . $datePrefixRegular . ".csv", $post_imacros_all);

	if($thema){
		foreach($post_thema_all as $post){
			file_put_contents(THEMA_POSTS_PATH . "/" . $genre . "/" . date("Y-m-d_H-i") . "_" . getCounter($i) . "_" . $genre . ".txt", $post);
			$i++;
		}
	}
}

?>
