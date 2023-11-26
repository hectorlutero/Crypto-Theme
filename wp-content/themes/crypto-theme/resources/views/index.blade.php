@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-medium text-center mt-20 uppercase">Check out the top 10 Cryptocurrencies</h1>
    <div class="container mx-auto mt-20 pb-20">
        {{-- HERE'S WHERE THE MAGIC HAPPENS: 
                - The #crypto is where Vue.js recognizes and renders the crypto table
                - follow app.js to check the data flow.
            --}}
        <div id="crypto"></div>
    </div>
@endsection
