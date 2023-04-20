<?php
$email = $_POST['email'];
$password = $_POST['password'];

// Connect to the database
$serverName = "serverName\\193.85.203.188"; //serverName\instanceName
$connectionInfo = array( "Database"=>"kunes", "UID"=>"kunes", "PWD"=>"SPjoxufy123");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    $stmt = $con->prepare("select * from login where email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data['password'] === $password) {
            //  echo "Login success...";
            $myfile = fopen("mainpage.html", "r");
            echo fread($myfile,filesize("mainpage.html"));
            fclose($myfile);
        } else {
            echo file_get_contents("test.html");
            echo "Invalid password...";
        }
    } else {
        echo file_get_contents("test.html");
        echo "Invalid email...";
    }
}
?>

