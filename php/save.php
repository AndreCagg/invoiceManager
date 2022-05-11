<?php
    session_start();
    $day=$_POST["date"];
    $fatturare=$_POST["toDebit"];
    $accreditato=$_POST["toCredit"];
    $order=$_POST["order"];
    $invoice=$_POST["invoice"];
    $id=$_SESSION["supplier"];

    $conn=new mysqli("localhost","root","","invoicemanager");
    $stmt=$conn->prepare("UPDATE ordini SET day=?,fatturare=?,accreditato=? WHERE ordine=? AND numero=? AND fornitore=?");
    $stmt->bind_param("sddsii",$day,$fatturare,$accreditato,$order,$invoice,$id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION["last"]=date("d/m/Y H:i:s");
    header("Location: work.php");
?>