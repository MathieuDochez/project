import Swal from "sweetalert2";

window.Swal = Swal;

// toast with default settings and event listener
window.addEventListener("swal:toast", (event) => {
    // default settings for toasts
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        background: "white",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
    // convert some attributes
    let config = Array.isArray(event.detail) ? event.detail[0] : event.detail;
    config = convertAttributes(config, "toast");
    // override default settings or add new settings
    Toast.fire(config);
});

// confirm modal with default settings and event listener
window.addEventListener("swal:confirm", (event) => {
    // default settings for confirm modals
    const Confirm = Swal.mixin({
        width: 600,
        position: "center",
        backdrop: true,
        showCancelButton: true,
        cancelButtonText: "Cancel",
        cancelButtonColor: "silver",
        showConfirmButton: true,
        confirmButtonText: "Yes",
        confirmButtonColor: "#F2421B",
        reverseButtons: true,
        allowEscapeKey: true,
        allowOutsideClick: true,
    });
    // move the 'next' property to the 'nextEvent' variable and delete it from the 'event.detail' object
    let config = Array.isArray(event.detail) ? event.detail[0] : event.detail;
    const NextEvent = config.next;
    delete config.next;
    // convert some attributes
    config = convertAttributes(config, "confirm");
    // override default settings or add new settings
    Confirm.fire(config).then((result) => {
        // execute this function if the confirm button is clicked AND if a 'NextEvent' is not empty
        if (result.isConfirmed && NextEvent) {
            // dispatch a Livewire event with 'event' as the event name and 'params' as the payload
            window.Livewire.dispatch(NextEvent.event, NextEvent.params);
        }
    });
});

function convertAttributes(attributes, type) {
    // convert predefined 'words' to a real color
    switch (attributes.background) {
        case "danger":
        case "error":
            attributes.background = "#FDE2E2";
            attributes.iconHtml = `<svg class="size-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Free 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zm-248 50c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"></path></svg>`;
            break;
        case "warning":
            attributes.background = "#FFF4E5";
            attributes.iconHtml = `<svg class="size-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 512"><!--! Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. --><path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"></path></svg>`;
            break;
        case "primary":
        case "info":
            attributes.background = "#e5efff";
            attributes.iconHtml = `<svg class="size-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><!--! Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. --><path d="M48 80a48 48 0 1 1 96 0A48 48 0 1 1 48 80zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path></svg>`;
            break;
        case "success":
            attributes.background = "#e8ffed";
            attributes.iconHtml = `<svg class="size-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>`;
            break;
    }

    if (type === "toast") {
        attributes.timer = 3000;
        attributes.timerProgressBar = true;
        attributes.toast = true;
        attributes.position = "top-end";
    }

    if (type === "confirm") {
        attributes.width = 600;
        attributes.position = "center";
        attributes.backdrop = true;
        attributes.showCancelButton = true;
        attributes.cancelButtonText = "Cancel";
        attributes.cancelButtonColor = "red";
        attributes.showConfirmButton = true;
        attributes.confirmButtonText = "Yes";
        attributes.confirmButtonColor = "green";
        attributes.reverseButtons = true;
        attributes.allowEscapeKey = true;
        attributes.allowOutsideClick = true;
    }

    if (attributes.text) {
        attributes.html = attributes.text;
        delete attributes.text;
    }
    return attributes;
}
