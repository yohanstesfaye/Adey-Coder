var loader = function(e) {
  let file = e.target.files;
  let output = document.getElementById("selector");
  //
  if (file[0].type.match("image")) {
    //file is image
    let reader = new FileReader();

    reader.addEventListener("load", function(e) {
      let data = e.target.result;
      let image = document.createElement("img");
      image.src = data;

      output.innerHTML = "";
      output.insertBefore(image, null);
      output.classList.add("image");
    });

    reader.readAsDataURL(file[0]);
  } else {
    //file is not image
    let show = "<span>Selected File : </span>";
    show = show + file[0].name;

    output.innerHTML = show;
    output.classList.add("active");

    if (output.classList.contains("image")) {
      output.classList.remove("image");
    }
  }
};

//add event listener for input

let fileInput = document.getElementById("file");
fileInput.addEventListener("change", loader);
