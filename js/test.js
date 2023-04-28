document.getElementById("search-form").addEventListener("submit", function (event) {
    event.preventDefault();
    const searchValue = document.getElementById("search").value.trim();
    if (searchValue.length === 0) {
        return;
    }

    fetch("search.php", {
        method: "POST",
        body: new FormData(event.target),
    })
            .then(response => response.json())
            .then(displayResults)
            .catch(console.error);
});

function displayResults(books) {
    const resultContainer = document.getElementById("result-container");
    resultContainer.innerHTML = "";

    for (const book of books) {
        const bookResult = document.createElement("div");
        bookResult.className = "book-result";

        const bookTitle = document.createElement("p");
        bookTitle.className = "book-title";
        bookTitle.textContent = book.title;

        const bookAuthor = document.createElement("p");
        bookAuthor.textContent = `Author: ${book.author}`;

        bookResult.append(bookTitle, bookAuthor);
        resultContainer.appendChild(bookResult);
    }
}
