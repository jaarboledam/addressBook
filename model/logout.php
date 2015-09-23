<?php

session_start();
session_destroy();
header('Location: /mvc_project1/index.php');
exit();

