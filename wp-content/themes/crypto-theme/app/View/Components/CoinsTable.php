<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CoinsTable extends Component
{
    public $topTenCoins;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Fetch data from CoinGecko API using the function
        $this->topTenCoins = $this->getTopTenCoinsData();
    }

    /**
     * Get the Top 10 CoinGecko data using the function from functions.php
     *
     * @return array|false
     */
    private function getTopTenCoinsData()
    {
        include_once(get_template_directory() . '/functions.php');
        return get_top_10_cryptos();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.coins-table');
    }
}
