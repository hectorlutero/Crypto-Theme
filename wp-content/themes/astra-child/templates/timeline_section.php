<div class="timeline-section container  mx-auto w-full h-full">
    <div class="relative wrap overflow-hidden p-10 h-full">
        <div class="border-2-2 absolute border-opacity-20 border-gray-300 h-full border" style="left: 50%"></div>

        <?php
        $timeline_data = array(
            array(
                'number' => '2016',
                'title' => 'Surgimento do SST',
                'content' => 'Surgimento do SST com a união de traders que buscavam melhores condições no mercado financeiro.',
                'bg_color' => 'bg-gray-900 group-hover:bg-red-400',
                'text_color' => 'text-white',
            ),
            array(
                'number' => '2017',
                'title' => 'Início da Revolução',
                'content' => 'João Homem e Rodrigo Puga (CEO Modalmais) anunciam a possibilidade de qualquer pessoa obter benefícios de custos reduzidos de corretagem, causando uma mudança significativa no mercado de varejo da bolsa de valores brasileira.',
                'bg_color' => 'bg-gray-900 group-hover:bg-red-400',
                'text_color' => 'text-white',
            ),
            array(
                'number' => '2018',
                'title' => 'Crescimento Exponencial',
                'content' => 'O SST, carinhosamente chamado de Esquadrão, ultrapassa a marca de 12 mil membros.<br><br>Eduardo Garufi lança o projeto "Drops Consistência do Trader 365", com 365 vídeos educacionais focados em experiência, técnicas e mindset para operações no mercado financeiro.<br><br>SST inaugura a SST Tower, uma sede física para a comunidade, e anuncia a corretagem zero, um marco importante para os investidores.',
                'bg_color' => 'bg-gray-900 group-hover:bg-red-400',
                'text_color' => 'text-white',
            ),
            array(
                'number' => '2019',
                'title' => 'Expansão e Novos Desafios',
                'content' => 'João Homem e Eduardo Garufi viajam aos EUA a convite da CME Group (Bolsa de Chicago) para apresentar o Suicide Squad Traders e buscar novas tecnologias e soluções para o mercado brasileiro.<br><br>Eduardo Garufi lança o maior EAD da Bolsa de Valores, o The North, marcando o início de uma nova fase do Esquadrão, que passou a se chamar Special Squad Traders (SST).',
                'bg_color' => 'bg-gray-900 group-hover:bg-red-400',
                'text_color' => 'text-white',
            ),
            array(
                'number' => '2020',
                'title' => 'Expansão Continuada',
                'content' => 'SST atinge a marca de 61 mil membros, demonstrando sua expansão contínua.',
                'bg_color' => 'bg-gray-900 group-hover:bg-red-400',
                'text_color' => 'text-white',
            ),
            array(
                'number' => '2021',
                'title' => 'Reestruturação e Crescimento',
                'content' => 'SST passa por uma reestruturação interna para desenvolvimento de um ecossistema cada vez mais completo para os investidores.',
                'bg_color' => 'bg-gray-900 group-hover:bg-red-400',
                'text_color' => 'text-white',
            ),
            array(
                'number' => '2022',
                'title' => 'Consolidação no Mercado',
                'content' => 'SST sai dos bastidores e volta ao mainstream, consolidando ainda mais sua presença no mercado financeiro brasileiro.',
                'bg_color' => 'bg-gray-900 group-hover:bg-red-400',
                'text_color' => 'text-white',
            ),
            array(
                'number' => '2023',
                'title' => 'Internacionalização',
                'content' => 'SST alcança um novo patamar ao se internacionalizar, expandindo sua influência para além das fronteiras do Brasil.',
                'bg_color' => 'bg-gray-900 group-hover:bg-red-400',
                'text_color' => 'text-white',
            ),
        );



        foreach ($timeline_data as $key => $item) :
            $is_right_timeline = ($key % 2 == 0); // Alternate between left and right timeline

            if ($is_right_timeline) :
        ?>
                <!-- Right timeline -->
                <div class="mb-16 lg:mb-8 group flex flex-col lg:flex-row justify-between items-center w-full right-timeline gap-5 lg:gap-0">
                    <div class="order-1 w-5/12"></div>
                    <div class="z-20 flex items-center justify-center order-1  <?php echo $item['bg_color']; ?> shadow-xl w-16 h-16 rounded-full">
                        <h1 class="mx-auto font-semibold text-lg <?php echo $item['text_color']; ?>"><?php echo $item['number']; ?></h1>
                    </div>
                    <div class="order-1 hidden-el from-right <?php echo $item['bg_color']; ?>  rounded-lg shadow-xl w-5/12 px-6 py-4">
                        <h3 class="mb-3 font-bold <?php echo $item['text_color']; ?>  text-xl"><?php echo $item['title']; ?></h3>
                        <p class="text-sm leading-snug tracking-wide <?php echo $item['text_color']; ?> text-opacity-100"><?php echo $item['content']; ?></p>
                    </div>
                </div>
            <?php else : ?>
                <!-- Left timeline -->
                <div class="mb-16 lg:mb-8 group flex justify-between flex-col lg:flex-row-reverse items-center w-full left-timeline gap-5 lg:gap-0">
                    <div class="order-1 w-5/12"></div>
                    <div class="z-20 flex items-center justify-center order-1 <?php echo $item['bg_color']; ?>  shadow-xl w-16 h-16 rounded-full">
                        <h1 class="mx-auto font-semibold text-lg <?php echo $item['text_color']; ?>"><?php echo $item['number']; ?></h1>
                    </div>
                    <div class="order-1 hidden-el from-left <?php echo $item['bg_color']; ?>  rounded-lg shadow-xl w-5/12 px-6 py-4">
                        <h3 class="mb-3 font-bold <?php echo $item['text_color']; ?> text-xl"><?php echo $item['title']; ?></h3>
                        <p class="text-sm font-medium leading-snug tracking-wide <?php echo $item['text_color']; ?> text-opacity-100"><?php echo $item['content']; ?></p>
                    </div>
                </div>
        <?php endif;
        endforeach; ?>
    </div>
</div>