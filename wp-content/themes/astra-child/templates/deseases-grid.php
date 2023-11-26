<div class="deseases-grid flex flex-wrap lg:grid lg:grid-cols-3 mx-auto justify-center">
    <?php 
        $deseases = get_field('doencas', 8);
        foreach ($deseases as $desease) {
            ?>
            <div class="desease-card hidden-el from-down p-5 flex flex-col justify-between items-center gap-5 animated-slow animated fadeInUp">
                <img src="<?php echo $desease['imagem'] ?>" alt="<?php echo $desease['nome'] ?>" class="desease-picture">
                <h3 class="desease-title text-center font-bold"><?php echo $desease['nome'] ?></h3>
            </div>
            <?php
        }
    ?>
</div>