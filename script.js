var images = ["Ressources/pic4.jpg", "Ressources/pic3.jpg", "Ressources/pic2.jpg"];
var i = 0;

setInterval(function() {
    var img = document.getElementById("item1img");
    if ((i == images.length) || (i == 0)) {
        i = 0;
        document.getElementById("item1title").innerText = "Lift-off";
        document.getElementById("item1text").innerText = "New lift-off yesterday";
    }
    else if (i == 1) {
        document.getElementById("item1title").innerText = "Discovery";
        document.getElementById("item1text").innerText = "New discovery yesterday";
    }
    else {
        document.getElementById("item1title").innerText = "Space";
        document.getElementById("item1text").innerText = "New space yesterday";
    }
    img.src = images[i];
    i++;
}, 20000);