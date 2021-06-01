<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<a href="index.php"><button type="button" class="btn btn-danger btn-lg btn-block">Home Back</button></a>
				<div class="card mb-3">
					<div class="card-body">						
						<form method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label for="photo">photo</label>
								<input required type="file" name="photo" class="form-control-file" id="photo">
							</div>
							<div class="form-group">
								<label>Title</label>
								<input required type="text" class="form-control" name="title" placeholder="Enter Title">
							</div>				
							<div class="form-group">
								<label>Content</label>
								<input required type="text" class="form-control" name="content" placeholder="Enter Content">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Add</button>
								<script type="text/javascript" src="js/sweetalert.min.js"></script>
							</div>
							<?php
							include('fonc.php');

							if ($_POST) { // We check if there is a post on the page.
    $title = $_POST['title']; // Posted after page refresh
    $content = $_POST['content'];   
    $error = "";

    // We make sure that the data fields are not empty. You can do it in other controls.
    if ($title <> "" && $content <> "" && isset($_FILES['photo'])) {

    	if ($_FILES['photo']['error'] != 0) {
    		$error .= 'An error occurred while uploading the file, please check your error.';
    	} else {

    		$files_name = strtolower($_FILES['photo']['name']);
    		if (file_exists('images/' . $files_name)) {
    			$error .= " There is a file called $files_name ";
    		} else {
    			$size = $_FILES['photo']['size'];
    			if ($size > (1024 * 1024 * 2)) {
    				$error .= ' The file size cannot be larger than 2MB.';
    			} else {
    				$file_type = $_FILES['photo']['type'];
    				$file_extension = explode('.', $files_name);
    				$file_extension = $file_extension[count($file_extension) - 1];

    				if (!in_array($file_type, ['image/png', 'image/jpeg']) || !in_array($file_extension, ['png', 'jpg'])) {
                        //if (($file_type != 'image/png' || $file_extension != 'png' )&&( $file_type != 'image/jpeg' || $file_extension != 'jpg')) {
    					$error .= ' Error, File type must be JPEG or PNG.';
    				} else {
    					$photo = $_FILES['photo']['tmp_name'];
    					copy($photo, 'img/' . $files_name);


                        //The data to be added is added to the array
    					$satir = [
    						'photo' => $files_name,
    						'title' => $title,    						
    						'content' => $content,
    					];

                        // We write our data insert query.
    					$sql = "INSERT INTO article SET photo=:photo, title=:title,content=:content;";
    					$status = $connect->prepare($sql)->execute($satir);

    					if ($status) {
    						echo '<script>swal("Successful","Data Added","success").then((value)=>{ window.location.href = "index.php"});

    						</script>';
    					}


    				}
    			}
    		}
    	}
    }
    if($error!=""){
    	echo '<script>swal("error","'.$error.'","error");</script>';
    }
}

?>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>