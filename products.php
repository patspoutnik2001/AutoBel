<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home page</title>
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
        
        <div class="container1">
            <!-- Brands List -->
            <div class="card-filter">
                <form action="" method="GET" >
                    <div>
                        <h3>Filter</h3>
                   </div>
                    <div>
                        <button type="submit" class="btnSubmit">Search</button>
                    </div>
                    <div class="card-body">
                        <hr>
                        <?php
                            $con = mysqli_connect("localhost", "root", "", "projetweb");

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

                        ?>
                    </div>
                </form>
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
                                                        <div class="col-2">
                                                            <img src="database voitures/1/1photo1.webp" width="100%" id="ProductImg1">
                                                            <div class="small-img-row">
                                                                <div class="small-img-col">
                                                                    <img src="database voitures/1/1photo1.webp" width="100%" class="SmallImg1">
                                                                </div>
                                                                <div class="small-img-col">
                                                                    <img src="database voitures/1/1photo2.webp" width="100%" class="SmallImg1">
                                                                </div>
                                                                <div class="small-img-col">
                                                                    <img src="database voitures/1/1photo3.webp" width="100%" class="SmallImg1">
                                                                </div>
                                                                <div class="small-img-col">
                                                                    <img src="database voitures/1/1photo4.webp" width="100%" class="SmallImg1">
                                                                </div>
                                                                <div class="small-img-col">
                                                                    <img src="database voitures/1/1photo5.webp" width="100%" class="SmallImg1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text1">
                                                        <h3><?= $prodItems['name']; ?></h3>
                                                        <h3>FONCTION: <?= $prodItems['fonction']; ?> </h3>
                                                        <h3>PRICE: <?= $prodItems['price']; ?></h3>
                                                    </div>
                                                    <div class="btnChoseCar">
                                                        <input type="submit" name="btnChoseCar1" value="More Details">
                                                    </div>
                                                </div>     
                                                    <?php break;
                                                case 2:?>
                                                    <div class="col-md-4">
                                                        <div class="border-p-2"> 
                                                            <div class="col-2">
                                                                <img src="database voitures/1/2photo1.webp" width="100%" id="ProductImg2">
                                                                <div class="small-img-row">
                                                                    <div class="small-img-col">
                                                                        <img src="database voitures/1/2photo1.webp" width="100%" class="SmallImg2">
                                                                    </div>
                                                                    <div class="small-img-col">
                                                                        <img src="database voitures/1/2photo2.webp" width="100%" class="SmallImg2">
                                                                    </div>
                                                                    <div class="small-img-col">
                                                                        <img src="database voitures/1/2photo3.webp" width="100%" class="SmallImg2">
                                                                    </div>
                                                                    <div class="small-img-col">
                                                                        <img src="database voitures/1/2photo4.webp" width="100%" class="SmallImg2">
                                                                    </div>
                                                                    <div class="small-img-col">
                                                                        <img src="database voitures/1/2photo5.webp" width="100%" class="SmallImg2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text1">
                                                            <h3><?= $prodItems['name']; ?></h3>
                                                            <h3>FONCTION: <?= $prodItems['fonction']; ?> </h3>
                                                            <h3>PRICE: <?= $prodItems['price']; ?></h3>
                                                        </div>
                                                        <div class="btnChoseCar">
                                                        <input type="submit" name="btnChoseCar2" value="More Details"/>
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
                                        ?>
                                            <div class="col-md-4">
                                                <div class="border-p-2">
                                                    <a class="text" href="products.php" ><?= $prodItems['name']; ?></a>
                                                </div>
                                            </div>
                                        <?php
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

        <!-- Image-products -->
        <script>
            var ProductImg1 = document.getElementById("ProductImg1");
            var SmallImg1 = document.getElementsByClassName("SmallImg1");
            var ProductImg2 = document.getElementById("ProductImg2");
            var SmallImg2 = document.getElementsByClassName("SmallImg2");

            // 1st photo
            SmallImg1[0].onclick = function()
            {
                ProductImg1.src = SmallImg1[0].src;
            }
            SmallImg1[1].onclick = function()
            {
                ProductImg1.src = SmallImg1[1].src;
            }
            SmallImg1[2].onclick = function()
            {
                ProductImg1.src = SmallImg1[2].src;
            }
            SmallImg1[3].onclick = function()
            {
                ProductImg1.src = SmallImg1[3].src;
            }
            SmallImg1[4].onclick = function()
            {
                ProductImg1.src = SmallImg1[4].src;
            }

            // 2nd photo
            SmallImg2[0].onclick = function()
            {
                ProductImg2.src = SmallImg2[0].src;
            }
            SmallImg2[1].onclick = function()
            {
                ProductImg2.src = SmallImg2[1].src;
            }
            SmallImg2[2].onclick = function()
            {
                ProductImg2.src = SmallImg2[2].src;
            }
            SmallImg2[3].onclick = function()
            {
                ProductImg2.src = SmallImg2[3].src;
            }
            SmallImg2[4].onclick = function()
            {
                ProductImg2.src = SmallImg2[4].src;
            }
            
        </script>
    </body>
</html>