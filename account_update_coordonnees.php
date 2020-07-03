<?php

session_start();
    
// Include config file
require_once "config.php";

if(isset($_POST['submit'])){
    // Get hidden input value
    $id = $_SESSION["id"];
        
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $codepostal = $_POST['codepostal'];
    $pays = $_POST['pays'];

    $coordonnees = array( 

        "Nom" => $nom,
        "Prenom" => $prenom,
        "Adresse" => $adresse,
        "Ville" => $ville,
        "Code Postal" => $codepostal,
        "Pays" => $pays

    );

    $jsonformat = json_encode($coordonnees);

    $sql = "UPDATE users SET coordonnees=:coordonnees WHERE id=:id";
 
    if($stmt = $pdo->prepare($sql)){

        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":coordonnees", $param_coordonnees, PDO::PARAM_STR);
        $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);

        // Set parameters
        $param_coordonnees = $jsonformat;
        $param_id = $id;

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records updated successfully. Redirect to landing page
            header("location: account.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
}
else {


    // Get session id
    $id = ($_SESSION["id"]);
            
        // Prepare a select statement
        $sql = "SELECT (coordonnees) FROM users WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){

                    /* Fetch result row as an associative array. */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $coordonnees = $row["coordonnees"];

                    // Decode the JSON
                    $obj = json_decode($coordonnees);

                } else{
                    // URL doesn't contain valid id. Redirect to error page
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



}
?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>
<main>
<div id="toto6">

    <h2>Update Mensurations</h2>

    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

        <input type="text" name="nom" class="form-control" placeholder="Nom" value="<?php if(isset($coordonnees) && !empty($coordonnees)){echo $obj->{'Nom'};} ?>">
        <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="<?php if(isset($coordonnees) && !empty($coordonnees)){echo $obj->{'Prenom'};} ?>">
        <input type="text" name="adresse" class="form-control" placeholder="Adresse" value="<?php if(isset($coordonnees) && !empty($coordonnees)){echo $obj->{'Adresse'};} ?>">
        <input type="text" name="ville" class="form-control" placeholder="Ville" value="<?php if(isset($coordonnees) && !empty($coordonnees)){echo $obj->{'Ville'};} ?>">
        <input type="text" name="codepostal" class="form-control" placeholder="Code Postal" value="<?php if(isset($coordonnees) && !empty($coordonnees)){echo $obj->{'Code Postal'};} ?>">
        <input type="text" name="pays" class="form-control" placeholder="Pays" value="<?php if(isset($coordonnees) && !empty($coordonnees)){echo $obj->{'Pays'};} ?>">

        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        <a href="account.php" class="btn btn-default">Cancel</a>

    </form>

</div>
</main>

</body>
</html>