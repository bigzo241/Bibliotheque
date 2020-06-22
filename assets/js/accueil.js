import '../css/accueil.css';

var $ = require('jquery');

$(function(){
    $("#main_navbar").bootnavbar();

    // animation d'apparition des elements au scroll
    const options = {
        root: null,
        rootMargin: '0px',
        threshold: .15
    }

    var relai = function (entries, observer) {
        entries.forEach(function (entry) {
            if (entry.intersectionRatio > options.threshold) {
                entry.target.classList.add('apparition');
                observer.unobserve(entry.target);
            }
        })
    }

    const observer = new IntersectionObserver(relai, options);
    document.querySelectorAll('.masque').forEach(function (m) {
        observer.observe(m);
    })
})