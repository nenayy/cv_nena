// Visual Effects for CV Application
document.addEventListener('DOMContentLoaded', function() {
    // Initialize subtle animations for cards and elements
    initCardAnimations();
    initButtonEffects();
    initProfileImageEffects();
});

function initCardAnimations() {
    // Add floating animation to cards
    const cards = document.querySelectorAll('.card-float');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
    });
}

function initButtonEffects() {
    // Add glow effect to buttons on hover
    const buttons = document.querySelectorAll('.btn-glow');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 0 15px rgba(102, 126, 234, 0.7)';
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.boxShadow = '';
            this.style.transform = '';
        });
    });
}

// Function to initialize profile image effects
function initProfileImageEffects() {
    const profileImages = document.querySelectorAll('.profile-img');
    profileImages.forEach(img => {
        // Ensure the pulse animation is applied to all profile images
        if (!img.classList.contains('pulse')) {
            img.classList.add('pulse');
        }
    });
}