// header
document.querySelector(".links-shower i").onclick = () => {
  document.querySelector(".links-holder").style.right = "0";
};

document.querySelector(".links-holder i").onclick = () => {
  document.querySelector(".links-holder").style.right = "-110%";
};

// footer
const currentYear = new Date().getFullYear();
const yearSpan = document.querySelector(".year");
if (yearSpan) yearSpan.textContent = currentYear;

// filter

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

// create task
const taskholder = document.querySelector(".create-task");
const taskBtn = document.querySelector(".create-task-btn");

if (taskholder && taskBtn) {
  const layout = document.querySelector(".layout");
  taskBtn.onclick = () => {
    taskholder.style.top = "50%";
    layout.style.top = "50%";
  };
  // add button
  // document.querySelector(".add").onclick = () => {
  //   holder.style.top = "-150%";
  //   layout.style.top = "-150%";
  // };
  document.querySelector(".cancel-task").onclick = () => {
    taskholder.style.top = "-150%";
    layout.style.top = "-150%";
  };
}

// create service
const serviceholder = document.querySelector(".create-service");
const serviceBtn = document.querySelector(".create-service-btn");

if (serviceholder && serviceBtn) {
  const layout = document.querySelector(".layout");
  serviceBtn.onclick = () => {
    serviceholder.style.top = "50%";
    layout.style.top = "50%";
  };
  // add button
  // document.querySelector(".add").onclick = () => {
  //   holder.style.top = "-150%";
  //   layout.style.top = "-150%";
  // };
  document.querySelector(".cancel-servic").onclick = () => {
    serviceholder.style.top = "-150%";
    layout.style.top = "-150%";
  };
}

// edit profile
const editholder = document.querySelector(".edit-header");
const editBtn = document.querySelector(".edit-btn");

if (editholder && editBtn) {
  const layout = document.querySelector(".layout");
  editBtn.onclick = () => {
    editholder.style.top = "50%";
    layout.style.top = "50%";
  };
  // add button
  // document.querySelector(".add").onclick = () => {
  //   holder.style.top = "-150%";
  //   layout.style.top = "-150%";
  // };
  document.querySelector(".cancel-edit").onclick = () => {
    editholder.style.top = "-150%";
    layout.style.top = "-150%";
  };
}

// edit card
const editCardholder = document.querySelector(".edit-card");
const editCardBtn = document.querySelectorAll(".edit-card-btn");

if (editCardholder && editCardBtn) {
  const layout = document.querySelector(".layout");
  editCardBtn.forEach((btn) => {
    btn.onclick = () => {
      editCardholder.style.top = "50%";
      layout.style.top = "50%";
    };
  });
  // add button
  // document.querySelector(".add").onclick = () => {
  //   holder.style.top = "-150%";
  //   layout.style.top = "-150%";
  // };
  const cancel = document.querySelector(".cancel-edit-card");
  if (cancel) cancel.onclick = () => {
    editCardholder.style.top = "-150%";
    layout.style.top = "-150%";
  };
}

// delete card
const deleteHolder = document.querySelector(".delete-card");
const deleteBtn = document.querySelectorAll(".delete-btn");
if (deleteHolder && deleteBtn) {
  const layout = document.querySelector(".layout");
  deleteBtn.forEach((btn) => {
    btn.onclick = () => {
      deleteHolder.style.top = "50%";
      layout.style.top = "50%";
    };
  });
  // add button
  // document.querySelector(".add").onclick = () => {
  //   holder.style.top = "-150%";
  //   layout.style.top = "-150%";
  // };
  document.querySelector(".cancel-delete-card").onclick = () => {
    deleteHolder.style.top = "-150%";
    layout.style.top = "-150%";
  };
}

// edit user
const dotsHolder = document.querySelector(".edit-user");
const dotsBtn = document.querySelectorAll(".dots-btn");
if (dotsHolder && dotsBtn) {
  const layout = document.querySelector(".layout");
  dotsBtn.forEach((btn) => {
    btn.onclick = () => {
      dotsHolder.style.top = "50%";
      layout.style.top = "50%";
    };
  });
  // add button
  // document.querySelector(".add").onclick = () => {
  //   holder.style.top = "-150%";
  //   layout.style.top = "-150%";
  // };
  document.querySelector(".cancel-dots-btn").onclick = () => {
    dotsHolder.style.top = "-150%";
    layout.style.top = "-150%";
  };
}

// create new user
const createHolder = document.querySelector(".create-user");
const createBtn = document.querySelectorAll(".create-new-user");
if (createHolder && createBtn) {
  const layout = document.querySelector(".layout");
  createBtn.forEach((btn) => {
    btn.onclick = () => {
      createHolder.style.top = "50%";
      layout.style.top = "50%";
    };
  });
  // add button
  // document.querySelector(".add").onclick = () => {
  //   holder.style.top = "-150%";
  //   layout.style.top = "-150%";
  // };
  document.querySelector(".cancel-create-user").onclick = () => {
    createHolder.style.top = "-150%";
    layout.style.top = "-150%";
  };
}
