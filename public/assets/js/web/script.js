// script.js
gsap.registerPlugin(ScrollTrigger);

// Mobile menu toggle
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", mobileMenu);

function mobileMenu() {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
}

const navLink = document.querySelectorAll(".nav-link");

navLink.forEach(n => n.addEventListener("click", closeMenu));

function closeMenu() {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}



// Hero section animation
gsap.from('.hero-content > *', {
    opacity: 0,
    y: 50,
    duration: 1,
    stagger: 0.3,
    ease: 'power3.out'
});

gsap.from('.hero-image img', {
    opacity: 0,
    x: 100,
    duration: 1,
    delay: 0.5,
    ease: 'power3.out'
});

// Product cards animation
gsap.utils.toArray('.product-card').forEach((card, index) => {
    gsap.from(card, {
        scrollTrigger: {
            trigger: card,
            start: 'top 80%',
            end: 'bottom 20%',
            toggleActions: 'play none none reverse'
        },
        opacity: 0,
        y: 50,
        rotation: 5,
        duration: 0.8,
        delay: index * 0.2,
        ease: 'power3.out'
    });
});

// Features animation
gsap.utils.toArray('.feature-item').forEach((item, index) => {
    gsap.from(item, {
        scrollTrigger: {
            trigger: item,
            start: 'top 80%',
            end: 'bottom 20%',
            toggleActions: 'play none none reverse'
        },
        opacity: 0,
        y: 30,
        scale: 0.9,
        duration: 0.6,
        delay: index * 0.1,
        ease: 'back.out(1.7)'
    });
});
document.addEventListener('DOMContentLoaded', () => {
    // Image gallery
    const mainImage = document.getElementById('main-image');
    const thumbnails = document.querySelectorAll('.thumbnail');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            mainImage.src = thumbnail.src.replace('150x150', '800x600');
        });
    });

    // Tabs
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const tabId = btn.getAttribute('data-tab');

            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            btn.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Sticky add to cart
    const productInfo = document.querySelector('.product-info');
    const stickyCart = document.createElement('div');
    stickyCart.classList.add('sticky-cart');
    stickyCart.innerHTML = `
        <div class="sticky-product-info">
            <img src="${mainImage.src}" alt="Product" width="50" height="50">
            <div>
                <h3>${document.querySelector('h1').textContent}</h3>
                <p>${document.querySelector('.price').textContent}</p>
            </div>
        </div>
        <button class="add-to-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
    `;

    document.body.appendChild(stickyCart);

    window.addEventListener('scroll', () => {
        if (window.scrollY > productInfo.offsetTop + productInfo.offsetHeight) {
            stickyCart.style.display = 'flex';
        } else {
            stickyCart.style.display = 'none';
        }
    });
});
// Testimonial slider
let currentTestimonial = 0;
const testimonials = document.querySelectorAll('.testimonial');
const totalTestimonials = testimonials.length;

function showTestimonial(index) {
    testimonials.forEach((testimonial, i) => {
        if (i === index) {
            testimonial.style.display = 'block';
            gsap.from(testimonial, { opacity: 0, y: 20, duration: 0.5, ease: 'power2.out' });
        } else {
            testimonial.style.display = 'none';
        }
    });
}

function nextTestimonial() {
    currentTestimonial = (currentTestimonial + 1) % totalTestimonials;
    showTestimonial(currentTestimonial);
}

setInterval(nextTestimonial, 5000);
showTestimonial(currentTestimonial);

// Contact form animation
gsap.from('#contact form', {
    scrollTrigger: {
        trigger: '#contact',
        start: 'top 80%',
        end: 'bottom 20%',
        toggleActions: 'play none none reverse'
    },
    opacity: 0,
    y: 50,
    duration: 1,
    ease: 'power3.out'
});

