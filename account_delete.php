<?php

// Initialize the session
session_start();

// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config.php";
    
        // Prepare a delete statement
        $sql = "DELETE FROM users WHERE id=:id";

        if($stmt = $pdo->prepare($sql)){
            // Set parameters
            $param_id = trim($_SESSION["id"]);

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                session_destroy();
                header("location: register.php");
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
    if(empty(trim($_SESSION["id"]))){
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

    <h1>Supprimer mon compte</h1>
    <div id="toto6">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <input type="hidden" name="id" value="<?php echo trim($_SESSION["id"]); ?>"/>
                <h4>Êtes-vous sûr de vouloir supprimer votre compte?</h4>
                <div>
                    <input type="submit" class="btn btn-primary" value="Yes">
                    <a href="account.php" class="btn">No</a>
                </div>
            </div>
        </form>
    </div>

</main>
</body>
</html>