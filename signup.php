<?php
session_start();
if($_SESSION){
if($_SESSION['level']=="Administrator")
{
header("Location: admin.php");
}
if($_SESSION['level']=="Member")
{
header("Location: member.php");
}
}
include('header.php'); //load header content for public users
include("connection.php"); // connection to database
?>
<div class="container" style="margin-top:50px">
<div class="content">
<h2>Sign Up &raquo;</h2>
<hr />
<?php
if(isset($_POST['btn-signup'])) {
$icno=mysqli_real_escape_string($connection,$_POST['icno']);

$username=mysqli_real_escape_string($connection,$_POST['username']);
$password=mysqli_real_escape_string($connection,$_POST['password']);
$password=md5($password); // Encrypted Password
$level = "Member";
$name=mysqli_real_escape_string($connection,$_POST['name']);
$gender=mysqli_real_escape_string($connection,$_POST['gender']);
$dob=mysqli_real_escape_string($connection,$_POST['dob']);
$address=mysqli_real_escape_string($connection,$_POST['address']);
$email=mysqli_real_escape_string($connection,$_POST['email']);
$telephone=mysqli_real_escape_string($connection,$_POST['telephone']);
$class=mysqli_real_escape_string($connection,$_POST['class']);
$status = "Inactive";
$position= "Member";
$check_icno = $connection->query("SELECT icno FROM user WHERE icno='$icno'");
$countic = $check_icno->num_rows;
$check_username = $connection->query("SELECT username FROM user WHERE username='$username'");
$countun = $check_username->num_rows;
if (($countic==0) && ($countun==0)){
$query = "INSERT INTO user(username,password,level,icno) VALUES ('$username','$password','$level','$icno')";
$query2 = "INSERT INTO student(icno, name, gender, dob, address, telephone, email, class, status, position) VALUES('$icno','$name', '$gender', '$dob', '$address', '$telephone', '$email', '$class', '$status', '$position')";
if ($connection->query($query) && $connection->query($query2)) {
$msg = "<div class='alert alert-success'>
<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully registered - User level is Member !
</div>";
} else {
$msg = "<div class='alert alert-danger'>
<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while registering !
</div>";
}
} else {
$msg = "<div class='alert alert-danger'>
<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Sorry.. Username or IC Number already exist!
</div>";
}
$connection->close();
}
?>
<!-- Form for collecting member data during signup -->
<form class="form-horizontal" action="" method="post">
<?php
if (isset($msg)) {
echo $msg;
}
?>
<div class="form-group">
<label class="col-sm-3 control-label">IC No</label>
<div class="col-sm-2">
<input type="text" name="icno" class="form-control" placeholder="IC No" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Username</label>
<div class="col-sm-2">

<input type="text" name="username" class="form-control" placeholder="Username" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Password</label>
<div class="col-sm-2">
<input type="password" name="password" class="form-control" placeholder="Password" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Name</label>
<div class="col-sm-4">
<input type="text" name="name" class="form-control" placeholder="Name" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Gender</label>
<div class="col-sm-2">
<select name="gender" class="form-control" required>
<option value="">- Select Gender -</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Date of Birth</label>
<div class="col-sm-3">
<input type="date" name="dob" class="input-group datepicker form-control" date="" data-date-format="dd-mm-yyyy" placeholder="DD-MM-YYYY" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Address</label>
<div class="col-sm-3">
<textarea name="address" class="form-control" placeholder="Address"></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Telephone No</label>
<div class="col-sm-3">
<input type="text" name="telephone" class="form-control" placeholder="Telephone No" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Email</label>
<div class="col-sm-3">
<input type="email" name="email" class="form-control" placeholder="Email" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Class</label>
<div class="col-sm-2">
<select name="class" class="form-control" required>
<option value="">- Select Class -</option>
<option value="Form 1">Form 1</option>
<option value="Form 2">Form 2</option>
<option value="Form 3">Form 3</option>
<option value="Form 4">Form 4</option>
<option value="Form 5">Form 5</option>
</select>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label"></label>
<div class="col-sm-2">
<button type="submit" class="btn btn-sm btn-primary" name="btn-signup">
<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
</button>
<hr />
<a href="login.php" class="btn btn-default">Log In Here</a>
</div>
</div>
</form>
</div> <!-- /.content -->
</div> <!-- /.container -->
<?php
include('footer.php');
?>