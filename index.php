<?php
session_start();
if(empty($_SESSION['login'])){
    include 'view/forms/frmLogin.php';
}else{
    include 'view/forms/frmMain.php';
}