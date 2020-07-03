<?php

session_start();

// Include config file
require_once "config.php";

// // See what's inside the array
//     print_r($_SESSION);
//     function pre_r($array){
//         echo '<pre>';
//         print_r($array);
//         echo '<pre>';
//     }

if(isset($_GET['action'])){
    if($_GET['action'] == "delete"){
        foreach($_SESSION['shopping_cart'] as $keys => $values){
            if($values["id"] == $_GET["id"]){
                unset($_SESSION["shopping_cart"][$keys]);
                header('index.php');
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

<main>

<h1>PANIER</h1>

<div class="container">


        <table id="cart_table" class="table">

            <tr>
                <th>Article</th>
                <th>Taille</th>
                <th>Quantité</th>
                <th>Prix/u</th>
                <th>Montant</th>
                <th>Supprimer</th>
            <tr>

            <?php
            if(!empty($_SESSION['shopping_cart'])):

                $total = 0;

                foreach($_SESSION['shopping_cart'] as $key => $product):

            ?>
            <tr>
                <td><?php echo $product['nom']; ?></td>
                <td><?php echo $product['taille']; ?></td>
                <td><?php echo $product['quantity']; ?></td>
                <td><?php echo $product['prix']; ?>€</td>
                <td><?php echo number_format($product['quantity'] * $product['prix'], 2); ?>€</td>
                <td>
                    <a href="shop_cart.php?action=delete&id=<?php echo $product['id']; ?>" title='Delete Record' data-toggle='tooltip'>
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php
                    $total = $total + ($product['quantity']*$product['prix']);
                endforeach;
            ?>
            <tr>
                <th>Total</th>
                <th><?php echo number_format($total, 2); ?>€</th>
            </tr>
            <tr>
                <td>
                    <?php
                        if (isset($_SESSION['shopping_cart'])):
                        if (count($_SESSION['shopping_cart']) >0 ):
                    ?>
                        <a href="#" class="btn btn-info">Checkout</a>
                    <?php endif; endif; ?>
                </td>
            </tr>
            <?php
            endif;
            ?>

        </table>
        
</div>



</main>

<footer>

</footer>

</body>
</html>