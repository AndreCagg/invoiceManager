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

    function printErr($code,$image,$style,$conf){
        require $conf;
        echo "<link rel='stylesheet' href='$style'>";
        echo "<div class='general'>";
            echo "<image src='$image' width='70px' height='70px'><br>";
            echo "<h2>ERROR CODE: ".$code.", LA LICENZA POTREBBE ESSERE SCADUTA O INATTIVA</h2>";
            echo "<title>!! ERROR !!</title>";
            echo "<p><i>Questo inconventiente potrebbe essere dovuto ad un semplice problema tecnico,<br>
            al mancato rinnovo della licenza o al ban della societ&agrave dai registri<br></i></p>";
            echo "<br>MATRICOLA: <p style='letter-spacing: 5px; display:inline;'><b>".$SN."</b></p><br><br>";
            echo "Made By ";
            echo "<div class='sign'>";
                echo "Andrea Caggiani";
            echo "</div>";
        echo "</div>";
    }

?>