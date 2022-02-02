<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela borac</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    include "konekcija.php";
    $sql = "SELECT * FROM igrac";
    if(!$q=$connection->query($sql)){
        echo "<p>Nastala je greska pri izvodenju upita</p>" . mysql_query();
        exit();
    }else{
        ?>
        <br>
        <table class="table table-stripped table-border table-hover">
            <tr>
                <td>ID</td>
                <td>Ime</td>
                <td>Prezime</td>
                <td>Skor</td>
                <td>Kategorija</td>
            </tr>
            <?php
            while($red=$q->fetch_object()){
            ?>
            <tr>
                <td><?php echo $red->IgracID; ?></td>
                <td><?php echo $red->ImeIgraca; ?></td>
                <td><?php echo $red->PrezimeIgraca; ?></td>
                <td><?php echo $red->Rekord; ?></td>
                <td><?php echo $red->KategorijaID; ?></td>
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