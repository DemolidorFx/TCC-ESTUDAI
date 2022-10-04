<?php
	session_start();
	include('connect.php');
	if(isset($_POST['login'])){
		$login = $_POST['login'];
		$password = md5($_POST['password']);
		$name = $_POST['name'];
		//usuario comum = 1, admin = 2
		$select = "SELECT * FROM usuarios WHERE login = '".$login."'";
		$result = $connect->query($select);
		echo $login;
		if($result->num_rows == 1){
			$_SESSION['cadastrado'] = false;
			$_SESSION['ja_existe'] = true;
			header('location: index.html');
		}else{
			$sql = "INSERT INTO usuarios (name, login, password, admin) VALUES ('".$name."','".$login."','".$password."', '1')";
			$connect->query($sql);
			$_SESSION['cadastrado'] = true;
			header('location: index.html');
		}
	}
?>