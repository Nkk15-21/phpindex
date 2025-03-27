<?php
// eemalda urlist muutujad
function clearVarsExcept($url, $varname) {
    return strtok(basename($_SERVER['REQUEST_URI']),"?")."?$varname=".$_REQUEST[$varname];
}
echo "<h2>Matemaatika Tehted</h2>";
echo "<a href='https://www.metshein.com/unit/php-matemaatilised-tehted-ulesanne-2/'>
PHP matemaatelised tehted</a>";

// Mõistatus
echo "<h2>Загадали два числа до ....</h2>";
$arv1 = 10;
$arv2 = 5;

echo "<ul>";
echo "<li>Если сложить оба числа, то получится число == " . ($arv1 + $arv2) . "</li>";
echo "<li>Если из первого числа вычесть второе, то получится второе число == " . ($arv1 - $arv2) . "</li>";
echo "<li>Если первое число умножить на второе, то получится число в пять раз первого числа == " . ($arv1 * $arv2) . "</li>";
echo "<li>Если первое число разделить на второе число, то получится число в 2,5 раза меньше второго числа == " . ($arv1 / $arv2) . "</li>";
echo "<li>При делении первого числа на второе то остаток будет равен == " . ($arv1 % $arv2) . "</li>";
echo "<li>При умножении первого числа на 0,5 второе число будет равно == " . ($arv1 * 0.5) . "</li>";
echo "<li>Разница между первым числом и вторым после вычитания == " . ($arv1 - $arv2) . "</li>";
echo "</ul>";

echo "<h2>Vastutuse kontroll</h2>";
?>

    <form name="arvud" action="<?=clearVarsExcept(basename($_SERVER['REQUEST_URI']), "leht")?>" method="post">
        <label for="arv1">Arv1</label>
        <input type="number" name="arv1" id="arv1" min="0" max="10" step="1">
        <br>
        <label for="arv2">Arv2</label>
        <input type="number" name="arv2" id="arv2" min="0" max="10" step="1">
        <br><br>
        <input type="submit" value="Kontrolli">
    </form>

<?php
if (isset($_REQUEST['arv1']) && isset($_REQUEST['arv2'])) {
    if ($_REQUEST['arv1'] == $arv1 && $_REQUEST['arv2'] == $arv2) {
        echo "Маладэц!";
        echo "<body style='background-color:lightgreen'>";
    } else {
        echo "Попробуй ещё!";
        echo "<body style='background-color:lightcoral'>";
    }
}
echo "<br>";
highlight_file('matem.php');