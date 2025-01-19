<?php  
    $name = "";
    $lrn = "";
    $date = "";
    $offense = "";
    $decision = "";

    $conn = mysqli_connect('localhost', 'root', '', 'dac_record');

    //get data from students_offense table using primary key(offense_id) to retrieve the informations and show it in the form
    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $offense_id = $_GET['offense_id'];

        $queryOffense = "SELECT * FROM students_offense WHERE offense_id='$offense_id'";
        $resultOffense = $conn->query($queryOffense);
        $rowOffense = $resultOffense->fetch_assoc();

        //store in variable the data from the database and show it in the form
        $lrn = $rowOffense["offense_lrn"];
        $date = $rowOffense["date"];
        $offense = $rowOffense["offense"];
        $decision = $rowOffense["decision"];

        //query to get the name from students_info table using the lrn and show it in the form since the offense table don't contain the name
        $queryInfo = "SELECT * FROM students_info WHERE lrn='$lrn'";
        $resultInfo = $conn->query($queryInfo);
        $rowInfo = $resultInfo->fetch_assoc();

        //store in variable the name from the database and show it in the form
        $name = $rowInfo["name"];
    }
    //update the data from the form to the students_offense table
    else{
        $offense_id = $_GET['offense_id'];
        $date = $_POST["date"];
        $offense = $_POST["offense"];
        $decision = $_POST["decision"];

        $queryOffense = "UPDATE students_offense SET date='$date', offense='$offense', decision='$decision' WHERE offense_id = '$offense_id'";
        $resultOffense = $conn->query($queryOffense);

        mysqli_close($conn);

        echo "<script>alert('Offense has been updated successfully!')</script>";
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
    <link rel="stylesheet" href="styleEditOffense.css?v=<?php echo time(); ?>">
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
                        <i class="fa-solid fa-users">&nbsp;&nbsp;Manage&nbsp; Students&nbsp; -&nbsp; Edit Offense</i>
                    </div>
                    <div class="content_Body">
                        <form method="post">
                            <label>LRN:</label><br>
                            <input type="text" id="lrn" name="lrn" value="<?php echo $lrn ?>" required readonly> <br>
                            <label>Name:</label><br>
                            <input type="text" id="name" name="name" value="<?php echo $name ?>" required readonly> <br>
                            <label>Date:</label><br>
                            <input type="date" id="date" name="date" value="<?php echo $date ?>" required> <br>
                            <label>Offense:</label><br>
                            <select id="offense" name="offense" size="1" required>
                                    <option value="Minor 1.1 - Hindi pagsusuot ng angkop na kasuotan" <?php if ($offense == "Minor 1.1 - Hindi pagsusuot ng angkop na kasuotan") echo "selected"; ?>>Minor 1.1 - Hindi pagsusuot ng angkop na kasuotan</option>
                                    <option value="Minor 1.2 - Pagususot ng mapanuksong damit (maikli, malalim ang leeg, hapit sa katawan)" <?php if ($offense == "Minor 1.2 - Pagususot ng mapanuksong damit (maikli, malalim ang leeg, hapit sa katawan)") echo "selected"; ?>>Minor 1.2 - Pagususot ng mapanuksong damit (maikli, malalim ang leeg, hapit sa katawan)</option>
                                    <option value="Minor 1.3 - Pagsusuot ng punit-punit na pantalon na nagpapakita ng balat" <?php if ($offense == "Minor 1.3 - Pagsusuot ng punit-punit na pantalon na nagpapakita ng balat") echo "selected"; ?>>Minor 1.3 - Pagsusuot ng punit-punit na pantalon na nagpapakita ng balat</option>
                                    <option value="Minor 1.4 - Pagsusuot ng sinelas o sandals" <?php if ($offense == "Minor 1.4 - Pagsusuot ng sinelas o sandals") echo "selected"; ?>>Minor 1.4 - Pagsusuot ng sinelas o sandals</option>
                                    <option value="Minor 1.5 - Pagsusuot ng hikaw at pagkakaroon ng body piercing sa mga kalalakihan at tatlo o higit pang piercing sa mga kababaihan" <?php if ($offense == "Minor 1.5 - Pagsusuot ng hikaw at pagkakaroon ng body piercing sa mga kalalakihan at tatlo o higit pang piercing sa mga kababaihan") echo "selected"; ?>>Minor 1.5 - Pagsusuot ng hikaw at pagkakaroon ng body piercing sa mga kalalakihan at tatlo o higit pang piercing sa mga kababaihan</option>
                                    <option value="Minor 1.6 - Pagkakaroon ng tattoo sa nakikitang bahagi ng katawan o hindi pagtatakip ng mga tattoo sa katawan" <?php if ($offense == "Minor 1.6 - Pagkakaroon ng tattoo sa nakikitang bahagi ng katawan o hindi pagtatakip ng mga tattoo sa katawan") echo "selected"; ?>>Minor 1.6 - Pagkakaroon ng tattoo sa nakikitang bahagi ng katawan o hindi pagtatakip ng mga tattoo sa katawan</option>
                                    <option value="Minor 2.1 - Hindi pagsusuot ng Pagkakakilanlan o ID Pagsira" <?php if ($offense == "Minor 2.1 - Hindi pagsusuot ng Pagkakakilanlan o ID Pagsira") echo "selected"; ?>>Minor 2.1 - Hindi pagsusuot ng Pagkakakilanlan o ID Pagsira</option>
                                    <option value="Minor 2.2 - Pagtamper sa ID" <?php if ($offense == "Minor 2.2 - Pagtamper sa ID") echo "selected"; ?>>Minor 2.2 - Pagtamper sa ID</option>
                                    <option value="Minor 2.3 - Paggamit ng ibang ID upang makapasok sa paaralan" <?php if ($offense == "Minor 2.3 - Paggamit ng ibang ID upang makapasok sa paaralan") echo "selected"; ?>>Minor 2.3 - Paggamit ng ibang ID upang makapasok sa paaralan</option>
                                    <option value="Minor 2.4 - Pagpapahiram ng ID sa ibang estudyante liban na lamang kung manghihiram ng gamit sa silid aklatan o sa laboratoryo o katulad na gawain" <?php if ($offense == "Minor 2.4 - Pagpapahiram ng ID sa ibang estudyante liban na lamang kung manghihiram ng gamit sa silid aklatan o sa laboratoryo o katulad na gawain") echo "selected"; ?>>Minor 2.4 - Pagpapahiram ng ID sa ibang estudyante liban na lamang kung manghihiram ng gamit sa silid aklatan o sa laboratoryo o katulad na gawain</option>
                                    <option value="Minor 3.1 - Palagiang pagpasok ng huli sa mga klase na umaabot na ng limang (5) araw o isang buong lingo" <?php if ($offense == "Minor 3.1 - Palagiang pagpasok ng huli sa mga klase na umaabot na ng limang (5) araw o isang buong lingo") echo "selected"; ?>>Minor 3.1 - Palagiang pagpasok ng huli sa mga klase na umaabot na ng limang (5) araw o isang buong lingo</option>
                                    <option value="Minor 3.2 - Palagiang pagliban ng higit isang linggo kada buwan at hindi pagpapasa ng Excuse Letter na may lagda ng magulang o tagapag-alaga" <?php if ($offense == "Minor 3.2 - Palagiang pagliban ng higit isang linggo kada buwan at hindi pagpapasa ng Excuse Letter na may lagda ng magulang o tagapag-alaga") echo "selected"; ?>>Minor 3.2 - Palagiang pagliban ng higit isang linggo kada buwan at hindi pagpapasa ng Excuse Letter na may lagda ng magulang o tagapag-alaga</option>
                                    <option value="Minor 3.3 - Pagka-cutting classes" <?php if ($offense == "Minor 3.3 - Pagka-cutting classes") echo "selected"; ?>>Minor 3.3 - Pagka-cutting classes</option>
                                    <option value="Minor 3.4 - Paglabas ng klasrum ng walang paalam sa mga guro at pagpapakita ng kawalang galang" <?php if ($offense == "Minor 3.4 - Paglabas ng klasrum ng walang paalam sa mga guro at pagpapakita ng kawalang galang") echo "selected"; ?>>Minor 3.4 - Paglabas ng klasrum ng walang paalam sa mga guro at pagpapakita ng kawalang galang</option>
                                    <option value="Minor 3.5 - Pagpapaliwanag na pirmado ng magulang o designated guardian ng mag-aaral" <?php if ($offense == "Minor 3.5 - Pagpapaliwanag na pirmado ng magulang o designated guardian ng mag-aaral") echo "selected"; ?>>Minor 3.5 - Pagpapaliwanag na pirmado ng magulang o designated guardian ng mag-aaral</option>
                                    <option value="Minor 4.1 - Pagtatapon ng BASURA sa kung saan saan" <?php if ($offense == "Minor 4.1 - Pagtatapon ng BASURA sa kung saan saan") echo "selected"; ?>>Minor 4.1 - Pagtatapon ng BASURA sa kung saan saan</option>
                                    <option value="Minor 4.2 - Paglikha ng ingay na nakakaabala sa mga klase" <?php if ($offense == "Minor 4.2 - Paglikha ng ingay na nakakaabala sa mga klase") echo "selected"; ?>>Minor 4.2 - Paglikha ng ingay na nakakaabala sa mga klase</option>
                                    <option value="Minor 4.3 - Pagtambay sa pasilyo na lumilikha ng ingay o kaguluhan na nakaka-abala sa mga klase" <?php if ($offense == "Minor 4.3 - Pagtambay sa pasilyo na lumilikha ng ingay o kaguluhan na nakaka-abala sa mga klase") echo "selected"; ?>>Minor 4.3 - Pagtambay sa pasilyo na lumilikha ng ingay o kaguluhan na nakaka-abala sa mga klase</option>
                                    <option value="Minor 4.4 - Paggamit ng Cellular Phone na walang pahintulot habang nagkaklase" <?php if ($offense == "Minor 4.4 - Paggamit ng Cellular Phone na walang pahintulot habang nagkaklase") echo "selected"; ?>>Minor 4.4 - Paggamit ng Cellular Phone na walang pahintulot habang nagkaklase</option>
                                    <option value="Minor 4.5 - Pagmumura at pagsasalita ng may kabastusan na nakakasakit ng damdamin ng iba" <?php if ($offense == "Minor 4.5 - Pagmumura at pagsasalita ng may kabastusan na nakakasakit ng damdamin ng iba") echo "selected"; ?>>Minor 4.5 - Pagmumura at pagsasalita ng may kabastusan na nakakasakit ng damdamin ng iba</option>
                                    <option value="Major 1.1 - Hindi pagsunod sa alituntuning pinapatupad ng mga guro at kawani ng paaralan" <?php if ($offense == "Major 1.1 - Hindi pagsunod sa alituntuning pinapatupad ng mga guro at kawani ng paaralan") echo "selected"; ?>>Major 1.1 - Hindi pagsunod sa alituntuning pinapatupad ng mga guro at kawani ng paaralan</option>
                                    <option value="Major 1.2 - Pagtataas ng boses o paghahamon ng away sa mga guro at kawani ng paaralan" <?php if ($offense == "Major 1.2 - Pagtataas ng boses o paghahamon ng away sa mga guro at kawani ng paaralan") echo "selected"; ?>>Major 1.2 - Pagtataas ng boses o paghahamon ng away sa mga guro at kawani ng paaralan</option>
                                    <option value="Major 1.3 - Maling paggamit ng pangalan ng paaralan na ikasisira ng maganda nitong imahe" <?php if ($offense == "Major 1.3 - Maling paggamit ng pangalan ng paaralan na ikasisira ng maganda nitong imahe") echo "selected"; ?>>Major 1.3 - Maling paggamit ng pangalan ng paaralan na ikasisira ng maganda nitong imahe</option>
                                    <option value="Major 1.4 - Pagkuha ng video o larawan ng kapwa mag-aaral o guro na walang pahintulot at pag upload nito sa anumang social media platform" <?php if ($offense == "Major 1.4 - Pagkuha ng video o larawan ng kapwa mag-aaral o guro na walang pahintulot at pag upload nito sa anumang social media platform") echo "selected"; ?>>Major 1.4 - Pagkuha ng video o larawan ng kapwa mag-aaral o guro na walang pahintulot at pag upload nito sa anumang social media platform</option>
                                    <option value="Major 1.5 - Pag upload ng larawan o video ng sarili na nagpapakita ng masamang asal o gawain habang nasa loob ng paaralan" <?php if ($offense == "Major 1.5 - Pag upload ng larawan o video ng sarili na nagpapakita ng masamang asal o gawain habang nasa loob ng paaralan") echo "selected"; ?>>Major 1.5 - Pag upload ng larawan o video ng sarili na nagpapakita ng masamang asal o gawain habang nasa loob ng paaralan</option>
                                    <option value="Major 2.1 - Paglabas sa gate ng paaralan ng walang (1) kaukulang paalam at rekord sa gwardya (2) sulat mula sa gurong tagapayo na ito ay pinapayagan na umuwi (3) kasamang parent/guardian o authorized fetcher" <?php if ($offense == "Major 2.1 - Paglabas sa gate ng paaralan ng walang (1) kaukulang paalam at rekord sa gwardya (2) sulat mula sa gurong tagapayo na ito ay pinapayagan na umuwi (3) kasamang parent/guardian o authorized fetcher") echo "selected"; ?>>Major 2.1 - Paglabas sa gate ng paaralan ng walang (1) kaukulang paalam at rekord sa gwardya (2) sulat mula sa gurong tagapayo na ito ay pinapayagan na umuwi (3) kasamang parent/guardian o authorized fetcher</option>
                                    <option value="Major 2.2 - Panlilinlang sa magulang o tagapamatnubay sa mga gawain at koleksyon sa paaralan" <?php if ($offense == "Major 2.2 - Panlilinlang sa magulang o tagapamatnubay sa mga gawain at koleksyon sa paaralan") echo "selected"; ?>>Major 2.2 - Panlilinlang sa magulang o tagapamatnubay sa mga gawain at koleksyon sa paaralan</option>
                                    <option value="Major 2.3 - Pandaraya o palsipikasyon ng mga tala ng paaralan" <?php if ($offense == "Major 2.3 - Pandaraya o palsipikasyon ng mga tala ng paaralan") echo "selected"; ?>>Major 2.3 - Pandaraya o palsipikasyon ng mga tala ng paaralan</option>
                                    <option value="Major 2.4 - Pamemeke ng lagda ng magulang o tagapag-alaga, guro o kawani ng paaralan" <?php if ($offense == "Major 2.4 - Pamemeke ng lagda ng magulang o tagapag-alaga, guro o kawani ng paaralan") echo "selected"; ?>>Major 2.4 - Pamemeke ng lagda ng magulang o tagapag-alaga, guro o kawani ng paaralan</option>
                                    <option value="Major 2.5 - Pandaraya sa mga pagsusulit, eksaminasyon o mga gawaing pang-akademiko" <?php if ($offense == "Major 2.5 - Pandaraya sa mga pagsusulit, eksaminasyon o mga gawaing pang-akademiko") echo "selected"; ?>>Major 2.5 - Pandaraya sa mga pagsusulit, eksaminasyon o mga gawaing pang-akademiko</option>
                                    <option value="Major 2.6 - Pangangalap ng salapi o donasyon sa ngalan ng paaralan na walang pahintulot" <?php if ($offense == "Major 2.6 - Pangangalap ng salapi o donasyon sa ngalan ng paaralan na walang pahintulot") echo "selected"; ?>>Major 2.6 - Pangangalap ng salapi o donasyon sa ngalan ng paaralan na walang pahintulot</option>
                                    <option value="Major 2.7 - Pagbebenta ng tiket na hindi pinayagan ng pamunuan ng paaralan" <?php if ($offense == "Major 2.7 - Pagbebenta ng tiket na hindi pinayagan ng pamunuan ng paaralan") echo "selected"; ?>>Major 2.7 - Pagbebenta ng tiket na hindi pinayagan ng pamunuan ng paaralan</option>
                                    <option value="Major 2.8 - Pamemeke ng lagda ng sinuman sa paaralan at paggamit nito sa mali o illegal na paraan" <?php if ($offense == "Major 2.8 - Pamemeke ng lagda ng sinuman sa paaralan at paggamit nito sa mali o illegal na paraan") echo "selected"; ?>>Major 2.8 - Pamemeke ng lagda ng sinuman sa paaralan at paggamit nito sa mali o illegal na paraan</option>
                                    <option value="Major 2.9 - Pagnanakaw ng gamit ng paaralan o ng kagamitan ng mga guro o kawani nito" <?php if ($offense == "Major 2.9 - Pagnanakaw ng gamit ng paaralan o ng kagamitan ng mga guro o kawani nito") echo "selected"; ?>>Major 2.9 - Pagnanakaw ng gamit ng paaralan o ng kagamitan ng mga guro o kawani nito</option>
                                    <option value="Major 3.1 - Pagsusuot ng singsing na may spike at malalaking metal na buckles ng sinturon na nakakasakit" <?php if ($offense == "Major 3.1 - Pagsusuot ng singsing na may spike at malalaking metal na buckles ng sinturon na nakakasakit") echo "selected"; ?>>Major 3.1 - Pagsusuot ng singsing na may spike at malalaking metal na buckles ng sinturon na nakakasakit</option>
                                    <option value="Major 3.2 - Paghahamon ng away o pag-aamok na nagdulot ng kaguluhan sa loob o labas ng paaralan" <?php if ($offense == "Major 3.2 - Paghahamon ng away o pag-aamok na nagdulot ng kaguluhan sa loob o labas ng paaralan") echo "selected"; ?>>Major 3.2 - Paghahamon ng away o pag-aamok na nagdulot ng kaguluhan sa loob o labas ng paaralan</option>
                                    <option value="Major 3.3 - Pagsisimula ng rambol o riot sa loob at labas ng paaralan" <?php if ($offense == "Major 3.3 - Pagsisimula ng rambol o riot sa loob at labas ng paaralan") echo "selected"; ?>>Major 3.3 - Pagsisimula ng rambol o riot sa loob at labas ng paaralan</option>
                                    <option value="Major 4.1 - Intensyonal na pagsira ng mga silya, lamesa o pintuan ng paaralan" <?php if ($offense == "Major 4.1 - Intensyonal na pagsira ng mga silya, lamesa o pintuan ng paaralan") echo "selected"; ?>>Major 4.1 - Intensyonal na pagsira ng mga silya, lamesa o pintuan ng paaralan</option>
                                    <option value="Major 4.2 - Pagbasag ng mga salamin, water closet at toilet bowl at pagsira ng mga gripo sa loob ng palikuran" <?php if ($offense == "Major 4.2 - Pagbasag ng mga salamin, water closet at toilet bowl at pagsira ng mga gripo sa loob ng palikuran") echo "selected"; ?>>Major 4.2 - Pagbasag ng mga salamin, water closet at toilet bowl at pagsira ng mga gripo sa loob ng palikuran</option>
                                    <option value="Major 4.3 - Pagbasag ng mga bintana at ilaw sa paaralan" <?php if ($offense == "Major 4.3 - Pagbasag ng mga bintana at ilaw sa paaralan") echo "selected"; ?>>Major 4.3 - Pagbasag ng mga bintana at ilaw sa paaralan</option>
                                    <option value="Major 4.4 - Pagsusulat sa mga dingding at mga kagamitan ng paaralan" <?php if ($offense == "Major 4.4 - Pagsusulat sa mga dingding at mga kagamitan ng paaralan") echo "selected"; ?>>Major 4.4 - Pagsusulat sa mga dingding at mga kagamitan ng paaralan</option>
                                    <option value="Major 5.1 - Pagpapasok ng sigarilyo, tabako, pipe, e-cigarettes, IQOS o Heets, vape, waterpipe o bong sa loob ng paaralan" <?php if ($offense == "Major 5.1 - Pagpapasok ng sigarilyo, tabako, pipe, e-cigarettes, IQOS o Heets, vape, waterpipe o bong sa loob ng paaralan") echo "selected"; ?>>Major 5.1 - Pagpapasok ng sigarilyo, tabako, pipe, e-cigarettes, IQOS o Heets, vape, waterpipe o bong sa loob ng paaralan</option>
                                    <option value="Major 5.2 - Paninigarilyo/Pag-gamit ng vape/pag-gamit ng bong at iba pang instrumentong naglalaman ng nikotina sa loob ng paaralan" <?php if ($offense == "Major 5.2 - Paninigarilyo/Pag-gamit ng vape/pag-gamit ng bong at iba pang instrumentong naglalaman ng nikotina sa loob ng paaralan") echo "selected"; ?>>Major 5.2 - Paninigarilyo/Pag-gamit ng vape/pag-gamit ng bong at iba pang instrumentong naglalaman ng nikotina sa loob ng paaralan</option>
                                    <option value="Major 5.3 - Paninigarilyo/Pag-gamit ng vape/pag-gamit ng bong at iba pang instrumentong naglalaman ng nikotina sa loob ng 100 metro mula sa paaralan" <?php if ($offense == "Major 5.3 - Paninigarilyo/Pag-gamit ng vape/pag-gamit ng bong at iba pang instrumentong naglalaman ng nikotina sa loob ng 100 metro mula sa paaralan") echo "selected"; ?>>Major 5.3 - Paninigarilyo/Pag-gamit ng vape/pag-gamit ng bong at iba pang instrumentong naglalaman ng nikotina sa loob ng 100 metro mula sa paaralan</option>
                                    <option value="Major 5.4 - Pagpapasok ng nakalalasing na inumin" <?php if ($offense == "Major 5.4 - Pagpapasok ng nakalalasing na inumin") echo "selected"; ?>>Major 5.4 - Pagpapasok ng nakalalasing na inumin</option>
                                    <option value="Major 5.5 - Paginom ng nakakalasing na inumin sa loob ng paaralan" <?php if ($offense == "Major 5.5 - Paginom ng nakakalasing na inumin sa loob ng paaralan") echo "selected"; ?>>Major 5.5 - Paginom ng nakakalasing na inumin sa loob ng paaralan</option>
                                    <option value="Major 5.6 - Pagpasok ng nakainom o lasing" <?php if ($offense == "Major 5.6 - Pagpasok ng nakainom o lasing") echo "selected"; ?>>Major 5.6 - Pagpasok ng nakainom o lasing</option>
                                    <option value="Major 5.7 - Pagsusugal sa anumang paraan habang nasa loob ng paaralan" <?php if ($offense == "Major 5.7 - Pagsusugal sa anumang paraan habang nasa loob ng paaralan") echo "selected"; ?>>Major 5.7 - Pagsusugal sa anumang paraan habang nasa loob ng paaralan</option>
                                    <option value="Major 5.8 - Pagdadala at pagpapalaganap ng mahahalay na babasahin" <?php if ($offense == "Major 5.8 - Pagdadala at pagpapalaganap ng mahahalay na babasahin") echo "selected"; ?>>Major 5.8 - Pagdadala at pagpapalaganap ng mahahalay na babasahin</option>
                                    <option value="Major 5.9 - Pagdadala at pagpapalaganap ng mga mahahalay na video/clips" <?php if ($offense == "Major 5.9 - Pagdadala at pagpapalaganap ng mga mahahalay na video/clips") echo "selected"; ?>>Major 5.9 - Pagdadala at pagpapalaganap ng mga mahahalay na video/clips</option>
                                    <option value="Major 5.10 - Pagpapakita ng mahalay na gawi sa loob ng paaralan" <?php if ($offense == "Major 5.10 - Pagpapakita ng mahalay na gawi sa loob ng paaralan") echo "selected"; ?>>Major 5.10 - Pagpapakita ng mahalay na gawi sa loob ng paaralan</option>
                                    <option value="Major 5.11 - Public display of affection katulad ng pakikipagyakapan, pakikipaghalikan at iba pang kilos na hindi nararapat sa loob ng paaralan" <?php if ($offense == "Major 5.11 - Public display of affection katulad ng pakikipagyakapan, pakikipaghalikan at iba pang kilos na hindi nararapat sa loob ng paaralan") echo "selected"; ?>>Major 5.11 - Public display of affection katulad ng pakikipagyakapan, pakikipaghalikan at iba pang kilos na hindi nararapat sa loob ng paaralan</option>
                                    <option value="Major 6.1 - Pagbabanta, pananakot o malabis na panghihiya" <?php if ($offense == "Major 6.1 - Pagbabanta, pananakot o malabis na panghihiya") echo "selected"; ?>>Major 6.1 - Pagbabanta, pananakot o malabis na panghihiya</option>
                                    <option value="Major 6.2 - Panunukso ng labis" <?php if ($offense == "Major 6.2 - Panunukso ng labis") echo "selected"; ?>>Major 6.2 - Panunukso ng labis</option>
                                    <option value="Major 6.3 - Pango-ngotong ng salapi o bagay" <?php if ($offense == "Major 6.3 - Pango-ngotong ng salapi o bagay") echo "selected"; ?>>Major 6.3 - Pango-ngotong ng salapi o bagay</option>
                                    <option value="Major 6.4 - Pagpigil sa kahit sino na makapasok sa paaralan at klase" <?php if ($offense == "Major 6.4 - Pagpigil sa kahit sino na makapasok sa paaralan at klase") echo "selected"; ?>>Major 6.4 - Pagpigil sa kahit sino na makapasok sa paaralan at klase</option>
                                    <option value="Major 6.5 - Pananakit" <?php if ($offense == "Major 6.5 - Pananakit") echo "selected"; ?>>Major 6.5 - Pananakit</option>
                                    <option value="Major 6.6 - Cyber bullying o iba pang nakalagay na probisyon sa Anti-bullying" <?php if ($offense == "Major 6.6 - Cyber bullying o iba pang nakalagay na probisyon sa Anti-bullying") echo "selected"; ?>>Major 6.6 - Cyber bullying o iba pang nakalagay na probisyon sa Anti-bullying</option>
                                    <option value="Grave 1 - Pananakit ng kapwa estudyante o guro" <?php if ($offense == "Grave 1 - Pananakit ng kapwa estudyante o guro") echo "selected"; ?>>Grave 1 - Pananakit ng kapwa estudyante o guro</option>
                                    <option value="Grave 2 - Pagsali sa Fraternity o Sorority na nagdudulot ng (1) kapahamakan o kaguluhan sa kapwa mag-aaral o sa buong paaralan at kinabibilangang komunidad ng paaralan, (2) pagkasangkot sa inisasyon o hazing na maaring ikapahamak o ikamatay ng kapwa mag-aaral" <?php if ($offense == "Grave 2 - Pagsali sa Fraternity o Sorority na nagdudulot ng (1) kapahamakan o kaguluhan sa kapwa mag-aaral o sa buong paaralan at kinabibilangang komunidad ng paaralan, (2) pagkasangkot sa inisasyon o hazing na maaring ikapahamak o ikamatay ng kapwa mag-aaral") echo "selected"; ?>>Grave 2 - 2.	Pagsali sa Fraternity o Sorority na nagdudulot ng (1) kapahamakan o kaguluhan sa kapwa mag-aaral o sa buong paaralan at kinabibilangang komunidad ng paaralan, (2) pagkasangkot sa inisasyon o hazing na maaring ikapahamak o ikamatay ng kapwa mag-aaral</option>
                                    <option value="Grave 3 - Pagdadala ng pampasabog o mga bagay na may kinalaman sa terorismo" <?php if ($offense == "Grave 3 - Pagdadala ng pampasabog o mga bagay na may kinalaman sa terorismo") echo "selected"; ?>>Grave 3 - Pagdadala ng pampasabog o mga bagay na may kinalaman sa terorismo</option>
                                    <option value="Grave 4 - Pagpapasok o paggamit ng droga o kahalintulad nito gaya ng marijuana, shabu, atbpa" <?php if ($offense == "Grave 4 - Pagpapasok o paggamit ng droga o kahalintulad nito gaya ng marijuana, shabu, atbpa") echo "selected"; ?>>Grave 4 - Pagpapasok o paggamit ng droga o kahalintulad nito gaya ng marijuana, shabu, atbpa</option>
                            </select> <br>
                            <label for="">Decision:</label><br>
                            <select id="decision" name="decision" size="1" required>
                                    <option value="Minor 1 - Pagpapaalaala na may kalakip na (1.1) Pagkumpiska ng pinagbabawal na kagamitan (1.2) Pagpapatawag ng magulang" <?php if ($decision == "Minor 1 - Pagpapaalaala na may kalakip na (1.1) Pagkumpiska ng pinagbabawal na kagamitan (1.2) Pagpapatawag ng magulang") echo "selected"; ?>>Minor 1 - Pagpapaalaala na may kalakip na (1.1)Pagkumpiska ng pinagbabawal na kagamitan (1.2)Pagpapatawag ng magulang</option>
                                    <option value="Minor 2 - Pagpapatawag at pagpapaliwanag sa magulang na may kalakip na Interbensyon at Programang Paggabay" <?php if ($decision == "Minor 2 - Pagpapatawag at pagpapaliwanag sa magulang na may kalakip na Interbensyon at Programang Paggabay") echo "selected"; ?>>Minor 2 - Pagpapatawag at pagpapaliwanag sa magulang na may kalakip na Interbensyon at Programang Paggabay</option>
                                    <option value="Minor 3 - Pagpapatawag at pagpapaliwanag sa magulang o Home Visit (3.1) Tatlong araw na Community Service matapos ang regular na klase (3.2) Ibabalik ang mag-aaral sa pangangalaga ng magulang" <?php if ($decision == "Minor 3 - Pagpapatawag at pagpapaliwanag sa magulang o Home Visit (3.1) Tatlong araw na Community Service matapos ang regular na klase (3.2) Ibabalik ang mag-aaral sa pangangalaga ng magulang") echo "selected"; ?>>Minor 3 - Pagpapatawag at pagpapaliwanag sa magulang o Home Visit (3.1)Tatlong araw na Community Service matapos ang regular na klase (3.2)Ibabalik ang mag-aaral sa pangangalaga ng magulang</option>
                                    <option value="Minor 4 - Ituturing na itong Major Offense" <?php if ($decision == "Minor 4 - Ituturing na itong Major Offense") echo "selected"; ?>>Minor 4 - Ituturing na itong Major Offense</option>
                                    <option value="Major 1 - Pagpapatawag at pagpapaliwanag ng magulang na may kalakip na (1.1) Pagpasok sa Interbensyon at Programang Paggabay (1.2) Pagkumpiska ng pinagbabawal na kagamitan (1.3) Pagpapanumbalik/pagpapalit ng nasirang kagamitan ng paaralan (1.4) Pagbabayad ng danyos" <?php if ($decision == "Major 1 - Pagpapatawag at pagpapaliwanag ng magulang na may kalakip na (1.1) Pagpasok sa Interbensyon at Programang Paggabay (1.2) Pagkumpiska ng pinagbabawal na kagamitan (1.3) Pagpapanumbalik/pagpapalit ng nasirang kagamitan ng paaralan (1.4) Pagbabayad ng danyos") echo "selected"; ?>>Major 1 - Pagpapatawag at pagpapaliwanag ng magulang na may kalakip na (1.1) Pagpasok sa Interbensyon at Programang Paggabay (1.2) Pagkumpiska ng pinagbabawal na kagamitan (1.3) Pagpapanumbalik/pagpapalit ng nasirang kagamitan ng paaralan (1.4) Pagbabayad ng danyos</option>
                                    <option value="Major 2 - Pagpapatawag at pagpapaliwanag sa magulang na may kalakip na (2.1) Interbensyon at Programang Paggabay kasama ang magulang (2.2) Tatlong araw na Community Service matapos ang regular na klase  (2.3) Suspensyon na gugugulin sa loob ng paaralan na may kasamang Community Service na di hihigit sa 3 araw (2.4) Pagpapatawag sa magulang at DSWD kung menor de edad at Pulis kapag nasa tamang edad" <?php if ($decision == "Major 2 - Pagpapatawag at pagpapaliwanag sa magulang na may kalakip na (2.1) Interbensyon at Programang Paggabay kasama ang magulang (2.2) Tatlong araw na Community Service matapos ang regular na klase  (2.3) Suspensyon na gugugulin sa loob ng paaralan na may kasamang Community Service na di hihigit sa 3 araw (2.4) Pagpapatawag sa magulang at DSWD kung menor de edad at Pulis kapag nasa tamang edad") echo "selected"; ?>>Major 2 - Pagpapatawag at pagpapaliwanag sa magulang na may kalakip na (2.1) Interbensyon at Programang Paggabay kasama ang magulang (2.2) Tatlong araw na Community Service matapos ang regular na klase  (2.3) Suspensyon na gugugulin sa loob ng paaralan na may kasamang Community Service na di hihigit sa 3 araw (2.4) Pagpapatawag sa magulang at DSWD kung menor de edad at Pulis kapag nasa tamang edad</option>
                                    <option value="Major 3 - Pagpapatawag at pagpapaliwanag sa magulang o Home Visit na may kalakip na (3.1) Ibabalik ang mag-aaral sa pangangalaga ng magulang (Suspensyon) (3.2) Konsultasyon sa bagong kapaligiran (Pagpapalipat ng ibang paaralan)" <?php if ($decision == "Major 3 - Pagpapatawag at pagpapaliwanag sa magulang o Home Visit na may kalakip na (3.1) Ibabalik ang mag-aaral sa pangangalaga ng magulang (Suspensyon) (3.2) Konsultasyon sa bagong kapaligiran (Pagpapalipat ng ibang paaralan)") echo "selected"; ?>>Major 3 - Pagpapatawag at pagpapaliwanag sa magulang o Home Visit na may kalakip na (3.1) Ibabalik ang mag-aaral sa pangangalaga ng magulang (Suspensyon) (3.2) Konsultasyon sa bagong kapaligiran (Pagpapalipat ng ibang paaralan)</option>
                                    <option value="Grave 1.1 - Unang Pagkakataon- Pagpapatawag at pagpapaliwanag ng magulang, pagpasok sa Interbensyon at Programang Paggabay at pagbabayad ng danyos" <?php if ($decision == "Grave 1.1 - Unang Pagkakataon- Pagpapatawag at pagpapaliwanag ng magulang, pagpasok sa Interbensyon at Programang Paggabay at pagbabayad ng danyos") echo "selected"; ?>>Grave 1.1 - Unang Pagkakataon- Pagpapatawag at pagpapaliwanag ng magulang, pagpasok sa Interbensyon at Programang Paggabay at pagbabayad ng danyos</option>
                                    <option value="Grave 1.2 - Pangalawang Pagkakataon- Suspensiyon na di lalampas ng limang araw, pagpasok sa Interbensyon at Programang Paggabay at pagbabayad ng danyos" <?php if ($decision == "Grave 1.2 - Pangalawang Pagkakataon- Suspensiyon na di lalampas ng limang araw, pagpasok sa Interbensyon at Programang Paggabay at pagbabayad ng danyos") echo "selected"; ?>>Grave 1.2 - Pangalawang Pagkakataon- Suspensiyon na di lalampas ng limang araw, pagpasok sa Interbensyon at Programang Paggabay at pagbabayad ng danyos</option>
                                    <option value="Grave 1.3 - Pangatlong Pagkakataon- Konsultasyons a bagong kapaligiran (Pagpapalipat ng ibang paaralan)" <?php if ($decision == "Grave 1.3 - Pangatlong Pagkakataon- Konsultasyons a bagong kapaligiran (Pagpapalipat ng ibang paaralan)") echo "selected"; ?>>Grave 1.3 - Pangatlong Pagkakataon- Konsultasyons a bagong kapaligiran (Pagpapalipat ng ibang paaralan)</option>
                                    <option value="Grave 2.1 - Pagpapatawag at pagpapaliwanag sa magulang, pagpasok sa Interbensyon at Programang Paggabay" <?php if ($decision == "Grave 2.1 - Pagpapatawag at pagpapaliwanag sa magulang, pagpasok sa Interbensyon at Programang Paggabay") echo "selected"; ?>>Grave 2.1 - Pagpapatawag at pagpapaliwanag sa magulang, pagpasok sa Interbensyon at Programang Paggabay</option>
                                    <option value="Grave 2.2 - Suspensiyon na di lalampas ng tatlong araw at pagpasok sa Interbensyon at Programang Paggabay" <?php if ($decision == "Grave 2.2 - Suspensiyon na di lalampas ng tatlong araw at pagpasok sa Interbensyon at Programang Paggabay") echo "selected"; ?>>Grave 2.2 - Suspensiyon na di lalampas ng tatlong araw at pagpasok sa Interbensyon at Programang Paggabay</option>
                                    <option value="Grave 2.3 - Ibabalik ang mag-aaral sa pangangalaga ng magulang" <?php if ($decision == "Grave 2.3 - Ibabalik ang mag-aaral sa pangangalaga ng magulang") echo "selected"; ?>>Grave 2.3 - Ibabalik ang mag-aaral sa pangangalaga ng magulang</option>
                                    <option value="Grave 3.1 - Pagkumpiska ng naturang pamapasabog, pagpapatawag ng magulang at pagpasok sa Interbensyon at Programang Paggabay" <?php if ($decision == "Grave 3.1 - Pagkumpiska ng naturang pamapasabog, pagpapatawag ng magulang at pagpasok sa Interbensyon at Programang Paggabay") echo "selected"; ?>>Grave 3.1 - Pagkumpiska ng naturang pamapasabog, pagpapatawag ng magulang at pagpasok sa Interbensyon at Programang Paggabay</option>
                                    <option value="Grave 3.2 - Suspensyon na di lalampas sa tatlong araw at pagpasok sa Interbensyon at Programang Paggabay kasama ang magulang" <?php if ($decision == "Grave 3.2 - Suspensyon na di lalampas sa tatlong araw at pagpasok sa Interbensyon at Programang Paggabay kasama ang magulang") echo "selected"; ?>>Grave 3.2 - Suspensyon na di lalampas sa tatlong araw at pagpasok sa Interbensyon at Programang Paggabay kasama ang magulang</option>
                                    <option value="Grave 3.3 - Ibabalik ng isang lingo ang mag-aaral sa pangangalaga ng magulang" <?php if ($decision == "Grave 3.3 - Ibabalik ng isang lingo ang mag-aaral sa pangangalaga ng magulang") echo "selected"; ?>>Grave 3.3 - Ibabalik ng isang lingo ang mag-aaral sa pangangalaga ng magulang</option>
                                    <option value="Grave 4.1 - Pagpapatawag ng magulang, Social Worker (DSWD) kapag ang magaaral ay menor de edad at Pulisya naman kung ang mag-aaral ay nasa tamang edad na" <?php if ($decision == "Grave 4.1 - Pagpapatawag ng magulang, Social Worker (DSWD) kapag ang magaaral ay menor de edad at Pulisya naman kung ang mag-aaral ay nasa tamang edad na") echo "selected"; ?>>Grave 4.1 - Pagpapatawag ng magulang, Social Worker (DSWD) kapag ang magaaral ay menor de edad at Pulisya naman kung ang mag-aaral ay nasa tamang edad na</option>
                                    <option value="Grave 4.2 - Konsultasyon sa bagong kapaligiran (Pagpapalipat ng ibang paaralan)" <?php if ($decision == "Grave 4.2 - Konsultasyon sa bagong kapaligiran (Pagpapalipat ng ibang paaralan)") echo "selected"; ?>>Grave 4.2 - Konsultasyon sa bagong kapaligiran (Pagpapalipat ng ibang paaralan)</option>
                            </select> <br>
                            <button type="submit" id="btn_UpdateOffense">Update Offense</button>
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