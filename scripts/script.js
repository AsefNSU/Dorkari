console.log("Script loaded");

let currentSlide = 0;
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.display = "none";
        dots[i].classList.remove("active");
    });

    slides[index].style.display = "block";
    dots[index].classList.add("active");
}

function changeSlide(step) {
    currentSlide += step;
    if (currentSlide >= slides.length) {
        currentSlide = 0;
    } else if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    }
    showSlide(currentSlide);
}

function goToSlide(index) {
    currentSlide = index;
    showSlide(currentSlide);
}

setInterval(() => {
    changeSlide(1);
}, 3000); // Auto-slide every 3 seconds

// Show first slide initially
showSlide(currentSlide);
