<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <script src="index.js"></script>
    <link rel="stylesheet" href="styleManageStudent.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
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
                            <i class="fa-solid fa-users">&nbsp; Manage Students</i>
                        </a>
                    </div>
                    <div class="add_Student">
                        <a href="addRecord.php"><i class="fa-solid fa-user">&nbsp; Add Student</i></a>
                    </div>
                    <div class="space2">
                        <a id="btn_RulesAndRegulation" href="rulesAndRegulation.html" target="_blank">
                            <i class="fa-solid fa-ban">&nbsp;&nbsp;Rules and Regulation</i>
                        </a>
                    </div>
                </div>
                <div class="content">
                    <div class="content_Top">
                        <i class="fa-solid fa-users">&nbsp;&nbsp;Manage&nbsp; Students</i>
                    </div>
                    <div class="searchBar">
                        <!-- search form -->
                        <form method="POST">
                            <input type="search" name="search" id="search" class="search-input" placeholder="Search Students">
                            <button type="submit" class="searchButton"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                    <div class="content_Body">
                        <div class="content_Body_Top">
                            <table class="info_Table">
                                <thead>
                                    <tr>
                                        <th>LRN</th>
                                        <th>Name</th>
                                        <th>Grade & Section</th>
                                        <th>Parent/Guardian Name</th>
                                        <th>Contact Number</th>
                                        <th>With Parent/Guardian</th>
                                        <th id="table_Button_Info"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $conn = mysqli_connect('localhost', 'root', '', 'dac_record');

                                        //condition to show the data from the students_info table using name or lrn that matches in the search form
                                        if(isset($_POST['search'])){
                                            $search = $_POST['search'];
                                            $query = "SELECT * FROM students_info WHERE lrn LIKE '%$search%' OR name LIKE '%$search%'";
                                            $result = mysqli_query($conn, $query);

                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    echo "
                                                    <tr>
                                                        <td>$row[lrn]</td>
                                                        <td>$row[name]</td>
                                                        <td>$row[grade_section]</td>
                                                        <td>$row[parent_guardian_name]</td>
                                                        <td>$row[contact_number]</td>
                                                        <td>$row[with_parent_guardian]</td>
                                                        <td><a id='btn_Edit' href='editInfo.php?info_id=$row[info_id]'>Edit</a>
                                                        <a id='btn_Delete' href='deleteInfo.php?info_id=$row[info_id]'>Delete</a>
                                                        <a id='btn_AddOffense' href='addOffense.php?info_id=$row[info_id]'>Add Offense</a></td>
                                                    </tr>
                                                    ";
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>No records found</td></tr>";
                                            }
                                        }
                                        mysqli_close($conn);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="content_Body_Bottom">
                            <table class="offense_Table">
                                    <thead>
                                        <tr>
                                            <th id="table_Date">Date</th>
                                            <th id="table_Offense">Offense</th>
                                            <th id="table_Decision">Decision</th>
                                            <th id="table_Button_Offense"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $conn = mysqli_connect('localhost', 'root', '', 'dac_record');

                                            //condition to show the data from the students_offense table using name or lrn that matches in the search form
                                            if(isset($_POST['search'])){
                                                $search = $_POST['search'];
                                                
                                                $query_offense = "SELECT * FROM students_offense WHERE offense_lrn IN (SELECT lrn FROM students_info WHERE lrn LIKE '%$search%' OR name LIKE '%$search%')";
                                                $result = mysqli_query($conn, $query_offense);

                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        echo "
                                                            <tr>
                                                                <td>$row[date]</td>
                                                                <td>$row[offense]</td>
                                                                <td>$row[decision]</td>
                                                                <td><a id='btn_Edit' href='editOffense.php?offense_id=$row[offense_id]'>Edit</a>
                                                                <a id='btn_Delete' href='deleteOffense.php?offense_id=$row[offense_id]'>Delete</a></td>
                                                            </tr>
                                                        ";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='4'>No records found</td></tr>";
                                                }
                                            }
                                        ?>
                                    </tbody>
                            </table> 
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