<?php
    $date = "";
    $name = "";
    $lrn = "";
    $grade_section = "";
    $offense = "";
    $contact = "";
    $decision = "";
    $pGName = "";
    
    //add the data from the form to the database
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //store in the variable the value of the form
        $date = $_POST['date'];
        $name = $_POST['name'];
        $lrn = $_POST['lrn'];
        $grade_section = $_POST['grade_section'];
        $offense = $_POST['offense'];
        $pGName = $_POST['pGName'];
        $contact = $_POST['contact'];
        $decision = $_POST['decision'];

        $conn = mysqli_connect('localhost', 'root', '', 'dac_record');

        //add data to the students_info table
        $queryInfo = "INSERT INTO students_info (lrn, name, grade_section, parent_guardian_name, contact_number) VALUES ('$lrn', '$name', '$grade_section', '$pGName', '$contact')";
        $resultInfo = $conn->query($queryInfo);

        //add data to the students_offense table
        $queryOffense = "INSERT INTO students_offense (date, offense_lrn, offense, decision) VALUES ('$date', '$lrn', '$offense', '$decision')";
        $resultOffense = $conn->query($queryOffense);

        mysqli_close($conn);

        echo "<script>alert('New record added successfully!')</script>";
        echo "<script>window.location.href = 'manage.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <script src="index.js"></script>
    <link rel="stylesheet" href="styleAddRecord.css?v=<?php echo time(); ?>">
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
                        <a href="dashboard.php ">
                            <i class="fa-solid fa-gauge">&nbsp;&nbsp;DashBoard</i>
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
                        <i class="fa-solid fa-user">&nbsp;&nbsp;Add Student</i> 
                    </div>
                    <form method="post">
                    <div class="content_Body">
                        <div class="content_Left">
                                <label>Name:</label><br>
                                <input type="text" id="name" name="name" value="<?php echo $name ?>" required> <br>
                                <label>LRN:</label><br>
                                <input type="text" id="lrn" name="lrn" value="<?php echo $lrn ?>" required> <br>
                                <label>Grade and Section:</label><br>
                                <input type="text" id="grade_section" name="grade_section" value="<?php echo $grade_section ?>" required> <br>
                                <label>Offense:</label><br>
                                <select id="offense" name="offense" size="1" value="<?php echo $offense ?>" required>
                                    <option value="Minor 1.1 - Hindi pagsusuot ng angkop na kasuotan">Minor 1.1 - Hindi pagsusuot ng angkop na kasuotan</option>
                                    <option value="Minor 1.2 - Pagususot ng mapanuksong damit (maikli, malalim ang leeg, hapit sa katawan)">Minor 1.2 - Pagususot ng mapanuksong damit (maikli, malalim ang leeg, hapit sa katawan)</option>
                                    <option value="Minor 1.3 - Pagsusuot ng punit-punit na pantalon na nagpapakita ng balat">Minor 1.3 - Pagsusuot ng punit-punit na pantalon na nagpapakita ng balat</option>
                                    <option value="Minor 1.4 - Pagsusuot ng sinelas o sandals">Minor 1.4 - Pagsusuot ng sinelas o sandals</option>
                                    <option value="Minor 1.5 - Pagsusuot ng hikaw at pagkakaroon ng body piercing sa mga kalalakihan at tatlo o higit pang piercing sa mga kababaihan">Minor 1.5 - Pagsusuot ng hikaw at pagkakaroon ng body piercing sa mga kalalakihan at tatlo o higit pang piercing sa mga kababaihan</option>
                                    <option value="Minor 1.6 - Pagkakaroon ng tattoo sa nakikitang bahagi ng katawan o hindi pagtatakip ng mga tattoo sa katawan">Minor 1.6 - Pagkakaroon ng tattoo sa nakikitang bahagi ng katawan o hindi pagtatakip ng mga tattoo sa katawan</option>
                                    <option value="Minor 2.1 - Hindi pagsusuot ng Pagkakakilanlan o ID Pagsira">Minor 2.1 - Hindi pagsusuot ng Pagkakakilanlan o ID Pagsira</option>
                                    <option value="Minor 2.2 - Pagtamper sa ID">Minor 2.2 - Pagtamper sa ID</option>
                                    <option value="Minor 2.3 - Paggamit ng ibang ID upang makapasok sa paaralan">Minor 2.3 - Paggamit ng ibang ID upang makapasok sa paaralan</option>
                                    <option value="Minor 2.4 - Pagpapahiram ng ID sa ibang estudyante liban na lamang kung manghihiram ng gamit sa silid aklatan o sa laboratoryo o katulad na gawain">Minor 2.4 - Pagpapahiram ng ID sa ibang estudyante liban na lamang kung manghihiram ng gamit sa silid aklatan o sa laboratoryo o katulad na gawain</option>
                                    <option value="Minor 3.1 - Palagiang pagpasok ng huli sa mga klase na umaabot na ng limang (5) araw o isang buong lingo">Minor 3.1 - Palagiang pagpasok ng huli sa mga klase na umaabot na ng limang (5) araw o isang buong lingo</option>
                                    <option value="Minor 3.2 - Palagiang pagliban ng higit isang linggo kada buwan at hindi pagpapasa ng Excuse Letter na may lagda ng magulang o tagapag-alaga">Minor 3.2 - Palagiang pagliban ng higit isang linggo kada buwan at hindi pagpapasa ng Excuse Letter na may lagda ng magulang o tagapag-alaga</option>
                                    <option value="Minor 3.3 - Pagka-cutting classes">Minor 3.3 - Pagka-cutting classes</option>
                                    <option value="Minor 3.4 - Paglabas ng klasrum ng walang paalam sa mga guro at pagpapakita ng kawalang galang">Minor 3.4 - Paglabas ng klasrum ng walang paalam sa mga guro at pagpapakita ng kawalang galang</option>
                                    <option value="Minor 3.5 - Pagpapaliwanag na pirmado ng magulang o designated guardian ng mag-aaral">Minor 3.5 - Pagpapaliwanag na pirmado ng magulang o designated guardian ng mag-aaral</option>
                                    <option value="Minor 4.1 - Pagtatapon ng BASURA sa kung saan saan">Minor 4.1 - Pagtatapon ng BASURA sa kung saan saan</option>
                                    <option value="Minor 4.2 - Paglikha ng ingay na nakakaabala sa mga klase">Minor 4.2 - Paglikha ng ingay na nakakaabala sa mga klase</option>
                                    <option value="Minor 4.3 - Pagtambay sa pasilyo na lumilikha ng ingay o kaguluhan na nakaka-abala sa mga klase">Minor 4.3 - Pagtambay sa pasilyo na lumilikha ng ingay o kaguluhan na nakaka-abala sa mga klase</option>
                                    <option value="Minor 4.4 - Paggamit ng Cellular Phone na walang pahintulot habang nagkaklase">Minor 4.4 - Paggamit ng Cellular Phone na walang pahintulot habang nagkaklase</option>
                                    <option value="Minor 4.5 - Pagmumura at pagsasalita ng may kabastusan na nakakasakit ng damdamin ng iba">Minor 4.5 - Pagmumura at pagsasalita ng may kabastusan na nakakasakit ng damdamin ng iba</option>
                                    <option value="Major 1.1 - Hindi pagsunod sa alituntuning pinapatupad ng mga guro at kawani ng paaralan">Major 1.1 - Hindi pagsunod sa alituntuning pinapatupad ng mga guro at kawani ng paaralan</option>
                                    <option value="Major 1.2 - Pagtataas ng boses o paghahamon ng away sa mga guro at kawani ng paaralan">Major 1.2 - Pagtataas ng boses o paghahamon ng away sa mga guro at kawani ng paaralan</option>
                                    <option value="Major 1.3 - Maling paggamit ng pangalan ng paaralan na ikasisira ng maganda nitong imahe">Major 1.3 - Maling paggamit ng pangalan ng paaralan na ikasisira ng maganda nitong imahe</option>
                                    <option value="Major 1.4 - Pagkuha ng video o larawan ng kapwa mag-aaral o guro na walang pahintulot at pag upload nito sa anumang social media platform">Major 1.4 - Pagkuha ng video o larawan ng kapwa mag-aaral o guro na walang pahintulot at pag upload nito sa anumang social media platform</option>
                                    <option value="Major 1.5 - Pag upload ng larawan o video ng sarili na nagpapakita ng masamang asal o gawain habang nasa loob ng paaralan">Major 1.5 - Pag upload ng larawan o video ng sarili na nagpapakita ng masamang asal o gawain habang nasa loob ng paaralan</option>
                                    <option value="Major 2.1 - Paglabas sa gate ng paaralan ng walang (1) kaukulang paalam at rekord sa gwardya (2) sulat mula sa gurong tagapayo na ito ay pinapayagan na umuwi (3) kasamang parent/guardian o authorized fetcher">Major 2.1 - Paglabas sa gate ng paaralan ng walang (1) kaukulang paalam at rekord sa gwardya (2) sulat mula sa gurong tagapayo na ito ay pinapayagan na umuwi (3) kasamang parent/guardian o authorized fetcher</option>
                                    <option value="Major 2.2 - Panlilinlang sa magulang o tagapamatnubay sa mga gawain at koleksyon sa paaralan">Major 2.2 - Panlilinlang sa magulang o tagapamatnubay sa mga gawain at koleksyon sa paaralan</option>
                                    <option value="Major 2.3 - Pandaraya o palsipikasyon ng mga tala ng paaralan">Major 2.3 - Pandaraya o palsipikasyon ng mga tala ng paaralan</option>
                                    <option value="Major 2.4 - Pamemeke ng lagda ng magulang o tagapag-alaga, guro o kawani ng paaralan">Major 2.4 - Pamemeke ng lagda ng magulang o tagapag-alaga, guro o kawani ng paaralan</option>
                                    <option value="Major 2.5 - Pandaraya sa mga pagsusulit, eksaminasyon o mga gawaing pang-akademiko">Major 2.5 - Pandaraya sa mga pagsusulit, eksaminasyon o mga gawaing pang-akademiko</option>
                                    <option value="Major 2.6 - Pangangalap ng salapi o donasyon sa ngalan ng paaralan na walang pahintulot">Major 2.6 - Pangangalap ng salapi o donasyon sa ngalan ng paaralan na walang pahintulot</option>
                                    <option value="Major 2.7 - Pagbebenta ng tiket na hindi pinayagan ng pamunuan ng paaralan">Major 2.7 - Pagbebenta ng tiket na hindi pinayagan ng pamunuan ng paaralan</option>
                                    <option value="Major 2.8 - Pamemeke ng lagda ng sinuman sa paaralan at paggamit nito sa mali o illegal na paraan">Major 2.8 - Pamemeke ng lagda ng sinuman sa paaralan at paggamit nito sa mali o illegal na paraan</option>
                                    <option value="Major 2.9 - Pagnanakaw ng gamit ng paaralan o ng kagamitan ng mga guro o kawani nito">Major 2.9 - Pagnanakaw ng gamit ng paaralan o ng kagamitan ng mga guro o kawani nito</option>
                                    <option value="Major 3.1 - Pagsusuot ng singsing na may spike at malalaking metal na buckles ng sinturon na nakakasakit">Major 3.1 - Pagsusuot ng singsing na may spike at malalaking metal na buckles ng sinturon na nakakasakit</option>
                                    <option value="Major 3.2 - Paghahamon ng away o pag-aamok na nagdulot ng kaguluhan sa loob o labas ng paaralan">Major 3.2 - Paghahamon ng away o pag-aamok na nagdulot ng kaguluhan sa loob o labas ng paaralan</option>
                                    <option value="Major 3.3 - Pagsisimula ng rambol o riot sa loob at labas ng paaralan">Major 3.3 - Pagsisimula ng rambol o riot sa loob at labas ng paaralan</option>
                                    <option value="Major 4.1 - Intensyonal na pagsira ng mga silya, lamesa o pintuan ng paaralan">Major 4.1 - Intensyonal na pagsira ng mga silya, lamesa o pintuan ng paaralan</option>
                                    <option value="Major 4.2 - Pagbasag ng mga salamin, water closet at toilet bowl at pagsira ng mga gripo sa loob ng palikuran">Major 4.2 - Pagbasag ng mga salamin, water closet at toilet bowl at pagsira ng mga gripo sa loob ng palikuran</option>
                                    <option value="Major 4.3 - Pagbasag ng mga bintana at ilaw sa paaralan">Major 4.3 - Pagbasag ng mga bintana at ilaw sa paaralan</option>
                                    <option value="Major 4.4 - Pagsusulat sa mga dingding at mga kagamitan ng paaralan">Major 4.4 - Pagsusulat sa mga dingding at mga kagamitan ng paaralan</option>
                                    <option value="Major 5.1 - Pagpapasok ng sigarilyo, tabako, pipe, e-cigarettes, IQOS o Heets, vape, waterpipe o bong sa loob ng paaralan">Major 5.1 - Pagpapasok ng sigarilyo, tabako, pipe, e-cigarettes, IQOS o Heets, vape, waterpipe o bong sa loob ng paaralan</option>
                                    <option value="Major 5.2 - Paninigarilyo/Pag-gamit ng vape/pag-gamit ng bong at iba pang instrumentong naglalaman ng nikotina sa loob ng paaralan">Major 5.2 - Paninigarilyo/Pag-gamit ng vape/pag-gamit ng bong at iba pang instrumentong naglalaman ng nikotina sa loob ng paaralan</option>
                                    <option value="Major 5.3 - Paninigarilyo/Pag-gamit ng vape/pag-gamit ng bong at iba pang instrumentong naglalaman ng nikotina sa loob ng 100 metro mula sa paaralan">Major 5.3 - Paninigarilyo/Pag-gamit ng vape/pag-gamit ng bong at iba pang instrumentong naglalaman ng nikotina sa loob ng 100 metro mula sa paaralan</option>
                                    <option value="Major 5.4 - Pagpapasok ng nakalalasing na inumin">Major 5.4 - Pagpapasok ng nakalalasing na inumin</option>
                                    <option value="Major 5.5 - Paginom ng nakakalasing na inumin sa loob ng paaralan">Major 5.5 - Paginom ng nakakalasing na inumin sa loob ng paaralan</option>
                                    <option value="Major 5.6 - Pagpasok ng nakainom o lasing">Major 5.6 - Pagpasok ng nakainom o lasing</option>
                                    <option value="Major 5.7 - Pagsusugal sa anumang paraan habang nasa loob ng paaralan">Major 5.7 - Pagsusugal sa anumang paraan habang nasa loob ng paaralan</option>
                                    <option value="Major 5.8 - Pagdadala at pagpapalaganap ng mahahalay na babasahin">Major 5.8 - Pagdadala at pagpapalaganap ng mahahalay na babasahin</option>
                                    <option value="Major 5.9 - Pagdadala at pagpapalaganap ng mga mahahalay na video/clips">Major 5.9 - Pagdadala at pagpapalaganap ng mga mahahalay na video/clips</option>
                                    <option value="Major 5.10 - Pagpapakita ng mahalay na gawi sa loob ng paaralan">Major 5.10 - Pagpapakita ng mahalay na gawi sa loob ng paaralan</option>
                                    <option value="Major 5.11 - Public display of affection katulad ng pakikipagyakapan, pakikipaghalikan at iba pang kilos na hindi nararapat sa loob ng paaralan">Major 5.11 - Public display of affection katulad ng pakikipagyakapan, pakikipaghalikan at iba pang kilos na hindi nararapat sa loob ng paaralan</option>
                                    <option value="Major 6.1 - Pagbabanta, pananakot o malabis na panghihiya">Major 6.1 - Pagbabanta, pananakot o malabis na panghihiya</option>
                                    <option value="Major 6.2 - Panunukso ng labis">Major 6.2 - Panunukso ng labis</option>
                                    <option value="Major 6.3 - Pango-ngotong ng salapi o bagay">Major 6.3 - Pango-ngotong ng salapi o bagay</option>
                                    <option value="Major 6.4 - Pagpigil sa kahit sino na makapasok sa paaralan at klase">Major 6.4 - Pagpigil sa kahit sino na makapasok sa paaralan at klase</option>
                                    <option value="Major 6.5 - Pananakit">Major 6.5 - Pananakit</option>
                                    <option value="Major 6.6 - Cyber bullying o iba pang nakalagay na probisyon sa Anti-bullying">Major 6.6 - Cyber bullying o iba pang nakalagay na probisyon sa Anti-bullying</option>
                                    <option value="Grave 1 - Pananakit ng kapwa estudyante o guro">Grave 1 - Pananakit ng kapwa estudyante o guro</option>
                                    <option value="Grave 2 - Pagsali sa Fraternity o Sorority na nagdudulot ng (1) kapahamakan o kaguluhan sa kapwa mag-aaral o sa buong paaralan at kinabibilangang komunidad ng paaralan, (2) pagkasangkot sa inisasyon o hazing na maaring ikapahamak o ikamatay ng kapwa mag-aaral">Grave 2 - 2.	Pagsali sa Fraternity o Sorority na nagdudulot ng (1) kapahamakan o kaguluhan sa kapwa mag-aaral o sa buong paaralan at kinabibilangang komunidad ng paaralan, (2) pagkasangkot sa inisasyon o hazing na maaring ikapahamak o ikamatay ng kapwa mag-aaral</option>
                                    <option value="Grave 3 - Pagdadala ng pampasabog o mga bagay na may kinalaman sa terorismo">Grave 3 - Pagdadala ng pampasabog o mga bagay na may kinalaman sa terorismo</option>
                                    <option value="Grave 4 - Pagpapasok o paggamit ng droga o kahalintulad nito gaya ng marijuana, shabu, atbpa">Grave 4 - Pagpapasok o paggamit ng droga o kahalintulad nito gaya ng marijuana, shabu, atbpa</option>
                                </select> <br>
                        </div>
                        <div class="content_Right">
                                <label>Parent/Guardian Name:</label><br>
                                <input type="text" id="pGName" name="pGName" value="<?php echo $pGName ?>"> <br>
                                <label>Contact Number:</label><br>
                                <input type="text" id="contact" name="contact" value="<?php echo $contact ?>"> <br>
                                <label>Date:</label><br>
                                <input type="date" id="date" name="date" value="<?php echo $date ?>" required> <br>
                                <label>Decision:</label><br>
                                <select id="decision" name="decision" size="1" value="<?php echo $decision ?>" required>
                                    <option value="Minor 1 - Pagpapaalaala na may kalakip na (1.1) Pagkumpiska ng pinagbabawal na kagamitan (1.2) Pagpapatawag ng magulang">Minor 1 - Pagpapaalaala na may kalakip na (1.1)Pagkumpiska ng pinagbabawal na kagamitan (1.2)Pagpapatawag ng magulang</option>
                                    <option value="Minor 2 - Pagpapatawag at pagpapaliwanag sa magulang na may kalakip na Interbensyon at Programang Paggabay">Minor 2 - Pagpapatawag at pagpapaliwanag sa magulang na may kalakip na Interbensyon at Programang Paggabay</option>
                                    <option value="Minor 3 - Pagpapatawag at pagpapaliwanag sa magulang o Home Visit (3.1) Tatlong araw na Community Service matapos ang regular na klase (3.2) Ibabalik ang mag-aaral sa pangangalaga ng magulang">Minor 3 - Pagpapatawag at pagpapaliwanag sa magulang o Home Visit (3.1)Tatlong araw na Community Service matapos ang regular na klase (3.2)Ibabalik ang mag-aaral sa pangangalaga ng magulang</option>
                                    <option value="Minor 4 - Ituturing na itong Major Offense">Minor 4 - Ituturing na itong Major Offense</option>
                                    <option value="Major 1 - Pagpapatawag at pagpapaliwanag ng magulang na may kalakip na (1.1) Pagpasok sa Interbensyon at Programang Paggabay (1.2) Pagkumpiska ng pinagbabawal na kagamitan (1.3) Pagpapanumbalik/pagpapalit ng nasirang kagamitan ng paaralan (1.4) Pagbabayad ng danyos">Major 1 - Pagpapatawag at pagpapaliwanag ng magulang na may kalakip na (1.1) Pagpasok sa Interbensyon at Programang Paggabay (1.2) Pagkumpiska ng pinagbabawal na kagamitan (1.3) Pagpapanumbalik/pagpapalit ng nasirang kagamitan ng paaralan (1.4) Pagbabayad ng danyos</option>
                                    <option value="Major 2 - Pagpapatawag at pagpapaliwanag sa magulang na may kalakip na (2.1) Interbensyon at Programang Paggabay kasama ang magulang (2.2) Tatlong araw na Community Service matapos ang regular na klase  (2.3) Suspensyon na gugugulin sa loob ng paaralan na may kasamang Community Service na di hihigit sa 3 araw (2.4) Pagpapatawag sa magulang at DSWD kung menor de edad at Pulis kapag nasa tamang edad
                                    ">Major 2 - Pagpapatawag at pagpapaliwanag sa magulang na may kalakip na (2.1) Interbensyon at Programang Paggabay kasama ang magulang (2.2) Tatlong araw na Community Service matapos ang regular na klase  (2.3) Suspensyon na gugugulin sa loob ng paaralan na may kasamang Community Service na di hihigit sa 3 araw (2.4) Pagpapatawag sa magulang at DSWD kung menor de edad at Pulis kapag nasa tamang edad</option>
                                    <option value="Major 3 - Pagpapatawag at pagpapaliwanag sa magulang o Home Visit na may kalakip na (3.1) Ibabalik ang mag-aaral sa pangangalaga ng magulang (Suspensyon) (3.2) Konsultasyon sa bagong kapaligiran (Pagpapalipat ng ibang paaralan)">Major 3 - Pagpapatawag at pagpapaliwanag sa magulang o Home Visit na may kalakip na (3.1) Ibabalik ang mag-aaral sa pangangalaga ng magulang (Suspensyon) (3.2) Konsultasyon sa bagong kapaligiran (Pagpapalipat ng ibang paaralan)</option>
                                    <option value="Grave 1.1 - Unang Pagkakataon- Pagpapatawag at pagpapaliwanag ng magulang, pagpasok sa Interbensyon at Programang Paggabay at pagbabayad ng danyos">Grave 1.1 - Unang Pagkakataon- Pagpapatawag at pagpapaliwanag ng magulang, pagpasok sa Interbensyon at Programang Paggabay at pagbabayad ng danyos</option>
                                    <option value="Grave 1.2 - Pangalawang Pagkakataon- Suspensiyon na di lalampas ng limang araw, pagpasok sa Interbensyon at Programang Paggabay at pagbabayad ng danyos">Grave 1.2 - Pangalawang Pagkakataon- Suspensiyon na di lalampas ng limang araw, pagpasok sa Interbensyon at Programang Paggabay at pagbabayad ng danyos</option>
                                    <option value="Grave 1.3 - Pangatlong Pagkakataon- Konsultasyons a bagong kapaligiran (Pagpapalipat ng ibang paaralan)">Grave 1.3 - Pangatlong Pagkakataon- Konsultasyons a bagong kapaligiran (Pagpapalipat ng ibang paaralan)</option>
                                    <option value="Grave 2.1 - Pagpapatawag at pagpapaliwanag sa magulang, pagpasok sa Interbensyon at Programang Paggabay">Grave 2.1 - Pagpapatawag at pagpapaliwanag sa magulang, pagpasok sa Interbensyon at Programang Paggabay</option>
                                    <option value="Grave 2.2 - Suspensiyon na di lalampas ng tatlong araw at pagpasok sa Interbensyon at Programang Paggabay">Grave 2.2 - Suspensiyon na di lalampas ng tatlong araw at pagpasok sa Interbensyon at Programang Paggabay</option>
                                    <option value="Grave 2.3 - Ibabalik ang mag-aaral sa pangangalaga ng magulang">Grave 2.3 - Ibabalik ang mag-aaral sa pangangalaga ng magulang</option>
                                    <option value="Grave 3.1 - Pagkumpiska ng naturang pamapasabog, pagpapatawag ng magulang at pagpasok sa Interbensyon at Programang Paggabay">Grave 3.1 - Pagkumpiska ng naturang pamapasabog, pagpapatawag ng magulang at pagpasok sa Interbensyon at Programang Paggabay</option>
                                    <option value="Grave 3.2 - Suspensyon na di lalampas sa tatlong araw at pagpasok sa Interbensyon at Programang Paggabay kasama ang magulang">Grave 3.2 - Suspensyon na di lalampas sa tatlong araw at pagpasok sa Interbensyon at Programang Paggabay kasama ang magulang</option>
                                    <option value="Grave 3.3 - Ibabalik ng isang lingo ang mag-aaral sa pangangalaga ng magulang">Grave 3.3 - Ibabalik ng isang lingo ang mag-aaral sa pangangalaga ng magulang</option>
                                    <option value="Grave 4.1 - Pagpapatawag ng magulang, Social Worker (DSWD) kapag ang magaaral ay menor de edad at Pulisya naman kung ang mag-aaral ay nasa tamang edad na">Grave 4.1 - Pagpapatawag ng magulang, Social Worker (DSWD) kapag ang magaaral ay menor de edad at Pulisya naman kung ang mag-aaral ay nasa tamang edad na</option>
                                    <option value="Grave 4.2 - Konsultasyon sa bagong kapaligiran (Pagpapalipat ng ibang paaralan)">Grave 4.2 - Konsultasyon sa bagong kapaligiran (Pagpapalipat ng ibang paaralan)</option>
                                </select> <br>
                        </div>
                    </div>
                    <div class="content_Bottom">
                        <button type="submit" id="btn_AddRecord">Add Record</button>
                    </div>
                    </form>
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