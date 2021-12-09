light = document.querySelector(".light");
slider = document.querySelector("#range");

slider.addEventListener("input", function (e) {
    c = slider.value;

    if (!light.classList.contains("on")) {
        light.classList.add("on");
    }

    light.style.setProperty("--spread", c + "rem");
    light.style.setProperty("--blur", c*2 + "rem");

});

light.addEventListener("click",function(e){
    if (light.classList.contains("on")) {
        light.classList.remove("on");
    } else {
        light.classList.add("on");
    }
});

var lightColor = function (e) {
    light.style.setProperty("--bsc", e.style.color);
    light.style.setProperty("--bc", e.style.backgroundColor);
    if (!light.classList.contains("on")) {
        light.classList.add("on");
    }
}