<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>Calendar</h1>
        <p>Manage your meetings, calls and follow-ups.</p>
    </div>

    <button type="button" class="btn btn-primary" id="openEventModal">
        + Add Event
    </button>
</div>

<div class="card">
    <div class="calendar-header">
        <button type="button" id="prevMonth">&larr;</button>
        <h2 id="monthYear"></h2>
        <button type="button" id="nextMonth">&rarr;</button>
    </div>

    <div class="calendar-grid" id="calendarGrid"></div>
</div>

<div class="event-modal-overlay" id="eventModal">
    <div class="event-modal">
        <div class="event-modal-header">
            <div>
                <h2>Add New Event</h2>
                <p>Schedule a meeting, call or follow-up.</p>
            </div>
            <button type="button" id="closeEventModal" class="event-close-btn">
                &times;
            </button>
        </div>

        <form id="eventForm">
            <div class="event-form-group">
                <label for="eventTitle">Event Title *</label>
                <input type="text" id="eventTitle" required
                    placeholder="e.g. Customer meeting">
            </div>

            <div class="event-form-row">
                <div class="event-form-group">
                    <label for="eventDate">Date *</label>
                    <input type="date" id="eventDate" required>
                </div>

                <div class="event-form-group">
                    <label for="eventTime">Time *</label>
                    <input type="time" id="eventTime" required>
                </div>
            </div>

            <div class="event-form-group">
                <label for="eventDescription">Description</label>
                <textarea id="eventDescription" rows="3"
                    placeholder="Add event details..."></textarea>
            </div>

            <div class="event-modal-actions">
                <button type="button" id="cancelEvent" class="event-cancel-btn">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Save Event
                </button>
            </div>
        </form>
    </div>
</div>

<div id="eventToast" class="event-toast"></div>


<div class="card event-list-card">
    <h2>Upcoming Events</h2>
    <div class="table-responsive">
        <table class="customers-table">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody id="eventTableBody">
                <tr>
                    <td colspan="4">No events added yet.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<script>
    const calendarGrid = document.getElementById('calendarGrid');
    const monthYear = document.getElementById('monthYear');

    let currentDate = new Date();

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        monthYear.textContent = currentDate.toLocaleDateString(
            'en-US', {
                month: 'long',
                year: 'numeric'
            }
        );

        calendarGrid.innerHTML = '';

        const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        days.forEach(day => {
            const cell = document.createElement('div');
            cell.className = 'calendar-day-name';
            cell.textContent = day;
            calendarGrid.appendChild(cell);
        });

        const firstDay = new Date(year, month, 1).getDay();
        const totalDays = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
            calendarGrid.appendChild(document.createElement('div'));
        }

        for (let day = 1; day <= totalDays; day++) {
            const cell = document.createElement('div');
            cell.className = 'calendar-date';
            cell.textContent = day;

            if (
                day === new Date().getDate() &&
                month === new Date().getMonth() &&
                year === new Date().getFullYear()
            ) {
                cell.classList.add('today');
            }

            calendarGrid.appendChild(cell);
        }
    }

    document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();


    const eventModal = document.getElementById('eventModal');
    const eventForm = document.getElementById('eventForm');
    const eventDateInput = document.getElementById('eventDate');
    const eventToast = document.getElementById('eventToast');

    // let calendarEvents = [];

    function openEventModal(selectedDate = '') {
        eventForm.reset();

        const date = selectedDate ||
            `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-01`;

        eventDateInput.value = date;
        eventModal.classList.add('active');
    }

    function closeEventModal() {
        eventModal.classList.remove('active');
    }

    function showEventToast(message) {
        eventToast.textContent = message;
        eventToast.classList.add('show');

        setTimeout(() => {
            eventToast.classList.remove('show');
        }, 2500);
    }

    document.getElementById('openEventModal')
        .addEventListener('click', () => openEventModal());

    document.getElementById('closeEventModal')
        .addEventListener('click', closeEventModal);

    document.getElementById('cancelEvent')
        .addEventListener('click', closeEventModal);

    eventModal.addEventListener('click', (event) => {
        if (event.target === eventModal) {
            closeEventModal();
        }
    });


    eventForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const newEvent = {
            title: document.getElementById('eventTitle').value.trim(),
            event_date: eventDateInput.value,
            event_time: document.getElementById('eventTime').value,
            description: document.getElementById('eventDescription').value.trim()
        };

        if (!newEvent.title || !newEvent.event_date || !newEvent.event_time) {
            showEventToast('Please fill all required fields.');
            return;
        }

        try {
            const response = await fetch('<?= site_url('calendar/create') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(newEvent)
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                showEventToast(result.message || 'Could not save event.');
                return;
            }

            calendarEvents.push({
                id: Date.now(),
                title: newEvent.title,
                date: newEvent.event_date,
                time: newEvent.event_time,
                description: newEvent.description
            });

            renderCalendar();
            renderEventTable();
            closeEventModal();
            showEventToast('Event saved successfully!');
            eventForm.reset();

        } catch (error) {
            console.error('Save event error:', error);
            showEventToast('Server error. Please try again.');
        }
    });


    function getEventsForDate(dateString) {
        return calendarEvents.filter(event => event.date === dateString);
    }



    const savedEvents = <?= json_encode(
                            $events ?? [],
                            JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
                        ) ?>;

    let calendarEvents = savedEvents.map(event => ({
        id: Number(event.id),
        title: event.title,
        date: event.event_date,
        time: event.event_time,
        description: event.description || ''
    }));

    function renderEventTable() {
        const eventTableBody = document.getElementById('eventTableBody');

        if (!eventTableBody) return;

        if (calendarEvents.length === 0) {
            eventTableBody.innerHTML = `
            <tr>
                <td colspan="4">No events added yet.</td>
            </tr>
        `;
            return;
        }

        eventTableBody.innerHTML = '';

        calendarEvents.forEach(event => {
            const row = document.createElement('tr');

            [event.title, event.date, event.time, event.description || '-']
            .forEach(value => {
                const cell = document.createElement('td');
                cell.textContent = value;
                row.appendChild(cell);
            });

            eventTableBody.appendChild(row);
        });
    }

    renderEventTable();
</script>





<?= $this->endSection() ?>