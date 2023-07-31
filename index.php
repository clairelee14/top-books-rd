<?php include ("includes/header.php"); ?>

<div class="filters">
  <div>
    <div class="front-page-header">
      <div class="welcome">
        <h3>Welcome to Reader's Digest's Top Books(ish)</h3>
        <p>A little like that bucketlist that you should read before you die. From science fiction to historical fiction to poetry, or pulitzer prize winners to newberry medal winners, this site will take you through the best books (arguably) of all time.</p>
        <p>There are some books thrown in there for personal preference (hence the "ish"), but I assure you, WELL worth the read. </p>
      </div>
      <?php $result = mysqli_query($con, "SELECT * FROM top_books_rd ORDER BY RAND() LIMIT 1"); ?>

      <div class="rand-book">
        <!-- Here we write the beginning of the while loop -->
          <?php while($row = mysqli_fetch_array($result)): ?>
          <div class="book-thumb">
            <h3>Reader's Book of the Day</h3>
            <a href="bookprofile.php?book_id=<?php echo $row['book_id']?>"><img src="thumbs/<?php echo $row['img_filename'] ?>"></a>

            <p><?php echo $row['title']?></p>
          </div>

          <?php endwhile; ?>
      </div>
    </div>

    <div class="left-filter-box">
      <div class="filter-head">
        <h3>Books by Literary Awards</h3>
        <div class="nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
          </svg>
        </div>
      </div>
      <div class="filter-menu">
        <div>
          <div class="award-link">
            <a href="prize.php?displayby=award&displayvalue=pulitzer">Pulitzer Prize</a>
          </div>
          <div class="award-link">
            <a href="prize.php?displayby=award&displayvalue=nobel">Nobel Prize</a>
          </div>
          <div class="award-link">
            <a href="prize.php?displayby=award&displayvalue=newbery">John Newbery Medal</a>
          </div>
        </div>
        <div>
          <div class="award-link">
            <a href="prize.php?displayby=award&displayvalue=national">National Book Award</a>
          </div>
          <div class="award-link">
            <a href="prize.php?displayby=award&displayvalue=women">Women's Prize</a>
          </div>
          <div class="award-link">
            <a href="prize.php?displayby=award&displayvalue=booker">Man Booker Award</a>
          </div>
        </div>
      </div>

      <div class="filter-head">
        <h3>Books by Length </h3>
        <div class="nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75h1.5m9 0h-9" />
          </svg>
        </div>
      </div>
      <div class="filter-menu">
        <a href="booklength.php">Go filter some books by pages</a>
      </div>

      <div class="filter-head">
        <h3>Books by Genre</h3>
        <div class="nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
          </svg>
        </div>
      </div>
      <div class="filter-menu">
        <a href="genre.php">Go filter some books by genre</a>
      </div>
    </div> <!-- left column -->
  </div>
  <div class="authors-list">
    <h3>A - Z Authors</h3>
      <div>
        <?php
        $qry = "SELECT *, LEFT(author, 1) AS first_char FROM top_books_rd WHERE UPPER(author) BETWEEN 'A' AND 'Z' ORDER BY author";

        $result = mysqli_query($con, $qry);
        $current_char = '';

        while ($row = mysqli_fetch_assoc($result)){
          if ($row['first_char'] != $current_char){
            $current_char = $row['first_char'];
            $thisChar = strtoupper($current_char);
            echo "<a href=\"authors.php?displayby=author&displayvalue=$thisChar%\"><div class=\"alpha-author\">$thisChar</div></a>";
          }
        }?>
      </div>
  </div>
</div> <!-- end of filter -->


<?php include ("includes/footer.php"); ?>