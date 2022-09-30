
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

        <div class="cardBodySub">
            <div class="profile">
                <div class="information">
                    <h3>Abonnment</h3>   

<?php

if (!isset($_SESSION['sesNom'])) {
    header('Location: index.php');
}
$id=$_SESSION['sesId'];

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$stmt = $dbh->prepare("SELECT * FROM users WHERE id = :id") ;
$stmt->execute(['id' => $id]);
while($row = $stmt->fetch())
{
    $subOld=$row['sub'];
    
}

if ($subOld==0) {
    echo 'vous avez un abonnemnt gratuit</br>';
}if ($subOld==1) {
    echo 'vous avez un abonnemnt GOLD</br>';
} else {
    echo 'vous avez un abonnemnt PREMIUM</br> ';
}
echo'voulez vous le changer?</br>';

$html='
<form id="buying" method="get" >
<select name="subs" >
    <option value="0">Gratuit</option>
    <option value="1">Gold</option>
    <option value="2">Premium</option>
</select>
    <button type="submit" name="bought" >Acheter le abbonemnt</button>
    </form>
    ';
    echo $html;



    if (isset($_GET['bought'])) {
        //echo 'you bought '.$_GET['subs'];
        $_SESSION['sesSub']=$_GET['subs'];
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE `users` SET  `sub`=:sub WHERE `users`.`id`=:id";
        
        $retour = $dbh->prepare($sql);
        $retour->execute([':sub' => $_GET['subs'], ':id'=>$id ]);
        
        header('Location: buySub.php');
    }
?>
<a href="account.php">retour</a>
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
