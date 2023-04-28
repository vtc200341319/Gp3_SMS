// Get the "Add book" and "Search book" buttons
const addBookBtn = document.querySelector('.show-add-book');
const searchBookBtn = document.querySelector('.show-search-book');

// Get the "Add book" and "Search book" sections
const addBookSection = document.querySelector('.add-book-section');
const searchBookSection = document.querySelector('.search-book-section');

// Hide the "Add book" and "Search book" sections by default
addBookSection.style.display = 'none';
searchBookSection.style.display = 'block';

// Show the "Add book" section when the "Add book" button is clicked
addBookBtn.addEventListener('click', () => {
  addBookSection.style.display = 'block';
  searchBookSection.style.display = 'none';
});

// Show the "Search book" section when the "Search book" button is clicked
searchBookBtn.addEventListener('click', () => {
  searchBookSection.style.display = 'block';
  addBookSection.style.display = 'none';
});

// Get the "Borrow book" button and modal
const borrowBookBtn = document.querySelector('.borrow-book');
const borrowModal = document.querySelector('#borrowModal');

// Get the book ID and name from the "Borrow book" button
borrowBookBtn.addEventListener('click', () => {
  const bookId = borrowBookBtn.dataset.bookId;
  const bookName = borrowBookBtn.dataset.bookName;
  
  // Update the modal with the book ID and name
  const bookIdInput = borrowModal.querySelector('#book_id');
  const bookNameSpan = borrowModal.querySelector('#book-name');
  bookIdInput.value = bookId;
  bookNameSpan.textContent = bookName;
});

// Get the "Sort" links
const sortLinks = document.querySelectorAll('.sort-link');

// Add a click event listener to each "Sort" link
sortLinks.forEach(link => {
  link.addEventListener('click', event => {
    event.preventDefault();
    const sortColumn = link.dataset.sort;
    sortBooks(sortColumn);
  });
});

// Sort the table rows based on the specified column
function sortBooks(sortColumn) {
  const rows = document.querySelectorAll('tbody tr');
  const sortedRows = Array.from(rows);
  sortedRows.sort((rowA, rowB) => {
    const valueA = rowA.querySelector(`td[data-column="${sortColumn}"]`).textContent.trim();
    const valueB = rowB.querySelector(`td[data-column="${sortColumn}"]`).textContent.trim();
    return valueA.localeCompare(valueB);
  });
  const tableBody = document.querySelector('tbody');
  tableBody.innerHTML = '';
  sortedRows.forEach(row => tableBody.appendChild(row));
}
