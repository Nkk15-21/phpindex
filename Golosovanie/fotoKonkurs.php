<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__));} ?>
<?php
require ('conf.php');
global $yhendus;

//kuvatamine
if(isset($_REQUEST["kuva_id"])){
    $paring=$yhendus->prepare("UPDATE fotokonkurs SET avalik=1 WHERE id=?");
    $paring->bind_param("i", $_REQUEST["kuva_id"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

//peitmine
if(isset($_REQUEST["peida_id"])){
    $paring=$yhendus->prepare("UPDATE fotokonkurs SET avalik=0 WHERE id=?");
    $paring->bind_param("i", $_REQUEST["peida_id"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

//update +1 punkt
if(isset($_REQUEST["lisa1punkt"])){
    $paring=$yhendus->prepare("UPDATE fotokonkurs SET punktid=punktid+1 WHERE id=?");
    $paring->bind_param("i", $_REQUEST["lisa1punkt"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
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
if(isset($_REQUEST["minus1punkt"])){
    $paring=$yhendus->prepare("UPDATE fotokonkurs SET punktid=punktid-1 WHERE id=?");
    $paring->bind_param("i", $_REQUEST["minus1punkt"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

//kustuta
if(isset($_REQUEST["kustuta"])){
    $paring=$yhendus->prepare("DELETE from fotokonkurs WHERE id=?");
    $paring->bind_param("i", $_REQUEST["kustuta"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

//kommentaride kustutamine
if(isset($_REQUEST["komentkust"])){
    $paring = $yhendus->prepare("UPDATE fotokonkurs SET komentaarid='' WHERE id=?");
    $paring->bind_param("i", $_REQUEST["komentkust"]);
    $paring->execute();
    header("Location: ".$_SERVER["PHP_SELF"]);
}

//добавление данных в таблицу
if(isset($_REQUEST["nimetus"]) && !empty($_REQUEST["nimetus"])){
    $paring=$yhendus->prepare("INSERT INTO fotokonkurs(fotoNimetus, autor, pilt, lisamisAeg) VALUES (?,?,?,NOW())");
    $paring->bind_param("sss", $_REQUEST["nimetus"], $_REQUEST["autor"], $_REQUEST["pilt"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
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
        <th>Lisamise Aeg</th>
        <th>Lisa -1 Punkt</th>
        <th>Kustuta</th>
        <th>Kommentaarid</th>
        <th>Kommentaaride kustutamine</th>
    </tr>

    <?php

    // -------------------------------------------------- Oтображение таблицы базы данных ---------------------------------------
    global $yhendus;
    $paring=$yhendus->prepare('SELECT id, fotoNimetus, pilt, autor, punktid, lisamisAeg, komentaarid, avalik from fotokonkurs');
    $paring->bind_result($id, $fotoNimetus, $pilt, $autor, $punktid, $lisamisAeg, $komentaarid, $avalik);
    $paring->execute();
    while($paring->fetch()){
        echo "<tr>";
        echo "<td>".htmlspecialchars($fotoNimetus)."</td>";
        echo "<td><img src='$pilt' alt='fotoPilt'></td>";
        echo "<td>".$autor."</td>";
        echo "<td>".$punktid."</td>";
        echo "<td>".$lisamisAeg."</td>";
        echo "<td><a href='?minus1punkt=$id'>-1</a></td>";
        echo "<td><a href='?kustuta=$id'>Kustuta</a></td>";

        echo "<td>".nl2br($komentaarid)."
            </td>";
        echo "<td><a href='?komentkust=$id'>Kommentaaride kustutamine</a></td>";

        $tekst="Näita";
        $avaparametr="kuva_id";
        $seis="Peidetud";
        if($avalik==1){
            $tekst="Peida";
            $avaparametr="peida_id";
            $seis="Kuvatadu";
        }

        echo "<td><a href='?$avaparametr=$id'>".$tekst."</a></td>";
        echo "<td>$seis</td>";

        echo "</tr>";
    }
    ?>
</table>

<?php
$yhendus->close();
?>

</body>
</html>
