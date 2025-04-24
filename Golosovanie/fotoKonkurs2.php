<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__));} ?>
<?php
require ('conf.php');
global $yhendus;

//update +1 punkt
if (isset($_REQUEST["lisa1punkt"])) {
    $id = $_REQUEST["lisa1punkt"];
    $kontroll = $yhendus->prepare("SELECT punktid FROM fotokonkurs WHERE id=?");
    $kontroll->bind_param("i", $id);
    $kontroll->execute();
    $kontroll->bind_result($punktid);
    $kontroll->fetch();
    $kontroll->close();

    if ($punktid < 100) {
        $paring = $yhendus->prepare("UPDATE fotokonkurs SET punktid=punktid+1 WHERE id=?");
        $paring->bind_param("i", $id);
        $paring->execute();
    }
    header("Location:".$_SERVER["PHP_SELF"]);
}

//update - comment
if(isset($_REQUEST["uus_komment"]) && !empty($_REQUEST["komment"])){
    $paring=$yhendus->prepare("UPDATE fotokonkurs SET komentaarid=Concat(komentaarid, ?) WHERE id=?");
    $komment2=$_REQUEST["komment"]."\n";
    $paring->bind_param("si", $komment2, $_REQUEST["uus_komment"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

//update -1 punkt
if (isset($_REQUEST["minus1punkt"])) {
    $id = $_REQUEST["minus1punkt"];
    $kontroll = $yhendus->prepare("SELECT punktid FROM fotokonkurs WHERE id=?");
    $kontroll->bind_param("i", $id);
    $kontroll->execute();
    $kontroll->bind_result($punktid);
    $kontroll->fetch();
    $kontroll->close();

    if ($punktid > 0) {
        $paring = $yhendus->prepare("UPDATE fotokonkurs SET punktid=punktid-1 WHERE id=?");
        $paring->bind_param("i", $id);
        $paring->execute();
    }
    header("Location:".$_SERVER["PHP_SELF"]);
}

?>


<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Foto Konkurss</title>
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

<table>
    <tr>
        <th>Foto nimetus</th>
        <th>Pilt</th>
        <th>Autor</th>
        <th>Punktid</th>
        <th>Lisa +1 Punkt</th>
        <th>Lisa -1 Punkt</th>
        <th>Kommentaarid</th>
    </tr>

    <?php

    // отображение таблицы базы данных
    global $yhendus;
    $paring=$yhendus->prepare('SELECT id, fotoNimetus, pilt, autor, punktid, komentaarid from fotokonkurs WHERE avalik=1');
    $paring->bind_result($id, $fotoNimetus, $pilt, $autor, $punktid, $komentaarid);
    $paring->execute();
    while($paring->fetch()){
        echo "<tr>";
        echo "<td>".htmlspecialchars($fotoNimetus)."</td>";
        echo "<td><a href='fotoDetail.php?id=$id'><img src='$pilt' alt='fotoPilt'></a></td>";
        echo "<td>".htmlspecialchars($autor)."</td>";
        echo "<td>".htmlspecialchars($punktid)."</td>";
        echo "<td><a href='?lisa1punkt=$id'>+1</a></td>";
        echo "<td><a href='?minus1punkt=$id'>-1</a></td>";
        echo "<td>".nl2br($komentaarid)."
                <form action='?' method='POST'>
                <input type='hidden' name='uus_komment' value='$id'>
                <input type='text' name='komment'>
                <input type='submit' value='ok'>   
                </form>
            </td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
$yhendus->close();
?>

</body>
</html>
