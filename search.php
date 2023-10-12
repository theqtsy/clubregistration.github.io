<?php
include('check_admin.php'); //check if user if an administrator
include('header_admin_name.php'); //load header content for admin page
include("connection.php"); // connction to database
?>
<div class="container" style="margin-top:50px">
<div class="content">
<?php $name = $_POST['searchName']; // name from text box search form ?>
<h2>Searching for &raquo; Name: <?php echo $name; // name ?></h2>
<hr />
<br />
<!-- start responsive table-->
<div class="table-responsive">
<table class="table table-striped table-hover">
<tr>
<th>No</th>
<th>IC No</th>
<th>Name</th>
<th>Gender</th>
<th>Class</th>
<th>Position</th>
<th>Status</th>
<th>Tools</th>
</tr>
<?php
$sql = mysqli_query($connection, "SELECT * FROM student WHERE name LIKE '%$name%'"); // query -filter
if(mysqli_num_rows($sql) == 0){
echo '<tr><td colspan="14">No data retrieved..</td></tr>'; // if no data retrieved from database
}else{ // if there are data
$no = 1; // start from number 1
while($row = mysqli_fetch_assoc($sql)){ // fetch query into array
echo '
<tr>
<td>'.$no.'</td>
<td>'.$row['icno'].'</td>
<td><a href="profile.php?icno='.$row['icno'].'">'.$row['name'].'</a></td>
<td>'.$row['gender'].'</td>
<td>'.$row['class'].'</td>
<td>'.$row['position'].'</td>
<td>'.$row['status'].'</td>
<td>
<a href="edit.php?icno='.$row['icno'].'" title="Update Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
<a href="reset_password.php?icno='.$row['icno'].'" title="Change Password" data-toggle="tooltip" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
<a href="view_users.php?action=delete&icno='.$row['icno'].'" title="Remove Data" data-toggle="tooltip" onclick="return confirm(\'Are you sure to remove this data for '.$row['name'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
</td>
</tr>
';
$no++; // next number
}
}
?>
</table>
</div> <!-- /.table-responsive -->
</div> <!-- /.content -->
</div> <!-- /.container -->
</body>
</html>