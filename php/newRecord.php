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
        $id=$_SESSION["supplier"];
        $query="INSERT INTO ordini (fornitore,ordine,numero,day,fatturare,accreditato) VALUES (?,?,?,?,?,?)";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("isisdd",$id,$numOrd,$fattura,$date,$toDebit,$toCredit);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        $_SESSION["last"]=date("d/m/Y H:i:s");
        header("Location: work.php?new=1");
    }else{
        echo "<h2>DEVI COMPILARE TUTTI I CAMPI OBBLIGATORI (*)</h2><br>";
        echo "<button><a href='work.php?new=1'>INDIETRO</a></button>";
    }
?>