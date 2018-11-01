<?php
// PHP Skripte von Jens Gippner, Internetsupport.de, November 2018 für TH
$json_config_file = "config.json";

class Misc_helper
{
   public static function clearinput($input) #returns $checked input;
	{
	$textstring = trim($input);
	$textstring = strip_tags($textstring); // alle tags entfernen
    $textstring =  htmlspecialchars($textstring,ENT_QUOTES);
    #$textstring = str_replace("'", " ", $textstring);
	$textstring = str_replace("|", " ", $textstring);
	return $textstring;
	}

    public static function list_room_nr($input)
    {
    $list_room_options="";

    for($i=0;$i<11;$i++)
      {
        if($i==$input) $list_room_options.="<option value=\"$i\" selected>$i</option>";
        else $list_room_options.="<option value=\"$i\">$i</option>";
      }

    return $list_room_options;
    }
}


$error_message="";
$closing_days =  isset($_POST["closing_days_new"]) ? Misc_helper::clearinput($_POST["closing_days_new"]) : "";
if($closing_days=="") $closing_days =  isset($_POST["closing_days"]) ? Misc_helper::clearinput($_POST["closing_days"]) : "";
$closing_days_arr = explode(",",str_replace('&quot;','',$closing_days));

#echo str_replace('&quot;','',$closing_days);
$formdata =  isset($_POST["formdata"]) ? Misc_helper::clearinput($_POST["formdata"]) : 0;
$room =  isset($_POST["room"]) ? Misc_helper::clearinput($_POST["room"]) : "";
$email_address =  isset($_POST["email_address"]) ? Misc_helper::clearinput($_POST["email_address"]) : "";
$user_name =  isset($_POST["user_name"]) ? Misc_helper::clearinput($_POST["user_name"]) : "";

if($formdata=="1")
{
  $json_arr = array('closing_days_arr'=>$closing_days_arr,'room'=>$room,'email_address'=>$email_address,'user_name'=>$user_name);
  $json_data = json_encode($json_arr);
  file_put_contents($json_config_file, $json_data);
  $error_message=" Daten erfolgreich gespeichert!";
  echo "<br>error: ".json_last_error()."<br>$json_data";
  $config_vars = "";

}

// get Date from jsonfile
$json_file_data = file_get_contents($json_config_file);
#$json_file_data = '{"closing_days_arr":["10.11.2018","11.11.2018","25.11.2018","28.11.2018"],"room":"5","email_address":"test@test.de","user_name":"Tester"}';

$json_data_arr = json_decode($json_file_data, true);
echo "<pre>";
var_dump($json_data_arr);
echo "</pre>";

?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Administration Konfiguration</title>
		<!-- site style -->
        <link rel="stylesheet" href="media/admin.css">
        <link rel="stylesheet" href="js/datepicker/datepicker.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src='js/datepicker/datepicker.min.js'></script>

	</head>
	<body>
		<div id="main">
		   <h1><i class="fas fa-cog fa-lg"></i> Administration Konfiguration</h1>
			<form action="jsonindex.php" id="sf" name="formsb"  method="post">
	  			<fieldset>
	  				<legend>Schließtage</legend>
	  				<input type="hidden" name="closing_days" value='<?=implode(",",$json_data_arr['closing_days_arr']);?>'>
	  				<input type="hidden" name="closing_days_new" value="">
                    <input type="hidden" name="formdata" value="1">
	  				<label for="closing_days">Kalenderdatum</label>
	  				<div class="spaceBeforeSmall configDates js-thisYearDate" id="configDatesThisYear">
	  					<span class="add"></span>
	  					<br>
	  					<input class="hiddenDate" data-toggle="datepickerConfigThisYear"><span class="datetrigger" data-toggle="datetriggerThisYear"><i class="fas fa-plus"></i> Datum hinzufügen</span>
	  				</div>

	  			</fieldset>
				<fieldset>
	  				<legend>Raum</legend>
	  				<label for="room">Raumnummer</label>
	  				<select name="room" id="room" class="floatRight"><option value="">bitte auswählen</option><?php echo Misc_helper::list_room_nr($room);?></select>

	  			</fieldset>
				<fieldset>
	  				<legend>E-Mail-Adresse</legend>
	  				<label for="email_address">E-Mail</label> <input type="email" class="floatRight" size="25" maxlength="100" name="email_address" value="<?=$json_data_arr['email_address'];?>" id="email_address">

	  			</fieldset>
					<fieldset>
	  				<legend>Name</legend>
	  				<label for="user_name">Vor und Nachname</label> <input type="text" class="floatRight" size="25" maxlength="100" name="user_name" value="<?=$json_data_arr['user_name'];?>" id="user_name">
	  	 	  			</fieldset>
	  			<br>
				<fieldset class="paddingArround">
			  	<div class="flex flexSpaceBetween">
                    <span><input type="submit" id="submitbutton" value="Speichern">
                    <div class="red"><?=$error_message;?></div>
			        </span>
			  	</div>
				</fieldset>
			</form>
			<br>
		</div>
		<!-- site script -->
		<script src="js/admin.js"></script>
		<script src="js/admin_config.js"></script>
	</body>
</html>
