<?php
include("webshopdb.php");

if (isset($_POST['btnOpslaan'])) {
    //Update naar de database
    $voornaam = $_POST['txtvoornaam'];
    $achternaam = $_POST['txtachternaam'];
    $email = $_POST['txtemail'];
    $telefoon = $_POST['txttelefoon'];

    /*
		Ophalen id uit de URL. Deze is nodig 
		om een specifiek smaak aan te passen. Dit moet 
		ALTIJD een unieke waarde zijn 
		*/
    $kid = $_GET['kid'];
    //Update query, waarin een voorwaarde gesteld wordt.
    // nl smid dat meekomt uit de URL.
    $query = "UPDATE klant SET voornaam	 = '$voornaam', achternaam  = '$achternaam', email = '$email', telefoon = '$telefoon' WHERE kid = $kid";
    $stm = $con->prepare($query);
    if ($stm->execute()) {
        header('Location: /Webshop/klanttoevoegen.php');
    }
}


//id ophalen uit de URL
$kid = $_GET['kid'];

//QUERY maken die voldoet aan het id
$query = "SELECT * FROM klant WHERE kid = $kid";
//Voorbereiden op de database   
$stm = $con->prepare($query);
//Query uitvoeren op de database
if ($stm->execute()) {
    //Een resultaat ophalen
    $res = $stm->fetch(PDO::FETCH_OBJ);
?>
    <form method="POST">
        <input type="text" name="txtID" readonly value="<?php echo $res->kid; ?>" /></br>
        <input type="text" name="txtvoornaam" value="<?php echo $res->voornaam; ?>" /></br>
        <input type="text" name="txtachternaam" value="<?php echo $res->achternaam; ?>" /></br>
        <input type="text" name="txtemail" value="<?php echo $res->email; ?>" /></br>
        <input type="text" name="txttelefoon" value="<?php echo $res->telefoon; ?>" /></br>

        <input type="submit" name="btnOpslaan" value="Opslaan" />

    </form>

<?php
}
?>
</body>

</html>