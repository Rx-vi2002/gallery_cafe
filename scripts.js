document.addEventListener("DOMContentLoaded", function() {
    const registerForm = document.getElementById('registerForm');
    registerForm.addEventListener('submit', function(e) {
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Passwords do not match');
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const reservationForm = document.getElementById('reservationForm');
    
    reservationForm.addEventListener('submit', function(event) {
        let valid = true;

        // Get form values
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');
        const guestsInput = document.getElementById('guests');
        const today = new Date();
        const selectedDate = new Date(dateInput.value);
        const selectedTime = timeInput.value;

        // Validate date
        if (!dateInput.value) {
            alert('Please select a date.');
            valid = false;
        } else if (selectedDate < today) {
            alert('Please select a future date.');
            valid = false;
        }

        // Validate time
        if (!timeInput.value) {
            alert('Please select a time.');
            valid = false;
        } else if (selectedTime < "09:00" || selectedTime > "22:00") {
            alert('Please select a time between 09:00 and 22:00.');
            valid = false;
        }

        // Validate guests
        if (!guestsInput.value || guestsInput.value < 1) {
            alert('Please select at least one guest.');
            valid = false;
        }

        // Prevent form submission if any validation fails
        if (!valid) {
            event.preventDefault();
        }
    });
});

