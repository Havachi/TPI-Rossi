var cartShowed = true;
function toggleCart(){
  var x = document.getElementsByClassName('right-container');
  var cart = document.getElementsByClassName('cart');
  var btn = document.getElementById("cart-toggler");

  if (cartShowed == true) {
    x[0].classList.add("widthChange","width-toggle");
    cart[0].classList.add("widthChange");
    btn.classList.add("cartwidthChange")
    cartShowed = false;

  } else if (cartShowed == false) {
    x[0].classList.remove("widthChange","width-toggle");
    cart[0].classList.remove("widthChange");
    btn.classList.remove("cartwidthChange")
    cartShowed = true;
  }
}
function showCart(){
  var x = document.getElementsByClassName('right-container');
  x[0].classList.add("width-toggle");
}
function hideCart(){
  var x = document.getElementsByClassName('right-container');
  x[0].classList.remove("width-toggle");
}
