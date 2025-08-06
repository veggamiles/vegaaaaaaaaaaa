// Smooth scrolling for navigation links
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    const navLinks = document.querySelectorAll('a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetSection.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Mobile menu toggle (if needed for responsive design)
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const nav = document.querySelector('.nav');
    
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            nav.classList.toggle('nav-open');
        });
    }

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe feature cards for animation
    const featureCards = document.querySelectorAll('.feature-card');
    featureCards.forEach(card => {
        observer.observe(card);
    });

    // Observe benefit items
    const benefitItems = document.querySelectorAll('.benefit-item');
    benefitItems.forEach(item => {
        observer.observe(item);
    });

    // Observe testimonial cards
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    testimonialCards.forEach(card => {
        observer.observe(card);
    });

    // Counter animation for statistics
    const statNumbers = document.querySelectorAll('.stat-number');
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
            }
        });
    }, { threshold: 0.5 });

    statNumbers.forEach(stat => {
        statsObserver.observe(stat);
    });

    // Header scroll effect
    let lastScrollTop = 0;
    const header = document.querySelector('.header');
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
        
        lastScrollTop = scrollTop;
    });

    // Feature card step toggle functionality
    const featureCardsWithSteps = document.querySelectorAll('.feature-card');
    featureCardsWithSteps.forEach(card => {
        const steps = card.querySelector('.feature-steps');
        if (steps) {
            // Initially hide steps on mobile
            if (window.innerWidth <= 768) {
                steps.style.display = 'none';
                
                // Add click handler to toggle steps
                card.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (steps.style.display === 'none') {
                        steps.style.display = 'block';
                        card.classList.add('expanded');
                    } else {
                        steps.style.display = 'none';
                        card.classList.remove('expanded');
                    }
                });
            }
        }
    });

    // Button click handlers with visual feedback
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);
            
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Form validation and submission (for demo purposes)
    const ctaButtons = document.querySelectorAll('.cta-buttons .btn');
    ctaButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show demo modal or alert
            if (this.textContent.includes('Chat')) {
                showDemoModal('Contact Form', 'Thank you for your interest! Our legislative management specialists will contact you within 24 hours to discuss your specific needs.');
            } else if (this.textContent.includes('Demo')) {
                showDemoModal('Schedule Demo', 'Demo request received! We\'ll send you a calendar link to schedule your personalized demonstration of our legislative management platform.');
            }
        });
    });

    // Pricing button handlers
    const pricingButtons = document.querySelectorAll('.btn-primary');
    pricingButtons.forEach(button => {
        if (button.textContent.includes('Pricing')) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                showDemoModal('Request Pricing', 'Pricing information request received! Our team will prepare a customized quote based on your organization\'s size and requirements.');
            });
        }
    });
});

// Counter animation function
function animateCounter(element) {
    const target = element.textContent;
    const isPercentage = target.includes('%');
    const isPlus = target.includes('+');
    const numericValue = parseInt(target.replace(/[^\d]/g, ''));
    
    let current = 0;
    const increment = numericValue / 50; // Animation duration control
    const timer = setInterval(() => {
        current += increment;
        if (current >= numericValue) {
            current = numericValue;
            clearInterval(timer);
        }
        
        let displayValue = Math.floor(current);
        if (isPercentage) {
            displayValue += '%';
        } else if (isPlus) {
            displayValue = displayValue.toLocaleString() + '+';
        } else {
            displayValue = displayValue.toLocaleString();
        }
        
        element.textContent = displayValue;
    }, 20);
}

