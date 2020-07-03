<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

    <h1>Stock</h1>
    <div id="toto6">


                <div class="row">
                    <div class="col-md-12">
                        <a id="btn_ajout" href="stock_create_article.php" class="btn btn-success">Ajouter un article</a>
                        <a id="btn_ajout" href="admin.php" class="btn btn-info">Retour</a>

                        <?php
                        // Include config file
                        require_once "config.php";
                        
                        // Attempt select query execution
                        $sql = "SELECT * FROM articles";
                        if($result = $pdo->query($sql)){
                            if($result->rowCount() > 0){
                                echo "<table id='table_articles' class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Prix</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Taille</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                    while($row = $result->fetch()){
                                        echo "<tr>";
                                        echo "<td>" . $row['nom'] . "</td>";
                                        echo "<td>" . $row['prix'] . "</td>";
                                        echo "<td>" . $row['descri'] . "</td>";
                                        echo "<td>" . $row['taille'] . "</td>";
                                        echo "<td>";
                                            echo "<a class='icone_see' href='stock_read_article.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'>".'<i class="fas fa-eye"></i>';
                                            echo "<a class='icone_modif' href='stock_update_article.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'>".'<i class="fas fa-pencil-alt"></i>';
                                            echo "<a class='icone_delete' href='stock_delete_article.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'>".'<i class="fas fa-trash"></i>';
                                        echo "</td>";
                                    echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                unset($result);
                            } else{
                                echo "<p class='lead'><em>No records were found.</em></p>";
                            }
                        } else{
                            echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                        }
                        
                        // Close connection
                        unset($pdo);
                        ?>
                    </div>
                </div>        



    </div>
</body>
</html>