<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Vítaj") }} {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 custom-padding">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 overflow-scroll">
                    <h2 class="text-2xl font-bold mb-4">Správa tvojej permanentky:</h2>

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

                    @if(Auth::user()->membership)
                    <table class="min-w-full">
                        <thead>
                        <tr class="border bg-blue-100">
                            <th class="border">Vytvorené</th>
                            <th class="border">Typ permanentky</th>
                            <th class="border">Stav</th>
                            <th class="border">Počet</th>
                            @if(Auth::user()->membership->membership_type == 'Monthly' && Auth::user()->membership->start_date)
                            <th class="border">Začiatok platnosti</th>
                            <th class="border">Koniec platnosti</th>
                            @else
                            @endif
                            @if(Auth::user()->membership->card_id)
                                <th class="border">ID karty</th>
                            @else
                            @endif
                            <th class="border">Akcie</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center border bg-gray-100">
                                {{ Auth::user()->membership->created_at }}
                            </td>
                            <td class="text-center border">
                                @if (Auth::user()->membership->membership_type === 'Single')
                                    Vstupová
                                @elseif (Auth::user()->membership->membership_type === 'Monthly')
                                    Mesačná
                                @else
                                    {{ Auth::user()->membership->membership_type }}
                                @endif
                            </td>
                            <td class="text-center border bg-gray-100">
                                @if (Auth::user()->membership->status === 'Pending Payment')
                                    Čaká sa na platbu
                                @elseif (Auth::user()->membership->status === 'Active')
                                    Aktívna
                                @elseif (Auth::user()->membership->status === 'Inactive')
                                    Ukončená
                                @else
                                    {{ Auth::user()->membership->status }}
                                @endif
                            </td>
                            <td class="text-center border">
                                    {{ Auth::user()->membership->quantity }}
                            </td>
                            {{-- Show start_date only for monthly memberships if it's not null --}}
                            @if(Auth::user()->membership->membership_type == 'Monthly' && Auth::user()->membership->start_date)
                                <td class="text-center border bg-gray-100">
                                    {{ Auth::user()->membership->start_date }}
                                </td>
                                <td class="text-center border">
                                    {{ Auth::user()->membership->end_date }}
                                </td>
                            @else
                            @endif
                            @if(Auth::user()->membership->card_id)
                                <td class="text-center border bg-gray-100">
                                    {{ Auth::user()->membership->card_id }}
                                </td>
                            @else
                            @endif

                            @if(Auth::user()->membership->status == 'Pending Payment')
                                {{-- Delete Membership Button --}}
                                <td class="text-center border bg-gray-100">
                                    <form action="{{ route('delete.membership') }}" method="POST" onsubmit="return confirm('Naozaj chcete zrušiť svoju permanentku?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Zrušiť
                                        </button>
                                    </form>
                                </td>
                            @else
                                {{-- Delete Membership Button --}}
                                <td class="text-center border">
                                    <form action="{{ route('delete.membership') }}" method="POST" onsubmit="return confirm('Naozaj chcete zrušiť svoju permanentku?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Zrušiť
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                    @endif

                    @if(!Auth::user()->membership)
                        <table class="min-w-full">
                            <thead>
                            <tr class="border bg-blue-100">
                                <th class="border">Typ permanentky</th>
                                <th class="border">Počet</th>
                                <th class="border">Akcie</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="border bg-gray-100">
                                    Vstupová
                                </td>
                                <form action="{{ route('order.single.membership') }}" method="POST">
                                    @csrf
                                    <td class="text-center border">
                                        <input type="number" name="quantity" value="1" min="1" class="mt-1 p-2 border rounded-md w-full" required>
                                    </td>
                                    <td class="text-center border bg-gray-100">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Objednať vstupovú permanentku
                                        </button>

                                    </td>
                                </form>
                            </tr>
                            <tr>
                                <td class="border bg-gray-100">
                                    Mesačná
                                </td>
                                <form action="{{ route('order.monthly.membership') }}" method="POST">
                                    @csrf
                                    <td class="text-center border">
                                            <input type="number" name="quantity" value="1" min="1" class="mt-1 p-2 border rounded-md w-full" required>
                                    </td>
                                    <td class="text-center border bg-gray-100">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Objednať mesačnú permanentku
                                        </button>

                                    </td>
                                </form>
                            </tr>


                            </tbody>
                        </table>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
