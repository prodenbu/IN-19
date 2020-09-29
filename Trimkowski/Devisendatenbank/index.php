    <!DOCTYPE html>
    <html lang="de">
    <html>

    <head>
      <meta charset="UTF-8">
      <title>Währungsrechner</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body class="lead container h-100" style="position: absolute ; top: 50%; left: 50%; transform: translate(-50%, -50%);">
      <div class="row align-self-center h-100">
        <div class="col-6 mx-auto my-auto">
          <div class="jumbotron">
            <?php
            // Verbindung zu der Datenbank herstellen
            $servername = "192.168.62.211";
            $username = "newphp";
            $password = "1234";
            $dbname = 'project';

            $conn = new mysqli($servername, $username, $password, $dbname);
            $link = mysqli_connect($servername, $username, $password, $dbname);

            ?>
            <h1>Währungen Umrechnen</h1>

            <form action="" class="my-2" method="post">

              <!-- Erste Währung auswählen -->
              Von:
              <select name="drop1" value="">
                <!--
                     Devisen in die Dropdown Liste einfügen 
                    Andere Datenbank verwendet, weil sonst alle 165.000 Einträge aufgelistet werden. 
                    -->
                <?php
                $result = mysqli_query($conn, "SELECT * from devisen;");
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                  // USD Pre selected
                  if ($i === 26) {
                    echo "<option selected value=$row[Devise]>$row[Devise]</option>";
                  } else {
                    # code...
                    echo "<option value=$row[Devise]>$row[Devise]</option>";
                  }
                  $i++;
                }
                ?>
              </select>

              <!-- Zweite Währung auswählen -->
              Zu:
              <select name="drop2">
                <?php
                $result = mysqli_query($conn, "SELECT * from devisen;");
                while ($row = mysqli_fetch_array($result)) {
                  echo "<option value=$row[Devise]> $row[Devise] </option>";
                }
                ?>
              </select>
              <!-- Mengenangabe, Datumsangabe und Submit -->
              <form action="">
                <input type="number" placeholder="15.123" step="0.001" class="form-control" id="data" name="data" min="0">
                <!-- <label for="dateSelect">Wähle Datum</label> -->
                <input type="submit" class="btn btn-primary" value="Berechnen" name="submit">
              </form>

            </form>

            <!-- Bei Knopfdruck -->
            <?php
              
              if (isset($_POST['submit'])) {
                $result_test = mysqli_query($conn, "CALL Umrechnung('" . $_POST['drop1'] . "', '" . $_POST['drop2'] . "', '" . $_POST['data'] . "');");
                //Fehler Ausgeben, falls vorhanden 
                if ($conn->error) {
                    echo '<div class="alert-info">Du musst eine Zahl eingeben!</div>';
                };
                //   Ergebniss ausgeben
                while ($ergebiss = mysqli_fetch_array($result_test)) {
                    if ($ergebiss[0] > 0) {
                        # code...
                        echo "Das Ergebnis lautet: " .  $ergebiss[0] . " " . $_POST['drop2'];
                    } else {
                        echo '<div class="alert-danger">Wochenden gibt es hier nicht!!!</div>';
                    }
                }
            }
            ?>
            <a href="historyindex.php " class="alert-link">Historische Währungen umrechnen</a>
          </div>
        </div>
      </div>
    </body>

    </html>