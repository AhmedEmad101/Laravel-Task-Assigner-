<x-guest-layout>
    <style>
        :root {
            --primary-color: #4facfe;
            --secondary-color: #00f2fe;
            --dark-color: #2c3e50;
            --accent-color: #667eea;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            100% {
                transform: translate(50px, 50px) rotate(10deg);
            }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-container {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 25px rgba(79, 172, 254, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .logo-container i {
            font-size: 2.5rem;
            color: white;
        }

        .login-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 5px;
        }

        .login-header p {
            color: #666;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
        }

        .form-group label i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
        }

        .input-wrapper input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
            outline: none;
        }

        .input-wrapper input:focus + i {
            color: var(--primary-color);
        }

        .input-wrapper input.error {
            border-color: #dc3545;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .checkbox-wrapper input {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
            accent-color: var(--primary-color);
        }

        .checkbox-wrapper span {
            font-size: 0.85rem;
            color: #666;
        }

        .forgot-link {
            font-size: 0.85rem;
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 172, 254, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn i {
            font-size: 1.2rem;
        }

        .register-section {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .register-section p {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0;
        }

        .register-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .error-message i {
            font-size: 0.8rem;
        }

        /* Features section */
        .features {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .feature-item {
            text-align: center;
            flex: 1;
            min-width: 80px;
        }

        .feature-item i {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 5px;
            display: block;
        }

        .feature-item span {
            font-size: 0.7rem;
            color: #888;
        }

        /* Alert customization */
        .alert-custom {
            border-radius: 12px;
            border: none;
            padding: 12px 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-custom i {
            font-size: 1.1rem;
        }

        .alert-success-custom {
            background: linear-gradient(135deg, #d4fc79, #96e6a1);
            color: #2d6a4f;
        }

        .alert-error-custom {
            background: linear-gradient(135deg, #fbc2c2, #ff9a9e);
            color: #c0392b;
        }

        /* Loading state */
        .login-btn.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .login-card {
                margin: 20px;
                padding: 30px 25px;
            }

            .logo-container {
                width: 60px;
                height: 60px;
            }

            .logo-container i {
                font-size: 1.8rem;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <i class="bi bi-check2-square"></i>
                </div>
                <h2>Task Assigner</h2>
                <p>Your ultimate task management solution</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert-custom alert-success-custom">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert-custom alert-error-custom">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">
                        <i class="bi bi-envelope"></i> Email Address
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-envelope-fill"></i>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Enter your email"
                               required 
                               autofocus 
                               autocomplete="username">
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">
                        <i class="bi bi-lock"></i> Password
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock-fill"></i>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               placeholder="Enter your password"
                               required 
                               autocomplete="current-password">
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="remember-forgot">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="remember" id="remember_me">
                        <span>Remember me</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            <i class="bi bi-question-circle"></i> Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" class="login-btn" id="loginBtn">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login to Task Assigner</span>
                </button>

                <!-- Features -->
                <div class="features">
                    <div class="feature-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Task Management</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-people"></i>
                        <span>Team Collaboration</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-graph-up"></i>
                        <span>Progress Tracking</span>
                    </div>
                </div>

                <!-- Register Section -->
                <div class="register-section">
                    <p>Don't have an account? 
                        <a href="{{ route('register') }}" class="register-link">
                            Create Account <i class="bi bi-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        }

        // Form submission with loading state
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                
                // Basic validation
                if (!email || !password) {
                    e.preventDefault();
                    showError('Please fill in all fields');
                    return;
                }
                
                if (!validateEmail(email)) {
                    e.preventDefault();
                    showError('Please enter a valid email address');
                    return;
                }
                
                // Show loading state
                loginBtn.classList.add('loading');
                loginBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Logging in...';
                loginBtn.disabled = true;
            });
        }
        
        // Email validation helper
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
        // Show error message function (can be enhanced with SweetAlert)
        function showError(message) {
            // Check if error container exists, if not create one
            let errorContainer = document.querySelector('.alert-error-custom');
            if (!errorContainer) {
                errorContainer = document.createElement('div');
                errorContainer.className = 'alert-custom alert-error-custom';
                const form = document.getElementById('loginForm');
                form.insertBefore(errorContainer, form.firstChild);
            }
            
            errorContainer.innerHTML = `
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>${message}</span>
            `;
            errorContainer.style.display = 'flex';
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                errorContainer.style.display = 'none';
            }, 5000);
        }
        
        // Add animation to form elements on load
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.input-wrapper input');
            inputs.forEach((input, index) => {
                input.style.animation = `slideUp 0.5s ease ${index * 0.1}s backwards`;
            });
            
            // Auto-focus on email field
            document.getElementById('email').focus();
        });
        
        // Store user login attempt for analytics (optional)
        function trackLoginAttempt(email, success) {
            console.log(`Login attempt for ${email}: ${success ? 'successful' : 'failed'}`);
            // You can send this to your analytics service
        }
    </script>
</x-guest-layout>