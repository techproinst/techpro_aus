document.addEventListener('DOMContentLoaded', function () {
  const copyBtns = document.querySelectorAll('.copy-btn');

  copyBtns.forEach((copyBtn) => {
      copyBtn.addEventListener('click', () => {
          const promoCode = copyBtn.getAttribute('data-code'); // Get promo code

          // Create a temporary input element
          const tempInput = document.createElement('input');
          tempInput.value = promoCode;
          document.body.appendChild(tempInput);
          tempInput.select();
          tempInput.setSelectionRange(0, 99999); // For mobile devices

          try {
              document.execCommand('copy'); // Copy text
              tempInput.remove(); // Remove the input field after copying
              
              // Show success message
              const message = copyBtn.nextElementSibling; // Get the "Copied!" message span
              message.style.display = 'inline';
              setTimeout(() => {
                  message.style.display = 'none';
              }, 2000); // Hide after 2 seconds
          } catch (err) {
              console.error('Failed to copy: ', err);
          }
      });
  });
});
