//Dummy feedback data
var feedback = [
    {
        image: "./image/pexels-andrea-piacquadio-774909.jpg",
        author: "Andrea Piacquadio",
        job: "CEO of Light LTD",
        message:
        "Wow a nice job guys i am satisfied with thier work. I make a a request to design a website for our company and they did a good research and job. thier work is great.",
    },
    {
        image: "./image/The fatRat.jpg",
        author: "John Mickey",
        job: "Marketing Manager of CBE",
        message:
        "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account.",
    },
    {
        image: "./image/happy.jpg",
        author: "Alberto Banoa",
        job: "CEO of Mother Earth",
        message:
        "The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only",
    },
    {
        image: "./image/alexa.jpg",
        author: "Selam Moges",
        job: "Vice President of Silica",
        message:
        "A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence",
    },
    {
        image: "./image/pexels-pixabay-220453.jpg",
        author: "Daniel Zafir",
        job: "CSO of ICO",
        message:
        "We needed a good website to show our services and products, and what thier did is amazing and astonishing that fits our need and showcase our products",
    },
    {
        image: "./image/pexels-đỗ-ngọc-tú-quyên-1520760.jpg",
        author: "Lin Yuhan",
        job: "Marketing Manager of SunG",
        message:
        "One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his",
    },
];

//Dummy data end
let author = document.getElementById("author");
let message = document.getElementById("message");
let job = document.getElementById("job");
let client = document.getElementById("client");

let index = 0;

function start() {
    client.innerHTML = ""; //clean field

    feedback.forEach((v, i) => {
        temp = client.innerHTML;

        if (i == index) {
            btn = "<button class='active' onclick='show(" + i + ")'><img src='" + v.image + "'></button>";
        } else {
            btn = "<button onclick='show(" + i + ")'><img src='" + v.image + "'></button>";
        }

        client.innerHTML = temp + btn;
    });

    author.textContent = feedback[index].author;
    job.textContent = feedback[index].job;
    message.textContent = feedback[index].message;
}

function show(selected) {
    index = selected;
    start();
}

document.body.onload = (e) => {
    start();
};

