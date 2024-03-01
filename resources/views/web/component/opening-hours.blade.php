<section class="hodiny_sekcia">
    <h2 class="hodiny_heading">Otváracie hodiny</h2>
    <div class="bar"></div>

    <div class="hodiny_container">
        <div id="status-dot"></div>
        <p id="opening-hours-message"></p>
    </div>
    <div id="opening-times_container">
        <table>
            <tr>
                <td>Pondelok</td>
                <td>8:00 - 21:00</td>
            </tr>
            <tr>
                <td>Utorok</td>
                <td>8:00 - 21:00</td>
            </tr>
            <tr>
                <td>Streda</td>
                <td>8:00 - 21:00</td>
            </tr>
            <tr>
                <td>Štvrtok</td>
                <td>8:00 - 21:00</td>
            </tr>
            <tr>
                <td>Piatok</td>
                <td>8:00 - 21:00</td>
            </tr>
            <tr>
                <td>Sobota</td>
                <td>15:00 - 20:00</td>
            </tr>
            <tr>
                <td>Nedeľa</td>
                <td>15:00 - 20:00</td>
            </tr>
        </table>
    </div>

    <script>
        var currentDate = new Date();
        var currentDay = currentDate.getDay();
        var currentHour = currentDate.getHours();

        var statusDotElement = document.getElementById("status-dot");
        var openingHoursMessageElement = document.getElementById("opening-hours-message");

        var weekdaysOpeningHour = 8;
        var weekdaysClosingHour = 21;
        var weekendOpeningHour = 15;
        var weekendClosingHour = 20;

        if (
            (currentDay >= 1 && currentDay <= 5 && currentHour >= weekdaysOpeningHour && currentHour < weekdaysClosingHour) ||
            (currentDay >= 6 && currentDay <= 7 && currentHour >= weekendOpeningHour && currentHour < weekendClosingHour)
        ) {
            statusDotElement.classList.add("blink");
            statusDotElement.style.backgroundColor = "#8add8a";
            openingHoursMessageElement.textContent = "Momentálne máme otvorené!";
            openingHoursMessageElement.style.color = "#8add8a";
        } else {
            statusDotElement.style.backgroundColor = "#C32A2A";
            openingHoursMessageElement.textContent = "Momentálne máme zatvorené";
            openingHoursMessageElement.style.color = "#C32A2A";
        }
    </script>


</section>
