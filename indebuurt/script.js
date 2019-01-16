let menuToggle = document.querySelector('.menu-toggle');

menuToggle.addEventListener('click', function () {
  document.body.classList.toggle('has-mobile-menu-expanded')
});

document.addEventListener('keypress', function (event) {
  event = event || window.event;
  let charCode = event.keyCode || event.which;
  let charStr = String.fromCharCode(charCode);

  if (charStr === 'd') {
    document.body.classList.add('day');
    document.body.classList.remove('night');
  }

  if (charStr === 'n') {
    document.body.classList.remove('day');
    document.body.classList.add('night');
  }
});
