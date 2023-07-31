<?php

session_start();
if(!isset($_SESSION['top-books-rd-session-clairelee'])){
    header("Location:admin/login.php?refer=welcome");
}

include("includes/header.php");

?>

<div>
    <h2>Welcome to Admin</h2>
    <a href="<?php echo BASE_URL ?>admin/insert.php" class="edit-btn">Insert Books</a>
    <a href="<?php echo BASE_URL ?>admin/edit.php" class="edit-btn">Edit Books</a>
    <a href="<?php echo BASE_URL ?>admin/logout.php" class="btn">LOG OUT</a>

</div>

<?php

include ("includes/footer.php");
?>