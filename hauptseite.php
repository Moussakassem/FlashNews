<!DOCTYPE html>
<html>

<head>
  <title>Hauptseite</title>
</head>

<body onLoad="getNews('general')" style="background-color:powderblue">
  <a href="index.php">Zurück</a>
  <?php
  session_start();

  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo "
      <h2>Einloggen</h2>
      <form action=\"login.php\" method=\"post\">
        <label>Benutzername:</label> <br>
        <input type=\"text\" name=\"username\"> <br>
        <label>Passwort:</label><br>
        <input type=\"password\" name=\"password\"> <br>
        <input type=\"submit\" value=\"Submit\">
      </form> 
      ";
    echo "
      <h2>Registrieren</h2>
      <form action=\"register.php\" method=\"post\">
        <label>Benutzername:</label> <br>
        <input type=\"text\" name=\"username\"> <br>
        <label>Passwort:</label><br>
        <input type=\"password\" name=\"password\"> <br>
        <input type=\"submit\" value=\"Submit\">
      </form> 
      ";
  } else {
    echo "
    <h2>Nachricht hinzufügen</h2>
    <form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">
      <label>Kategorie: </label> <br>
      <select name=\"category\">
        <option value=\"business\">Wirtschaft</option>
        <option value=\"sports\">Sport</option>
        <option value=\"health\">Gesundheit</option>
        <option value=\"technology\">Technologie</option>
        <option value=\"science\">Wissenschaft</option>
        <option value=\"entertainment\">Unterhaltung</option>
      </select> <br>
      <label>Titel: </label> <br>
      <input type=\"text\" name=\"title\" /> <br>
      <label>Beschreibung: </label> <br>
      <input type=\"text\" name=\"description\" /> <br>
      <label>Link: </label> <br>
      <input type=\"url\" name=\"link\" /> <br>
      <label>Bild: </label> <br>
      <input type=\"file\" name=\"file\" /> <br>
      <button type=\"submit\" name=\"upload\">upload</button> <br>
    </form>
    <a href=\"logout.php\">Sign Out of Your Account</a>
      ";
  }
  ?>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script>
    function getNews(category) {
      $.post("newsFromApi.php", {
        "category": category
      }, function(result) {
        document.getElementById("apiNews").innerHTML = result;
      });

      $.post("newsFromDatabase.php", {
        "category": category
      }, function(result) {
        document.getElementById("userNews").innerHTML = result;
      });
    }
  </script>
  <div class="tab">
    <button class="tablinks" onclick="getNews('business')">Wirtschaft</button>
    <button class="tablinks" onclick="getNews('sports')">Sport</button>
    <button class="tablinks" onclick="getNews('health')">Gesundheit</button>
    <button class="tablinks" onclick="getNews('technology')">Technologie</button>
    <button class="tablinks" onclick="getNews('science')">Wissenschaft</button>
    <button class="tablinks" onclick="getNews('entertainment')">Unterhaltung</button>
    <style>
      .tab {
        align-self: center;
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
      }

      .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
      }

      .tab button:hover {
        background-color: #ddd;
      }

      .tab button.active {
        background-color: #ccc;
      }
    </style>
  </div>
  <h2 style="text-align:center">Benutzer Nachrichten</h2>
  <div id="userNews">
  </div>
  <div id="apiNews">
  </div>
</body>
</div>

</html>