<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		Framework Básico:
		<?php 
			if (isset($this->titulo)) {
				echo $this->titulo;
			}
		?>
	</title>
	<link rel="stylesheet" href="<?php echo APP_URL_CSS."bootstrap.min.css"; ?>">
		<link rel="stylesheet" href="<?php echo APP_URL_CSS."fontawesome-free-5.5.0-web/css/all.css"; ?>">
	<link rel="stylesheet" href="<?php echo $_layoutParams["ruta_css"]; ?>style.css">
</head>
<body>
	<?php
	if (isset($this->flashMessage)) {
		echo "<h3>".$this->flashMessage."</h3>";
	}
	?>
