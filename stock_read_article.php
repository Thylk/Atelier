<?php

	session_start();

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
                $nom = $row["nom"];
                $prix = $row["prix"];
                $descri = $row["descri"];
                $taille = $row["taille"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
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
    header("location: error.php");
    exit();
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
        <a href="stock.php" class="btn btn-primary">Retour</a>
    </div>

</main>
</body>
</html>