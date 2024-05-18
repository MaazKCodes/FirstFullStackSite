<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <style media="screen">
  .here { color: #FF0000;}
  .resultStyle {
    margin-top: 25px;
    text-align: center; 
    line-height: 2.5; 
  }
  .results-container {
    max-width: 600px;
    margin: 30px auto;
    padding: 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f8f9fa;
  }
  .resultText {
    color: black; 
  }
  .boldText {
    font-weight: bold; 
  }
</style>


  <title>Results</title>
</head>
<body>
<nav id="navbar-site" class="navbar navbar-dark bg-dark navbar-expand-sm">
    <div class="container">
      <a class="navbar-brand" href="#">Maaz Khalil's IT Website - Tools Survey Results</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="navbar-nav ml-sm-auto">
      <a class="nav-item nav-link" href="homepage.html">Home</a>
      <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="services-dropdown" role="button"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info-Tech</a>
        <div class="dropdown-menu" aria-labelledby="services-dropdown">
          <a class="dropdown-item" href="infotech.html">Overview</a>
          <a class="dropdown-item" href="kohanew.html">Koha ILS</a>
          <a class="dropdown-item" href="formpage.html">Info Tech Tools</a>
          <a class="dropdown-item here" href="formpageresults.php">Tools Survey Results</a>
        </div>
      </div>
      <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="services-dropdown" role="button"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Interests</a>
        <div class="dropdown-menu" aria-labelledby="services-dropdown">
         <a class="dropdown-item" href="interestsmain.html">NJ Wildlife</a>
          <a class="dropdown-item" href="interestsbear.html">Bears</a>
          <a class="dropdown-item" href="interestswolf.html">Wolves</a>
          <a class="dropdown-item" href="interestsfox.html">Foxes</a>
        </div>
      </div>
      <a class="nav-item nav-link" href="aboutme.html">About</a>
    </div>
  </div>
</div>
</nav>
    <div>
</div>
      <?php

      require 'login_Khalil.php';

      $db_connect = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
      
      if (!$db_connect) {
          die("Connection failed: " . mysqli_connect_error());
      }
  $tools_valid = true;
  for ($i = 1; $i <= 10; $i++) {
      if (!isset($_POST["tool$i"])) {
          $tools_valid = false;
          break;
      }
  }

  if ($tools_valid) {

      $tools = [];
      for ($i = 1; $i <= 10; $i++) {
          $tools["tool$i"] = mysqli_fix_string($db_connect, $_POST["tool$i"]);
      }

      $query = "INSERT INTO tools (tool1, tool2, tool3, tool4, tool5, tool6, tool7, tool8, tool9, tool10) VALUES" .
          "('{$tools['tool1']}', '{$tools['tool2']}', '{$tools['tool3']}', '{$tools['tool4']}', '{$tools['tool5']}', '{$tools['tool6']}', '{$tools['tool7']}', '{$tools['tool8']}', '{$tools['tool9']}', '{$tools['tool10']}')";

      if (!mysqli_query($db_connect, $query)) {
          echo "INSERT failed: $query<br>" .
              mysqli_error($db_connect) . "<br><br>";
      }
  }

  $query = "SELECT SUM(tool1), SUM(tool2), SUM(tool3), SUM(tool4), SUM(tool5), SUM(tool6), SUM(tool7), SUM(tool8), SUM(tool9), SUM(tool10) FROM tools";

  $result = mysqli_query($db_connect, $query);
  if (!$result)
  if (!$result) die("Database access failed: " . mysqli_error($db_connect));

  $firstrow = mysqli_fetch_row($result);

$row_count_query = "SELECT COUNT(*) FROM tools";
$row_count_result = mysqli_query($db_connect, $row_count_query);
if (!$row_count_result) die("Database access failed: " . mysqli_error($db_connect));
$row_count = mysqli_fetch_row($row_count_result);
$rows = $row_count[0];

  echo '<div class=\'resultStyle\'>';
  echo '<h3 class="text-center">Form Results</h3>';
  echo '<div class="results-container">';
  echo '<div class=\'resultStyle\'>';  

  for ($i = 0; $i < 10; $i++) {
    echo '<span class="boldText">Tool ' . ($i + 1) . ':</span> SUM = <span class="boldText">' . $firstrow[$i] . '</span> and AVE = <span class="boldText">' . number_format($firstrow[$i] / $rows, 2) . '</span><br>';
  }  

  echo '<hr>';
  echo '</div>'; 
  echo '</div>';

  function displayPostArray($postarray)
  {

      foreach ($postarray as $tool => $score) {
          echo "$tool" . " = " . "$score<br>";
      }
      
  }

  function mysqli_fix_string($db_connect, $string)
  {

      return mysqli_real_escape_string($db_connect, $string);
  }
  ?>
</div>
</div>
<footer class="bg-dark text-white py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p>&copy; 2023 Maaz Khalil's IT Website. All rights reserved.</p>
      </div>
      <div class="col-md-6 text-right">
        <p><a href="#" class="text-white">Home</a> | <a href="#" class="text-white">Info-Tech</a> | <a href="#" class="text-white">Interests</a> | <a href="#" class="text-white">About</a></p>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
