// sweet alern 2
const swal = $(".swal").data("swal");
if (swal) {
    Swal.fire({
        icon: 'error',
        title: 'Oops..',
        text: swal,
        confirmButtonText: 'Oke'
    })
}
const flashData = $(".flash-data").data("flashdata");
// cek console
// console.log(flashData);
if (flashData) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4500,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: flashData,
    })
}

// Rergis service worker

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js').then(function(reg) {
        //  daftar
        console.log('Service tedaftar', reg);
    }, function(err) {
        // gagal daftar
        console.log('service tidak terdaftar', err);
    });
}