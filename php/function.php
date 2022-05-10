<?php

    require_once("fornitore.php");

    function getSupplier(){
        $conn=new mysqli("localhost","root","","invoicemanager");
        $result=$conn->query("SELECT * FROM fornitori");
        
        while($row=$result->fetch_array()){
            $rows[]=new Fornitore($row["id"],$row["nome"]);
        }

        $result->free();
        $conn->close();

        return $rows;
    }

    function getDoc($fornitore,$fattura,$ordine){
        $conn=new mysqli("localhost","root","","invoicemanager");
        $query="SELECT o.ordine,o.numero,o.day,o.fatturare,o.accreditato FROM ordini AS o,fornitori AS f,fornitori_ordini AS fo WHERE f.id=? AND fo.id_fattura=? AND fo.id_ordine=? AND f.id=fo.id_fornitore AND fo.id_ordine=o.ordine AND fo.id_fattura=o.numero";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("isi",$fornitore,$fattura,$ordine);
        $stmt->execute();
        $stmt->bind_result($ordine,$numFatt,$data,$fatturare,$accreditato);

        $stmt->close();
        $conn->close();

        $retVal=array("ord"=>$ordine,
        "fattura"=>$numFatt,
        "data"=>$data,
        "fatturare"=>$fatturare,
        "accreditato"=>$accreditato);

        print_r($retVal);
        return $retVal;
    }

?>