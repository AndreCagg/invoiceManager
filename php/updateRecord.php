<?php
    echo "<link rel='icon' type='image/x-icon' href='../others/invoiceIcon.ico'>";
    echo "<title>MODIFICA</title>";
    session_start();
    if(!$_SESSION["active"]){
        header("Location: ../");
    }
    
    require_once("function.php");
    //estrazione dati
    echo "<form action='save.php' method='post'>";
        echo "<fieldset>";
            echo "<legend>MODIFICA DATI</legend>";
            echo "NUM. ORDINE<sup>*</sup> <input readonly='readonly' type='text' name='order' size='9' value='".$_GET["ordine"]."'>,&nbsp;&nbsp;";
            echo "NUM. FATT<sup>*</sup> <input readonly='readonly' type='numer' name='invoice' size='4' value='".$_GET["fattura"]."'>,&nbsp;&nbsp;";
            echo "DATA<sup>*</sup> <input type='date' name='date' value='".$_GET["data"]."'>,&nbsp;&nbsp;";
            echo "DA FATTURARE <input type='number' name='toDebit' value='".$_GET["fatturare"]."' min='0' max='100000' step='0.01'>&euro;,&nbsp;&nbsp;";
            echo "ACCREDITATO <input type='number' name='toCredit' value='".$_GET["accreditato"]."' min='0' max='100000' step='0.01'>&euro;&nbsp;&nbsp;<br><br>";
            echo "<button><a href='work.php'>INDIETRO</a></button>&nbsp;";
            echo "<input type='submit' value='MODIFICA'>";
        echo "</fildset>";
    echo "</form>";
    $_SESSION["last"]=date("d/m/Y H:i:s");
?>