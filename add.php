<?php
    $Server_Name = 'localhost';
    $User_Name   = 'root';
    $Password    = '';
    $DB_Name     = 'alireza';

    $First_Name  = $_POST['First_Name'];
    $Last_Name   = $_POST['Last_Name'];
    $user_name   = $_POST['User_Name'];
    $Pass        = $_POST['Pass'];
    $Position    = $_POST['Position'];
    $Tel         = $_POST['Tel'];

    try{
        $Connection = new PDO("mysql:host=$Server_Name;dbname=$DB_Name",
        $User_Name, $Password);

        $Connection -> setAttribute( PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);

        $Sql = "INSERT INTO employee VALUES ('$First_Name', '$Last_Name',
        '$user_name', '$Pass', '$Tel', '$Position' )";
                        
        $Connection -> exec($Sql);

        echo '<h1 style="text-align: center">' . 
        '.اکنون عضوی از خانواده شرکت اتوماسیون اداری شد'. ' '.
        $First_Name. ' ' . $Last_Name . ' آقا/خانم ' .' '. '</h1>';

    }
    catch (PDOException $e){
        echo $e -> getMessage();
    } 
?>