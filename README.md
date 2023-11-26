# Fanwave Test - Crypto Theme

A wordpress theme development for crypto currencies.

## Getting Started

### Using Docker

1. Navigate to the project's root folder.
2. Run the following command to set up the project using Docker:
   ```bash
   docker-compose up --build -d
   ```

### Setting up the Theme

1. After the Docker setup, navigate to `wp-content/theme/crypto-theme`.
2. Run the following commands to install dependencies and build the assets:

   ```bash
   composer install
   ```

   ```bash
   # Choose either yarn or npm
   yarn
   # or
   npm install
   ```

   ```bash
   # Choose either yarn or npm
   yarn build
   # or
   npm run build
   ```

These commands will install the necessary dependencies and build the project assets.

### Possible Issues

- In case you run into problems with permission using docker, just enters the wordpress container shell, and execute

```bash
chown -R www-data:www-data .
```

This will set wordpress files to the right ownership.

## Usage

### Overview

This project provides a user interface to view information about the top 10 cryptocurrencies. The user interface is divided into several sections, including a currencies tab, search functionality, a crypto table, and a crypto modal for detailed information.

### Currencies Tab

The currencies tab allows users to switch between different currencies (EUR, USD, JPY). Click on the currency abbreviation (e.g., EUR) to switch between currencies.

```html
<a @click="changeCurrency('eur')">EUR</a>
<a @click="changeCurrency('usd')">USD</a>
<a @click="changeCurrency('jpy')">JPY</a>
```

### Search Functionality

The search functionality enables users to search for specific cryptocurrencies by name or symbol. Type the search query in the input field and press Enter or click the "Search" button.

```html
<input
  type="text"
  v-model="userInput"
  @keyup.enter="searchCrypto"
  placeholder="Search for a crypto"
/>
<button @click="searchCrypto">Search</button>
```

### Crypto Table

The crypto table displays information about the top 10 cryptocurrencies, including symbol, name, current price, and market cap. Click on the table headers to sort the table based on the corresponding column.

```html
<th @click="sortTable('symbol')">Symbol</th>
<th @click="sortTable('name')">Name</th>
<th @click="sortTable('current_price')">Current Price</th>
<th @click="sortTable('market_cap')">Market Cap</th>
```

### Crypto Modal

The crypto modal provides detailed information about a selected cryptocurrency. Click on a row in the table to open the modal and view additional details.

```html
<CryptoModal
  @close="toggleModal"
  :modalActive="modalActive"
  :coin="selectedCoin"
></CryptoModal>
```

### Interactions

- **Currency Change**: Use the currencies tab to switch between different currencies.
- **Search**: Enter a search query and press Enter or click the "Search" button to filter the displayed cryptocurrencies.
- **Sort Table**: Click on the table headers to sort the table based on the selected column.
- **View Details**: Click on a row in the table to open the crypto modal and view detailed information about the selected cryptocurrency.

### API Integration

The project makes use of the CoinGecko API to fetch information about cryptocurrencies. The `loadCoins` method is responsible for making the API call and updating the displayed data.

```javascript
// Example API URL
getApiUrl: function () {
  return `https://api.coingecko.com/api/v3/coins/markets?vs_currency=${this.selectedCurrency}&order=market_cap_desc&per_page=10&page=1&sparkline=false&locale=en`;
},
```

**Note**: Ensure you have the necessary API key and replace it in the URL if required.

Feel free to customize this usage guide based on additional features or specifics of your project.

## Contributing

If you would like to contribute to the project, please follow the [contribution guidelines](CONTRIBUTING.md).
