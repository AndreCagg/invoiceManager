<?php
    require "php/function.php";

    echo "<title>SELEZIONA FORNITORE</title>";
    echo "<link rel='icon' type='image/x-icon' href='others/invoiceIcon.ico'>";

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
?>