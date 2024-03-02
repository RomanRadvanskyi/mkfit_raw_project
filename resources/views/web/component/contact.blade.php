<section class="contact_section">

    <div class="contact-flex-container">

        <div class="open-status-container">

            <div class="contact-open-status">
                <div id="status-dot"></div>
                <p id="opening-hours-message"></p>
            </div>
            <div class="contact-opening-times">
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

        </div>


        <div class="contact-info">
            <h2>MK FIT</h2>
            <p>Hlavné námestie 18, Kežmarok</p>
            <p>060 01</p>
            <h2>Zodpovedná osoba</h2>
            <p>Marcel Duda</p>
            <p>Email: <a href="mailto:mkfit@mkfit.sk">mkfit@mkfit.sk</a></p>
            <p>Tel.: <a href="tel:0904567109">0904 567 109</a></p>
        </div>

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
