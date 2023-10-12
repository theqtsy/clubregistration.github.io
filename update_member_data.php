<?php
session_start();
$icno = $_SESSION['icno'];
//check if user has login
include('check_member.php'); //check if member logged in
include('header_member.php'); //load header content for member page
include("connection.php"); // connection to database
?>
<div class="container" style="margin-top:50px">
<div class="content">
<h2>Update Member Data &raquo;</h2>
<hr />
<?php
$sql = mysqli_query($connection, "SELECT * FROM student WHERE icno='$icno'"); // query for select member by ic number
if(mysqli_num_rows($sql) == 1){
$row = mysqli_fetch_assoc($sql);
}
if(isset($_POST['update']))
{ // if button Update clicked
$name = $_POST['name'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$class = $_POST['class'];
$update = mysqli_query($connection, "UPDATE student SET name='$name', gender='$gender', dob='$dob', address='$address', telephone='$telephone', email='$email', class='$class' WHERE icno='$icno'") or die(mysqli_error()); // query for update data into database
if($update)
{ // if query executed successfully
header("Location: update_member_data.php?icno=".$icno);
echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Update successful.. <a href="member.php"><- Back</a></div>'; // display message data updated successfully.'
}else{ // if query unsuccessfull
echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Cannot update data! <a href="member.php"><- Back</a></div>'; // display message data unsuccessfull added!'
}
}
?>
<!-- Form for collecting member data -->
<form class="form-horizontal" action="" method="post">
<div class="form-group">
<label class="col-sm-3 control-label">IC No</label>
<div class="col-sm-2">
<input type="text" name="icno" class="form-control" value="<?php echo $icno; ?>" disabled>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Name</label>
<div class="col-sm-4">
<input type="text" name="name" class="form-control" value="<?php echo $row ['name']; ?>" placeholder="Name" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Gender</label>
<div class="col-sm-2">
<select name="gender" class="form-control" required>
<option value="">- Select Gender -</option>
<option <?php if($row['gender']=="Male") {echo "selected";}?>>Male</option>
<option <?php if($row['gender']=="Female") {echo "selected";}?>>Female</option> </select>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Date of Birth</label>
<div class="col-sm-3">
<input type="text" name="dob" value="<?php echo $row ['dob']; ?>" class="input-group datepicker form-control" date="" data-date-format="dd-mm-yyyy" placeholder="DD-MM-YYYY" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Address</label>
<div class="col-sm-3">
<textarea name="address" class="form-control" placeholder="Address"><?php echo $row ['address']; ?></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Telephone No</label>
<div class="col-sm-3">
<input type="text" name="telephone" value="<?php echo $row ['telephone']; ?>" class="form-control" placeholder="Telephone No" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Email</label>
<div class="col-sm-3">
<input type="email" name="email" value="<?php echo $row ['email']; ?>" class="form-control" placeholder="Email" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Class</label>
<div class="col-sm-2">
<select name="class" class="form-control" required>
<option value="">- Select Class -</option>
<option <?php if($row['class']=="Form 1") {echo "selected";}?>>Form 1</option>
<option <?php if($row['class']=="Form 2") {echo "selected";}?>>Form 2</option>
<option <?php if($row['class']=="Form 3") {echo "selected";}?>>Form 3</option>
<option <?php if($row['class']=="Form 4") {echo "selected";}?>>Form 4</option>
<option <?php if($row['class']=="Form 5") {echo "selected";}?>>Form 5</option> </select>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">&nbsp;</label>
<div class="col-sm-6">
<input type="submit" name="update" class="btn btn-sm btn-primary" value="Update" data-toggle="tooltip" title="Update Data">
<a href="member.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Cancel">Cancel</a>
</div>
</div>
</form> <!-- /form -->
</div> <!-- /.content -->
</div> <!-- /.container -->
<script>
$('.datepicker').datepicker({
format: 'dd-mm-yyyy',
})
</script>
<?php
include('footer.php');
?>