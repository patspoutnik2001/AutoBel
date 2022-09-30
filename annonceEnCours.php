
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
        <link rel="stylesheet" type="text/css" href="css/lightbox.min.css?v=<?php echo time(); ?>">
        <script type="text/javascript" src="js/lightbox-plus-jquery.min.js"> </script>
        
        

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
                                    <li><a href="myAnnonces.php">Mes annonces</a></li>';
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


<!-------------contenue --------->


<?php
   

    if(isset($_GET['value_key'])){
        $var = $_GET['value_key']; //some_value
        //echo $var;
      }
      $stmt = $dbh->prepare("SELECT * FROM products WHERE id = :id") ;
      $stmt->execute(['id' => $var]);
      while($row = $stmt->fetch())
      {
        $image=$row['image'];
        $brand_id=$row['brand_id'];
        $name=$row['name'];
        $fonction=$row['fonction'];
        $prix=$row['price'];
        $userId=$row['userID'];  
      }/*
      echo $image.'</br>';
      echo $brand_id.'</br>';
      echo $name.'</br>';
      echo $fonction.'</br>';
      echo $prix.'</br>';*/

?>   

    
      
    
    
    <div class="ProductBig">
        <div class="col1">
            <img src="images/<?php echo $image; ?>" width="100%">
        </div>          
        <div class="col2">      
            <h2><?php echo $name ?></h2>
            <h4><?php echo $fonction ?></h4>
            <h4><?php echo $prix ?> euro</h4>
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