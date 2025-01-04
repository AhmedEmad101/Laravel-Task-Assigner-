
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
console.log('user logged in ')

        }).catch(error => {
            console.error('Error fetching user data', error);
        });
    } else {
        console.error('User ID not found in local storage');
    };
