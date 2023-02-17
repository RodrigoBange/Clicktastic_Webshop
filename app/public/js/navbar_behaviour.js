// Method for creating a mobile and desktop responsive and friendly navigation bar.
function responsive() {
    var x = document.getElementById("navbar");
    if (x.className == "topNavbar") {
        // Add the responsive class
        x.className += " responsive";
    } else {
        x.className = "topNavbar";
    }
}
