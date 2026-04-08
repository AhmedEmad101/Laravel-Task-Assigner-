<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light gradient-bg">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand text-white fw-bold fs-4" href="{{ url('/home') }}">
                <i class="bi bi-kanban-fill me-2"></i>
                Task Assigner
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ url('/home') }}">
                            <i class="bi bi-house-door me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ url('/subscriptions') }}" method="GET" class="d-inline">
                            @csrf
                            <input type="hidden" name="SubId" id="SubId">
                            <button type="submit" class="nav-link btn btn-link text-light p-0">
                                <i class="bi bi-star me-1"></i> Subscriptions
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ url('/about') }}">
                            <i class="bi bi-info-circle me-1"></i> About
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ url('/Contactindex') }}" method="GET" class="d-inline">
                            @csrf
                            <input type="hidden" name="Contactor" id="ContactorId">
                            <button type="submit" class="nav-link btn btn-link text-light p-0">
                                <i class="bi bi-envelope me-1"></i> Contact
                            </button>
                        </form>
                    </li>
                </ul>
                
                <!-- User Info & Actions -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="userDropdown" 
                           role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            <span id="userName">User</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span class="dropdown-item-text small">
                                    <i class="bi bi-envelope me-2"></i>
                                    <span id="userEmail">user@example.com</span>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ url('/profile') }}" method="GET" class="d-inline w-100">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-person me-2"></i> Profile
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form action="{{ url('/settings') }}" method="GET" class="d-inline w-100">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-gear me-2"></i> Settings
                                    </button>
                                </form>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ url('/logout') }}" method="POST" class="d-inline w-100" id="logoutForm">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- Notification Bell -->
                    <li class="nav-item">
                        <a class="nav-link position-relative text-light" href="{{ url('/notifications') }}">
                            <i class="bi bi-bell"></i>
                            @if(session('task_created') || session('project_created'))
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ (session('task_created') ? 1 : 0) + (session('project_created') ? 1 : 0) }}
                            </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Subscription Status Bar -->
    <div class="bg-dark text-white py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-award-fill me-2 text-warning"></i>
                        <span id="subscriptionStatus" class="small">
                            Loading subscription...
                        </span>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <span id="subscriptionExpiry" class="small"></span>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Fetch and display subscription info
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof userId !== 'undefined' && typeof token !== 'undefined') {
                fetch(`/api/tier/${userId}`, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    if (!response.ok) throw new Error('Subscription fetch failed');
                    return response.json();
                })
                .then(data => {
                    if (data.subscriptionName && data.subscriptionName !== 404) {
                        const tier = data.subscriptionName;
                        const statusElement = document.getElementById('subscriptionStatus');
                        const expiryElement = document.getElementById('subscriptionExpiry');
                        
                        // Update status
                        statusElement.innerHTML = `
                            <strong>${tier.charAt(0).toUpperCase() + tier.slice(1)} Tier</strong>
                        `;
                        
                        // Add tier-specific styling
                        const tierColors = {
                            'gold': 'text-warning',
                            'silver': 'text-secondary',
                            'bronze': 'text-danger'
                        };
                        statusElement.classList.add(tierColors[tier] || 'text-info');
                        
                        // Update expiry
                        if (data.expires_at && expiryElement) {
                            expiryElement.innerHTML = `
                                <i class="bi bi-clock me-1"></i>
                                Expires: ${data.expires_at}
                            `;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching subscription:', error);
                    document.getElementById('subscriptionStatus').textContent = 'Free Tier';
                    document.getElementById('subscriptionStatus').classList.add('text-muted');
                });
            }
        });
    </script>
</header>