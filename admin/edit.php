<?php 

session_start();
if(!isset($_SESSION['top-books-rd-session-clairelee'])){
    header("Location:login.php?refer=welcome");
}

include("../includes/header.php"); 

?>

<?php 
    $bookid = "";
    if(isset($_GET['book_id'])){
        $bookid = $_GET['book_id'];
    }
	if(!isset($bookid)){
		$default = mysqli_query($con, "SELECT book_id FROM top_books_rd LIMIT 1") or die(mysqli_error($con));
		while($row = mysqli_fetch_array($default)){
			$bookid = $row['book_id']; 
		}
	}

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
$updateValidMsg = "";
$navLinks = "";

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

    if((strlen($title) < 3) || (strlen($title) > 75)){
        // $valid = 0;
        $titleMsg = "Please enter a title from 2 to 75 characters";
    }

    if((strlen($author) < 2) || (strlen($author) > 80)){
        $valid = 0;
        $authorMsg = "Please enter an author name from 2 to 80 characters";
    }

    if((strlen($publication) < 4) || (strlen($publication) > 4)){
        // $valid = 0;
        $publicationMsg = "Please enter a year (4 characters long)";
    }

    if($genre_drama = "" && $genre_sciencefiction = "" && $genre_horror = "" && $genre_mystery = "" && $genre_romance = "" && $genre_historicalfiction = "" && $genre_fantasy = "" && $genre_poetry = "" && $genre_realistnovel = "" && $genre_autobiography = "" && $genre_nonfiction = ""){
        // $valid = 0;
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

        mysqli_query($con, "UPDATE top_books_rd SET
        title = '$title',
        author = '$author',
        synopsis = '$synopsis',
        publisher = '$publisher',
        genre_drama = '$genre_drama',
        genre_sciencefiction = '$genre_sciencefiction',
        genre_horror = '$genre_horror',
        genre_mystery = '$genre_mystery',
        genre_romance = '$genre_romance',
        genre_historicalfiction = '$genre_historicalfiction',
        genre_fantasy = '$genre_fantasy',
        genre_poetry = '$genre_poetry',
        genre_realistnovel = '$genre_realistnovel',
        genre_autobiography = '$genre_autobiography',
        genre_nonfiction = '$genre_nonfiction',
        publication = '$publication',
        length = '$length',
        award = '$award',
        url = '$url'
        WHERE book_id = '$bookid'") or die(mysqli_error($con));
        $updateValidMsg = "Book Updated";
    }
}

$result = mysqli_query($con, "SELECT * FROM top_books_rd") or die(mysqli_error($con));

while($row = mysqli_fetch_array($result)){

    $title = $row['title'];
    $id = $row['book_id'];

    if($bookid == $id){
        $navLinks .= "\n\t<b><a href=\"edit.php?book_id=$id\" class=\"edit-list\">$title</a><br>";
    }else{
        $navLinks .= "\n\t<a href=\"edit.php?book_id=$id\" class=\"edit-list\">$title</a><br>";
    }
}

$result = mysqli_query($con, "SELECT * FROM top_books_rd WHERE book_id = '$bookid'") or die(mysqli_error($con));

while($row = mysqli_fetch_array($result)){
    $title = $row['title'];
    $author = $row['author'];
    $synopsis = $row['synopsis'];
    $publisher = $row['publisher'];
    $genre_drama = $row['genre_drama'];
    $genre_sciencefiction = $row['genre_sciencefiction'];
    $genre_horror = $row['genre_horror'];
    $genre_mystery = $row['genre_mystery'];
    $genre_romance = $row['genre_romance'];
    $genre_historicalfiction = $row['genre_historicalfiction'];
    $genre_fantasy = $row['genre_fantasy'];
    $genre_poetry = $row['genre_poetry'];
    $genre_realistnovel = $row['genre_realistnovel'];
    $genre_autobiography = $row['genre_autobiography'];
    $genre_nonfiction = $row['genre_nonfiction'];
    $publication = $row['publication'];
    $length = $row['length'];
    $award = $row['award'];
    $url = $row['url'];
}
?>
<div class="flex">
    <h2>Edit Top Books</h2>
    <a href="../welcome.php" class="edit-btn">Admin Home</a>
</div>
<div class="form-page">
    <div class="col">
        <form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
            <div class="form-field required">
                <label for="title">Book Title</label>
                <input type="text" id="title" name="title" value="<?php if($title){echo $title;} ?>">
                <?php if($titleMsg){echo $msgPreError . $titleMsg . $msgPost;} ?>
            </div>

            <div class="form-field required">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" value="<?php if($author){echo $author;} ?>">
                <?php if($authorMsg){echo $msgPreError . $authorMsg . $msgPost;} ?>
            </div>

            <div class="form-field">
                <label for="synopsis">Synopsis</label>
                <textarea id="synopsis" name="synopsis" cols="40" rows="10"><?php if($synopsis){echo $synopsis;} ?></textarea>
            </div>

            <div class="form-field">
                <label for="publisher">Publisher</label>
                <input type="text" id="publisher" name="publisher" value="<?php if($publisher){echo $publisher;} ?>">
            </div>

            <div class="form-field">
                <label for="publication">Publication Year</label>
                <input type="text" id="publication" name="publication" value="<?php if($publication){echo $publication;} ?>">
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
            </div>

            <div class="form-field">
                <label for="length">Book Length</label>
                <input type="text" id="length" name="length" value="<?php if($length){echo $length;} ?>">
            </div>

            <div class="form-field">
                <label for="award">Award</label>
                <select id="award" name="award">
                    <option value="">--select an award (optional)--</option>
                    <option value="nobel" <?php if(isset($award) && $award == "nobel") {echo "selected";} ?>>Nobel Prize in Literature</option>
                    <option value="pulitzer" <?php if(isset($award) && $award == "pulitzer") {echo "selected";} ?>>Pulitzer Prize</option>
                    <option value="booker" <?php if(isset($award) && $award == "booker") {echo "selected";} ?>>Man Booker Award</option>
                    <option value="newbery" <?php if(isset($award) && $award == "newbery") {echo "selected";} ?>>The John Newbery Award</option>
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
                <button type="submit" name="submit">Update Book</button>
            </div>
        
        </form>
        <a href="delete.php?book_id=<?php echo $bookid ?>" class="btn">Delete</a>
    </div>
    <div class="col">
        <?php echo $navLinks; ?>
    </div>
</div>