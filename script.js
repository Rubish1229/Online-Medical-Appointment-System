const sliders = document.querySelectorAll(".doctor-slider");
const leftBtns = document.querySelectorAll(".left-btn");
const rightBtns = document.querySelectorAll(".right-btn");

sliders.forEach((slider, index) => {
  const leftBtn = leftBtns[index];
  const rightBtn = rightBtns[index];

  rightBtn.addEventListener("click", () => {
    slider.scrollBy({ left: 300, behavior: "smooth" });
  });

  leftBtn.addEventListener("click", () => {
    slider.scrollBy({ left: -300, behavior: "smooth" });
  });
});
