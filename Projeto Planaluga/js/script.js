// Main entry point - Import other scripts

document.addEventListener('DOMContentLoaded', function() {
    console.log('Initializing scripts...');

    const cardBody = document.querySelector('.card-body');
    const cardImg = document.querySelector('.card-img');

    if (cardImg) {
        cardImg.addEventListener('mousemove', function(e) {
            const rect = cardImg.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            // Calculate rotation based on cursor position
            // Range: -20 to 20 degrees
            const rotateX = ((y - centerY) / centerY) * -20;
            const rotateY = ((x - centerX) / centerX) * 20;
            
            cardImg.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`;
        });
        
        cardImg.addEventListener('mouseleave', function() {
            cardImg.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
        });
    }
});