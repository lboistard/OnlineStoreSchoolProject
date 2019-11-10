<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- Supprimer le <meta> ci dessous pour enelver l'auto refresh de la page -->
	<!--  <meta http-equiv="refresh" content="1"/> -->
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta charset="utf-8">
</head>
<body>

	<?php 
		//init des vars
		$category = "";
		$categoryError ="";


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["category"])) {
			$categoryError = "Category is required";
		} else {
			$category = test_input($_POST["category"]);
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	 ?>
	
	<section id="rest">
		<!--Formulaire qui permet de se connecter-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
	class="form-example">
		

			<input type="radio" id="clientButton" name="category" 

				<?php if (isset($category) && $category=="client") 
					echo "checked";
				?>

			value="client" checked>
			
				<h2>Client</h2>
		

			<input type="radio" id="managerButton" name="category" 
				<?php if (isset($category) && $category=="manager") {
					echo "checked";
				}
				?>

			value="manager">
			<h2>Manager</h2>
			
		

				<input type="submit" name="submit" value="Log In">

<!--
			<div class="form-example">
				<input type="email" name="email" id="email" required placeholder="email">
			</div>
			
			<div class="form-example">	
				<input type="password" name="password" id="password" required placeholder="password">
			</div>

			
			
		
-->
		</form>



	</section>

	<?php
	echo "<h2>Your Input:</h2>";
	echo "<br>";
	echo $category;
	?>
	
	
</body>
</html>