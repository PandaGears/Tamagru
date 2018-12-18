<?php
    session_start();
    include("../config/setup.php");
?>
<head>
    <title>Tamagru</title>
		<section class="hero is-fullheight is-default is-bold">
			<div class="hero-head">
				<nav class="navbar is-fixed-top">
					<div class="navbar-brand">
						<a class="navbar-item" href="index.php">
						</a>
						<div class="navbar-burger burger" id="burger_menu">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
					<div class="navbar-menu">
						<div class="navbar-start">
                            <a class='navbar-item' href='index.php'>Home</a>
							<a class='navbar-item' name="home-btn" href="gallery.php">Gallery</a>
						</div>
						<div class="navbar-end">
							<div class="navbar-item">
								<div class="field is-grouped">
                                <?php
                    if($_SESSION["username"] != "")
                    {
                       ?>
                        <p class='control'>
                        <a class='button button is-dark' href="logout.php" name="logout-btn" id="logout-btn" value="Log Out">
                            <span>Log out</span>
                        </a>
                        </p>
                    <p class='control'>
                    <a class='button button is-dark' name="user-btn" href='video.php' value="Camera">
                            <span>Photo</span>
                        </a>
                        </p>
                    <p class='control'>
                        <a class='button button is-dark' name="settings-btn" href='settings.php' value="Settings">
                            <span>Settings</span>
                        </a>
                        </p>
                    <p class='control'>
                    <a class='button button is-dark' name="usergal-btn" value="'.$_SESSION["username"].'\'s Images">
                            <span>Profile</span>
                        </a>
                        </p>
<?php	}
	else{?>
		<p class='control'>
			<a class='button button is-dark' name="login-btn" href='signup.php' value="Login/Sign Up">
				<span>Deets Here</span>
			</a>
		</p>
<?php	}	?>
									</p>
								</div>
							</div>
						</div>
					</div>
				</nav>
			</div>

        </div>
    </form>
    </div>
    <link rel="stylesheet" href="styles/bulma.min.css">
        <link rel="stylesheet" href="styles/default.css">	
        <link rel="stylesheet" href="styles/dark.css">	
    <link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet"> 
</head>
</html>