<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
<?php
// image/jpeg, image/png, image/gif    
    if (isset($_POST['odeslat']) && !empty($_FILES['soubor']['name'])) {
        
        $uploaddir = 'img/';

        if (isset($_POST['nazev']) && !empty($_POST['nazev'])) {
            $nazev_souboru = $_POST['nazev'];
        } else {
            $nazev_souboru = basename($_FILES['soubor']['name']);
        }
        $uploadfile = $uploaddir . $nazev_souboru;

        $muzuZobrazit = false;

        if (($_FILES['soubor']['type'] == 'image/jpeg') || 
            ($_FILES['soubor']['type'] == 'image/png') || 
            ($_FILES['soubor']['type'] == 'image/gif')) {

            if (move_uploaded_file($_FILES['soubor']['tmp_name'], $uploadfile)) {
                echo "<h2>Obrázek byl úspěšně uložen pod názvem: $nazev_souboru</h2>";
                $muzuZobrazit = true;
            } else {
                echo "<h2>Možný útok při ukládání souborů!</h2>";
            }            
        } else {
            echo "<h2>Soubor není obrázek</h2>";
        }
        //print_r($_POST);
        //print_r($_FILES);
    }
?>
    </pre>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="id_soubor">Vyber soubor: </label><input id="id_soubor" type="file" name="soubor"><br>
        <label for="id_nazev">Nový název souboru:</label><input id="id_nazev" type="text" name="nazev" value=""><br>
        <label for="id_zobraz">Po uploadu zobraz:</label><input id="id_zobraz" type="checkbox" name="zobraz"><br>
        <input type="submit" name="odeslat" value="Odeslat">
    </form>   
    <?php  
        if (isset($_POST['zobraz']) && !empty($_FILES['soubor']['name']) && $muzuZobrazit) {
            echo "<img src='$uploadfile' alt=''>";
        }
    ?> 
</body>
</html>