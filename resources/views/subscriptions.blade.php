@extends('layouts.app')

@section('title', 'Subscription Plans - TaskFlow')

@section('styles')
<style>
    .subscription-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 100px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .subscription-hero::before {
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
    }
    
    .current-plan-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 20px;
        border-radius: 50px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }
    
    .current-plan-badge .badge {
        margin-left: 10px;
    }
    
    .pricing-container {
        padding: 80px 0;
    }
    
    .pricing-title {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .pricing-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 15px;
    }
    
    .pricing-title p {
        color: #666;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .pricing-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
        border: 2px solid transparent;
    }
    
    .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .pricing-card.popular {
        border-color: var(--primary-color);
        transform: scale(1.05);
    }
    
    .pricing-card.popular:hover {
        transform: scale(1.05) translateY(-10px);
    }
    
    .popular-badge {
        position: absolute;
        top: 0;
        right: 0;
        background: var(--primary-color);
        color: white;
        padding: 8px 25px;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 0 0 0 20px;
    }
    
    .plan-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px dashed #f0f0f0;
    }
    
    .plan-name {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-transform: capitalize;
    }
    
    .plan-price {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 10px;
        line-height: 1;
    }
    
    .plan-duration {
        color: #666;
        font-size: 0.9rem;
    }
    
    .plan-features {
        list-style: none;
        padding: 0;
        margin-bottom: 40px;
    }
    
    .plan-features li {
        padding: 10px 0;
        display: flex;
        align-items: center;
        color: #555;
    }
    
    .plan-features li i {
        margin-right: 10px;
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }
    
    .plan-features li.included i {
        color: #28a745;
    }
    
    .plan-features li.not-included {
        color: #999;
        text-decoration: line-through;
    }
    
    .plan-button {
        display: block;
        width: 100%;
        padding: 15px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-align: center;
        text-decoration: none;
    }
    
    .plan-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .btn-current {
        background: #f8f9fa;
        color: #666;
        cursor: not-allowed;
    }
    
    .btn-upgrade {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
    }
    
    .btn-downgrade {
        background: white;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
    }
    
    /* Tier-specific styling */
    .bronze .plan-name {
        color: #cd7f32;
    }
    
    .silver .plan-name {
        color: #c0c0c0;
    }
    
    .gold .plan-name {
        color: #ffd700;
    }
    
    .bronze .plan-price {
        background: linear-gradient(135deg, #cd7f32, #a66932);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .silver .plan-price {
        background: linear-gradient(135deg, #c0c0c0, #a0a0a0);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .gold .plan-price {
        background: linear-gradient(135deg, #ffd700, #ffaa00);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .bronze .popular-badge,
    .bronze .btn-upgrade {
        background: linear-gradient(135deg, #cd7f32, #a66932);
    }
    
    .silver .popular-badge,
    .silver .btn-upgrade {
        background: linear-gradient(135deg, #c0c0c0, #a0a0a0);
    }
    
    .gold .popular-badge,
    .gold .btn-upgrade {
        background: linear-gradient(135deg, #ffd700, #ffaa00);
    }
    
    .bronze .btn-downgrade {
        border-color: #cd7f32;
        color: #cd7f32;
    }
    
    .silver .btn-downgrade {
        border-color: #c0c0c0;
        color: #c0c0c0;
    }
    
    .gold .btn-downgrade {
        border-color: #ffd700;
        color: #ffaa00;
    }
    
    .comparison-table {
        margin-top: 100px;
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    
    .comparison-title {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .comparison-title h3 {
        color: var(--primary-color);
        font-weight: 700;
    }
    
    .feature-row {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .feature-name {
        flex: 1;
        font-weight: 500;
        color: #333;
    }
    
    .feature-tiers {
        display: flex;
        flex: 2;
        gap: 20px;
    }
    
    .feature-tier {
        flex: 1;
        text-align: center;
        font-weight: 500;
    }
    
    .faq-section {
        margin-top: 100px;
        padding: 80px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
    }
    
    .faq-title {
        text-align: center;
        margin-bottom: 50px;
    }
    
    .faq-title h3 {
        color: var(--primary-color);
        font-weight: 700;
    }
    
    .faq-item {
        margin-bottom: 20px;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .faq-question {
        padding: 20px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #333;
        border: none;
        background: white;
        width: 100%;
        text-align: left;
    }
    
    .faq-question:hover {
        background: #f8f9fa;
    }
    
    .faq-answer {
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        color: #666;
        line-height: 1.6;
    }
    
    .faq-answer.open {
        padding: 0 20px 20px;
        max-height: 500px;
    }
    
    .faq-icon {
        transition: transform 0.3s ease;
    }
    
    .faq-question.active .faq-icon {
        transform: rotate(180deg);
    }
    
    @media (max-width: 992px) {
        .pricing-card.popular {
            transform: none;
        }
        
        .pricing-card.popular:hover {
            transform: translateY(-10px);
        }
    }
    
    @media (max-width: 768px) {
        .subscription-hero {
            padding: 60px 0;
        }
        
        .pricing-title h2 {
            font-size: 2rem;
        }
        
        .plan-price {
            font-size: 2.5rem;
        }
        
        .feature-tiers {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="subscription-hero">
    <div class="container">
        <div class="hero-content">
            <div class="current-plan-badge">
                Your Current Plan: 
                @if(isset($currentSubscription))
                <span class="badge bg-warning text-dark">{{ ucfirst($currentSubscription) }}</span>
                @else
                <span class="badge bg-secondary">Free</span>
                @endif
            </div>
            <h1 class="hero-title display-4 fw-bold mb-4">Choose Your Perfect Plan</h1>
            <p class="hero-subtitle lead mb-0">Upgrade your workflow with powerful features designed for teams of all sizes</p>
        </div>
    </div>
</section>

<!-- Flash Messages -->
<div class="container mt-4">
    @if (session('firstsub'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('firstsub') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    @if (session('alreadysub'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('alreadysub') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
</div>

<!-- Pricing Plans -->
<section class="pricing-container">
    <div class="container">
        <div class="pricing-title">
            <h2>Simple, Transparent Pricing</h2>
            <p>All plans include core features. Upgrade for advanced capabilities and higher limits.</p>
        </div>
        
        <div class="row g-4">
            @foreach ($tier as $index => $t)
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card {{ strtolower($t->name) }} {{ $index == 1 ? 'popular' : '' }}">
                    @if($index == 1)
                    <div class="popular-badge">MOST POPULAR</div>
                    @endif
                    
                    <div class="plan-header">
                        <div class="plan-name">{{ $t->name }}</div>
                        <div class="plan-price">${{ $t->price }}</div>
                        <div class="plan-duration">per year</div>
                    </div>
                    
                    <ul class="plan-features">
                        @if(strtolower($t->name) == 'bronze')
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Up to 5 team members</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> 10 projects</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Basic task management</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Email support</li>
                        <li class="not-included"><i class="bi bi-x-circle"></i> Advanced analytics</li>
                        <li class="not-included"><i class="bi bi-x-circle"></i> Custom workflows</li>
                        @elseif(strtolower($t->name) == 'silver')
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Up to 20 team members</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> 50 projects</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Advanced task management</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Priority support</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Basic analytics</li>
                        <li class="not-included"><i class="bi bi-x-circle"></i> Custom workflows</li>
                        @elseif(strtolower($t->name) == 'gold')
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Unlimited team members</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Unlimited projects</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Premium task management</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> 24/7 phone support</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Advanced analytics</li>
                        <li class="included"><i class="bi bi-check-circle-fill"></i> Custom workflows</li>
                        @endif
                    </ul>
                    
                    <form action="{{ url('Pay/' . $t->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="tier" value="{{ $t->id }}">
                        <input type="hidden" name="UserId" value="{{ Auth::id() ?? '' }}">
                        
                        @php
                            $currentPlan = isset($currentSubscription) ? strtolower($currentSubscription) : 'free';
                            $thisPlan = strtolower($t->name);
                        @endphp
                        
                        @if($currentPlan == $thisPlan)
                        <button type="button" class="plan-button btn-current" disabled>
                            <i class="bi bi-check-circle me-2"></i>Current Plan
                        </button>
                        @elseif($currentPlan == 'free' || ($thisPlan == 'gold' && $currentPlan == 'silver') || ($thisPlan == 'silver' && $currentPlan == 'bronze'))
                        <button type="submit" class="plan-button btn-upgrade">
                            <i class="bi bi-arrow-up-circle me-2"></i>
                            @if($currentPlan == 'free')
                            Get Started
                            @else
                            Upgrade to {{ $t->name }}
                            @endif
                        </button>
                        @else
                        <button type="submit" class="plan-button btn-downgrade">
                            <i class="bi bi-arrow-down-circle me-2"></i>
                            Downgrade to {{ $t->name }}
                        </button>
                        @endif
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Feature Comparison -->
<section class="comparison-table">
    <div class="container">
        <div class="comparison-title">
            <h3>Detailed Feature Comparison</h3>
            <p class="text-muted">See exactly what each plan offers</p>
        </div>
        
        <div class="feature-comparison">
            <div class="feature-row">
                <div class="feature-name">Team Members</div>
                <div class="feature-tiers">
                    <div class="feature-tier bronze">5</div>
                    <div class="feature-tier silver">20</div>
                    <div class="feature-tier gold">Unlimited</div>
                </div>
            </div>
            
            <div class="feature-row">
                <div class="feature-name">Projects</div>
                <div class="feature-tiers">
                    <div class="feature-tier bronze">10</div>
                    <div class="feature-tier silver">50</div>
                    <div class="feature-tier gold">Unlimited</div>
                </div>
            </div>
            
            <div class="feature-row">
                <div class="feature-name">Storage Space</div>
                <div class="feature-tiers">
                    <div class="feature-tier bronze">5 GB</div>
                    <div class="feature-tier silver">50 GB</div>
                    <div class="feature-tier gold">500 GB</div>
                </div>
            </div>
            
            <div class="feature-row">
                <div class="feature-name">API Access</div>
                <div class="feature-tiers">
                    <div class="feature-tier bronze"><i class="bi bi-x-lg text-danger"></i></div>
                    <div class="feature-tier silver"><i class="bi bi-check-lg text-success"></i></div>
                    <div class="feature-tier gold"><i class="bi bi-check-lg text-success"></i></div>
                </div>
            </div>
            
            <div class="feature-row">
                <div class="feature-name">Custom Branding</div>
                <div class="feature-tiers">
                    <div class="feature-tier bronze"><i class="bi bi-x-lg text-danger"></i></div>
                    <div class="feature-tier silver"><i class="bi bi-x-lg text-danger"></i></div>
                    <div class="feature-tier gold"><i class="bi bi-check-lg text-success"></i></div>
                </div>
            </div>
            
            <div class="feature-row">
                <div class="feature-name">Priority Support</div>
                <div class="feature-tiers">
                    <div class="feature-tier bronze"><i class="bi bi-x-lg text-danger"></i></div>
                    <div class="feature-tier silver"><i class="bi bi-check-lg text-success"></i></div>
                    <div class="feature-tier gold"><i class="bi bi-check-lg text-success"></i></div>
                </div>
            </div>
            
            <div class="feature-row">
                <div class="feature-name">SMS Notifications</div>
                <div class="feature-tiers">
                    <div class="feature-tier bronze">100/month</div>
                    <div class="feature-tier silver">1000/month</div>
                    <div class="feature-tier gold">Unlimited</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="faq-title">
            <h3>Frequently Asked Questions</h3>
            <p class="text-muted">Find answers to common questions</p>
        </div>
        
        <div class="accordion" id="faqAccordion">
            <div class="faq-item">
                <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    Can I change my plan later?
                    <i class="bi bi-chevron-down faq-icon"></i>
                </button>
                <div id="faq1" class="collapse faq-answer" data-bs-parent="#faqAccordion">
                    Yes! You can upgrade or downgrade your plan at any time. When you upgrade, you'll get immediate access to new features. When you downgrade, changes take effect at the start of your next billing cycle.
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    Is there a free trial?
                    <i class="bi bi-chevron-down faq-icon"></i>
                </button>
                <div id="faq2" class="collapse faq-answer" data-bs-parent="#faqAccordion">
                    We offer a free plan with basic features. For paid plans, you can start with a 14-day free trial. No credit card required to start the trial.
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    What payment methods do you accept?
                    <i class="bi bi-chevron-down faq-icon"></i>
                </button>
                <div id="faq3" class="collapse faq-answer" data-bs-parent="#faqAccordion">
                    We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and in some regions, bank transfers. All payments are processed securely through our payment partners.
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                    Can I cancel anytime?
                    <i class="bi bi-chevron-down faq-icon"></i>
                </button>
                <div id="faq4" class="collapse faq-answer" data-bs-parent="#faqAccordion">
                    Absolutely! You can cancel your subscription at any time. After cancellation, you'll continue to have access to paid features until the end of your current billing period.
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                    Do you offer discounts for non-profits or education?
                    <i class="bi bi-chevron-down faq-icon"></i>
                </button>
                <div id="faq5" class="collapse faq-answer" data-bs-parent="#faqAccordion">
                    Yes! We offer special discounts for registered non-profit organizations and educational institutions. Contact our sales team at sales@taskflow.com for more information.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="text-center py-5">
            <h3 class="mb-4">Still have questions?</h3>
            <p class="text-muted mb-4">Our team is here to help you choose the right plan for your needs.</p>
            <a href="{{ url('/Contactindex') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-envelope me-2"></i>Contact Sales
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize user data
    if (typeof userId !== 'undefined') {
        document.querySelectorAll('input[name="UserId"]').forEach(input => {
            input.value = userId;
        });
    }
    
    // FAQ toggle animation
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });
    
    // Plan card hover effects
    const planCards = document.querySelectorAll('.pricing-card');
    planCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            if (!this.classList.contains('popular')) {
                this.style.zIndex = '10';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '';
        });
    });
    
    // Smooth scroll for comparison table
    const comparisonRows = document.querySelectorAll('.feature-row');
    comparisonRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.1}s`;
        row.classList.add('animate-on-scroll');
    });
});
</script>
@endsection