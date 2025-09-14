<?php
    require './models/payment.php';
    class PaymentController{
        private $modelPayment;
        public function __construct(){
            $this ->modelPayment = new Payment();
        }
    }