<head>

<style>
.center {
  margin: auto;
  width: 90%;
  border: 3px solid #0000FF;
  padding: 1px;
}
</style>

</head>


<?php


if (!isset($_GET['step']) ){
	echo '<center><h1>Welcome to My SQL Ledger installation wizzard</h1>
	<center>
	<div>
	<fieldset class="center"><legend>Database Info:</legend>
	<form method="post" action="install.php?step=2">
	<center>
		<label><span>Host:</span><input type="text" value="'. $dbhost . '" name="dbhost"></label>
		<label><span>Database Name:</span><input type="text" value="'. $dbname . '" name="dbname"></label>
		<br><br>
		<label><span>Database Username:</span><input type="text" value="'. $dbusername . '" name="dbusername"></label>
		<label><span>Database Password:</span><input type="text" value="'. $dbuserpass . '" name="dbuserpass"></label>
		<br><br>
		<label><span>Web User:</span><input type="text" value="'. $webuser . '" name="webuser"></label>
		<label><span>Web User Password:</span><input type="text" value="'. $webpass . '" name="webpass"></label>
		<br><br>
		<label><span>Path to config file:</span><input type="text" value="'. $path . '" name="path"></label>
		<br><i>Leave blank for root directory.</i>
		<div class="cntr"><input type="submit" value="Save"/></label></div>
		</center>
	</form>
	</fieldset>
	</div>
	</center>';
}
else {
	
			$dbhost = $_POST["dbhost"];
			$dbusername =  $_POST["dbusername"] ;
			$dbuserpass = $_POST["dbuserpass"];
			$dbname = $_POST["dbname"] ;
			$dbTablName = "ledger1";
			$webuser = $_POST["webuser"];
			$webpass = $_POST["webpass"];
			$path = $_POST['path'];



			$putStr = '<'.'?'.'php
$dbhost = "'. $_POST["dbhost"] . '";
$dbname = "'. $_POST["dbname"] . '";
$tablename = "ledger1";
$dbuser = "'. $_POST["dbusername"] . '";
$dbpassword = "'. $_POST["dbuserpass"]. '";
$webuser = "'. $_POST["webuser"] . '";
$webpass = "'. $_POST["webpass"] . '";
$webhash = "typealongrandomstrtinghereyoudonothavetorememberthis";

'.'?'.'>';

			//echo $putStr;
			$putStr2 = '<'.'?'.'php
require "'.$path.$webuser.'_ledger_config.php'.'";

'.'?'.'>';


			file_put_contents($path.$webuser.'_ledger_config.php', $putStr );
			file_put_contents('config.php', $putStr2 );
			
			echo "<center>Config file updated!<br/>
			It is recomended to place the config.php file in a private location<br>
			And use a require statement in the index.php file.</center>";
}
	



?>

