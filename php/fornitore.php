<?php
    class Fornitore{
        private $nome;
        private $id;

        public function __construct($id,$nome){
            $this->nome=$nome;
            $this->id=$id;
        }

        public function getID(){
            return $this->id;
        }

        public function getNome(){
            return $this->nome;
        }
    }
?>