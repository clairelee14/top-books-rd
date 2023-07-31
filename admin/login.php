<?php

include("../data/data.php");
$msg = "";

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(($username == $username_login) && (password_verify($password, $pw_enc))){

        session_start();
        $_SESSION['top-books-rd-session-clairelee'] = session_id();

        if(isset($_GET['refer'])){
            if($_GET['refer'] == "welcome"){
                header("Location:../welcome.php");
            }else{
                header("Location:insert.php");
            }
        }else{
            header("Location:insert.php");
        }
    }else{
        if($username != "" && $password != ""){
            $msg = "Invalid Login";
        }else {
            $msg = "Please enter a Username/Password";
        }
    }
}


include("../includes/header.php");
?>

<h2>Log-In</h2>
<form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

    <div class="form-field required">
        <label for="username">Username: </label>
        <input type="text" name="username" class="form-input">
    </div>
    <div class="form-field required">
        <label for="password">Password: </label>
        <input type="password" name="password" class="form-input">
    </div>
    <div class="form-field">
        <p>&nbsp;</p>
        <button type="submit" name="submit">login</button>
    </div>

</form>

<?php

if($msg){
    echo "<div class=\"error-message\">$msg</div>";
}

?>

<?php
    include("../includes/footer.php");
?>