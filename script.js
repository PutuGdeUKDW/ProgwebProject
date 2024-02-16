
var currentDate = new Date();
var currentMonth = currentDate.getMonth() + 1;
var currentYear = currentDate.getFullYear();





function adjustCalendarRows() {
    var tbody = document.querySelector('.kalender tbody');
    var trElements = tbody.querySelectorAll('tr');

    if (trElements.length >= 7) {
        tbody.removeChild(trElements[trElements.length - 1]);
    }
}
function generateCalendar(month, year) {
    // Remaining code from the previous solution...
    var currentDate = new Date(year, month - 1, 1);
    var currentMonth = currentDate.getMonth();
    var currentYear = currentDate.getFullYear();
    var daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    var firstDayOfWeek = new Date(currentYear, currentMonth, 1).getDay();

    var calendarTable = document.querySelector('.kalender');
    var calendarCaption = document.querySelector('.month-year h3');
    calendarCaption.textContent = `${new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long' })} ${currentYear}`;

    // Clear the existing calendar
    while (calendarTable.rows.length > 1) {
        calendarTable.deleteRow(-1);
    }

    var dayCount = 1;
    for (var i = 0; i < 6; i++) {
        var row = calendarTable.insertRow();
        for (var j = 0; j < 7; j++) {
            if (i === 0 && j < firstDayOfWeek) {
                // Create empty cells for previous month's days
                row.insertCell();
            } else if (dayCount > daysInMonth) {
                // Create empty cells for next month's days
                row.insertCell();
            } else {
                var cell = row.insertCell();
                var dateValue = `${year}-${month.toString().padStart(2, '0')}-${dayCount.toString().padStart(2, '0')}`;
                cell.innerHTML = `<a href="Acara/Acara.php?date=${dateValue}">${dayCount}</a>`;
                fetchEventData(dateValue, cell);
                dayCount++;
            }
        }
    }
    var now = new Date();
    if (month === (now.getMonth()+1) && year === now.getFullYear()) {
        getToday();
      }
    adjustCalendarRows(); // Call the function to adjust rows

    // Update the current month and year
    currentMonth = month;
    currentYear = year;    
}
function fetchEventData(date, cell) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'kalenderController.php?date=' + encodeURIComponent(date), true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            console.log('Response:', response); // Add this line for debugging

            if (response.trim() !== '') {
                var eventData = JSON.parse(response);
                console.log(date);
                console.log('prioritas_kegiatan:', eventData.priositas_kegiatan);
                console.log('prioritas_kegiatan:', eventData.nama_kegiatan);

                if (eventData && eventData["priositas_kegiatan"] === '3') {
                    cell.querySelector('a').id = 'urgent';
                } else if (eventData && eventData["priositas_kegiatan"] === '2') {
                    cell.querySelector('a').id = 'important';
                } else if (eventData && eventData["priositas_kegiatan"] === '1') {
                    cell.querySelector('a').id = 'not-important';
                }
                
                cell.title = eventData["nama_kegiatan"]; // Set the cell title here
            }
        }
    };

    xhr.send();
}


  
  
function goToPreviousMonth() {
    currentMonth--; // Decrease the current month
    if (currentMonth === 0) {
        currentMonth = 12;
        currentYear--;
    }
    generateCalendar(currentMonth, currentYear);
}

function goToNextMonth() {
    currentMonth++; // Increase the current month
    if (currentMonth === 13) {
        currentMonth = 1;
        currentYear++;
    }
    generateCalendar(currentMonth, currentYear);
}

document.querySelector('.prev').addEventListener('click', goToPreviousMonth);
document.querySelector('.next').addEventListener('click', goToNextMonth);

// Call the function with the current month and year
generateCalendar(currentMonth, currentYear);


function getToday(){
    var currentDate1 = new Date();
    var currentDay1 = currentDate1.getDate();
    
    var tableCells = document.querySelectorAll('.kalender td');
    for (var i = 0; i < tableCells.length; i++) {
        var cell = tableCells[i];
        if (parseInt(cell.innerText) === currentDay1) {
            cell.classList.add('today');
            break;
        }
    }
}




