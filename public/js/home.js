var nav = document.getElementById('nav')

window.addEventListener("scroll", function() {
    var scroll = window.scrollY;
    if (scrollY > 0) {
        nav.style.backgroundColor = '#8590FF';
    } else {
        nav.style.backgroundColor = 'transparent';
    }
})