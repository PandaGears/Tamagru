<?php

    include("header_front.php");

    $imagelimit = 5;
    $out2 = $db->returnRecord("SELECT * FROM images");
    $total = count($out2);
    if(isset($_GET["page"])){
        $page = $_GET["page"];
        $i = ($_GET["page"] - 1)* $imagelimit;
    }
    else{
        $i = 0;
        $page = 1;
    }
    $pages = ceil($total / $imagelimit);
    echo "<div class='centerdiv' style='top:140%' left:900px'>";
    while($i < $imagelimit*$page){
        echo "<a href='image.php?imageID=".$out2[$i]["imageID"]."'</a>
        <div class='imagedv'><img src=".$out2[$i]['image']."></div><br>";
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
<div class="hero-body">
                    <div  style='right:35% top:180%'>
                        <h1 class='title is-2'>
                                    Not Tamagru
                                </h1>
								<h2 class='subtitle is-4'>Heya <?php echo isset($_SESSION['username'])?'['.$_SESSION['username'].']':' ... You... Whoever you are...'; ?></h2>
                                 <h2 class='subtitle is-4'>
                                    All your Images: We see them now...
                                </h2>
                                <br>
                                <p >
                                    <a class='button is-dark' href='gallery.php'>
                                        This is your personal gallery
                                    </a>
                                </p>
                            </div>
                            </div>

</html>