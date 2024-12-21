import axios from 'axios';
let usertoken = localStorage.getItem('access_token');
let userId = localStorage.getItem('id'); // Assuming the user ID is stored in local storage
let username = localStorage.getItem('name');

    // Make sure userId is defined
    if (userId) {
        axios.get(`api/user/${userId}`, {
            headers: {
                Authorization: `Bearer ${usertoken}`
            }
        }).then(response => {
            document.getElementById('idid').innerText = response.data.id
            document.getElementById('user-name').innerText = response.data.name;

        }).catch(error => {
            console.error('Error fetching user data', error);
        });
    } else {
        console.error('User ID not found in local storage');
    };
