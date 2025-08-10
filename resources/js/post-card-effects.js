// === POST CARD EFEITO SIMPLES ===

document.addEventListener('DOMContentLoaded', function() {
    initSimplePostCardEffects();
});

function initSimplePostCardEffects() {
    const postCards = document.querySelectorAll('.post-card');
    
    postCards.forEach(card => {
        // Adicionar efeito de entrada suave
        addEntranceEffect(card);
    });
}

// Efeito de entrada suave para os cards
function addEntranceEffect(card) {
    // Intersection Observer para animação de entrada
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        },
        { threshold: 0.1 }
    );
    
    // Configurar estado inicial
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    
    observer.observe(card);
}

// Função de utilidade para animações suaves (caso precise no futuro)
function smoothTransition(element, property, targetValue, duration = 300) {
    element.style.transition = `${property} ${duration}ms ease-out`;
    element.style[property] = targetValue;
}
