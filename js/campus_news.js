var addNewsBtn = document.getElementById("add-news-btn");

addNewsBtn.addEventListener("click", function () {
    var popupBox = document.getElementById("popup-box");
    popupBox.style.display = "block";
});

var closeBtn = document.getElementById("close-btn");

closeBtn.addEventListener("click", function () {
    var popupBox = document.getElementById("popup-box");
    popupBox.style.display = "none";
});

var form = document.querySelector('form');

form.addEventListener('submit', function (event) {
    event.preventDefault();

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'add_news.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.success) {
                location.reload();
            } else {
                alert('Failed to add news item');
            }
        } else {
            alert('Request failed. ' + xhr.statusText);
        }
    };

    var data = new FormData(form);

    xhr.send(new URLSearchParams(data));
});

function confirmDelete(topic, campusNewsID) {
    if (confirm("Delete " + topic + "?")) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        xhr.open("GET", "delete_news.php?id=" + campusNewsID, true);
        xhr.send();
    }
}
