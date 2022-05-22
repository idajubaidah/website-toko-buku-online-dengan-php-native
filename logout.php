<?php
session_start();

//menghancurkan $_SESSION ['customer']
session_destroy();

echo "<script>alert('Anda telah logout');</script>";
echo "<script>location='login.php';</script>";