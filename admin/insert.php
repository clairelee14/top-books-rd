<?php 

session_start();
if(!isset($_SESSION['top-books-rd-session-clairelee'])){
    header("Location:login.php?refer=welcome");
}

include ("../includes/header.php"); 

?>

<?php
$title = "";
$author = "";
$synopsis = "";
$publisher = "";
$publication = "";
$length = "";
$award = "";
$url = "";

$genre_drama = "";
$genre_fantasy = "";
$genre_historicalfiction = "";
$genre_horror = "";
$genre_mystery = "";
$genre_romance = "";
$genre_sciencefiction = "";
$genre_poetry = "";
$genre_realistnovel = "";
$genre_autobiography = "";
$genre_nonfiction = "";

$fileMsg = "";
$fileSizeMsg = "";
$titleMsg = "";
$authorMsg = "";
$publicationMsg = "";
$genreMsg = "";
$urlMsg = "";
$msgSuccess = "";

if(isset($_POST['submit'])){
    $title = strip_tags(trim($_POST['title']));
    $author = strip_tags(trim($_POST['author']));
    $synopsis = strip_tags(trim($_POST['synopsis']));
    $publisher = strip_tags(trim($_POST['publisher']));
    $publication = strip_tags(trim($_POST['publication']));
    $length = strip_tags(trim($_POST['length']));
    $award = $_POST['award'];
    $url = strip_tags(trim($_POST['url']));

    if(isset($_POST['drama'])){
        $genre_drama = +($_POST['drama']);
    }
    if(isset($_POST['fantasy'])){
        $genre_fantasy = +($_POST['fantasy']);
    }
    if(isset($_POST['historicalfiction'])){
        $genre_historicalfiction = +($_POST['historicalfiction']);
    }
    if(isset($_POST['horror'])){
        $genre_horror = +($_POST['horror']);
    }
    if(isset($_POST['mystery'])){
        $genre_mystery = +($_POST['mystery']);
    }
    if(isset($_POST['romance'])){
        $genre_romance = +($_POST['romance']);
    }
    if(isset($_POST['sciencefiction'])){
        $genre_sciencefiction = +($_POST['sciencefiction']);
    }
    if(isset($_POST['poetry'])){
        $genre_poetry = +($_POST['poetry']);
    }
    if(isset($_POST['realistnovel'])){
        $genre_realistnovel = +($_POST['realistnovel']);
    }
    if(isset($_POST['autobiography'])){
        $genre_autobiography = +($_POST['autobiography']);
    }
    if(isset($_POST['nonfiction'])){
        $genre_nonfiction = +($_POST['nonfiction']);
    }

    // echo "<pre>";
    // print_r ($_POST);
    // echo "</pre>";

    // if($genre_drama == "1"){
    //     $genre_drama = 1;
    // }


    $valid = 1;
    $msgPreError = "\n<div class=\"error-message\">";
    $msgPreSuccess = "\n<div class=\"success-message\">";
    $msgPost = "\n</div>\n";
    
    if($_FILES['myfile']['type'] != "image/jpeg"){
        $valid = 0;
        $fileMsg = "Not a JPG image";
    }

    if($_FILES['myfile']['size'] > (8000 * 1024)){
        $valid = 0;
        $fileSizeMsg = "File is too large";
    }

    if((strlen($title) < 3) || (strlen($title) > 75)){
        $valid = 0;
        $titleMsg = "Please enter a title from 2 to 75 characters";
    }

    if((strlen($author) < 2) || (strlen($author) > 80)){
        $valid = 0;
        $authorMsg = "Please enter an author name from 2 to 80 characters";
    }

    if((strlen($publication) < 4) || (strlen($publication) > 4)){
        $valid = 0;
        $publicationMsg = "Please enter a year (4 characters long)";
    }

    if($genre_drama = "" && $genre_sciencefiction = "" && $genre_horror = "" && $genre_mystery = "" && $genre_romance = "" && $genre_historicalfiction = "" && $genre_fantasy = "" && $genre_poetry = "" && $genre_realistnovel = "" && $genre_autobiography = "" && $genre_nonfiction = ""){
        $valid = 0;
        $genreMsg = "Please choose a genre";
    }

    if($url != ""){
        if(!filter_var($url, FILTER_VALIDATE_URL)){
            $valid = 0;
            $urlMsg = "Please enter a valid URL";
        }
    }else{
        $valid = 0;
        $urlMsg = "Please enter a website URL";
    }

    if($valid == 1){
        echo "<h2>validation passed</h2>";
        if(move_uploaded_file($_FILES['myfile']['tmp_name'], "../originals/" . $_FILES['myfile']['name'])){

            $thisFile = "../originals/" . basename($_FILES['myfile']['name']);
            
            createSquareImageCopy($thisFile, "../thumbs/", 250);
            createDisplay($thisFile, "../display/", 600);
            
            $filename = "";
            $filename = $_FILES['myfile']['name'];

            mysqli_query($con, "INSERT INTO top_books_rd (title, author, synopsis, publisher, genre_drama, genre_sciencefiction, genre_horror, genre_mystery, genre_romance, genre_historicalfiction, genre_fantasy, genre_poetry, genre_realistnovel, genre_autobiography, genre_nonfiction, publication, length, award, img_filename) VALUES ('$title', '$author', '$synopsis', '$publisher', '$genre_drama', '$genre_sciencefiction', '$genre_horror', '$genre_mystery', '$genre_romance', '$genre_historicalfiction', '$genre_fantasy', '$genre_poetry', '$genre_realistnovel', '$genre_autobiography', '$genre_nonfiction', '$publication', '$length', '$award', '$filename')") or die(mysqli_error($con));

            $msgSuccess = "Top book successfully uploaded to list :)";

            $title = "";
            $author = "";
            $synopsis = "";
            $publisher = "";
            $publication = "";
            $length = "";
            $award = "";
            $url = "";
            $genre_drama = "";
            $genre_fantasy = "";
            $genre_historicalfiction = "";
            $genre_horror = "";
            $genre_mystery = "";
            $genre_romance = "";
            $genre_sciencefiction = "";
            $genre_poetry = "";
            $genre_realistnovel = "";
            $genre_autobiography = "";
            $genre_nonfiction = "";
        }
    }
}

