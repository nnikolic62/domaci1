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
if (isset ($_GET['akcija'])){
if ($_GET['akcija'] == 'unos'){
?>
<h1>Unos novog borca</h1>
<hr/>
<form class="form-group" method="post" action="?akcija=unos">
    <label>ID: </label> <input class="form-control" type="text" name="ID" /><br/>
    <label>Ime: </label> <input class="form-control" type="text" name="ime" /><br/>
    <label>Prezime: </label> <input class="form-control" type="text" name="prezime" /><br/>
    <label>Skor: </label> <input class="form-control" type="text" name="rekord" /><br/>
    <label>KategorijaID:</label> <input class="form-control" type="text" name="kategorijaID" /><br/>
    <input class="btn btn-lg btn-dark" type="submit" name="unos" value="Ubaci" />
    <!-- naziv post zahteva je unos? -->
</form>
<?php
if (isset($_POST["unos"])){
    if (isset($_POST['ID'])&&isset($_POST['ime'])&&isset($_POST['prezime'])&&isset($_POST['rekord'])&&isset($_POST['kategorijaID'])){
        $ID = $_POST['ID'];
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $rekord = $_POST['rekord'];
        $kategorijaID = $_POST['kategorijaID'];


$sql="INSERT INTO igrac (IgracID,ImeIgraca,PrezimeIgraca,Rekord,kategorijaID) VALUES ('".$ID."', '".$ime."', '".$prezime."', '".$rekord."', '".$kategorijaID."')";
if ($connection->query($sql)){
    echo "<p>Borac uspesno dodat</p>";
} else {
    echo "<p>Nastala je greska pri dodavanju borca</p>" . $mysqli->error;
}
} else {
    echo "Nisu prosledjeni parametri!";
            }
        }
    }
}

if(isset($_GET["akcija"]) && isset($_GET['IgracID'])){
    $akcija = $_GET["akcija"];
    $ID = $_GET["IgracID"];

    switch($akcija){
        case "obrisi":
            $upit = "DELETE FROM igrac WHERE IgracID=" .$ID;
            if(!$q=$connection->query($upit)){
                echo "Nastala je greska pri izvodenju upita<br/>" . mysql_query();
                die();
            } else {
                echo "<p>Brisanje borca je uspelo!</p>";
            }
        break;

        case "izmeni_forma":
            $upit = "SELECT IgracID, ImeIgraca, PrezimeIgraca, Rekord, KategorijaID FROM igrac WHERE IgracID=" .$ID;
            if (!$q=$connection->query($upit)){
                echo "<p>Nastala je greska pri izvodenju upita</p>" . mysql_query();
                die();
            } else {
            if ($q->num_rows!=1){
                echo "<p>Nepostojeci borac.</p>";
            }else{
                $igrac = $q->fetch_object();
                $igracID = $igrac->IgracID;
                $ime = $igrac->ImeIgraca;
                $prezime = $igrac->PrezimeIgraca;
                $rekord = $igrac->Rekord;
                $kategorijaID = $igrac->KategorijaID;
                ?>
                <h1>Izmena podataka o borcu</h1>
                <hr/>
                <form class="form-group" method="post" action="?akcija=izmena&IgracID=<?php echo $_GET['IgracID'];?>">
                <label>Ime : </label> <input class="form-control" type="text" name="ime" value="<?php echo $ime;?>"/><br/>
                <label>Prezime : </label> <input class="form-control" type="text" name="prezime" value="<?php echo $prezime;?>"/><br/>
                <label>Skor : </label> <input class="form-control" type="text" name="rekord" value="<?php echo $rekord;?>"/><br/>
                <label>KategorijaID : </label> <input class="form-control" type="text" name="kategorijaID" value="<?php echo $kategorijaID;?>"/><br/>
                <input class="btn btn-lg btn-dark" type="submit" name="unos" value="Potvrdi" />
                </form>
                <!-- sto ovde ne definisemo da li je setovan post zahtev izmena, a ne da nastavljamo switch -->
                <?php
            }
        }
                case "izmena":
                    if (isset ($_POST['ime']) && isset ($_POST['prezime']) && isset ($_POST['rekord']) && isset ($_POST['kategorijaID'])){
                        $ime = $_POST['ime'];
                        $prezime = $_POST['prezime'];
                        $rekord = $_POST['rekord'];
                        $katID = $_POST['kategorijaID'];
                        $upit = "UPDATE igrac SET ImeIgraca='". $ime ."', PrezimeIgraca='". $prezime ."', Rekord='". $rekord ."', KategorijaID='" . $katID . "' WHERE IgracID=". $ID;

                        if ($connection->query($upit)){
                            if ($connection->affected_rows > 0 ){
                                echo "<p>Podaci o borcu su uspesno izmenjeni.</p>";
                            } else {
                                echo "<p>Podaci o borcu nisu izmenjeni.</p>";
                            }
                        }else {
                            echo "<p>Nastala je greška pri izmeni podataka o borcu.</p>" . mysql_error();
                            } 
                }else {
                    echo "<p>Nisu prosleđeni parametri za izmenu";
                }
            break;
            default:
            echo "<p>Nepostojeća akcija!</p>";
            break;
    }
}
    
  
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
    <a class="btn btn-lg btn-dark" href="?akcija=unos">Unos novog borca</a>
    
    <footer>
        <button id="back" class="mt-2 btn btn-lg btn-outline-dark">Nazad na pocetnu</button>
        <script>
            document.getElementById("back").addEventListener("click", function(){
                document.location.href = "index.html";
            })
        </script>
    </footer>
</body>
</html>