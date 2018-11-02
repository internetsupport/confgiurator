<?php
// PHP Skripte von Jens Gippner, Internetsupport.de, November 2018
$json_config_file = "config.json";

class Misc_helper
{
   public static function clearinput($input)
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
  if(json_last_error()!=0)
    echo "<br>error: ".json_last_error()."<br>$json_data";
  $config_vars = "";

}

// get Date from jsonfile
$json_file_data = file_get_contents($json_config_file);
#$json_file_data = '{"closing_days_arr":["10.11.2018","11.11.2018","25.11.2018","28.11.2018"],"room":"5","email_address":"test@test.de","user_name":"Tester"}';

$json_data_arr = json_decode($json_file_data, true);
echo "<pre>";
#var_dump($json_data_arr);
echo "</pre>";

?>