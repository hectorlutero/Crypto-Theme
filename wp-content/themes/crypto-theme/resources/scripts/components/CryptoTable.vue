<template>
  <!-- 
  The template part is divided into 4 parts:
    - Currencies Tab
    - Search Functionality
    - Crypto Table
    - Crypto Modal - For checking Crypto details 
 -->

  <div class="" style="height: 800px">
    <div
      class="currencies-tab-container mx-auto divide-x-2 flex items-center max-w-2xl my-20 border rounded"
    >
      <a
        class="w-1/3 text-center p-4 hover:bg-zinc-100 cursor-pointer"
        :class="{ 'bg-zinc-100': selectedCurrency === 'eur' }"
        @click="changeCurrency('eur')"
      >
        EUR
      </a>
      <a
        class="w-1/3 text-center p-4 hover:bg-zinc-100 cursor-pointer"
        :class="{ 'bg-zinc-100': selectedCurrency === 'usd' }"
        @click="changeCurrency('usd')"
      >
        USD
      </a>
      <a
        class="w-1/3 text-center p-4 hover:bg-zinc-100 cursor-pointer"
        :class="{ 'bg-zinc-100': selectedCurrency === 'jpy' }"
        @click="changeCurrency('jpy')"
      >
        JPY
      </a>
    </div>
    <!-- Here I filter the table according to the name and symbol typed by the user -->
    <div class="search-container my-10">
      <input
        type="text"
        class="border outline-none py-2 px-4 rounded-l"
        placeholder="Search for a crypto"
        v-model="userInput"
        @keyup.enter="searchCrypto"
      />
      <button
        type="button"
        class="p-2 bg-amber-300 rounded-r"
        @click="searchCrypto"
      >
        Search
      </button>
    </div>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
      <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
              <th scope="col" class="py-3 px-6" @click="sortTable('symbol')">
                Symbol
              </th>
              <th scope="col" class="py-3 px-6" @click="sortTable('name')">
                Name
              </th>
              <th
                scope="col"
                class="py-3 px-6"
                @click="sortTable('current_price')"
              >
                Current Price
              </th>
              <th
                scope="col"
                class="py-3 px-6"
                @click="sortTable('market_cap')"
              >
                Market Cap
              </th>
            </tr>
          </thead>
          <!-- Here is a loading type screen, using tailwind feature animate-pulse -->
          <tbody v-if="coins.length === 0" class="animate-pulse">
            <tr
              class="bg-white border-b hover:bg-gray-50 transition-all duration-100 ease-in"
              v-for="index in 10"
              :key="index"
            >
              <td class="py-4 px-6">
                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
              </td>
              <td class="py-4 px-6">
                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
              </td>
              <td class="py-4 px-6">
                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
              </td>
              <td class="py-4 px-6">
                <div class="h-2 bg-slate-300 rounded col-span-1"></div>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <!-- Here I have passed the coins array variable as a prop, and I listen to the value of selected coin and modal activation state -->
            <CryptoItem
              :coins="coins"
              @set-selected-coin="getSelectedCoin"
              @modal-active="isModalActive"
            />
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Here I render the modal outside the table for styling purposes, also I listen the the modal activation state when closed,
      and pass the props for modal activation and the selected coin for render its informations -->
  <CryptoModal
    @close="toggleModal"
    :modalActive="modalActive"
    :coin="selectedCoin"
  >
  </CryptoModal>
