    <?php
    $servername = "192.168.62.211";
    $username = "newphp";
    $password = "1234";
    $dbname = 'project';

    $conn = new mysqli($servername, $username, $password, $dbname);
    $link = mysqli_connect($servername, $username, $password, $dbname);
    echo "Site initiated! <br>";

    // Start date
    $date = '2000-01-01';
    // End date
    $end_date = '2000-03-03';

    // $data = json_decode(file_get_contents('https://api.exchangeratesapi.io/2000-03-01'), true);
    // extract($data);
    $begin = new DateTime("2013-06-27");
    $end   = new DateTime("2020-06-05");

    for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
        
        $data = json_decode(file_get_contents('https://api.exchangeratesapi.io/'.$i->format("Y-m-d")), true);
        extract($data);

        foreach (array_keys($rates) as $key) {
            $sql = "INSERT INTO getHistory VALUES('$data[date]','$key', $rates[$key])";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully for Day ";
                echo $i->format("Y-m-d")."<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }


    ?>