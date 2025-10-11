<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Book Your Appointment</h1>
            <p class="section-subtitle">Select a service, choose your preferred date and time</p>
        </div>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <form action="<?= base_url('/booking/create') ?>" method="POST" class="booking-form" id="bookingForm">
            <?= csrf_field() ?>
            
            <!-- Step 1: Service Selection -->
            <div class="card" style="margin-bottom: 2rem;">
                <h3 style="margin-bottom: 1.5rem;">Step 1: Select Service</h3>
                
                <div class="services-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <?php foreach ($services as $service): ?>
                        <label class="service-option" style="cursor: pointer;">
                            <input type="radio" name="service_id" value="<?= $service['id'] ?>" 
                                   required 
                                   data-duration="<?= $service['duration'] ?>"
                                   style="display: none;">
                            <div class="card" style="border: 3px solid transparent; transition: all 0.3s ease;">
                                <h4><?= esc($service['name']) ?></h4>
                                <p><?= esc($service['description']) ?></p>
                                <p style="color: var(--golf-green); font-weight: 700; font-size: 1.5rem;">
                                    $<?= number_format($service['price'], 2) ?>
                                </p>
                                <p style="color: #666;">Duration: <?= $service['duration'] ?> minutes</p>
                            </div>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Step 2: Date and Time Selection -->
            <div class="card" style="margin-bottom: 2rem;">
                <h3 style="margin-bottom: 1.5rem;">Step 2: Select Date and Time</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <!-- Calendar -->
                    <div>
                        <h4 style="margin-bottom: 1rem;">Choose a Date</h4>
                        <div class="calendar">
                            <div class="calendar-header">
                                <button type="button" class="calendar-prev" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">◀</button>
                                <h4 class="calendar-title" style="margin: 0;">Month Year</h4>
                                <button type="button" class="calendar-next" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">▶</button>
                            </div>
                            <div class="calendar-grid"></div>
                        </div>
                        <input type="hidden" name="booking_date" id="booking_date" required>
                    </div>
                    
                    <!-- Time Slots -->
                    <div>
                        <h4 style="margin-bottom: 1rem;">Choose a Time</h4>
                        <div id="timeSlotsContainer" style="min-height: 400px;">
                            <p style="color: #666;">Please select a date first</p>
                        </div>
                        <input type="hidden" name="start_time" id="start_time" required>
                    </div>
                </div>
            </div>
            
            <!-- Step 3: Customer Information -->
            <div class="card" style="margin-bottom: 2rem;">
                <h3 style="margin-bottom: 1.5rem;">Step 3: Your Information</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label for="customer_name" class="form-label">Full Name *</label>
                        <input type="text" 
                               class="form-control" 
                               id="customer_name" 
                               name="customer_name" 
                               required
                               value="<?= old('customer_name') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="customer_email" class="form-label">Email Address *</label>
                        <input type="email" 
                               class="form-control" 
                               id="customer_email" 
                               name="customer_email" 
                               required
                               value="<?= old('customer_email') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="customer_phone" class="form-label">Phone Number *</label>
                        <input type="tel" 
                               class="form-control" 
                               id="customer_phone" 
                               name="customer_phone" 
                               required
                               value="<?= old('customer_phone') ?>">
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label for="special_requests" class="form-label">Special Requests (Optional)</label>
                    <textarea class="form-control" 
                              id="special_requests" 
                              name="special_requests" 
                              rows="4"><?= old('special_requests') ?></textarea>
                </div>
            </div>
            
            <!-- Submit -->
            <div style="text-align: center;">
                <button type="submit" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 3rem;">
                    Confirm Booking
                </button>
            </div>
        </form>
    </div>
</section>

