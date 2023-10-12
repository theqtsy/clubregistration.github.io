<?php
session_start();
$error='';
include('header.php'); //load header content for public users
include "connection.php";
?>
<div class="container" style="margin-top:50px">
<div class="content">
<h2>Login &raquo;</h2>
<hr />
<?php
if(isset($_POST['btn-login']))
{
$username = mysqli_real_escape_string($connection,$_POST['username']);
$password = mysqli_real_escape_string($connection,$_POST['password']);
$passcode = md5($password); // Encrypted Password
$sql = "SELECT * FROM user WHERE username='$username' and password='$passcode'";
$query = mysqli_query($connection,$sql);
$row = $query->fetch_array();
$count = $query->num_rows; // if email/password are correct returns must be 1 row
if ($count == 1)
{
$_SESSION['username']=$row['username'];
$_SESSION['level'] = $row['level'];
$_SESSION['icno'] = $row['icno'];
if($row['level'] == "Administrator")
{
header("Location: admin.php");
}
else if($row['level'] == "Member")
{
header("Location: member.php");
}
}
else
{
$msg = "<div class='alert alert-danger'>
<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Username or Password is invalid !
</div>";
}
$connection->close();
}
?>
<!-- Form for collecting member data during login -->
<form class="form-horizontal" action="" method="post">
<?php
if (isset($msg)) {
echo $msg;
}
?>
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
<label class="col-sm-3 control-label"></label>
<div class="col-sm-2">
<button type="submit" class="btn btn-default" name="btn-login">
<span class="glyphicon glyphicon-log-in"></span> &nbsp; Login
</button>
</div>
</div>
</form>
</div> <!-- /.content -->
</div> <!-- /.container -->
<?php
include('footer.php');
?>