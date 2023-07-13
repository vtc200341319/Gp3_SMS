
document.querySelector('form').addEventListener('submit', function () {
  document.querySelector('button[type="submit"]').disabled = true;
});


if (window.location.href.indexOf('success.php') > -1) {
  const successMessage = document.createElement('div');
  successMessage.className = 'success';
  successMessage.innerHTML = 'Thank you for registering!';
  document.querySelector('form').parentNode.insertBefore(successMessage, document.querySelector('form'));
}
