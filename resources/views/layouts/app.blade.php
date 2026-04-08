<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Assigner Dashboard')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --light-bg: #f8f9fa;
            --card-shadow: 0 8px 25px rgba(0,0,0,0.08);
            --hover-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding-top: 20px;
        }

        /* Alert styling */
        .alert-success {
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #38b000 0%, #2d9100 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(56, 176, 0, 0.2);
        }

        .alert-info {
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #4cc9f0 0%, #4361ee 100%);
            color: white;
        }

        .alert-warning {
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #ffd166 0%, #ff9e00 100%);
            color: #333;
        }

        .alert-danger {
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #ff4757 0%, #ff3742 100%);
            color: white;
        }

        /* Custom utility classes */
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 25px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }

        .card-hover {
            transition: all 0.3s ease;
            box-shadow: var(--card-shadow);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>
    
    @yield('styles')
    
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Your Auth Scripts -->
    <script src="{{ asset('js/Auth.js') }}"></script>
    <script src="{{ asset('js/AuthData.js') }}"></script>
    <script src="{{ asset('js/LoginCheck.js') }}"></script>
    
    <script>
        // Global user data initialization
        window.onload = function() {
            if (typeof userId !== 'undefined') {
                // Set user ID in all hidden inputs with common IDs
                const elements = [
                    'Creatorid', 'Authorid', 'TaskCreator', 
                    'Assignmentorid', 'SubId', 'ContactorId'
                ];
                
                elements.forEach(id => {
                    const element = document.getElementById(id);
                    if (element) {
                        element.value = userId;
                    }
                });
                
                // Update user info in navbar
                if (userEmail) {
                    const emailElement = document.getElementById('userEmail');
                    const nameElement = document.getElementById('userName');
                    
                    if (emailElement) emailElement.textContent = userEmail;
                    if (nameElement) {
                        const name = userEmail.split('@')[0];
                        nameElement.textContent = name.charAt(0).toUpperCase() + name.slice(1);
                    }
                }
            }
        };
    </script>
</head>
<body>
    <!-- Include Header -->
    @include('layouts.header')
    
    <!-- Main Content -->
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    
    <!-- Include Footer -->
    @include('layouts.footer')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <!-- Custom Scripts -->
    @yield('scripts')
    
    <script>
        // Auto-dismiss alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>