<?php include '../functions.php'; 
if (!isAdmin()){
    header('location: ../login.php');
  }
  $results = mysqli_query($db, "SELECT idGuru, nama, alamat, namaKelas, notelefon from kelas k, guru g where k.idKelas=g.idKelas group by idGuru");
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
			<li><a href="../index.php"><i class="fas fa-home"></i>Home</a></li>
			<li><a href="adminAttandance.php"><i class="fas fa-project-diagram"></i>Attendance</a></li>
			<li><div class="as-dropdown">
				<button class="as-dropdownBtn">Student
					<i class="fas fa-caret-down"></i>
				</button>
				<div class="as-dropdown-content">
					<a href="addStudent.php">Add new Student</a>
					<a href="adminStudentList.php">List of Student</a>
				</div>
			</div>
			</li>
			<li><div class="as-dropdown">
				<button class="as-dropdownBtn">Lecturer
					<i class="fas fa-caret-down"></i>
				</button>
				<div class="as-dropdown-content">
					<a href="addLecturer.php">Add new Lecturer</a>
					<a href="#">List of Lecturer</a>
				</div>
			</div></li>
			<li><a href="../index.php?logout='1'"><i class="fas fa-project-diagram"></i>Log Out</a></li>
		</ul>
	</div>
	<!-- Main section -->
	<div class="as-main_content">
		<!-- Header section -->
		<div class="as-header">
			<h1>Web Dev</h1>
			<a href="#" style="text-align: right;"><?php echo $_SESSION['user']['username']; ?></a>
		</div>
		<div class="as-info">
			<div class="as-container">
				<div class="as-header">List of Lecturer</div>
				<div id="as-content1" style="border: thin solid black;">
					<input type="search" class="inp-search" name="">
					<table>
						<tr>
							<th width="8%">Lecturer ID</th>
							<th width="40%">Lecturer Name</th>
							<th width="30%">Address</th>
							<th width="10%">Phone Number</th>
							<th width="5%">Class</th>
							<th width="11%">Actions</th>
						</tr>
<?php while ($row = mysqli_fetch_array($results)) { ?>
						<tr>
							<td><?php echo $row['idGuru']; ?></td>
							<td><?php echo $row['nama']; ?></td>
							<td><?php echo $row['alamat']; ?></td>
							<td><?php echo $row['notelefon']; ?></td>
							<td><?php echo $row['namaKelas']; ?></td>
							<td><a href="../functions.php?delTeachers=<?php echo $row['idGuru']; ?>" id="btn-outline-Action" onclick="return confirm('Are you sure?')">Delete</a></td>
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