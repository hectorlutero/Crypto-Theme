<template>
  <div v-show="modalActive" class="modal flex flex-col justify-center">
    <div v-show="modalActive" class="modal-inner mt-40">
      <div v-if="coin">
        <div class="bg-zinc-100 rounded-md w-1/2 mx-auto shadow-2xl">
          <div class="modal-header flex justify-end pt-5 px-5">
            <i @click="close" class="far fa-times-circle"></i>
            <button @click="close" type="button">Close</button>
          </div>
          <div class="modal-content p-5 flex divide-x gap-5">
            <div class="primary-info w-1/2 flex flex-col gap-3 p-2">
              <h2 class="text-2xl uppercase">{{ coin.name }}</h2>
              <hr />
              <div class="h-72 w-full overflow-x-hidden">
                {{ coin.description.en }}
              </div>
            </div>
            <div class="secondary-info w-1/2 flex flex-col gap-4 p-4">
              <h2>{{ coin.name }}</h2>
              <p>Symbol: {{ coin.symbol }}</p>
              <p>Current Price: {{ coin.current_price }}</p>
              <p>Market Cap: {{ coin.market_cap }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['modalActive', 'coin'],

  setup(props, { emit }) {
    const close = () => {
      emit('close');
    };

    return { close };
  },
};
</script>

<style scoped>
.modal {
  /* background: #00000034; */
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}
</style>
