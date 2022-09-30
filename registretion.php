<html>
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
            <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
            <link rel="stylesheet" type="text/css" href="css/lightbox.min.css?v=<?php echo time(); ?>">
            
            <script type="text/javascript" src="js/lightbox-plus-jquery.min.js"> </script>
        
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

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
                    
                </nav>
            </div>
        </div>

        <div class="hero">
            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" class="toggle-btn" onclick="login()">Se connecter</button>
                    <button type="button" class="toggle-btn" onclick="register()">Se inscrire</button>  
                </div>
                <form id="login" method="get" class="input-group">
                        <input type="text" class="input-field" name="loginName" placeholder="Nom de utilisateur" required>
                        <input type="password" class="input-field" name="loginPass" placeholder="Mot de Passe" required>
                        <input type="checkbox" class="chech-box"><span>Se souvenir du mot de passe</span>
                        <button type="submit" class="submit-btn">Login</button>
                </form>
                <form id="register" method="get" class="input-group">
                        <input type="text" class="input-field" name="regName" placeholder="Nom de utilisateur" required>
                        <input type="email" class="input-field" name="regMail" placeholder="Email " required>
                        <input type="password" class="input-field" name="regPass" placeholder="Mot de Passe" required>
                        <button type="submit" class="submit-btn">Se inscrire</button>
                </form>
                        </div>
                    <div class="social-icons">
                        <img src="images/facebook.png">
                        <img src="images/insta.png" >
                        </div>
                    </div>
<?php

    $head='';
    $body='';
    session_start();
    require_once("connexion_pdo.php");
    
    if (isset($_SESSION['sesNom'])) {
        echo 'bienvenue '.$_SESSION['sesNom'];
        //rederiction vers page d'acceuil
        //session_destroy();
        header('Location: index.php');
    }

    $uLogin=$_GET['loginName'];   //login
    $uPass=$_GET['loginPass'];
    ///register
    $regNom=$_GET['regName'];
    $regPassw=$_GET['regPass'];
    $regEmail=$_GET['regMail'];
    //echo $regEmail;
    $arrayLogins= array();

    $sql = "SELECT * FROM users";
    $resultat = $dbh->query($sql);
    
    //echo ' coucou ';
    while($row = $resultat->fetch())
    {
        echo '<pre style="color:green">';
        
        //print_r($row);
        if($row['nom']==$uLogin )
        {
            if ($row['password']==$uPass) {

                //echo 'bon utilisateur';
                $uEmail=$row['mail'];
                $uSub=$row['sub'];
                $uId=$row['id'];
            }
        }
        echo $row['nom'].'</p>';
        $arrayLogins[]=$row['nom'];
       // $iCpt++;
        echo '</pre>';
    }//fin while
    //print_r($arrayLogins);
     if (in_array($_GET['regName'],$arrayLogins)) {
            echo 'ce utilisateur existe deja'; ///////////////// faire un pop up
            ?>
                    <script>alert("<?php echo htmlspecialchars('Ce utilisateur existe deja', ENT_QUOTES); ?>")</script>
                    <?php
            //header('Location: registretion.php');
        }else {
            //creation de compte ++pop up
            try
            {
                $level=1;
                $sub=0;
                


                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // on force la génération d'exception pour les erreurs
                //$stmt = "INSERT INTO users (level,nom,password,mail,sub,id) VALUES ($level,$regNom,$regPassw,$regEmail,$sub,NULL)";
                

                $sql1 = "INSERT INTO users (level,nom,password,mail,sub) values (:level,:nom,:password,:mail,:sub)";
                
                $stmt = $dbh->prepare($sql1);/*
                $stmt->bindParam(':level',$level,PDO::PARAM_INT,20);
                $stmt->bindParam(':nom',$regNom,PDO::PARAM_STR,20);
                $stmt->bindParam(':password',$regPassw,PDO::PARAM_STR,30);
                $stmt->bindParam(':mail',$regEmail,PDO::PARAM_STR,30);
                $stmt->bindParam(':sub',$sub,PDO::PARAM_INT);
                $stmt->bindParam(':id',null,PDO::PARAM_INT);*/
                $stmt->execute(['level'=> $level, 'nom' => $regNom, 'password' => $regPassw, 'mail' => $regEmail, 'sub' => $sub]);

                
                
                $retour = $dbh->exec($stmt);
                // on utilise le triple === pour ne pas confondre le Zéro enregistrement avec le false (qui peut s'écrire 0). On vérifie donc le type
                if($retour === FALSE) // si c'est un booléen
                {
                    die('Erreur dans la requête<br />') ;
                    ?>
                    <script>alert("<?php echo htmlspecialchars('error', ENT_QUOTES); ?>")</script>
                    <?php
                }
                elseif($retour === 0) // si c'est un entier
                {
                    echo 'Aucune modification effectuée<br />';
                    ?>
                    <script>alert("<?php echo htmlspecialchars('Error', ENT_QUOTES); ?>")</script>
                    <?php
                }
                else
                {
                    $sMessageSuc='Creation avec succes';
                    echo $retour . ' lignes ont été affectées.<br />';
                    ?>
                    <script>alert("<?php echo htmlspecialchars('Creation avec succes', ENT_QUOTES); ?>")</script>
                    <?php
                }
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }


    //$result = $uLogin.' '.$uPass.' '.$uEmail.' sub:'.$uSub.' id:'.$uId;
    //echo $result;
    if (isset($uEmail) AND isset($uSub) AND isset($uId)) {
        echo ' account bon </br>';
        $_SESSION['sesNom']=$uLogin;
        $_SESSION['sesPass']=$uPass;
        $_SESSION['sesMail']=$uEmail;
        $_SESSION['sesId']=$uId;
        $_SESSION['sesSub']=$uSub;
        header('Location: index.php');
    }
    
    

    $scripts='<script>
    var x= document.getElementById("login");
    var y= document.getElementById("register");
    var z= document.getElementById("btn");
    
    function register(){
        x.style.left= "-400px";
        y.style.left= "50px";
        z.style.left= "110px";
    }
    function login(){
        x.style.left= "50px";
        y.style.left= "450px";
        z.style.left= "0px";
    }

</script>';

$end='</body>

</html>';

$sSendToHtml='';
$sSendToHtml.=$head.$body.$scripts.$end;
echo $sSendToHtml;

?>


