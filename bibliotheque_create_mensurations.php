<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";


if(isset($_POST['submit'])){

    $id = $last_id;

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

    $jsonformat = json_encode($mensurations); // json_decode pour read
    // var_dump($jsonformat);

    $sql = "INSERT INTO users (mensurations) VALUES (:mensurations)";
 
    if($stmt = $pdo->prepare($sql)){

        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":mensurations", $param_mensurations, PDO::PARAM_STR);

        // Set parameters
        $param_mensurations = $jsonformat;

        // Attempt to execute the prepared statement
        if($stmt->execute()){

            $last_id = $pdo->lastInsertId();
            // echo $last_id;

// --------------------- //
            $id = $last_id;

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

// ---------------------- //

            // Records updated successfully. Redirect to landing page
            // header("location: bibliotheque_client.php");
            // exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
     
    // // Close statement
    // unset($stmt);
}
 

?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

<div id="box_create_mensurations">

    <h2>Nouvelles mensurations</h2>
    <form class="form-group" method="post" action="bibliotheque_create_mensurations.php">
        <input type="text" name="nom" class="form-control" placeholder="Nom" value="">
        <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="">
        <input type="text" name="sexe" class="form-control" placeholder="Sexe" value="">
        <input type="text" name="longueurepaule" class="form-control" placeholder="Longueur d'épaule" value="">
        <input type="text" name="carrureavant" class="form-control" placeholder="Carrure avant" value="">
        <input type="text" name="carrurearriere" class="form-control" placeholder="Carrure arrière" value="">
        <input type="text" name="tourbras" class="form-control" placeholder="Tour de bras (biceps)" value="">
        <input type="text" name="touravantbras" class="form-control" placeholder="Tour d'avant-bras" value="">
        <input type="text" name="tourpoignet" class="form-control" placeholder="Tour de poignet" value="">
        <input type="text" name="tourtaille" class="form-control" placeholder="tour de taille" value="">
        <input type="text" name="tourpoitrine" class="form-control" placeholder="Tour de poitrine" value="">
        <input type="text" name="tourhanches" class="form-control" placeholder="Tour de hanches" value="">
        <input type="text" name="tourbassin" class="form-control" placeholder="Tour de bassin" value="">
        <input type="text" name="hauteurmanches" class="form-control" placeholder="Hauteur manches" value="">
        <input type="text" name="longueurtaille" class="form-control" placeholder="Longueur taille" value="">
        <input type="text" name="hauteurtaille" class="form-control" placeholder="Hauteur taille" value="">
        <input type="text" name="longueurentrejambes" class="form-control" placeholder="Longueur d'entre jambes" value="">
        <input type="text" name="tourdessouspoitrine" class="form-control" placeholder="Tour dessous de poitrine" value="">
        <input type="text" name="tourcou" class="form-control" placeholder="Tour de cou" value="">
        <input type="text" name="tourtete" class="form-control" placeholder="Tour de tête" value="">
        <input type="text" name="longueurrascou" class="form-control" placeholder="Longueur ras du cou" value="">
        <input type="text" name="tourcuisse" class="form-control" placeholder="Tour de cuisse" value="">
        <input type="text" name="tourgenou" class="form-control" placeholder="Tour de genou" value="">
        <input type="text" name="tourcheville" class="form-control" placeholder="Tour de cheville" value="">
        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        <a href="bibliotheque.php" class="btn btn-default">Cancel</a>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    </form>
    

</div>
</main>

</body>

</html>