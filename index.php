<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP index leht</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="js/domik.js"></script>
    <script src="js/calculator.js"></script>
</head>
<body>

<!---------------------------------------------------------header------------------------------------------>
<?php
include("header.php");
?>
<!-----------------------------------------------------------nav-------------------------------------------->
<?php
include("nav.php");
?>
<!---------------------------------------------content kaustast failide sisud------------------------------>
<main>
<?php
    if(isset($_GET["leht"])){
        include('content/'.$_GET["leht"]);
    } else{
        include('content/avaleht.php');
        }
?>
</main>
<!--------------------------------------------------------PHP osa------------------------------------------>
<?php
    //php osa
echo "<h1>Meie esimene test</h1>";
echo "<br>";
$tekst="Esimene php tund";
echo $tekst;
echo "<br>";

?>
<!---------------------------------------------------------footer-------------------------------------------->
<?php
include("footer.php");
?>
</body>
</html>