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

    setTimeout(function () {
        message.style.transform = 'translateX(-50%) translateY(-5rem)';
        message.style.opacity = 0;
    }, 5000);
}

// Confirm
let productId = null;
const deleteBtn = document.querySelectorAll('.crud-delete');
if (deleteBtn) {
    deleteBtn.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            productId = this.dataset.id;
            showConfirm();
        })
    });
}

const confirmPopUp = document.getElementById("confirm");
const confirmBg = document.getElementById("confirm-bg");
const yesButton = document.getElementById("yes");
const noButton = document.getElementById("no");

if (yesButton && noButton) {
    yesButton.addEventListener("click", function () {
        // console.log(`./?delete=${productId}`)
        confirmPopUp.classList.remove('show')
        confirmPopUp.classList.add('hidden')
        window.location.href = `./?delete=${productId}`;
    });

    noButton.addEventListener("click", function () {
        confirmPopUp.classList.remove('show')
        confirmPopUp.classList.add('hidden')
    })
}

function showConfirm() {
    confirmPopUp.classList.remove('hidden')
    requestAnimationFrame(() => {
        confirmPopUp.classList.add('show')
    });
}

// ToggleButton
const toggle = document.getElementById('toggle-sidebar');
const sidebar = document.getElementById('toggle-link');

if (toggle && sidebar) {
    toggle.addEventListener('click', function () {
        sidebar.classList.toggle('active');
    })
}