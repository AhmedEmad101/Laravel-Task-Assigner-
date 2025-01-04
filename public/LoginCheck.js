userId = localStorage.getItem('id');
if (userId != null) {

    document.addEventListener('DOMContentLoaded', function () {
        var button = document.getElementById('logoutbutton');
        button.textContent = "Logout";
        console.log('there is a user');
    });
}
