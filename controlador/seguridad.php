<?php



if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){  
} else {
    echo "<div class='alert alert-danger' role='alert'>
    <h4>You need to login to access this page.</h4>
    <p><a href='index.php'>Login Here!</a></p></div>";
    exit;
}  


?>