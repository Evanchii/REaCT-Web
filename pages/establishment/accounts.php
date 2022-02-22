<?php
include '../../functions/checkSession.php';

$uid = $_SESSION["uid"];
$infoRef = $database->getReference("Users/" . $uid . "/info");
$userHisRef = $database->getReference('Users/' . $uid . '/history');
$historyRef = $database->getReference('History');

if (!isset($_SESSION['name'])) {
  $_SESSION["name"] = $infoRef->getChild("name")->getValue();
  $_SESSION["branch"] = $infoRef->getChild("branch")->getValue();
}

$extension = "_" . str_replace(' ', '-', $_SESSION['name']);


// Firebase Storage
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
  <link rel="stylesheet" type="text/css" href="../../styles/history.css">
  <link rel="shortcut icon" href="../../assets/favicon.ico" type="image/x-icon">
  <title>Accounts | REaCT</title>
  <style>
    .button {
      background: #0C59CF;
      padding: 1% 2%;
      margin-bottom: 1%;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      box-shadow: rgba(100, 100, 111, 0.4) 0px 7px 29px 0px;
      transition: ease-in-out 0.3s;
      cursor: pointer;
    }

    .button:hover {
      box-shadow: rgb(100, 100, 111, 0.6) 0px 0px 4px 2px;
    }

    table {
      display: inline-table;
    }

    .right {
      display: block;
      float: right;
    }

    td>button {
      background: none;
      border: none;
      margin: 2%;
      padding: 2%;
      cursor: pointer;
    }

    tr>td:last-child {
      text-align: center;
    }

    td .fa {
      font-size: 1.8em;
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
        <!-- PHP Get from RTDB -->
        <h2><?php echo $_SESSION['name']; ?></h2>
        <h3><?php echo $_SESSION['branch']; ?></h3>
      </div>
      <hr class="divider">
      <a href="dashboard.php"><i class="fa fa-th-large" aria-hidden="true"></i>Dashboard</a>
      <a href="cases.php"><i class="fa fa-line-chart" aria-hidden="true"></i>Covid Cases</a>
      <a href="status.php"><i class="fa fa-heartbeat" aria-hidden="true"></i>Status</a>
      <a href="history.php"><i class="fa fa-lightbulb-o" aria-hidden="true"></i>Visitor History</a>
      <a href="#" class="active"><i class="fa fa-users" aria-hidden="true"></i>Accounts</a>
      <div class="settings">
        <a href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i>Setttings</a>
      </div>
    </div>
    <div class="Header">
      <div class="dashboard-date">
        <h2>Accounts</h2>
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
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Success</p>
                </div>
              </li>
              <li class="baskin_robbins failed">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Failed</p>
                </div>
              </li>
              <li class="mcd success">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Success</p>
                </div>
              </li>
              <li class="pizzahut failed">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Failed</p>
                </div>
              </li>
              <li class="kfc success">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Success</p>
                </div>
              </li>
              <li class="show_all">
                <p class="link">Show All Activities</p>
              </li>
            </ul>
          </div>
        </div>

        <div class="dashboard-notif">
          <span class="dropdown"><i class="fa fa-user-circle dropbtn" aria-hidden="true"></i>My Account
            <div class="dropdown-content">
              <a href="profile.php"><i class="fa fa-user-circle" aria-hidden="true"></i>Profile</a>
              <a href="../logout.php"><i class="fas fa-sign-out" aria-hidden="true"></i>Log out</a>
            </div>
          </span>
        </div>
      </div>
    </div>
    <div class="Content">
      <div>
        <button type="button" class="button right" id="btn-account">Add Account</button>
        <div id="data">
          <table>
            <tr>
              <th>Username</th>
              <th>UID</th>
              <th>Action</th>
            </tr>
            <tr>
              <td colspan="3">
                <h2 style="text-align: center;">Loading Data...</h2>
              </td>
            <tr>
          </table>
          <div class="pagination">
            <a href="#" class="disabled-link">&laquo;</a>
            <a href="#" class="disabled-link active">1</a>
            <a href="#" class="disabled-link">&raquo;</a>
          </div>
        </div>
        <!-- <tr>
            <td>Unit-01</td>
            <td>96a52e07-3648-4076-a136-b0760abc1d37</td>
            <td>
                <button>
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
                <button>
                <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </td>
          </tr>
        </table>
          <div class="pagination">
                <a href="#" class="disabled-link">&laquo;</a>
                <a href="#" class="disabled-link active">1</a>
                <a href="#" class="disabled-link">&raquo;</a>
            </div> -->
        <!-- <php
          if ($userHisRef->getSnapshot()->hasChildren()) {
            // var_dump($userHisRef->getValue());
            $history = $userHisRef->getValue();
            foreach ($history as $date => $keySet) {
              foreach ($keySet as $key => $timestamp) {
                echo '<tr>
                      <td>' . $date . '</td>
                      <td>' . $historyRef->getChild($date . '/' . $timestamp . '/time')->getValue() . '</td>
                      <td>' . $historyRef->getChild($date . '/' . $timestamp . '/name')->getValue() . '</td>
                      <td>' . $historyRef->getChild($date . '/' . $timestamp . '/backend')->getValue() . '</td>
                      </tr>';
              }
            }
            echo "</table>";
            echo '
              <div class="pagination">
                <a href="#" class="disabled-link">&laquo;</a>
                <a href="#" class="disabled-link active">1</a>
                <a href="#" class="disabled-link">&raquo;</a>
            </div>
            ';
          } else {
            echo '<tr><td colspan="4"><h2 style="text-align: center;">No data found!</h2></td><tr>';
            echo "</table>";
            echo '
              <div class="pagination">
                <a href="#" class="disabled-link">&laquo;</a>
                <a href="#" class="disabled-link active">1</a>
                <a href="#" class="disabled-link">&raquo;</a>
            </div>
            ';
          }
          ?> -->
      </div>
    </div>



    <div class="Footer">

      © 2021 REaCT. All right reserved

    </div>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <div class="modal" id="create-account">
      <h1>Create Sub-account</h1>
      <hr><br>
      <form id="frm-account">
        <label for="username">Username:</label>
        <input type="text" class="username" name="username" placeholder="example" id="username" required />
        <input type="text" name="extension" size="1" value="<?php echo $extension; ?>" style="width: <?php echo strlen($extension) + 5 ?>ch" readonly>
        <!-- <input type="text" name="extension" id="extension" value="_<?php echo $_SESSION["name"]; ?>" readonly /> -->
        <br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" placeholder="••••••" required>
        <input type="hidden" name="create">
      </form>
      <button class="button right" id="btn-create">Create</button>
    </div>

    <script>
      loadPage(1);

      $("#btn-account").click(function() {
        $('#create-account').modal('show');
      });

      $("#btn-create").click(function() {
        var frm = $("#frm-account");

        $.ajax({
          type: "POST",
          url: "data/account-handler.php",
          data: frm.serialize(),
          success: function(data) {
            alert("Account created.");
            loadPage(1);
          },
          error: function(data) {
            alert("An error occured.");
          },
        });
      });

      function loadPage(page) {
        $.ajax({
          url: "data/account-controller.php",
          type: "POST",
          data: {
            "page": page
          }
        }).done(function(data) {
          $("#data").html(data);
        });
      }

      function deleteUser(uid, username) {
        if (confirm('Do you wish to delete ' + username + '?')) {
          $.ajax({
            type: "POST",
            url: "data/account-handler.php",
            data: {
              'delete': '',
              'uid': uid,
              'username': username
            }
          }).done(function() {
            loadPage(1);
          });
        }
      }
    </script>


  </div>

  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/a2501cd80b.js" crossorigin="anonymous"></script>

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <!-- jQuery Modal -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

</body>

</html>