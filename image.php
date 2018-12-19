<?php
    include("header_front.php");
    if ($_POST["like-btn"]){
        $statement = "UPDATE images SET likes = likes + 1 WHERE imageID = ".toQuote($_GET["imageID"]);
        $db->runStatement($db->getDBConn(),$statement);
    }
    if ($_POST["comm-btn"]){
        if ($_POST["commbox"]){
            $pattern = array("#;#", "#=#", "#\"#");
            $replace = array("%1", "%2", "%3");
            $noinjectcomm = preg_replace($pattern, $replace, $_POST["commbox"]);
            $statement = "INSERT INTO comments (imageID, username, comment) VALUES (";
            $statement .= toQuote($_GET["imageID"]).", ".toQuote($_SESSION["username"]).", ".toQuote($noinjectcomm).")";
            $db->runStatement($db->getDBConn(),$statement);
            $_POST["commbox"] = "";
            $statement = "SELECT * FROM images WHERE imageID = ".toQuote($_GET["imageID"]);
            $out = $db->returnRecord($statement);
            $user = $out[0]["username"];
            $statement = "SELECT * FROM users WHERE username = ".toQuote($user);
            $out = $db->returnRecord($statement);
            $message = $_SESSION["username"]." talked about your image. Fly off to http://$_SERVER[HTTP_HOST]/camagru/image.PHP?imageID=".$_GET["imageID"]." to see what happened!";
            $headers = 'From:noreply@maybetamagru.com' . "\r\n"; 
            if ($out[0]["notifications"]){
                mail($out[0]["email"], "New Camagru Comment", $message, $headers);
            }
        }
    }
    $imarray = $db->returnRecord("SELECT * FROM images WHERE imageID = ".toQuote($_GET["imageID"]));
    $commarray = $db->returnRecord("SELECT * FROM comments WHERE imageID = ".toQuote($_GET["imageID"]));
    echo "<div class='imagediv' style='top:10%'><img src=".$imarray[0]["image"].">";
    echo "<div class='commdiv'>";
    foreach ($commarray as $something){
        $pattern = array("#(%1)#", "#(%2)#", "#(%3)#");
        $replace = array(";", "=", "\"");
        $noinjectcomm = preg_replace($pattern, $replace, $something["comment"]);
        $out = "(".$something["date"].") ".$something["username"].": ".$noinjectcomm;
        echo $out."<br><hr>";
    }
    echo "</div>";
    echo "<br><anything style='color:white;font-family:K2D;font-size:150%'>Likes: ".$imarray[0]["likes"]."</anything>";
    if ($_SESSION["username"]){
        echo    
        "<div><form action='' method='post' id='commform'>
        <input type='submit' class='button is-dark' value='LIKE ME!' name='like-btn'><input type='submit' class='button is-dark' value='SAY SOMETHING!!!' name='comm-btn'>
        </form></div>";
        echo "<br><textarea name='commbox' form='commform' rows='5' cols='80' class='textarea' placeholder='Whatever is going through yer mind, say it here, I aint gonna judge...'></textarea><br>";
    }
    echo "</div>";
?>