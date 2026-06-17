        <?php
            session_start();
            if (!isset($_SESSION['admin'])) {
            header("Location: login.php");
            exit();
            }
            include 'db.php';
            if(isset($_GET['id'])){
             $id = $_GET['id'];
            $res = mysqli_query($con, "SELECT * FROM student WHERE id = '$id'");
            $data = mysqli_fetch_array($res);
            }
    ?>

    <!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
        <style>
            
            body { font-family: "Tajawal", sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; padding-top: 50px; }
            
            .update-form { 
                background: white; 
                padding: 55px; 
                border-radius: 10px; 
                box-shadow: 0 7px 8px rgba(1,1,1,0.1); 
                width: 350px; 
                text-align: center;
            }

            input { 
                width: 90%; 
                padding: 15px; 
                margin: 10px 0; 
                border: 2px solid #ddd;  
                font-size: 15px;
            }

            input:focus { border-color: #3498db; outline: none; }

            button { 
                width: 95%; 
                padding: 10px; 
                background-color: #27ae60; 
                color: white; 
                border: none; 
                border-radius: 10px;  
                font-size: 20px; 
                font-weight: bold;
            }
            
            button:hover { background-color: #219150; }
            h2 { color: #000000; }
            .back-btn {
                display: block;
                width: 92%;
            padding: 10px;
            margin-top: 10px;
                background-color: #7f8c8d; 
                color: white;
                text-decoration: none;
                border-radius: 10px;
                font-size: 19px;
                font-weight: bold;

            }

        </style>
    </head>
    <body>

        <div class="update-form">
            <form method="POST">
                <h2>تعديل بيانات الطالب</h2>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                
                <label>اسم الطالب:</label>
                <input type="text" name="name" value="<?php echo $data['name']; ?>" required>
                
                <label>عنوان الطالب:</label>
                <input type="text" name="address" value="<?php echo $data['address']; ?>" required>

                <label> تاريخ الميلاد :</label>
                <input type="date" name="birth_date" value="<?php echo $data['birth_date'];?>" required>
                
                <button name="update">حفظ التعديلات</button>
                <a href="home.php" class="back-btn">رجوع للقائمة</a>
            </form>
        </div>

    </body>
    </html>

    <?php
    if(isset($_POST['update'])){
        $new_name = mysqli_real_escape_string($con, $_POST['name']);
        $new_address = mysqli_real_escape_string($con, $_POST['address']);
        $id = $_POST['id'];
        
        $update_query = "UPDATE student SET name='$new_name', address='$new_address' WHERE id='$id'";
        mysqli_query($con, $update_query);
        header("location: home.php");
    }
    ?>