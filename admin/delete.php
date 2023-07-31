<!-- 1: DB connect
2: grab the ID
3: delete
4: redirect -->

<?php include("../includes/header.php"); ?>

<?php
$bookid = "";
if(isset($_GET['book_id'])){
    $bookid = $_GET['book_id'];
}
if(!$bookid){
    $sql = "SELECT contact_id FROM business_contacts";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    while($row = mysqli_fetch_array($result)){

        $id = $row['contact_id'];

    }
}

mysqli_query($con, "DELETE FROM top_books_rd WHERE book_id = '$bookid'") or die(mysqli_error($con));

header("Location:edit.php");
?>