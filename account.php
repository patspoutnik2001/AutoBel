
<?php 
    session_start();
    include_once 'connexion_pdo.php';
    if (!isset($_SESSION['sesNom'])) {
        header('Location: index.php');
    }
    $stmt = $dbh->prepare("SELECT * FROM users WHERE id = :id") ;
    $stmt->execute(['id' => $_SESSION['sesId']]);
    while($row = $stmt->fetch())
    {
        $userBio=$row['bio'];
        $userGsm=$row['gsm'];
        
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account</title>
        <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/accountStyle.css">
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

        

<?php
   
    $disBtn='
    <form id="logout" method="get">
    <input type="submit" name="logout" value="deconecter">
    </form>
    ';
    $sUpdate='
    <form id="update" method="get" class="input-group"> 
        <input type="text"  name="upName" placeholder="changer le nom" class="areaText"><br>
        <input type="email"  name="upMail" placeholder="changer le Mail" class="areaText"><br>
        <input type="password"  name="upPass" placeholder="mot de passe actuel" class="areaText">
        <input type="password"  name="upPass1" placeholder="nouveu mot de passe" class="areaText"><br>
        <input type="number"  name="upNumber" placeholder="ajouter/modifier numero de GSM" class="areaText"><br>
        <input type="file"  name="profileImage"  class="areaText" accept="*/image"><br>
        <button type="submit" name="update" class="submit-btn">Sauvegarder</button>
    </form>
    </br>
    <form id="updateBio" method="get" class="input-group">
        <textarea name="BioText" id="BioText"></textarea>
        <button type="submit" name="bioUpdate" value="bio" >Changer la bio</button>
        </form>
        <form id="sub" method="get" >
    <button type="submit" name="sub" value="buy" >Changer le abbonemnt</button>
    </form>
    ';
    $sDelete='
    <form id="update" method="get" class="input-group">
    <button type="submit" name="deleted" class="submitDelete">Supprimer le compte</button>
    </form>
    ';
    $sSubBtn='
    
    ';

    if (isset($_SESSION['sesNom'])) { // si la session existe alors on affiche les info + button deconnecter
        
        ?>
        <div class="cardBody">
            <div class="profile">
                <div class="information">
                    <h3>Profile</h3>   
                <?php
                $sql="SELECT * FROM users WHERE id= '".$_SESSION['sesId']."'";//on recupre les annonce du utlisteur
                $resultat = $dbh->query($sql);
                $row = $resultat->fetch();
                $nbrAnnonces=$row['annonceEnCours'];
                $nbrBoost=$row['nbrBoost'];
                $imageEncours=$row['imageProfile'];//if null => default image picture
                if ($imageEncours==null) {
                    $imageEncours='deafultprofile.jpg';
                }
                
                echo '<img src='?>"images/<?php echo $imageEncours; ?>"<?php echo ' width="100" height="100"></br> ';
                echo 'Bonjour '.$_SESSION['sesNom'].'<br>';// ceux qui on sub->0 normal/ sub->1 jaune/sub-> bleu
                //$_SESSION['sesId']; id du utilisteur!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                //echo 'Mot de pass: '.$_SESSION['sesPass'].'<br>';
                echo 'Votre mail:  '.$_SESSION['sesMail'].'<br>';
                //echo 'Votre id:  '.$_SESSION['sesId'].'<br>';
                if ($_SESSION['sesSub']==0) {  //abbonemnt
                    echo 'Vous avez un abonnemnt gratuit</br>';
                }if ($_SESSION['sesSub']==1) {
                    echo 'Vous avez un abonnemnt GOLD</br>';
                } else {
                    echo 'Vous avez un abonnemnt PREMIUM</br> ';
                }
                
                if ($userGsm==null AND $userGsm=="") {  //GSM
                    echo 'Pas de numero de Gsm</br>';
                }else {
                    echo 'Votre numero de gsm:'.$userGsm.'</br>';
                }
                if ($nbrAnnonces==null) {  //annonces
                    echo '0 Annonces en ligne</br>';
                }else {
                    echo $nbrAnnonces.' annonces en ligne </br>';
                }
                echo $nbrBoost.' boosts </br>';
                if ($userBio==null AND $userBio=="") {  //bio
                    echo 'Le utilisateur a pas de bio</br>';
                }else {
                    echo 'Bio: '.$userBio.'</br>';
                }
                
                //echo $imageEncours;
                echo $disBtn. '</div>';
                echo $sSubBtn;
                
                ?>
                <div class="modify">
                    <h3>Modifier</h3>
                    <?= $sUpdate ?>
                </div>
                <div class="delete">
                    <?= $sDelete ?>
                </div>
            </div>
        </div>
        <?php

        if (isset($_GET['deleted'])) {
            echo 'le compte deleted';

            $sql = "DELETE FROM users WHERE id=:id";
            $retour = $dbh->prepare($sql);
            $retour->execute([':id'=>$_SESSION['sesId'] ]);
            echo '<script>alert("Le compte a ete suprimé")</script>';
            session_destroy();
            header('Location: account.php');
        }

        if (isset($_GET['update'])) {
            $sUpName=$_SESSION['sesNom'];
            $sUpMail=$_SESSION['sesMail'];
            $sUpPass=$_SESSION['sesPass'];
            
            
            $image=$_FILES['image']['name'];
            echo $image;
            $target = "images/".basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'],$target);
            if(($_GET['upName']!=$_SESSION['sesNom'] AND $_GET['upName']!="" ))//si on veut chnager le nom
            {
                $sUpName=$_GET['upName'];
                
            }
            if($_GET['upMail']!=$_SESSION['sesMail'] AND $_GET['upMail']!="")//si on veut changer le mail
            {
                $sUpMail=$_GET['upMail'];
                
            }

            if ($_GET['upPass']==$_SESSION['sesPass']) {//si le mdp est bon
                $sUpPass=$_GET['upPass1'];
            }

            if ($_GET['upNumber']!=$userGsm AND $_GET['upNumber']!="" ) {
                $userGsm=$_GET['upNumber'];
            }

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `users` SET  `imageProfile`=:imageProfile,`nom`=:nom, `password`=:password, `mail`=:mail, `gsm`=:gsm WHERE `users`.`id`=:id";
            
            $retour = $dbh->prepare($sql);
            $retour->execute(['imageProfile'=>$image,':nom' => $sUpName, ':password' => $sUpPass, ':mail' => $sUpMail, ':gsm' => $userGsm , ':id'=>$_SESSION['sesId'] ]);
            // on utilise le triple === pour ne pas confondre le Zéro enregistrement avec le false (qui peut s'écrire 0). On vérifie donc le type
            
            $_SESSION['sesNom']=$sUpName;
            $_SESSION['sesPass']=$sUpPass;
            $_SESSION['sesMail']=$sUpMail;
                //echo '<script>alert("Succes")</script>';
            header('Location: account.php');
            
        }
        if (isset($_GET['updateBio'])) {
            echo $bioText;
        }
    }
    if (!isset($_SESSION['sesNom'])) { //si la session existe pas
        echo '<a href="registretion.php">connecter vous ici</a>';
    }
    
    if (isset($_GET['logout'])) {
    header('Location: account.php');
    //echo 'post marche';
    session_destroy();
    }
    if (isset($_GET['sub'])) {
    header('Location: buySub.php');
    }
    if (isset($_GET['bioUpdate'])) {
        $bioText = $_GET['BioText'];
        //echo $bioText;
        $sql = "UPDATE `users` SET  `bio`=:bio WHERE `users`.`id`=:id";
            
        $retour = $dbh->prepare($sql);
        $retour->execute([':bio' => $bioText, ':id'=>$_SESSION['sesId'] ]);
        header('Location: account.php');
    }


?>
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
        <script src="ckeditor/ckeditor.js"></script>
        <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <script>
             CKEDITOR.remplace("BioText");
        </script>
        

    </body>
</html>





