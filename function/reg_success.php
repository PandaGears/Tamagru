<?php
session_start();
include_once("header_function.php");
$token = hash("whirlpool", $_SESSION["username"].$_SESSION["email"]);
echo $token."<br>";
$token = substr(str_shuffle($token), 0, 12);
$fields = array(
    "username",
    "password",
    "email",
    "gender",
    "token",
    "verified",
    "notifications"
);
$table = array(
    "name"      => "USERS",
    "fields"   => $fields
);
print_r($_SESSION);
$values = array(
                toQuote($_SESSION["username"]),
                toQuote($_SESSION["pass"]),
                toQuote($_SESSION["email"]),
                toQuote($_SESSION["gender"]),
                toQuote($token),
                '0',
                '1'
);
$db->insertRecord(
    array(
            "table"     => $table,
            "values"    => $values
    )
);
$username = $_SESSION["username"];
unset($_SESSION["pass"]);
unset($_SESSION["username"]);
$message = "
                        New Human!!!!!
	 
                        Hey, $username,

                    Ready to join the flock?

            Click this link to activate the thing: 
            http://$_SERVER[HTTP_HOST]/camagru/function/reg_conf.php?username=$username&token=$token
                    Have fun, you human, you...
";
$headers = 'From:noreply@maybetamagru.com' . "\r\n"; 
mail($_SESSION["email"], "A NEW CHALLENGER!!!!", $message, $headers);
header("Location: ../login.php");
?>
