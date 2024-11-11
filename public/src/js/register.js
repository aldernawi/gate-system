document.querySelector(".register-box:not(.open)").onclick = () => {
  document.querySelector(".register-box:not(.open)")?.classList.add("open");
};

document.querySelector(".register-box .close").onclick = (e) => {
  e.stopPropagation();
  document.querySelector(".register-box")?.classList.remove("open");
};
