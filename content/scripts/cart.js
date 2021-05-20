var cartShowed = true;
function toggleCart(){
  var x = document.getElementsByClassName('right-container');
  if (cartShowed == true) {
    x[0].classList.add("hidden");
    cartShowed = false;
  } else if (cartShowed == false) {
    x[0].classList.remove("hidden");
    cartShowed = true;
  }
}
