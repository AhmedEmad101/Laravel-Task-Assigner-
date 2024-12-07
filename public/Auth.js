let token = localStorage.getItem('access_token');
let id    = localStorage.getItem('id');
let name    = localStorage.getItem('name');
if (token) {
    fetch(`api/user/${id}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
        }
    }).then(response => response.json())
    .then(data =>{document.getElementById('name').textContent = name;
    document.getElementById('email').textContent = data.email;})
    .catch(error => console.error('Error:', error));
}
      else {
    window.location.href = 'login'; // Redirect if no token
}
