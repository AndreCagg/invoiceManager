<?php
    session_start();
    $fornitore=$_GET["fornitore"];
    $ordine=$_GET["ordine"];
    $fattura=$_GET["fattura"];
    $id=$_SESSION["supplierID"];

    $conn=new mysqli("localhost","root","","invoicemanager");
    $stmt=$conn->prepare("DELETE FROM ordini WHERE ordine=? AND numero=? AND fornitore=?");
    $stmt->bind_param("sii",$ordine,$fattura,$id);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    $_SESSION["last"]=date("d/m/Y H:i:s");
    header("Location: work.php");
?>