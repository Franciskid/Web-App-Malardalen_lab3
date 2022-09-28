<!DOCTYPE html>
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$cookie_name = "user";
$cookie_value = get_current_user();

if (!isset($_SESSION['user'])) {
  $_SESSION["user"] = $cookie_value;
}
if (!isset($_SESSION['rememberme'])) {
  $_SESSION["rememberme"] = "";
}

function checkArrayNotEmpty($array)
{
  return count(array_filter($array)) == count($array);
}
?>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="styles.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
    function search() {
      var ajaxurl = 'ajax.php';
      var clickBtnValue = $("#search").val();
      data = {
        'action': "search",
        'search': $("#search").val()
      };
      $.post(ajaxurl, data, function(response) {
        alert(response);
      });
    };
  </script>
</head>

<body>
  <script src="script.js"></script>
  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  <div class="inline">
    <div>
      <img src="Ressources/nasa_logo.png" alt="logo" width="100" height="100" />
    </div>
    <div>
      <div class="inline-nav">
        <nav>
          <a href="#">Missions</a> | <a href="#">Galleries</a> |
          <a href="#">NASA TV</a> | <a href="#">Follow NASA</a> |
          <a href="#">Downloads</a> | <a href="#">About</a> |
          <a href="#">NASA Audiences</a>
        </nav>
        <search>
          <input type="text" placeholder="Search.." onchange="search()" id="search" />
          <div>

          </div>
        </search>
        <button class="sharing-icon" title="This button does nothing"></button>
        <form action=<?php if (isset($_SESSION["rememberme"]) and $_SESSION["rememberme"] != "") {
                        echo "./AdminPage.php";
                      } else {
                        echo "./LoginPage.php";
                      } ?>>
          <button class="admin-icon" type="submit" value="./LoginPage.html" title="Go to the admin page"></button>
        </form>
      </div>
      <div>
        <nav class="small-nav">
          <a>International Space Station</a> | <a>Journey to Mars</a> |
          <a>Earth</a> | <a>Technology</a> | <a>Aeronautics</a> |
          <a>Solar System and Beyond</a> | <a>Education</a> | <a>History</a> |
          <a>Benefits to You</a>
        </nav>
      </div>
    </div>
  </div>
  <div class="grid-container">
    <div class="grid-item item1" style="overflow: hidden">
      <img id="item1img" src="Ressources/pic4.jpg" />
      <div class="titleOver">
        <a><b id="item1title">Lift-off</b></a>
      </div>
      <div class="textOver">
        <a class="textDecoration">
          <b id="item1text">New lift-off yesterday</b>
        </a>
      </div>
    </div>
    <div class="grid-item item2">
      <div class="nasaEventsDiv">
        <div class="nasaEventDivText">
          <?php
          $db = new mysqli("localhost", "root", "root", "assignment3");
          if ($db->connect_error) {
            die("Could not connect: " . mysqli_connect_error());
          }

          $title = array();
          $content = array();
          $image = array();
          $news = $db->query("SELECT * FROM news ORDER BY date DESC LIMIT 3;");
          while ($row = $news->fetch_assoc()) {
            array_push($title, $row["title"]);
            array_push($content, $row["content"]);
            if (isset($row["image_path"])) {
              array_push($image, $row["image_path"]);
            } else {
              array_push($image, "Ressources/pic1.jpg");
            }
          }
          echo "<h4>$title[0]</h4>";
          ?>
          <div class="nasaEventsDivScrollbar"></div>
          <div class="eventText">
            <?php
            echo $content[0];
            ?>
          </div>
        </div>
        <div class="eventNasaDivBottom">
          <div class="nasaEventsDivBorderLine"></div>
          <div class="eventNasaDivBottomStretch">
            <span id="CalendarLink"> <a>Calendar</a> </span>
            <span id="LaunchesLink">
              <a>Launches and landings</a>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="grid-item item3">
      <?php
      echo "<img src='$image[0]' />";
      ?>
      <div class="containerHiddenBoxes">
        <div class="toHideOnHover">
          <div class="toHideOnHoverChild">
            <div class="titleOver2">
              <a>
                <b>
                  <?php
                  echo $title[1];
                  ?>
                </b>
              </a>
            </div>
            <div class="textOver2">
              <a class="textDecoration">
                <b>
                  <?php
                  echo substr($content[1], 0, 55) . "...";
                  ?>
                </b>
              </a>
            </div>
          </div>
        </div>
        <div class="toShowOnHover">
          <div class="textOver2">
            <a class="textDecoration">
              <b>
                <?php
                echo $content[1];
                ?>
              </b>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="grid-item item4" style="width: 100%">
      <div id="wrapper">
        <div id="first">
          <?php
          echo "<img src='$image[1]' />";
          ?>
        </div>
        <div class="nasaStuff">
          <?php
          echo "<h3>$title[2]</h3>";
          ?>
          <?php
          echo $content[2];
          ?>
        </div>
      </div>
    </div>
    <div class="grid-item item5">
      <iframe src="Ressources/video1.mp4" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="grid-item item6"><img src="Ressources/pic6.jpg" /></div>
    <div class="grid-item item7">
      <a class="twitter-timeline" data-width="300" data-height="300" data-dnt="true" data-theme="dark" href="https://twitter.com/NASA?ref_src=twsrc%5Etfw">Tweets by NASA</a>
    </div>
  </div>
</body>

</html>