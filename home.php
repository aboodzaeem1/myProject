<?php 
        session_start();
        if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

        include 'db.php';
        $res = mysqli_query($con, "select * from student");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;900;400;500;700;800;900&display=swap" rel="stylesheet">
    <title>لوحة التحكم</title>
    <style>
        .btn {
            padding: 5px 10px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            margin: 2px;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        .btn-edit {
            background-color: #27ae60;
            color: white;
        }
        .btn-edit:hover {
            background-color: #219150;
            transform: scale(1.05);
        }
        .top-header {
            width: 100%;
            background-color: #333;
            padding: 1px 3px;
            display: flex;
            justify-content: flex-end ;
            align-items: center;
            box-sizing: border-box;
            margin-bottom: 3px;
        }

        .logout-btn-top {
            background-color: #c0392b;
            color: white;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .logout-btn-top:hover {
            background-color: #e74c3c;
            box-shadow: 0 4px 8px rgba(192, 57, 43, 0.3);
            transform: translateY(-2px);
        }
        
        body { background-color: whitesmoke; 
            font-family: "Tajawal", sans-serif; 
        }
        
        #mother { width: 100%;
            font-size: 20px;
        }
        
        main { float:left;
            border: 1px solid gray; 
            padding:4px; 
            width: 70%;
        }

        aside { text-align: center; 
            width: 300px; 
            float: right; 
            border: 1px solid black; 
            padding: 1px;
            font-size:20px;
            background-color: silver; 
            color: white;
        }
        
         input { padding: 4px; 
            border: 2px solid black; 
            text-align: center; 
            margin-bottom: 10px; 
            font-size:15px;
            font-family: "Tajawal", sans-serif;
        }

        #tel { width:100%;
            font-size:20px;
            text-align: center;
            border-collapse: collapse;
        }
       
         #tel th { background-color: silver;
            color:black;
            font-size:20px;
            padding: 10px;
            text-align: center;
        }

        aside button { width: 190px; 
            padding: 8px;
            margin-top: 7px; 
            font-weight: bold; 
            font-size:17px;
            font-family: "Tajawal", sans-serif;
            font-weight:bold;
        }
          
    </style>
</head>
<body>

   <?php 
     
        $id='';
        $name='';
        $address='';
        $birth_date ='';

        if(isset($_POST['id'])){
            
            $id=$_POST['id'];
        }
        if(isset($_POST['name'])){

            $name=$_POST['name'];
        }
        if(isset($_POST['address'])){
            
            $address=$_POST['address'];
        }
        if(isset($_POST['birth_date'])){
        
            $birth_date=$_POST['birth_date'];
        }
        $search_query = "SELECT * FROM student";
            if (isset($_POST['search_btn']) && !empty($_POST['search'])) {
            $search_val = $_POST['search'];
        $search_query = "SELECT * FROM student WHERE name LIKE '%$search_val%'";
        }   

        $res = mysqli_query($con, $search_query);
        $sqls='';
        if(isset($_POST['add'])){
            $sqls ="insert into student (id, name , address , birth_date) values('$id','$name','$address','$birth_date')";
            mysqli_query($con,$sqls);
            header("location: home.php");
            }
            if(isset($_POST['del'])){
           $id_to_delete = $_POST['del'];
            $sqls = "DELETE FROM student WHERE id = '$id_to_delete'";
           mysqli_query($con, $sqls);
           header("Location: home.php");
          exit();
            }
    
        ?>
           <div class="top-header">
          <a href="logout.php" class="logout-btn-top">تسجيل الخروج</a>
          </div>    
            <div id='mother'>
            <form method='POST'>
                <!-- لوحة التحكم -->
                    <aside>
                        
            <div id='div'>
            <img src='https://i.pinimg.com/736x/ef/da/eb/efdaeb01c31ce7db01126a4d653443d9.jpg' alt='لوجو الموقع' width="200">
            <h3>لوحة المدير</h3>
            
            <label>رقم هوية الطالب:</label><br>
            <input type='number' min='1' name='id'><br>

            <label>اسم الطالب:</label><br>
            <input type='text' name='name'><br>
            
            <label>عنوان الطالب:</label><br>
            <input type='text' name='address'><br>

            <label>سنة الميلاد:</label><br>
            <input type='date' name='birth_date' min='1900' max='2026'><br>
            
            <button name='add'>إضافة طالب</button><br>
            
            <label>بحث عن اسم طالب:</label><br>
            <input type='text' name='search'><br>
            
            <button name='search_btn'>بحث</button>
            
             </div>
            </aside>
        <!-- عرض بيانات الطالب-->
        <main>
            
            <table id='tel'>
                <tr>
                    <th>الرقم الهوية  </th>
                    <th>اسم الطالب</th>
                    <th>عنوان الطالب</th>  
                    <th>سنة الميلاد</th> 
                    <th> الاجراءات</th>
                </tr>
       <?php
        while ($row = mysqli_fetch_array($res)){
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['birth_date'] . "</td>";
           echo "<td>
            <button type='submit' name='del' value='".$row['id']."' 
             onclick='return confirm(\"هل أنت متأكد من رغبتك في حذف هذا الطالب؟\");'
            class='btn btn-delete'>حذف</button>
            <a href='update.php?id=".$row['id']."'class='btn btn-edit'>تعديل</a>
        </td>";
            echo "</tr>";
        }
         ?>
            </table>
 
        </main>
    </form>
</div>

</body>
</html>
