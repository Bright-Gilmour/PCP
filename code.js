

let slideIndex = 0;
const slides = document.querySelectorAll(".slides");
const dots = document.querySelectorAll(".dot");

function showSlides() {
  slides.forEach((slide, index) => {
    slide.style.display = "none";
    dots[index].classList.remove("active");
  });
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].classList.add("active");
  setTimeout(showSlides, 6000); // Change slide every 3 seconds
}

showSlides();






function signBtn(){
    window.location.href = "sign-up.html";
}



function adminBtn(){
    window.location.href = "admin.html";
}



function goOut(){
    window.location.href = "home.html";
}





function addProduct(){
  document.getElementById("cover-product").style.display = 'block';
}


function exitCover(){
  document.getElementById("cover-product").style.display = 'none';
}







function beforeGo(){
  window.location.href = "login.html";
}






function viewPro(){
  window.location.href = "product-view.php";
}




function listPro(){
  window.location.href = "product-list.php";
}



function listMess(){
  window.location.href = "message.html";
}



function listSett(){
  window.location.href = "v-settings.php";
}




// ------------------------------------

function buyPhone(){
  document.getElementById("cover").style.display = 'block';
}


function backGo(){
  document.getElementById("cover").style.display = 'none';
}

