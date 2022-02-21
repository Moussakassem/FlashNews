<?php
require_once __DIR__ . '/vendor/autoload.php';

use jcobhams\NewsApi\NewsApi;

if (!empty($_POST["category"])) {
    $newsapi = new NewsApi('');
    $top_headlines = $newsapi->getTopHeadLines(category: $_POST["category"], country: "de");
    $articles = $top_headlines->articles;
    foreach ($articles as $article) {
        $title = $article->title;
        $description = $article->description;
        $url = $article->url;
        $urlToImage = $article->urlToImage;
        echo "<div style=\"text-align: center; cursor: pointer;\" onclick=\"window.open('" . $url . "');\">";
        echo "<h3>" . $title . "</h3>";
        echo "<img src=" . $urlToImage . " width=\"40%\" height=\"30%\">";
        echo "<p> " . $description . " </p>";
        echo "</div>";
    }
} else {
    echo "no category specified";
}
