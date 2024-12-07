function logout() {
    // Remove the token and user ID from local storage
    localStorage.removeItem('auth_token');
    localStorage.removeItem('user_id');

    // Optionally, notify the user or log out from the server
    axios.post('api/logout') // Only if you need to notify the server about logout
        .then(response => {
            console.log('Logout successful:', response.data);
        })
        .catch(error => {
            console.error('Error during logout:', error.response ? error.response.data : error);
        });

    // Redirect the user to the login page or home page
    window.location.href = 'login'; // Change 'login' to your login page URL
}

// Example of attaching the logout function to a button click event
document.getElementById('logout-button').addEventListener('click', logout);
