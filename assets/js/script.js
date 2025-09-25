const dropArea = document.getElementById('drop-area');
const inputFile = document.getElementById('gambar');
const imageView = document.getElementById('img-view');

if (inputFile) {
    inputFile.addEventListener("change", uploadImage);
}

function uploadImage() {
    let imgLink = URL.createObjectURL(inputFile.files[0]);
    imageView.style.backgroundImage = `url(${imgLink})`;
    imageView.style.padding = "8rem 0";
    imageView.textContent = "";
}

if (dropArea) {
    dropArea.addEventListener("dragover", function (e) {
        e.preventDefault();
    });
    
    dropArea.addEventListener("drop", function (e) {
        e.preventDefault();
        inputFile.files = e.dataTransfer.files;
        uploadImage();
    });
}

// Close Icon
const closeIcon = document.getElementById('message-close');
const message = document.getElementById('message-container');

if (closeIcon && message) {
    closeIcon.addEventListener("click", function () {
        message.style.transform = 'translateX(-50%) translateY(-5rem)';
        message.style.opacity = 0;

        setTimeout(function () {
            message.style.display = 'none';
        }, 1000)
    })
}

// Tampilkan alert
function showAlert() {
    message.classList.remove('hidden'); // Biar tampil di DOM
    requestAnimationFrame(() => {
        message.classList.add('show'); // Trigger animasi
    });
}