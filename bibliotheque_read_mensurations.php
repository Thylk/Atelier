<?php

session_start();
    
// Include config file
require_once "config.php";

    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Get URL parameter
    $id =  trim($_GET["id"]);
            
        // Prepare a select statement
        $sql = "SELECT (mensurations) FROM users WHERE id = :id";
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
                    $mensurations = $row["mensurations"];

                    // Decode the JSON
                    $obj = json_decode($mensurations);

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
    <h1>Mensurations client</h1>
<div id="box_read_mensurations">
    
    <h3><?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Prenom'};} ?> <?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Nom'};} ?>, <?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Sexe'};} ?></h3>
    <ul class="list">
        <li><span>Longueur d'épaule: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Longueur epaule'};} ?></li>
        <li><span>Carrure avant: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Carrure avant'};} ?></li>
        <li><span>Carrure arrière: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Carrure arriere'};} ?></li>
        <li><span>Tour de bras (biceps): </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour de bras'};} ?></li>
        <li><span>Tour d'avant-bras: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour avant bras'};} ?></li>
        <li><span>Tour de poignet: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour de poignet'};} ?></li>
        <li><span>tour de taille: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour de taille'};} ?></li>
        <li><span>Tour de poitrine: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour de poitrine'};} ?></li>
        <li><span>Tour de hanches: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour de hanches'};} ?></li>
        <li><span>Tour de bassin: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour de bassin'};} ?></li>
        <li><span>Hauteur manches: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Hauteur manches'};} ?></li>
        <li><span>Longueur taille: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Longueur taille'};} ?></li>
        <li><span>Hauteur taille: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Hauteur taille'};} ?></li>
        <li><span>Longueur d'entre jambes: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Longueur entre jambes'};} ?></li>
        <li><span>Tour dessous de poitrine: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour dessous poitrine'};} ?></li>
        <li><span>Tour de cou: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour du cou'};} ?></li>
        <li><span>Tour de tête: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour de tête'};} ?></li>
        <li><span>Longueur ras du cou: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Longueur ras du cou'};} ?></li>
        <li><span>Tour de cuisse: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour de cuisse'};} ?></li>
        <li><span>Tour de genou: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour de genou'};} ?></li>
        <li><span>Tour de cheville: </span><?php if(isset($mensurations) && !empty($mensurations)){ echo $obj->{'Tour de cheville'};} ?></li>
    </ul>
    <a href="bibliotheque.php" class="btn btn-info btn_margin">Retour</a>
</div>
</main>

</body>
</html>