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

function checkArrayNotEmpty($array) {
  return count(array_filter($array)) == count($array);
}

?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles.css" />
  </head>
  <body>
    <script src="script.js"></script>
    <script
      async
      src="https://platform.twitter.com/widgets.js"
      charset="utf-8"
    ></script>
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
          <input type="text" placeholder="Search.." />
          <button
            class="sharing-icon"
            title="This button does nothing"
          ></button>
          <form action=<?php if(isset($_SESSION["rememberme"]) and $_SESSION["rememberme"] != "") { echo "./AdminPage.php";
} else { echo "./LoginPage.php";} ?>>
            <button
              class="admin-icon"
              type="submit"
              value="./LoginPage.html"
              title="Go to the admin page"
            ></button>
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
              $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              $params = parse_url($url);
              if (array_key_exists("query", $params) == 1 and checkArrayNotEmpty($params)) {
                parse_str($params['query'], $param);
                $json = file_get_contents("Ressources/".$param['jsonFile']); 
              }
              else {
                $json = file_get_contents("Ressources/Ass2News.json");
              }
              $data = json_decode($json, true);
              $title = $data["news"][0]['title'];
              echo "<h4>$title</h4>";
            ?>
            <div class="nasaEventsDivScrollbar"></div>
            <div class="eventText">
            <?php
              echo $data["news"][0]["content"];
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
          $image = $data["news"][1]['imgurl'];
          echo "<img src='$image' />";
        ?>
        <div class="containerHiddenBoxes">
          <div class="toHideOnHover">
            <div class="toHideOnHoverChild">
              <div class="titleOver2">
                <a>
                <b>
                  <?php
                    echo $data["news"][1]["title"];
                  ?>
                  </b>
                </a>
              </div>
              <div class="textOver2">
                <a class="textDecoration">
                <b>
                  <?php
                    echo $data["news"][1]["previewContent"];
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
                    echo $data["news"][1]["content"];
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
              $image = $data["news"][2]['imgurl'];
              echo "<img src='$image' />";
            ?>
          </div>
          <div class="nasaStuff">
          <?php
              $title = $data["news"][2]['title'];
              echo "<h3>$title</h3>";
            ?>
            <?php
              echo $data["news"][2]["content"];
            ?>
          </div>
        </div>
      </div>
      <div class="grid-item item5">
        <iframe
          src="Ressources/video1.mp4"
          frameborder="0"
          allowfullscreen
        ></iframe>
      </div>
      <div class="grid-item item6"><img src="Ressources/pic6.jpg" /></div>
      <div class="grid-item item7">
        <a
          class="twitter-timeline"
          data-width="300"
          data-height="300"
          data-dnt="true"
          data-theme="dark"
          href="https://twitter.com/NASA?ref_src=twsrc%5Etfw"
          >Tweets by NASA</a
        >
      </div>
    </div>
  </body>
</html>
