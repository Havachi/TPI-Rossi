var userMenuShowed = false;

function toggleMenu() {
  var x = document.getElementById('menu');
  if (userMenuShowed == true) {
    x.style.display = "none";

    userMenuShowed = false;
  } else if (userMenuShowed == false) {
    x.style.display = "block";
    userMenuShowed = true;
  }
}
