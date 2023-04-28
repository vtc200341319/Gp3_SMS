
const rows = document.querySelectorAll('tbody tr');
for (let i = 0; i < rows.length; i++) {
  rows[i].addEventListener('mouseover', function () {
    this.style.backgroundColor = '#f2f2f2';
  });
  rows[i].addEventListener('mouseout', function () {
    this.style.backgroundColor = '';
  });
}
