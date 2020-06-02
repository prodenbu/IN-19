<!DOCTYPE html>
<html lang="de">
<html>

<head>
  <meta charset="UTF-8">
  <title>Währungsrechner</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <div class="container">

    <?php
    $servername = "192.168.62.211";
    $username = "newphp";
    $password = "1234";
    $dbname = 'project';

    $conn = new mysqli($servername, $username, $password, $dbname);
    $link = mysqli_connect($servername, $username, $password, $dbname);

    ?>
    <h1>Währungen zum Umrechnen</h1>
    <div class="row">
      <form action="" method="post">
        <!-- Dropdown 1 -->

        <select name="drop1">
          <?php
          $result = mysqli_query($conn, "SELECT * from devisen;");
          while ($row = mysqli_fetch_array($result)) {
            echo "<option value=$row[Devise]> $row[Devise] </option>";
          }
          ?>
        </select>

        <!-- Drop2 -->

        <select name="drop2">
          <?php
          $result = mysqli_query($conn, "SELECT * from devisen;");
          while ($row = mysqli_fetch_array($result)) {
            echo "<option value=$row[Devise]> $row[Devise] </option>";
          }
          ?>
        </select>

    </div>

    <div class="row">

      <!-- Mengenangabe und Submit -->
      <input type="number" id="data" name="data" min="o">
      <input type="submit" class="btn btn-primary" value="Berechnen" name="submit">
    </div>

    </form>

    <!-- Submit und Ergebnisverkündung -->
    <?php
    if (isset($_POST['submit'])) {

      $result_test = mysqli_query($conn, "CALL do_math('" . $_POST['drop1'] . "', '" . $_POST['drop2'] . "', '" . $_POST['data'] . "');");

      while ($test_row = mysqli_fetch_array($result_test)) {
        echo "Das Ergebnis lautet: " . $test_row[0];
      }
    }
    ?>

  </div>
</body>

</html>