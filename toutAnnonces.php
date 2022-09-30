<?php 
session_start();
include_once 'connexion_pdo.php';?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account</title>
        <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/accountStyle.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/lightbox.min.css?v=<?php echo time(); ?>">
            <script type="text/javascript" src="js/lightbox-plus-jquery.min.js"> </script>
        
        

    </head>
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


        <div class="container5">
            <!-- Brands Items - Products --> 
            <div class="card-myProduct">

    <?php
        
        $stmt = $dbh->prepare("SELECT * FROM users ") ;
        $stmt->execute();
        $k=1;
        while($row1 = $stmt->fetch())
        {
          //echo $row1['gsm'].'</br>' ;
          $numTelArray[$k]=$row1['gsm'];
          $k++;
        }
        //print("Fetch all of the remaining rows in the result set:\n");
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        $sth = $dbh->prepare("SELECT userId FROM products ");
        $sth->execute();

        
        $result = $sth->fetchAll();
      
        $compte=0;
        //echo $result[0][0];

        $row_count =count($result);
        //echo $row_count;

        for ($i=0; $i <$row_count ; $i++) { 
          $AnnonceTel[$compte]=$numTelArray[$result[$i][0]];
          //echo $result[$i][0].'</br>';
          $compte++;
        }
       

                $sql="SELECT * FROM products ";//on recupre les annonce 
                $resultat = $dbh->query($sql);
                $row_count =$resultat->fetchColumn();
                //echo $row_count;
                if ($row_count>0) {
                  ?> <div class="card-myProducts"> <?php
                 $i=0;
                 while($row = $resultat->fetch()){
                 ?>
                 <div class="MyProducts">
                   <div class="photoMyproduct">
                     <a href="images/<?php echo $row['image']; ?>" data-lightbox="mygallery<?=$i++?>">
                         <img src="images/<?php echo $row['image']; ?>" width="100%">
                     </a>
                   </div>
                   <div class="textMyproduct">
                       <p class="NameProduct"><a href="annonceEnCours.php?value_key=<?php echo $row['id'];?>"><?php echo $row['name']; ?></a></p>
                       <p> Boite : <?php echo $row['fonction']; ?></p>
                       <p>Prix : <?php echo $row['price']; ?></p>
                        <p>Tel : <?php if(isset($_SESSION['sesNom'])){echo $AnnonceTel[$row['userID']];}else{echo 'Connecter vous d'."'".'abord ';}
                         ?></p>
                   </div> 
                 </div>
                 <?php                                          
                 }
                 ?> 
                </div> <?php

             }else {
               echo 'error rien trouvé';
             }  
               
            ?>


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