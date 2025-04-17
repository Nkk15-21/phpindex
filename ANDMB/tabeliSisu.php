<?php
require("conf.php");
global $yhendus;

// Удаление
if (isset($_REQUEST["kustuta"])) {
    $kask = $yhendus->prepare("DELETE FROM lehed WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustuta"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
    exit();
}

// Добавление
if (isset($_REQUEST["uusleht"])) {
    $kask = $yhendus->prepare("INSERT INTO lehed (pealkiri, sisu, kuupaev) VALUES (?, ?, ?)");
    $kask->bind_param("sss", $_REQUEST["pealkiri"], $_REQUEST["sisu"], $_REQUEST["kuupaev"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
    exit();
}

// Обновление
if (isset($_REQUEST["muutmisid"])) {
    $kask = $yhendus->prepare("UPDATE lehed SET pealkiri=?, sisu=?, kuupaev=? WHERE id=?");
    $kask->bind_param("sssi", $_REQUEST["pealkiri"], $_REQUEST["sisu"], $_REQUEST["kuupaev"], $_REQUEST["muutmisid"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
    exit();
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Teated lehel</title>
    <style>
        /* (весь CSS как у тебя — без изменений) */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            display: flex;
        }

        #menyykiht {
            width: 220px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            box-sizing: border-box;
        }

        #menyykiht h2 {
            border-bottom: 1px solid #ecf0f1;
            padding-bottom: 10px;
        }

        #menyykiht ul {
            list-style-type: none;
            padding: 0;
        }

        #menyykiht li {
            margin: 10px 0;
        }

        #menyykiht a {
            color: #ecf0f1;
            text-decoration: none;
        }

        #menyykiht a:hover {
            color: #1abc9c;
        }

        #sisukiht {
            flex-grow: 1;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 20px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a.kustuta, a.muuda {
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }

        a.kustuta {
            background-color: #e74c3c;
        }

        a.kustuta:hover {
            background-color: #c0392b;
        }

        a.muuda {
            background-color: #27ae60;
        }

        a.muuda:hover {
            background-color: #1e8449;
        }

        form {
            margin-top: 40px;
            max-width: 600px;
            background-color: #ecf0f1;
            padding: 30px;
            border-radius: 8px;
        }

        input[type="text"], textarea, input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        #jalusekiht {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #888;
        }

        a.pealkiri-link {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 600;
        }

        a.pealkiri-link:hover {
            text-decoration: underline;
            color: #2980b9;
        }
    </style>
</head>
<body>

<div id="sisukiht">
    <?php if (isset($_GET["id"])): ?>
        <?php
        $kask = $yhendus->prepare("SELECT pealkiri, sisu, kuupaev FROM lehed WHERE id=?");
        $kask->bind_param("i", $_GET["id"]);
        $kask->bind_result($pealkiri, $sisu, $kuupaev);
        $kask->execute();
        if ($kask->fetch()):
            ?>
            <h2><?= htmlspecialchars($pealkiri) ?></h2>
            <p><strong>Kuupäev:</strong> <?= htmlspecialchars($kuupaev) ?></p>
            <p><?= nl2br(htmlspecialchars($sisu)) ?></p>
        <?php else: ?>
            <p>Teadet ei leitud.</p>
        <?php endif; ?>

    <?php elseif (isset($_GET["muutmine"])): ?>
        <?php
        $muutmineId = intval($_GET["muutmine"]);
        $kask = $yhendus->prepare("SELECT pealkiri, sisu, kuupaev FROM lehed WHERE id=?");
        $kask->bind_param("i", $muutmineId);
        $kask->bind_result($muut_pealkiri, $muut_sisu, $muut_kuupaev);
        $kask->execute();
        if ($kask->fetch()):
            ?>
            <form method="get" action="">
                <input type="hidden" name="muutmisid" value="<?= $muutmineId ?>" />
                <h2>Muuda teadet (ID: <?= $muutmineId ?>)</h2>

                <label>Pealkiri:</label>
                <input type="text" name="pealkiri" value="<?= htmlspecialchars($muut_pealkiri) ?>" required />

                <label>Sisu:</label>
                <textarea name="sisu" rows="6" required><?= htmlspecialchars($muut_sisu) ?></textarea>

                <label>Kuupäev:</label>
                <input type="date" name="kuupaev" value="<?= htmlspecialchars($muut_kuupaev) ?>" required />

                <input type="submit" value="Uuenda teadet" />
            </form>
        <?php endif; ?>

    <?php else: ?>
        <h1>Tabeli "lehed" sisu</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Pealkiri</th>
                <th>Sisu</th>
                <th>Kuupäev</th>
                <th>Kustuta</th>
                <th>Muuda</th>
            </tr>
            <?php
            $kask = $yhendus->prepare("SELECT id, pealkiri, sisu, kuupaev FROM lehed ORDER BY id DESC");
            $kask->bind_result($id, $pealkiri, $sisu, $kuupaev);
            $kask->execute();
            while ($kask->fetch()):
                ?>
                <tr>
                    <td><?= htmlspecialchars($id) ?></td>
                    <td><a class="pealkiri-link" href="?id=<?= $id ?>"><?= htmlspecialchars($pealkiri) ?></a></td>
                    <td><?= htmlspecialchars($sisu) ?></td>
                    <td><?= htmlspecialchars($kuupaev) ?></td>
                    <td><a class="kustuta" href="?kustuta=<?= $id ?>">Kustuta</a></td>
                    <td><a class="muuda" href="?muutmine=<?= $id ?>">Muuda</a></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <form method="get" action="">
            <input type="hidden" name="uusleht" value="jah" />
            <h2>Lisa uus teade</h2>

            <label>Pealkiri:</label>
            <input type="text" name="pealkiri" required />

            <label>Sisu:</label>
            <textarea name="sisu" rows="6" required></textarea>

            <label>Kuupäev:</label>
            <input type="date" name="kuupaev" required />

            <input type="submit" value="Lisa teade" />
        </form>
    <?php endif; ?>

    <div id="jalusekiht">
        <p>Lehe tegi Jaagup</p>
    </div>
</div>

</body>
</html>

<?php
$yhendus->close();
?>