function createDisplay($file, $folder, $newwidth){

    list($width, $height) = getimagesize($file);
    $imgRatio = $width/$height;
    $newheight = $newwidth/ $imgRatio; 

    //echo "<p>$newwidth | $newheight";

    $thumb = imagecreatetruecolor($newwidth, $newheight);

    $source = imagecreatefromjpeg($file);

    imagecopyresampled($thumb, $source, 0,0,0,0, $newwidth, $newheight, $width, $height );
    $newFileName = $folder . basename($_FILES['myfile']['name']);
    imagejpeg($thumb, $newFileName, 80); 
    imagedestroy($thumb);
    imagedestroy($source);
}

function createSquareImageCopy($file, $folder, $newWidth){
   
    //echo "$filename, $folder, $newWidth";
    //exit();

    $thumb_width = $newWidth;
    $thumb_height = $newWidth;// tweak this for ratio

    list($width, $height) = getimagesize($file);

    $original_aspect = $width / $height;
    $thumb_aspect = $thumb_width / $thumb_height;

    if($original_aspect >= $thumb_aspect) {
    // If image is wider than thumbnail (in aspect ratio sense)
    $new_height = $thumb_height;
    $new_width = $width / ($height / $thumb_height);
    } else {
    // If the thumbnail is wider than the image
    $new_width = $thumb_width;
    $new_height = $height / ($width / $thumb_width);
    }

    $source = imagecreatefromjpeg($file);
    $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

    // Resize and crop
    imagecopyresampled($thumb,
                    $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                    0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                    0, 0,
                    $new_width, $new_height,
                    $width, $height);

    $newFileName = $folder. "/" .basename($file);
    imagejpeg($thumb, $newFileName, 80);

    // echo "<p>image uploaded: <img src=\"$newFileName\" /></p>"; // if you want to see the image


}


?>

<div class="flex">
    <h2>Insert Top Books</h2>
    <a href="../welcome.php" class="edit-btn">Admin Home</a>
