<?php
	session_start();
	include('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<title>SUAS ANOTAÇÕES</title>
	<style type="text/css">
		#list li{
		    display: inline;
		    padding:30px;
		}
	</style>
</head>
<body>
	<div id="folders">
		<ul id="list">
			<?php
				$id = $_SESSION['id'];
				$sql = "SELECT * FROM usuarios WHERE id = '".$id."'";
				$result = $connect->query($sql);

				while($row = $result->fetch_object()){
					$str = $row->folders;
					$delimiter = ' ';
					$words = explode($delimiter, $str);

					foreach ($words as $word) {
						if(!empty($word)){
							echo "<li><a href='anotacoes.php?folder_id=$word'>".$word."</a></li>";
						}
					}
				}
			?>
		</ul>
	</div>
	<div>
		<button id='create' onclick="return criarpasta();">Criar pasta</button>
	</div>
	<script>
		function changeTitle(titleId){
			//<input type='text' id='title' value='olalas' readonly> <span id='title' onclick='changeTitle(this.id)'>Editar</span>
			const title = document.getElementById(titleId)
			title.removeAttribute('readonly')
		}

		function criarpasta(){
			var id = "id" + Math.random().toString(16).slice(2)
	        const pasta = document.createElement('li')
	        const div = document.getElementById('list')
	        pasta.id = id
	        pasta.innerHTML = `<a href='anotacoes.php?folder_id=${id}'>Sua pasta</a>`
	        div.append(pasta)

	        $.ajax({
				type:'post',
				url:'ajax.php',
				data:{
					click:true,
					id:id
				},
		        success:function(html) {
             		console.log(html);
           		}
			});
		}
	</script>
</body>
</html>