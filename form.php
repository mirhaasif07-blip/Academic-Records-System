<?php
// DATABASE RESET (fresh run)
if(!isset($_POST['submit'])){
    file_put_contents("students.txt","");
}

if(isset($_POST['submit'])){

    $name   = trim($_POST['name']);
    $regno  = trim($_POST['regno']);
    $email  = trim($_POST['email']);
    $course = trim($_POST['course']);

    // WARNING ALERT
    if($name=="" || $regno=="" || $email=="" || $course==""){
        echo "<script>alert('⚠ Please fill all fields!');</script>";
    }
    else{

        $data = $name.",".$regno.",".$email.",".$course."\n";

        if(file_put_contents("students.txt",$data,FILE_APPEND)){
            echo "<script>
                    alert('✅ Registration Successful!');
                    window.location.href='students.php?status=added';
                  </script>";
        }
        else{
            echo "<script>alert('❌ Error saving data!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Registration</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(135deg,#1c92d2,#f2fcfe);
}

.header{
    background:#0f2027;
    color:white;
    padding:15px 25px;
    display:flex;
    justify-content:space-between;
}

.container{
    width:400px;
    margin:60px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

input,select{
    width:100%;
    padding:10px;
    margin:10px 0;
}

button{
    width:100%;
    padding:12px;
    background:#ff7a18;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

.back{
    background:#0f2027;
    margin-top:10px;
}
</style>
</head>

<body>

<div class="header">
<h2>Student Registration System</h2>
<div>By Mirha Asif — COSC231101012</div>
</div>

<div class="container">

<form method="POST">

<input type="text" name="name" placeholder="Full Name">
<input type="text" name="regno" placeholder="Registration Number">
<input type="email" name="email" placeholder="Email Address">

<select name="course">
<option value="">Select Course</option>
<option>Computer Science</option>
<option>Software Engineering</option>
<option>Information Technology</option>
<option>Artificial Intelligence</option>
</select>

<button type="submit" name="submit">Register Student</button>

</form>

<form action="students.php">
<button class="back">View Registered Students</button>
</form>

</div>
</body>
</html>