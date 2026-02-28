<?php

$students = file("students.txt", FILE_IGNORE_NEW_LINES);

// DELETE CONFIRM
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    unset($students[$id]);
    file_put_contents("students.txt",implode("\n",$students));
    header("Location: students.php?status=deleted");
    exit();
}

// UPDATE
if(isset($_POST['update'])){

    $id=$_POST['id'];

    $students[$id] =
        $_POST['name'].",".
        $_POST['regno'].",".
        $_POST['email'].",".
        $_POST['course'];

    file_put_contents("students.txt",implode("\n",$students));

    header("Location: students.php?status=updated");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Students List</title>

<style>
body{
    font-family:Arial;
    background:#f4f7fb;
    text-align:center;
}

.header{
    background:#0f2027;
    color:white;
    padding:15px;
}

table{
    margin:auto;
    width:90%;
    border-collapse:collapse;
    background:white;
}

th,td{
    padding:10px;
    border:1px solid #ddd;
}

th{
    background:#0f2027;
    color:white;
}

a{
    padding:6px 10px;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

.edit{background:#17a2b8;}
.delete{background:#dc3545;}

button{
    padding:10px 15px;
    margin:15px;
    background:#ff7a18;
    color:white;
    border:none;
    border-radius:6px;
}
</style>
</head>

<body>

<div class="header">
<h2>Registered Students</h2>
</div>

<?php
// STATUS ALERTS
if(isset($_GET['status'])){
    if($_GET['status']=="added"){
        echo "<script>alert('✅ Student Added Successfully');</script>";
    }
    if($_GET['status']=="updated"){
        echo "<script>alert('✏ Student Updated Successfully');</script>";
    }
    if($_GET['status']=="deleted"){
        echo "<script>alert('❌ Student Deleted Successfully');</script>";
    }
}
?>

<!-- EDIT FORM -->
<?php
if(isset($_GET['edit'])){
$id=$_GET['edit'];
$data=explode(",",$students[$id]);
?>

<form method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>">

<input type="text" name="name" value="<?php echo $data[0]; ?>">
<input type="text" name="regno" value="<?php echo $data[1]; ?>">
<input type="email" name="email" value="<?php echo $data[2]; ?>">
<input type="text" name="course" value="<?php echo $data[3]; ?>">

<button name="update">Update Student</button>
</form>

<?php } ?>

<table>
<tr>
<th>#</th>
<th>Name</th>
<th>Reg No</th>
<th>Email</th>
<th>Course</th>
<th>Action</th>
</tr>

<?php
foreach($students as $index=>$line){

$data=explode(",",$line);

echo "<tr>
<td>".($index+1)."</td>
<td>$data[0]</td>
<td>$data[1]</td>
<td>$data[2]</td>
<td>$data[3]</td>
<td>
<a class='edit' href='students.php?edit=$index'>Edit</a>
<a class='delete' onclick=\"return confirm('Delete this student?')\" href='students.php?delete=$index'>Delete</a>
</td>
</tr>";
}
?>

</table>

<form action="form.php">
<button>⬅ Back to Registration Form</button>
</form>

</body>
</html>