<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Si prihlásený ako administrator!") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 custom-padding">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 overflow-scroll">
                    <h2 class="text-2xl font-bold mb-4">Správa kariet:</h2>

                    @if(session('success'))
                        <div class="bg-green-500 text-white font-bold px-4 py-2 mb-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-500 text-white font-bold px-4 py-2 mb-4 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p>Zoradenie podľa:</p>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="orderSwitch" class="sr-only peer" checked>
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Pridelení užívatelia/ID karty</span>
                    </label>

                    <table class="min-w-full" id="cardTable">
                        <thead>
                        <tr class="border bg-blue-100">
                            <th class="border">ID karty</th>
                            <th class="border">HEX číslo</th>
                            <th class="border">Meno a priezvisko</th>
                            <th class="border">Akcie</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cards as $card)
                            <tr data-card-id="{{ $card->id }}">
                                <td class="text-center border bg-gray-100">{{ $card->id }}</td>
                                <td class="text-center border">{{ $card->rfid_card_number }}</td>
                                <td class="text-center border bg-gray-100">{{ $card->membership ? $card->membership->user->name : 'N/A' }}</td>
                                <td class="text-center border">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Upraviť</button>
                                    @if (!$card->membership)
                                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300"
                                                onclick="deleteCard({{ $card->id }})">Odstrániť</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- Form to add a new card -->
                    <h2 class="text-2xl font-bold mt-8 mb-4">Pridať novú kartu:</h2>
                    <form action="{{ route('admin.cards.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="id" class="block text-gray-700 text-sm font-bold mb-2">ID karty*:</label>
                            <input type="text" name="id" id="id" class="form-input w-full">
                        </div>
                        <div class="mb-4">
                            <label for="rfid_card_number" class="block text-gray-700 text-sm font-bold mb-2">HEX číslo karty*:</label>
                            <input type="text" name="rfid_card_number" id="rfid_card_number" class="form-input w-full">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Pridať kartu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(isset($card))
    <script>
        // Add a function to handle card deletion
        function deleteCard(cardId) {
            if (confirm('Naozaj chcete odstrániť túto kartu?')) {
                // Perform the deletion logic here, e.g., make an AJAX request
                fetch(`/admin/cards/${cardId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to delete card');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data.message);
                        // Update the DOM to remove the corresponding row after successful deletion
                        const deletedRow = document.querySelector(`tr[data-card-id="${cardId}"]`);
                        if (deletedRow) {
                            deletedRow.remove();
                        }

                        // Display flash message dynamically
                        displayFlashMessage(data.message, 'success');
                    })
                    .catch(error => {
                        // Handle errors, e.g., show an error message
                        console.error('Error:', error);
                    });
            }
        }

        // Function to display flash message dynamically
        function displayFlashMessage(message, type) {
            const flashDiv = document.createElement('div');
            flashDiv.className = `bg-${type === 'success' ? 'green' : 'red'}-500 text-white font-bold px-4 py-2 mb-4 rounded`;
            flashDiv.textContent = message;

            // Append the flash message to the body or any specific container
            document.body.appendChild(flashDiv);

            // Optionally, remove the flash message after a certain duration
            setTimeout(() => {
                flashDiv.remove();
            }, 3000); // Adjust the duration as needed
        }

        document.addEventListener('DOMContentLoaded', function () {
            const orderSwitch = document.getElementById('orderSwitch');
            const tableBody = document.querySelector('#cardTable tbody');
            const rows = Array.from(tableBody.querySelectorAll('tr'));

            const editRow = (row) => {
                const rfidCell = row.cells[1];
                const actionsCell = row.cells[3];

                const rfidValue = rfidCell.innerText;

                // Replace content with input fields only for RFID
                rfidCell.innerHTML = `<input type="text" value="${rfidValue}" class="form-input text-center">`;
                actionsCell.innerHTML = '<button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-300">Uložiť</button>';
            };

            const saveRow = async (row) => {
                const rfidCell = row.cells[1];
                const actionsCell = row.cells[3];

                const updatedRfidValue = rfidCell.querySelector('input').value;

                // Send an AJAX request to update the card
                const cardId = row.dataset.cardId;

                try {
                    const response = await fetch(`/admin/cards/${cardId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            rfid_card_number: updatedRfidValue,
                            // Add other fields as needed
                        }),
                    });

                    if (!response.ok) {
                        throw new Error('Failed to update card');
                    }

                    // Handle success, e.g., show a success message
                    const data = await response.json();
                    console.log(data.message);

                    // Replace content with updated values
                    rfidCell.textContent = updatedRfidValue;
                    actionsCell.innerHTML = '<button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Upraviť</button>' +
                        '<button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300" onclick="deleteCard({{ $card->id }})">Odstrániť</button>';

                    // Display flash message dynamically
                    displayFlashMessage(data.message, 'success');
                } catch (error) {
                    // Handle error, e.g., show an error message
                    console.error('Error:', error);
                }
            };

            tableBody.addEventListener('click', function (event) {
                const target = event.target;

                if (target.tagName === 'BUTTON') {
                    const row = target.closest('tr');

                    if (target.innerText.toLowerCase() === 'upraviť') {
                        editRow(row);
                    } else if (target.innerText.toLowerCase() === 'uložiť') {
                        saveRow(row);
                    }
                }
            });

            // Function to update table rows based on the selected order
            const updateTableRows = (orderById) => {
                const sortedRows = rows.slice().sort((a, b) => {
                    let aValue, bValue;

                    if (orderById) {
                        aValue = parseInt(a.cells[0].innerText) || 0;
                        bValue = parseInt(b.cells[0].innerText) || 0;
                    } else {
                        const aUserName = a.cells[2].innerText.toLowerCase();
                        const bUserName = b.cells[2].innerText.toLowerCase();

                        aValue = aUserName === 'n/a' ? Infinity : parseInt(a.cells[0].innerText) || 0;
                        bValue = bUserName === 'n/a' ? Infinity : parseInt(b.cells[0].innerText) || 0;
                    }

                    if (isNaN(aValue)) aValue = 0;
                    if (isNaN(bValue)) bValue = 0;

                    return aValue - bValue;
                });

                tableBody.innerHTML = '';
                sortedRows.forEach(row => tableBody.appendChild(row));
            };

            // Initialize table with default order
            updateTableRows(true);

            // Add an event listener to the switch
            orderSwitch.addEventListener('change', function () {
                updateTableRows(this.checked);
            });
        });
    </script>
    @endif

</x-app-layout>