</div>
<form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
    <div class="form-field required">
        <label for="myfile">Upload Book Cover Image</label>
        <input type="file" name="myfile" class="form-input">
        <?php if($fileMsg){echo $msgPreError . $fileMsg . $msgPost;} ?>
        <?php if($fileSizeMsg){echo $msgPreError . $fileSizeMsg . $msgPost;} ?>
    </div>

    <div class="form-field required">
        <label for="title">Book Title</label>
        <input type="text" id="title" name="title" class="form-input" value="<?php if($title){echo $title;} ?>">
        <?php if($titleMsg){echo $msgPreError . $titleMsg . $msgPost;} ?>
    </div>

    <div class="form-field required">
        <label for="author">Author</label>
        <input type="text" id="author" name="author" class="form-input" value="<?php if($author){echo $author;} ?>">
        <?php if($authorMsg){echo $msgPreError . $authorMsg . $msgPost;} ?>
    </div>

    <div class="form-field">
        <label for="synopsis">Synopsis</label>
        <textarea id="synopsis" name="synopsis" cols="40" rows="10"><?php if($synopsis){echo $synopsis;} ?></textarea>
    </div>

    <div class="form-input">
        <label for="publisher">Publisher</label>
        <input type="text" id="publisher" name="publisher" class="form-input" value="<?php if($publisher){echo $publisher;} ?>">
    </div>

    <div class="form-field">
        <label for="publication">Publication Year</label>
        <input type="text" id="publication" name="publication" class="form-input" value="<?php if($publication){echo $publication;} ?>">
        <?php if($publicationMsg){echo $msgPreError . $publicationMsg . $msgPost;} ?>
    </div>

    <div class="form-field required">
        <label for="genre">Genre</label>
        <div class="checkbox">
            <label><input type="checkbox" name="drama" value="1" <?php if($genre_drama == "1"){echo "checked";} ?>>Drama</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="sciencefiction" value="1" <?php if($genre_sciencefiction == "1"){echo "checked";} ?>>Science Fiction</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="horror" value="1" <?php if($genre_horror == "1"){echo "checked";} ?>>Horror</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="mystery" value="1" <?php if($genre_mystery == "1"){echo "checked";} ?>>Mystery</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="romance" value="1" <?php if($genre_romance == "1"){echo "checked";} ?>>Romance</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="historicalfiction" value="1" <?php if($genre_historicalfiction == "1"){echo "checked";} ?>>Historical Fiction</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="fantasy" value="1" <?php if($genre_fantasy == "1"){echo "checked";} ?>>Fantasy</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="poetry" value="1" <?php if($genre_poetry == "1"){echo "checked";} ?>>Poetry</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="realistnovel" value="1" <?php if($genre_realistnovel == "1"){echo "checked";} ?>>Realist Novel</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="autobiography" value="1" <?php if($genre_autobiography == "1"){echo "checked";} ?>>Autobiography</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="nonfiction" value="1" <?php if($genre_nonfiction == "1"){echo "checked";} ?>>Nonfiction</label>
        </div>
        <?php if($genreMsg){echo $msgPreError . $genreMsg . $msgPost;} ?>
    </div>

    <div class="form-field">
        <label for="length">Book Length</label>
        <input type="text" id="length" name="length" class="form-input" value="<?php if($length){echo $length;} ?>">
    </div>

    <div class="form-field">
        <label for="award">Award</label>
        <select id="award" name="award">
            <option value="">--select an award (optional)--</option>
            <option value="nobel" <?php if(isset($award) && $award == "nobel") {echo "selected";} ?>>Nobel Prize in Literature</option>
            <option value="pulitzer" <?php if(isset($award) && $award == "pulitzer") {echo "selected";} ?>>Pulitzer Prize</option>
            <option value="booker" <?php if(isset($award) && $award == "booker") {echo "selected";} ?>>Man Booker Award</option>
            <option value="newbery" <?php if(isset($award) && $award == "nobel") {echo "selected";} ?>>The John Newbery Award</option>
            <option value="national" <?php if(isset($award) && $award == "national") {echo "selected";} ?>>National Book Award</option>
            <option value="women" <?php if(isset($award) && $award == "women") {echo "selected";} ?>>Women's Prize for Fiction</option>
        </select>
    </div>
    <div class="form-field">
        <label for="url">YouTube Trailer URL</label>
        <input type="text" class="form-input url" id="url" name="url" placeholder="https://www.youtube.com/watch?v=exampleurl" value="<?php if($url){echo $url;} ?>"><?php if($urlMsg){ echo $msgPreError . $urlMsg . $msgPost; } ?>
    </div>
    <div class="form-field">
        <p>&nbsp;</p>
        <button type="submit" name="submit">Submit Book</button>
    </div>
   
</form>

<a href="<?php echo BASE_URL ?>admin/edit.php" class="edit-btn">Edit Books</a>

<?php
    if($msgSuccess){
        echo $msgPreSuccess . $msgSuccess . $msgPost;
    }
?>

<?php include("../includes/footer.php"); ?>