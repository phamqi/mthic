var slideIndex = 1;
var indicator = 0;
var i;

const img_single_product = document.getElementById("img_single_product");
const el_indicator = document.getElementById("indicator");
const review_tag = document.getElementById("review-count");
const average_rate = document.getElementById("average-rate");
const star_1 = document.getElementsByClassName("star-1");
const star_2 = document.getElementsByClassName("star-2");
const star_3 = document.getElementsByClassName("star-3");
const star_4 = document.getElementsByClassName("star-4");
const star_5 = document.getElementsByClassName("star-5");
var slides = document.getElementsByClassName("abc");

showSlides(slideIndex);
function plusSlides(n) {
  showSlides((slideIndex += n));
  indicator +1;
  el_indicator.innerHTML = indicator;
  
}
function showSlides(n) {
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[slideIndex - 1].style.display = "block";
}

document.getElementById("modal-prev").addEventListener("click", () => {
  plusSlides(-1);
  myprevFunction();
});
document.getElementById("modal-next").addEventListener("click", () => {
  plusSlides(1);
  myFunction();
});
myFunction();
function myFunction() {
  if(indicator < slides.length ){
    indicator ++;
  }else if ( indicator == slides.length){
    indicator = 1;
  }
  el_indicator.innerHTML = indicator + '/' + slides.length;
}
function myprevFunction() {
  if( indicator >= 2){
    indicator --;
  } else if (indicator == 1){
    indicator = slides.length;
  } else {
    indicator --;
  }
  el_indicator.innerHTML = indicator + '/' + slides.length;
}
function currentSlide(n) {
  showSlides((slideIndex = n));
  el_indicator.innerHTML = n+ '/' + slides.length;
}


function startup() {
  img_single_product.addEventListener("touchstart", touchstart, false);
  img_single_product.addEventListener("touchmove", touchmove, false);
  img_single_product.addEventListener("touchend", touchend, false);
}
document.addEventListener("DOMContentLoaded", startup);
var starx, movex;
function touchstart(evt) {
  starx = evt.touches[0].clientX;
}
function touchmove(evt) {
  movex = evt.touches[0].clientX;
}
function touchend() {
  if(starx+30 < movex ){
    plusSlides(-1);
    myprevFunction();
  }
  if(starx-30 > movex ){
    plusSlides(1);
    myFunction();
  }
}

average_rate.addEventListener("click", ()=>{
  scrolltoView();
});
review_tag.addEventListener("click", ()=>{
  scrolltoView();
});

function scrolltoView() {
  var elmnt = document.getElementById("tab-title-reviews");
  elmnt.scrollIntoView();
}
