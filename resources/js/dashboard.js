window.addEventListener("load", function () {
    fetch('/user-info', {
        headers: {
            'Content-Type': 'application/json'
        },
    })
        .then(response => response.json())
        .then(user => {
            window.Echo.private('App.Models.User.' + user.id)
                .notification((notification) => {
                    window.Swal.fire({
                        title: notification.title,
                        toast: true,
                        position: 'top-right',
                        text: notification.text,
                        confirmButtonText: 'Ok'
                    })
                });
        })
});
