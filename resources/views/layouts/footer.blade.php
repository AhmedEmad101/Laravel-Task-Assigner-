<footer class="bg-dark text-white mt-auto">
    <div class="container py-4">
        <div class="row">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-warning mb-3">
                    <i class="bi bi-kanban"></i> TaskFlow
                </h5>
                <p class="text-light small">
                    Streamline your workflow and achieve more with our comprehensive task management solution.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-github"></i></a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-warning mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ url('/home') }}" class="text-light text-decoration-none">
                            <i class="bi bi-chevron-right me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="mb-2">
                        <form action="{{ url('/subscriptions') }}" method="GET" class="d-inline">
                            @csrf
                            <input type="hidden" name="SubId" id="SubId">
                            <button type="submit" class="btn btn-link text-light text-decoration-none p-0">
                                <i class="bi bi-chevron-right me-1"></i> Subscriptions
                            </button>
                        </form>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/about') }}" class="text-light text-decoration-none">
                            <i class="bi bi-chevron-right me-1"></i> About Us
                        </a>
                    </li>
                    <li class="mb-2">
                        <form action="{{ url('/Contactindex') }}" method="GET" class="d-inline">
                            @csrf
                            <input type="hidden" name="Contactor" id="ContactorId">
                            <button type="submit" class="btn btn-link text-light text-decoration-none p-0">
                                <i class="bi bi-chevron-right me-1"></i> Contact
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            
            <!-- Resources -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="text-warning mb-3">Resources</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ url('/documentation') }}" class="text-light text-decoration-none">
                            <i class="bi bi-file-text me-1"></i> Documentation
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/faq') }}" class="text-light text-decoration-none">
                            <i class="bi bi-question-circle me-1"></i> FAQ
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/blog') }}" class="text-light text-decoration-none">
                            <i class="bi bi-journal-text me-1"></i> Blog
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/support') }}" class="text-light text-decoration-none">
                            <i class="bi bi-headset me-1"></i> Support
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h6 class="text-warning mb-3">Contact Us</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        <span class="text-light">support@taskflow.com</span>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        <span class="text-light">+1 (555) 123-4567</span>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i>
                        <span class="text-light">123 Business St, City, State 12345</span>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-clock me-2"></i>
                        <span class="text-light">Mon - Fri: 9:00 AM - 6:00 PM</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <hr class="bg-light">
        
        <!-- Copyright -->
        <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <p class="mb-0 text-light small">
                    &copy; {{ date('Y') }} TaskFlow Dashboard. All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ url('/privacy') }}" class="text-light text-decoration-none me-3 small">Privacy Policy</a>
                <a href="{{ url('/terms') }}" class="text-light text-decoration-none small">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>