let date = "Aug 22,2021 16:00:00";

let second = document.getElementById("second");
let minute = document.getElementById("minute");
let hour = document.getElementById("hour");
let day = document.getElementById("day");
let week = document.getElementById("week");

setInterval(function () {
    let event_date =new Date(date).getTime();
    let today =new Date().getTime();

    let difference = event_date - today;

    if (difference > 0) {
        //show count down
        let t_second = Math.floor((difference / 1000) % 60);
        let t_minute = Math.floor((difference / (1000*60)) % 60);
        let t_hour = Math.floor((difference / (1000*60*60)) % 24);
        let t_day = Math.floor((difference / (1000*60*60*24)) % 7);
        let t_week = Math.floor(difference / (1000 * 60 * 60 * 24 * 7));
        
        second.textContent = t_second;
        minute.textContent = t_minute;
        hour.textContent = t_hour;
        day.textContent = t_day;
        week.textContent = t_week;

    } else {
        //show website
        let section = document.getElementById("section_coundown");

        second.style.display = "none";
    }
}, 1000);