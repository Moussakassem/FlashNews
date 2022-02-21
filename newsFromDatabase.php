<?php
include 'datenbank.php';
if (!empty($_POST["category"])) {
    $category = $_POST['category'];
    $sql = "SELECT `id`,`category`, `title`, `description`, `link`, `urlToImage` FROM `news` WHERE `category` = '$category' ORDER BY `id` DESC";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_array()) {
        $title = $row['title'];
        $description = $row['description'];
        $url = $row['link'];
        $urlToImage = $row['urlToImage'];
        echo "<div style=\"text-align: center; cursor: pointer;\" onclick=\"window.open('" . $url . "');\">";
        echo "<h3>" . $title . "</h3>";
        echo "<img src=" . $urlToImage . " width=\"40%\" height=\"30%\">";
        echo "<p> " . $description . " </p>";
        echo "</div>";
    }
} else {
    echo "no category specified";
}
