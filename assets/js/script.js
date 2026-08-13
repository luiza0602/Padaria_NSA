

/*carrosel - destaques */

document.addEventListener('DOMContentLoaded', () => {

    const carrossel = document.getElementById('carrossel');
    if (!carrossel) return;

    const track = document.getElementById('carrossel-track');
    const dotsWrap = document.getElementById('carrossel-dots');
    const prevBtn = document.getElementById('carrossel-prev');
    const nextBtn = document.getElementById('carrossel-next');
    const slides = Array.from(track.children);

    let current = 0;
    let autoplayTimer = null;
    const AUTOPLAY_MS = 5000;

    // cria os dots dinamicamente, um para cada slide
    slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'dot' + (i === 0 ? ' active' : '');
        dot.setAttribute('aria-label', 'Ir para slide ' + (i + 1));
        dot.addEventListener('click', () => {
            goTo(i);
            startAutoplay();
        });
        dotsWrap.appendChild(dot);
    });
    const dots = Array.from(dotsWrap.children);

    function goTo(index) {
        current = (index + slides.length) % slides.length;
        track.style.transform = 'translateX(' + (-current * 100) + '%)';
        dots.forEach((d, i) => d.classList.toggle('active', i === current));
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function startAutoplay() {
        stopAutoplay();
        autoplayTimer = setInterval(next, AUTOPLAY_MS);
    }

    function stopAutoplay() {
        if (autoplayTimer) clearInterval(autoplayTimer);
    }

    nextBtn.addEventListener('click', () => { next(); startAutoplay(); });
    prevBtn.addEventListener('click', () => { prev(); startAutoplay(); });

    carrossel.addEventListener('mouseenter', stopAutoplay);
    carrossel.addEventListener('mouseleave', startAutoplay);

    carrossel.setAttribute('tabindex', '0');
    carrossel.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') { next(); startAutoplay(); }
        if (e.key === 'ArrowLeft') { prev(); startAutoplay(); }
    });

    // suporte a swipe no celular
    let touchStartX = 0;
    carrossel.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
        stopAutoplay();
    }, { passive: true });

    carrossel.addEventListener('touchend', (e) => {
        const dx = e.changedTouches[0].clientX - touchStartX;
        if (dx > 40) prev();
        else if (dx < -40) next();
        startAutoplay();
    }, { passive: true });

    goTo(0);
    startAutoplay();

});

// Menu  (mobile)
const menuToggle = document.getElementById('menuToggle');
const menuPrincipal = document.getElementById('menuPrincipal');
 
if (menuToggle && menuPrincipal) {
 
    menuToggle.addEventListener('click', () => {
 
        const aberto = menuPrincipal.classList.toggle('active');
        menuToggle.setAttribute('aria-expanded', aberto);
 
        // Troca o ícone entre "barras" e "x"
        const icone = menuToggle.querySelector('i');
        icone.classList.toggle('fa-bars');
        icone.classList.toggle('fa-xmark');
 
    });
 
    // Fecha o menu ao clicar em um link
    menuPrincipal.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            menuPrincipal.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
 
            const icone = menuToggle.querySelector('i');
            icone.classList.add('fa-bars');
            icone.classList.remove('fa-xmark');
        });
    });
 
}

