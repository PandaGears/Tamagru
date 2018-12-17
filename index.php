<?php
    // ini_set('display_errors', 'On');
    include("function/header.php");
    $imagelimit = 5;
    $out2 = $db->returnRecord("SELECT * FROM images");
    $total = count($out2);
    if(isset($_GET["page"])){
        $page = $_GET["page"];
        $i = ($_GET["page"] - 1 )* $imagelimit;
    }
    else{
        $i = 0;
        $page = 1;
    }
    $pages = ceil($total / $imagelimit);
    echo "<div class='galdiv'>";
    while ($i < $imagelimit*$page){
        echo "<a class='username' href='image.php?imageID=".$out2[$i]["imageID"]."'</a>";
        echo "<div class='imagediv'><img src=".$out2[$i]["image"]."></div>";
        $i++;
    }
    echo "<br><div class='imagediv' style='bottom:0%'>";
    for ($x = 1; $x <= $pages; $x++){
        echo "<a href='index.php?page=$x'>$x</a>"."\t";
    }
    echo "</div>";
    echo "</div>";

?>
<body>
<div class='hero-body'>
                    <div class='container has-text-centered'>
                        <h1 class='title is-2'>
                                    Not Tamagru
                                </h1>
								<h2 class='subtitle is-4'>Heya <?php echo isset($_SESSION['username'])?'['.$_SESSION['username'].']':' guest'; ?></h2>
                                 <h2 class='subtitle is-4'>
                                    All your Images: We see them now...
                                </h2>
                                <br>
                                <p class='has-text-centered'>
                                    <a class='button is-dark' href='gallery.php'>
                                        This is a gallery
                                    </a>
                                </p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </body>
                <div id="notification"></div>
			<div class="hero-foot">
				<footer class="footer">
					<div class="container">
						<div class="content has-text-centered">
						</div>
					</div>
				</footer>
</html>