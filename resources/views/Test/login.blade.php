<form action="" method="POST" id="login-form">
    @csrf
    <div class="textbox">
        <input type="text" placeholder="Username" name="email" required>
    </div>
    <div class="textbox">
        <input type="password" placeholder="Password" name="password" required>
    </div>
    <div class="remember-me">
        <input type="checkbox" name="remember"> Remember me
    </div>
    <div class="button">
        <input type="submit" value="Login">
    </div>
    <script>

        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let data = {
                email: formData.get('email'),
                password: formData.get('password')
            };

            try {
                const response = await fetch('api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                if (response.ok) {
                    // Store the token in localStorage
                    localStorage.setItem('access_token', result.access_token);
                    localStorage.setItem('id', result.id);
                    localStorage.setItem('name', result.name);
                    localStorage.setItem('role', result.role);
                    // Redirect to dashboard or any protected route
                     //window.location.href = 'home';
                     if (result.role === 2) {
                window.location.assign('admin');  // Redirect to admin page
            }

                window.location.assign('home');


                   // window.location.href = 'dashboard';
                } else {
                    alert(result.error);
                }
            } catch (error) {
                console.error('Login error', error);
            }
        });

        </script>
