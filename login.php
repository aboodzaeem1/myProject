<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <title>تسجيل الدخول - لوحة التحكم</title>
    <style>
        body { 
            background-color: #f4f7f6; 
            font-family: "Tajawal", sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        
        .login-card { 
            
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
            width: 350px; 
            text-align: center; 
            border-top: 5px solid #2c3e50;
                }

        h2 { color: #2c3e50; }

        input { 
            width: 100%; 
            padding: 12px; 
            margin: 10px 0; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
            box-sizing: border-box; 
        }

        button { 
            width: 100%; 
            padding: 12px; 
            background-color: #2c3e50;
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-weight: bold; 
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover { background-color: #34495e; }
        
        .error { color: #e74c3c; font-size: 14px; margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="login-card">
        <div style="font-size: 30px; margin-bottom: 10px;">👤</div>
        <h2>دخول المدير</h2>
        <form action='' method='post'>
            <input type='text' name='username' placeholder='اسم المستخدم' required>
            <input type='password' name='password' placeholder='كلمة المرور' required>
            <button type='submit' name='submit'>تسجيل الدخول</button>
            <label>اختر نوع الدخول:</label>
        <select name="user_type" style="width: 100%; padding: 10px; margin: 10px 0;">
            <option value="admin">مدير</option>
            <option value="student">طالب</option>
        </select>
        </form>

     <?php
        session_start();
        include 'db.php';

    if (isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_type = $_POST['user_type'];

            if ($user_type == 'admin') {
    
            if (($username == 'abood') && ($password == '2332005')){
            $_SESSION['admin'] = $username;
            header("Location: home.php");
            exit();
            }
            else {
            $error = "بيانات المدير غير صحيحة";
            }
            } 
    
            else if ($user_type == 'student') {
    
            header("Location: student_register.php"); 
            exit();
            }
        }
    ?>
    </div>

</body>
</html>