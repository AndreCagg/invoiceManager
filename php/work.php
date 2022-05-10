<?php
    $supplier=$_POST["supplier"];
    $name=$_POST["supplierName"];

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
    $query="SELECT o.ordine,o.numero,o.data,o.fatturare,o.accreditato FROM ordini AS o,fornitori AS f,fornitori_ordini AS fo WHERE f.id=? AND f.id=fo.id_fornitore AND fo.id_ordine=o.ordine";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->bind_result($ordine,$numFatt,$data,$fatturare,$accreditato);

    echo "<form action='#' method='post'>&nbsp;&nbsp;";
    while($stmt->fetch()){
        //$obj[]=new Fornitore($row["id"],$row["nome"]);
        //echo $ordine." ".$num." ".$data." ".$fattura." ".$accred."<br>";
        echo "NUM. ORDINE <input type='text' name='order' size='9' value='".$ordine."'>&nbsp;&nbsp;";
        echo "NUM. FATT <input type='numer' name='invoice' size='4' value='".$numFatt."'>&nbsp;&nbsp;";
        echo "DATA <input type='date' name='date' value='".$data."'>&nbsp;&nbsp;";
        echo "DA FATTURARE <input type='number' name='toDebit' value='".$fatturare."'>&euro;&nbsp;&nbsp;";
        echo "DA ACCREDITARE <input type='numer' name='toCredit' value='".$accreditato."'>&euro;&nbsp;&nbsp;<br><br>&nbsp;&nbsp;";
    }
    echo "</form>";

    $stmt->close();
    $conn->close();
?>