<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__));} ?>
<?php
require("conf.php");
global $yhendus;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Foto lisamine</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Foto Konkurss</h1>


<div style="display: flex;">
    <div id="menyykiht">
        <h2>Navigeerimine</h2>
        <ul>
            <li><a href="fotoKonkurs.php">Admin PHP leht</a></li>
            <li><a href="fotoKonkurs2.php">Kasutaja PHP leht</a></li>
            <li><a href="fotoKonLisamine.php    ">Foto lisamine hääletamisele</a></li>
        </ul>
    </div>
</div>

<div class="formukarp">
    <form action="?" method="post">
        <h3>Foto lisamine hääletamisele</h3>
        <label for="nimetus">Foto nimetus</label>
        <input type="text" id="nimetus" name='nimetus' placeholder="Kirjuta ilus foto nimetus!">
        <br>
        <label for="autor">Foto autor</label>
        <input type="text" id="autor" name="autor" placeholder="Kirjuta autori nimi!">
        <br>
        <label for="pilt">Pildifoto</label>
        <textarea name="pilt" id="pilt" rows="6" placeholder="Kooperi kujutisse aadress!"></textarea>
        <br>
        <input type="submit" value="Lisa">
    </form>
</div>


<?php
if(isset($_REQUEST["nimetus"]) && !empty($_REQUEST["nimetus"])){
    $paring=$yhendus->prepare("INSERT INTO fotokonkurs(fotoNimetus, autor, pilt, lisamisAeg) VALUES (?,?,?,NOW())");
    $paring->bind_param("sss", $_REQUEST["nimetus"], $_REQUEST["autor"], $_REQUEST["pilt"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}
?>



</body>
</html>




