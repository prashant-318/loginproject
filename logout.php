<?php
require 'dbcon.php';
$_SESSION = [];
session_unset();
session_destroy();
header("Location: signin.php");