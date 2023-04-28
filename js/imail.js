document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const messageContainer = document.createElement("div");
  messageContainer.style.display = "none";
  form.parentNode.insertBefore(messageContainer, form.nextSibling);

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(form);
    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState === XMLHttpRequest.DONE) {
        if (request.status === 200) {
          messageContainer.textContent = request.responseText;
          messageContainer.style.display = "block";
          messageContainer.style.color =
            request.responseText.includes("issue") ? "red" : "green";

          if (!request.responseText.includes("issue")) {
            form.reset();
          }
        } else {
          messageContainer.textContent =
            "There was an error with the request. Please try again.";
          messageContainer.style.display = "block";
          messageContainer.style.color = "red";
        }
      }
    };

    request.open("POST", "imail.php", true);
    request.send(formData);
  });
});
