<?php include("includes/header.php") ?>
<?php
      $displayby = "";
      $displayvalue = "";

      if(isset($_GET['displayby'])){
        $displayby = $_GET['displayby'];
      }
      
      if(isset($_GET['displayvalue'])){
        $displayvalue = $_GET['displayvalue'];
      }

      if($displayby && $displayvalue){
        $sql = "SELECT * FROM top_books_rd WHERE $displayby LIKE '$displayvalue'";
      }
?>
<?php

echo "<div class=\"front-page-box\">";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)){
    $author = $row['author'];
    $book_id = $row['book_id'];
    $image_file = $row['img_filename'];
    echo "<div class=\"book-thumb\">";
    echo "<a href=\"bookprofile.php?book_id=$book_id\"><img src=\"thumbs/$image_file\"/></a><br/>";
    echo "<a href=\"bookprofile.php?book_id=$book_id\">$author</a><br/>";
    echo "</div>";
    }
echo "</div>";

?>

<?php include("includes/footer.php") ?>