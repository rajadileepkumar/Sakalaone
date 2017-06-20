<?php
/*
 * Plugin Name:Wp Custom Register
 * Plugin URI:https://www.github.com/rajadileepkumar
 * Author:Raja Dileep Kumar
 * Author URI:https://www.github.com/rajadileepkumar
 * Description:User Custom Registration Form
 * Version:1.5
 */

if(!class_exists('Custom_Register_Subscriber')){
    class Custom_Register_Subscriber{

        public function __construct()
        {

        }
    }
}

$obj = new Custom_Register_Subscriber();
?>