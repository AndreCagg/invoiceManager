<?php
    session_start();
    $SN="00000001";
    $_SESSION["productID"]=$SN;

    require_once("php/function.php");
    require_once("php/fornitore.php");

    $response=json_decode(file_get_contents("http://localhost:8080/PERSONALE/API/invoiceManager?code=10&sn=".$SN),true);
    echo "<link rel='icon' type='image/x-icon' href='others/invoiceIcon.ico'>";

    if($response["code"]=="100" && $response["mex"]["active"]){
        $_SESSION["active"]=true;
        echo "<title>SELEZIONA FORNITORE</title>";

        echo "<form action='php/work.php' method='post'>";
            echo "<fieldset>";
                echo "<legend>SELEZIONA FORNITORE</legend>";
                echo "FORNITORE&nbsp;&nbsp;";
                $supplier=getSupplier();
                echo "<select name='supplier'>";
                foreach($supplier as $k=>$v){
                    echo "<option value='".$supplier[$k]->getID()."'>".$supplier[$k]->getNome()."</option>";
                }
                echo "<option value='0000'>-- ALTRO --</option>";
                echo "</select>";
                echo "<br><br>NOME FORNITORE <input type='text' name='supplierName'>";
                echo "<br><br><input type='submit'>";
            echo "</fieldset>";
        echo "</form>";
    }else{
        $_SESSION["active"]=false;
        echo "<h2>ERROR CODE: ".$response["code"].", LA LICENZA POTREBBE ESSERE SCADUTA O INATTIVA</h2>";
        echo "<title>!! ERROR !!</title>";
    }
    echo "<br>MATRICOLA: <p style='letter-spacing: 5px; display:inline;'><b>".$SN."</b></p>";
?>