<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Slider Klien dengan Dots & Panah</title>
<style>
  body {
    font-family: sans-serif;
  }

  .slider-container {
    overflow: hidden;
    max-width: 1000px;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    position: relative;
  }

  .slider-track {
    display: flex;
    transition: transform 0.5s ease-in-out;
  }

  .slide {
    flex: 0 0 auto;
    width: 200px;
    padding: 10px;
    box-sizing: border-box;
  }

  .slide img {
    width: 100%;
    display: block;
  }

  /* Dots navigation */
  .dots {
    text-align: center;
    margin-top: 15px;
  }

  .dot {
    display: inline-block;
    width: 12px;
    height: 12px;
    margin: 5px;
    background-color: #bbb;
    border-radius: 50%;
    cursor: pointer;
  }

  .dot.active {
    background-color: #333;
  }

  /* Panah kiri & kanan */
  .arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.5);
    color: #fff;
    width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    font-size: 20px;
    border-radius: 50%;
    cursor: pointer;
    user-select: none;
    z-index: 10;
  }

  .arrow-left {
    left: 10px;
  }

  .arrow-right {
    right: 10px;
  }
</style>
</head>
<body>

<div class="slider-container">
  <div class="arrow arrow-left">&#10094;</div>
  <div class="arrow arrow-right">&#10095;</div>

  <div class="slider-track">
    <!-- Contoh slide 21 logo -->
    <div class="slide"><img src="assets/image/clients/1.png" alt="Klien 1"></div>
    <div class="slide"><img src="assets/image/clients/2.jpg" alt="Klien 2"></div>
    <div class="slide"><img src="assets/image/clients/3.png" alt="Klien 3"></div>
    <div class="slide"><img src="assets/image/clients/4.png" alt="Klien 4"></div>
    <div class="slide"><img src="assets/image/clients/5.png" alt="Klien 5"></div>
    <div class="slide"><img src="assets/image/clients/7.png" alt="Klien 7"></div>
    <div class="slide"><img src="assets/image/clients/8.png" alt="Klien 8"></div>
    <div class="slide"><img src="assets/image/clients/9.jpg" alt="Klien 9"></div>
    <div class="slide"><img src="assets/image/clients/10.png" alt="Klien 10"></div>
    <div class="slide"><img src="assets/image/clients/11.png" alt="Klien 11"></div>
    <div class="slide"><img src="assets/image/clients/12.png" alt="Klien 12"></div>
    <div class="slide"><img src="assets/image/clients/13.png" alt="Klien 13"></div>
    <div class="slide"><img src="assets/image/clients/14.jpg" alt="Klien 14"></div>
      <div class="slide"><img src="assets/image/clients/17.png" alt="Klien 17"></div>
    <div class="slide"><img src="assets/image/clients/18.png" alt="Klien 18"></div>
    <div class="slide"><img src="assets/image/clients/19.png" alt="Klien 19"></div>
    <div class="slide"><img src="assets/image/clients/20.png" alt="Klien 20"></div>
    <div class="slide"><img src="assets/image/clients/21.png" alt="Klien 21"></div>
  </div>
</div>

<div class="dots">
  <span class="dot active"></span>
  <span class="dot"></span>
  <span class="dot"></span>
</div>

<script>
const track = document.querySelector('.slider-track');
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
const leftArrow = document.querySelector('.arrow-left');
const rightArrow = document.querySelector('.arrow-right');

let index = 0;
const slidesPerView = 3; // jumlah logo terlihat
const totalSlides = slides.length;

// Fungsi update slider
function showSlide(i) {
  const slideWidth = slides[0].offsetWidth;
  track.style.transform = `translateX(${-i * slideWidth}px)`;
  dots.forEach(dot => dot.classList.remove('active'));
  dots[Math.min(i, dots.length-1)].classList.add('active');
}

// Auto scroll
function nextSlide() {
  index = (index + 1) % (totalSlides - slidesPerView + 1);
  showSlide(index);
}
let interval = setInterval(nextSlide, 3000);

// Klik dot
dots.forEach((dot, i) => {
  dot.addEventListener('click', () => {
    index = i;
    showSlide(index);
    clearInterval(interval);
    interval = setInterval(nextSlide, 3000);
  });
});

// Klik panah
rightArrow.addEventListener('click', () => {
  index = (index + 1) % (totalSlides - slidesPerView + 1);
  showSlide(index);
  clearInterval(interval);
  interval = setInterval(nextSlide, 3000);
});

leftArrow.addEventListener('click', () => {
  index = (index - 1 + (totalSlides - slidesPerView + 1)) % (totalSlides - slidesPerView + 1);
  showSlide(index);
  clearInterval(interval);
  interval = setInterval(nextSlide, 3000);
});
</script>

</body>
</html>
