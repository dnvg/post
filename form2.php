<?php

$fileinfo=file_get_contents('/fo/uplvids/upl/inf/filesinfo.txt');
//$fileinfo=file_get_contents('/tmp/test.txt');
//var_dump ($fileinfo); die();
$screenshots="";
$screenshots_small="";
$titles=file_get_contents('/fo/uplvids/upl/inf/titles.txt');

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
		body{padding:10px;}

		ul{list-style-type: none;}

		li{float:left; margin-right: 20px;}

		textarea{width:100%;height:140px;}

		input[type="text"]{width: 100%;}
		
		#test{margin-left: auto;margin-right: auto; width: 3em;}

		#left{float: left;}
	
		#right{float: left; margin-left: 10px; width: 1000px;}

		#clearfix {overflow: auto;}

	</style>


</head>
<body>
	
	<div>
		
		<form method="post" action="create_posts4.php" target="_blank" >
			<div id="clearfix">
				<div id="left">
					<input type="submit" name="posts" value="Make posts">
				</div>
				<div id="right">
					<input type="text" name="tags" >
				</div>
			</div>
			
			<ul>
				<li><input type="radio" name="genre" value = "bbw">BBW</li>
				<li><input type="radio" name="genre" value = "lesbian">Lesbian</li>
				<li><input type="radio" name="genre" value = "shemale">Shemale</li>
				<li><input type="radio" name="genre" value = "bdsm">Bdsm</li>
				<li><input type="radio" name="genre" value = "footfetish">Feet</li>
				<li><input type="radio" name="genre" value = "pissing">Pissing</li>
				<li><input type="radio" name="genre" value = "latex">Latex</li>
				<li><input type="radio" name="genre" value = "interracial-sex">Interracial</li>
				<li><input type="radio" name="genre" value = "jerkoff">Jerkoff</li>
				<li><input type="radio" name="genre" value = "incest-roleplay">Inc</li>
				<li><input type="radio" name="genre" value = "spanking">Spanking</li>
				<li><input type="radio" name="genre" value = "scat">Scat</li>
				<li><input type="radio" name="genre" value = "HD anal">HD anal</li>
			</ul><br><br><br>
			
			<ul>
				<li><input type="radio" name="hoster" value = "KEEP2SHARE">K2s</li>
				<li><input type="radio" name="hoster" value = "RAPIDGATOR">RG</li>
				<li><input type="checkbox" name="thema" value="true">Thema</li>
				<li><input type="checkbox" name="write" value="false">Write</li>
				<li><input type="checkbox" name="date-prefix-suzy" value="false">Date prefix Suzy</li>
				<li><input type="checkbox" name="date-prefix-philia" value="false">Date prefix Philia</li>
				<li><input type="checkbox" name="date-prefix-regular" value="false">Date prefix regular</li>
			</ul><br><br>
						
			<label for="gifs">Gif</label><br>
			<textarea name="gifs"></textarea><br>

			<label for="screenshots">Screenshots</label><br>
			<textarea name="screenshots"><?php echo $screenshots; ?></textarea><br>

			<label for="screenshots">Screenshots small</label><br>
			<textarea name="screenshots_small"><?php echo $screenshots_small; ?></textarea><br>

			<label for="titles">Titles</label><br>
			<textarea name="titles"><?php echo $titles; ?></textarea><br>
			
			<label for="fileinfo">File info</label><br>
			<textarea name="fileinfo"><?php echo $fileinfo; ?></textarea><br>

			<label for="urls">URLs</label><br>
			<textarea name="urls"></textarea><br>
		</form>
	</div>
</body>
</html>
