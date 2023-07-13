const addBookBtn = document.querySelector('.show-add-book');
const searchBookBtn = document.querySelector('.show-search-book');

const addBookSection = document.querySelector('.add-book-section');
const searchBookSection = document.querySelector('.search-book-section');

addBookSection.style.display = 'none';
searchBookSection.style.display = 'block';

addBookBtn.addEventListener('click', () => {
  addBookSection.style.display = 'block';
  searchBookSection.style.display = 'none';
});

searchBookBtn.addEventListener('click', () => {
  searchBookSection.style.display = 'block';
  addBookSection.style.display = 'none';
});

const borrowBookBtn = document.querySelector('.borrow-book');
const borrowModal = document.querySelector('#borrowModal');

borrowBookBtn.addEventListener('click', () => {
  const bookId = borrowBookBtn.dataset.bookId;
  const bookName = borrowBookBtn.dataset.bookName;
  
  const bookIdInput = borrowModal.querySelector('#book_id');
  const bookNameSpan = borrowModal.querySelector('#book-name');
  bookIdInput.value = bookId;
  bookNameSpan.textContent = bookName;
});

const sortLinks = document.querySelectorAll('.sort-link');

sortLinks.forEach(link => {
  link.addEventListener('click', event => {
    event.preventDefault();
    const sortColumn = link.dataset.sort;
    sortBooks(sortColumn);
  });
});

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
