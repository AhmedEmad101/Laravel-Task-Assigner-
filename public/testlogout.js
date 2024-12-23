document.addEventListener("DOMContentLoaded", function() {
    const logoutButton = document.getElementById('logoutbutton');

    if (logoutButton) {
        logoutButton.addEventListener('click', async function() {
            try {
                const response = await fetch('api/logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });

                if (response.ok) {
                    // Remove the token from localStorage

                    localStorage.removeItem('access_token');

                    // Redirect to the login page or any specified page
                    window.location.href = 'login';
                    // Adjust this as necessary
                } else {
                    const result = await response.json();
                    alert(result.error || 'Logout failed');
                }
            } catch (error) {
                console.error('Logout error', error);
            }
        });
    } else {
        console.error('Logout button not found');
    }
});
