<script>
console.log('Booking page: Loading custom script AFTER main.js');

// Override loadTimeSlots for this page
window.loadTimeSlots = async function(date) {
    console.log('Custom loadTimeSlots called with date:', date);
    const container = document.getElementById('timeSlotsContainer');
    const serviceInput = document.querySelector('input[name="service_id"]:checked');
    
    if (!serviceInput) {
        container.innerHTML = '<p style="color: #666;">Please select a service first</p>';
        return;
    }
    
    container.innerHTML = '<p>Loading available time slots...</p>';
    
    try {
        const response = await fetch('<?= base_url('/booking/checkAvailability') ?>?date=' + date + '&service_id=' + serviceInput.value);
        const data = await response.json();
        
        if (data.status === 'success') {
            if (data.slots.length > 0) {
                const slotsHtml = data.slots.map(slot => `
                    <div class="time-slot ${slot.available ? '' : 'booked'}" 
                         data-time="${slot.value}"
                         onclick="${slot.available ? 'window.selectTimeSlot(this)' : ''}">
                        ${slot.time}
                    </div>
                `).join('');
                
                container.innerHTML = '<div class="time-slots">' + slotsHtml + '</div>';
            } else {
                container.innerHTML = '<p style="color: #666;">No time slots available for this date.</p>';
            }
        } else {
            container.innerHTML = '<p style="color: #dc3545;">' + data.message + '</p>';
        }
    } catch (error) {
        console.error('Error loading time slots:', error);
        container.innerHTML = '<p style="color: #dc3545;">Error loading time slots. Please try again.</p>';
    }
};

// Override selectDate to also update hidden input
window.selectDate = function(dateElement) {
    console.log('Custom selectDate called');
    if (dateElement.classList.contains('blocked')) return;
    
    // Remove previous selection
    document.querySelectorAll('.calendar-day.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection
    dateElement.classList.add('selected');
    
    // Set hidden input value
    const selectedDate = dateElement.dataset.date;
    document.getElementById('booking_date').value = selectedDate;
    
    // Load time slots
    window.loadTimeSlots(selectedDate);
};

// Time slot selection
window.selectTimeSlot = function(slotElement) {
    // Remove previous selection
    document.querySelectorAll('.time-slot.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection
    slotElement.classList.add('selected');
    
    // Set hidden input value
    document.getElementById('start_time').value = slotElement.dataset.time;
};

// Service selection styling
document.querySelectorAll('.service-option').forEach(option => {
    const radio = option.querySelector('input[type="radio"]');
    const card = option.querySelector('.card');
    
    option.addEventListener('click', function() {
        console.log('Service clicked:', radio.value);
        // Remove selected class from all cards
        document.querySelectorAll('.service-option .card').forEach(c => {
            c.style.borderColor = 'transparent';
        });
        
        // Add selected class to clicked card
        card.style.borderColor = 'var(--golf-green)';
        radio.checked = true;
        
        // Reload time slots if date is selected
        const selectedDate = document.querySelector('.calendar-day.selected');
        if (selectedDate && selectedDate.dataset.date) {
            console.log('Service selected, reloading time slots for date:', selectedDate.dataset.date);
            window.loadTimeSlots(selectedDate.dataset.date);
        }
    });
    
    if (radio.checked) {
        card.style.borderColor = 'var(--golf-green)';
    }
});

// Form validation before submit
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    const serviceId = document.querySelector('input[name="service_id"]:checked');
    const bookingDate = document.getElementById('booking_date');
    const startTime = document.getElementById('start_time');
    
    if (!serviceId || !bookingDate.value || !startTime.value) {
        e.preventDefault();
        alert('Please complete all booking steps:\n1. Select a service\n2. Choose a date\n3. Select a time slot\n4. Fill in your information');
        return false;
    }
});

console.log('Booking page: Custom script loaded successfully');
</script>

