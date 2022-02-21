<?php
include("webshopdb.php");

if (isset($_POST['btnOpslaan'])) {
    //Update naar de database
    $artikelnummer = $_POST['txtartikelnummer'];
    $artikelnaam = $_POST['txtartikelnaam'];
    $soort = $_POST['txtsoort'];
    $omschrijving = $_POST['txtomschrijving'];
    $prijs = $_POST['txtprijs'];

    /*
		Ophalen id uit de URL. Deze is nodig 
		om een specifiek smaak aan te passen. Dit moet 
		ALTIJD een unieke waarde zijn 
		*/
    $id = $_GET['id'];
    //Update query, waarin een voorwaarde gesteld wordt.
    // nl smid dat meekomt uit de URL.
    $query = "UPDATE product SET artikelnummer = '$artikelnummer', artikelnaam  = '$artikelnaam', soort = '$soort', omschrijving = '$omschrijving', prijs = '$prijs' WHERE id = $id";
    $stm = $con->prepare($query);
    if ($stm->execute()) {
        header('Location: /Webshop/producttoevoegen.php');
    }
}


//id ophalen uit de URL
$id = $_GET['id'];

//QUERY maken die voldoet aan het id
$query = "SELECT * FROM product WHERE id = $id";
//Voorbereiden op de database   
$stm = $con->prepare($query);
//Query uitvoeren op de database
if ($stm->execute()) {
    //Een resultaat ophalen
    $res = $stm->fetch(PDO::FETCH_OBJ);
?>
    <form method="POST">
        <input type="text" name="txtID" readonly value="<?php echo $res->id; ?>" /></br>
        <input type="text" name="txtartikelnummer" value="<?php echo $res->artikelnummer; ?>" /></br>
        <input type="text" name="txtartikelnaam" value="<?php echo $res->artikelnaam; ?>" /></br>
        <input type="text" name="txtsoort" value="<?php echo $res->soort; ?>" /></br>
        <input type="text" name="txtomschrijving" value="<?php echo $res->omschrijving; ?>" /></br>
        <input type="text" name="txtprijs" value="<?php echo $res->prijs; ?>" /></br>

        <input type="submit" name="btnOpslaan" value="Opslaan" />

    </form>

<?php
}
?>
</body>

</html>