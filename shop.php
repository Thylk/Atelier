<?php
    session_start();
    $product_ids = array();
    // session_destroy();

    // Check if Add to cart has been submitted
    if(filter_input(INPUT_POST, 'add_to_cart')){
        
        if(isset($_SESSION['shopping_cart'])){

            // Keep track of how many prodcuts are in the shopping cart
            $count = count($_SESSION['shopping_cart']);

            // Create array to match product ids
            $product_ids = array_column($_SESSION['shopping_cart'], 'id');

            // pre_r($product_ids);
            if(!in_array(filter_input(INPUT_POST, 'id'), $product_ids)){
            $_SESSION['shopping_cart'][$count] = array
                (
                    'id' => filter_input(INPUT_POST, 'id'),
                    'nom' => filter_input(INPUT_POST, 'nom'),
                    'prix' => filter_input(INPUT_POST, 'prix'),
                    'taille' => filter_input(INPUT_POST, 'taille'),
                    'quantity' => filter_input(INPUT_POST, 'quantity')
                );
            }
            else{
                for ($i = 0; $i < count($product_ids); $i++){
                    if ($product_ids[$i] == filter_input(INPUT_POST, 'id')){
                        //Add item quantity to existing product in shopping cart
                        $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                    }
                }
            }

        }
        else{ // If shopping cart dosen't exist, create first product with array key 0
            // create array using sumbitted form data, start from key 0 and fill it with values
            $_SESSION['shopping_cart'][0] = array
            (
                'id' => filter_input(INPUT_POST, 'id'),
                'nom' => filter_input(INPUT_POST, 'nom'),
                'taille' => filter_input(INPUT_POST, 'taille'),
                'quantity' => filter_input(INPUT_POST, 'quantity'),
                'prix' => filter_input(INPUT_POST, 'prix')
            );
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

<main>

<h1>Boutique</h1>

<div id="filterbox">

        <div id="modeles">

            <h4>Modèles</h4>
            <?php
                require_once "config.php";
                $query = "SELECT DISTINCT (nom) FROM articles ORDER BY id ASC";
                $statement = $pdo->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                foreach($result as $row) 
                {
                ?>

                <div class="checkbox testyty">
                    <label><input type="checkbox" class="common_selector nom" value="<?php echo $row['nom']; ?>" > <?php echo $row['nom']; ?></label>
                </div>

            <?php
            }    
            ?>
            
        </div>

        <div id="tailles">

            <h4>Tailles</h4>
            <?php
                require_once "config.php";
                $query = "SELECT DISTINCT (taille) FROM articles ORDER BY id ASC";
                $statement = $pdo->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                foreach($result as $row) 
                {
                ?>

                <div class="checkbox testyty">
                    <label><input type="checkbox" class="common_selector taille" value="<?php echo $row['taille']; ?>" > <?php echo $row['taille']; ?></label>
                </div>

            <?php
            }    
            ?>

        </div>
    
</div>

<div class="container">
        <div id="boxshop" class="row filter-data">

        </div>
</div>

</main>

</body>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data(){
        // $('.filter-data').html; // Can add loader here
        var action = 'fetch-data';
        var nom = get_filter('nom');
        var taille = get_filter('taille');
        $.ajax({
            url:"shop_fetch_data.php",
            method:"POST",
            data:{action:action, nom:nom, taille:taille},
            success:function(data){
                $('.filter-data').html(data); // Output send into the div here
            }
        });
    }

    function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        })
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

})
</script>

</html>