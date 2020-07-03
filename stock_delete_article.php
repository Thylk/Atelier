<?php

session_start();

// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config.php";

    // TEST 
    // Get URL parameter
    $id =  trim($_POST["id"]);
        
    // Prepare a select statement
    $sql = "SELECT * FROM articles WHERE id = :id";
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = $id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
                // Retrieve individual field value
                $imgFile = $row['img'];
                $imgFileTwo = $row['imgTwo'];
                $imgFileThree = $row['imgThree'];

                unlink("assets/img/img_articles/$imgFile");
                unlink("assets/img/img_articles/$imgFileTwo");
                unlink("assets/img/img_articles/$imgFileThree");

            } else{
                // URL doesn't contain valid id. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // FIN TEST

    // Prepare a delete statement
    $sql = "DELETE FROM articles WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){

            // Unlink the image here
            // unlink();

            // Records deleted successfully. Redirect to landing page
            header("location: stock.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>
<main>
<?php include 'header.php';?>

    <h1>Effacer l'article</h1>
    <div id="box_delete">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                <h4>Êtes-vous sûr de vouloir supprimer cet article?</h4>
                <div>
                    <input type="submit" class="btn btn-primary" value="Yes">
                    <a href="stock.php" class="btn">No</a>
                </div>
            </div>
        </form>
    </div>

</main>
</body>
</html>