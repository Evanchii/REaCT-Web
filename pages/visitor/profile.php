<?php
include '../../functions/checkSession.php';
$auth = $firebase->createAuth();

$uid = $_SESSION["uid"];

$infoRef = $database->getReference("Users/" . $uid . "/info");
$linkRef = $database->getReference("appData/links/");

if (!isset($_SESSION['fName'])) {
  $_SESSION["lName"] = $infoRef->getChild("lName")->getValue();
  $_SESSION["fName"] = $infoRef->getChild("fName")->getValue();
  $_SESSION["mName"] = $infoRef->getChild("mName")->getValue();
}

if (isset($_POST['submit'])) {
  $photo = $_POST['updateFace'];
  $cno = $_POST['contact-num'];
  $dob = $_POST['birthday'];
  $addNo = $_POST['house-num'];
  $addBa = $_POST['barangay'];
  $addCi = $_POST['city'];
  $addPro = $_POST['province'];
  $addCo = $_POST['country'];
  $addZip = $_POST['zip-code'];

  if ($photo != '') {
    $folderPath = "Face/";

    $image_parts = explode(";base64,", $photo);
    // $image_type_aux = explode("image/", $image_parts[0]);
    // $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);
    $fileName = $uid . '.png'; //INSERT UID HERE

    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);

    include '../../functions/enrollFace.php';
    enrollFace($photo, $uid);
    // print_r($fileName);

    $storage = $firebase->createStorage();
    $storageClient = $storage->getStorageClient();
    $defaultBucket = $storage->getBucket();

    $imageReference = $defaultBucket->object($infoRef->getChild("faceID")->getValue());
    if ($imageReference->exists()) {
      $imageReference->delete();
    }

    $defaultBucket->upload(
      file_get_contents($file),
      [
        'name' => $file
      ]
    );

    unlink($file);
  }

  $updates = [
    "cNo" => $cno,
    "DoB" => $dob,
    "addNo" => $addNo,
    "addBa" => $addBa,
    "addCi" => $addCi,
    "addPro" => $addPro,
    "addCo" => $addCo,
    "addZip" => $addZip,
  ];
  if (isset($fileName) && $fileName != '') {
    $updates["faceID"] = $folderPath . $fileName;
  }


  $infoRef // this is the root reference
    ->update($updates);
} else {
  $cno = $infoRef->getChild("cNo")->getValue();
  $dob = $infoRef->getChild("DoB")->getValue();
  $addNo = $infoRef->getChild("addNo")->getValue();
  $addBa = $infoRef->getChild("addBa")->getValue();
  $addCi = $infoRef->getChild("addCi")->getValue();
  $addPro = $infoRef->getChild("addPro")->getValue();
  $addCo = $infoRef->getChild("addCo")->getValue();
  $addZip = $infoRef->getChild("addZip")->getValue();
}


// Firebase Storage
$storage = $firebase->createStorage();
$storageClient = $storage->getStorageClient();
$defaultBucket = $storage->getBucket();


$expiresAt = new DateTime('tomorrow', new DateTimeZone('Asia/Manila'));
// echo $expiresAt->getTimestamp();

$imageReference = $defaultBucket->object($infoRef->getChild("faceID")->getValue());
if ($imageReference->exists()) {
  $image = $imageReference->signedUrl($expiresAt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  <link rel="stylesheet" type="text/css" href="../../styles/private-common.css">
  <link rel="stylesheet" type="text/css" href="../../styles/profile.css">
  <link rel="shortcut icon" href="../../assets/favicon.ico" type="image/x-icon">
  <title>Profile | REaCT</title>
  <style>
    #change-pw {
      max-width: 500px !important;
    }

    #change-pw input {
      padding: unset;
      margin: unset;
      width: 60%;
      margin-right: unset;
    }
  </style>
</head>

