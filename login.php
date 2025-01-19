<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'dac_record');
    $username = "";
    $password = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //store the value of form to variable
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * from admin_info WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);
    
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            //if the username and password matches a data from the database then in will redirect to the dashboard or home page
            if($row['username'] === $username && $row['password'] === $password){
                echo "<script>window.location.href = 'dashboard.php';</script>";
            }
        }
        //if the username and password doesn't match a data from the database then an alert will pop up
        else{
            echo "<script>alert('Incorrect username or password!')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAC Record</title>
    <link rel="stylesheet" href="styleLogIn.css?v=<?php echo time(); ?>">
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
                    <img src="company.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="body">
            <p id="prompt">Admin Log In</p> 
            <div class="login_Input">
                <form method="post">
                    <input type="text" id="username" name="username" placeholder="Username" value="<?php echo $username ?>" required> <br>
                    <input type="password" id="password" name="password" placeholder="Password" value="<?php echo $password ?>" required> <br>
                    <button type="submit" id="login_Btn">Log In</button>
                </form>
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