<?php





$conn = mysqli_connect('localhost','root', '','ethermoney19');
//-------------------------------default language setting code start-------------------------------------------------

$query = "SELECT defaultLanguage FROM adminsetting";
$result = mysqli_query($conn,$query);
$lang=array();
$lang = mysqli_fetch_row($result);
$defaultLanguage = $lang[0];
 if(isset($_COOKIE['country']) && $_COOKIE['country'] != ""){
    $lang = "language_".$_COOKIE['country'];
    $c=$_COOKIE['country'];
  }else{
    $lang = "language_".$defaultLanguage;
    $c=$defaultLanguage;
  }

//--------------- default language setting end code--------------------------------------------------------