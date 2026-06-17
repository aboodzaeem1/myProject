<?php
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db   = 'student';
        $con  = mysqli_connect($host, $user, $pass, $db);

        if (!$con) {
        die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
        }
?>