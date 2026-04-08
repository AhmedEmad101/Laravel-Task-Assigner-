<x-guest-layout>
    <style>
        :root {
            --primary-color: #4facfe;
            --secondary-color: #00f2fe;
            --dark-color: #2c3e50;
            --accent-color: #667eea;
            --success-color: #28a745;
        }

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .register-container::before {
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

        .register-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

        .register-card::-webkit-scrollbar {
            width: 8px;
        }

        .register-card::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .register-card::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
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

        .register-header {
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

        .register-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 5px;
        }

        .register-header p {
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

        .password-strength {
            margin-top: 8px;
        }

        .strength-bar {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-bar-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-text {
            font-size: 0.7rem;
            color: #666;
        }

        .strength-text.weak {
            color: #dc3545;
        }

        .strength-text.medium {
            color: #ffc107;
        }

        .strength-text.strong {
            color: #28a745;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 25px;
        }

        .terms-checkbox input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            cursor: pointer;
            accent-color: var(--primary-color);
        }

        .terms-checkbox label {
            font-size: 0.85rem;
            color: #666;
            cursor: pointer;
            line-height: 1.4;
        }

        .terms-checkbox a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .terms-checkbox a:hover {
            text-decoration: underline;
        }

        .register-btn {
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

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 172, 254, 0.3);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .register-btn i {
            font-size: 1.2rem;
        }

        .login-section {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .login-section p {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0;
        }

        .login-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link:hover {
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

        .alert-error-custom {
            background: linear-gradient(135deg, #fbc2c2, #ff9a9e);
            color: #c0392b;
        }

        /* Loading state */
        .register-btn.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .register-card {
                margin: 20px;
                padding: 30px 25px;
                max-height: 85vh;
            }

            .logo-container {
                width: 60px;
                height: 60px;
            }

            .logo-container i {
                font-size: 1.8rem;
            }

            .register-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="logo-container">
                    <i class="bi bi-check2-square"></i>
                </div>
                <h2>Task Assigner</h2>
                <p>Create your account to start managing tasks</p>
            </div>

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

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name">
                        <i class="bi bi-person"></i> Full Name
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-person-fill"></i>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               placeholder="Enter your full name"
                               required 
                               autofocus 
                               autocomplete="name">
                    </div>
                </div>

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
                               placeholder="Create a password"
                               required 
                               autocomplete="new-password">
                        <span class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="bi bi-eye-slash" id="toggleIcon1"></i>
                        </span>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-bar-fill" id="strengthBar"></div>
                        </div>
                        <div class="strength-text" id="strengthText"></div>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">
                        <i class="bi bi-check-circle"></i> Confirm Password
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-shield-lock-fill"></i>
                        <input id="password_confirmation" 
                               type="password" 
                               name="password_confirmation" 
                               placeholder="Confirm your password"
                               required 
                               autocomplete="new-password">
                        <span class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                            <i class="bi bi-eye-slash" id="toggleIcon2"></i>
                        </span>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        I agree to the <a href="#" onclick="return false;">Terms of Service</a> and 
                        <a href="#" onclick="return false;">Privacy Policy</a>
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit" class="register-btn" id="registerBtn">
                    <i class="bi bi-person-plus"></i>
                    <span>Create Account</span>
                </button>

                <!-- Features -->
                <div class="features">
                    <div class="feature-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Task Assignment</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-people"></i>
                        <span>Team Management</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-graph-up"></i>
                        <span>Progress Tracking</span>
                    </div>
                </div>

                <!-- Login Section -->
                <div class="login-section">
                    <p>Already have an account? 
                        <a href="{{ route('login') }}" class="login-link">
                            Sign In <i class="bi bi-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId, iconId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(iconId);
            
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

        // Password strength checker
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = checkPasswordStrength(password);
                
                let width = '0%';
                let text = '';
                let color = '';
                
                switch(strength) {
                    case 0:
                        width = '0%';
                        text = 'Enter a password';
                        color = '#e9ecef';
                        break;
                    case 1:
                        width = '25%';
                        text = 'Weak password';
                        color = '#dc3545';
                        break;
                    case 2:
                        width = '50%';
                        text = 'Fair password';
                        color = '#ffc107';
                        break;
                    case 3:
                        width = '75%';
                        text = 'Good password';
                        color = '#17a2b8';
                        break;
                    case 4:
                        width = '100%';
                        text = 'Strong password!';
                        color = '#28a745';
                        break;
                }
                
                strengthBar.style.width = width;
                strengthBar.style.backgroundColor = color;
                strengthText.textContent = text;
                strengthText.className = `strength-text ${strength <= 1 ? 'weak' : (strength === 2 ? 'medium' : 'strong')}`;
            });
        }

        function checkPasswordStrength(password) {
            let strength = 0;
            
            if (password.length === 0) return 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/\d/)) strength++;
            if (password.match(/[^a-zA-Z\d]/)) strength++;
            
            return strength;
        }

        // Password confirmation validation
        const confirmPassword = document.getElementById('password_confirmation');
        
        if (confirmPassword && passwordInput) {
            confirmPassword.addEventListener('input', function() {
                if (passwordInput.value !== this.value) {
                    this.setCustomValidity('Passwords do not match');
                } else {
                    this.setCustomValidity('');
                }
            });
            
            passwordInput.addEventListener('input', function() {
                if (confirmPassword.value && this.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity('Passwords do not match');
                } else {
                    confirmPassword.setCustomValidity('');
                }
            });
        }

        // Form submission with validation
        const registerForm = document.getElementById('registerForm');
        const registerBtn = document.getElementById('registerBtn');
        const termsCheckbox = document.getElementById('terms');
        
        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const confirmPwd = document.getElementById('password_confirmation').value;
                
                // Validate name
                if (!name || name.trim().length < 2) {
                    e.preventDefault();
                    showError('Please enter your full name');
                    return;
                }
                
                // Validate email
                if (!email || !validateEmail(email)) {
                    e.preventDefault();
                    showError('Please enter a valid email address');
                    return;
                }
                
                // Validate password strength
                if (password.length < 6) {
                    e.preventDefault();
                    showError('Password must be at least 6 characters');
                    return;
                }
                
                // Validate password match
                if (password !== confirmPwd) {
                    e.preventDefault();
                    showError('Passwords do not match');
                    return;
                }
                
                // Validate terms
                if (!termsCheckbox.checked) {
                    e.preventDefault();
                    showError('You must agree to the Terms of Service');
                    return;
                }
                
                // Show loading state
                registerBtn.classList.add('loading');
                registerBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Creating account...';
                registerBtn.disabled = true;
            });
        }
        
        // Email validation helper
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
        // Show error message function
        function showError(message) {
            let errorContainer = document.querySelector('.alert-error-custom');
            if (!errorContainer) {
                errorContainer = document.createElement('div');
                errorContainer.className = 'alert-custom alert-error-custom';
                const form = document.getElementById('registerForm');
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
        });
    </script>
</x-guest-layout>