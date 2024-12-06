<?php
include("connect.php");

if (isset($_POST['btnSubmitPost'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $content = $_POST['content'];
    $dateTime = $_POST['dateTime'];
    
    $content = mysqli_real_escape_string($conn, $content);

    $userInfoQuery = "INSERT INTO userinfo (firstName, lastName) VALUES ('$firstName', '$lastName')";
    executeQuery($userInfoQuery);

    $userInfoID = mysqli_insert_id($conn);


    $postQuery = "INSERT INTO posts (content, dateTime, userInfoID) VALUES ('$content', '$dateTime', $userInfoID)";
    executeQuery($postQuery);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['btnDeletePost'])) {
    $postID = $_POST['postID'];
    $deleteQuery = "DELETE FROM posts WHERE postID = '$postID'";
    executeQuery($deleteQuery);
}

$query = "SELECT u.firstName, u.lastName, p.content AS postContent, p.dateTime AS postDateTime, p.postID
          FROM userinfo u
          JOIN posts p ON u.userID = p.userID;";


$result = executeQuery($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg shadow fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Macatangay_wordmark.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 100px;">
        <h3>Create a Post</h3>
        <form method="post">
            <div class="mb-3">
                <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
            </div>
            <div class="mb-3">
                <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
            </div>
            <div class="mb-3">
                <textarea name="content" class="form-control" placeholder="Content" required></textarea>
            </div>
            <div class="mb-3">
                <input type="date" name="dateTime" class="form-control" required>
            </div>
            <button type="submit" name="btnSubmitPost" class="btn btn-primary">Post</button>
        </form>


        <h1 class="mt-5">All Posts</h1>
        <div class="row">
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
    <div class="card rounded-4 shadow my-3">
        <div class="card-body">
            <h3 class="card-text"><b><?php echo $row['firstName'] . " " . $row['lastName']; ?></b></h3> 
            <p class="card-title"><?php echo "Post # " . $row['postID']; ?></p> 
            <p class="card-text"><?php echo $row['postContent']; ?></p>
        </div>
        <div class="card-footer">
            <small class="text-muted"><?php echo "Posted on: " . $row['postDateTime']; ?></small> 
            <form method="post" class="mt-2">
                <input type="hidden" name="postID" value="<?php echo $row['postID']; ?>">
                <button type="submit" name="btnDeletePost" class="btnDelete btn btn-outline-danger">X</button>
            </form>
        </div>
    </div>
</div>

                <?php
            }
            ?>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
</body>
</html>
