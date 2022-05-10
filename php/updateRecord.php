<?php
    /*$fornitore=$_GET["fornitore"];
    $ordine=$_GET["ordine"];
    $fattura=$_GET["fattura"];
    
    
    $conn=new mysqli("localhost","root","","invoicemanager");
    $stmt=$conn->prepare("DELETE FROM fornitori_ordini WHERE id_fornitore=? AND id_ordine=? AND id_fattura=?");
    $stmt->bind_param("isi",$fornitore,$ordine,$fattura);
    $stmt->execute();
    
    $stmt=$conn->prepare("DELETE FROM ordini WHERE ordine=? AND numero=?");
    $stmt->bind_param("si",$ordine,$fattura);
    $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    header("Location: work.php?new=1");*/
    require_once("function.php");
    //estrazione dati
    //$info=getDoc($_GET["fornitore"],$_GET["fattura"],$_GET["ordine"]);
    echo "<form action='#' method='#'>";
        echo "<fieldset>";
            echo "<legend>MODIFICA DATI</legend>";
            echo "NUM. ORDINE<sup>*</sup> <input type='text' name='order' size='9' value='".$_GET["ordine"]."'>,&nbsp;&nbsp;";
            echo "NUM. FATT<sup>*</sup> <input type='numer' name='invoice' size='4' value='".$_GET["fattura"]."'>,&nbsp;&nbsp;";
            echo "DATA<sup>*</sup> <input type='date' name='date' value='".$_GET["data"]."'>,&nbsp;&nbsp;";
            echo "DA FATTURARE <input type='number' name='toDebit' value='".$_GET["fatturare"]."'>&euro;,&nbsp;&nbsp;";
            echo "ACCREDITATO <input type='numer' name='toCredit' value='".$_GET["accreditato"]."'>&euro;&nbsp;&nbsp;<br><br>";
            echo "<input type='submit' value='MODIFICA'>";
        echo "</fildset>";
    echo "</form>";
?>