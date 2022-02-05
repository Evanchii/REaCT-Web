<!-- 
  DevNotes:

 -->
<?php
include '../../functions/checkSession.php';

$uid = $_SESSION["uid"];
$infoRef = $database->getReference("Users/" . $uid . "/info");
$linkRef = $database->getReference("appData/links/");

// if (!isset($_SESSION['fName'])) {
//   $_SESSION["lName"] = $infoRef->getChild("lName")->getValue();
//   $_SESSION["fName"] = $infoRef->getChild("fName")->getValue();
//   $_SESSION["mName"] = $infoRef->getChild("mName")->getValue();
// }


// // Firebase Storage
// $storage = $firebase->createStorage();
// $storageClient = $storage->getStorageClient();
// $defaultBucket = $storage->getBucket();


// $expiresAt = new DateTime('tomorrow', new DateTimeZone('Asia/Manila'));
// // echo $expiresAt->getTimestamp();

// $imageReference = $defaultBucket->object($infoRef->getChild("faceID")->getValue());
// if ($imageReference->exists()) {
//   $image = $imageReference->signedUrl($expiresAt);
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../styles/private-common.css">
  <link rel="stylesheet" type="text/css" href="../../styles/settings.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="../../assets/favicon.ico" type="image/x-icon">
  <title>Settings | REaCT</title>
</head>

<body>
  <div class="grid">
  <div class="Navigation">
      <!-- <h2>REaCT</h2> -->
      <img class="text-logo" src="../../assets/text-logo.png" alt="REaCT ">
      <hr class="divider">
      <div class="user-profile">
        <!-- PHP Get from Storage -->
        <img src="../../assets/logo.png">
        <!-- PHP Get from RTDB -->
        <span>
          <?php echo (str_contains($uid, "Uv8vqq4rlrM2ADvfKv6t9KVvndA2")) ? 'Admin Demo' : $infoRef->getChild("addCi")->getValue(); ?>
        </span>
      </div>
      <hr class="divider">
      <a href="dashboard.php"><i class="fas fa-th-large" aria-hidden="true"></i>Dashboard</a>
      <a href="cases.php"><i class="fas fa-line-chart" aria-hidden="true"></i>Covid Cases</a>
      <a href="applications.php"><i class="far fa-file" aria-hidden="true"></i>Applications</a>
      <a href="users.php"><i class="fas fa-users" aria-hidden="true"></i>Users</a>
      <a href="accounts.php"><i class="fas fa-user-cog" aria-hidden="true"></i>Sub-Accounts</a>
      <div class="settings">
        <a href="#" class="active"><i class="fas fa-cog" aria-hidden="true"></i>Setttings</a>
      </div>
    </div>
    <div class="Header">
      <div class="dashboard-date">
        <h2>Settings</h2>
      </div>
      <div class="dashboard-notif">
        <span class="dropdown"><i class="fa fa-user-circle dropbtn" aria-hidden="true"></i>My Account
          <div class="dropdown-content">
            <a href="../logout.php"><i class="fa fa-sign-out"></i>Log out</a>
          </div>
        </span>
      </div>
    </div>
    <div class="Content">

      <div class="content1">
        <h2>Links</h2>
        <hr style="margin-left:35%; margin-right:35%;">
        </hr>
        <a href="../aboutus.php"><i class="fa fa-info-circle" aria-hidden="true"></i>About Us</a>
        <a href="../terms.php"><i class="fa fa-shield" aria-hidden="true"></i>Terms of Service</a>
        <a href="../privacy.php"><i class="fa fa-shield" aria-hidden="true"></i>Privacy Policy</a>
        <a href="mailto:team.react2021@gmail.com"><i class="fa fa-envelope" aria-hidden="true"></i>Contact Us</a>
        <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a>

      </div>

      <div class="content2">
        <div class="hotlines">
          <h2>Emergency Hotlines</h2>
          <hr style="margin-left:15%; margin-right:15%;">
          </hr>
          <p><b>Philippine Department of Health COVID-19</b></p>
          <a href="tel:(02)894-26843" style="color: blue;">02.894.COVID (02.894.26843)</a><span> or</span><br>
          <a href="tel:1555" style="color: blue;">1555 (PLDT, Smart, Sun, and TNT Subscribers)</a>
        </div>


        <div class="dev">
          <img src="../../assets/logo.png" class="logo">

          <div class="developers">
            <h3>DEVELOPED BY:</h3>
            <hr style="margin-left:15%; margin-right:15%;">
            </hr>

            <p><b>Al Evan Castillo</b></br>
              Project Manager<br><br>

              <b>Mark Denzel Ugaban</b></br>
              Front-end Developer<br><br>

              <b>Michael Eman Cordova</b></br>
              Quality Assurance<br><br>

              <b>Jenny Fernandez</b></br>
              System Designer
            </p>
          </div>
        </div>
      </div>


    </div>



    <div class="Footer">

      © 2021 REaCT. All right reserved

    </div>

    <script src="https://kit.fontawesome.com/a2501cd80b.js" crossorigin="anonymous"></script>

  </div>


</body>

</html>