<?php
session_start();
// 1. حماية الصفحة: لا يدخلها إلا مدير مسجل
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// 2. معالجة التسجيل
if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    // تشفير كلمة المرور (مهم جداً للأمان)
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO admin_users (username, password) VALUES ('$username', '$password')";
    
    if(mysqli_query($con, $sql)){
        echo "<p style='color: green; text-align: center;'>تم تسجيل المدير الجديد بنجاح!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>خطأ: " . mysqli_error($con) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل مدير جديد</title>
    <style>
        /* يمكنك هنا إضافة تنسيق مشابه لصفحة تسجيل الدخول ليكون الشكل موحداً */
        body { font-family: "Tajawal", sans-serif; background: #f4f4f4; text-align: center; padding-top: 50px; }
        form { background: white; padding: 30px; display: inline-block; border-radius: 10px; }
        input { display: block; margin: 10px auto; padding: 10px; width: 250px; }
        button { padding: 10px 20px; background: #27ae60; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <form method="POST">
        <h2>تسجيل مدير جديد</h2>
        <input type="text" name="username" placeholder="اسم المستخدم" required>
        <input type="password" name="password" placeholder="كلمة المرور" required>
        <button name="register">إنشاء حساب</button>
        <br><br>
        <a href="home.php">العودة للوحة التحكم</a>
    </form>

</body>
</html>