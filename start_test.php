<?php

session_start();


if (!isset($_SESSION["username"])) {
    header('location: index.php');
}

$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'codespindle');

$tname = $_GET['tname'];
$qun = [];
$rs = mysqli_query($con, "select * from tcat where tname = '$tname' ");
while ($rr = mysqli_fetch_array($rs)) {
    $dur = $rr['tdur'];
    $id = $rr['tid'];
    $tname = $rr['tname'];
}

$res = mysqli_query($con, "select * from tqn where category = '$tname' ");
$i = 0;
while ($row = mysqli_fetch_assoc($res)) {
    $qun[$i] = $row['qun'];
    $opt1[$i] = $row['opt1'];
    $opt2[$i] = $row['opt2'];
    $opt3[$i] = $row['opt3'];
    $opt4[$i] = $row['opt4'];
    $ans[$i] = $row['answer'];
    $i++;

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test start</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <!-------------------------------------------------------- navbar ------------------------------------------------------->
    <div class="navi bg-success">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" style="pointer-events: none" href="home.php">CodeSpindle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" style="pointer-events: none" href="java.php">Java</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="pointer-events: none" href="html.php">Html</a>
                    </li>
                    <?php
                    if ($_SESSION['type'] == "admin") {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" style="pointer-events: none" href="set_test.php">Set Test</a>
                        </li>
                        <?php
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" style="pointer-events: none" href="take_test.php">Take Test</a>
                    </li>

                    <li>

                        <a href="" style="pointer-events: none" class="text-white text-decoration-none" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="nav-link">Profile</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="">Settings</a></li>
                            <li><a class="dropdown-item" href="">User Details</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>

                    </li>

                </ul>
            </div>
        </nav>
    </div>

    <!-- ----------------------------------------------------question paper------------------------------------------- -->
    <div id="ttable" class="container-fluid">
        <div class="card">
            <div class="card-header" style="height: 50px;">
                <strong class="card-title" id="ctd" style="color: crimson; font-size: xx-large;">
                </strong>
                <p style="display: inline; float: right; font-size: x-large; font-weight: bolder; font-style: oblique;">
                    <?php echo $tname ?> Test
                </p>

            </div>

            <div class="card-body ccpd">
                <form action="results.php?id=<?php echo $tname; ?>" method="post">
                    <?php
                    if (empty($qun)) {
                        $duri = 6000;
                        ?>
                        <p style="text-align: center; font-size: xx-large; font-weight: lighter;">No Questions Available!
                        </p>
                        <script>
                            document.getElementById("ctd").style.display = "none"
                        </script>
                        <?php
                    } else {
                        for ($i = 0; $i < count($qun); $i++) {
                            ?>
                            <div class="card">
                                <div class="card-head">
                                    <strong class="card-title">
                                        <?php echo $i + 1; ?>
                                    </strong>
                                </div>
                                <div class="card-body">
                                    <table style="margin: 0px auto;">
                                        <tr>
                                            <td>
                                            <label for="qun">
                                                <?php
                                                    if(strpos($qun[$i],'qna_images') !== false){
                                                ?>
                                                    <img src="<?php echo $qun[$i] ?>" alt="Img Not Avl" height="200" width="200">
                                                <?php
                                                }
                                                else{
                                                    echo $qun[$i];
                                                }
                                                ?>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="opt1">
                                                <?php
                                                    if(strpos($opt1[$i],'qna_images') !== false){
                                                ?>
                                                    <img src="<?php echo $opt1[$i] ?>" alt="Img Not Avl" height="200" width="200">
                                                <?php
                                                }
                                                else{
                                                    echo $opt1[$i];
                                                }
                                                ?>
                                                </label>
                                                <input value="<?php echo $opt1[$i] ?>" type="radio" name=<?php echo "ans".$i; ?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="opt2">
                                                <?php
                                                    if(strpos($opt2[$i],'qna_images') !== false){
                                                ?>
                                                    <img src="<?php echo $opt2[$i] ?>" alt="Img Not Avl" height="200" width="200">
                                                <?php
                                                }
                                                else{
                                                    echo $opt2[$i];
                                                }
                                                ?>
                                                </label>
                                                <input value="<?php echo $opt2[$i] ?>" type="radio" name=<?php echo "ans".$i; ?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="opt3">
                                                <?php
                                                    if(strpos($opt3[$i],'qna_images') !== false){
                                                ?>
                                                    <img src="<?php echo $opt3[$i] ?>" alt="Img Not Avl" height="200" width="200">
                                                <?php
                                                }
                                                else{
                                                    echo $opt3[$i];
                                                }
                                                ?>
                                                </label>
                                                <input value="<?php echo $opt3[$i] ?>" type="radio" name=<?php echo "ans".$i; ?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="opt4">
                                                <?php
                                                    if(strpos($opt4[$i],'qna_images') !== false){
                                                ?>
                                                    <img src="<?php echo $opt4[$i] ?>" alt="Img Not Avl" height="200" width="200">
                                                <?php
                                                }
                                                else{
                                                    echo $opt4[$i];
                                                }
                                                ?>
                                                </label>
                                                <input value="<?php echo $opt4[$i] ?>" type="radio" name=<?php echo "ans".$i; ?>>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <input type="submit" value="End Test" class="btn btn-dark">
                        <?php
                    }
                    ?>

                </form>
            </div>

        </div>

    </div>
    <!-- ----------------------------------------------------count-down timer------------------------------------------- -->
    <script>
        function startTimer(testId, duration, display) {
            var timer = duration, minutes, seconds;
            var localStorageKey = "timer-" + testId;
            if (localStorage.getItem(localStorageKey)) {
                timer = localStorage.getItem(localStorageKey);
            }
           
        
            var x = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(x);
                    window.location.href = "results.php?id=<?php echo $id; ?>";
                } else {
                    localStorage.setItem(localStorageKey, timer);
                }
            }, 1000);
        }
        window.onload = function () {
            testId = <?php echo $id ?>,
                duri = <?php echo $dur * 60 ?>,
                display = document.getElementById('ctd');
            startTimer(testId, duri, display);
        };


    </script>
    <script>
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };  
    </script>
    <!-- --------------------------- --------------------------- ---------------------------  --------------------------- -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>