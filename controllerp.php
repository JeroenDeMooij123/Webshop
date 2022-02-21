<?php
class Controller
{
  private $conn;

  function __construct()
  {
    $conn = new PDO("mysql:host=localhost;dbname=casuswebshop;", "root", "");
    $this->conn = $conn;
  }
 

  //klant toevoegen     
  public function artikeltoevoegen($id, $artikelnummer, $artikelnaam, $soort, $omschrijving, $prijs)
  {

    $query = "INSERT INTO product VALUES(:id,
                                            :artikelnummer,
                                            :artikelnaam,
                                            :soort,
                                            :omschrijving,
                                            :prijs)";
    $stm = $this->conn->prepare($query);
    $stm->bindParam(":id", $id);
    $stm->bindParam(":artikelnummer", $artikelnummer);
    $stm->bindParam(":artikelnaam", $artikelnaam);
    $stm->bindParam(":soort", $soort);
    $stm->bindParam(":omschrijving", $omschrijving);
    $stm->bindParam(":prijs", $prijs);

    if ($stm->execute() == true) {
    } else {
    }
  }
  //Lijst
  public function lijst()
  {
?>
    <table>
      <thead>
        <tr>
          <th>id</th>
          <th>artikelnummer</th>
          <th>artikelnaam</th>
          <th>soort</th>
          <th>omschrijving</th>
          <th>prijs</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $query = "SELECT * FROM product";
        $stm = $this->conn->prepare($query);
        if ($stm->execute() == true) {

          $producten = $stm->fetchAll(PDO::FETCH_OBJ);

          foreach ($producten as $product) {

            echo "<tr>";
        ?>


            <td><?php echo $product->id; ?></td>
            <td><?php echo $product->artikelnummer; ?> </td>
            <td><?php echo $product->artikelnaam; ?> </td>
            <td><?php echo $product->soort; ?> </td>
            <td><?php echo $product->omschrijving; ?> </br></td>
            <td><?php echo $product->prijs; ?> </br></td>
            <td> <?php echo "<a href=Productwijzig.php?id=".$product->id.">edit </a>"; ?></td>
            <td> <?php echo "<a href=Productdelete.php?id=".$product->id.">Delete </a>"; ?></td>
        <?php
          }
        }

        ?>
    </table>
<?php
  }
 //get id
  public function getkid($kid)
  {
    $stm = $this->conn->prepare("SELECT * FROM klant WHERE $kid=:kid");
    $stm->execute(array(":kid" => $kid));
    $editRow = $stm->fetch(PDO::FETCH_ASSOC);
    return $editRow;
  }
  //Ik weet volgensmij de code wel maar ik weet niet hoe ik het aan moet spreken in de window waar ik het doe het zelfde geld voor deleten.
  public function update()
  {

    $stm = $this->conn->prepare("UPDATE klant SET voornaam =:voornaam, 
                                                       achternaam =:achternaam, 
                                                       email =:email, 
                                                       telefoon =:telefoon
                                                    WHERE kid =:kid ");
    $stm->bindparam(":kid", $kid);
    $stm->bindparam(":voornaam", $voornaam);
    $stm->bindparam(":achternaam", $achternaam);
    $stm->bindparam(":email", $email);
    $stm->bindparam(":telefoon", $telefoon);
    $stm->execute();
    if ($stm->execute() == true) {
    } else {
    }
  }

  public function delete($kid)
  {
    $stm = $this->conn->prepare("DELETE FROM klant WHERE kid=:kid");
    $stm->bindparam(":kid", $kid);
    $stm->execute();
    return true;
  }
}


?>