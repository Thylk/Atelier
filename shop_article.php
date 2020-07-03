<?php


session_start();
$product_ids = array();
// session_destroy();

// Check if Add to cart has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
    
    if(isset($_SESSION['shopping_cart'])){

        // Keep track of how many prodcuts are in the shopping cart
        $count = count($_SESSION['shopping_cart']);

        // Create array to match product ids
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');

        // pre_r($product_ids);
        if(!in_array(filter_input(INPUT_POST, 'id'), $product_ids)){
        $_SESSION['shopping_cart'][$count] = array
            (
                'id' => filter_input(INPUT_POST, 'id'),
                'nom' => filter_input(INPUT_POST, 'nom'),
                'prix' => filter_input(INPUT_POST, 'prix'),
                'taille' => filter_input(INPUT_POST, 'taille'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );
        }
        else{
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_POST, 'id')){
                    //Add item quantity to existing product in shopping cart
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }

    }
    else{ // If shopping cart dosen't exist, create first product with array key 0
        // create array using sumbitted form data, start from key 0 and fill it with values
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_POST, 'id'),
            'nom' => filter_input(INPUT_POST, 'nom'),
            'taille' => filter_input(INPUT_POST, 'taille'),
            'quantity' => filter_input(INPUT_POST, 'quantity'),
            'prix' => filter_input(INPUT_POST, 'prix')
        );
    }
}

// // See what's inside the array
// print_r($_SESSION);
// function pre_r($array){
//     echo '<pre>';
//     print_r($array);
//     echo '<pre>';
// }




    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Include config file
        require_once "config.php";
        
        // Prepare a select statement
        $sql = "SELECT * FROM articles WHERE id = :id";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = trim($_GET["id"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Retrieve individual field value
                    $id = $row["id"];
                    $img = $row["img"];
                    $nom = $row["nom"];
                    $prix = $row["prix"];
                    $descri = $row["descri"];
                    $taille = $row["taille"];

                } else{
                    // URL doesn't contain valid id parameter. Redirect to error page
                    // header("location: error.php");
                    // exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    } else{
        // URL doesn't contain id parameter. Redirect to error page
        // header("location: error.php");
        // exit();
    }



?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

<main>
    <div id="articlebox">
        <h2 id="article_title"><?php echo $row["nom"]; ?></h2>
        <div id="img_article_solo">
            
            <div id="slideshow" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slideshow" data-slide-to="0" class="active"></li>
                    <li data-target="#slideshow" data-slide-to="1"></li>
                    <li data-target="#slideshow" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="assets/img/img_articles/<?php echo $row['img']; ?>" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="assets/img/img_articles/<?php echo $row['imgTwo']; ?>" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="assets/img/img_articles/<?php echo $row['imgThree']; ?>" alt="Third slide">
                    </div>
                </div>
            </div>

        </div>
        <div class="info_article">
            <p class="form-control-static"><?php echo $row["descri"]; ?></p>
        </div>
        <div class="info_article">
            <p class="form-control-static">Taille: <?php echo $row["taille"]; ?></p>
        </div>
        <div class="info_article">
            <p class="form-control-static">Prix: <?php echo $row["prix"]; ?></p>
        </div>
        <form method="post" action="#">
            <input id="testoit" class="qty_article" type="text" name="quantity" value="1" />
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
            <input type="hidden" name="nom" value="<?php echo $row['nom']; ?>" /> 
            <input type="hidden" name="prix" value="<?php echo $row['prix']; ?>" />
            <input type="hidden" name="taille" value="<?php echo $row['taille']; ?>" />
            <div>
                <input type="submit" id="add_to_cart" name="add_to_cart" class="btn btn-info" value="Ajouter au panier" />
            </div>
        </form>
        <a href="shop.php" class="btn btn-primary">Retour</a>
    </div>
</main>
</body>
</html>