<?php
	session_start();
	include("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel='stylesheet' href='css/anotacoes.css'>
	<meta charset="utf-8">
</head>
<body id='<?php echo $_GET['folder_id']; ?>'>
	<button id='btn1' onclick="return insert()">Criar anotação</button>
	<div id='parent'>
		<?php
			$folder = $_GET['folder_id'];
			$sql = "SELECT * FROM postit WHERE folder = '".$folder."'";
			$result = $connect->query($sql);
			while($row = $result->fetch_object()){
				echo "<div class='wrapper' id='$row->id'><header id='header'> <input type='text' oninput='changetitle(this.id)' id='$row->id' class='title$row->id title' value='$row->title'><span id='$row->id'onclick='deletar(this.id)'>x</span> </header><div id='content'>
			<textarea id='$row->id' class='text$row->id' oninput='changevalue(this.id)'>$row->content</textarea> </div></div>";
			}

		?>
	</div>
	<script src="js/script.js"></script>
	<script>
		function deletar(spanId){
			var elem = document.getElementById(spanId);
			const elementId = spanId
  			elem.parentNode.removeChild(elem);
			  $.ajax({
				type:'post',
				url:'ajax.php',
				data:{
					elementId:elementId,
				},
		        success:function(html) {
             		console.log(html);
           		}
			})
		}
		function changevalue(text_id){
			const input = document.querySelector(`.text${text_id}`).value
			const content_id = text_id
			$.ajax({
				type:'post',
				url:'ajax.php',
				data:{
					contentid:content_id,
					input_content:input
				},
		        success:function(html) {
             		console.log(html);
           		}
			})
		}
		function changetitle(text_id){
			const input = document.querySelector(`.title${text_id}`).value
			const inputcont = document.querySelector(`.text${text_id}`).value
			const content_id = text_id
			$.ajax({
				type:'post',
				url:'ajax.php',
				data:{
					contentid:content_id,
					content:inputcont,
					title:input
				},
		        success:function(html) {
             		console.log(html);
           		}
			})
		}

		function insert(){
			const folderId = document.querySelector('body').id
			var id = "id" + Math.random().toString(16).slice(2)
	        const users = document.createElement('div')
	        const div = document.getElementById('parent')

	        users.id = id
	        users.classList.add('wrapper');
	        users.innerHTML = `<header id='header'> <input type='text' oninput='changetitle(this.id)' id='${id}' class='title${id} title' value='seu título aqui'><span id='${id}'onclick='deletar(this.id)'>x</span> </header><div id='content'>
			<textarea id='${id}' class='text${id}'oninput="changevalue(this.id)"></textarea> </div>`
	     	div.append(users)

		 	$.ajax({
				type:'post',
				url:'ajax.php',
				data:{
					insert_id:id,
					folderId:folderId
				},
		        success:function(html) {
             		console.log(html);
           		}
			})
		}
	</script>

</body>
</html>