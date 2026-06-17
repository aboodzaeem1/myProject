    <?php
        include 'db.php';

        if(isset($_POST['save'])){
            $id = mysqli_real_escape_string($con, $_POST['id']);
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $address = mysqli_real_escape_string($con, $_POST['address']);
            $birth_date = $_POST['birth_date'];

    
            $check_query = "SELECT id FROM student WHERE id = '$id'";
            $check_res = mysqli_query($con, $check_query);

            if(mysqli_num_rows($check_res) > 0) {
     
                echo "<script>alert('خطأ: يوجد طالب مسجل مسبقاً بهذا الرقم!');</script>";
            }
             else {
        
                $sql = "INSERT INTO student (id, name, address, birth_date) VALUES ('$id', '$name', '$address', '$birth_date')";
        
                if(mysqli_query($con, $sql)){
                echo "<script>alert('تم تسجيل بياناتك بنجاح!');</script>";
            } 
                else {
                echo "<script>alert('خطأ في الحفظ: " . mysqli_error($con) . "');</script>";
            }
            }
        }
    ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <title>تسجيل بيانات الطالب</title>
    <style>
        .back-btn {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #7f8c8d;
            font-size: 15px;
            transition: color 0.3s;
        }
        .back-btn:hover {
            color: #34495e;
            text-decoration: underline;
        }
        body { 
            font-family: "Tajawal", sans-serif; 
            background-color: #f0f2f5; 
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .form-card { 
            background: white; 
            padding: 40px; 
            width: 100%;
            max-width: 400px;
            border-radius: 15px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
            text-align: center;
        }
        h2 { color: #2c3e50; margin-bottom: 25px; }
        input { 
            display: block; 
            width: 100%; 
            margin: 15px 0; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            box-sizing: border-box;
            font-size: 16px;
        }
        label { display: block; text-align: right; color: #7f8c8d; font-size: 14px; }
        button { 
            width: 100%; 
            padding: 12px; 
            background-color: #3498db; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-size: 18px; 
            font-weight: bold;
            margin-top: 20px;
            transition: background 0.3s;
        }
        button:hover { background-color: #2980b9; }
    </style>
</head>
<body>

    <div class="form-card">
        <h2>تسجيل بيانات طالب</h2>
        <form method="POST">
            <input type="number" name="id" placeholder="رقم هوية الطالب " required>
            <input type="text" name="name" placeholder="اسم الطالب" required>
            <input type="text" name="address" placeholder="العنوان" required>
            <label>تاريخ الميلاد:</label>
            <input type="date" name="birth_date" required>
            <button name="save">إرسال البيانات</button>
            <a href="login.php" class="back-btn">رجوع لصفحة الدخول</a>
        </form>
    </div>

</body>
</html>
