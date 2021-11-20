<?php 
	session_start();
	include('config.php');
	// variable declaration
	$username = "";
	$email    = "";
	$id 	  = "";
	$errors   = array(); 

	//UPDATE PROFILE
	if(isset($_POST['updateProfileBtn'])){
		updateProfile();
	}
	// call the register() function if register_btn is clicked ADMIN REGISTER
	if (isset($_POST['register_btn'])) {
		register();
	}
	// UPDATE TEACHERS DATA
	if (isset($_POST['updateTeachersBtn'])) {
		teachersUpdate();
	}
	// UPDATE STUDENTS DATA
	if (isset($_POST['updateStudentsBtn'])) {
		studentsUpdate();
	}
	// UPDATE STUDENTS STATUS (ABSENT / PRESENT)
	if(isset($_POST['updatesStudentsAttendance'])){
			$id = $_POST['idPelajar'];
			$Tarikh = $_POST['Tarikh'];
			$Status = $_POST['Status'];
			
			if ($Status == 'Present') {
				mysqli_query($db, "UPDATE kehadiran set Status='$Status', Sebab='' where idPelajar='$id' and Tarikh='$Tarikh'");
				if($_SESSION['user']['user_type'] == "admin"){
					$_SESSION['message'] = "Student updated!"; 
					header('location: attendances.php');
				}
				else{
					$_SESSION['message'] = "Student Attendance updated!"; 
					header('location: attendance.php');
				}
			}else{
				$Sebab = $_POST['Sebab'];
				mysqli_query($db, "UPDATE kehadiran set Status='$Status', Sebab='$Sebab' where idPelajar='$id' and Tarikh='$Tarikh'");
				if($_SESSION['user']['user_type'] == "admin"){
					$_SESSION['message'] = "Student updated!"; 
					header('location: attendances.php');
				}
				else{
					$_SESSION['message'] = "Student Attendance updated!"; 
					header('location: attendance.php');
				}
			}
					
	}
	// DETELE STUDENTS
	if (isset($_GET['delStudents'])) {
	$id = $_GET['delStudents'];
		if(mysqli_query($db, "DELETE from pelajar where idPelajar='$id'"))
		{
			$_SESSION['message'] = "Account deleted!"; 
			header('location: admin/adminStudentList.php');
		}elseif (!mysqli_query($db, "DELETE pelajar, kehadiran from pelajar INNER JOIN kehadiran where pelajar.idPelajar=kehadiran.idPelajar and pelajar.idPelajar='$id'")){
			echo "<script>alert('Unsuccessfully Delete Account'); </script>";
		}else{
				$_SESSION['message'] = "Account deleted!"; 
			header('location: user/studentList.php');
			}
	
	}
	// DELETE STUDENT ATTENDANCE ON SPECIFIC DATE AND SPECIFIC CLASS
	if (isset($_GET['delStudentsAttendancesID'])) { 
		$id = $_GET['delStudentsAttendancesID'];
		$Tarikh =$_GET['delStudentsAttendancesDate'];
		//$kelas = $_GET['delStudentsAttendancesIDKelas'];
		if(!mysqli_query($db, "DELETE from kehadiran where idPelajar='$id' and Tarikh='$Tarikh'")){
			echo "<script>alert('Unsuccessfully Delete Account'); </script>";
		}else{
			if($_SESSION['user']['user_type'] == "admin"){
				$_SESSION['message'] = "Student deleted!"; 
				header('location: admin/adminAttandance.php');
			}
			else{
				$_SESSION['message'] = "Student Attendance deleted!"; 
				header('location: user/attendanceList.php');
			}
		}
		
	}
	// DELETE TEACHERS ROW
	if (isset($_GET['delTeachers'])) {
	$id = $_GET['delTeachers'];
	mysqli_query($db, "DELETE FROM guru WHERE idGuru='$id'");
	$_SESSION['message'] = "Account deleted!"; 
	header('location: admin/adminLecturerList.php');
	}

	// call the login() function if register_btn is clicked Teachers LOGIN
	if (isset($_POST['login_btn'])) {
		login();
	}

	// STUDENT FORM BUTTOM
	if (isset($_POST['student_btn'])) {
		student();
	}
	// TEACHERS FORM BUTTON
	if(isset($_POST['teachers_btn'])){
		teachers();
	}
	//LOG OUT
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../login.php");
	}

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM multi_login WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}
	// LOGIN USER
	function login(){
		global $db, $id, $errors;

		// grap form values
		//$username = e($_POST['username']);
		$id = e($_POST['idGuru']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($id)) {
			array_push($errors, "ID is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM guru WHERE idGuru='$id' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			$query1 = "SELECT * FROM multi_login WHERE username='$id' AND password='$password' LIMIT 1";
			$results1 = mysqli_query($db, $query1);

			if (mysqli_num_rows($results) == 1) { // user found
				$logged_in_user = mysqli_fetch_assoc($results);	  
				{
					//$guru = mysqli_query($db, "")
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";

					header('location: user/index.php');
				}
			}else if(mysqli_num_rows($results1) == 1){
				$logged_in_user = mysqli_fetch_assoc($results1);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: index.php');		  
				}
			}
		}
	}
	 // STUDENT FORM from Form-elementsStudents.php
	function student()
	{
		global $db, $errors;

		$Name = e($_POST['fullname']);
		$Id = e($_POST['idstudent']);
		$Add = e($_POST['address']);
		$Class = e($_POST['kelas']);
		$Tel = e($_POST['numberstudent']);
		

		$sql = "insert into pelajar (idPelajar, nama, alamat, notelefon, idKelas) values ('$Id', '$Name', '$Add', '$Tel', '$Class')";

		if (!mysqli_query($db,$sql))
			{
			 echo "<script>alert('Unsuccessfully registered Student'); </script>";
			}else
			{
			 echo "<script>alert('Successfully registered Student'); </script>";
			}
	}
	 // TEACHERS FORM from form-elementsTeachers.php
	function teachers()
	{
		global $db, $errors;

		$Name = e($_POST['nama']);
		$Id = e($_POST['idGuru']);
		$Add = e($_POST['alamat']);
		$Tel = e($_POST['notelefon']);
		$Class = e($_POST['kelas']);
		$password_1 = e($_POST['password_1']);
		$password_2 = e($_POST['password_2']);

		if ($password_1 != $password_2) {
			echo "<script>alert('Wrong Password combination'); </script>";
		}else
		{
		$password = md5($password_1);
		$sql = "insert into guru (idGuru, nama, alamat, notelefon, user_type, idKelas, password) values ('$Id', '$Name', '$Add', '$Tel', 'user', '$Class', '$password')";

		if (!mysqli_query($db,$sql))
			{
			 echo "<script>alert('Lecturer ID already have !'); </script>";
			}else
			{
			 echo "<script>alert('Successfully Add new Lecturer'); </script>";
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

	function teachersUpdate(){
		global $db;
			
			$password_1 = $_POST['password_1'];
			$password_2 = $_POST['password_2'];

			if ($password_1 != $password_2) {
				$_SESSION['message'] = "Wrong Password combination!";
				header('location: teachers.php');
			}else{
				$password = md5($password_1);
				$id = $_POST['idGuru'];
				$Name = $_POST['nama'];
				$Add = $_POST['alamat'];
				$Tel = $_POST['notelefon'];
				mysqli_query($db, "UPDATE guru SET nama='$Name', alamat='$Add', notelefon='$Tel', password='$password' WHERE idGuru='$id'");
				$_SESSION['message'] = "Account updated!"; 
				header('location: teachers.php');
			}
			
	}
	function studentsUpdate(){
		global $db;
			$id = $_POST['idPelajar'];
			$Name = $_POST['nama'];
			$Add = $_POST['alamat'];
			$Tel = $_POST['notelefon'];
			mysqli_query($db, "UPDATE pelajar SET nama='$Name', alamat='$Add', notelefon='$Tel' WHERE idPelajar='$id'");
			$_SESSION['message'] = "Account updated!"; 
			header('location: students.php');
	}

	if(isset($_POST["action"]))
	{
		global $errors;
		if($_POST['action'] == "Add"){
			$Tarikh = $_POST['Tarikh'];
			if (empty($Tarikh)) { 
			echo "<script>alert('Date is required!'); </script>"; 
			}else{
				//CALL FUNCTION submitAttendance with $tarikh Arguments
				submitAttendance($Tarikh);
				echo "<script>alert('Successfully Insert Attendance!'); </script>";
			}	
		}
	}
		
	
	function submitAttendance($Tarikh){
			global $db;
			$idPelajar=$_POST['idPelajar'];
			//RECEIVE VALUE FROM FORM
			for ($count=0; $count < count($idPelajar) ; $count++) { 
			$data =array(
				//COLUMN Name     VALUES
				'idPelajar'		=>$idPelajar[$count],
				'Status'		=>$_POST['Status'.$idPelajar[$count].""],
				'Sebab'			=>$_POST['Sebab'.$idPelajar[$count].""],	
				'Tarikh'		=>$Tarikh,
				'idKelas'		=>$_SESSION['user']['idKelas']

			);
			$placeholders = array_fill(0, count($data), '?');
			$keys = array();
			$values = array();
			foreach ($data as $k => $v) {
				$keys[]=$k;
				$values[]= !empty($v) ? $v : null;
			}	
				$query = "INSERT INTO kehadiran ".
						'('.implode(', ',  $keys).') values '.
						'('.implode(', ',  $placeholders).'); ';

			$stmt = mysqli_prepare($db, $query);

			$params = array();
			foreach ($data as &$value) {
				$params[] = &$value;
			}
			//Bind params
			$types = array(str_repeat('s', count($params)));
			$values = array_merge($types, $params);

			call_user_func_array(array($stmt, 'bind_param'), $values);


			mysqli_execute($stmt);
			}
		}


	function updateProfile(){
		global $db;

		// receive all input values from the form

		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if ($password_1 != $password_2) {
			echo "<script>alert('Wrong Password combination'); </script>";
		}else{
			if ($_SESSION['user']['user_type'] == 'admin') {
				$idAdmin = $_SESSION['user']['id'];
				$username    =  e($_POST['username']);
				$email       =  e($_POST['email']);
				$password = md5($password_1);
				$query = "UPDATE multi_login set username='$username', email='$email', password='$password' where id='$idAdmin'";
				if(!mysqli_query($db,$query)){
					echo "<script>alert('Username already Taken'); </script>";
				}else{
					$_SESSION['success'] = "Account updated!"; 
					header('location: index.php');
				}
				
			}else{
				$password = md5($password_1);
				$id = e($_POST['idGuru']);
				$Name = e($_POST['nama']);
				$Add = e($_POST['alamat']);
				$Tel = e($_POST['notelefon']);
				if(!mysqli_query($db, "UPDATE guru SET nama='$Name', alamat='$Add', notelefon='$Tel', password='$password' WHERE idGuru='$id'")){
					echo "<script>alert('Failure updating Profile'); </script>";
				}else{
					$_SESSION['success'] = "Account updated!"; 
					header('location: index.php');
				}
			}
		}
	}

?>
