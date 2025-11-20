// ===== SLIDER CHÍNH (có nút bấm + tự động) =====
(function mainSlider() {
  const slides = document.querySelectorAll('.slider .slide');
  const prevBtn = document.querySelector('.slider .prev');
  const nextBtn = document.querySelector('.slider .next');
  let index = 0;
  let timer;

  function showSlide(i) {
    slides.forEach(slide => slide.classList.remove('active'));
    slides[i].classList.add('active');
  }

  function nextSlide() {
    index = (index + 1) % slides.length;
    showSlide(index);
  }

  function prevSlide() {
    index = (index - 1 + slides.length) % slides.length;
    showSlide(index);
  }

  function startAutoSlide() {
    timer = setInterval(nextSlide, 3000);
  }

  function resetTimer() {
    clearInterval(timer);
    startAutoSlide();
  }

  // Nút bấm
  nextBtn.addEventListener('click', () => {
    nextSlide();
    resetTimer();
  });

  prevBtn.addEventListener('click', () => {
    prevSlide();
    resetTimer();
  });

  // Bắt đầu chạy
  startAutoSlide();
})();

// ===== SLIDER_1 (tự động, không nút, fade) =====
(function slider1Auto() {
  const allSliders = document.querySelectorAll('.slider_1');

  allSliders.forEach(sliderBlock => {
    const slides = sliderBlock.querySelectorAll('.slide_1');
    let index = 0;

    function showSlide(i) {
      slides.forEach(slide => slide.classList.remove('active'));
      slides[i].classList.add('active');
    }

    setInterval(() => {
      index = (index + 1) % slides.length;
      showSlide(index);
    }, 3000);
  });
})();

document.addEventListener("DOMContentLoaded", function () {
  const btn = document.getElementById("adminMenuBtn");
  const dropdown = document.getElementById("adminMenuDropdown");

  if (btn && dropdown) {
    btn.addEventListener("click", function () {
      dropdown.classList.toggle("show");
    });

    document.addEventListener("click", function (e) {
      if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.remove("show");
      }
    });
  }
});