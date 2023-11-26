// JavaScript code with count-up integration
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show-el');
            // Check if the element has a data-countup attribute
            const countUpValue = entry.target.dataset.countup;
            if (countUpValue) {
                animateCountUp(entry.target);
            }
        } else {
            // entry.target.classList.remove('show-el');
            // entry.target.classList.remove('bg-red-400');
        }
    });
});

function animateCountUp(element) {
    const targetValue = parseFloat(element.dataset.countup.replace(/\./g, ''));
    const duration = 3000; // Time in milliseconds for the animation (adjust as needed)
    const frameDuration = 1000 / 60; // 60 FPS

    let currentNumber = 0;
    const totalFrames = Math.round(duration / frameDuration);
    const frameIncrement = (targetValue - currentNumber) / totalFrames;

    const numberFormatter = new Intl.NumberFormat('pt-BR', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    });

    function updateNumber() {
        currentNumber += frameIncrement;
        element.textContent = numberFormatter.format(Math.floor(currentNumber));

        if (currentNumber < targetValue) {
            requestAnimationFrame(updateNumber)
        } else {
            element.textContent = numberFormatter.format(targetValue);
        }
    }

    requestAnimationFrame(updateNumber);
}

const hiddenElements = document.querySelectorAll('.hidden-el');
hiddenElements.forEach((el) => {
    observer.observe(el);
});
