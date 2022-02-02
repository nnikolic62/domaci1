<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sortirane kategorije</title>
</head>
<body>
    <?php
    include "konekcija.php";
    $sql = "SELECT * FROM kategorija ORDER BY KategorijaNaziv";
    if(!$q=$connection->query($sql)){
        echo "<p>Nastala je greska pri izvodenju upita</p>" . mysql_query();
        exit();
    }else{
    ?>
    <br>
    <table class="table table-stripped table-border table-hover">
        <tr>
            <td>ID</td>
            <td>Naziv</td>
            <td>Kilaza</td>
        </tr>
        <?php
        while($red=$q->fetch_object()){
        ?>
        <tr>
            <td><?php echo $red->KategorijaID; ?></td>
            <td><?php echo $red->KategorijaNaziv; ?></td>
            <td><?php echo $red->KategorijaKilaza; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
    }
    ?>
</body>
</html>