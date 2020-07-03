<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

<main>
    
    <h2 class="title">Merci pour votre commande, elle a bien été prise en compte !</h2>

    <div id="recapitulatif_commande">

        <h3 id="titre_facture">Facture</h3>

        <div class="separateur"></div>

        <div class="info_commande">
            <h4>Informations</h4>
            <ul class="list">
                <li><span>Numéro de la commande :</span>025814756</li>
                <li><span>Date et heure: </span>le 18/06/1992 à 17:48:07</li>
                <li><span>Montant total: </span>521.03€</li>
                <li><span>Mode de paiement: </span>Carte bleue</li>
            </ul>
        </div>

        <div class="separateur"></div>

        <div class="adresse_commande">
            <h4>Livraison</h4>
            <ul class="list">
                <li><span>Nom: </span>Regnault</li>
                <li><span>Prénom: </span>Maxime</li>
                <li><span>Adresse: </span>43 Rue de la comète</li>
                <li><span>Ville: </span>Asnières-sur-Seine</li>
                <li><span>Code Postal: </span>92600</li>
                <li><span>Pays: </span>France</li>
            </ul>
        </div>

        <div class="separateur"></div>

        <div class="facturation_commande">
            <h4>Facturation</h4>
            <ul class="list">
                <li><span>Nom: </span>Rue de la comète</li>
                <li><span>Prénom: </span>Rue de la comète</li>
                <li><span>Adresse: </span>Rue de la comète</li>
                <li><span>Ville: </span>Asnières-sur-Seine</li>
                <li><span>Code Postal: </span>92600</li>
                <li><span>Pays: </span>France</li>
            </ul>
        </div>

        <div class="separateur"></div>

        <div class="row">

            <div id="details_commande">

                <h2>Details de la commande</h2>

                <table class="table">

                    <tbody>

                        <tr>
                            <th scope="col">Article</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Montant</th>
                        </tr>

                        <tr class="article1">
                            <td>
                                <p>Nom article1</p>
                            </td>
                            <td>
                                <p>x 02</p>
                            </td>
                            <td>
                                <p>782.79€</p>
                            </td>
                        </tr>

                        <tr class="article2">
                            <td>
                                <p>Nom article2</p>
                            </td>
                            <td>
                                <p>x 10</p>
                            </td>
                            <td>
                                <p>1278.79€</p>
                            </td>
                        </tr>

                        <tr class="article3">
                            <td>
                                <p>Nom article3</p>
                            </td>
                            <td>
                                <p>x 07</p>
                            </td>
                            <td>
                                <p>356.79€</p>
                            </td>
                        </tr>

                        <tr class="totalht">
                            <td>
                                <p>Total HT</p>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <p>7672.79€</p>
                            </td>
                        </tr>

                        <tr class="taxe">
                            <td>
                                <p>TVA</p>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <p>20.00%</p>
                            </td>
                        </tr>

                        <tr class="livraison">
                            <td>
                                <p>Livraison</p>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <p>0.00€</p>
                            </td>
                        </tr>

                        <tr class="total">
                            <td>
                                <p>Total TTC</p>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <p>37182.79€</p>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <div class="separateur"></div>

        <button id="btn_facture" type="submit" class="btn btn-primary">Télécharger la facture</button>

    </div>

</main>

<footer>

</footer>

</body>
</html>