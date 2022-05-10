<?php
    $fornitore=$_GET["fornitore"];
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

    header("Location: work.php?new=1");
?>