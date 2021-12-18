const nav = () => {
  const toggler = document.querySelector(".header__toggle-berger");
  const nav = document.querySelector(".header__nav");
  const navItem = document.querySelectorAll(".header__nav-list li");
  const overlay = document.getElementById("header-overlay");
  const search_modal = document.getElementById("search-modal");
  const btn_cs = document.getElementById("btn-cs");

  toggler.addEventListener("click", () => {
    nav.classList.toggle("header__nav--show");
    overlay.classList.toggle("header__overlay--show");
    toggler.classList.toggle("trans");

    navItem.forEach((link, index) => {
      if (link.style.animation) {
        link.style.animation = "";
      } else {
        link.style.animation = `nav-itemFade 0.3s ease forwards ${
          index / 5 + 0.2
        }s`;
      }
    });
  });
  overlay.addEventListener("click", () => {
    nav.classList.remove("header__nav--show");
    overlay.classList.remove("header__overlay--show");
    toggler.classList.remove("trans");
    navItem.forEach((link, index) => {
      link.style.animation = "";
    });
    search_modal.style.transform = "";
  });

  document.querySelectorAll(".btn-search").forEach((item) => {
    item.addEventListener("click", () => {
      search_modal.style.transform = "translateY(0%)";
      overlay.classList.toggle("header__overlay--show");
    });
  });
  btn_cs.addEventListener("click", () => {
    search_modal.style.transform = "";
    overlay.classList.remove("header__overlay--show");
  });
};
nav();
