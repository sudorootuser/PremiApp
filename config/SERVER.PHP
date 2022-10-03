<?php
/**------------------------------------------------
 * CREATION OF DB CONNECTION AND SECURITY TOKENS *
 *-----------------------------------------------*/
const SERVER = 'localhost'; 
const DB = 'premiapp'; 
const USER = 'root'; 
const PASS = '';


const SGBD = 'mysql:host=' . SERVER . ';dbname='. DB;

const METHOD = 'AES-256-CBC'; 
const SECRET_KEY = '$PREMIAPP@2022'; 
const SECRET_IV = '037970';
