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
  public function toevoegen($kid, $voornaam, $achternaam, $email, $telefoon)
  {

    $query = "INSERT INTO klant VALUES(:kid,
                                            :voornaam,
                                            :achternaam,
                                            :email,
                                            :telefoon)";
    $stm = $this->conn->prepare($query);
    $stm->bindParam(":kid", $kid);
    $stm->bindParam(":voornaam", $voornaam);
    $stm->bindParam(":achternaam", $achternaam);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":telefoon", $telefoon);

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
          <th>kid</th>
          <th>voornaam</th>
          <th>achternaam</th>
          <th>email</th>
          <th>telefoon</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $query = "SELECT * FROM klant";
        $stm = $this->conn->prepare($query);
        if ($stm->execute() == true) {

          $klanten = $stm->fetchAll(PDO::FETCH_OBJ);

          foreach ($klanten as $klant) {

            echo "<tr>";
        ?>

//lijst van alle klanten
            <td><?php echo $klant->kid; ?></td>
            <td><?php echo $klant->voornaam; ?> </td>
            <td><?php echo $klant->achternaam; ?> </td>
            <td><?php echo $klant->email; ?> </td>
            <td><?php echo $klant->telefoon; ?> </br></td>
            <td> <?php echo "<a href=Klantwijzig.php?kid=".$klant->kid.">edit </a>"; ?></td>
            <td> <?php echo "<a href=Klantdelete.php?kid=".$klant->kid.">Delete </a>"; ?></td>
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