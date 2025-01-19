<?php 
    $name = "";
    $lrn = "";
    $grade_section = "";
    $wPG = "";
    $contact = "";
    $info_id = "";
    $pGName = "";

    $conn = mysqli_connect('localhost', 'root', '', 'dac_record');

    //get data from students_info table using primary key(info_id) to retrieve the informations and show it in the form
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $info_id = $_GET['info_id'];

        $queryInfo = "SELECT * FROM students_info WHERE info_id='$info_id'";
        $result = $conn->query($queryInfo);
        $row = $result->fetch_assoc();

        //store in variable the data from the database and show it in the form
        $name = $row["name"];
        $lrn = $row["lrn"];
        $grade_section = $row["grade_section"];
        $pGName = $row["parent_guardian_name"];
        $wPG = $row["with_parent_guardian"];
        $contact = $row["contact_number"];
        
        //storing the old lrn to change into new lrn
        $oldLRN = $lrn;
    }
    //update the data from the form to the database
    else{
        //store in the variable the value of the form
        $info_id = $_GET['info_id'];
        $name = $_POST["name"];
        $lrn = $_POST["lrn"];
        $grade_section = $_POST["grade_section"];
        $pGName = $_POST["pGName"];
        $wPG = $_POST["wPG"];
        $contact = $_POST["contact"];

        //getting the old lrn
        $oldLRNQuery = "SELECT lrn FROM students_info WHERE info_id='$info_id'";
        $oldLRNResult = $conn->query($oldLRNQuery);
        $oldLRNRow = $oldLRNResult->fetch_assoc();
        $oldLRN = $oldLRNRow["lrn"];

        //updating the data in the students_info table
        $queryInfo = "UPDATE students_info SET lrn='$lrn', name='$name', grade_section='$grade_section', parent_guardian_name='$pGName', with_parent_guardian='$wPG', contact_number='$contact' WHERE info_id='$info_id'";
        $resultInfo = $conn->query($queryInfo);

        //updating the lrn of offenses in students_offense table
        $queryOffense = "UPDATE students_offense SET offense_lrn='$lrn' WHERE offense_lrn = '$oldLRN'";
        $resultOffense = $conn->query($queryOffense);

        mysqli_close($conn);

        echo "<script>alert('Record has been updated successfully!')</script>";
        echo "<script>window.location.href = 'manage.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <script src="index.js"></script>
    <link rel="stylesheet" href="styleEditInfo.css?v=<?php echo time(); ?>">
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
                        <i class="fa-solid fa-users">&nbsp;&nbsp;Manage&nbsp; Students&nbsp; -&nbsp; Edit Info</i>
                    </div>
                    <div class="content_Body">
                        <form method="post" >
                            <input type="hidden" name="info_id" value="<?php echo $info_id ?>">
                            <label for="lrn">LRN:</label><br>
                            <input type="text" id="lrn" name="lrn" value="<?php echo $lrn ?>"> <br>
                            <label for="name">Name:</label><br>
                            <input type="text" id="name" name="name" value="<?php echo $name ?>"><br>
                            <label for="grade_section">Grade and Section:</label><br>
                            <input type="text" id="grade_section" name="grade_section" value="<?php echo $grade_section ?>"><br>
                            <label>Parent/Guardian Name:</label><br>
                            <input type="text" id="pGName" name="pGName" value="<?php echo $pGName ?>"> <br>
                            <label for="contact">Contact Number:</label><br>
                            <input type="text" id="contact" name="contact" value="<?php echo $contact ?>"><br>
                            <label for="wPG">With Parent/Guardian:</label><br>
                            <select id="wPG" name="wPG" size="1" >
                                    <option value="No" <?php if ($wPG == "No") echo "selected"; ?>>No</option>
                                    <option value="Yes" <?php if ($wPG == "Yes") echo "selected"; ?>>Yes</option>
                                </select><br>
                            <button type="submit" id="btn_EditInfo">Save</button>
                        </form>
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