</template>
<script>
/**
 * THE SCRIPT PART HANDLES THE  TEMPLATE PARTS IN TWO STATES, ON MOUNT AND ON INTERACTIONS:
 *  - To understand it better, we need to understand the data flow when mounted and available interactions.
 *  - On Mount:
 *    - loadCoins: This method makes a API call to retrieve crypto data and renders the table rows.
 *        - it takes the top 10 currencies in market (limited to 10)
 *        - With the response.data it updates the array variable 'coins'
 *        - when coins array variable is updated it rerenders the Component CryptoItem that receives it.
 *          Rendering the Table's rows.
 *
 *  - When Interacting:
 *    - changeCurrency: everytime the currency is changed, it updates the variable selectedCurrency,
 *      and makes the api call again thorugh loadCoins method.
 *
 *    - Table Row Selection: everytime a coin is selected opens up a modal, with informations about that
 *      specific currency.
 *        - Get the selected coin through click. However, you won't see this happening on this component,
 *          because, the rows are rendered in a children Component called CryptoItem.
 *        - In CryptoItems we 'emit' the selected coin value and if the modal is active to it's parent
 *          component, CrytoTable, update the selectedCoin variable state and show its data rendering the
 *          CryptoModal, using toggleModal(),
 *
 *
 *    - Search functionality:
 *      - I have decided to limit the search functionality to only the ten crypto displayed, instead of calling
 *        the API again. Saving API consumption and making the search more efficient using the data already
 *        fetched.
 *      - everytime the user types enter on searchbox or clicks the button search, it triggers searchCrypto(),
 *        instead of when key down or key up, in order to save API calls unnecessarily.
 *      - searchCrypto: It basically filters the coins array comparing with the user input, when nothing is found
 *        renders the ten top Crypto Coins.
 *
 *    - Sort Functionality:
 *      - It's triggered when the user clicks some of the table header cells, calling sortTable()
 *      - sortTable(): will check for which key on table header cell was selected, using sort() javascript
 *        functionality, it going to evaluate the type of data for each each cell row, if it's a string or not.
 *          * String type value: it orders alphabetically using, localeCompare() and sortOrder variable, 1 for
 *          ascending, and -1 for descending
 *          * Number type value: it orders by size, using straight forward, valueA - valueB, thorugh sortOrder too.
 *
 */
import axios from 'axios';
import CryptoItem from './CryptoItem.vue';
import CryptoModal from './CryptoModal.vue';

export default {
  data: function () {
    return {
      coins: [],
      selectedCurrency: 'eur',
      userInput: '',
      sortKey: null,
      sortOrder: 1,
      selectedCoin: null,
      modalActive: false,
    };
  },
  mounted() {
    setTimeout(() => {
      this.loadCoins();
    }, 1500);
  },
  methods: {
    loadCoins: function () {
      axios
        .get(this.getApiUrl())
        .then((response) => {
          this.coins = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    changeCurrency: function (currency) {
      this.selectedCurrency = currency;
      this.coins = [];
      setTimeout(() => {
        this.loadCoins();
      }, 1500);
    },
    getApiUrl: function () {
      return `https://api.coingecko.com/api/v3/coins/markets?vs_currency=${this.selectedCurrency}&order=market_cap_desc&per_page=10&page=1&sparkline=false&locale=en&x_cg_demo_api_key=CG-Dja2R2rhxMMJ9bYxERe3D27n`;
    },
    getSelectedCoin(value) {
      this.selectedCoin = value;
    },
    toggleModal() {
      this.modalActive = !this.modalActive;
    },
    isModalActive() {
      this.toggleModal();
    },
    searchCrypto: function () {
      const filteredCoins = this.coins.filter((coin) => {
        const lowerCaseInput = this.userInput.toLowerCase();
        return (
          coin.name.toLowerCase().includes(lowerCaseInput) ||
          coin.symbol.toLowerCase().includes(lowerCaseInput)
        );
      });
      if (this.userInput && filteredCoins.length > 0) {
        return (this.coins = filteredCoins);
      } else {
        return this.loadCoins();
      }
    },
    sortTable: function (key) {
      if (this.sortKey === key) {
        this.sortOrder *= -1;
      } else {
        this.sortKey = key;
        this.sortOrder = 1;
      }
      this.coins.sort((a, b) => {
        const aValue = a[key];
        const bValue = b[key];

        return (
          (typeof aValue === 'string'
            ? aValue.localeCompare(bValue)
            : aValue - bValue) * this.sortOrder
        );
      });
    },
  },
  components: {
    CryptoItem,
    CryptoModal,
  },
};
</script>
