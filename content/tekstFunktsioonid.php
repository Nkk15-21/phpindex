
<?php

function clearVarsExcept($url, $varname) {
    // basename - makes the link relative, url must contain a filename that it returns basename('http://www.ee/index.php') > index.php
    $url = basename($url);
    if (str_starts_with($url, "?")) {
        return "?$varname=".$_REQUEST[$varname];
    }
    // strtok - returns first token after spliting on separator "?" strtoken('index.php?haha=lala', '?') > index.php
    return strtok($url, "?")."?$varname=".$_REQUEST[$varname];
}

$tekst = "PHP on scriptkeel serveri pool";
echo "<h2>Tekst funktsioonid</h2>";
echo $tekst;
echo "<br>";
echo "Teksti pikkus (strlen) on ".strlen($tekst). " tähte";
echo "<br>";
echo "Esimesed 6 tähte on (substr) : ".substr($tekst,0,6);
echo "<br>";
echo "Alates 6 tähtest on (substr) : ".substr($tekst,6);
echo "<br>";
echo "Sõnade arv lauses on (str_word_count) : ".str_word_count($tekst). "tk";
echo "<br>";
echo "Esimese tühiku asukoht on (strpos) - ".strpos($tekst, " "). " sümbolid"; // сначада где искать, а потом что искать
echo "<br>";
echo "Kõik sümblolid peale esimese tühiku (substr(tekst, strpos(tekst, пробел))): ".substr($tekst, strpos($tekst, " "));
echo "<br>";
echo "Kõik tähted on väiksed (strtolower) - ".strtolower($tekst);
echo "<br>";
echo "Kõik tähted on suured (strtoupper) - ".strtoupper($tekst);
echo "<br>";
echo "Iga sõna lauses algab syyre tähtega (ucwords) - ".ucwords($tekst);
echo "<br>";
echo "Mõistatus. Õppeaine.";
echo "<br>";

$aine = "Veebirakenduste loomise alused";
    echo "<ol>"; // ol - числовой список
        echo "<li>";
            echo "Обратный порядок символов в названии предмета: " . strrev($aine);
        echo "</li>";
        echo "<li>";
            echo "Текст, начиная с 5-го символа: " . substr($aine, 4);
        echo "</li>";
        echo "<li>";
            echo "Сколько раз встречается буква 'e': " . substr_count($aine, "e");
        echo "</li>";
        echo "<li>";
            echo "Заменим все пробелы на тире: " . str_replace(" ", "-", $aine);
        echo "</li>";
        echo "<li>";
            echo "Текст с удалением всех гласных: " . preg_replace("/[aeiouAEIOU]/", "", $aine);
        echo "</li>";
        echo "<li>";
            echo "Извлечем первые 3 слова: " . implode(" ", array_slice(explode(" ", $aine), 0, 3));
        echo "</li>";
    echo "</ol>";

echo "<h2>Vastutuse kontroll</h2>";

?>

    <form name="aine" action="<?=clearVarsExcept(basename($_SERVER['REQUEST_URI']), "leht")?>" method="post">
        <label for="aine">Õppeaine</label>
        <input name="aine" id="aine">
        <br><br>
        <input type="submit" value="Kontrolli">
    </form>

<?php
if (isset($_REQUEST['aine'])) {
    if ($_REQUEST['aine'] == $aine) {
        echo "Маладэц!";
        echo "<body style='background-color:lightgreen'>";
    } else {
        echo "Попробуй ещё!";
        echo "<body style='background-color:lightcoral'>";
    }
}
echo "<br>";