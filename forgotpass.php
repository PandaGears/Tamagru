<?php
	include("header_front.php");
    if ($_POST["btn"] == "Submit"){
        $select = "SELECT * FROM USERS WHERE username = ".toQuote($_POST['username']);
        $out = $db->returnRecord($select);
        $username = toQuote($_POST['username']);

        $newpass = "A".$out[0]["token"];
        $message = "
                      Change your password
		
                     Well, $username,
            Okay, I get it, mistakes happen, just use this
        here to fix yer little problem of memory loss: $newpass;
        Oh... And if you don't like that one, feel free to change it in yer settings, so no tantrums.
        G'luck mate... You know where to find me if it happens again...
 ";
        $headers = 'From:noreply@maybetamagru.com' . "\r\n"; 
        mail($out[0]["email"], "Change your password", $message, $headers);
        $newpass = hash("whirlpool", $newpass);
        $statement = "UPDATE users SET `password` = ".toQuote($newpass)." WHERE username = ".toQuote($out[0]["username"]);
        $db->runStatement($db->getDBConn(),$statement);
        header("Location: login.php");
    }
?>
<html>
    <body>
        <div class='centerdiv'>
            <form action="" method="post" style="top:50%">
                <h4 style="margin-top:0">Hrrrrfm... This is a password reset...</h4>
                <input type="text" class="input" name="username" placeholder="Enter Username"><br>
                <input class="button button is-dark" type="submit" name="btn" value="Submit"><br>
            </form>
        </div>
    </body>
</html>