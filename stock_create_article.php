<?php

session_start();

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$img = $nom = $prix = $descri = $taille = "";
$img_err = $nom_err = $prix_err = $descri_err = $taille_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // IMAGE 1
    $img = $_FILES['img'];
    // print_r($file);
    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgSize = $_FILES['img']['size'];
    $imgError = $_FILES['img']['error'];
    $imgType = $_FILES['img']['type'];

    // IMAGE 2
    $imgTwo = $_FILES['imgTwo'];
    $imgTwoName = $_FILES['imgTwo']['name'];
    $imgTwoTmpName = $_FILES['imgTwo']['tmp_name'];
    $imgTwoSize = $_FILES['imgTwo']['size'];
    $imgTwoError = $_FILES['imgTwo']['error'];
    $imgTwoType = $_FILES['imgTwo']['type'];

    // IMAGE 3
    $imgThree = $_FILES['imgThree'];
    $imgThreeName = $_FILES['imgThree']['name'];
    $imgThreeTmpName = $_FILES['imgThree']['tmp_name'];
    $imgThreeSize = $_FILES['imgThree']['size'];
    $imgThreeError = $_FILES['imgThree']['error'];
    $imgThreeType = $_FILES['imgThree']['type'];

    $upload_dir = 'assets/img/img_articles/';
    $imgExt = strtolower(pathinfo($imgName,PATHINFO_EXTENSION));
    $imgTwoExt = strtolower(pathinfo($imgTwoName,PATHINFO_EXTENSION));
    $imgThreeExt = strtolower(pathinfo($imgThreeName,PATHINFO_EXTENSION));
    $valid_extensions = array('jpg', 'jpeg', 'png');
    $picProfile = rand(1000, 1000000).'.'.$imgExt;
    $picProfileTwo = rand(1000, 1000000).'.'.$imgTwoExt;
    $picProfileThree = rand(1000, 1000000).'.'.$imgThreeExt;
    move_uploaded_file($imgTmpName, $upload_dir.$picProfile);
    move_uploaded_file($imgTwoTmpName, $upload_dir.$picProfileTwo);
    move_uploaded_file($imgThreeTmpName, $upload_dir.$picProfileThree);

    // Validate name
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "Please enter a name for the article";
    } else{
        $nom = $input_nom;
    }

    // Validate price
    $input_prix = trim($_POST["prix"]);
    if(empty($input_prix)){
        $prix_err = "Please enter an price.";     
    } else{
        $prix = $input_prix;
    }
    
    // Validate description
    $input_descri = trim($_POST["descri"]);
    if(empty($input_descri)){
        $descri_err = "Please enter a description.";     
    } else{
        $descri = $input_descri;
    }
    
    // Validate taille
    $input_taille = trim($_POST["taille"]);
    if(empty($input_taille)){
        $taille_err = "Please enter a taille.";     
    } else{
        $taille = $input_taille;
    }
    
    // Check input errors before inserting in database
    if(empty($nom_err) && empty($prix_err) && empty($descri_err) && empty($taille_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO articles (img, imgTwo, imgThree, nom, prix, descri, taille) VALUES (:img, :imgTwo, :imgThree, :nom, :prix, :descri, :taille)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":img", $param_img);
            $stmt->bindParam(":imgTwo", $param_imgTwo);
            $stmt->bindParam(":imgThree", $param_imgThree);
            $stmt->bindParam(":nom", $param_nom);
            $stmt->bindParam(":prix", $param_prix);
            $stmt->bindParam(":descri", $param_descri);
            $stmt->bindParam(":taille", $param_taille);
            
            // Set parameters
            $param_img = $picProfile;
            $param_imgTwo = $picProfileTwo;
            $param_imgThree = $picProfileThree;
            $param_nom = $nom;
            $param_prix = $prix;
            $param_descri = $descri;
            $param_taille = $taille;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: stock.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 
 <!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>


    <div id="box_create_article">

        <h2>Nouvel article</h2>
        <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Images</label>
                <div>
                    <input type="file" name="img" value="<?php echo $img; ?>">
                </div>
                <div>
                    <input type="file" name="imgTwo" value="<?php echo $imgTwo; ?>">
                </div>
                <div>
                    <input type="file" name="imgThree" value="<?php echo $imgThree; ?>">
                </div>
            </div>
            <div class="form-group <?php echo (!empty($nom_err)) ? 'has-error' : ''; ?>">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>">
                <span class="help-block"><?php echo $nom_err;?></span>
            </div>
            <div class="form-group <?php echo (!empty($prix_err)) ? 'has-error' : ''; ?>">
                <label>Prix</label>
                <input name="prix" class="form-control"><?php echo $prix; ?>
                <span class="help-block"><?php echo $prix_err;?></span>
            </div>
            <div class="form-group <?php echo (!empty($descri_err)) ? 'has-error' : ''; ?>">
                <label>Description</label>
                <textarea type="text" name="descri" class="form-control" value="<?php echo $descri; ?>"></textarea>
                <span class="help-block"><?php echo $descri_err;?></span>
            </div>
            <div class="form-group <?php echo (!empty($taille_err)) ? 'has-error' : ''; ?>">
                <label>Taille</label>
                <select name="taille" value="<?php echo $taille; ?>">
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                    <option>Unique</option>
                </select>
                <span class="help-block"><?php echo $taille_err;?></span>
            </div>
            <input type="submit" class="btn btn-primary" value="Créer">
            <a href="stock.php" class="btn btn-default">Retour</a>
        </form>

    </div>

</body>

</html>