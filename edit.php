<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title></title>
</head>
<?php
include('fonc.php');

$query = $connect->prepare("SELECT * FROM article Where id=:id");
$query->execute(['id' => (int)$_GET["id"]]);
$result = $query->fetch();//executing query and getting data
?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="index.php"><button type="button" class="btn btn-danger btn-lg btn-block">Home Back</button></a>
                <div class="card mb-3">
                    <div class="card-body">                     
                       <form method="post" action="" enctype="multipart/form-data">
                         <div class="form-group">
                            <img src="img/<?= $result["photo"] ?>" width="150" alt="">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" class="form-control-file" id="photo">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input required type="text" value="<?= $result["title"] ?>" class="form-control" name="title"
                            placeholder="Title">
                        </div>                  
                        <div class="form-group">
                            <label>Content</label>
                            <input required type="text" value="<?= $result["content"] ?>" class="form-control" name="content"
                            placeholder="Content">
                        </div>    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <script type="text/javascript" src="js/sweetalert.min.js"></script>
                            <?php
                                if ($_POST) { // We check if there is a post.
               $title = $_POST['title']; // After the page is refreshed, we assign the posted values to the variables.
               $content = $_POST['content'];
               $error = '';

               if ($_FILES["photo"]["name"] != "") {
                $photo = strtolower($_FILES['photo']['name']);
                if (file_exists('images/' . $photo)) {
                    $error = " There is a file called  $photo ";
                } else {
                    $size = $_FILES['photo']['size'];
                    if ($size > (1024 * 1024 * 2)) {
                        $error = 'the file size cannot be larger than 2MB.';
                    } else {
                        $file_type = $_FILES['photo']['type'];
                        $file_extension = explode('.', $photo);
                        $file_extension = $file_extension[count($file_extension) - 1];

                        if (!in_array($file_type, ['image/png', 'image/jpeg']) || !in_array($file_extension, ['png', 'jpg'])) {
                            //if (($file_type != 'image/png' || $file_extension != 'png' )&&( $file_type != 'image/jpeg' || $file_extension != 'jpg')) {
                            $error = 'Error, The file type must be JPEG or PNG.';
                        } else {
                            $file = $_FILES["photo"]["tmp_name"];
                            copy($file, "img/" . $photo);
                            unlink('img/' . $result["photo"]); //the old file is being deleted.
                        }
                    }
                }
            } else {
                // If the user has not selected the picture, we do not change the picture in the database.uz
                $photo = $result["photo"];
            }

            if ($title <> "" && $content <> "" && $error == "") { //We make sure that the fields are not empty..
                //Data to change
                $line = [
                   'id' => $_GET['id'],
                   'photo' => $photo,
                   'title' => $title,              
                   'content' => $content,
               ];
                // We write our data update query.
               $sql = "UPDATE article SET photo=:photo, title=:title,content=:content WHERE id=:id;";             
               $status = $connect->prepare($sql)->execute($line);

               if ($status)
               {
                echo '<script>swal("successful","Data updated","success").then((value)=>{ window.location.href = "index.php"});

                </script>';     // If the update query worked, we redirect to the index.php page.
            } else {
                    echo 'Edit error occurred: '; // If id is not found or there is an error in the query, we print the error.
                }
            } else {
                echo 'An error occurred: ' . $error; // We return the error according to the file error and empty state of the form elements
            }
            if ($error != "") {
                echo '<script>swal("error","' . $error . '","error");</script>';
            }
        }


        ?>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>