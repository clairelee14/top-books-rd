<?php

$bookid = $_GET['book_id'];
if(!is_numeric($bookid)){
    header("Location:index.php");
}

include("includes/header.php");

?>
<?php $result = mysqli_query($con, "SELECT * FROM top_books_rd WHERE book_id = '$bookid'"); ?>
    <div class="single-book">
        <?php while($row = mysqli_fetch_array($result)): ?>
            <div>
                <h2><?php echo $row['title'] ?></h2>
                <p><b>Author: </b><?php echo $row['author'] ?></p>
                <p><b>Publisher: </b><?php echo $row['publisher'] ?></p>
                <p><b>Synopsis: </b><?php echo $row['synopsis'] ?></p>
                <p><b>Year of Publication: </b><?php echo $row['publication'] ?></p>
                <p><b>Genres: </b>
                <?php 
                if($row['genre_drama'] == "1"){
                    echo "Drama, ";
                }
                if($row['genre_sciencefiction'] == "1"){
                    echo "Science Fiction, ";
                }
                if($row['genre_horror'] == "1"){
                    echo "Horror, ";
                }
                if($row['genre_mystery'] == "1"){
                    echo "Mystery, ";
                }
                if($row['genre_romance'] == "1"){
                    echo "Romance, ";
                }
                if($row['genre_historicalfiction'] == "1"){
                    echo "Historical Fiction, ";
                }
                if($row['genre_sciencefiction'] == "1"){
                    echo "Science Fiction, ";
                }
                if($row['genre_fantasy'] == "1"){
                    echo "Fantasy, ";
                }
                if($row['genre_poetry'] == "1"){
                    echo "Poetry, ";
                }
                if($row['genre_realistnovel'] == "1"){
                    echo "Realist Novel, ";
                }
                if($row['genre_autobiography'] == "1"){
                    echo "Autobiography, ";
                }
                if($row['genre_nonfiction'] == "1"){
                    echo "Nonfiction, ";
                }
                ?></p>
                <p><b>Literary Award: </b>
                <?php 
                if($row['award'] == "pulitzer"){
                    echo "Pulitzer Prize";
                }
                if($row['award'] == "nobel"){
                    echo "Nobel Prize";
                }
                if($row['award'] == "newbery"){
                    echo "John Newbery Medal";
                }
                if($row['award'] == "national"){
                    echo "National Book Award";
                }
                if($row['award'] == "booker"){
                    echo "Man Booker Award";
                }
                if($row['award'] == "women"){
                    echo "Women's Prize for Fiction";
                }
                if(!$row['award']){
                    echo "N/A";
                }
                ?></p>
                <div class="book-profile-url">
                    <?php
                    $videoURL = $row['url'];
                    $convertedURL = str_replace("watch?v=", "embed/", $videoURL);
                    ?>
                    <iframe width="500" height="281" src="<?php echo $convertedURL; ?>" title="Embed YouTube Video from URL | PHP | JavaScript (jQuery)" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div>
                <img src="display/<?php echo $row['img_filename']?>">
            </div>

        <?php endwhile; ?>
    </div>
    <div class="back-btn">
        <a href="javascript:history.go(-1)" class="edit-btn">back</a>
    </div>

<?php include("includes/footer.php") ?>