<script>
// Override the renderCalendar function to add proper click handlers
document.addEventListener('DOMContentLoaded', function() {
    // Service selection styling
    document.querySelectorAll('.service-option').forEach(option => {
        const radio = option.querySelector('input[type="radio"]');
        const card = option.querySelector('.card');
        
        option.addEventListener('click', function() {
            // Remove selected class from all cards
            document.querySelectorAll('.service-option .card').forEach(c => {
                c.style.borderColor = 'transparent';
            });
            
            // Add selected class to clicked card
            card.style.borderColor = 'var(--golf-green)';
            radio.checked = true;
            
            // Reload calendar if date is selected
            const selectedDate = document.querySelector('.calendar-day.selected');
            if (selectedDate && selectedDate.dataset.date) {
                loadTimeSlots(selectedDate.dataset.date);
            }
        });
        
        if (radio.checked) {
            card.style.borderColor = 'var(--golf-green)';
        }
    });
    
    // Make the static calendar interactive
    attachCalendarListeners();
});

function attachCalendarListeners() {
    // Add click handlers to all calendar days
    document.querySelectorAll('.calendar-day').forEach((dayElement, index) => {
        // Skip the first 7 items (day headers)
        if (index < 7) return;
        
        const dayNumber = dayElement.textContent.trim();
        if (dayNumber && !isNaN(dayNumber)) {
            // Get current month and year from the calendar title
            const titleText = document.querySelector('.calendar-title').textContent;
            const [monthName, year] = titleText.split(' ');
            const monthMap = {
                'January': '01', 'February': '02', 'March': '03', 'April': '04',
                'May': '05', 'June': '06', 'July': '07', 'August': '08',
                'September': '09', 'October': '10', 'November': '11', 'December': '12'
            };
            const month = monthMap[monthName];
            const date = `${year}-${month}-${dayNumber.padStart(2, '0')}`;
            
            // Set data attribute
            dayElement.dataset.date = date;
            
            // Add click handler if not blocked
            if (!dayElement.classList.contains('blocked')) {
                dayElement.style.cursor = 'pointer';
                dayElement.addEventListener('click', function() {
                    selectDate(this);
                });
            }
        }
    });
}

// Enhanced date selection
function selectDate(dateElement) {
    if (dateElement.classList.contains('blocked')) return;
    
    // Remove previous selection
    document.querySelectorAll('.calendar-day.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection
    dateElement.classList.add('selected');
    
    // Set hidden input value
    document.getElementById('booking_date').value = dateElement.dataset.date;
    
    // Load time slots
    loadTimeSlots(dateElement.dataset.date);
}

// Enhanced time slot loading
async function loadTimeSlots(date) {
    const container = document.getElementById('timeSlotsContainer');
    const serviceInput = document.querySelector('input[name="service_id"]:checked');
    
    if (!serviceInput) {
        container.innerHTML = '<p style="color: #666;">Please select a service first</p>';
        return;
    }
    
    container.innerHTML = '<p>Loading available time slots...</p>';
    
    try {
        const response = await fetch(`<?= base_url('/booking/checkAvailability') ?>?date=${date}&service_id=${serviceInput.value}`);
        const data = await response.json();
        
        if (data.status === 'success') {
            if (data.slots.length > 0) {
                const slotsHtml = data.slots.map(slot => `
                    <div class="time-slot ${slot.available ? '' : 'booked'}" 
                         data-time="${slot.value}"
                         onclick="${slot.available ? 'selectTimeSlot(this)' : ''}">
                        ${slot.time}
                    </div>
                `).join('');
                
                container.innerHTML = `<div class="time-slots">${slotsHtml}</div>`;
            } else {
                container.innerHTML = '<p style="color: #666;">No time slots available for this date.</p>';
            }
        } else {
            container.innerHTML = `<p style="color: #dc3545;">${data.message}</p>`;
        }
    } catch (error) {
        console.error('Error loading time slots:', error);
        container.innerHTML = '<p style="color: #dc3545;">Error loading time slots. Please try again.</p>';
    }
}

// Time slot selection
function selectTimeSlot(slotElement) {
    // Remove previous selection
    document.querySelectorAll('.time-slot.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection
    slotElement.classList.add('selected');
    
    // Set hidden input value
    document.getElementById('start_time').value = slotElement.dataset.time;
}

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
</script>

