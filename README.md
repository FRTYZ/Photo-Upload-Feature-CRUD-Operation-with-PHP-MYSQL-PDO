# Photo Upload Feature CRUD operation with PHP MYSQL (PDO)

## Hello there,
In this project, I will present CRUD (Create, Read, Update, Delete) operations with Photo upload feature with PHP MYSQL (PDO).

#### Our Project Content
* Photo Upload, Deletion, Change Procedures in CRUD process
* Required security measures for uploading photos (Size, Type)
* Success and error alerts with SweatAlert
* Validation alerts with HTML5


## İndex.php
* Listing Data
- Applying Add, Edit, Delete Operations

![alt text](https://github.com/FRTYZ/Photo-Upload-Feature-CRUD-Operation-with-PHP-MYSQL-PDO/blob/main/img/ss/pcrud-home.png?raw=true)

## add.php
#### Adding New Data
![alt text](https://github.com/FRTYZ/Photo-Upload-Feature-CRUD-Operation-with-PHP-MYSQL-PDO/blob/main/img/ss/pcrud-add.png?raw=true)

#### Alert with SweatAlert
![alt text](https://github.com/FRTYZ/Photo-Upload-Feature-CRUD-Operation-with-PHP-MYSQL-PDO/blob/main/img/ss/pcrud-add-alert.png?raw=true)


#### Validation alerts with HTML5
![alt text](https://github.com/FRTYZ/Photo-Upload-Feature-CRUD-Operation-with-PHP-MYSQL-PDO/blob/main/img/ss/pcrud-add-validation.png?raw=true)

## edit.php
#### Updating Data
![alt text](https://github.com/FRTYZ/Photo-Upload-Feature-CRUD-Operation-with-PHP-MYSQL-PDO/blob/main/img/ss/pcrud-edit.png?raw=true)

#### Alert with SweatAlert
![alt text](https://github.com/FRTYZ/Photo-Upload-Feature-CRUD-Operation-with-PHP-MYSQL-PDO/blob/main/img/ss/pcrud-edit-alert.png?raw=true)

## delete.php
#### Deletion of selected data
#### Alert with SweatAlert
#### The image of the selected data is deleted. If you wish, you can remove my code from the relevant source code
![alt text](https://github.com/FRTYZ/Photo-Upload-Feature-CRUD-Operation-with-PHP-MYSQL-PDO/blob/main/img/ss/pcrud-edit-alert.png?raw=true)

## Source Codes
* Related explanations are in the source code

#### .fonc.php (Database Settings)
```
<?php
$host = '127.0.0.1';
$dbname = 'pdocrudphoto';
$username = 'root';
$password = '';
$charset = 'utf8';
//$collate = 'utf8_unicode_ci';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
];
try {
    $connect = new PDO($dsn, $username, $password, $options);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection error: ' . $e->getMessage();
    exit;
}
?>
```

#### index.php
```
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <a href="add.php"><button type="button" class="btn btn-primary btn-lg btn-block">Add New Data</button></a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('fonc.php'); // We call the database on our index.php page

                        $sorgu = $connect->prepare('Select * from article'); // We are pulling all the data from the Article table in the database
                        $sorgu->execute(); // We run our query

                        while($query=$sorgu->fetch()) // We rotate our Data with "While Loop"
                        
                        {  // While Start

                            ?>
                            <tr>
                                <th scope="row"><?= $query['id']?></th>
                                <td><img src="img/<?= $query["photo"] ?>" width="150px"/></td>
                                <td><?= $query['title']?></td>
                                <td><?= $query['content']?></td>
                                <td>
                                <a href="edit.php?id=<?= $query["id"] ?>"><button type="button" class="btn btn-success">Edit</button></a>
                                </td>                               
                                        <td>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                           data-target="#delete<?= $query["id"] ?>"><button type="button" class="btn btn-warning">Delete</button></a>
                                        
                                        <div class="modal fade" id="delete<?= $query["id"] ?>" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Deletion Process</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Are you sure you want to delete the data?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary pull-left mx-4" type="button"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <a class="btn btn-danger pull-right mx-4"
                                                           href="delete.php?id=<?= $query["id"] ?>">Delete</a>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </td>
                            </tr>

                            <?php
                        }  // While End

                        ?>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script src="js/sweetalert.min.js"></script>
```



#### add.php          

```
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
```


#### edit.php
```
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
```

#### delete.php
```
<?php
if ($_GET) {

    $page = $_GET["page"];
    include("fonc.php"); // We add our database connection to our page.
    $query = $connect->prepare("SELECT * FROM article Where id=:id");
    $query->execute(['id' => (int)$_GET["id"]]);
    $result = $query->fetch();//executing query and getting data
    unlink('img/' . $result["photo"]);//the old file is being deleted. optional

    // We write our query to delete the data whose id is selected.z.
    $where = ['id' => (int)$_GET['id']];
    $status = $connect->prepare("DELETE FROM article WHERE id=:id")->execute($where);
    if ($status) {
        header("location:index.php"); // If the query runs, we send it to the index.php page.
    }
}
?>
```



Good Encodings