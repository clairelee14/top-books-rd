<?php include("includes/header.php") ?>
    <h2>Genre Filters</h2>
    <div class="genre">
            <?php $result = mysqli_query($con, "SELECT * FROM top_books_rd") or die (mysqli_error($con)); ?>
            <?php
            $x = "";
            if(isset($_GET['x'])){
                $x = $_GET['x'];
            }
            if(isset($_GET['y'])){
                $y = $_GET['y'];
            }

                if($x == "genre_drama"){
                    echo "<h3>" . "Genre Chosen: Drama" . "</h3>";
                    }
                if($x == "genre_sciencefiction"){
                    echo "<h3>" . "Genre Chosen: Science Fiction" . "</h3>";
                    }
                if($x == "genre_horror"){
                    echo "<h3>" . "Genre Chosen: Horror" . "</h3>";
                    }
                if($x == "genre_mystery"){
                    echo "<h3>" . "Genre Chosen: Mystery" . "</h3>";
                    }
                if($x == "genre_romance"){
                    echo "<h3>" . "Genre Chosen: Romance" . "</h3>";
                    }
                if($x == "genre_historicalfiction"){
                    echo "<h3>" . "Genre Chosen: Historical Fiction" . "</h3>";
                    }
                if($x == "genre_fantasy"){
                    echo "<h3>" . "Genre Chosen: Fantasy" . "</h3>";
                    }
                if($x == "genre_poetry"){
                    echo "<h3>" . "Genre Chosen: Poetry" . "</h3>";
                    }
                if($x == "genre_realistnovel"){
                    echo "<h3>" . "Genre Chosen: Realist Novel" . "</h3>";
                    }
                if($x == "genre_autobiography"){
                    echo "<h3>" . "Genre Chosen: Autobiography" . "</h3>";
                    }
                if($x == "genre_nonfiction"){
                    echo "<h3>" . "Genre Chosen: Nonfiction" . "</h3>";
                    }

            if(isset($x) && isset($y)){
                $result = mysqli_query($con, "SELECT * FROM top_books_rd WHERE $x LIKE '$y'") or die(mysqli_error($con));
            }
            ?>
        <div class="front-page-box">
                <?php while($row = mysqli_fetch_array($result)): ?>
                    <?php
                        $title = $row['title'];
                        $img = $row['img_filename'];
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
                        $book_id = $row['book_id']
                    ?>
            <div class="book-thumb">
                <a href="bookprofile.php?book_id=<?php echo $row['book_id']?>"><img src="thumbs/<?php echo $row['img_filename'] ?>"></a>
                <p><?php echo $row['title']?></p>
                <div class="book-thumb-genre">
                    <?php if($row['genre_drama'] == "1"): ?>
                        <p style="color: #CC6600">DRAMA | </p>
                    <?php endif; ?>

                    <?php if($row['genre_sciencefiction'] == "1"): ?>
                        <p style="color: #4a6c20">SCIENCE FICTION | </p>
                    <?php endif; ?>

                    <?php if($row['genre_horror'] == "1"): ?>
                        <p style="color: #C13100">HORROR | </p>
                    <?php endif; ?>

                    <?php if($row['genre_mystery'] == "1"): ?>
                        <p style="color: #216974">MYSTERY | </p>
                    <?php endif; ?>

                    <?php if($row['genre_romance'] == "1"): ?>
                        <p style="color: #41766F">ROMANCE | </p>
                    <?php endif; ?>

                    <?php if($row['genre_historicalfiction'] == "1"): ?>
                        <p style="color: #A34828">HISTORICAL FICTION | </p>
                    <?php endif; ?>

                    <?php if($row['genre_sciencefiction'] == "1"): ?>
                        <p style="color: #D1711F">FANTASY | </p>
                    <?php endif; ?>

                    <?php if($row['genre_poetry'] == "1"): ?>
                        <p style="color: #ED6335">POETRY | </p>
                    <?php endif; ?>

                    <?php if($row['genre_realistnovel'] == "1"): ?>
                        <p style="color: #8DB4AD">REALIST NOVEL | </p>
                    <?php endif; ?>

                    <?php if($row['genre_autobiography'] == "1"): ?>
                        <p style="color: #064C72">AUTOBIOGRAPHY | </p>
                    <?php endif; ?>

                    <?php if($row['genre_nonfiction'] == "1"): ?>
                        <p style="color: #E9311A">NONFICTION | </p>
                    <?php endif; ?>
                </div> <!-- end of book-thumb-genre -->
            </div> <!-- end of book-thumb -->
        <?php endwhile; ?>
        </div> <!-- end of front-page-box -->
        

        <div class="sidebar-genre">
            <div>
                <a href="genre.php">ALL Genres</a>
            </div>
            <div class="genre-links">
                <div>
                    <a href="genre.php?x=genre_drama&y=1">Drama |</a>
                </div>
                <div>
                    <a href="genre.php?x=genre_sciencefiction&y=1">Science Fiction |</a>
                </div>
                <div>
                    <a href="genre.php?x=genre_horror&y=1">Horror |</a>
                </div>
                <div>
                    <a href="genre.php?x=genre_mystery&y=1">Mystery |</a>
                </div>
                <div>
                    <a href="genre.php?x=genre_romance&y=1">Romance |</a>
                </div>
                <div>
                    <a href="genre.php?x=genre_historicalfiction&y=1">Historical Fiction |</a>
                </div>
                <div>
                <a href="genre.php?x=genre_fantasy&y=1">Fantasy |</a>
                </div>
                <div>
                    <a href="genre.php?x=genre_poetry&y=1">Poetry |</a>
                </div>
                <div>
                    <a href="genre.php?x=genre_autobiography&y=1">Autobiography |</a>
                </div>
                <div>
                    <a href="genre.php?x=genre_nonfiction&y=1">Nonfiction |</a>
                </div>
            </div>
        </div><!-- end of sidebar -->
    </div> <!-- end of genre -->

<?php include("includes/footer.php") ?>