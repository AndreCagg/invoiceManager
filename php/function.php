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

?>