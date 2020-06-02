<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
        $servername = "192.168.62.211";
        $username = "newphp";
        $password = "1234";
        $dbname ='project';

        $conn = new mysqli($servername, $username, $password, $dbname);
        $link = mysqli_connect($servername, $username, $password, $dbname);

        $data = json_decode(file_get_contents('https://api.exchangeratesapi.io/latest'), true);
        extract($data);
        foreach(array_keys($rates) as $key){
        $sql = "Update devisen set Wert = $rates[$key] WHERE Devise = '$key';";
        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
       }
    ?>
</body>
</html>