<?php
// PHP Skripte von Jens Gippner, Internetsupport.de, November 2018 
require("inc.php");
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Administration Konfiguration.</title>
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
