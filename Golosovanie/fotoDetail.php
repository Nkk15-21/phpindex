<?php
require('conf.php');
global $yhendus;

if (!isset($_GET['id'])) {
    echo "Foto puudub!";
    exit;
}

$paring = $yhendus->prepare("SELECT fotoNimetus, autor, pilt, punktid, komentaarid FROM fotokonkurs WHERE id=?");
$paring->bind_param("i", $_GET['id']);
$paring->execute();
$paring->bind_result($nimetus, $autor, $pilt, $punktid, $kommentaarid);
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Foto detailid</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .detailikarp {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        .detailikarp img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .detailikarp h1 {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .detailikarp p {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }

        .back-button {
            display: inline-block;
            margin-top: 30px;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<?php
if ($paring->fetch()):
    ?>
    <div class="detailikarp">
        <h1><?php echo htmlspecialchars($nimetus); ?></h1>
        <img src="<?php echo htmlspecialchars($pilt); ?>" alt="Foto">
        <p><strong>Autor:</strong> <?php echo htmlspecialchars($autor); ?></p>
        <p><strong>Punktid:</strong> <?php echo $punktid; ?></p>
        <p><strong>Kommentaarid:</strong><br><?php echo nl2br(htmlspecialchars($kommentaarid)); ?></p>
        <a href="fotoKonkurs2.php" class="back-button">⬅ Tagasi</a>
    </div>
<?php
else:
    echo "<p style='text-align:center; font-size:18px;'>Fotot ei leitud.</p>";
endif;
$yhendus->close();
?>

</body>
</html>
