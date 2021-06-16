let read = document.getElementById("read");
let animation = document.getElementById("animation");
let icon = document.getElementsByClassName("fas")[0].classList;

if ("speechSynthesis" in window) {
    let message = new SpeechSynthesisUtterance();
    let text = document.getElementById("text").textContent;
    message.text = text.replace(/(\r\n|\r|\n)/gm, " "); //remove line breaks

    //when reading ended
    message.onend = function (event) {
        icon_play();
    };

    //when reading started
    message.onstart = function (event) {
        icon_pause();
    };

    let icon_play = function () {
        icon.add("fa-play");
        icon.remove("fa-pause");
        animation.style.display = "none";
    }
    let icon_pause = function () {
        icon.remove("fa-play");
        icon.add("fa-pause");
        animation.style.display = "block";
    }

    read.onclick = function (event) {
        if (speechSynthesis.speaking && !speechSynthesis.paused) {
            icon_play();
            speechSynthesis.pause();
        } else if (speechSynthesis.paused) {
            icon_pause();
            speechSynthesis.resume();
        } else {
            speechSynthesis.speak(message);
        }
    }
} else {
    
    alert("Sorry,Your browser doesnot support speech Synthesis API");
}