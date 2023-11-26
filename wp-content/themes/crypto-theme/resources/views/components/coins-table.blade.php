@if ($topTenCoins)
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
                    <tr>
                        <th scope="col"
                            class="py-3 px-6">Symbol</th>
                        <th scope="col"
                            class="py-3 px-6">Name</th>
                        <th scope="col"
                            class="py-3 px-6">Current Price</th>
                        <th scope="col"
                            class="py-3 px-6">Market Cap</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topTenCoins as $coin)
                        <tr class="bg-white border-b hover:bg-gray-50 transition-all duration-200 ease-in-out">
                            <td class="py-4 px-6">{{ $coin['symbol'] }}</td>
                            <td class="py-4 px-6">{{ $coin['name'] }}</td>
                            <td class="py-4 px-6">$ {{ $coin['current_price'] }}</td>
                            <td class="py-4 px-6">{{ $coin['market_cap'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <p>Error fetching data from CoinGecko API</p>
@endif
