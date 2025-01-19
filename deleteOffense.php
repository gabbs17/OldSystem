<?php 
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $conn = mysqli_connect('localhost', 'root', '', 'dac_record');
        $offense_id = $_GET['offense_id'];

        //primary key is used in the sql to find a certain row
        //delete the offense from students_offense using primary key(offense_id) 
        $queryDeleteOffense = "DELETE FROM students_offense WHERE offense_id='$offense_id'";
        $resultDeleteOffense = $conn->query($queryDeleteOffense);

        mysqli_close($conn);

        echo "<script>alert('Offense has been deleted successfully!')</script>";
        echo "<script>window.location.href = 'manage.php';</script>";
    }
?>