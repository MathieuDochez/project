import Swal from 'sweetalert2';
window.Swal = Swal;

// toast with default settings and event listener
window.addEventListener('swal:toast', event => {
    // default settings for toasts
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        background: 'white',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    // convert some attributes
    let config = Array.isArray(event.detail) ? event.detail[0] : event.detail;
    config = convertAttributes(config);

    // override default settings or add new settings
    Toast.fire(config);
});

// confirm modal with default settings and event listener
window.addEventListener('swal:confirm', event => {
    // default settings for confirm modals
    const Confirm = Swal.mixin({
        width: 600,
        position: 'center',
        backdrop: true,
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        cancelButtonColor: 'silver',
        showConfirmButton: true,
        confirmButtonText: 'Yes',
        confirmButtonColor: 'rgb(31, 41, 55)',
        reverseButtons: true,
        allowEscapeKey: true,
        allowOutsideClick: true,
    });
    // move the 'next' property to the 'nextEvent' variable and delete it from the 'event.detail' object
    let config = Array.isArray(event.detail) ? event.detail[0] : event.detail;
    const NextEvent = config.next ;
    delete config.next;
    // convert some attributes
    config = convertAttributes(config);
    // override default settings or add new settings
    Confirm.fire(config)
        .then(result => {
            // execute this function if the confirm button is clicked AND if a 'NextEvent' is not empty
            if (result.isConfirmed && NextEvent) {
                // dispatch a Livewire event with 'event' as the event name and 'params' as the payload
                window.Livewire.dispatch(NextEvent.event, NextEvent.params);
            }
        });
});

function convertAttributes(attributes) {
    // convert predefined 'words' to a real color
    const colorMap = {
        danger: 'rgb(254, 226, 226)',
        error: 'rgb(254, 226, 226)',
        warning: 'rgb(255, 237, 213)',
        primary: 'rgb(207, 250, 254)',
        info: 'rgb(207, 250, 254)',
        success: 'rgb(220, 252, 231)'
    };

    if (colorMap[attributes.background]) {
        attributes.background = colorMap[attributes.background];
    }

    // if the attribute 'text' is set, convert it to the attribute 'html'
    if (attributes.text) {
        attributes.html = attributes.text;
        delete attributes.text;
    }

    return attributes;
}
