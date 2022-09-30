<?php
 session_start();
 include_once 'connexion_pdo.php';
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

        <div class="cardBody">
            <div class="profile">
                <div class="information">
                    <h3>Creation d'annonce</h3>   
                        <form action="creatingAction.php" id="create" method="post" class="input-group" enctype="multipart/form-data"> 
                            <input type="text"  name="crTitre" placeholder="Titre de l'annonce" class="areaText"><br>
                            <select name="crFonction" >
                                <option value="Automatique">Automatique</option>
                                <option value="Manuelle">Manuelle</option>
                            </select></br>
                            <input type="number"  name="crPrice" placeholder="Prix" class="areaText"><br>
                            <select name="crBrand" >
                                <option value="1">Mercedes-Benz</option>
                                <option value="2">Audi</option>
                                <option value="3">Volkswagen</option>
                                <option value="4">BMW</option>
                            </select></br>
                            <input type="file"  name="image" placeholder="Image" class="areaText"><br>
                            <button type="submit" name="create" class="submit-btn">creation</button>
                        </form>
<?php
    if (!isset($_SESSION['sesNom'])) {
        header('Location: index.php');
    }
    
    $sql1="SELECT * FROM users WHERE id= '".$_SESSION['sesId']."'";//on recupre les annonce du utlisteur
    $resultat1 = $dbh->query($sql1);
    $row1 = $resultat1->fetch();
    $nbrAnnonces=$row1['annonceEnCours'];

    if (isset($_POST['create'])) {
        $titre=$_POST['crTitre'];
        $boite=$_POST['crFonction'];
        $prix=$_POST['crPrice'];
        $idBrand=$_POST['crBrand'];
        

        
        
        $currentUserId=$_SESSION['sesId'];
        //echo $boite;
        //echo $idBrand;
        if ($titre=="" OR $prix=="") {
            //message box: error
        }else {
            $image=$_FILES['image']['name'];
            $target = "images/".basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'],$target);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO products (image,brand_id,name,fonction,price,userID) values (:image,:brand_id,:name,:fonction,:price,:userID) ";
                
            $retour = $dbh->prepare($sql);
            $retour->execute([':image'=>$image ,':brand_id' => $idBrand, ':name' => $titre, ':fonction' => $boite, ':price' => $prix , ':userID'=> $currentUserId ]);

            $sql2 = "UPDATE `users` SET  `annonceEnCours`=:annonceEnCours WHERE `users`.`id`=:id";
            if ($nbrAnnonces==null) {
                $nbrAnnonces=1;
            }
            $nbrAnnonces=$nbrAnnonces+1;
            $retour2 = $dbh->prepare($sql2);
            $retour2->execute([':annonceEnCours' => $nbrAnnonces, ':id'=>$currentUserId]);
            header('Location: index.php');
        }
        
        
        
    }
?>
        </div>
            </div>
        </div>
        
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

