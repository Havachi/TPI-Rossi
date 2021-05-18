var userMenuShowed = false;
window.onload = (function() {
  var x = document.getElementById('menu');
  x.style.height = 0;
  x.style.width = 0;
});

function toggleMenu() {
  var x = document.getElementById('menu');
  if (userMenuShowed == true) {
    x.style.height = 0;
    x.style.width = 0;
    userMenuShowed = false;
  } else if (userMenuShowed == false) {
    x.style.height = "100%";
    x.style.width = "100%";
    userMenuShowed = true;
  }
}
