// sweet alern 2
const swal = $(".swal").data("swal");
if (swal) {
    Swal.fire({
        icon: 'error',
        title: 'Oops..',
        text: swal,
        confirmButtonText: 'Top up'
    })
}

// const Toast = Swal.mixin({
//     toast: true,
//     position: 'top-end',
//     showConfirmButton: false,
//     timer: 3000,
//     timerProgressBar: true,
//     onOpen: (toast) => {
//         toast.addEventListener('mouseenter', Swal.stopTimer)
//         toast.addEventListener('mouseleave', Swal.resumeTimer)
//     }
// })

// Toast.fire({
//     icon: 'success',
//     title: 'Signed in successfully'
// })