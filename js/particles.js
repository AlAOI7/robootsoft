// Particles Background for Hero Section
(function() {
    const canvas = document.getElementById('hero-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationFrameId;
    
    // Mouse coords
    let mouse = {
        x: null,
        y: null,
        radius: 150
    };

    function resizeCanvas() {
        const parent = canvas.parentElement;
        canvas.width = parent.clientWidth;
        canvas.height = parent.clientHeight;
        initParticles();
    }

    class Particle {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.vx = (Math.random() - 0.5) * 0.8;
            this.vy = (Math.random() - 0.5) * 0.8;
            this.radius = Math.random() * 2.5 + 1;
        }

        draw() {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = isDark ? 'rgba(59, 130, 246, 0.6)' : 'rgba(37, 99, 235, 0.4)';
            ctx.fill();
        }

        update() {
            // Collision check with canvas boundary
            if (this.x < 0 || this.x > canvas.width) this.vx = -this.vx;
            if (this.y < 0 || this.y > canvas.height) this.vy = -this.vy;

            this.x += this.vx;
            this.y += this.vy;

            // Mouse interaction (pull/push effect)
            if (mouse.x !== null && mouse.y !== null) {
                let dx = mouse.x - this.x;
                let dy = mouse.y - this.y;
                let dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < mouse.radius) {
                    const force = (mouse.radius - dist) / mouse.radius;
                    this.x -= dx / dist * force * 1.5;
                    this.y -= dy / dist * force * 1.5;
                }
            }
        }
    }

    function initParticles() {
        particles = [];
        const quantity = Math.floor((canvas.width * canvas.height) / 11000);
        // Constrain quantity to look nice on all screens
        const particleCount = Math.min(Math.max(quantity, 30), 120);
        
        for (let i = 0; i < particleCount; i++) {
            const x = Math.random() * canvas.width;
            const y = Math.random() * canvas.height;
            particles.push(new Particle(x, y));
        }
    }

    function connectParticles() {
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        const lineColor = isDark ? 'rgba(59, 130, 246, 0.08)' : 'rgba(37, 99, 235, 0.06)';
        const maxDist = 120;

        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                let dx = particles[i].x - particles[j].x;
                let dy = particles[i].y - particles[j].y;
                let dist = Math.sqrt(dx * dx + dy * dy);

                if (dist < maxDist) {
                    ctx.beginPath();
                    ctx.strokeStyle = lineColor;
                    ctx.lineWidth = (1 - dist / maxDist) * 1.2;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        particles.forEach(p => {
            p.update();
            p.draw();
        });
        
        connectParticles();
        animationFrameId = requestAnimationFrame(animate);
    }

    // Set listeners
    window.addEventListener('resize', resizeCanvas);
    
    const parentSection = canvas.parentElement;
    parentSection.addEventListener('mousemove', (e) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    });

    parentSection.addEventListener('mouseleave', () => {
        mouse.x = null;
        mouse.y = null;
    });

    // Start
    resizeCanvas();
    animate();
})();