// Demo modal function
function showDemoModal(title, message) {
    // Create modal overlay
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay';
    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 10000;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    `;
    
    // Create modal content
    const modal = document.createElement('div');
    modal.className = 'modal-content';
    modal.style.cssText = `
        background: white;
        padding: 2rem;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
        text-align: center;
        transform: translateY(50px);
        transition: transform 0.3s ease;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    `;
    
    modal.innerHTML = `
        <div style="margin-bottom: 1.5rem;">
            <i class="fas fa-check-circle" style="font-size: 3rem; color: #10b981; margin-bottom: 1rem;"></i>
            <h3 style="color: #1e293b; margin-bottom: 1rem;">${title}</h3>
            <p style="color: #64748b; line-height: 1.6;">${message}</p>
        </div>
        <button class="btn btn-primary" onclick="closeModal()" style="margin-top: 1rem;">
            Close
        </button>
    `;
    
    overlay.appendChild(modal);
    document.body.appendChild(overlay);
    
    // Animate in
    setTimeout(() => {
        overlay.style.opacity = '1';
        modal.style.transform = 'translateY(0)';
    }, 10);
    
    // Close on overlay click
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            closeModal();
        }
    });
    
    // Store reference for closing
    window.currentModal = overlay;
}

// Close modal function
function closeModal() {
    const modal = window.currentModal;
    if (modal) {
        modal.style.opacity = '0';
        modal.querySelector('.modal-content').style.transform = 'translateY(50px)';
        setTimeout(() => {
            modal.remove();
        }, 300);
    }
}

// Parallax effect for hero section
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const heroImage = document.querySelector('.hero-image img');
    
    if (heroImage && scrolled < window.innerHeight) {
        const rate = scrolled * -0.5;
        heroImage.style.transform = `translateY(${rate}px)`;
    }
});

// Lazy loading for images
function lazyLoadImages() {
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
}

// Initialize lazy loading
document.addEventListener('DOMContentLoaded', lazyLoadImages);

// Keyboard navigation support
document.addEventListener('keydown', function(e) {
    // ESC key closes modal
    if (e.key === 'Escape' && window.currentModal) {
        closeModal();
    }
    
    // Enter key on buttons
    if (e.key === 'Enter' && e.target.classList.contains('btn')) {
        e.target.click();
    }
});

// Touch support for mobile devices
let touchStartY = 0;
let touchEndY = 0;

document.addEventListener('touchstart', function(e) {
    touchStartY = e.changedTouches[0].screenY;
});

document.addEventListener('touchend', function(e) {
    touchEndY = e.changedTouches[0].screenY;
    handleSwipe();
});

function handleSwipe() {
    const swipeThreshold = 50;
    const diff = touchStartY - touchEndY;
    
    if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
            // Swipe up - could trigger scroll to next section
            console.log('Swipe up detected');
        } else {
            // Swipe down - could trigger scroll to previous section
            console.log('Swipe down detected');
        }
    }
}

// Performance optimization - debounce scroll events
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Apply debouncing to scroll events
const debouncedScrollHandler = debounce(function() {
    // Scroll handling logic here
}, 16); // ~60fps

window.addEventListener('scroll', debouncedScrollHandler);

// Add CSS for ripple effect
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
    .btn {
        position: relative;
        overflow: hidden;
    }
    
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .header-scrolled {
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    
    .animate-in {
        animation: slideInUp 0.6s ease-out forwards;
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .feature-card.expanded {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }
    
    @media (max-width: 768px) {
        .feature-card {
            cursor: pointer;
        }
        
        .feature-card::after {
            content: "Tap to view steps";
            display: block;
            text-align: center;
            color: #2563eb;
            font-size: 0.9rem;
            margin-top: 1rem;
            font-weight: 500;
        }
        
        .feature-card.expanded::after {
            content: "Tap to hide steps";
        }
    }
`;

document.head.appendChild(rippleStyle);

// Analytics and tracking (placeholder)
function trackEvent(eventName, properties = {}) {
    // This would integrate with your analytics platform
    console.log('Event tracked:', eventName, properties);
}

// Track button clicks
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn')) {
        trackEvent('button_click', {
            button_text: e.target.textContent.trim(),
            button_type: e.target.className,
            page_section: e.target.closest('section')?.className || 'unknown'
        });
    }
});

// Track feature card interactions
document.addEventListener('click', function(e) {
    const featureCard = e.target.closest('.feature-card');
    if (featureCard) {
        const featureTitle = featureCard.querySelector('h3')?.textContent;
        trackEvent('feature_interaction', {
            feature_name: featureTitle,
            interaction_type: 'card_click'
        });
    }
});

// Page load performance tracking
window.addEventListener('load', function() {
    const loadTime = performance.now();
    trackEvent('page_load', {
        load_time: Math.round(loadTime),
        page_url: window.location.href
    });
});

// Error handling
window.addEventListener('error', function(e) {
    console.error('JavaScript error:', e.error);
    // Could send to error tracking service
});

// Service worker registration for PWA capabilities (optional)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('ServiceWorker registration successful');
            })
            .catch(function(err) {
                console.log('ServiceWorker registration failed');
            });
    });
}