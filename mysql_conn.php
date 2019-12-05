<?php
// $servername = "localhost";
// $username = "root";
// $password = "";

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=Login_system", $username, $password);
//     // set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully";
//     }
// catch(PDOException $e)
//     {
//     echo "Connection failed: " . $e->getMessage();
//     }

$host = "localhost"; 
$dbuser = "root";
$dbpassword = "";
$dbname = 'login_system';

//dsn -data source name

$dsn = 'mysql:host ='.$host . ';dbname=' . $dbname;
//create a pdo instance
$connection = new PDO($dsn, $dbuser, $dbpassword);
$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


$fetchstmt = $connection->query('SELECT * FROM workers');
// echo '<table>';
// while($row = $fetchstmt->fetch(PDO::FETCH_ASSOC)){
// echo '<tr><td>'.$row['username'] . '</td><td>'.$row['email'] . '</td><td>'.$row['department'] . '</td><td>'.$row['password'] . '</td></tr>';
// }

// if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['department']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['department']) && !empty($_POST['password']))
// {
// $username = $_POST['username'];
// $email = $_POST['email'];
// $department = $_POST['department'];
// $password = $_POST['password'];

// $sql = 'INSERT INTO auth(username, email, department, password) VALUES(:username, :email, :department, :password)';
// $stmt = $connection->prepare($sql);
// $stmt->execute(['username' => $username, 'email' => $email, 'department' => $department,'password' => $password]);
// echo "Post Added";
// }
?>