// Animate section headings
gsap.utils.toArray('h2').forEach((heading) => {
    gsap.from(heading, {
        scrollTrigger: {
            trigger: heading,
            start: 'top 80%',
            end: 'bottom 20%',
            toggleActions: 'play none none reverse'
        },
        opacity: 0,
        y: 30,
        duration: 0.8,
        ease: 'power2.out'
    });
});

// Parallax effect for hero image
gsap.to('.hero-image img', {
    yPercent: -20,
    ease: 'none',
    scrollTrigger: {
        trigger: '.hero',
        start: 'top top',
        end: 'bottom top',
        scrub: true
    }
});

// Animate logo on page load
gsap.from('.logo', {
    opacity: 0,
    x: -50,
    duration: 1,
    ease: 'power3.out'
});

// Animate navigation links on page load
gsap.from('nav ul li', {
    opacity: 0,
    y: -20,
    duration: 0.5,
    stagger: 0.1,
    ease: 'power2.out'
});

//prodect page
gsap.from(".offer-banner", {
    duration: 1.2,
    scale: 0.8,
    opacity: 0,
    delay: 0.5,
    ease: "elastic.out(1, 0.5)"
});



document.addEventListener('DOMContentLoaded', () => {
    // Image gallery
    const mainImage = document.getElementById('main-image');
    const thumbnails = document.querySelectorAll('.thumbnail');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            gsap.to(mainImage, {
                opacity: 0,
                duration: 0.2,
                onComplete: () => {
                    mainImage.src = thumbnail.src.replace('150x150', '800x600');
                    gsap.to(mainImage, { opacity: 1, duration: 0.2 });
                }
            });
        });
    });

    // Tabs
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const tabId = btn.getAttribute('data-tab');

            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            btn.classList.add('active');
            const activeContent = document.getElementById(tabId);
            activeContent.classList.add('active');

            gsap.from(activeContent, {
                opacity: 0,
                y: 20,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });

    // Sticky add to cart
    const productInfo = document.querySelector('.product-info');
    const stickyCart = document.createElement('div');
    stickyCart.classList.add('sticky-cart');
    stickyCart.innerHTML = `
        <div class="sticky-product-info">
            <img src="${mainImage.src}" alt="Product" width="50" height="50">
            <div>
                <h3>${document.querySelector('h1').textContent}</h3>
                <p>${document.querySelector('.price').textContent}</p>
            </div>
        </div>
        <button class="add-to-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
    `;

    document.body.appendChild(stickyCart);

    const stickyCartTimeline = gsap.timeline({ paused: true });
    stickyCartTimeline.from(stickyCart, {
        y: -100,
        opacity: 0,
        duration: 0.3,
        ease: 'power2.out'
    });

    window.addEventListener('scroll', () => {
        if (window.scrollY > productInfo.offsetTop + productInfo.offsetHeight) {
            stickyCart.style.display = 'flex';
            stickyCartTimeline.play();
        } else {
            stickyCartTimeline.reverse();
        }
    });

    // Initial animations
    gsap.from('.product-gallery', {
        opacity: 0,
        x: -50,
        duration: 0.8,
        ease: 'power2.out'
    });

    gsap.from('.product-info', {
        opacity: 0,
        x: 50,
        duration: 0.8,
        ease: 'power2.out'
    });

    gsap.from('.tab-btn', {
        opacity: 0,
        y: 20,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out'
    });

    // Add to Cart button animation
    const addToCartBtn = document.querySelector('.add-to-cart');
    addToCartBtn.addEventListener('click', () => {
        gsap.to(addToCartBtn, {
            scale: 1.1,
            duration: 0.1,
            yoyo: true,
            repeat: 1,
            ease: 'power2.inOut'
        });
    });

    // Thumbnail hover animation
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('mouseenter', () => {
            gsap.to(thumbnail, {
                scale: 1.1,
                duration: 0.2,
                ease: 'power2.out'
            });
        });

        thumbnail.addEventListener('mouseleave', () => {
            gsap.to(thumbnail, {
                scale: 1,
                duration: 0.2,
                ease: 'power2.out'
            });
        });
    });
});