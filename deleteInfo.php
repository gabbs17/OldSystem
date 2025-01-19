<?php 
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $conn = mysqli_connect('localhost', 'root', '', 'dac_record');
        $info_id = $_GET['info_id'];

        //getting all the same lrn from the students_info
        $queryInfo = "SELECT lrn FROM students_info WHERE info_id='$info_id'";
        $resultInfo = $conn->query($queryInfo);
        $rowInfo = $resultInfo->fetch_assoc();
        $lrn = $rowInfo['lrn'];

        //delete all the offenses from students_offense with the same lrn
        $queryDeleteOffense = "DELETE FROM students_offense WHERE offense_lrn='$lrn'";
        $resultDeleteOffense = $conn->query($queryDeleteOffense);

        //delete the info from students_info with the lrn
        $queryDeleteInfo = "DELETE FROM students_info WHERE info_id='$info_id'";
        $resultDeleteInfo = $conn->query($queryDeleteInfo);

        mysqli_close($conn);

        echo "<script>alert('Record has been deleted successfully!')</script>";
        echo "<script>window.location.href = 'manage.php';</script>";
    }
?>