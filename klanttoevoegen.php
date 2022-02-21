<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="header.css" media="all" />
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

            <label for="txtvoornaam">Voornaam</label>
            <input type="text" name="txtvoornaam" id="txtvoornaam">
            <br />
            <label for="txtachternaam">Achternaam</label>
            <input type="text" name="txtachternaam" id="txtachternaam">
            <br />
            <label for="txtemail">Email</label>
            <input type="text" name="txtemail" id="txtemail">
            <br />
            <label for="txttelefoon">Telefoon</label>
            <input type="text" name="txttelefoon" id="txttelefoon">
            <br />
            <input type="submit" name="btnSave" value="Opslaan">
        </form>
    </center>


    <?php

    require("controller.php");
    $klant = new Controller();

    // Klant toeveogen
    if (isset($_POST['btnSave'])) {

        $kid = 0;
        $voornaam = $_POST['txtvoornaam'];
        $achternaam = $_POST['txtachternaam'];
        $email = $_POST['txtemail'];
        $telefoon = $_POST['txttelefoon'];
//waarder meesturen naar de controller
        if ($klant->toevoegen($kid, $voornaam, $achternaam, $email, $telefoon)) {
        } else {
        }
    }
    // Lijst klanten

    $klant->lijst();
    // klant edit
    if (isset($_POST['btnEdit'])) {
        $klant->getkid($kid);
        $klant->update() ;

        
    }
    
    
    

    ?>


    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>