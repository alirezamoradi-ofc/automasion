<?php
    $Server_Name = 'localhost';
    $User_Name   = 'root';
    $Password    = '';
    $DB_Name     = 'alireza';

    $Sender      = $_POST['Sender_Name'];
    $Giver       = $_POST['Giver_Name'];
    $subject     = $_POST['subject'];
    $Pass        = $_POST['pass'];
    $letter      = $_POST['letter'];

    try{
        $Connection = new PDO("mysql:host=$Server_Name;dbname=$DB_Name",
        $User_Name, $Password);

        $Connection -> setAttribute( PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);

        $Sql = "INSERT INTO letters VALUES('$Sender', '$Giver', '$Pass',
        '$subject', '$letter' )";
                        
        $Connection -> exec($Sql);

        echo '<h1 style="text-align: center">' . '.نامه شما با موفقیت برای آقا/خانم'. ' '.
        $Giver. ' ' .'ارسال شد'. '</h1>';
    }
    catch (PDOException $e){
        echo $e -> getMessage();
    } 
?>