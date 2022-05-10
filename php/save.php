<?php
    session_start();
    $day=$_POST["date"];
    $fatturare=$_POST["toDebit"];
    $accreditato=$_POST["toCredit"];
    $order=$_POST["order"];
    $invoice=$_POST["invoice"];

    $conn=new mysqli("localhost","root","","invoicemanager");
    $stmt=$conn->prepare("UPDATE ordini SET day=?,fatturare=?,accreditato=? WHERE ordine=? AND numero=?");
    $stmt->bind_param("sddsi",$day,$fatturare,$accreditato,$order,$invoice);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION["last"]=date("d/m/Y H:i:s");
    header("Location: work.php");
?>