<?php
    class Order{
        private $order;
        private $fattura;
        private $date;
        private $toDebit;
        private $toCredit;

        public function __construct($ordine,$numFatt,$date,$toDebit,$toCredit){
            $this->order=$ordine;
            $this->fattura=$numFatt;
            $this->date=$date;
            $this->toDebit=$toDebit;
            $this->toCredit=$toCredit;
        }

        public function getOrdine(){
            return $this->order;
        }

        public function getFattura(){
            return $this->fattura;
        }

        public function getDate(){
            return $this->date;
        }

        public function getToDebit(){
            return $this->toDebit;
        }

        public function getToCredit(){
            return $this->toCredit;
        }
    }
?>