<?php
    echo "<h2>Aja Funktsioonid</h2>";
echo "<br>";
    echo "<br>";
        echo date_default_timezone_set('Europe/Tallinn'); // если там часы не переведены адекватно на сервере, то при установке часового пояса - всё нормально
    echo "<br>";
        echo "time() - aeg secundides".time();
    echo "<br>";
        echo "date() - aeg on: ".date('d.m.Y G:i:s', time()); //
    echo "<br>";
        echo "date('d.m.Y G:i:s', time())";
    echo "<br>";
        echo "d - day 1...31";
    echo "<br>";
        echo "m - month 01...12";
    echo "<br>";
        echo "Y - year neljakohane arv";
    echo "<br>";
        echo "G - 24-tundiline format";
    echo "<br>";
        echo "i - minute 0-59";
    echo "<br>";
        echo "s - secundsive format 0-59";
    echo "<br>";
        echo date('Y');
    echo "<br>";
echo "<br>";

echo "<strong>Tehted kuupäevaga</strong>";
    echo "<br>";
        echo "+1min: ".date('d.m.Y G:i:s', time()+60);
    echo "<br>";
        echo "+1h: ".date('d.m.Y G:i:s', time()+3600);
    echo "<br>";
        echo "+1 day: ".date('d.m.Y G:i:s', time()+60*60*24);
    echo "<br>";
echo "<br>";

echo "<strong>Kuupäeva genireerimine</strong>";
    echo "<br>";
        echo "mktime(h:i:s:m:d:y)";
    echo "<br>";
        echo "Minu sünnipäev: ";
    echo "<br>";
        $s = mktime(7,00,00,10,29,2004);
    echo "<br>";
        echo date('d.m.Y G:i:s', $s);
    echo "<br>";
echo "<br>";
?>

<div id="hooaeg">
    <h2>Kuvada hooajapilti (kevad,suvi,sygi,talv) vastavalt tänasele kuupäevale</h2>
    <?php
    $tana = new DateTime();
    echo "Täna on: ".$tana->format('d-m-Y');
    echo "<br>";
    $kevad = new DateTime('March 20');
    $suvi= new DateTime('June 21');
    $sygi= new DateTime('September 22');
    $talv= new DateTime('December 22');

    switch (true){

        case $kevad >= $kevad && $tana < $suvi:
            echo "Kevad";
            echo "<br>";
            $pilt = "content/img/kevad.png";
            break;
        case $suvi >= $suvi && $tana < $suvi:
            echo "Suvi";
            echo "<br>";
            $pilt = "content/img/suvi.png";
            break;
        case $sygi >= $sygi && $tana < $suvi:
            echo "Sügi";
            echo "<br>";
            $pilt = "content/img/sygi.png";
            break;
        case $talv >= $talv && $tana < $suvi:
            echo "Talv";
            echo "<br>";
            $pilt = "content/img/talv.png";
            break;
    }
    ?>
    <br>
    <img src="<?=$pilt?>" alt="hooaja pilt" width="1000">

</div>

<div>
    <br>
    <h2>Massiivi abil näidata kuu nimega tänases kuupäevas.</h2>
    <br>
    <?php
    $kuud = array(
        1 => 'jaanuar', 2 => 'veebruar', 3 => 'märts', 4 => 'aprill',
        5 => 'mai', 6 => 'juuni', 7 => 'juuli', 8 => 'august',
        9 => 'september', 10 => 'oktoober', 11 => 'november', 12 => 'detsember'
    );

    $paev = date('d');
    $aasta = date('Y');
    $kuu = $kuud[date('n')];

    echo "$paev. $kuu $aasta";
    ?>
    <br>
</div>

<div>
    <br>
    <h2>Найти сколько осталось до каникул - до 16.06.2025</h2>
    <br>
    <?php
    $tana = new DateTime(); // текущая дата
    $kanikul = new DateTime('2025-06-16'); // дата каникул
    $diff = $tana->diff($kanikul); // разница между датами
    echo "До каникул осталось: ".$diff->days. " дней.";
    ?>
    <br>
</div>

<div>
    <br>
    <h2>Сколько времени прошло с начала года</h2>
    <br>
    <?php
    $algus = new DateTime(date('Y') . '-01-01 00:00:00'); // начало года
    $tana = new DateTime(); // сейчас
    $vahe = $algus->diff($tana); // разница

    echo "С начала года прошло: ";
    echo $vahe->format('%m месяцев, %d дней, %h часов, %i минут и %s секунд');
    ?>
    <br>
</div>


