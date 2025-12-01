document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector("header");

    window.addEventListener("scroll", function() {
        header.classList.toggle("sticky", window.scrollY > 0);
    });

    // Hamburger menu for mobile
    let menu = document.querySelector('#menu-icon');
    let navbar = document.querySelector('.navbar');
    if (menu) {
        menu.onclick = () => {
            menu.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        };
    }

    window.onscroll = () => {
        if (menu) {
            menu.classList.remove('bx-x');
            navbar.classList.remove('open');
        }
    };

    // Scroll Reveal Animation
    const sr = ScrollReveal({
        distance: '30px',
        duration: 2500,
        reset: true
    });
    sr.reveal('.home-text', { delay: 200, origin: 'left' });
    sr.reveal('.home-img', { delay: 200, origin: 'right' });
    sr.reveal('.container, .about, .menu, .contact', { delay: 200, origin: 'bottom' });

    // Product Modal Logic
    const productModal = document.getElementById('product-modal');
    if (productModal) {
        const modalImg = document.getElementById('modal-img');
        const modalName = document.getElementById('modal-name');
        const modalDesc = document.getElementById('modal-desc');
        const modalPrice = document.getElementById('modal-price');
        const modalProductId = document.getElementById('modal-product-id');
        const modalBuyNowId = document.getElementById('modal-buy-now-id');
        const closeButton = productModal.querySelector('.close-button');

        // Event listener for all product rows
        document.querySelectorAll('.menu-content .row').forEach(item => {
            item.addEventListener('click', () => {
                // Get data from data-* attributes of the clicked product
                const id = item.dataset.id;
                const name = item.dataset.name;
                const desc = item.dataset.desc;
                const price = parseFloat(item.dataset.price).toFixed(2);
                const img = item.dataset.img;

                // Populate the modal with the product data
                modalImg.src = img;
                modalName.textContent = name;
                modalDesc.textContent = desc;
                modalPrice.textContent = `$${price}`;
                modalProductId.value = id;
                modalBuyNowId.value = id;

                // Display the modal
                productModal.style.display = "block";
            });
        });

        // Close modal when 'x' is clicked
        if(closeButton) {
            closeButton.onclick = function() {
                productModal.style.display = "none";
            }
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == productModal) {
                productModal.style.display = "none";
            }
        }
    }

    // Shopping Cart Sidebar Logic
    const cartIcon = document.getElementById('cart-icon');
    const cartSidebar = document.getElementById('cart-sidebar');
    const closeSidebar = document.querySelector('.close-sidebar');

    if (cartIcon) {
        cartIcon.onclick = (e) => {
            e.preventDefault(); // Prevent page from jumping to top
            cartSidebar.style.width = '350px';
        };
    }

    if (closeSidebar) {
        closeSidebar.onclick = () => {
            cartSidebar.style.width = '0';
        };
    }
});