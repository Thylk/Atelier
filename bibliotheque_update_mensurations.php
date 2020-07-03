<?php

session_start();
    
// Include config file
require_once "config.php";

if(isset($_POST['submit'])){

    // Get values from the form
    $id = $_POST["id"];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $longueurepaule = $_POST['longueurepaule'];
    $carrureavant = $_POST['carrureavant'];
    $carrurearriere = $_POST['carrurearriere'];
    $tourbras = $_POST['tourbras'];
    $touravantbras = $_POST['touravantbras'];
    $tourpoignet = $_POST['tourpoignet'];
    $tourtaille = $_POST['tourtaille'];
    $tourpoitrine = $_POST['tourpoitrine'];
    $tourhanches = $_POST['tourhanches'];
    $tourbassin = $_POST['tourbassin'];
    $hauteurmanches = $_POST['hauteurmanches'];
    $longueurtaille = $_POST['longueurtaille'];
    $hauteurtaille = $_POST['hauteurtaille'];
    $longueurentrejambes = $_POST['longueurentrejambes'];
    $tourdessouspoitrine = $_POST['tourdessouspoitrine'];
    $tourcou = $_POST['tourcou'];
    $tourtete = $_POST['tourtete'];
    $longueurrascou = $_POST['longueurrascou'];
    $tourcuisse = $_POST['tourcuisse'];
    $tourgenou = $_POST['tourgenou'];
    $tourcheville = $_POST['tourcheville'];

    // Create an array with key => variables
    $mensurations = array( 
        "ID" => $id,
        "Nom" => $nom,
        "Prenom" => $prenom,
        "Sexe" => $sexe,
        "Longueur epaule" => $longueurepaule,
        "Carrure avant" => $carrureavant,
        "Carrure arriere" => $carrurearriere,
        "Tour de bras" => $tourbras,
        "Tour avant bras" => $touravantbras,
        "Tour de poignet" => $tourpoignet,
        "Tour de taille" => $tourtaille,
        "Tour de poitrine" => $tourpoitrine,
        "Tour de hanches" => $tourhanches,
        "Tour de bassin" => $tourbassin,
        "Hauteur manches" => $hauteurmanches,
        "Longueur taille" => $longueurtaille,
        "Hauteur taille" => $hauteurtaille,
        "Longueur entre jambes" => $longueurentrejambes,
        "Tour dessous poitrine" => $tourdessouspoitrine,
        "Tour du cou" => $tourcou,
        "Tour de tête" => $tourtete,
        "Longueur ras du cou" => $longueurrascou,
        "Tour de cuisse" => $tourcuisse,
        "Tour de genou" => $tourgenou,
        "Tour de cheville" => $tourcheville  
    );

    // Transorm the array into a JSON
    $jsonformat = json_encode($mensurations);

    $sql = "UPDATE users SET mensurations=:mensurations WHERE id=:id";
 
    if($stmt = $pdo->prepare($sql)){

        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":mensurations", $param_mensurations, PDO::PARAM_STR);
        $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);

        // Set parameters
        $param_mensurations = $jsonformat;
        $param_id = $id;

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records updated successfully. Redirect to landing page
            header("location: bibliotheque.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
}
else {

    // Si id a été postée = Admin 

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
    else{

        // Si id n'a pas été postée = client site
        $id =  $_SESSION["id"];
                
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


}

?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>
<main>
    
<h1>Modifier les mensurations</h1>

<div id="box_update_mensurations">

    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

        <div class="form_box">
            <p>Nom :</p>
            <input type="text" name="nom" class="form-control form_control_update" placeholder="Nom" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Nom'};} ?>">
        </div>
        <div class="form_box">
            <p>Prénom :</p>
            <input type="text" name="prenom" class="form-control form_control_update" placeholder="Prénom" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Prenom'};} ?>">
        </div>
        <div class="form_box">
            <p>Sexe :</p>
            <input type="text" name="sexe" class="form-control form_control_update" placeholder="Sexe" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Sexe'};} ?>">
        </div>
        <div class="form_box">
            <p>Longueur d'épaule :</p>
            <input type="text" name="longueurepaule" class="form-control form_control_update" placeholder="Longueur d'épaule" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Longueur epaule'};} ?>">
        </div>
        <div class="form_box">
            <p>Carrure avant :</p>
            <input type="text" name="carrureavant" class="form-control form_control_update" placeholder="Carrure avant" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Carrure avant'};} ?>">
        </div>
        <div class="form_box">
            <p>Carrure arrière :</p>
            <input type="text" name="carrurearriere" class="form-control form_control_update" placeholder="Carrure arrière" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Carrure arriere'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de bras :</p>
            <input type="text" name="tourbras" class="form-control form_control_update" placeholder="Tour de bras (biceps)" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour de bras'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour d'avant-bras :</p>
            <input type="text" name="touravantbras" class="form-control form_control_update" placeholder="Tour d'avant-bras" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour avant bras'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de poignet :</p>
            <input type="text" name="tourpoignet" class="form-control form_control_update" placeholder="Tour de poignet" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour de poignet'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de taille :</p>
            <input type="text" name="tourtaille" class="form-control form_control_update" placeholder="tour de taille" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour de taille'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de poitrine :</p>
            <input type="text" name="tourpoitrine" class="form-control form_control_update" placeholder="Tour de poitrine" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour de poitrine'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de hanches :</p>
            <input type="text" name="tourhanches" class="form-control form_control_update" placeholder="Tour de hanches" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour de hanches'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de bassin :</p>
            <input type="text" name="tourbassin" class="form-control form_control_update" placeholder="Tour de bassin" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour de bassin'};} ?>">
        </div>
        <div class="form_box">
            <p>Hauteur manches :</p>
            <input type="text" name="hauteurmanches" class="form-control form_control_update" placeholder="Hauteur manches" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Hauteur manches'};} ?>">
        </div>
        <div class="form_box">
            <p>Longueur taille :</p>
            <input type="text" name="longueurtaille" class="form-control form_control_update" placeholder="Longueur taille" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Longueur taille'};} ?>">
        </div>
        
        <div class="form_box">
            <p>Hauteur taille :</p>
            <input type="text" name="hauteurtaille" class="form-control form_control_update" placeholder="Hauteur taille" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Hauteur taille'};} ?>">
        </div>
        <div class="form_box">
            <p>Longueur d'entre jambes :</p>
            <input type="text" name="longueurentrejambes" class="form-control form_control_update" placeholder="Longueur d'entre jambes" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Longueur entre jambes'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour dessous de poitirne :</p>
            <input type="text" name="tourdessouspoitrine" class="form-control form_control_update" placeholder="Tour dessous de poitrine" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour dessous poitrine'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de cou :</p>
            <input type="text" name="tourcou" class="form-control form_control_update" placeholder="Tour de cou" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour du cou'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de tête :</p>
            <input type="text" name="tourtete" class="form-control form_control_update" placeholder="Tour de tête" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour de tête'};} ?>">
        </div>
        <div class="form_box">
            <p>Longueur ras du cou :</p>
            <input type="text" name="longueurrascou" class="form-control form_control_update" placeholder="Longueur ras du cou" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Longueur ras du cou'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de cuisse :</p>
            <input type="text" name="tourcuisse" class="form-control form_control_update" placeholder="Tour de cuisse" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour de cuisse'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de genou :</p>
            <input type="text" name="tourgenou" class="form-control form_control_update" placeholder="Tour de genou" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour de genou'};} ?>">
        </div>
        <div class="form_box">
            <p>Tour de cheville :</p>
            <input type="text" name="tourcheville" class="form-control form_control_update" placeholder="Tour de cheville" value="<?php if(isset($mensurations) && !empty($mensurations)){echo $obj->{'Tour de cheville'};} ?>">
        </div>

        <input type="submit" name="submit" class="btn btn-primary btn_margin" value="Modifier">
        <a href="<?php if($_SESSION["id"] === "13"){echo "bibliotheque.php";}else{echo "account.php";}?>" class="btn btn-default btn_margin">Retour</a>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>

    </form>

</div>
</main>

</body>
</html>