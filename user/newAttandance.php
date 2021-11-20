<?php include '../functions.php'; 
	if (!isLoggedIn()){
    header('location: ../login.php');
  }
    $IdKelas=$_SESSION['user']['idKelas'];
$id=$_SESSION['user']['idGuru'];
$kelas = mysqli_query($db, "SELECT * FROM kelas WHERE idKelas='$IdKelas' LIMIT 1");
  $arr4 = mysqli_fetch_assoc($kelas);
    $results = mysqli_query($db, "SELECT idPelajar, g.nama, g.alamat, namaKelas, g.notelefon, g.idKelas from kelas k, pelajar g, guru j where k.idKelas=g.idKelas and k.idKelas=j.idKelas and idGuru='$id' group by idPelajar"); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Attendance System</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="as-wrapper">
	<!-- Side Navbar -->
	<div class="as-sidenav">
		<h2>Attendance System</h2>
		<ul>
			<li><a href="index.php"><i class="fas fa-home"></i>Home</a></li>
			<li><a href="studentList.php"><i class="fas fa-clipboard-check"></i>Student</a></li>
			<li><div class="as-dropdown">
				<button class="as-dropdownBtn">Attandance
					<i class="fas fa-caret-down"></i>
				</button>
				<div class="as-dropdown-content">
					<a href="newAttandance.php">Add new Attandance</a>
					<a href="attendanceList.php">List of Attandance</a>
				</div>
			</div></li>
			<li><a href="index.php?logout='1'"><i class="fas fa-project-diagram"></i>Log Out</a></li>
		</ul>
	</div>
	<!-- Main section -->
	<div class="as-main_content">
		<!-- Header section -->
		<div class="as-header"><h1>Web Dev</h1>
			<a href="#" style="text-align: right;">{<?php echo $_SESSION['user']['nama']; ?>}
				{<?php echo $arr4['namaKelas']; ?>}
			</a>
		</div>
		<div class="as-info">
			<form id="attendance_form" method="post" class="as-container" onsubmit="return validate(this);">
				<div class="as-header">Add New Attandance</div>
				<?php
                $kelas=$_SESSION['user']['nama'];
                //echo '<label>'.$kelas.'</label>';
                ?>
					<div id="as-content1" style="border: thin solid black;">
						<input type="text" class="inp-search" value="<?php echo $kelas; ?>" name="" readonly="">
						<label style="display: block;">Date:
						<input type="date" name="Tarikh" id="attendance_date">
						<script type="text/javascript">
							// When the document is ready
				            $(document).ready(function () {
				                
				                $('#attendance_date').datepicker({
				                    format: "yyyy-mm-dd",
				                    autoclose:true
				                });  
				            
				            });
						</script>
						</label>
						<table>
							<tr>
								<th width="8%">Student ID</th>
								<th width="40%">Student Name</th>
								<th width="5%">Present</th>
								<th width="5%">Absent</th>
								<th width="11%">Reasons</th>
							</tr>
							<?php
			                while ($row = mysqli_fetch_array($results)) 
			                  {
                    		?>
							<tr>
								<td><?php echo $row['idPelajar']; ?></td>
								<input type="hidden" name="idPelajar[]" value="<?php echo $row['idPelajar']; ?>" />
								<td><?php echo $row['nama']; ?> </td>
								<td><label><input id="click2"  type="radio" name="Status<?php echo $row['idPelajar']; ?>" value="Present"checked></label></td>
								<td><label><input id="click1"  type="radio" name="Status<?php echo $row['idPelajar']; ?>" value="Absent" ></label></td>
								<td><label>
									<select name="Sebab<?php echo $row['idPelajar']; ?>" id="selectOne" disable>
										<option value="">Select Reason</option>
										<option value="Medical Certificate">Medical Certificate</option>
										<option value="Representating School">Representating School</option>
									</select>
								</label></td>
							</tr>
							
						<?php }?>
						</table>
						<input type="hidden" name="action" id="action" value="Add" />
						<button class="btn-btnAdd" name="button_action" id="button_action" type="submit" value="Add" >Add New Attendance</button>
					</div>
			</form>
		</div>
		<!-- Footer section -->
		<div class="as-footer">Attendance System 2021</div>
	</div>
</div>

  function validate() {
    return [
        document.form.Tarikh

    ].every(validateDate)
}

function validateDate(Tarikh)
{
    if (Tarikh.value.trim() == "") {
        alert("Please enter a Date");
        Tarikh.focus();
        return false;
    }
    return true;       
}
  function SubmiAttendanceForm(){
    $.ajax({
      url:'newAttandance.php',
      method:"POST",
      data:$(this).serialize()
      success:function()
    })
  };


</script>
</body>
</html>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>