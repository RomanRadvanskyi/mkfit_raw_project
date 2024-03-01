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
                    <h2 class="text-2xl font-bold mb-4">Správa permanentiek:</h2>

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

                    <table class="min-w-full" >
                        <thead>
                        <tr class="border bg-blue-100">
                            <th class="border">ID permanentky</th>
                            <th class="border">Vytvorené</th>
                            <th class="border">Meno a priezvisko</th>
                            <th class="border">Telefón</th>
                            <th class="border">Email</th>
                            <th class="border">Typ permanentky</th>
                            <th class="border">Počet</th>
                            <th class="border">Stav</th>
                            <th class="border">Začiatok platnosti</th>
                            <th class="border">Koniec platnosti</th>
                            <th class="border">Pridelené ID karty</th>
                            <th class="border">Akcie</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($memberships as $membership)
                            @if ($membership->user)
                                <tr data-membership-id="{{ $membership->id }}">
                                    <td class="text-center border bg-gray-100">{{ $membership->id }}</td>
                                    <td class="text-center border ">{{ $membership->created_at }}</td>
                                    <td class="text-center border bg-gray-100">{{ $membership->user->name }}</td>
                                    <td class="text-center border ">{{ $membership->user->phone }}</td>
                                    <td class="text-center border bg-gray-100">{{ $membership->user->email }}</td>
                                    <td class="text-center border ">
                                        @if ($membership->membership_type === 'Single')
                                            Vstupová
                                        @elseif ($membership->membership_type === 'Monthly')
                                            Mesačná
                                        @else
                                            {{ $membership->membership_type }}
                                        @endif
                                    </td>
                                    <td class="text-center border bg-gray-100">{{ $membership->quantity }}</td>
                                    <td class="text-center border">
                                        @if ($membership->status === 'Pending Payment')
                                            Čaká sa na platbu
                                        @elseif ($membership->status === 'Active')
                                            Aktívna
                                        @elseif ($membership->status === 'Inactive')
                                            Ukončená
                                        @else
                                            {{ $membership->status }}
                                        @endif
                                    </td>
                                    <td class="text-center border bg-gray-100">{{ $membership->start_date ?? 'N/A' }}</td>
                                    <td class="text-center border">{{ $membership->end_date ?? 'N/A' }}</td>

                                @if ($membership->status !== 'Pending Payment')
                                    <td class="text-center border bg-gray-100">{{ $membership->card_id ? $membership->card_id : 'N/A' }}</td>
                                    <td class="text-center border">
                                        <button onclick="editMembership({{ $membership->id }}, {{ $membership->card_id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                            Upraviť
                                        </button>
                                        <form action="{{ route('admin.cancel.membership', ['id' => $membership->id]) }}" method="POST" onsubmit="return confirm('Naozaj chcete odstrániť túto permanentku?');">
                                            @csrf
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                                Odstrániť
                                            </button>
                                        </form>
                                    </td>
                                    @else
                                        <form action="{{ route('admin.pay.membership', ['id' => $membership->id]) }}" method="POST">
                                            @csrf
                                            <td class="text-center border bg-gray-100">
                                                <input type="number" name="cardId" value="1" min="1" class="mt-1 p-2 border rounded-md w-full" required>
                                            </td>
                                            <td class="text-center border">
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                                    Zaplatiť
                                                </button>
                                        </form>
                                        <form action="{{ route('admin.cancel.membership', ['id' => $membership->id]) }}" method="POST" onsubmit="return confirm('Naozaj chcete odstrániť túto permanentku?');">
                                            @csrf
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                                Odstrániť
                                            </button>
                                        </form>
                                            </td>
                                    @endif

                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(isset($membership))
        <script>
            // Function to edit membership dynamically
            function editMembership(membershipId, currentCardId) {
                const trElement = document.querySelector(`tr[data-membership-id="${membershipId}"]`);

                if (!trElement) {
                    console.error(`Membership with ID ${membershipId} not found.`);
                    return;
                }

                const tdCardId = trElement.querySelector('td:nth-child(11)'); // Assuming card_id is in the 11th column
                const tdActions = trElement.querySelector('td:nth-child(12)'); // Assuming "Akcie" is in the 12th column

                if (!tdCardId || !tdActions) {
                    console.error(`tdElement not found for membership with ID ${membershipId}.`);
                    return;
                }

                tdCardId.innerHTML = '';

                const inputElement = document.createElement('input');
                inputElement.type = 'number';
                inputElement.value = currentCardId || ''; // Set the current card_id as the initial value
                inputElement.min = '1';

                const saveButton = document.createElement('button');
                saveButton.innerText = 'Uložiť';
                saveButton.className = 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300';
                saveButton.addEventListener('click', () => saveMembershipEdit(membershipId, inputElement.value));

                const cancelButton = document.createElement('button');
                cancelButton.innerText = 'Zrušiť';
                cancelButton.className = 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-300';
                cancelButton.addEventListener('click', () => cancelMembershipEdit(membershipId, currentCardId));

                tdCardId.appendChild(inputElement);
                tdActions.innerHTML = ''; // Clear "Akcie" column
                tdActions.appendChild(saveButton);
                tdActions.appendChild(cancelButton);
            }

            // Function to save edited membership
            async function saveMembershipEdit(membershipId, newCardId) {
                try {
                    // Check if the new card_id is already assigned to another membership
                    const isCardIdAssigned = Array.from(document.querySelectorAll('td:nth-child(11)'))
                        .map(td => td.textContent.trim())
                        .some(cardId => cardId === newCardId.toString());

                    if (isCardIdAssigned) {
                        alert('Toto ID karty je už priradené k inej permanentke! Vyberte si iné ID karty.');
                        return;
                    }

                    const response = await fetch(`/admin/edit/membership/${membershipId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            card_id: newCardId,
                        }),
                    });

                    if (!response.ok) {
                        throw new Error('Failed to update membership');
                    }

                    const data = await response.json();
                    console.log(data.message);

                    // Refresh only the edited row
                    const trElement = document.querySelector(`tr[data-membership-id="${membershipId}"]`);
                    trElement.innerHTML = data.updatedRow;

                } catch (error) {
                    console.error('Error:', error);
                }
            }

            // Function to cancel membership edit
            function cancelMembershipEdit(membershipId, currentCardId) {
                const trElement = document.querySelector(`tr[data-membership-id="${membershipId}"]`);
                if (!trElement) {
                    console.error(`Membership with ID ${membershipId} not found.`);
                    return;
                }

                const tdCardId = trElement.querySelector('td:nth-child(11)'); // Assuming card_id is in the 11th column
                const tdActions = trElement.querySelector('td:nth-child(12)'); // Assuming "Akcie" is in the 12th column

                if (!tdCardId || !tdActions) {
                    console.error(`tdElement not found for membership with ID ${membershipId}.`);
                    return;
                }

                tdCardId.innerHTML = currentCardId || 'N/A'; // Restore the original card_id value

                // Restore "Akcie" column with "Edit" and "Odstrániť" buttons
                tdActions.innerHTML = `
            <button onclick="editMembership(${membershipId}, ${currentCardId})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                Upraviť
            </button>
            <form action="{{ route('admin.cancel.membership', ['id' => $membership->id]) }}" method="POST" onsubmit="return confirm('Naozaj chcete odstrániť túto permanentku?');">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Odstrániť
                </button>
            </form>
`;
            }
        </script>
    @endif

</x-app-layout>
