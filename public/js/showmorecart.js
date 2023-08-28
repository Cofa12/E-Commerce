function myFunction() {
    var manDiv = document.getElementById("man_div");
    var ContainerDiv = document.getElementById("man_div_container");
    var btnText = document.getElementById("myBtn");

    if (manDiv.style.height === "382px") {
        manDiv.style.height = "960px";
      btnText.innerHTML = "Show Less";
    } else {
      manDiv.style.height = "382px";
      btnText.innerHTML = "Show More";
    }
  }
