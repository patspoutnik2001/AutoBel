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
        <title>Acheter</title>
            <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
            <link rel="stylesheet" type="text/css" href="css/lightbox.min.css?v=<?php echo time(); ?>">
            <script type="text/javascript" src="js/lightbox-plus-jquery.min.js"> </script>
    </head>
    <body class="body">

    <div class="navbar">
            <div class="container">
                <a class="logo" href="index.php"><img src="images/logoAutobel1.png"></a>
                <img id="mobile-cta" class="mobile-menu" src="images/menu.svg" alt="Open navigation">
                <nav>
                    <img id="mobile-exit" class="mobile-menu-exit" src="images/exit.svg" alt="">
                    <ul class="primary-nav">
                        <li class="current"><a href="index.php">Acceil</a></li>
                        <li><a href="searching.php">Acheter</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                    <ul class="secondary-nav">
                        <?php
                            if(isset($_SESSION['sesNom']))
                            {
                                echo '<li><a href="account.php"> Bonjour '.$_SESSION['sesNom']. ' </a></li>';
                            }else
                            {
                                echo '<li class="SignUp"><a href="registretion.php">Login</a></li>';
                                
                            }                          

                        ?>                      
                    </ul>
                </nav>
            </div>
        </div>
        
        <div class="container1">
            <!-- Brands List -->
            <div class="card-filter">
                <div class="card-body">
                    <form action="" method="GET" >
                        <div>
                            <h3>Filter</h3>
                        </div>
                        <div class="btnSubmit1">
                            <button type="submit" class="btnSubmit">Search</button>
                        </div>
                        <hr>
                            <?php
                            $con = mysqli_connect("localhost", "redacteur", "helb", "autobel");
                                if(isset($_SESSION['sesNom']))
                                { 
                                    $brand_query = "SELECT * FROM car_brands";
                                    $brand_query_run = mysqli_query($con, $brand_query);

                                    if(mysqli_num_rows( $brand_query_run) > 0)
                                    {
                                        foreach( $brand_query_run as $brandlist)
                                        {
                                            $checked = [];
                                            if(isset($_GET['brands']))
                                            {
                                                $checked = $_GET['brands'];
                                            }
                                            ?>
                                                <div>
                                                    <input type="checkbox" name="brands[]" value="<?= $brandlist['id']; ?>"        
                                                    <?php 
                                                        if(in_array($brandlist['id'], $checked))
                                                        {
                                                            echo "checked";
                                                        }  
                                                    ?>
                                                    />
                                                    <?= $brandlist['name']; ?>
                                                </div>
                                            <?php
                                        }
                                    }
                                }else
                                {
                                    ?>
                                    <p>Cette option est réservée aux membres</p>
                                    <?php
                                }   
                                
                            ?>
                    </form>
                </div>
            </div>
        
            
            <!-- Brands Items - Products --> 
            <div class="card-products">
                <div class="card-body">
                    <form action="products.php" method="GET">
                        <?php
                            if(isset($_GET['brands']))
                            {
                                $brandchecked = [];
                                $brandchecked = $_GET['brands'];
                                foreach($brandchecked as $rowbrand)
                                {
                                    //echo $rowbrand;
                                    $products = "SELECT * FROM products WHERE brand_id IN ($rowbrand)";
                                    $products_run = mysqli_query($con, $products);
                                    if(mysqli_num_rows($products_run) > 0)
                                    {
                                        foreach($products_run as $prodItems) : 
                                            switch ($prodItems['id'])
                                            {
                                                case 1:?>
                                                <div class="col-md-4">
                                                    <div class="border-p-2"> 
                                                        <a href="database Voitures/1/1photo1.webp" data-lightbox="mygallery1">
                                                            <img src="database Voitures/1/1photo1.webp" width="100%">
                                                        </a>
                                                        <a href="database Voitures/1/1photo2.webp" data-lightbox="mygallery1"></a>
                                                        <a href="database Voitures/1/1photo3.webp" data-lightbox="mygallery1"></a>
                                                        <a href="database Voitures/1/1photo4.webp" data-lightbox="mygallery1"></a>
                                                        <a href="database Voitures/1/1photo5.webp" data-lightbox="mygallery1"></a>
                                                        <a href="database Voitures/1/1photo6.webp" data-lightbox="mygallery1"></a> 
                                                    </div>
                                                    <div class="text1">
                                                        <h3><a href="annonceEnCours.php"><?= $prodItems['name']; ?></a></h3>
                                                        <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                        <h3>PRIX: <?= $prodItems['price']; ?></h3>
                                                        <h3 class="phone"><img  src="images/phone.png" width="100%"> <?= $prodItems['tel']; ?></h3>
                                                    </div>
                                                </div>     
                                                    <?php break;
                                                case 2:?>
                                                    <div class="col-md-4">
                                                        <div class="border-p-2"> 
                                                            <div class="gallery">
                                                                <a href="database Voitures/1/2photo1.webp" data-lightbox="mygallery2">
                                                                    <img class="zoomImg" src="database Voitures/1/2photo1.webp" width="100%">
                                                                </a>
                                                                <a href="database Voitures/1/2photo2.webp" data-lightbox="mygallery2"></a>
                                                                <a href="database Voitures/1/2photo3.webp" data-lightbox="mygallery2"></a>
                                                                <a href="database Voitures/1/2photo4.webp" data-lightbox="mygallery2"></a>
                                                                <a href="database Voitures/1/2photo5.webp" data-lightbox="mygallery2"></a>
                                                                <a href="database Voitures/1/2photo6.webp" data-lightbox="mygallery2"></a> 
                                                            </div>
                                                        </div>
                                                        <div class="text1">
                                                            <h3><?= $prodItems['name']; ?></h3>
                                                            <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                            <h3>PRIX: <?= $prodItems['PRIX']; ?></h3>
                                                            <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                        </div>
                                                    </div>     
                                                        <?php break;
                                                case 3:?>
                                                    <div class="col-md-4">
                                                        <div class="border-p-2"> 
                                                            <div class="gallery">
                                                                <a href="database Voitures/1/3photo1.webp" data-lightbox="mygallery3">
                                                                    <img class="zoomImg" src="database Voitures/1/3photo1.webp" width="100%">
                                                                </a>
                                                                <a href="database Voitures/1/3photo2.webp" data-lightbox="mygallery3"></a>
                                                                <a href="database Voitures/1/3photo3.webp" data-lightbox="mygallery3"></a>
                                                                <a href="database Voitures/1/3photo4.webp" data-lightbox="mygallery3"></a>
                                                                <a href="database Voitures/1/3photo5.webp" data-lightbox="mygallery3"></a>
                                                                <a href="database Voitures/1/3photo6.webp" data-lightbox="mygallery3"></a> 
                                                            </div>
                                                        </div>
                                                        <div class="text1">
                                                            <h3><?= $prodItems['name']; ?></h3>
                                                            <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                            <h3>PRIX: <?= $prodItems['PRIX']; ?></h3>
                                                            <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                        </div>
                                                    </div>     
                                                        <?php break;
                                                case 4:?>
                                                    <div class="col-md-4">
                                                        <div class="border-p-2"> 
                                                            <div class="gallery">
                                                                <a href="database Voitures/1/4photo1.webp" data-lightbox="mygallery4">
                                                                    <img class="zoomImg" src="database Voitures/1/4photo1.webp" width="100%">
                                                                </a>
                                                                <a href="database Voitures/1/4photo2.webp" data-lightbox="mygallery4"></a>
                                                                <a href="database Voitures/1/4photo3.webp" data-lightbox="mygallery4"></a>
                                                                <a href="database Voitures/1/4photo4.webp" data-lightbox="mygallery4"></a>
                                                                <a href="database Voitures/1/4photo5.webp" data-lightbox="mygallery4"></a>
                                                                <a href="database Voitures/1/4photo6.webp" data-lightbox="mygallery4"></a> 
                                                            </div>
                                                        </div>
                                                        <div class="text1">
                                                            <h3><?= $prodItems['name']; ?></h3>
                                                            <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                            <h3>PRIX: <?= $prodItems['PRIX']; ?></h3>
                                                            <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                        </div>
                                                    </div>     
                                                        <?php break;
                                                case 5:?>
                                                    <div class="col-md-4">
                                                        <div class="border-p-2"> 
                                                            <div class="gallery">
                                                                <a href="database Voitures/1/5photo1.webp" data-lightbox="mygallery5">
                                                                    <img class="zoomImg" src="database Voitures/1/5photo1.webp" width="100%">
                                                                </a>
                                                                <a href="database Voitures/1/5photo2.webp" data-lightbox="mygallery5"></a>
                                                                <a href="database Voitures/1/5photo3.webp" data-lightbox="mygallery5"></a>
                                                                <a href="database Voitures/1/5photo4.webp" data-lightbox="mygallery5"></a>
                                                                <a href="database Voitures/1/5photo5.webp" data-lightbox="mygallery5"></a>
                                                                <a href="database Voitures/1/5photo6.webp" data-lightbox="mygallery5"></a> 
                                                            </div>
                                                        </div>
                                                        <div class="text1">
                                                            <h3><?= $prodItems['name']; ?></h3>
                                                            <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                            <h3>PRIX: <?= $prodItems['PRIX']; ?></h3>
                                                            <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                        </div>
                                                    </div>     
                                                        <?php break;
                                                case 6:?>
                                                    <div class="col-md-4">
                                                        <div class="border-p-2"> 
                                                            <div class="gallery">
                                                                <a href="database Voitures/1/6photo1.webp" data-lightbox="mygallery6">
                                                                    <img class="zoomImg" src="database Voitures/1/6photo1.webp" width="100%">
                                                                </a>
                                                                <a href="database Voitures/1/6photo2.webp" data-lightbox="mygallery6"></a>
                                                                <a href="database Voitures/1/6photo3.webp" data-lightbox="mygallery6"></a>
                                                                <a href="database Voitures/1/6photo4.webp" data-lightbox="mygallery6"></a>
                                                                <a href="database Voitures/1/6photo5.webp" data-lightbox="mygallery6"></a>
                                                                <a href="database Voitures/1/6photo6.webp" data-lightbox="mygallery6"></a> 
                                                            </div>
                                                        </div>
                                                        <div class="text1">
                                                            <h3><?= $prodItems['name']; ?></h3>
                                                            <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                            <h3>PRIX: <?= $prodItems['PRIX']; ?></h3>
                                                            <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                        </div>
                                                    </div>     
                                                        <?php break;
                                                case 7:?>
                                                    <div class="col-md-4">
                                                        <div class="border-p-2"> 
                                                            <div class="gallery">
                                                                <a href="database Voitures/1/7photo1.webp" data-lightbox="mygallery7">
                                                                    <img class="zoomImg" src="database Voitures/1/7photo1.webp" width="100%">
                                                                </a>
                                                                <a href="database Voitures/1/7photo2.webp" data-lightbox="mygallery7"></a>
                                                                <a href="database Voitures/1/7photo3.webp" data-lightbox="mygallery7"></a>
                                                                <a href="database Voitures/1/7photo4.webp" data-lightbox="mygallery7"></a>
                                                                <a href="database Voitures/1/7photo5.webp" data-lightbox="mygallery7"></a>
                                                                <a href="database Voitures/1/7photo6.webp" data-lightbox="mygallery7"></a> 
                                                            </div>
                                                        </div>
                                                        <div class="text1">
                                                            <h3><?= $prodItems['name']; ?></h3>
                                                            <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                            <h3>PRIX: <?= $prodItems['PRIX']; ?></h3>
                                                            <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                        </div>
                                                    </div>     
                                                        <?php break;
                                                case 8:?>
                                                    <div class="col-md-4">
                                                        <div class="border-p-2"> 
                                                            <div class="gallery">
                                                                <a href="database Voitures/1/8photo1.webp" data-lightbox="mygallery8">
                                                                    <img class="zoomImg" src="database Voitures/1/8photo1.webp" width="100%">
                                                                </a>
                                                                <a href="database Voitures/1/8photo2.webp" data-lightbox="mygallery8"></a>
                                                                <a href="database Voitures/1/8photo3.webp" data-lightbox="mygallery8"></a>
                                                                <a href="database Voitures/1/8photo4.webp" data-lightbox="mygallery8"></a>
                                                                <a href="database Voitures/1/8photo5.webp" data-lightbox="mygallery8"></a>
                                                                <a href="database Voitures/1/8photo6.webp" data-lightbox="mygallery8"></a> 
                                                            </div>
                                                        </div>
                                                        <div class="text1">
                                                            <h3><?= $prodItems['name']; ?></h3>
                                                            <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                            <h3>PRIX: <?= $prodItems['PRIX']; ?></h3>
                                                            <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                        </div>
                                                    </div>     
                                                        <?php break;                                                        
                                            }    
                                        endforeach;
                                    }
                                }
                            }
                            else
                            {
                                $products = "SELECT * FROM products";
                                $products_run = mysqli_query($con, $products);
                                if(mysqli_num_rows($products_run) > 0)
                                {
                                    foreach($products_run as $prodItems) : 
                                        switch ($prodItems['id'])
                                        {
                                            case 1:?>
                                            <div class="col-md-4">
                                                <div class="border-p-2"> 
                                                    <a href="database Voitures/1/1photo1.webp" data-lightbox="mygallery1">
                                                        <img src="database Voitures/1/1photo1.webp" width="100%">
                                                    </a>
                                                    <a href="database Voitures/1/1photo2.webp" data-lightbox="mygallery1"></a>
                                                    <a href="database Voitures/1/1photo3.webp" data-lightbox="mygallery1"></a>
                                                    <a href="database Voitures/1/1photo4.webp" data-lightbox="mygallery1"></a>
                                                    <a href="database Voitures/1/1photo5.webp" data-lightbox="mygallery1"></a>
                                                    <a href="database Voitures/1/1photo6.webp" data-lightbox="mygallery1"></a> 
                                                </div>
                                                <div class="text1">
                                                    <h3><a href="annonceEnCours.php"><?= $prodItems['name']; ?></a></h3>
                                                    <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                    <h3>PRIX: <?= $prodItems['price']; ?></h3>
                                                    <h3 class="phone"><img  src="images/phone.png" width="100%"> <?= $prodItems['userID']; ?></h3>
                                                </div>
                                            </div>     
                                                <?php break;
                                            case 2:?>
                                                <div class="col-md-4">
                                                    <div class="border-p-2"> 
                                                        <div class="gallery">
                                                            <a href="database Voitures/1/2photo1.webp" data-lightbox="mygallery2">
                                                                <img class="zoomImg" src="database Voitures/1/2photo1.webp" width="100%">
                                                            </a>
                                                            <a href="database Voitures/1/2photo2.webp" data-lightbox="mygallery2"></a>
                                                            <a href="database Voitures/1/2photo3.webp" data-lightbox="mygallery2"></a>
                                                            <a href="database Voitures/1/2photo4.webp" data-lightbox="mygallery2"></a>
                                                            <a href="database Voitures/1/2photo5.webp" data-lightbox="mygallery2"></a>
                                                            <a href="database Voitures/1/2photo6.webp" data-lightbox="mygallery2"></a> 
                                                        </div>
                                                    </div>
                                                    <div class="text1">
                                                        <h3><?= $prodItems['name']; ?></h3>
                                                        <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                        <h3>PRIX: <?= $prodItems['price']; ?></h3>
                                                        <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                    </div>
                                                </div>     
                                                    <?php break;
                                            case 3:?>
                                                <div class="col-md-4">
                                                    <div class="border-p-2"> 
                                                        <div class="gallery">
                                                            <a href="database Voitures/1/3photo1.webp" data-lightbox="mygallery3">
                                                                <img class="zoomImg" src="database Voitures/1/3photo1.webp" width="100%">
                                                            </a>
                                                            <a href="database Voitures/1/3photo2.webp" data-lightbox="mygallery3"></a>
                                                            <a href="database Voitures/1/3photo3.webp" data-lightbox="mygallery3"></a>
                                                            <a href="database Voitures/1/3photo4.webp" data-lightbox="mygallery3"></a>
                                                            <a href="database Voitures/1/3photo5.webp" data-lightbox="mygallery3"></a>
                                                            <a href="database Voitures/1/3photo6.webp" data-lightbox="mygallery3"></a> 
                                                        </div>
                                                    </div>
                                                    <div class="text1">
                                                        <h3><?= $prodItems['name']; ?></h3>
                                                        <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                        <h3>PRIX: <?= $prodItems['price']; ?></h3>
                                                        <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                    </div>
                                                </div>     
                                                    <?php break;
                                            case 4:?>
                                                <div class="col-md-4">
                                                    <div class="border-p-2"> 
                                                        <div class="gallery">
                                                            <a href="database Voitures/1/4photo1.webp" data-lightbox="mygallery4">
                                                                <img class="zoomImg" src="database Voitures/1/4photo1.webp" width="100%">
                                                            </a>
                                                            <a href="database Voitures/1/4photo2.webp" data-lightbox="mygallery4"></a>
                                                            <a href="database Voitures/1/4photo3.webp" data-lightbox="mygallery4"></a>
                                                            <a href="database Voitures/1/4photo4.webp" data-lightbox="mygallery4"></a>
                                                            <a href="database Voitures/1/4photo5.webp" data-lightbox="mygallery4"></a>
                                                            <a href="database Voitures/1/4photo6.webp" data-lightbox="mygallery4"></a> 
                                                        </div>
                                                    </div>
                                                    <div class="text1">
                                                        <h3><?= $prodItems['name']; ?></h3>
                                                        <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                        <h3>PRIX: <?= $prodItems['price']; ?></h3>
                                                        <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                    </div>
                                                </div>     
                                                    <?php break;
                                            case 5:?>
                                                <div class="col-md-4">
                                                    <div class="border-p-2"> 
                                                        <div class="gallery">
                                                            <a href="database Voitures/1/5photo1.webp" data-lightbox="mygallery5">
                                                                <img class="zoomImg" src="database Voitures/1/5photo1.webp" width="100%">
                                                            </a>
                                                            <a href="database Voitures/1/5photo2.webp" data-lightbox="mygallery5"></a>
                                                            <a href="database Voitures/1/5photo3.webp" data-lightbox="mygallery5"></a>
                                                            <a href="database Voitures/1/5photo4.webp" data-lightbox="mygallery5"></a>
                                                            <a href="database Voitures/1/5photo5.webp" data-lightbox="mygallery5"></a>
                                                            <a href="database Voitures/1/5photo6.webp" data-lightbox="mygallery5"></a> 
                                                        </div>
                                                    </div>
                                                    <div class="text1">
                                                        <h3><?= $prodItems['name']; ?></h3>
                                                        <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                        <h3>PRIX: <?= $prodItems['price']; ?></h3>
                                                        <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                    </div>
                                                </div>     
                                                    <?php break;
                                            case 6:?>
                                                <div class="col-md-4">
                                                    <div class="border-p-2"> 
                                                        <div class="gallery">
                                                            <a href="database Voitures/1/6photo1.webp" data-lightbox="mygallery6">
                                                                <img class="zoomImg" src="database Voitures/1/6photo1.webp" width="100%">
                                                            </a>
                                                            <a href="database Voitures/1/6photo2.webp" data-lightbox="mygallery6"></a>
                                                            <a href="database Voitures/1/6photo3.webp" data-lightbox="mygallery6"></a>
                                                            <a href="database Voitures/1/6photo4.webp" data-lightbox="mygallery6"></a>
                                                            <a href="database Voitures/1/6photo5.webp" data-lightbox="mygallery6"></a>
                                                            <a href="database Voitures/1/6photo6.webp" data-lightbox="mygallery6"></a> 
                                                        </div>
                                                    </div>
                                                    <div class="text1">
                                                        <h3><?= $prodItems['name']; ?></h3>
                                                        <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                        <h3>PRIX: <?= $prodItems['price']; ?></h3>
                                                        <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                    </div>
                                                </div>     
                                                    <?php break;
                                            case 7:?>
                                                <div class="col-md-4">
                                                    <div class="border-p-2"> 
                                                        <div class="gallery">
                                                            <a href="database Voitures/1/7photo1.webp" data-lightbox="mygallery7">
                                                                <img class="zoomImg" src="database Voitures/1/7photo1.webp" width="100%">
                                                            </a>
                                                            <a href="database Voitures/1/7photo2.webp" data-lightbox="mygallery7"></a>
                                                            <a href="database Voitures/1/7photo3.webp" data-lightbox="mygallery7"></a>
                                                            <a href="database Voitures/1/7photo4.webp" data-lightbox="mygallery7"></a>
                                                            <a href="database Voitures/1/7photo5.webp" data-lightbox="mygallery7"></a>
                                                            <a href="database Voitures/1/7photo6.webp" data-lightbox="mygallery7"></a> 
                                                        </div>
                                                    </div>
                                                    <div class="text1">
                                                        <h3><?= $prodItems['name']; ?></h3>
                                                        <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                        <h3>PRIX: <?= $prodItems['price']; ?></h3>
                                                        <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                    </div>
                                                </div>     
                                                    <?php break;
                                            case 8:?>
                                                <div class="col-md-4">
                                                    <div class="border-p-2"> 
                                                        <div class="gallery">
                                                            <a href="database Voitures/1/8photo1.webp" data-lightbox="mygallery8">
                                                                <img class="zoomImg" src="database Voitures/1/8photo1.webp" width="100%">
                                                            </a>
                                                            <a href="database Voitures/1/8photo2.webp" data-lightbox="mygallery8"></a>
                                                            <a href="database Voitures/1/8photo3.webp" data-lightbox="mygallery8"></a>
                                                            <a href="database Voitures/1/8photo4.webp" data-lightbox="mygallery8"></a>
                                                            <a href="database Voitures/1/8photo5.webp" data-lightbox="mygallery8"></a>
                                                            <a href="database Voitures/1/8photo6.webp" data-lightbox="mygallery8"></a> 
                                                        </div>
                                                    </div>
                                                    <div class="text1">
                                                        <h3><?= $prodItems['name']; ?></h3>
                                                        <h3>BOITE DE VITESSE: <?= $prodItems['fonction']; ?> </h3>
                                                        <h3>PRIX: <?= $prodItems['price']; ?></h3>
                                                        <h3 class="phone"><img  src="images/phone.png" width="3%"> <?= $prodItems['tel']; ?></h3>
                                                    </div>
                                                </div>     
                                                <?php break;                                                        
                                        }    
                                    endforeach;
                                }
                            }
                        ?>
                    </form>
                    
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
    </body>
</html>