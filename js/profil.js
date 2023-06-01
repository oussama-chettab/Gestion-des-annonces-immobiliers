/* Script pour ouvrir/fermer le menu */
const menuBtn = document.querySelector(".menu-btn");
const nav = document.querySelector("nav");
const main = document.querySelector("main");
let menuOpen = false;

menuBtn.addEventListener("click", () => {
  if (!menuOpen) {
    menuBtn.classList.add("open");
    nav.classList.add("open");
    main.classList.add("open");
    menuOpen = true;
  } else {
    menuBtn.classList.remove("open");
    nav.classList.remove("open");
    main.classList.remove("open");
    menuOpen = false;
  }
});
///////////////////////////

const images = document.querySelectorAll('.valide img');
let currentIndex = 0;

function showImage(index) {
  // Remove the 'active' class from all images
  images.forEach(img => {
    img.classList.remove('active');
  });
  // Add the 'active' class to the current image
  images[index].classList.add('active');
}

// Start the slideshow
setInterval(() => {
  // Increment the current index and wrap around if necessary
  currentIndex = (currentIndex + 1) % images.length;
  showImage(currentIndex);
}, 5000);
