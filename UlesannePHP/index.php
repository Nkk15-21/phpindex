<?php
require("conf.php");
global $yhendus;

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    // +1 punkt
    if (isset($_POST["lisa1punkt"])) {
        $paring = $yhendus->prepare("UPDATE fotokonkurs SET punktid=punktid+1 WHERE id=?");
        $paring->bind_param("i", $id);
        $paring->execute();
    }

    // -1 punkt
    if (isset($_POST["minus1punkt"])) {
        $paring = $yhendus->prepare("UPDATE fotokonkurs SET punktid=punktid-1 WHERE id=?");
        $paring->bind_param("i", $id);
        $paring->execute();
    }

    // komment lisamine
    if (isset($_POST["komment"]) && !empty(trim($_POST["komment"]))) {
        $komment = trim($_POST["komment"])."\n";
        $paring = $yhendus->prepare("UPDATE fotokonkurs SET komentaarid=Concat(komentaarid, ?) WHERE id=?");
        $paring->bind_param("si", $komment, $id);
        $paring->execute();
    }

    // komment kustutamine
    if (isset($_POST["kustuta_komment"])) {
        $paring = $yhendus->prepare("UPDATE fotokonkurs SET komentaarid='' WHERE id=?");
        $paring->bind_param("i", $id);
        $paring->execute();
    }

    // andmete päring
    $paring = $yhendus->prepare("SELECT fotoNimetus, autor, pilt, punktid, komentaarid FROM fotokonkurs WHERE id=?");
    $paring->bind_param("i", $id);
    $paring->bind_result($nimetus, $autor, $pilt, $punktid, $komentaarid);
    $paring->execute();
    $paring->fetch();
    ?>
    <!DOCTYPE html>
    <html lang="et">
    <head>
        <meta charset="UTF-8">
        <title><?php echo htmlspecialchars($nimetus); ?></title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #988d8d;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 800px;
                margin: 30px auto;
                background-color: #fff;
                padding: 25px;
                border-radius: 10px;
                box-shadow: 0 0 10px #ccc;
            }

            h1 {
                text-align: center;
                color: #333;
            }

            img {
                max-width: 100%;
                margin: 20px 0;
                border-radius: 8px;
            }

            .btn {
                background-color: #2040c3;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 5px;
                margin-top: 10px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: #0e3087;
            }

            .btn-delete {
                background-color: #dc3545;
            }

            .btn-delete:hover {
                background-color: #c82333;
            }

            .comments {
                background-color: #f9f9f9;
                padding: 10px;
                border-radius: 6px;
                margin-bottom: 10px;
                white-space: pre-line;
            }

            input[type="text"] {
                padding: 8px;
                width: calc(100% - 110px);
                margin-right: 10px;
            }

            a {
                display: inline-block;
                margin-top: 20px;
                color: #0077cc;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h1><?php echo htmlspecialchars($nimetus); ?></h1>
        <p><strong>Autor:</strong> <?php echo htmlspecialchars($autor); ?></p>
        <img src="<?php echo htmlspecialchars($pilt); ?>" alt="pilt">
        <p><strong>Punktid:</strong> <?php echo $punktid; ?></p>

        <form method="post">
            <button type="submit" name="lisa1punkt" class="btn">Lisa +1 punkt</button>
            <button type="submit" name="minus1punkt" class="btn">Minus 1 punkt</button>

        </form>

        <h3>Kommentaarid:</h3>
        <div class="comments">
            <?php echo nl2br(htmlspecialchars($komentaarid)); ?>
        </div>

        <form method="post">
            <input type="text" name="komment" placeholder="Lisa kommentaar" required>
            <button type="submit" class="btn">Lisa kommentaar</button>
        </form>

        <form method="post">
            <button type="submit" name="kustuta_komment" class="btn btn-delete">Kustuta kõik kommentaarid</button>
        </form>

        <a href="index.php">← Tagasi nimekirja</a>
    </div>
    </body>
    </html>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html lang="et">
    <head>
        <meta charset="UTF-8">
        <title>Foto Nimetused</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #8c8181;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 30px auto;
                background-color: #f1ba14;
                padding: 25px;
                border-radius: 10px;
                box-shadow: 0 0 10px #ccc;
            }

            h1 {
                text-align: center;
                color: #333;
            }

            ul {
                list-style: none;
                padding: 0;
            }

            li {
                margin-bottom: 10px;
            }

            a {
                text-decoration: none;
                color: #0077cc;
                font-size: 18px;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h1>Fotode nimekiri</h1>
        <ul>
            <?php
            $paring = $yhendus->prepare("SELECT id, fotoNimetus FROM fotokonkurs");
            $paring->bind_result($id, $fotoNimetus);
            $paring->execute();
            while ($paring->fetch()) {
                echo "<li><a href='?id=$id'>" . htmlspecialchars($fotoNimetus) . "</a></li>";
            }
            ?>
        </ul>
    </div>
    </body>
    </html>
    <?php
}
$yhendus->close();
?>
