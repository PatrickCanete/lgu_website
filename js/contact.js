const form = document.getElementById('contactForm');
form.addEventListener('submit', function (event) {
    event.preventDefault();
    let valid = true;

    const nameInput = form.name;
    const nameError = document.getElementById('nameError');
    if (!nameInput.value.trim()) {
        nameError.classList.add('error-visible');
        valid = false;
    } else {
        nameError.classList.remove('error-visible');
    }

    const emailInput = form.email;
    const emailError = document.getElementById('emailError');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailInput.value.trim() || !emailRegex.test(emailInput.value)) {
        emailError.classList.add('error-visible');
        valid = false;
    } else {
        emailError.classList.remove('error-visible');
    }

    const phoneInput = form.phone;
    const phoneError = document.getElementById('phoneError');
    const phoneRegex = /^\+?[0-9\s\-]{7,15}$/;
    if (phoneInput.value.trim() && !phoneRegex.test(phoneInput.value)) {
        phoneError.classList.add('error-visible');
        valid = false;
    } else {
        phoneError.classList.remove('error-visible');
    }

    const messageInput = form.message;
    const messageError = document.getElementById('messageError');
    if (!messageInput.value.trim()) {
        messageError.classList.add('error-visible');
        valid = false;
    } else {
        messageError.classList.remove('error-visible');
    }

    if (valid) {
        alert('Thank you for contacting us! We will get back to you shortly.');
        form.reset();
    }
});