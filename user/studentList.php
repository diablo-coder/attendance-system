<?php include '../functions.php'; 
	if (!isLoggedIn()){
    header('location: ../login.php');
  }
  $id=$_SESSION['user']['idGuru'];
 $IdKelas=$_SESSION['user']['idKelas'];
$kelas = mysqli_query($db, "SELECT * FROM kelas WHERE idKelas='$IdKelas' ");
 $arr4 = mysqli_fetch_assoc($kelas);
  $results = mysqli_query($db, "SELECT idPelajar, g.nama, g.alamat, namaKelas, g.notelefon from kelas k, pelajar g, guru j where k.idKelas=g.idKelas and k.idKelas=j.idKelas and idGuru='$id' group by idPelajar"); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Attendance System</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/dataTables.min.css">
	<script src="../assets/js/min.js"></script>
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
			<li><a href="#"><i class="fas fa-clipboard-check"></i>Student</a></li>
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
			<div class="as-container">
				<div class="as-header">List of Student</div>
				<div id="as-content1" style="border: thin solid black;">
					<input type="search" class="inp-search" name="">
					<table>
						<tr>
							<th width="8%">Student ID</th>
							<th width="40%">Student Name</th>
							<th width="30%">Address</th>
							<th width="10%">Phone Number</th>
							<th width="5%">Class</th>
						</tr>
						<?php while ($row = mysqli_fetch_array($results)) { ?>
						<tr>
							<td><?php echo $row['idPelajar']; ?></td>
							<td><?php echo $row['nama']; ?></td>
							<td><?php echo $row['alamat']; ?></td>
							<td><?php echo $row['notelefon']; ?></td>
							<td><?php echo $row['namaKelas']; ?></td>
						</tr>
					<?php }?>
					</table>
				</div>
			</div>
		</div>
		<!-- Footer section -->
		<div class="as-footer">Attendance System 2021</div>
	</div>
</div>
</body>
</html>