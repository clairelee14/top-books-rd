<?php
$min = 50;
$max = 600;
$output = "";

if (! empty($_POST['min_price'])) {
    $min = $_POST['min_price'];
}

if (! empty($_POST['max_price'])) {
    $max = $_POST['max_price'];
}

include("includes/header.php");
?>

</head>

<body>
    <h2>Books by Page Length</h2>

    <div class="form-price-range-filter">
        <form method="post" action="">
            <div>
                <input type="" id="min" name="min_price"
                    value="<?php echo $min; ?>">
                <div id="slider-range"></div>
                <input type="" id="max" name="max_price"
                    value="<?php echo $max; ?>">
            </div>
            <div class="filter-btn">
                <input type="submit" name="submit_range"
                    value="Filter Books" class="btn-submit">
            </div>
        </form>
    </div>
  
<?php


$result = mysqli_query($con, "SELECT * FROM top_books_rd WHERE `length` BETWEEN '$min' AND '$max' ORDER BY `length` ASC");

$count = mysqli_num_rows($result);
if ($count > 0) {
    ?>
<hr>
<div class="front-page-box">
     <?php
    while ($row = mysqli_fetch_array($result)) {
        ?>
    <div class="book-thumb">
        <a href="bookprofile.php?book_id=<?php echo $row['book_id'] ?>"><img src="thumbs/<?php echo $row['img_filename'] ?>" /></a>
        <p><?php echo $row['title']; ?></p>
        <p><?php echo $row['length']; ?></p>
    </div>
    <?php
        } // end while
    } else {
        ?>
    <div class="no-result">No Results</div>
</div>
<?php
}

mysqli_free_result($result);

mysqli_close($con);
echo $output;

?>
<?php include("includes/footer.php") ?>