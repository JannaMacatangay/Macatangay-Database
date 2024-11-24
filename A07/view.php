<?php
include("connect.php");

$postID = $_GET['postID'];

if (isset($_POST['btnEditPost'])) {
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $updateUserQuery = "UPDATE posts SET content='$content' WHERE postID='$postID'";
    executeQuery($updateUserQuery);

    header("Location: index.php");
}

$query = "SELECT * FROM posts WHERE postID='$postID'";
$results = executeQuery($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (mysqli_num_rows($results) > 0) {
        while ($post = mysqli_fetch_assoc($results)) {
            ?>

            <div class="container d-flex justify-content-center align-items-center min-vh-100">
                <div class="card p-4 shadow" style="width: 100%; max-width: 500px;">
                    <h2 class="text-center mb-4">Edit Post</h2>
                    <form method="post" class="row g-3">
                        <div class="mb-3">
                            <textarea name="content" class="form-control" placeholder="Content"
                                required><?php echo $post['content']; ?></textarea>
                        </div>
                        <div class="col-12 text-start">
                            <button type="submit" class="btn btn-primary" name="btnEditPost">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>