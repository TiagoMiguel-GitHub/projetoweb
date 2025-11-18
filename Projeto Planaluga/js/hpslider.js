// Populate slider with your own images
async function loadSliderImages() {
    try {
        // SUBSTITUA ESTAS URLs PELAS SUAS PRÓPRIAS IMAGENS
        const myImages = [
            './img/1.jpg',
            './img/2.jpg',
            './img/3.jpg',
            './img/4.jpg',
            './img/5.jpg',
            './img/6.jpg'
        ];
        
        const listContainer = document.querySelector('.slider .list');
        const dotsContainer = document.querySelector('.slider .dots');
        
        // Clear existing content
        listContainer.innerHTML = '';
        dotsContainer.innerHTML = '';
        
        myImages.forEach((imgSrc, index) => {
            // Create slider item
            const item = document.createElement('div');
            item.className = 'item';
            
            const imgElement = document.createElement('img');
            imgElement.src = imgSrc;
            imgElement.alt = `Imagem ${index + 1}`;
            
            item.appendChild(imgElement);
            listContainer.appendChild(item);
            
            // Create dot
            const dot = document.createElement('li');
            if (index === 0) dot.classList.add('active');
            dotsContainer.appendChild(dot);
        });
        
        console.log('Slider populated with', myImages.length, 'images');
        
        // Initialize slider navigation after images are loaded
        initSliderNavigation();
    } catch (error) {
        console.error('Error loading images:', error);
    }
}

// Slider navigation functionality
function initSliderNavigation() {
    let slider = document.querySelector('.slider .list');
    let items = document.querySelectorAll('.slider .list .item');
    let next = document.getElementById('next');
    let prev = document.getElementById('prev');
    let dots = document.querySelectorAll('.slider .dots li');

    let lengthItems = items.length - 1;
    let active = 0;
    
    next.onclick = function(){
        active = active + 1 <= lengthItems ? active + 1 : 0;
        reloadSlider();
    }
    
    prev.onclick = function(){
        active = active - 1 >= 0 ? active - 1 : lengthItems;
        reloadSlider();
    }
    
    let refreshInterval = setInterval(()=> {next.click()}, 3000);
    
    function reloadSlider(){
        slider.style.left = -items[active].offsetLeft + 'px';
        
        let last_active_dot = document.querySelector('.slider .dots li.active');
        last_active_dot.classList.remove('active');
        dots[active].classList.add('active');

        clearInterval(refreshInterval);
        refreshInterval = setInterval(()=> {next.click()}, 3000);
    }

    dots.forEach((li, key) => {
        li.addEventListener('click', ()=>{
            active = key;
            reloadSlider();
        })
    })
    
    window.onresize = function(event) {
        reloadSlider();
    };
}

// Load images when page is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadSliderImages);
} else {
    loadSliderImages();
}