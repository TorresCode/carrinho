const $menu = document.querySelector('.menu')

const $open = document.querySelector('.open')
const $close = document.querySelector('.closee')

$open.addEventListener('click', function() {
    $menu.classList.add('menu-open')
} )
$close.addEventListener('click', function() {
    $menu.classList.remove('menu-open')
} )

