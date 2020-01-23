<?php
/**
 * Created by PhpStorm.
 * User: gabela
 * Date: 10/10/2019
 * Time: 10:07
 */
require '../constants/db_config.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT * FROM tbl_jobs ORDER BY category");
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach($result as $row)

    {
        $cat = $row['category'];
       echo $row['title']. '</br>';
    }
    $stmt->execute();

}catch(PDOException $e)
{

}