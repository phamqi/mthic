var slideIndex = 1;
showSlides(slideIndex);
function plusSlides(n) {
  showSlides((slideIndex += n));
}
function currentSlide(n) {
  showSlides((slideIndex = n));
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("main__carousel-item");
  var dots = document.getElementsByClassName("main__carousel-dot");
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" dot--active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " dot--active";
}

document.getElementById("carousel-prev").addEventListener("click", () => {
  plusSlides(-1);
});
document.getElementById("carousel-next").addEventListener("click", () => {
  plusSlides(1);
});
var slideIndex = 0;
showSlidespers();
function showSlidespers() {
  var i;
  const slides = document.getElementsByClassName("main__carousel-item");
  var dots = document.getElementsByClassName("main__carousel-dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
    dots[i].classList.remove("dot--active");
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].classList.add("dot--active");
  setTimeout(showSlidespers, 5000);
}

function startup() {
  const slides = document.getElementById("main-carousel-list");
  slides.addEventListener("touchstart", touchstart, false);
  slides.addEventListener("touchend", touchend, false);
  slides.addEventListener("touchmove", touchmove , false);
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
  }
  if(starx-30 > movex ){
    plusSlides(1);
  }
}