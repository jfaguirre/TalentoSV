/* TalentoSV Landing Page Interactive Effects */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Navigation Header Scroll Effect
    const navbar = document.getElementById('main-navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-md', 'py-3');
                navbar.classList.remove('py-5');
            } else {
                navbar.classList.remove('shadow-md', 'py-3');
                navbar.classList.add('py-5');
            }
        });
    }

    // 2. Animated Counter for Stats
    const stats = document.querySelectorAll('.stat-number');
    const animateStats = () => {
        stats.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-target'), 10);
            const count = parseInt(stat.innerText, 10);
            const speed = 2000; // time in ms
            const increment = target / (speed / 16); // ~60fps
            
            let current = 0;
            const updateCount = () => {
                if (current < target) {
                    current += increment;
                    stat.innerText = Math.floor(current);
                    setTimeout(updateCount, 16);
                } else {
                    stat.innerText = target.toLocaleString() + '+';
                }
            };
            
            updateCount();
        });
    };

    // Intersection Observer to trigger counter when visible
    const statsSection = document.getElementById('stats-section');
    if (statsSection && stats.length > 0) {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        observer.observe(statsSection);
    }
});
