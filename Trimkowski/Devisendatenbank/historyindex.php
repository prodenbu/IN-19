<!DOCTYPE html>
<html lang="de">
<html>

<head>
    <meta charset="UTF-8">
    <title>Währungsrechner</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="lead container h-100" style="position: absolute ; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <div class="row  align-self-center h-100">
        <div class="mx-auto col-6 my-auto">
            <div class="jumbotron">
                <div class="">
                    <h1>Währungen Umrechnen</h1>
                    <?php
                    // Verbindung zu der Datenbank herstellen
                    $servername = "192.168.62.211";
                    $username = "newphp";
                    $password = "1234";
                    $dbname = 'project';
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $link = mysqli_connect($servername, $username, $password, $dbname);
                    ?>
                    <form action="" class="my-2" method="post">
                        <!-- Erste Währung auswählen -->
                        <!--
                        Devisen in die Dropdown Liste einfügen 
                        Andere Datenbank verwendet, weil sonst alle 165.000 Einträge aufgelistet werden. 
                    -->
                        <?php
                        if (isset($_POST['setDate'])) {
                            $result = mysqli_query($conn, "SELECT devise from getHistory where Datum = '" . $_POST['datum'] . "';");
                            if ($result->num_rows > 1) {
                                $visible = 'invisible';
                                echo $conn->error;
                                echo 'Von:
                            <select name="drop1" value="">';
                                $result = mysqli_query($conn, "SELECT devise from getHistory where Datum = '" . $_POST['datum'] . "';");
                                $i = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    // USD Pre selected
                                    if ($i === 26) {
                                        echo "<option selected value=$row[devise]>$row[devise]</option>";
                                    } else {
                                        # code...
                                        echo "<option value=$row[devise]>$row[devise]</option>";
                                    }
                                    $i++;
                                }
                            } else {
                                echo '<div class="alert-danger">Du musst ein anderes Datum auswählen</div>';
                                unset($_POST['setDate']);
                            }
                        }
                        ?>
                        </select>
                        <!-- Zweite Währung auswählen -->
                        <?php
                        if (isset($_POST['setDate'])) {

                            echo ' Zu:
                        <select name="drop2">';
                            $result = mysqli_query($conn, "SELECT devise from getHistory where Datum = '" . $_POST['datum'] . "';");
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                // USD Pre selected
                                if ($i === 24) {
                                    echo "<option selected value=$row[devise]>$row[devise]</option>";
                                } else {
                                    # code...
                                    echo "<option value=$row[devise]>$row[devise]</option>";
                                }
                                $i++;
                            }
                        }
                        ?>
                        </select>
                        <!-- Mengenangabe, Datumsangabe und Submit -->
                        <?php
                        if (isset($_POST['setDate'])) {
                            echo '<input type="number" placeholder="15.231" step="0.001" value="2.34" class="form-control" id="data" name="data" min="0">';
                        }
                        ?>
                        <form action="">
                            <?php
                            if (!isset($_POST['setDate'])) {
                                echo '<label for="dateSelect">Wähle Datum</label>';
                            }
                            echo '<input type="date" id="datum" value="2000-01-03" class="' . $visible . '" name="datum">';
                            if (!isset($_POST['setDate'])) {
                                echo '<input type="submit" class="btn btn-primary" value="Datum setzen" name="setDate">';
                                $visible = null;
                            }
                            ?>
                            <?php
                            if (isset($_POST['setDate'])) {
                                echo '<input type="submit" class="btn btn-primary" value="Berechnen" name="submit">';
                            }
                            ?>
                        </form>
                    </form>
                    <?php
                    // Bei Knopfdruck 
                    if (isset($_POST['submit'])) {

                        $result_test = mysqli_query($conn, "call Umrechnung2('" . $_POST['datum'] . "','" . $_POST['drop1'] . "', '" . $_POST['drop2'] . "', " . $_POST['data'] . ");");
                        //Fehler Ausgeben, falls vorhanden 
                        if ($conn->error) {
                            echo '<div class="alert-info">Du musst eine Zahl eingeben!</div>';
                        };
                        //   Ergebniss ausgeben
                        while ($test_row = mysqli_fetch_array($result_test)) {
                            if ($test_row[0] > 0) {
                                # code...
                                echo "Das Ergebnis lautet: " .  $test_row[0] . " " . $_POST['drop2'];
                            } else {
                                echo '<div class="alert-danger">Wochenden gibt es hier nicht!!!</div>';
                            }
                        }
                    }
                    ?>
                </div>
                <div class="row">
                    <a href="index.php" class="alert-link">Aktuelle Währung umrechnen</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>