document.addEventListener("DOMContentLoaded", function () {
    const toast = document.querySelector(".custom-toast");
    if (toast) {
        toast.classList.add("show");

        setTimeout(() => {
            toast.classList.remove("show");
        }, 5000);
    }
});
