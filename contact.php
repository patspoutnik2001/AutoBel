<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact</title>
        <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    </head>
    <body class="body">
    <div class="navbar">
            <div class="container">
                <a class="logo" href="index.php"><img src="images/logoAutobel1.png" ></a>
                <img id="mobile-cta" class="mobile-menu" src="images/menu.svg" alt="Open navigation">
                <nav>
                    <img id="mobile-exit" class="mobile-menu-exit" src="images/exit.svg" alt="">
                    <ul class="primary-nav">
                        <li class="current"><a href="index.php">Acceil</a></li>
                        <li><a href="toutAnnonces.php">Annonces</a></li>
                        <?php
                            if(isset($_SESSION['sesNom']))
                            {
                                echo '<li><a href="creatingAction.php">Ajouter une annonce</a></li>
                                    <li><a href="myAnnonces.php">Mes annonces</a></li>
                                    ';
                            }                     

                        ?>           
                        

                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                    <ul class="secondary-nav">
                        <?php
                            if(isset($_SESSION['sesNom']))
                            {
                                echo '<li class="accountBtn" ><a href="account.php"> Bonjour '.$_SESSION['sesNom']. ' </a></li>';
                            }else
                            {
                                echo '<li class="SignUp"><a href="registretion.php">Login</a></li>';
                                
                            }                          

                        ?>                      
                    </ul>
                </nav>
            </div>
        </div>

        <section>
            <div class="aboutUs">
        <!--  about us  -->
            <img src="images/cool9.png" width="100%">
            </div>         
        </section>
        <section>
            <!-- contact form -->
            <div class="container2">
                <div class="contactForm">
                    <form 
                    
                    <?php
                    if(!empty($_GET['firstName']) and !empty($_GET['lastName']) and !empty($_GET['email']) and !empty($_GET['email']))
                    {
                        ?>action="confirmation.php"<?php
                    }
                    ?> method="GET">
                        <div class="typeForm">
                            <p class="label">Prénom *</p><input type="text" name="firstName" class="textarea">
                            <p class="label">Nom *</p><input type="text" name="lastName" class="textarea">
                            <p class="label">Email *</p><input type="email" name="email" class="textarea">
                            <p class="label">Téléphone *</p><input type="tel" name="tel" class="textarea">
                            <p class="label">Message *</p>
                            <textarea name="message" id="message" cols="30" rows="10" class="textarea"></textarea> <br>
                            <input type="submit" name="send" value="Envoyer" class="submit3">

                        <?php 
                            if(isset($_GET['send']))
                            {
                                if(empty($_GET['firstName']) or empty($_GET['lastName']) or empty($_GET['email']) or empty($_GET['email']))
                                {
                                    echo '<p class="label2">Obligatoire *</p>';
                                }
                            }
                            else
                            {
                                ?> <p class="label">Obligatoire *</p> <?php
                            }
                        ?>     
                        </div>  
                    </form>
                   
                </div>
                <div class="map">
                    <div class="googleMap">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3564.8460439377695!2d4.394561969874914!3d50.81770005209948!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3c44494b26cf1%3A0x4003887dcbd79f04!2sHaute%20Ecole%20Libre%20de%20Bruxelles%20Ilya%20Prigogine%20-%20D%C3%A9partement%20Technologies%20et%20Economie!5e0!3m2!1snl!2sbe!4v1619767197577!5m2!1snl!2sbe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </section>

        <section class="bottom">
            <a href="https://facebook.com"><img class="littleIcon" src="images/facebook.png" alt=""></a>
            <a href="https://instagram.com"><img class="littleIcon" src="images/insta.png" alt=""></a>
            <a href="https://twitter.com"><img class="littleIcon" src="images/twitter.svg" alt=""></a>
        </section>

        <script>
            const mobileBtn = document.getElementById('mobile-cta')
                nav = document.querySelector('nav');
                mobileBtnExit = document.getElementById('mobile-exit');
            mobileBtn.addEventListener('click', () => {
                nav.classList.add('menu-btn');
            })
            mobileBtnExit.addEventListener('click', () => {
                nav.classList.remove('menu-btn');
            })
        </script>

    </body>
</html>


