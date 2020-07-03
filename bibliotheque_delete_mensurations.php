<?php

session_start();

// Include config file
require_once "config.php";

// IF USER IS ADMIN
if($_SESSION["id"] === "13"){

    // Si email = mensurations créées par user = pas de delete mais update to null
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id=:id');
    $stmt->bindParam(":id", $_POST['id'], PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $email = $row["email"];

    if(!empty($email)){

        // "email existe" donc mensurations créées par client, il faut update to NULL
        
        // Process delete operation after confirmation
        if(isset($_POST["id"]) && !empty($_POST["id"])){

            $mensurations = NULL;

            // Prepare an update statement
            $sql = "UPDATE users SET mensurations=:mensurations WHERE id=:id";
            
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":mensurations", $param_mensurations, PDO::PARAM_STR);
                $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
                
                // Set parameters
                $param_mensurations = $mensurations;
                $param_id = $_POST['id'];
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Records deleted successfully. Redirect to landing page
                    header("location: bibliotheque.php");
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

    }
    else{

        // echo 'email nexiste pas';

        if(isset($_POST["id"]) && !empty($_POST["id"])){

            // Prepare a delete statement
            $sql = "DELETE FROM users WHERE id = :id";
            
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id", $param_id);
                
                // Set parameters
                $param_id = $_POST['id'];
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Records deleted successfully. Redirect to landing page
                    header("location: bibliotheque.php");
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


    }

}
else{ // USER = CLIENT DU SITE

    // echo 'ok';

    // Process delete operation after confirmation
    if(isset($_POST["submit"])){

        $mensurations = NULL;

        // Prepare a delete statement
        $sql = "UPDATE users SET mensurations=:mensurations WHERE id=:id";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":mensurations", $param_mensurations, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
            
            // Set parameters
            $param_mensurations = $mensurations;
            $param_id = $_SESSION['id'];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records deleted successfully. Redirect to landing page
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

}

?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>
<main>
<?php include 'header.php';?>

    <h1>Effacer les mensurations</h1>
    <div id="box_delete">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                <h4>Êtes-vous sûr de vouloir supprimer ces mensurations?</h4>
                <div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Yes">
                    <a href="bibliotheque.php" class="btn">No</a>
                </div>
            </div>
        </form>
    </div>

</main>
</body>
</html>