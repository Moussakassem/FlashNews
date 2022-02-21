<?php
include 'datenbank.php';
if (
   !empty($_POST['category']) && !empty($_POST['title']) && !empty($_POST['description']) &&
   !empty($_POST['link']) && !empty($_FILES['file'])
) {

   //process image
   $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
   $file_loc = $_FILES['file']['tmp_name'];
   $folder = "upload/";
   $new_file_name = strtolower($file);
   $final_file = str_replace(' ', '-', $new_file_name);
   move_uploaded_file($file_loc, $folder . $final_file);

   //prepare news article
   $category = $_POST['category'];
   $title = $_POST['title'];
   $description = $_POST['description'];
   $url = $_POST['link'];
   $urlToImage = $folder . $final_file;

   //insert into database
   $sql = "INSERT INTO news (`category`, `title`, `description`, `link`, `urlToImage`) VALUES ('$category','$title','$description','$url','$urlToImage')";
   mysqli_query($conn, $sql);

   //display inserted news article
   echo "<h2 style=\"text-align: center\"> news article was successfully added </h3>";
   echo "<div style=\"text-align: center; cursor: pointer;\" onclick=\"window.open('" . $url . "');\">";
   echo "<h3>" . $title . "</h3>";
   echo "<img src=" . $urlToImage . " width=\"40%\" height=\"30%\">";
   echo "<p> " . $description . " </p>";
   echo "</div>";
} else {
   echo "please fill out all the fields";
}
