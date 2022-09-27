<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" type="text/css" href="styleAdminPage.css" />
  </head>
  <body>
    <div class="inline">
      <div>
        <img src="images/nasa_logo.png" alt="logo" width="100" height="100" />
      </div>
      <div id="centerTitle">
        <h1>ADMIN PAGE</h1>
      </div>
      <div id="goback">
        <form action="./Exercise1.php">
          <button
            class="gobackButton"
            type="submit"
            value="/AdminPage.html"
            title="Disconnect"
          >
            Disconnect
          </button>
        </form>
      </div>
    </div>
    <div class="content">
      <div class="textFile">
        <h1>
          Choose text file
        </h1>
        <form name="myForm" method="POST" action="javascript:changeUrl()" onsubmit="return validationForm()">
          <input type="text" placeholder="Choose a text file" name="chooseTextFile">
          <input type="submit" value="Apply">
        </form>
        <script>
          function validationForm() {
            var x = document.forms["myForm"]["chooseTextFile"].value;
            const jsonFiles = ["Ass2News.json", "Ass2News2nd.json", "Ass2News3rd.json"];
            if (x == "" || !jsonFiles.includes(x)) {
              alert("The name of the file is incorrect !");
              return false;
            }
          }
          function changeUrl() {
            var x = document.forms["myForm"]["chooseTextFile"].value;
            window.location.href = "./Exercise1.php?jsonFile=" + x;
          }
        </script>
      </div>
      <h3>List of files availables</h3>
      <ul>
        <li>Ass2News.json</li>
        <li>Ass2News2nd.json</li>
        <li>Ass2News3rd.json</li>
      </ul>
    </div>
  </body>
</html>
