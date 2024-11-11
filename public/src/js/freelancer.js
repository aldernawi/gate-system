// header
document.querySelector(".links-shower i").onclick = () => {
  document.querySelector(".links-holder").style.right = "0";
};

document.querySelector(".links-holder i").onclick = () => {
  document.querySelector(".links-holder").style.right = "-110%";
};

// fitlers
document
  .querySelector(".dropdown dt a")
  ?.addEventListener("click", function () {
    var ul = document.querySelector(".dropdown dd ul");
    if (ul.style.display === "none" || ul.style.display === "") {
      ul.style.display = "block";
    } else {
      ul.style.display = "none";
    }
  });

document.querySelectorAll(".dropdown dd ul li a").forEach(function (link) {
  link.addEventListener("click", function () {
    document.querySelector(".dropdown dd ul").style.display = "none";
  });
});

function getSelectedValue(id) {
  return $("#" + id)
    .find("dt a span.value")
    .html();
}

document.addEventListener("click", function (e) {
  var clicked = e.target;
  if (!clicked.closest(".dropdown")) {
    document.querySelectorAll(".dropdown dd ul").forEach(function (ul) {
      ul.style.display = "none";
    });
  }
});

document
  .querySelectorAll('.mutliSelect input[type="checkbox"]')
  .forEach(function (checkbox) {
    checkbox.addEventListener("click", function () {
      var title = this.value + ",";
      if (this.checked) {
        var html = '<span title="' + title + '">' + title + "</span>";
        document
          .querySelector(".multiSel")
          .insertAdjacentHTML("beforeend", html);
        document.querySelector(".hida").style.display = "none";
      } else {
        document
          .querySelectorAll('span[title="' + title + '"]')
          .forEach(function (span) {
            span.remove();
          });
        var ret = document.querySelector(".hida");
        document.querySelector(".dropdown dt a").appendChild(ret);
      }
    });
  });

// footer
const currentYear = new Date().getFullYear();
const yearSpan = document.querySelector(".year");
if (yearSpan) yearSpan.textContent = currentYear;
