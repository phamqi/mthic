
const nav = () => {
    const  toggler = document.querySelector('.header__toggle-berger');
    const  nav = document.querySelector('.header__nav');
    const navItem = document.querySelectorAll('.header__nav-list li');
    const overlay = document.getElementById('header-overlay');
    const search_modal = document.getElementById('search-modal');
    const btn_cs = document.getElementById('btn-cs');

    toggler.addEventListener('click', ()=>{
        nav.classList.toggle('header__nav--show');
        overlay.classList.toggle('header__overlay--show');
        toggler.classList.toggle('trans');

        navItem.forEach((link, index) => {
            if(link.style.animation){
                link.style.animation ='';
            } else {
                link.style.animation = `nav-itemFade 0.3s ease forwards ${index / 5 + 0.2}s`;
            }
        });
      });
      overlay.addEventListener('click', ()=>{
      nav.classList.remove('header__nav--show');
      overlay.classList.remove('header__overlay--show');
      toggler.classList.remove('trans');
      navItem.forEach((link, index) => {
        link.style.animation = '';
      });
      search_modal.style.transform = ''
    });
    
    document.querySelectorAll('.btn-search').forEach(item => {
      item.addEventListener('click', () => {
        search_modal.style.transform = 'translateY(0%)'
        overlay.classList.toggle('header__overlay--show');
      });
    });
    btn_cs.addEventListener('click', ()=>{
      search_modal.style.transform = ''
      overlay.classList.remove('header__overlay--show');
  })
}
nav();

var slideIndex = 1;
showSlides(slideIndex);
function plusSlides(n) {
  showSlides(slideIndex += n);
}
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("main__carousel-item");
  var dots = document.getElementsByClassName("main__carousel-dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" dot--active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " dot--active";
}
 
document.getElementById("carousel-prev").addEventListener('click', ()=>{
    plusSlides(-1);
  });
document.getElementById("carousel-next").addEventListener('click', ()=>{
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
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].classList.add("dot--active")
  setTimeout(showSlidespers, 5000); 
}

// document.addEventListener("DOMContentLoaded", function() {
//   let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
//   let active = false;

//   const lazyLoad = function() {
//     if (active === false) {
//       active = true;

//       setTimeout(function() {
//         lazyImages.forEach(function(lazyImage) {
//           if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
//             lazyImage.src = lazyImage.dataset.src;
//             lazyImage.srcset = lazyImage.dataset.srcset;
//             lazyImage.classList.remove("lazy");

//             lazyImages = lazyImages.filter(function(image) {
//               return image !== lazyImage;
//             });

//             if (lazyImages.length === 0) {
//               document.removeEventListener("scroll", lazyLoad);
//               window.removeEventListener("resize", lazyLoad);
//               window.removeEventListener("orientationchange", lazyLoad);
//             }
//           }
//         });

//         active = false;
//       }, 200);
//     }
//   };

//   lazyLoad();
  
//   document.addEventListener("scroll", lazyLoad);
//   window.addEventListener("resize", lazyLoad);
//   window.addEventListener("orientationchange", lazyLoad);
// });

