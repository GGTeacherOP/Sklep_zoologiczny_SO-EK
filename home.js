document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.scrollable');
    let isDown = false;
    let startX;
    let scrollLeft;
    const slides = document.querySelectorAll('.banner-slide');
    let currentIndex = 0;
    
    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const scrollSpeed = (x - startX) * 1.5;
        slider.scrollLeft = scrollLeft - scrollSpeed;
    });

    setInterval(() => {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add('active');
    }, 4000); 
})
