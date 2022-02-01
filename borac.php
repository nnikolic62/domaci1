<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borci</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        include "konekcija.php";
        if(isset($_GET['akcija'])){
            if($_GET['akcija'] == 'unesi'){
    ?>
    <h1>Unos novog borca</h1>
    <form class="form-group" action="?akcija=unesi" method="post">
        <label >ID: </label> <input class="form-control" type="text" name="ID"/></br>
        <label >Ime: </label> <input class="form-control" type="text" name="Ime"/></br>
        <label >Prezime: </label> <input class="form-control" type="text" name="Prezime"/></br>
        <label >Skor: </label> <input class="form-control" type="text" name="Skor"/></br>
        <label >KategorijaID: </label> <input class="form-control" type="text" name="KategorijaID"/></br>
        <input class="btn btn-lg btn-dark" type="submit" name="unesi" value="Ubaci"/>
    </form>

    <?php
        if(isset($_POST['unesi'])){
        if(isset($_POST['ID']) && isset($_POST['Ime']) && isset($_POST['Prezime']) && isset($_POST['Skor']) && isset($_POST['KategorijaID'])){
            $ID = isset($_POST['ID']);
            $ime = $_POST['Ime'];
            $prezime = $_POST['Prezime'];
            $skor = $_POST['Skor'];
            $kategorijaID = $_POST['KategorijaID'];

            $sql="INSERT INTO igrac (IgracID,ImeIgraca,PrezimeIgraca,Rekord,kategorijaID) VALUES ('".$ID."', '".$ime."', '".$prezime."', '".$rekord."', '".$kategorijaID."')";
            if($connection->query($sql)){
                echo "Borac je uspesno dodat";
                }else{
                    echo "Borac nije dodat";
                }
            }else{
                echo "Nisu uneti podaci";
            }
        }
            }
        }
    ?>
    <?php
        $sql = "SELECT * FROM igrac";
        if (!$q=$connection->query($sql)){
        echo "Nastala je greska pri izvodenju upita<br>" . mysql_query();
        die();
        }
        if ($q->num_rows==0){
        echo "Nema boraca za prikaz.";
        }else{
    ?>
    <h1>Prikaz svih boraca</h1>
    <table  class="table table-stripped table-hover table-border">
        <tr>
            <td><b>ID</b></td>
            <td><b>Ime</b></td>
            <td><b>Prezime</b></td>
            <td><b>Skor</b></td>
            <td><b>KategorijaID</b></td>
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
            <td><a href="?akcija=izmeni_forma&IgracID= <?php echo $red->IgracID; ?>">Izmeni</a></td>
            <td><a href="?akcija=obrisi&IgracID= <?php echo $red->IgracID; ?>">Obrisi</a></td>
        </tr>

        <?php
            }
        ?>
    </table>
    <?php
        }
    ?>
    <a href="?akcija=unesi">Unos novog borca</a>
</body>
</html>