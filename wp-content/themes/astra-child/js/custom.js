jQuery(document).ready(function ($) {
    console.log('jQuery is running...');

    // HAMBURGUER ANIMATION
    $(document).ready(function () {
        $(".hamburguer-bt").click(function () {
            $(this).toggleClass("on");
        });
    });

    $(".mobile-menu-icon").on('click', function () {
        $(".mobile-menu-sidebar").toggleClass("open");
        // alert()
    });

    $('.testimonials').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        // center: true,
        // startPosition: 0,
        autoplay: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    })

});

document.addEventListener("DOMContentLoaded", function () {
    const currentYear = new Date().getFullYear();
    const copyrightYearSpan = document.getElementById("copyright-year");

    if (copyrightYearSpan) {
        copyrightYearSpan.textContent = currentYear;
    }
});

let prevScrollY = window.scrollY;

window.addEventListener('scroll', () => {
    const logoImage = document.querySelector('#logo-image');
    const scrollY = window.scrollY;

    if (scrollY > prevScrollY) {
        // Scrolling down
        var liElements = document.querySelectorAll(".navbar .nav-list li:not(.schedule-li)");
        liElements.forEach(function (li) {
            li.classList.remove("opacity-100");
            li.classList.add("opacity-0");
        });
    } else {
        // Scrolling up
        var liElements = document.querySelectorAll(".navbar .nav-list li:not(.schedule-li)");
        liElements.forEach(function (li) {
            li.classList.remove("opacity-0");
            li.classList.add("opacity-100");
        });
    }

    // Calculate the new max-width value based on scroll position
    const newMaxWidth = Math.max(280 - scrollY * 0.1, 150); // Adjust the values as needed
    logoImage.style.maxWidth = `${newMaxWidth}px`;

    prevScrollY = scrollY;
});
