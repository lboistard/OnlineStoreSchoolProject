<?php 
session_start();
$var = $_GET['emailClient'];
$carToDelimite = '@';
$string = 'this/is/a/string@text-to-delete';

$newString = substr($string, 0, strpos($string,$carToDelimite));
?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		.header {
		  padding: 60px;
		  text-align: center;
		  background: #1abc9c;
		  color: white;
		  font-size: 30px;
		}
	</style>
	<title>Client Page</title>
</head>
<body>
	<?php 
	$emailClient = $_POST['emailClient'];
	$usernameClient = substr($emailClient, 0, strpos($emailClient, $carToDelimite));
	
	?>
	
	<div class="header">
		<span>
			<?php 
				echo $usernameClient;
			?>
			 	
		</span>

	</div>
</body>
</html>
