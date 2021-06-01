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