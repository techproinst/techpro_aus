const input = document.querySelector('.promo-input');
const checkbox = document.getElementById('promocheck');

const uploadLabel = document.querySelector('.upload-label');
const uploadInput = document.querySelector('.upload-input');

// Hide input field initially
input.style.display = 'none';


checkbox.addEventListener('change', function () {
    if (checkbox.checked) {
        input.style.display = 'block';
        uploadLabel.style.display = 'none';
        uploadInput.style.display = 'none';
    } else {
        input.style.display = 'none';
        uploadLabel.style.display = 'block';
        uploadInput.style.display = 'block';
    }
});