<?php
	include("function/header.php");
    if ($_POST["btn"] == "Submit"){
        $select = "SELECT * FROM USERS WHERE username = ".toQuote($_POST['username']);
        $out = $db->returnRecord($select);
        $unhashpass = "A".$out[0]["token"];
        $message = "
                      Change your password
		
                     Well,$_POST['username'],
            Okay, I get it, mistakes happen, just use this
        here to fix yer little problem of memory loss: new password: $unhashpass;
        G'luck mate... You know where to find me if it happens again...
 ";
        mail($out[0]["email"], "Change your password", $message);
        $newpass = hash("whirlpool", $unhashpass);
        $statement = "UPDATE users SET `password` = ".toQuote($newpass)." WHERE username = ".toQuote($out[0]["username"]);
        $db->runStatement($db->getDBConn(),$statement);
        header("Location: login.php");
    }
?>
<html>
    <body>
        <div class="centerdiv">
            <form action="" method="post" style="top:50%">
                <h4 style="margin-top:0">Hrrrrfm... This is a password reset...</h4>
                <input type="text" class="input" name="username" placeholder="Enter Username"><br>
                <input class="button button is-dark" type="submit" name="btn" value="Submit"><br>
            </form>
        </div>
    </body>
</html>