<!DOCTYPE html>
<html>
<head>
	<title>PDO CRUD</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
</head>
<body>

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

	<script src="js/jquery-3.4.1.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>
</body>
</html>