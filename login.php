<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل کاربر</title>
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="normal-user.css">
    <link rel="stylesheet" href="login.css">
    <!--fontawesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="script.js" defer></script>
    <script src="date.js" defer></script>
</head>


<body>
    <div class="container">

        <section class="normal-user">
            <header>
                <ul>
                    <li>
                        <span>نام کاربری:</span>
                        <span> <?= $_POST['username'] ?> </span>
                    </li>
                    <li>
                        <span> ورود بعنوان:</span>
                        <span> <?= $_POST['position'] ?> </span>
                    </li>
                </ul>
                <button class="log-out">خروج</button>
            </header>
            <aside>
                <ul class="panel-list">
                    <li class="container">
                        <div>
                            عملیات
                            <i class="fa fa-chevron-down"></i>
                        </div>
                        <ul>
                            <li class="panel-opener" data-context-target="letter-content">نامه</li>
                        </ul>
                    </li>
                    <?php
                        if ( $_POST['position'] == 'مدیر سیستم' || 
                        $_POST['position'] == 'راهبر سیستم' ) {
                            echo '
                            <li class="container">
                                <div>
                                    گزارش
                                    <i class="fa fa-chevron-down"></i>
                                </div>
                                <ul>
                                    <li class="panel-opener" data-context-target="letters-list">گزارش نامه ها</li>
                                </ul>
                            </li>';}?>
                            <?php
                            if ($_POST['position'] == 'راهبر سیستم'){
                                echo'
                                <li class="container">
                                <div>
                                    مدیریت سیستم
                                    <i class="fa fa-chevron-down"></i>
                                </div>
                                <ul>
                                    <li class="panel-opener" data-context-target="members-list">لیست اعضا</li>
                                    <li class="panel-opener" data-context-target="add-member">افزودن عضو</li>
                                </ul>
                            </li>';
                            }
                            ;?>
                </ul>
            </aside>
            <main class="context">
                <section class="letter-content">
                    <table class="letter-table">
                        <thead>
                            <tr>
                                <th>تاریخ امروز</th>
                                <th>ساعت</th>
                                <th>اطلاعات نامه</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="date-cell"></td>
                                <td id="clock"></td>
                                <?php

                                $year = date('Y') - 621;

                                $Number = '0123456789';
                                $Random = substr( str_shuffle($Number) , 0 , 4);

                                echo'
                                <td>
                                    <span>' . substr($year, 2, 3). '</span>
                                    <span>' . '/ ن' . '</span>
                                    <span>' . '/ ع' . '</span>
                                    <span>' . '/' . ' ' . $Random . '</span>
                                    
                                </td>';
                                ?>
                            </tr>
                        </tbody>
                    </table>
                    <form action="letter.php" method="post" class="send-letter-form">
                        <div class="table-row">
                            <input type="text" name="Sender_Name" required
                            placeholder="نام فرستنده">
                            <input type="text" name="Giver_Name" required 
                            placeholder="نام گیرنده">
                        </div>
                        <div class="table-row">
                            <input type="text" name="subject" required 
                            placeholder="موضوع">
                            <input type="password" name="pass" required 
                            placeholder="رمز عبور">
                        </div>
                        <textarea name="letter" 
                        placeholder="متن نامه را اینجا بنویسید..."></textarea>
                        <div class="buttons">
                            <button class="cancel-button">لغو</button>
                            <button class="send-button">ارسال</button>
                        </div>
                    </form>
                </section>
                <?php
                
                    $Server_Name  = 'localhost';
                    $User_Name    = 'root';
                    $Password     = '';
                    $DB_Name      = 'alireza'; 

                    try{

                        $Connection = new PDO("mysql:host=$Server_Name;dbname=$DB_Name", $User_Name, $Password);
                        $Connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $Show = $Connection -> prepare("SELECT * FROM letters");
                        $Show ->execute();

                        $Letter = $Show -> fetchAll();

                ?>  
                <div class="letters-list">
                    <section class="member">
                        <?php foreach ( $Letter as $v ){?>
                            <section class="letter">
                                <button class="remove-letter" onclick="del()">حذف</button>
                            <header>
                                <ul>
                                    <li>
                                        <span>فرستنده:</span>
                                        <strong> <?= $v['نام_فرستنده'] ?> </strong>
                                    </li>
                                    <li>
                                        <span>گیرنده:</span>
                                        <strong> <?= $v['نام_گیرنده'] ?> </strong>
                                    </li>
                                    <li>
                                        <span>موضوع:</span>
                                        <strong> <?= $v['موضوع'] ?> </strong>
                                    </li>
                                </ul>
                            </header>
                            <p> <?= $v['متن_نامه'] ?> </p>
                            </section>
                        <?php } ?>
                    </section>
                    <?php
            
                    }
                    catch (PDOException $e){
                        echo $e -> getMessage();
                    }

                    $Connection = null;

                    ?>
                </div>
                <section class="add-member">
                    <form action="add.php" method="post" class="login-form add-member-form">

                        <label for="firstName">
                            <span>نام :</span> <br>
                            <input dir="ltr" id="firstName" name="First_Name" 
                            autocomplete="off" type="text">
                        </label>
                        <label for="lastName">
                            <span>نام خانوادگی:</span> <br>
                            <input dir="ltr" id="lastName" name="Last_Name"
                            autocomplete="off" type="text">
                        </label>
                        <label for="username">
                            <span>نام کاربری:</span> <br>
                            <input id="username" name="User_Name"
                            autocomplete="off" type="text">
                        </label>

                        <label for="password">
                            <span>رمز عبور:</span> <br>
                            <input dir="ltr" id="password" name="Pass"
                            type="password">
                        </label>
                        <label for="member-type">
                            <span>سمت:</span> <br>
                            <select id="member-type" name="Position">
                                <option value="راهبر سیستم">
                                    راهبر سیستم
                                </option>
                                <option value="مدیر سیستم">
                                    مدیر سیستم
                                </option>
                                <option value="کاربر معمولی">
                                    کاربر معمولی
                                </option>
                            </select>
                        </label>
                        <label for="phone-number">
                            <span>شماره تماس:</span> <br>
                            <input id="phone-number" name="Tel"
                            autocomplete="off" type="tel">
                        </label>
                        <button class="login-button addMember-button">افزودن</button>
                    </form>
                </section>
                <?php
                
                $Server_Name  = 'localhost';
                $User_Name    = 'root';
                $Password     = '';
                $DB_Name      = 'alireza'; 

                try{

                    $Connection = new PDO("mysql:host=$Server_Name;dbname=$DB_Name", $User_Name, $Password);
                    $Connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $Show = $Connection -> prepare("SELECT * FROM employee");
                    $Show ->execute();

                    $Letter = $Show -> fetchAll();

                ?>
                <div class="members-list">
                    <section class="member">
                        <?php foreach ( $Letter as $v ){?>
                            <section class="letter_container">    
                                    <button class="remove-member">حذف عضو</button>
                                    <header>
                                        <img src="user-logo.png" alt="عکس پروفایل عضو">
                                        <div>
                                            <span class="member-name"> 
                                                <?= $v['نام'] . ' ' . $v['نام_خانوادگی'] ?>
                                            </span>
                                            <span>
                                                <?= $v['سمت']?>
                                            </span>
                                        </div>
                                    </header>
                                    <ul class="info">
                                        <li>
                                            <span>شماره تماس:</span>
                                            <span>
                                                <?= $v['شماره_تلفن']?>
                                            </span>
                                        </li>
                                        <li>
                                        <span>نام کاربری:</span>
                                        <span>
                                            <?= $v['نام_کاربری']?>
                                        </span>
                                        </li>
                                        <li>
                                            <span>رمز عبور:</span>
                                            <span id="pass">
                                                <?= $v['رمز_عبور']?>
                                            </span>
                                        </li>
                                    </ul>
                                </section>
                                <hr/><br/>
                            
                            <?php } ?>
                        </section>
                    </div>
                    <?php
            
                    }
                    catch (PDOException $e){
                        echo $e -> getMessage();
                    }

                    $Connection = null;

                    ?>
            </main>
        </section>
    </div>
    <script>
        function del(){

        }
    </script>
</body>

</html>