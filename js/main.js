document.addEventListener('DOMContentLoaded', (event) => {
    const paymentForm = document.querySelector('form');

    if (paymentForm) {
        paymentForm.addEventListener('submit', (e) => {
            const amount = document.getElementById('amount').value;
            const currency = document.getElementById('currency').value;
            const description = document.getElementById('description').value;
            const email = document.getElementById('email').value;

            if (!amount || !currency || !description || !email) {
                e.preventDefault();
                alert('Please fill in all fields.');
            } else {
                console.log('Form submitted successfully!');
            }
        });
    }
});
