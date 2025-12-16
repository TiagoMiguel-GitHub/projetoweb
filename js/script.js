// Main entry point - Import other scripts
/*
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

    //ADICIONAR JS PARA SERVIÇOS FUTURAMENTE
    if(document.querySelector('.portfolio').length > 0){
        // Código para portfolio
    }
});

*/

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

    // Portfolio Gallery with Popup Slider
    if(document.querySelector('.portfolio')) {
        // Dados das imagens para cada serviço
        const serviceImages = {
            1: {
                title: 'Serviços 1 - Limpeza de Fachada',
                images: [
                    'img/servicos/s3.jpg',
                    'img/servicos/s33.jpg',
                    'img/servicos/s333.jpg',
                    'img/servicos/s3333.jpg'
                ]
            },
            2: {
                title: 'Serviços 2 - X',
                images: [
                    'img/servicos/s4.jpg',
                    'img/servicos/s44.jpg',
                    'img/servicos/s444.jpg'
                ]
            },
            3: {
                title: 'Serviços 3 - Pinturas',
                images: [
                    'img/servicos/s5.jpg',
                    'img/servicos/s55.jpg',
                    'img/servicos/s555.jpg'
                ]
            },
            4: {
                title: 'Serviços 4 - X',
                images: [
                    'img/servicos/s6.jpg',
                    'img/servicos/s66.jpg',
                    'img/servicos/s666.jpg'
                ]
            },
            5: {
                title: 'Serviços 5 - XX',
                images: [
                    'img/servicos/s7.jpg',
                    'img/servicos/s77.jpg',
                    'img/servicos/s777.jpg',
                    'img/servicos/s7777.jpg'
                ]
            },
            6: {
                title: 'Serviços 6 - Eletricidade',
                images: [
                    'img/servicos/s9.jpg',
                    'img/servicos/s99.jpg',
                ]
            },
            7: {
                title: 'Serviços 7 - Jardinagem',
                images: [
                    'img/servicos/s1.jpg',
                ]
            },
            8: {
                title: 'Serviços 8 - Limpezas',
                images: [
                    'img/servicos/s2.jpg',
                ]
            }
        };

        // Elementos DOM
        const galleryItems = document.querySelectorAll('.gallery-item');
        const popupModal = document.getElementById('popupModal');
        const closePopup = document.getElementById('closePopup');
        const sliderImage = document.getElementById('sliderImage');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const sliderCounter = document.getElementById('sliderCounter');
        const serviceTitle = document.getElementById('serviceTitle');

        let currentService = null;
        let currentImageIndex = 0;

        // Abrir popup ao clicar numa imagem da gallery
        galleryItems.forEach(item => {
            item.addEventListener('click', () => {
                const serviceId = item.dataset.service;
                openPopup(serviceId);
            });
        });

        // Função para abrir o popup
        function openPopup(serviceId) {
            currentService = serviceImages[serviceId];
            currentImageIndex = 0;
            
            if (currentService) {
                serviceTitle.textContent = currentService.title;
                updateSlider();
                popupModal.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevenir scroll
            }
        }

        // Função para atualizar o slider
        function updateSlider() {
            if (currentService && currentService.images.length > 0) {
                sliderImage.src = currentService.images[currentImageIndex];
                sliderCounter.textContent = `${currentImageIndex + 1} / ${currentService.images.length}`;
            }
        }

        // Navegação do slider
        prevBtn.addEventListener('click', () => {
            if (currentService) {
                currentImageIndex = (currentImageIndex - 1 + currentService.images.length) % currentService.images.length;
                updateSlider();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentService) {
                currentImageIndex = (currentImageIndex + 1) % currentService.images.length;
                updateSlider();
            }
        });

        // Fechar popup
        closePopup.addEventListener('click', () => {
            popupModal.classList.remove('active');
            document.body.style.overflow = ''; // Restaurar scroll
        });

        // Fechar popup ao clicar fora do conteúdo
        popupModal.addEventListener('click', (e) => {
            if (e.target === popupModal) {
                popupModal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Navegação por teclado
        document.addEventListener('keydown', (e) => {
            if (popupModal.classList.contains('active')) {
                if (e.key === 'Escape') {
                    popupModal.classList.remove('active');
                    document.body.style.overflow = '';
                } else if (e.key === 'ArrowLeft') {
                    prevBtn.click();
                } else if (e.key === 'ArrowRight') {
                    nextBtn.click();
                }
            }
        });
    }
});