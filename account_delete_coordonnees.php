<?php

session_start();

// Include config file
require_once "config.php";

// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){

    // On remplace la valeur par NULL car on ne peut pas supprimer la colomne "coordonnees"
    $coordonnees = NULL;

    // Prepare a delete statement
    $sql = "UPDATE users SET coordonnees=:coordonnees WHERE id=:id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":coordonnees", $param_coordonnees, PDO::PARAM_STR);
        $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
        
        // Set parameters
        $param_coordonnees = $coordonnees;
        $param_id = $_SESSION['id'];
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to account
            header("location: account.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);

} 

?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>
<main>
<?php include 'header.php';?>

    <h1>Effacer mes coordonnées</h1>
    <div id="toto6">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                <h4>Êtes-vous sûr de vouloir supprimer vos informations?</h4>
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