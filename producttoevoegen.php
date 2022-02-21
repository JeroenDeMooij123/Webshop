<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="webshop.css" media="all" />
    <link rel="stylesheet" type="text/css" href="webshop.css" media="all" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>
        Webshop
    </title>
</head>

<body>

<ul>
    <li><a href="/Webshop/index.php">Home</a></li>
    <li><a href="/Webshop/producttoevoegen.php">product Toevoegen</a></li>
    <li><a href="/Webshop/klanttoevoegen.php">klant toevoegen</a></li>

  </ul>

    <center>
        <form method="POST">

            <label for="txtartikelnummer">Artikelnummer</label>
            <input type="text" name="txtartikelnummer" id="txtartikelnummer">
            <br />
            <label for="txtartikelnaam<">Artikelnaam</label>
            <input type="text" name="txtartikelnaam" id="txtartikelnaam">
            <br />
            <label for="txtsoort">Soort</label>
            <input type="text" name="txtsoort" id="txtsoort">
            <br />
            <label for="txtomschrijving">Omschrijving</label>
            <input type="text" name="txtomschrijving" id="txtomschrijving">
            <br />
            <label for="txtprijs">Prijs</label>
            <input type="text" name="txtprijs" id="txtprijs">
            <br />
            <input type="submit" name="btnSave" value="Opslaan">
        </form>
    </center>


    <?php

    require("controllerp.php");
    $product = new Controller();

    // Klant toeveogen
    if (isset($_POST['btnSave'])) {

        $id = 0;
        $artikelnummer = $_POST['txtartikelnummer'];
        $artikelnaam = $_POST['txtartikelnaam'];
        $soort = $_POST['txtsoort'];
        $omschrijving = $_POST['txtomschrijving'];
        $prijs = $_POST['txtprijs'];
//waardes mee sturen naar de controller

        if ($product->artikeltoevoegen($id, $artikelnummer, $artikelnaam, $soort, $omschrijving, $prijs)) {
        } else {
        }
    }
    // Lijst klanten

    $product->lijst();
    // klant edit





    ?>


    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>