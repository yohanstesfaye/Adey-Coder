
imgCard = document.querySelectorAll(".img-card");

imgCard.forEach(element => {

  element.addEventListener("click", function (e) {

    //remove active class
    imgCard.forEach(el => {
      el.classList.remove("active");
    });

    element.classList.add("active");
  })
  
});