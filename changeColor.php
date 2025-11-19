<!DOCTYPE html>
<html>
<head>
    <title>Booking Table Highlight</title>
    <style>
        /* Normal row style */
        #bookingTable tbody tr {
            transition: background-color 1s; /* smooth color change */
        }

        /* Highlighted row */
        .expired {
            background-color: #f8d7da; /* light red / expired color */
            color: #721c24;
        }

        /* Button clicked style */
        #startColorBtn.clicked {
            background-color: #28a745; /* green after click */
            color: white;
        }
    </style>
</head>
<body>

<h2>Booking List</h2>

<table id="bookingTable" border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Patient</th>
            <th>Department</th>
            <th>Time</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Ram</td>
            <td>Dental</td>
            <td>10:00 AM</td>
        </tr>

        <tr>
            <td>Shyam</td>
            <td>Cardiology</td>
            <td>11:00 AM</td>
        </tr>

        <tr>
            <td>Sita</td>
            <td>ENT</td>
            <td>1:00 PM</td>
        </tr>
    </tbody>
</table>

<br>
<button id="startColorBtn">Start Color Timer</button>

<script>
function startColorTimer() {
    const btn = document.getElementById("startColorBtn");
    btn.classList.add("clicked");
    btn.disabled = true; // prevent multiple clicks

    const rows = document.querySelectorAll("#bookingTable tbody tr");

    rows.forEach((row, index) => {
        // Change each row individually after (index * 1 minute)
        setTimeout(() => {
            row.classList.add("expired");
        }, 10000 * (index + 1)); // 10 seconds for demo, replace with 60000 for 1 minute
    });
}

// Attach event to button
document.getElementById("startColorBtn").addEventListener("click", startColorTimer);
</script>

</body>
</html>
