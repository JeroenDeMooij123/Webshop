<?php

include "webshopdb.php";
if (isset($_GET['id'])) {
?>

    <b> Weet u zeker dat u het product wilt verwijderen?</b>

    <form method="post">

        <input type="submit" name="btnJa" value="Ja" />

    </form>

<?php
    if (isset($_POST['btnJa'])) {

        $id = $_GET['id'];

        $query = "DELETE FROM product WHERE id = $id";
        $stm = $con->prepare($query);
        if ($stm->execute()) {

            header('Location: /Webshop/producttoevoegen.php');
        }
    }
}
?>