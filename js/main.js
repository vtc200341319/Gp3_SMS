
const tablinks = document.querySelectorAll('.tab button');
const tabcontent = document.querySelectorAll('.tabcontent');


tablinks.forEach(tablink => {
    tablink.addEventListener('click', () => {
        for (const {classList} of tablinks) {
            classList.remove('active');
        }

        tablink.classList.add('active');
        for (const {classList} of tabcontent) {
            classList.remove('show');
        }

        const target = tablink.dataset.target;
        document.querySelector(`#${target}`).classList.add('show');
    });
});

const accordionHeaders = document.querySelectorAll('.accordion-header');


accordionHeaders.forEach(header => {
    header.addEventListener('click', () => {
        header.parentElement.classList.toggle('active');

        const content = header.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }

        const activeItems = document.querySelectorAll('.accordion-item.active');
        activeItems.forEach(item => {
            if (item !== header.parentElement) {
                item.classList.remove('active');
                item.lastElementChild.style.maxHeight = null;
            }
        });
    });
});

function changeLanguage() {
    var lang = document.getElementById("lang-select").value;
    var enElements = document.getElementsByClassName("en");
    var zhElements = document.getElementsByClassName("zh");

    if (lang === "en") {
        for (var i = 0; i < enElements.length; i++) {
            enElements[i].style.display = "block";
        }
        for (var j = 0; j < zhElements.length; j++) {
            zhElements[j].style.display = "none";
        }
    } else if (lang === "zh") {
        for (var i = 0; i < enElements.length; i++) {
            enElements[i].style.display = "none";
        }
        for (var j = 0; j < zhElements.length; j++) {
            zhElements[j].style.display = "block";
        }
    }
}

function logout() {
    if (confirm("Logout?")) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'logout.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (this.readyState === 4 && this.status === 200) {
                window.location.href = "index.php";
            }
        };
        xhr.send();
    }
}

function updateClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    if (seconds < 10)
    {
        seconds = "0" + seconds;
    }
    var timeString = hours + ':' + minutes + ':' + seconds;
    document.getElementById('clock').innerHTML = timeString;
    document.getElementById('clock1').innerHTML = timeString;
}
setInterval(updateClock, 1000);


var initialUrl = "home.php";

function reloadPage() {
     location.reload(true);
  }