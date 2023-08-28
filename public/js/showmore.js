function myFunction() {
    var manDiv = document.getElementById("man_div");
    var ContainerDiv = document.getElementById("man_div_container");
    var btnText = document.getElementById("myBtn");

    if (manDiv.style.height === "462px") {
        manDiv.style.height = "950px";
      btnText.innerHTML = "Show Less";
      ContainerDiv.style.height = "1400px";
    } else {
      manDiv.style.height = "462px";
      btnText.innerHTML = "Show More";
      ContainerDiv.style.height = "700px";
    }
  }

  function myFunction3() {
    var manDiv = document.getElementById("kids_div");
    // var ContainerDiv = document.getElementById("man_div_container");
    var btnText = document.getElementById("myBtn3");

    if (manDiv.style.height === "462px") {
        manDiv.style.height = "950px";
      btnText.innerHTML = "Show Less";
    //   ContainerDiv.style.height = "1400px";
    } else {
      manDiv.style.height = "462px";
      btnText.innerHTML = "Show More";
    //   ContainerDiv.style.height = "700px";
    }
  }

  function myFunction2() {
    var manDiv = document.getElementById("woman_div");
    // var ContainerDiv = document.getElementById("man_div_container");
    var btnText = document.getElementById("myBtn2");

    if (manDiv.style.height === "462px") {
        manDiv.style.height = "950px";
      btnText.innerHTML = "Show Less";
    } else {
      manDiv.style.height = "462px";
      btnText.innerHTML = "Show More";
    }
  }

  function myHeart($love){
    var bottun = document.getElementById('img');
    if ($love==1){
        bottun.style.backgroundColor="red";
    }else{
        bottun.style.backgroundColor="#DDD";
    }


    //  if (img.src==="../heart1.png")
    // else
    // img.src='../heart1.png'
 }

 function functionToCall(countproduct){
    var span = document.getElementById('trolley');
        span.innerHTML=countproduct;
}

function showhidden(){
    
}
