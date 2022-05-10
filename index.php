<?php
    require "php/function.php";

    echo "<title>SELEZIONA FORNITORE</title>";
    $supplier=getSupplier();
    echo "<select name='supplier'>";
    foreach($supplier as $k=>$v){
        echo "<option value='".$supplier[$k]->getID()."'>".$supplier[$k]->getNome()."</option>";
    }
    echo "</select>";
?>