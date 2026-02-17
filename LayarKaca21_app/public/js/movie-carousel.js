/**
 * Movie Carousel - Navigation Script
 * Handles smooth scrolling with Next/Previous buttons
 */

function scrollCarousel(carouselId, direction) {
    const track = document.getElementById(carouselId);
    if (!track) return;

    // Calculate how many pixels to scroll (roughly 3 cards)
    const cardWidth = track.querySelector('.movie-card')?.offsetWidth || 200;
    const gap = 16; // 1rem gap
    const scrollAmount = (cardWidth + gap) * 3;

    if (direction === 'next') {
        track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    } else {
        track.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    }

    // Update fade visibility after scroll
    setTimeout(() => updateFadeVisibility(track), 400);
}

/**
 * Update left/right fade gradients based on scroll position
 */
function updateFadeVisibility(track) {
    const wrapper = track.closest('.carousel-wrapper');
    if (!wrapper) return;

    const fadeLeft = wrapper.querySelector('.carousel-fade-left');
    const fadeRight = wrapper.querySelector('.carousel-fade-right');

    if (fadeLeft) {
        fadeLeft.style.opacity = track.scrollLeft > 20 ? '1' : '0';
    }

    if (fadeRight) {
        const isAtEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 20;
        fadeRight.style.opacity = isAtEnd ? '0' : '1';
    }
}

/**
 * Initialize all carousels on page load
 */
document.addEventListener('DOMContentLoaded', function () {
    const tracks = document.querySelectorAll('.carousel-track');

    tracks.forEach(track => {
        // Initialize fade visibility
        updateFadeVisibility(track);

        // Update on scroll
        track.addEventListener('scroll', function () {
            updateFadeVisibility(this);
        }, { passive: true });

        // Enable touch/drag scroll for desktop
        let isDown = false;
        let startX;
        let scrollLeft;

        track.addEventListener('mousedown', (e) => {
            isDown = true;
            track.style.cursor = 'grabbing';
            startX = e.pageX - track.offsetLeft;
            scrollLeft = track.scrollLeft;
        });

        track.addEventListener('mouseleave', () => {
            isDown = false;
            track.style.cursor = 'grab';
        });

        track.addEventListener('mouseup', () => {
            isDown = false;
            track.style.cursor = 'grab';
        });

        track.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - track.offsetLeft;
            const walk = (x - startX) * 1.5;
            track.scrollLeft = scrollLeft - walk;
        });

        // Set initial cursor
        track.style.cursor = 'grab';
    });
});
