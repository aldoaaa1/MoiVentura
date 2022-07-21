	<?php
    $this->load->view('template/scripts.php');
		if (file_exists('assets/js/'.$page.'.js')) {
			$js = $js_path.$page.'.js'; echo '<script src="'.$js.'"></script>';
		}
	?>
</body>
</html>