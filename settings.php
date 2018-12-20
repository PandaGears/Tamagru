<?php
    include("header_front.php");
    $i = 0;
    if($_POST["btn"]){
        $i = 1;
    }
    if($_POST["btn2"]){
        $select = "SELECT * FROM USERS WHERE username =".toQuote($_SESSION['username']);
        $out = $db->returnRecord($select);
        if($_POST["curruser"] === $_SESSION["username"]){
            if($_POST["newuser"] != "" && isUnique("username",$_POST["newuser"])){
                $statement = "UPDATE users SET username = ".toQuote($_POST['newuser'])." WHERE username = ".toQuote($_SESSION["username"]);
                $statement .= "; UPDATE images SET username = ".toQuote($_POST['newuser'])." WHERE username = ".toQuote($_SESSION["username"]);
                $statement .= "; UPDATE comments SET username = ".toQuote($_POST['newuser'])." WHERE username = ".toQuote($_SESSION["username"]);
                $db->runStatement($db->getDBConn(),$statement);
                $_SESSION["username"] = $_POST["newuser"];
            }
        }
        if(hash("whirlpool",$_POST["currpass"]) == $out[0]["password"]){
            $newpass = hash("whirlpool", $_POST["newpass"]);
            $statement = "UPDATE users SET `password` = ".toQuote($newpass)." WHERE `password` = ".toQuote(hash("whirlpool",$_POST["currpass"]))." AND username = ".toQuote($_SESSION["username"]);
            $db->runStatement($db->getDBConn(),$statement);
        }
        if($_POST["curremail"] == $out[0]["email"]){
            $statement = "UPDATE users SET email = ".toQuote($_POST['newemail'])." WHERE email = ".toQuote($_POST["curremail"]);
            $db->runStatement($db->getDBConn(),$statement);
        }
        if($_POST["notifications"]){
            if($_POST["notifications"] == "noteon")
                $onoff = 1;
            else
                $onoff = 0;
            $statement = "UPDATE users SET notifications = ".toQuote($onoff)." WHERE username = ".toQuote($_SESSION["username"]);
            $db->runStatement($db->getDBConn(),$statement);
        }
        if($_POST["themes"]){
            if($_POST["themes"] == "default")
                $onoff = "default";
            else
                $onoff = "dark";
            $statement = "UPDATE users SET themes = ".toQuote($onoff)." WHERE username = ".toQuote($_SESSION["username"]);
            $db->runStatement($db->getDBConn(),$statement);
        }
    }
?>
<html>
    <div class="centerdiv">
        <form style="align-text:left" action="" method="post" style="top:50%">
            <h4 class='title is-2'>So, not Satisfied? fine! what do you want changed?</h4>
            <?php 
                if($i == 0){
                    echo "<label><input class='checkbox' type='checkbox' name='usercheck' value='usercheck'>Change Username</label><br>
                    <label><input class='checkbox' type='checkbox' name='passcheck' value='passcheck'>Change Password</label><br>
                    <label><input class='checkbox' type='checkbox' name='emailcheck' value='emailcheck'>Change Email Address</label><br>
                    <label><input class='checkbox' type='checkbox' name='notecheck' value='notecheck'>Change Notification Settings</label><br>
                    <label><input class='checkbox' type='checkbox' name='themecheck' value='themecheck'>Change Theme Settings</label><br>
                    <input class='button is-dark' type='submit' name='btn' value='Submit'><br>";
                }
                if($i >= 1 && $_POST["usercheck"]==usercheck){
                    echo "<input class='input' type='text' name='curruser' placeholder='Enter Current Username'><br>
                    <input class='input' type='text' name='newuser' placeholder='Enter New Username'><br>";
                }
                if($i >= 1 && $_POST["passcheck"]==passcheck){
                    echo "<input class='input' title='You registered, you know what I expect...' pattern='^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{6,}$'' type='password'  name='currpass' placeholder='Enter Current Password'><br>
                    <input class='input' title='Password requires one lower case letter, one upper case letter, one digit, 8+ characters, and no spaces.' pattern='^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{6,}$' type='password'  name='newpass' placeholder='Enter New Password'><br>";
                }
                if($i >= 1 && $_POST["emailcheck"]==emailcheck){
                    echo "<input type='email' class='input' name='curremail' placeholder='Enter Current Email Address'><br>
                    <input type='email' class='input' name='newemail' placeholder='Enter New Email Address'><br>";
                }
                if($i >= 1 && $_POST["notecheck"] == notecheck){
                    echo "<label><input type='radio' name='notifications' value='noteon'>Receive Email Updates</label><br>
                    <label><input type='radio' name='notifications' value='noteoff'>Don't Receive Email Updates</label><br>";
                }
                if($i == 1){
                    echo "<input class='button is-dark' type='submit' name='button is-dark' value='Submit'><br>";
                }
            ?>
        </form>
    </div>

</html>