<?php include("includes/header.php") ?>
<?php

$displayby = "";
$displayvalue = "";
$sql = "";

if(isset($_GET['displayby'])){
  $displayby = $_GET['displayby'];
}
if(isset($_GET['displayvalue'])){
  $displayvalue = $_GET['displayvalue'];
}
if($displayby && $displayvalue){
  $sql = "SELECT * FROM top_books_rd WHERE $displayby LIKE '$displayvalue'";
}

if($displayvalue == "newbery"){
    echo "<h2>" . "John Newbery Medal Award Winners" . "</h2>";
    echo "<p class=\"award-blurb\">" . "The <b>John Newbery Medal</b>, frequently shortened to the <b>Newbery</b>, is a literary award given by the Association for Library Service to Children (ALSC), a division of the American Library Association (ALA), to the author of \"the most distinguished contributions to American literature for children\" The Newbery and the Caldecott Medal are considered the two most prestigious awards for children's literature in the United States." . "</p>";
}
if($displayvalue == "national"){
    echo "<h2>" . "National Book Award Winners" . "</h2>";
    echo "<p class=\"award-blurb\">" . "The <b>National Book Award</b> are a set of annual U.S literary awards. At the final National Book Awards Ceremony every November, the National Book Foundation presents the National Book Awards and two lifetime achievement awards to authors. The National Book Awards were established in 1936 by the American Booksellers Association, abandoned during World War II, and re-established by three book industry organizations in 1950." . "</p>";
}
if($displayvalue == "pulitzer"){
    echo "<h2>" . "Pulitzer Prize Award Winners" . "</h2>";
    echo "<p class=\"award-blurb\">" . "The <b>Pulitzer Prize</b> is an award for achievements in newspaper, magazine, online journalism, literature, and musical composition within the United States. It was established in 1917 by provisions in the will of Joseph Pulitzer, who had made his fortune as a newspaper publisher, and is administered by Columnbia University. Prizes are awarded annually in twenty-one catergories. In twenty on the categaroies, each winner receives a certificate and a US$15,000 cash award (raised from $10,000 in 2017). The winner of the public service category is awarded a gold medal." . "</p>";
}
if($displayvalue == "nobel"){
  echo "<h2>" . "Nobel Prize Award Winners" . "</h2>";
  echo "<p class=\"award-blurb\">" . "The <b>Nobel Prize in Literatue</b> is a Swedish literature prize that is awarded annually, since 1901, to an author from any country who has, in the words of the will of Swedish industrialist, Alfred Nobel, \"in the field of literature, produced the most outstanding work in an idealistic direction\". Though indiviual works are sometimes cited as being particularly noteworhty, the award is based on an author's body of work as a whole. The Swedish Academy decided who, if anyone, will recieve the prize." . "</p>";
}
if($displayvalue == "women"){
  echo "<h2>" . "Women's Prize for Fiction Winners" . "</h2>";
  echo "<p class=\"award-blurb\">" . "The <b>Women's Prize for Fiction</b> (previously with sponsor names <b>Orange Prize for Fiction</b> is one of the United Kingdon's most prestigious literary prizes. It was awarded annually to a female author of any nationality for the best original full-length novel written in English and published in the United Kingdom in the preceding year." . "</p>";
}
if($displayvalue == "booker"){
  echo "<h2>" . "Man Booker Award Winners" . "</h2>";
  echo "<p class=\"award-blurb\">" . "The <b>International Booker Prize</b> (formerly known as the Man Booker International Prize) is an international literary award hosted in the United Kingdom. The introduction of the International Prize to complement the Man Booker Prize was announced in June 2004. Sponsored by the Man Group, from 2005 until 2015 the award was given every two years to a living author of any nationality for a body of work published in English or generally available in English translation. It rewarded one author's \"continued creativity, development and overall contribution to fiction on the world stage\", and was a recognition of the wrtier's body of work rather than any one title." . "</p>";
}
?>
<div class="filter-menu-prize">
    <div>
      <a href="prize.php?displayby=award&displayvalue=pulitzer">Pulitzer Prize</a>
    </div>
    <div>
      <a href="prize.php?displayby=award&displayvalue=nobel">Nobel Prize</a>
    </div>
    <div>
      <a href="prize.php?displayby=award&displayvalue=newbery">John Newbery Medal</a>
    </div>
    <div>
      <a href="prize.php?displayby=award&displayvalue=national">National Book Award</a>
    </div>
    <div>
      <a href="prize.php?displayby=award&displayvalue=women">Women's Prize</a>
    </div>
    <div>
      <a href="prize.php?displayby=award&displayvalue=booker">Man Booker Award</a>
    </div>
</div>

<?php

echo "<div class=\"front-page-box\">";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)){
    $title = $row['title'];
    $book_id = $row['book_id'];
    $image_file = $row['img_filename'];
    echo "<div class=\"book-thumb\">";
    echo "<a href=\"bookprofile.php?book_id=$book_id\"><img src=\"thumbs/$image_file\"/></a><br/>";
    echo "<a href=\"bookprofile.php?book_id=$book_id\">$title</a><br/>";
    echo "</div>";
    }
echo "</div>";

?>

<?php include("includes/footer.php") ?>