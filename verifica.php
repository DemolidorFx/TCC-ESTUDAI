<?php
	session_start();
	include("connect.php");
	if(isset($_POST['login'])){
		$login = $_POST['login'];
		$password = md5($_POST['password']);
		$sql = "SELECT * FROM usuarios WHERE login = '".$login."' and password = '".$password."'";
		$result = $connect->query($sql);
		if($result->num_rows == 1){
			$_SESSION['logado'] = true;
			$_SESSION['error'] = false;
			while ($row = $result->fetch_object()){
				$_SESSION['name'] = $row->name;
				$_SESSION['id'] = $row->id;
				$_SESSION['login'] = $row->login;
				$admin = $row->admin;
				if($admin == 2){
					header('location: pagina_inicial_admin.html');
				}else{
					header('location: home.html');
				}
			}
		}else{
			$_SESSION['logado'] = false;
			$_SESSION['error'] =  true;
			header('location: index.html');
		}
	}
?>