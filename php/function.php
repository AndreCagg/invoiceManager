<?php
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

    function getWorkSupplier($id){
        $conn=new mysqli("localhost","root","","invoicemanager");
        $stmt=$conn->prepare("SELECT nome FROM fornitori WHERE id=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->bind_result($nome);

        while($stmt->fetch()){
            $retVal=$nome;
        }

        $stmt->close();
        $conn->close();

        return $nome;
    }

?>