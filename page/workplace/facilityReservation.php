<!DOCTYPE html>
<html>
    <head>
        <title>Facility Reservation</title>
        <link rel="stylesheet" href="fullcalendar.min.css">
        <link href="../../css/facilityReservation.css" rel="stylesheet" type="text/css"/>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var locationEl = document.getElementById('location');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '07:00:00',
                    slotMaxTime: '20:00:00',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'timeGridWeek,timeGridDay'
                    }
                });
                function fetchBookedSlots(facility) {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            var bookedSlots = JSON.parse(this.responseText);
                            calendar.removeAllEvents();
                            calendar.addEventSource(bookedSlots);
                            calendar.render();
                        }
                    };
                    xhttp.open("GET", "getBookedSlots.php?facility=" + facility, true);
                    xhttp.send();

                    var facilityName;
                    switch (facility) {
                        case "HALL":
                            facilityName = "Hall";
                            break;
                        case "PG":
                            facilityName = "Playground";
                            break;
                        case "MET101":
                            facilityName = "Meeting Room 101";
                            break;
                        case "MET401":
                            facilityName = "Meeting Room 401";
                            break;
                        case "COM402":
                            facilityName = "Computer Room 402";
                            break;
                        default:
                            facilityName = "";
                    }
                    locationEl.textContent = facilityName;

                    var facilitySelect = document.getElementById("schoolFacilitiesCode");
                    for (var i = 0; i < facilitySelect.options.length; i++) {
                        if (facilitySelect.options[i].value === facility) {
                            facilitySelect.selectedIndex = i;
                            break;
                        }
                    }
                }

                var tabLinks = document.getElementsByClassName("tab-link");
                for (var i = 0; i < tabLinks.length; i++) {
                    tabLinks[i].addEventListener("click", function (event) {
                        event.preventDefault();
                        var facility = this.getAttribute("data-facility");
                        fetchBookedSlots(facility);
                    });
                }

                var today = new Date();
                var startDateInput = document.getElementById('startDate');
                var endDateInput = document.getElementById('endDate');

                startDateInput.value = today.toISOString().split('T')[0];
                endDateInput.value = startDateInput.value;

                startDateInput.addEventListener('change', function () {
                    endDateInput.value = startDateInput.value;
                });

                var facilitySelect = document.getElementById("schoolFacilitiesCode");
                facilitySelect.selectedIndex = 0;
            });
        </script>
    </head>
    <body>
        <h1>Facility Reservation</h1>
        <div id="location"></div>

        <ul class="tab">
            <li><a href="#" class="tab-link" data-facility="HALL">Hall</a></li>
            <li><a href="#" class="tab-link" data-facility="PG">Playground</a></li>
            <li><a href="#" class="tab-link" data-facility="MET101">Meeting Room 101</a></li>
            <li><a href="#" class="tab-link" data-facility="MET401">Meeting Room 401</a></li>
            <li><a href="#" class="tab-link" data-facility="COM402">Computer Room 402</a></li>
        </ul>
        <div id="reservation-form">
            <h2>Reservation Form</h2>
            <form method="POST" action="insertBooking.php">                
                <label for="schoolFacilitiesCode">Facility:</label>
                <select id="schoolFacilitiesCode" name="schoolFacilitiesCode">
                    <option value="" selected>---</option>
                    <option value="HALL">Hall</option>
                    <option value="PG">Playground</option>
                    <option value="MET101">Meeting Room 101</option>
                    <option value="MET401">Meeting Room 401</option>
                    <option value="COM402">Computer Room 402</option>
                </select><br><br>
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate">
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate"><br><br>
                <label for="startTime">Start Time:</label>
                <select id="startTime" name="startTime">
                    <?php
                    $startTime = strtotime('07:00');
                    $endTime = strtotime('20:00');
                    $interval = 30 * 60;
                    while ($startTime <= $endTime) {
                        $time = date('H:i', $startTime);
                        echo "<option value=\"$time\">$time</option>";
                        $startTime += $interval;
                    }
                    ?>
                </select>

                <label for="endTime">End Time:</label>
                <select id="endTime" name="endTime">
                    <?php
                    $startTime = strtotime('07:00');
                    $endTime = strtotime('20:00');
                    $interval = 30 * 60;
                    while ($startTime <= $endTime) {
                        $time = date('H:i', $startTime);
                        echo "<option value=\"$time\">$time</option>";
                        $startTime += $interval;
                    }
                    ?>
                </select>
                <br><br>
                <label for="reason">Reason:</label>
                <input type="text" id="reason" name="reason">
                <label for="approval">Approval Status:</label>
                <input type="text" id="approval" name="approval">
                <label for="staffCode">Staff Code:</label>
                <input type="text" id="staffCode" name="staffCode">
                <input type="submit" value="Submit">
            </form>
        </div>
        <div id="calendar"></div>
    </body>
</html>
