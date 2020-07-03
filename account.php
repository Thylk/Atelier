<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: account_login.php");
    exit;
}

// Check if the user is the admin
if($_SESSION["id"] === "13"){
    header("location: admin.php");
    exit;
}

if(isset($_SESSION["id"]) && !empty(trim($_SESSION["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM users WHERE id = :id";
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = $_SESSION['id'];
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
                // Retrieve individual field value
                $id = $row['id'];

                $coordonnees = $row["coordonnees"];
                $mensurations = $row["mensurations"];

                // Decode the JSON
                $obj = json_decode($mensurations);
                $coord = json_decode($coordonnees);

                // echo $obj->{'Longueur epaule'};

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
    
    <h1>Mon compte</h1>
    <div id="toto6">

        <h1>Bienvenue, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b>.</h1>

        <div id="info_client">
            <h3>Mes informations</h3>
            <ul class="list">
                <li><span>Nom: </span><?php if(isset($coordonnees) && !empty($coordonnees)){ echo $coord->{'Nom'};} ?></li>
                <li><span>Prénom: </span><?php if(isset($coordonnees) && !empty($coordonnees)){ echo $coord->{'Prenom'};} ?></li>
                <li><span>Adresse: </span><?php if(isset($coordonnees) && !empty($coordonnees)){ echo $coord->{'Adresse'};} ?></li>
                <li><span>Ville: </span><?php if(isset($coordonnees) && !empty($coordonnees)){ echo $coord->{'Ville'};} ?></li>
                <li><span>Code Postal: </span><?php if(isset($coordonnees) && !empty($coordonnees)){ echo $coord->{'Code Postal'};} ?></li>
                <li><span>Pays: </span><?php if(isset($coordonnees) && !empty($coordonnees)){ echo $coord->{'Pays'};} ?></li>
            </ul>
            <a id="modif_info" class="btn" href="account_update_coordonnees.php?"><?php if(isset($coordonnees)){echo "Modifier mes informations";}else{echo "Renseigner mes informations";}?></a>
            
            <?php if
                (isset($coordonnees)){
                    echo '<a id="modif_info" class="btn" href="account_delete_coordonnees.php">Supprimer mes informations</a>';
                }else{
                    // echo "Renseigner mes mensurations";
                }
            ?>

        </div>

        <div id="info_client">
            <h3>Mes mensurations</h3>
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

            <form action="modif_mensurations_client.php" method="post">
                <a id="modif_info" class="btn" href="bibliotheque_update_mensurations.php"><?php if(isset($mensurations)){echo "Modifier mes mensurations";}else{echo "Renseigner mes mensurations";}?></a>
            </form>

            <?php 
                if(isset($mensurations)){
                    echo '<a id="modif_info" class="btn" href="bibliotheque_delete_mensurations.php">Supprimer mes mensurations</a>';
                }
            ?>
            
        </div>

        <div>
            <a href="account_delete.php" class="btn btn-danger">Supprimer le compte</a>
            <a href="account_update_password.php" class="btn btn-warning">Modifier le mot de passe</a>
            <a href="account_logout.php" class="btn btn-danger">Deconnexion</a>
        </div>

    </div>

</main>
</body>
</html>