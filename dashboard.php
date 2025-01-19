<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="index.js"></script>
    <link rel="stylesheet" href="styleDashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
        <div class="head">
            <div class="school_Logo">
                <div class="image">
                    <img src="school_Logo.PNG" alt="">
                </div>
            </div>
            <div class="title">
                <div class="name">
                    <h1>Discipline Action Committee Record</h1>
                </div>
            </div>
            <div class="watermark">
                <div class="image">
                    <img src="company.jpg">
                </div>
            </div>
        </div>
        <div class="body">
            <div class="top">
                <div class="space1">
                    
                </div>
                <div class="dateIcon">
                    <i class="fa-solid fa-calendar fa-2x"></i>
                </div>
                <div class="date_Now">
                    <p id="currentDate"></p>
                </div>
                <div class="log_Out">
                    <button class="logout_Btn2" onclick="logout()">
                        <div class="logout_Left">
                            <i class="fa-solid fa-power-off fa-2x"></i>
                        </div>
                        <div class="logout_Right">
                            Logout
                        </div>
                    </button>
                </div>
            </div>
            <div class="bottom">
                <div class="navigation">
                    <div class="dashboard">
                        <a href="dashboard.php">
                            <i class="fa-solid fa-gauge" id="navDash">&nbsp;&nbsp;DashBoard</i>
                        </a>
                    </div>
                    <div class="manage_Student">
                        <a href="manage.php">
                            <i class="fa-solid fa-users"> &nbsp;Manage&nbsp; Students</i>
                        </a>
                    </div>
                    <div class="add_Student">
                        <a href="addRecord.php">
                            <i class="fa-solid fa-user"> &nbsp;Add&nbsp; Student</i>
                        </a>
                    </div>
                    <div class="space2">
                        <a id="btn_RulesAndRegulation" href="rulesAndRegulation.html" target="_blank">
                            <i class="fa-solid fa-ban">&nbsp;&nbsp;Rules and Regulation</i>
                        </a>
                    </div>
                </div>
                <div class="content">
                    <div class="content_Top">
                        <i class="fa-solid fa-gauge">&nbsp;&nbsp;DashBoard</i> 
                    </div>
                    <div class="content_Name">
                        Discipline Action Commitee Record
                    </div>
                    <div class="content_Body">
                        <div class="manage_Btn">
                            <a href="manage.php">
                                <button class="btn_Dashboard"><i class="fa-solid fa-users fa-2x" id="dashboard_Icon"> <br></i>
                                <p id="student_Para">Students</p>
                                </button>
                            </a>
                        </div>
                        <div class="add_Btn">
                            <a href="addRecord.php">
                                <button class="btn_Dashboard"><i class="fa-solid fa-user fa-2x" id="dashboard_Icon"> <br></i>
                                    <p id="addStudent_Para">Add Students</p>
                                </button>
                            </a>
                        </div>
                        <div class="logout_Btn">
                            <button class="btn_Dashboard" onclick="logout()"><i class="fa-solid fa-power-off fa-2x"><br></i>
                                <p id="logout_Para">Logout</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="fleft"></div>
            <div class="fmid">
                <p>Created by 12-Cooper 2023-2024</p>
            </div>
            <div class="fright"><p>MNPE</p></div>
        </div>
    </div>
</body>
</html>