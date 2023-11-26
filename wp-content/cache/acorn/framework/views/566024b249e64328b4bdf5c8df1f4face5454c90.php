<?php if($topTenCoins): ?>
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
                    <?php $__currentLoopData = $topTenCoins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="bg-white border-b hover:bg-gray-50 transition-all duration-200 ease-in-out">
                            <td class="py-4 px-6"><?php echo e($coin['symbol']); ?></td>
                            <td class="py-4 px-6"><?php echo e($coin['name']); ?></td>
                            <td class="py-4 px-6">$ <?php echo e($coin['current_price']); ?></td>
                            <td class="py-4 px-6"><?php echo e($coin['market_cap']); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <p>Error fetching data from CoinGecko API</p>
<?php endif; ?>
<?php /**PATH /var/www/html/wp-content/themes/crypto-theme/resources/views/components/coins-table.blade.php ENDPATH**/ ?>