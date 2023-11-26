<template>
  <tr
    class="bg-white border-b hover:bg-gray-50 transition-all duration-100 ease-in cursor-pointer"
    v-for="coin in coins"
    :key="coin.id"
    v-on:click="selectCoin(coin)"
  >
    <td class="py-4 px-6">
      {{ coin.symbol }}
    </td>
    <td class="py-4 px-6">
      {{ coin.name }}
    </td>
    <td class="py-4 px-6">
      {{ coin.current_price }}
    </td>
    <td class="py-4 px-6">
      {{ coin.market_cap }}
    </td>
  </tr>
</template>

<script>
import CryptoModal from './CryptoModal.vue';
import axios from 'axios';
import { ref } from 'vue';

export default {
  props: {
    coins: Array,
  },
  data() {
    return {
      selectedCoin: null,
      modalActive: false,
    };
  },
  methods: {
    // Everytime a row is clicked it emits modalActivation state to the parent component for opening or closing the modal.
    toggleModal() {
      this.$emit('modal-active', !this.modalActive);
    },
    // Everytime the coin is selected, makes an api call to return the coin details and emits for the parent component to be rendered in the modal.
    selectCoin(coin) {
      axios
        .get(`https://api.coingecko.com/api/v3/coins/${coin.id}`)
        .then((response) => {
          this.selectedCoin = response.data;
          this.$emit('set-selected-coin', response.data);
        })
        .catch((error) => {
          console.log(error);
        });
      this.toggleModal();
    },
  },
  components: {
    CryptoModal,
  },
};
</script>
