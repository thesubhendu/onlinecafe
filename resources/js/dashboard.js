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

                    let options = {
                        title: notification.title,
                        toast: true,
                        position: 'top-right',
                        text: notification.text,
                    };

                    if (notification.action) {
                        options.confirmButtonText = "<a class='text-white' href='" + notification.action + "'>View</a>"
                    }

                    window.Swal.fire(options)
                });
        })
});
