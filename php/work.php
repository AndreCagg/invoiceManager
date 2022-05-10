<?php
    require_once("order.php");
    session_start();

    if(isset($_POST["supplier"])){
        $supplier=$_POST["supplier"];
        $name=$_POST["supplierName"];
    
        $_SESSION["supplier"]=$supplier;
        $_SESSION["name"]=$name;
    }else{
        $supplier=$_SESSION["supplier"];
        $name=$_SESSION["name"];
    }

    if($supplier=="0000"){
        $conn=new mysqli("localhost","root","","invoicemanager");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
        }
        $stmt=$conn->prepare("INSERT INTO fornitori (nome) VALUES(?)");
        $stmt->bind_param("s",$name);
        $stmt->execute();

        $id=$conn->insert_id;

        $stmt->close();
        $conn->close();
    }else{
        $id=$supplier;
    }

    $conn=new mysqli("localhost","root","","invoicemanager");
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
    }
    $query="SELECT DISTINCT o.ordine,o.numero,o.day,o.fatturare,o.accreditato FROM ordini AS o,fornitori AS f,fornitori_ordini AS fo WHERE f.id=? AND f.id=fo.id_fornitore AND fo.id_ordine=o.ordine";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->bind_result($ordine,$numFatt,$data,$fatturare,$accreditato);

    echo "<form action='newRecord.php' method='post'>&nbsp;&nbsp;";
    while($stmt->fetch()){
        echo "NUM. ORDINE<sup>*</sup> <input type='text' name='order' size='9' value='".$ordine."'>&nbsp;&nbsp;";
        echo "NUM. FATT<sup>*</sup> <input type='numer' name='invoice' size='4' value='".$numFatt."'>&nbsp;&nbsp;";
        echo "DATA<sup>*</sup> <input type='date' name='date' value='".$data."'>&nbsp;&nbsp;";
        echo "DA FATTURARE <input type='number' name='toDebit' value='".$fatturare."'>&euro;&nbsp;&nbsp;";
        echo "DA ACCREDITARE <input type='numer' name='toCredit' value='".$accreditato."'>&euro;&nbsp;&nbsp;<br><br>&nbsp;&nbsp;";
    }
    $_SESSION["supplierID"]=$id;

    if(isset($_GET["new"])){
        echo "NUM. ORDINE<sup>*</sup> <input type='text' name='order' size='9'>&nbsp;&nbsp;";
        echo "NUM. FATT<sup>*</sup> <input type='numer' name='invoice' size='4'>&nbsp;&nbsp;";
        echo "DATA<sup>*</sup> <input type='date' name='date'>&nbsp;&nbsp;";
        echo "DA FATTURARE <input type='number' name='toDebit'>&euro;&nbsp;&nbsp;";
        echo "DA ACCREDITARE <input type='numer' name='toCredit'>&euro;&nbsp;&nbsp;<br><br>&nbsp;&nbsp;";
    }
    echo "<input type='submit' value='SALVA + NUOVA RIGA'>";
    echo "</form>";

    $stmt->close();
    $conn->close();
?>