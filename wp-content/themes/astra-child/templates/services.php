<div class="container w-full md:w-[80%] mx-auto services-container flex flex-wrap lg:grid lg:grid-cols-2 gap-20 p-3">
    <?php 
        $services = get_field('servicos', 8);

        foreach ($services as $service) {
            ?>
            <div class="service-card hidden-el from-down px-10 py-10 text-center bg-[#DBC7AC] flex flex-col justify-start  rounded-2xl gap-5">
                <div class="icon-container flex justify-center bg-[#3c3231] rounded-full w-[100px] h-[100px] mx-auto -mt-20 mb-5">
                    <img src="<?php echo $service['icone'] ?>" alt="<?php echo $service['titulo'] ?>" class="w-full p-5" >
                </div>
                <div class="flex flex-col justify-between gap-5">
                    <h4 class="h4 service-title font-bold fopnt-xl text-[#3C3231]"><?php echo $service['titulo'] ?></h4>
                    <p>"<?php echo $service['descricao'] ?></p>
                </div>
            </div>
            <?php
        }
    
    ?>
   
</div>