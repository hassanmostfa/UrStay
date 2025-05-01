function fadeIn(el, display = 'flex') {
    el.style.opacity = 0;
    el.style.display = display;

    let opacity = 0;
    const timer = setInterval(() => {
        if (opacity >= 1) {
            clearInterval(timer);
        }
        el.style.opacity = opacity;
        opacity += 0.1; // Change the increment value to control the speed
    }, 10); // Change the interval value to control the speed
}

function fadeOut(el) {
    let opacity = 1;
    const timer = setInterval(() => {
        if (opacity <= 0) {
            clearInterval(timer);
            el.style.display = 'none';
        }
        el.style.opacity = opacity;
        opacity -= 0.1;
    }, 10);
}

// Event listener for the "more_btn"
document.querySelector('.more_btn').addEventListener("click", function() {
    fadeIn(document.querySelector('.toggled-menu'));
});

// Event listener for the "close-menu"
document.querySelector('.close-menu').addEventListener("click", function() {
    fadeOut(document.querySelector('.toggled-menu'));
});

// Event listener for the ".owner-login-btn"
document.querySelectorAll('.owner-login-btn').forEach(btn => {
    btn.addEventListener("click", function(e) {
        e.preventDefault();

        // Get the next sibling element
        const nextElement = this.nextElementSibling;
        if (nextElement) {
            // Toggle visibility
            if (nextElement.style.display === 'none' || !nextElement.style.display) {
                fadeIn(nextElement);
            } else {
                fadeOut(nextElement);
            }
        }
    });
});
