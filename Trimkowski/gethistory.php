    <?php
    $servername = "192.168.62.211";
    $username = "newphp";
    $password = "1234";
    $dbname = 'project';

    $conn = new mysqli($servername, $username, $password, $dbname);
    $link = mysqli_connect($servername, $username, $password, $dbname);

    $data = json_decode(file_get_contents('https://api.exchangeratesapi.io/latest'), true);
    extract($data);

    foreach (array_keys($rates) as $key) {
        $sql = "INSERT INTO getHistory VALUES('$data[date]','$key', $rates[$key])";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    echo "Records created successfully on " . $data[date];
    ?>