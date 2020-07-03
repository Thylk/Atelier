<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $pass = $confirm_pass = "";
$email_err = $pass_err = $confirm_pass_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["pass"]))){
        $pass_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["pass"])) < 6){
        $pass_err = "Password must have atleast 6 characters.";
    } else{
        $pass = trim($_POST["pass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_pass"]))){
        $confirm_pass_err = "Please confirm password.";     
    } else{
        $confirm_pass = trim($_POST["confirm_pass"]);
        if(empty($pass_err) && ($pass != $confirm_pass)){
            $confirm_pass_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($pass_err) && empty($confirm_pass_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (email, pass) VALUES (:email, :pass)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":pass", $param_pass, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = $email;
            $param_pass = password_hash($pass, PASSWORD_BCRYPT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: account_login.php");
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

<main>
    <h1>Création de compte</h1>
    <div id="box_register">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($pass_err)) ? 'has-error' : ''; ?>">
                <label>Mot de passe</label>
                <input type="password" name="pass" class="form-control" value="<?php echo $pass; ?>">
                <span class="help-block"><?php echo $pass_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_pass_err)) ? 'has-error' : ''; ?>">
                <label>Confirmez votre Mot de passe</label>
                <input type="password" name="confirm_pass" class="form-control" value="<?php echo $confirm_pass; ?>">
                <span class="help-block"><?php echo $confirm_pass_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Créer mon compte">
            </div>
            <p>Vous avez déjà un compte? <a href="account_login.php">Connectez-vous ici.</a></p>
        </form>
    </div>
</main>

</body>
</html>