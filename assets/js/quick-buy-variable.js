const normal_buy = document.getElementById("normal-buy");
const cart_variable =  document.getElementById("cart-variable");
const quick_buy =  document.getElementById("quick-buy");
const dialog = document.getElementById("single-product-dialog");

function showCartvariable() {
    cart_variable.style.display = "block";
    dialog.style.display = "block";
  }
  function hiddenCartvariable() {
    cart_variable.style.display = "none";
    dialog.style.display = "none";
  }
  
  dialog.addEventListener("click", ()=>{hiddenCartvariable()});
  
  
  normal_buy.addEventListener("click", () => {
    var variation_id = document.getElementById("variation-input").value;
    var current_link = window.location.href;
    if (variation_id != 0) {
      var redirect = current_link+"?add-to-cart=" + variation_id;
      window.location.href = redirect;
    } else {
      showCartvariable();
    }
  });
  
  quick_buy.addEventListener("click", () => {
    var variation_id = document.getElementById("variation-input").value;
    var checkout_link = document.getElementById("checkout-link").href;
  
    if (variation_id != 0) {
      var redirect = checkout_link + "?add-to-cart=" + variation_id;
      window.location.href = redirect;
    } else {
      showCartvariable();
    }
  });
  