document.addEventListener('DOMContentLoaded', function() {
    // Animate cards on dashboard and other pages
    const animatedCards = document.querySelectorAll('.card');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    animatedCards.forEach(card => {
        observer.observe(card);
    });

    // --- Dark Mode Toggle ---
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeIcon = document.getElementById('darkModeIcon');
    const htmlEl = document.documentElement;

    // Set initial icon based on theme
    if (localStorage.getItem('theme') === 'dark') {
        darkModeIcon.classList.remove('fa-moon');
        darkModeIcon.classList.add('fa-sun');
    }

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            htmlEl.classList.toggle('dark-mode');
            if (htmlEl.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                darkModeIcon.classList.replace('fa-moon', 'fa-sun');
            } else {
                localStorage.setItem('theme', 'light');
                darkModeIcon.classList.replace('fa-sun', 'fa-moon');
            }
        });
    }

    // --- Sidebar Toggle Logic ---
    const sidebarCollapse = document.getElementById('sidebarCollapse');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.querySelector('.overlay');
    const sidebarIcon = document.getElementById('sidebarIcon');

    if (sidebarCollapse && sidebar && overlay && sidebarIcon) {
        sidebarCollapse.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');

            // Toggle icon class
            if (sidebar.classList.contains('active')) {
                sidebarIcon.classList.remove('fa-bars');
                sidebarIcon.classList.add('fa-times');
            } else {
                sidebarIcon.classList.remove('fa-times');
                sidebarIcon.classList.add('fa-bars');
            }
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            // Reset icon when overlay is clicked
            sidebarIcon.classList.remove('fa-times');
            sidebarIcon.classList.add('fa-bars');
        });
    }

    // --- GSAP Interactive Backgrounds ---
    const canvas = document.getElementById('motion-canvas');
    if (canvas && typeof gsap === 'undefined') {
        let gsapScript = document.createElement('script');
        gsapScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js';
        gsapScript.onload = () => initializeCanvasAnimation(canvas);
        document.head.appendChild(gsapScript);
    } else if (canvas) {
        initializeCanvasAnimation(canvas);
    }

    function initializeCanvasAnimation(canvas) {
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let width, height, particles;
        let animationRunning = false;

        // --- Light Mode: Plexus Animation ---
        const lightModeAnimation = {
            connectDistance: 150,
            hue: 0,
            init: function() {
                particles = [];
                const particleCount = Math.floor((width * height) / 12000);
                for (let i = 0; i < particleCount; i++) {
                    particles.push(this.createParticle());
                }
            },
            createParticle: function(x, y) {
                return {
                    x: x ?? Math.random() * width,
                    y: y ?? Math.random() * height,
                    vx: gsap.utils.random(-0.5, 0.5),
                    vy: gsap.utils.random(-0.5, 0.5),
                    radius: gsap.utils.random(1, 2.5),
                    color: `hsla(${Math.random() * 360}, 100%, 70%, ${gsap.utils.random(0.3, 0.8)})`,
                };
            },
            draw: function() {
                ctx.clearRect(0, 0, width, height);
                this.hue = (this.hue + 0.5) % 360;
                for (let i = 0; i < particles.length; i++) {
                    const p = particles[i];
                    p.x += p.vx; p.y += p.vy;
                    if (p.x < -p.radius) p.x = width + p.radius; else if (p.x > width + p.radius) p.x = -p.radius;
                    if (p.y < -p.radius) p.y = height + p.radius; else if (p.y > height + p.radius) p.y = -p.radius;
                    ctx.beginPath(); ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2); ctx.fillStyle = p.color; ctx.fill();
                    for (let j = i + 1; j < particles.length; j++) {
                        const p2 = particles[j];
                        const dist = Math.sqrt((p.x - p2.x)**2 + (p.y - p2.y)**2);
                        if (dist < this.connectDistance) {
                            ctx.beginPath(); ctx.moveTo(p.x, p.y); ctx.lineTo(p2.x, p2.y); ctx.lineWidth = 1;
                            ctx.strokeStyle = `hsla(${this.hue}, 100%, 70%, ${1 - dist / this.connectDistance})`;
                            ctx.stroke();
                        }
                    }
                }
            },
            handleClick: function(e) {
                const burstCount = 20;
                for (let i = 0; i < burstCount; i++) {
                    particles.push(this.createParticle(e.clientX + gsap.utils.random(-15, 15), e.clientY + gsap.utils.random(-15, 15)));
                }
            }
        };

        // --- Dark Mode: Fireflies Animation ---
        const darkModeAnimation = {
            init: function() {
                particles = [];
                const particleCount = Math.floor((width * height) / 15000);
                for (let i = 0; i < particleCount; i++) {
                    particles.push(this.createParticle());
                }
            },
            createParticle: function() {
                const p = {
                    x: Math.random() * width,
                    y: Math.random() * height,
                    vx: gsap.utils.random(-0.3, 0.3),
                    vy: gsap.utils.random(-0.3, 0.3),
                    radius: gsap.utils.random(1, 2),
                    color: `hsla(${gsap.utils.random(40, 60)}, 100%, 80%, 0)`, // Start invisible
                };
                // Animate opacity for twinkling effect
                gsap.to(p, {
                    color: `hsla(${gsap.utils.random(40, 60)}, 100%, 80%, ${gsap.utils.random(0.2, 0.9)})`,
                    duration: gsap.utils.random(2, 5),
                    repeat: -1,
                    yoyo: true,
                    ease: "power1.inOut"
                });
                return p;
            },
            draw: function() {
                ctx.clearRect(0, 0, width, height);
                for (let i = 0; i < particles.length; i++) {
                    const p = particles[i];
                    p.x += p.vx; p.y += p.vy;
                    if (p.x < -p.radius) p.x = width + p.radius; else if (p.x > width + p.radius) p.x = -p.radius;
                    if (p.y < -p.radius) p.y = height + p.radius; else if (p.y > height + p.radius) p.y = -p.radius;
                    ctx.beginPath(); ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                    ctx.fillStyle = p.color;
                    ctx.fill();
                }
            },
            handleClick: function(e) {
                // Gentle ripple effect on click
                particles.forEach(p => {
                    const dist = Math.sqrt((p.x - e.clientX)**2 + (p.y - e.clientY)**2);
                    if (dist < 100) {
                        const force = (100 - dist) / 100;
                        const angle = Math.atan2(p.y - e.clientY, p.x - e.clientX);
                        gsap.to(p, {
                            x: p.x + Math.cos(angle) * force * 25,
                            y: p.y + Math.sin(angle) * force * 25,
                            duration: 0.5,
                            ease: "power2.out"
                        });
                    }
                });
            }
        };

        let currentAnimation;

        function setupAnimation() {
            if (animationRunning) {
                gsap.ticker.remove(currentAnimation.draw.bind(currentAnimation));
                window.removeEventListener('click', currentAnimation.handleClick);
            }

            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = width;
            canvas.height = height;

            currentAnimation = document.documentElement.classList.contains('dark-mode') ? darkModeAnimation : lightModeAnimation;
            currentAnimation.init();
            gsap.ticker.add(currentAnimation.draw.bind(currentAnimation));
            window.addEventListener('click', currentAnimation.handleClick.bind(currentAnimation));
            animationRunning = true;
        }

        setupAnimation();
        window.addEventListener('resize', setupAnimation);
        darkModeToggle.addEventListener('click', setupAnimation); // Re-setup animation on theme change
    }}

    // --- Delete Confirmation Modal Logic ---
    const deleteModal = document.getElementById('deleteConfirmationModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract user ID from data-* attributes
            const userId = button.getAttribute('data-user-id');
            // Find the confirm button inside the modal
            const confirmButton = deleteModal.querySelector('#confirmDeleteButton');
            // Update the href of the confirm button
            confirmButton.href = `../delete/user?id=${userId}`;
        });
    }
});