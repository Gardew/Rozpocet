<?php
session_start();
// Vytvoření připojení
$pripojeni = new mysqli("localhost","root","","rozpocetDB");

// Kontrola připojení
if ($pripojeni->connect_error) {
  die("Chyba připojení: " . $pripojeni->connect_error);
}
$cely_rozpocet = 0;
$aktualizace = false;
$id=0;
$jmeno = '';
$castka = '';

if(isset($_POST['save'])){
       
    $rozpocet = $_POST['rozpocet'];
    $castka = $_POST['castka'];

    $dotaz = mysqli_query($pripojeni, "INSERT INTO budget (jmeno, hodnota) VALUE ('$rozpocet', '$castka')"); 
        
    $_SESSION['zprava'] = "Záznam byl uložen!";
    $_SESSION['typ_zpravy'] = "primary";

    header("location: index.php?result=true");
}

// Výpočet celkového rozpočtu
$vysledek = mysqli_query($pripojeni, "SELECT * FROM budget");
while($radek = $vysledek->fetch_assoc()){
    $cely_rozpocet = $cely_rozpocet + $radek['hodnota'];
}

// Smazání dat
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $dotaz = mysqli_query($pripojeni, "DELETE FROM budget WHERE id=$id");
    $_SESSION['zprava'] = "Záznam byl smazán!";
    $_SESSION['typ_zpravy'] = "danger";

    header("location: index.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $aktualizace = true;
    $vysledek = mysqli_query($pripojeni, "SELECT * FROM budget WHERE id=$id");

    if( mysqli_num_rows($vysledek) == 1){
        $radek = $vysledek->fetch_assoc();
        $jmeno = $radek['jmeno'];
        $castka = $radek['hodnota'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $rozpocet = $_POST['rozpocet'];
    $castka = $_POST['castka'];

    $dotaz = mysqli_query($pripojeni, "UPDATE budget SET jmeno='$rozpocet', hodnota='$castka' WHERE id='$id'");
    $_SESSION['zprava'] = "Záznam byl aktualizován!";
    $_SESSION['typ_zpravy'] = "success";
    header("location: index.php");
}
?>