<body>
  <div class="grid">
    <div class="Navigation">
      <!-- <h2>REaCT</h2> -->
      <img class="text-logo" src="../../assets/text-logo.png" alt="REaCT ">
      <hr class="divider">
      <div class="user-profile">
        <!-- PHP Get from Storage -->
        <img src="<?php echo $image; ?>">
        <!-- PHP Get from RTDB -->
        <span>
          <?php echo $_SESSION['lName'] . ', ' . $_SESSION['fName'] . ' ' . $_SESSION['mName'] ?>
        </span>
      </div>
      <hr class="divider">
      <a href="dashboard.php"><i class="fa fa-th-large" aria-hidden="true"></i>Dashboard</a>
      <a href="cases.php"><i class="fa fa-line-chart" aria-hidden="true"></i>Covid Cases</a>
      <a href="health.php"><i class="fa fa-heartbeat" aria-hidden="true"></i>Health Status</a>
      <a href="history.php"><i class="fa fa-lightbulb-o" aria-hidden="true"></i>Location History</a>
      <div class="settings">
        <a href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i>Setttings</a>
      </div>
    </div>
    <div class="Header">
      <div class="dashboard-date">
        <h2>Profile</h2>
      </div>
      <div class="header-right">
        <div class="notifications">
          <div class="icon_wrap"><i class="far fa-bell"></i></div>
          <div class="notification_dd">
            <ul class="notification_ul">
              <li class="starbucks success">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Loading Data...
                  </div>
                  <div class="sub_title">
                    Please Wait
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <div class="dashboard-notif">
          <span class="dropdown"><i class="fa fa-user-circle dropbtn" aria-hidden="true"></i>My Account
            <div class="dropdown-content">
              <a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i>Profile</a>
              <a onclick="$('#change-pw').modal('show');"><i class="fa-solid fa-key" aria-hidden="true"></i>Change Password</a>
              <a href="../logout.php"><i class="fas fa-sign-out" aria-hidden="true"></i>Log out</a>
            </div>
          </span>
        </div>
      </div>
    </div>
    <div class="Content">

      <div class="profile">
        <h3>Update Facial Information</h3><br>
        <a href="#modalFace" onclick="initCamera();" rel="modal:open" id="retry-button">
          <img src="../../assets/ic_upload.png" id="imgFace" alt="Avatar" class="avatar">
        </a>
        <canvas id="canvas" style="display:none;"></canvas><br>

        <h1>
          <span>
            <?php echo $_SESSION['lName'] . ', ' . $_SESSION['fName'] . ' ' . $_SESSION['mName'] ?>
          </span>
        </h1>
        <hr>
        </hr>
        <span><?php echo $auth->getUser($uid)->__get('email'); ?></span>
      </div>

      <div class="profile-data">

        <h2>Profile Data</h2>

        <form action="profile.php" method="POST">

          <input type="hidden" name="updateFace" id="updateFace">
          <table>
            <tr>
              <th>First Name:</th>
              <td><input type="text" name="fname" value="<?php echo $_SESSION['fName']; ?>" id="fname" disabled /></td>
            </tr>

            <tr>
              <th>Middle Name:</th>
              <td><input type="text" name="mname" value="<?php echo $_SESSION['mName']; ?>" id="mname" disabled /></td>
            </tr>

            <tr>
              <th>Last Name:</th>
              <td><input type="text" name="lname" value="<?php echo $_SESSION['lName']; ?>" id="lname" disabled /></td>
            </tr>

            <tr>
              <th>Contact Number:</th>
              <td><input type="tel" name="contact-num" value="<?php echo $cno; ?>" id="contact-num" /></td>
            </tr>

            <tr>
              <th>Date of Birth:</th>
              <td><input type="date" value="<?php echo $dob; ?>" name="birthday" id="birthday"></td>
            </tr>
          </table>
          <h1 style="text-align: center;">CURRENT ADDRESS</h1>
          <table>
            <tr>
              <th>House Number &<br>Street Address:</th>
              <td><input type="text" name="house-num" value="<?php echo $addNo; ?>" id="house-num" /></td>
            </tr>

            <tr>
              <th>Barangay:</th>
              <td><input type="text" name="barangay" value="<?php echo $addBa; ?>" id="barangay" /></td>
            </tr>

            <tr>
              <th>City/Municipality:</th>
              <td><input type="text" name="city" value="<?php echo $addCi; ?>" id="city" /></td>
            </tr>

            <tr>
              <th>Province:</th>
              <td><input type="text" name="province" value="<?php echo $addPro; ?>" id="province" /></td>
            </tr>

            <tr>
              <th>Country:</th>
              <td><input type="text" name="country" value="<?php echo $addCo; ?>" id="country" /></td>
            </tr>

            <tr>
              <th>Zip Code:</th>
              <td><input type="number" name="zip-code" value="<?php echo $addZip; ?>" id="zip-code" /></td>
            </tr>

          </table>

          <input class="update-button" type="submit" value="Update" name="submit"><a></a>

        </form>

      </div>



    </div>



    <div class="Footer">

      © 2021 REaCT. All right reserved

    </div>

  </div>

  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/a2501cd80b.js" crossorigin="anonymous"></script>

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <!-- jQuery Modal -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <!-- Common Scripts -->
  <script src="../../scripts/common.js"></script>

  <div id="modalFace" class="modal">
    <div class="modal-title">
      <h3>Update Face</h3>
    </div>
    <div class="faceVideo" id="faceVideo">
      <div class="modal-body">
        <video autoplay="true" poster="../../assets/loading.gif" id="videoElement" class="faceid"></video><br>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="camButt btn-primary" id="screenshot-button"><i class="fa-solid fa-camera"></i> Take photo</button>
    </div>
  </div>

  <script>
    function initCamera() {
      var video = document.querySelector("#videoElement");
      const screenshotButton = document.querySelector("#screenshot-button");
      const retryButton = document.querySelector("#retry-button");
      const img = document.querySelector("#imgFace");
      const canvas = document.querySelector("#canvas");
      const faceInput = document.querySelector("#updateFace");

      if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({
            video: true
          })
          .then(function(stream) {
            mediaStream = stream.getTracks();
            video.srcObject = stream;

            screenshotButton.onclick = video.onclick = function() {
              canvas.width = video.videoWidth;
              canvas.height = video.videoHeight;
              canvas.getContext("2d").drawImage(video, 0, 0);
              // Other browsers will fall back to image/png
              img.src = canvas.toDataURL("image/webp");
              faceInput.value = canvas.toDataURL("image/webp");

              mediaStream.forEach(track => track.stop());
              $("#modalFace .close-modal").click()
            };

            retryButton.onclick = function() {
              faceInput.value = "";

              initCamera();
            }

          })
          .catch(function(err0r) {
            console.log("Something went wrong!");
          });
      }
    }
  </script>

  <div id="common-modal">
    <?php include '../change.php'; ?>
  </div>

</body>

</html>