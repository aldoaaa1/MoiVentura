<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?></title>
	<meta name="description" content="<?= $description ?>">
	<meta name="keywords" content="<?= $keywords ?>">
	<?php
    $this->load->view('template/links.php');
		if (file_exists('assets/css/'.$page.'.css')) {
      $css = $css_path.$page.'.css'; echo '<link rel="stylesheet" href="'.$css.'">';
    }
    echo '<script>var base_url = "'.base_url().'";</script>';
	?>
</head>
<body>