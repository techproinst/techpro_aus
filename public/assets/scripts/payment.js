const installment = document.querySelector('.installment');

installment.addEventListener('click', () => {

 document.querySelector('.full-hr').style.display = 'none';
 document.querySelector('.full-time').style.display = 'none';
 document.querySelector('.installment-hr').classList.add('install-hr');
 document.querySelector('.deposit').classList.add('install-element');



});

const fullPayment = document.querySelector('.full-payment');

fullPayment.addEventListener('click', () => {

 document.querySelector('.full-hr').style.display = 'block';
 document.querySelector('.full-time').style.display = 'block';
 document.querySelector('.installment-hr').classList.remove('install-hr');
 document.querySelector('.deposit').classList.remove('install-element');



});