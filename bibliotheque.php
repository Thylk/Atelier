<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

<main>

    <h1>Mensurations</h1>
    <div id="toto6">

        <a id="btn_ajout" href="bibliotheque_create_mensurations.php" class="btn btn-success">Ajouter une personne</a>
        <a id="btn_ajout" href="admin.php" class="btn btn-info">Retour</a>
        <?php 
            // Include config file
            require_once "config.php";
            // Attempt select query execution
            $sql = "SELECT (mensurations) FROM users ORDER BY id ASC";
            if($result = $pdo->query($sql)){

                if($result->rowCount() > 0){

                    echo "<table id='table_mensurations' class='table table-bordered table-striped'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Nom</th>";
                                echo "<th>Prénom</th>";
                                echo "<th>Sexe</th>";
                                echo "<th>Action</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                    
                        while($row = $result->fetch()){

                            // Retrieve individual field value
                            $mensurations = $row["mensurations"];
                            // echo $mensurations;
                            
                            if(isset($mensurations) && !empty($mensurations)){
                                // Decode the JSON
                                $obj = json_decode($mensurations);

                                // Si pas d'email = mensurations créées par admin = delete
                                $stmt = $pdo->prepare('SELECT * FROM users WHERE id=:id');
                                $stmt->bindParam(":id", $obj->{'ID'}, PDO::PARAM_INT);
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                $email = $row["email"];

                                echo "<tr>";
                                echo "<td>" . $obj->{'Nom'} . "</td>";
                                echo "<td>" . $obj->{'Prenom'} . "</td>";
                                echo "<td>" . $obj->{'Sexe'} . "</td>";
                                    echo "<td>";
                                        echo "<a class='icone_see' href='bibliotheque_read_mensurations.php?id=". $obj->{'ID'} ."' title='View Record' data-toggle='tooltip'>".'<i class="fas fa-eye"></i>';
                                        echo "<a class='icone_modif' href='bibliotheque_update_mensurations.php?id=". $obj->{'ID'} ."' title='Update Record' data-toggle='tooltip'>".'<i class="fas fa-pencil-alt"></i>';
                                        if(empty($email)){
                                            echo "<a class='icone_delete' href='bibliotheque_delete_mensurations.php?id=". $obj->{'ID'} ."' title='Delete Record' data-toggle='tooltip'>".'<i class="fas fa-trash"></i>';
                                        }
                                        elseif(!empty($email)){
                                            echo "<a class='icone_delete' href='bibliotheque_delete_mensurations.php?id=". $obj->{'ID'} ."' title='Delete Record' data-toggle='tooltip'>".'<i class="fas fa-trash"></i>';
                                        }
                                        // echo "<a href='test_delete_mensurations.php?id=". $obj->{'ID'} ."' title='Update Record' data-toggle='tooltip'>".'<i class="fas fa-trash"></i>';
                                        
                                    echo "</td>";
                                echo "</tr>";
                            }
                                
                        }
                                echo "</tbody>";                            
                                echo "</table>";

                                // Free result set
                                unset($result);
                
                } else{

                    exit();
                }

            }

            // Close connection
            unset($pdo);
        ?>
  
    </div>

</main>

</body>

</html>