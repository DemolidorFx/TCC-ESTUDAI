<?php
	session_start();
	include("connect.php");
	if(isset($_POST["click"])){
		if($_POST["click"] == true){
			echo 'foi';
			$_POST["click"] = false;
			$user_id = $_SESSION['id'];
			$id = $_POST["id"];
			$get_folder = "SELECT * FROM usuarios WHERE id = '".$user_id."'";
			$result = $connect->query($get_folder);
			while($row = $result->fetch_object()){
				$folders = $row->folders;
			}
			$new_folders = $folders.' '.$id;
			echo $new_folders;
			$sql = "UPDATE usuarios SET folders = '".$new_folders."' WHERE id ='".$user_id."'";
			$connect->query($sql);
		}
	}
	if(isset($_POST['elementId'])){
		$element_id = $_POST['elementId'];
		$sql = "DELETE FROM postit WHERE id = '".$element_id."'";
		$connect->query($sql);
	}
	if(isset($_POST["insert_id"])){
		$postit_id = $_POST['insert_id'];
		$folderId = $_POST['folderId'];

		$nome = $_SESSION['name'];
		$login = $_SESSION['login'];

		$sql = "INSERT INTO postit (id, user_login, folder) VALUES ('".$postit_id."','".$login."','".$folderId."')";
		$connect->query($sql);
	}
	if(isset($_POST['contentid'])){
		$text = $_POST['input_content'];
		$text_id = $_POST['contentid'];
		echo $text;
		$sql = "UPDATE postit SET content = '".$text."' WHERE id = '".$text_id."'";
		$connect->query($sql);
	}
	if(isset($_POST['title'])){
		$text_id = $_POST['contentid'];
		$content = $_POST['content'];
		$title = $_POST['title'];
		$sql = "UPDATE postit SET title = '".$title."', content ='".$content."' WHERE id = '".$text_id."'";
		$connect->query($sql);
	}