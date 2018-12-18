<?php

    include("header_front.php");

?>
<body>
<div class='hero-body'>
                    <div class='container has-text-centered'>
                        <h1 class='title is-2'>
                                    Not Tamagru
                                </h1>
								<h2 class='subtitle is-4'>Heya <?php echo isset($_SESSION['username'])?'['.$_SESSION['username'].']':' ... You... Whoever you are...'; ?></h2>
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