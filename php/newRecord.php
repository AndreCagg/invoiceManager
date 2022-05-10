<?php
    session_start();
    $conn=new mysqli("localhost","root","","invoicemanager");

    //tabella ordini
    $numOrd=$_POST["order"];
    $fattura=$_POST["invoice"];
    $date=$_POST["date"];
    $toDebit=$_POST["toDebit"];
    $toCredit=$_POST["toCredit"];

    if(!empty($numOrd) && !empty($fattura) && $date!="0000-00-00"){

        $query="INSERT INTO ordini (ordine,numero,day,fatturare,accreditato) VALUES (?,?,?,?,?); -- WHERE NOT EXISTS (SELECT ordine FROM ordini WHERE ordine=? AND numero=?)";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("sisdd",$numOrd,$fattura,$date,$toDebit,$toCredit);
        $stmt->execute();

        //tabella convenzionale
        $supplierID=$_SESSION["supplierID"];
        $stmt=$conn->prepare("INSERT INTO fornitori_ordini (id_fornitore,id_ordine,id_fattura) VALUES (?,?,?); -- WHERE NOT EXISTS (SELECT id_fornitore FROM fornitori_ordini WHERE id_fornitore=? AND id_ordine=? AND id_fattura=?)");
        $stmt->bind_param("isi",$supplierID,$numOrd,$fattura);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        header("Location: work.php?new=1");
    }else{
        echo "<h2>DEVI COMPILARE TUTTI I CAMPI OBBLIGATORI (*)</h2><br>";
        echo "<button><a href='work.php?new=1'>INDIETRO</a></button>";
    }
?>