<?php

include "webshopdb.php";
if (isset($_GET['kid'])) {
?>

    <b> Weet u zeker dat u de klant wilt verwijderen?</b>

    <form method="post">

        <input type="submit" name="btnJa" value="Ja" />

    </form>

<?php
    if (isset($_POST['btnJa'])) {

        $kid = $_GET['kid'];

        $query = "DELETE FROM klant WHERE kid = $kid";
        $stm = $con->prepare($query);
        if ($stm->execute()) {

            header('Location: /Webshop/klanttoevoegen.php');
        }
    }
}
?>