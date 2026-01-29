@extends('layouts.app')

@section('title', 'About Us - TaskFlow')

@section('styles')
<style>
    .about-hero {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
        margin-bottom: 60px;
    }
    
    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.1;
    }
    
    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    
    .hero-subtitle {
        font-size: 1.25rem;
        opacity: 0.9;
        line-height: 1.6;
    }
    
    .about-section {
        margin-bottom: 80px;
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 50px;
        position: relative;
    }
    
    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        display: inline-block;
        padding-bottom: 15px;
    }
    
    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        border-radius: 2px;
    }
    
    .team-member-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: none;
    }
    
    .team-member-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .member-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        object-position: top;
        transition: transform 0.5s ease;
    }
    
    .team-member-card:hover .member-image {
        transform: scale(1.05);
    }
    
    .member-info {
        padding: 25px;
        text-align: center;
    }
    
    .member-name {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .member-role {
        color: var(--primary-color);
        font-weight: 500;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }
    
    .member-bio {
        color: #666;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    .member-social {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }
    
    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #f8f9fa;
        border-radius: 50%;
        color: #666;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .social-icon:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-3px);
    }
    
    .mission-values {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 80px 0;
        border-radius: 20px;
        margin: 80px 0;
    }
    
    .value-card {
        text-align: center;
        padding: 30px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        height: 100%;
        transition: all 0.3s ease;
    }
    
    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .value-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        color: white;
        font-size: 2rem;
    }
    
    .value-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }
    
    .value-description {
        color: #666;
        line-height: 1.6;
    }
    
    .stats-section {
        background: white;
        padding: 60px 0;
        border-radius: 20px;
        margin: 60px 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    
    .stat-item {
        text-align: center;
        padding: 20px;
    }
    
    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 10px;
        line-height: 1;
    }
    
    .stat-label {
        color: #666;
        font-size: 1.1rem;
        font-weight: 500;
    }
    
    .cta-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 80px 0;
        border-radius: 20px;
        text-align: center;
        margin-top: 80px;
    }
    
    .cta-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .cta-description {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 40px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .btn-cta {
        background: white;
        color: var(--primary-color);
        border: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    
    .btn-cta:hover {
        background: #f8f9fa;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    
    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-on-scroll {
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
    }
    
    .team-member-card {
        animation-delay: calc(var(--item-index) * 0.2s);
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .section-title h2 {
            font-size: 2rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
        }
        
        .cta-title {
            font-size: 2rem;
        }
        
        .member-image {
            height: 250px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="about-hero">
    <div class="container">
        <div class="hero-content animate-on-scroll">
            <h1 class="hero-title">
                Welcome, <span id="userName" class="text-warning">{{ Auth::user()->name ?? 'Guest' }}</span>!
            </h1>
            <p class="hero-subtitle">
                At TaskFlow, we're passionate about transforming how teams collaborate, manage projects, 
                and achieve their goals through intuitive task management solutions.
            </p>
        </div>
    </div>
</section>

<!-- Mission & Values -->
<section class="mission-values">
    <div class="container">
        <div class="section-title animate-on-scroll">
            <h2>Our Mission & Values</h2>
            <p class="text-muted mt-3">What drives us every day</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="value-card animate-on-scroll">
                    <div class="value-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3 class="value-title">Our Mission</h3>
                    <p class="value-description">
                        To empower teams of all sizes with powerful yet simple task management tools 
                        that streamline workflows, enhance productivity, and foster collaboration.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="value-card animate-on-scroll">
                    <div class="value-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <h3 class="value-title">Innovation</h3>
                    <p class="value-description">
                        Continuously evolving our platform with cutting-edge features while 
                        maintaining simplicity and user-friendly interfaces.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="value-card animate-on-scroll">
                    <div class="value-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="value-title">Collaboration</h3>
                    <p class="value-description">
                        Building tools that break down silos and enable seamless teamwork, 
                        communication, and shared success.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="about-section">
    <div class="container">
        <div class="section-title animate-on-scroll">
            <h2>Meet Our Team</h2>
            <p class="text-muted mt-3">The brilliant minds behind TaskFlow</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <!-- YOUR ORIGINAL CARD WITH ENHANCEMENTS -->
            <div class="col-lg-4 col-md-6">
                <div class="team-member-card animate-on-scroll" style="--item-index: 0;">
                    <div class="member-image-container">
                        <img src="{{ asset('AhmedEmad.jpg') }}" alt="Ahmed Emad" class="member-image">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Ahmed Emad</h3>
                        <div class="member-role">Laravel Backend Developer</div>
                        <p class="member-bio">
                            Experienced Laravel developer specializing in building robust, scalable web applications. 
                            Passionate about clean code, efficient algorithms, and creating seamless user experiences.
                        </p>
                        <div class="member-skills">
                            <span class="badge bg-primary me-1">Laravel</span>
                            <span class="badge bg-primary me-1">PHP</span>
                            <span class="badge bg-primary me-1">MySQL</span>
                            <span class="badge bg-primary">API Development</span>
                        </div>
                        <div class="member-social">
                            <a href="#" class="social-icon">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-github"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Additional Team Members (Optional - can remove if you want just your card) -->
            <div class="col-lg-4 col-md-6">
                <div class="team-member-card animate-on-scroll" style="--item-index: 1;">
                    <div class="member-image-container">
                        <img src="{{ asset('images/placeholder-developer.jpg') }}" alt="Frontend Developer" class="member-image">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Sarah Johnson</h3>
                        <div class="member-role">Frontend Developer</div>
                        <p class="member-bio">
                            UI/UX enthusiast with expertise in modern JavaScript frameworks. 
                            Focused on creating intuitive, responsive, and beautiful user interfaces.
                        </p>
                        <div class="member-skills">
                            <span class="badge bg-success me-1">Vue.js</span>
                            <span class="badge bg-success me-1">React</span>
                            <span class="badge bg-success me-1">Tailwind</span>
                            <span class="badge bg-success">TypeScript</span>
                        </div>
                        <div class="member-social">
                            <a href="#" class="social-icon">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-github"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-dribbble"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="team-member-card animate-on-scroll" style="--item-index: 2;">
                    <div class="member-image-container">
                        <img src="{{ asset('images/placeholder-designer.jpg') }}" alt="UI/UX Designer" class="member-image">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Michael Chen</h3>
                        <div class="member-role">UI/UX Designer</div>
                        <p class="member-bio">
                            Creative designer focused on user-centered design principles. 
                            Transforms complex workflows into simple, engaging user experiences.
                        </p>
                        <div class="member-skills">
                            <span class="badge bg-warning me-1 text-dark">Figma</span>
                            <span class="badge bg-warning me-1 text-dark">Adobe XD</span>
                            <span class="badge bg-warning me-1 text-dark">UI Design</span>
                            <span class="badge bg-warning text-dark">UX Research</span>
                        </div>
                        <div class="member-social">
                            <a href="#" class="social-icon">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-behance"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="stat-item animate-on-scroll">
                    <div class="stat-number" data-count="5000">0</div>
                    <div class="stat-label">Active Users</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-item animate-on-scroll">
                    <div class="stat-number" data-count="1500">0</div>
                    <div class="stat-label">Teams Created</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-item animate-on-scroll">
                    <div class="stat-number" data-count="25000">0</div>
                    <div class="stat-label">Tasks Managed</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-item animate-on-scroll">
                    <div class="stat-number" data-count="99.9">0</div>
                    <div class="stat-label">Uptime %</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section animate-on-scroll">
    <div class="container">
        <h2 class="cta-title">Ready to Transform Your Workflow?</h2>
        <p class="cta-description">
            Join thousands of teams who have already simplified their task management 
            and boosted their productivity with TaskFlow.
        </p>
        <a href="{{ url('/home') }}" class="btn btn-cta">
            <i class="bi bi-rocket-takeoff"></i>
            Get Started Today
        </a>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update user name in hero section
    if (typeof userEmail !== 'undefined') {
        const name = userEmail.split('@')[0];
        const userName = name.charAt(0).toUpperCase() + name.slice(1);
        document.getElementById('userName').textContent = userName;
    }
    
    // Animate on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe all animate-on-scroll elements
    document.querySelectorAll('.animate-on-scroll').forEach(element => {
        element.style.animationPlayState = 'paused';
        observer.observe(element);
    });
    
    // Animate statistics counters
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-count'));
        const suffix = stat.textContent.includes('%') ? '%' : '';
        const increment = target / 100;
        let current = 0;
        
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                if (current > target) current = target;
                
                if (suffix === '%') {
                    stat.textContent = current.toFixed(1) + suffix;
                } else {
                    stat.textContent = Math.floor(current).toLocaleString() + suffix;
                }
                
                requestAnimationFrame(updateCounter);
            }
        };
        
        // Start animation when element comes into view
        const statObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCounter();
                    statObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        statObserver.observe(stat);
    });
    
    // Initialize tooltips for team member skills
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection