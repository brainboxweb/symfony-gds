<html>
	<head>
		<title></title>

<?php
	require('config_nam.php');
	
	// get file name from querystring
	$image =  $_SERVER['DOCUMENT_ROOT'] . $config['basePath'] . 'html/images/news/' . $_GET['res'] . '.jpg';
	
	//$image_atr = getimagesize($config['basePath'] . 'html/images/news/' . $_GET['res'] . '.jpg');
	//$width = $image_atr[0];
	//$height = $image_atr[1];
	
	?>
		<script>
			window.onload = function(){
				sheight = document.getElementById('example_image').height;
				swidth = document.getElementById('example_image').width;
				
				if (sheight < 180) {
					sheight = 209;
				}
				if (swidth < 500) {
					swidth = 500;
				}
				
				self.resizeTo(swidth + 150, sheight + 180);
			}
		</script>
		
		</head>
	<body>

	<?php
	
	
	//echo $image . "<br />";
	
	if(file_exists($image)){
		// show image
		echo "<div style='margin:0 auto;border:1px solid #C1C1C1;width:99%;padding:5px;font-family:ariel,helvetica;text-align:center;'>";
		echo "<div style='text-align:center;'>";
		
		echo "<img id='example_image' src='" . $config['basePath'] . 'html/images/news/' . $_GET['res'] . ".jpg' alt='CMS Resource.' border='0' />";
		
		echo "</div><br /><a href='#' onclick='javascript:self.close();' >close window.</a></div>";
	}else{
		// error! no file message
		echo "<div style='margin:0 auto;border:1px solid #C1C1C1;width:75%;margin-top:15%;padding:20px;'>";
		echo "<div style='font-family:ariel,helvetica;text-align:center;'>";
		echo "<p>The resource you are trying to access does not exist.<p>";
		echo "<p>You need to upload an image first.</p>";
		echo "<a href='#' onclick='javascript:self.close();' >close window.</a></div></div>";
	}
?>
	</body>
</html>