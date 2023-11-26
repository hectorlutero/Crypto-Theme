<nav id="custom-menu" class="menu navbar relative px-2">

	<div class="mobile-menu">
		<div class="logo-container py-3 lg:py-0">
			<?php
			$logo = get_custom_logo();
			if (!empty($logo)) {
				echo $logo;
			}
			?>
		</div>
		<div class="mobile-menu-icon relative">
			<div class="hamburguer-bt">
				<div class="hamburguer-bt__stripe hamburguer-bt__stripe__top"></div>
				<div class="hamburguer-bt__stripe hamburguer-bt__stripe__middle"></div>
				<div class="hamburguer-bt__stripe hamburguer-bt__stripe__bottom"></div>
			</div>
		</div>
	</div>

	<ul class="menu-list hidden lg:flex justify-center items-center gap-5">

		<?php
		wp_nav_menu(array(
			'theme_location' => 'custom-menu', // Use the location name you registered
			'menu_class' => 'menu',
			'container' => false,
		));
		?>
			<?php if (get_locale() === "pt_BR") : ?>
		
		<li class="transition ease-in-out duration-300 schedule-li"><a href="https://link.sst.trade/login-sst" target="_blank" class="login-btn">Login</a></li>
			<?php else : ?>
		<li class="transition ease-in-out duration-300 schedule-li"><a href="https://portalen.sst.trade" target="_blank" class="login-btn">Login</a></li>
			<?php endif; ?>
		
		<span class="hidden"></span>
	</ul>
	<div class="mobile-menu-sidebar">

		<ul class="nav-list flex flex-col items-end gap-10">
			<?php
			wp_nav_menu(array(
				'theme_location' => 'custom-menu', // Use the location name you registered
				'menu_class' => 'menu',
				'container' => false,
			));
			?>
			<?php if (get_locale() === "pt_BR") : ?>
				<li class="transition ease-in-out duration-300 opacity-100 schedule-li"><a href="https://link.sst.trade/login-sst" target="_blank" class="login-btn">Login</a></li>
			<?php else : ?>
				<li class="transition ease-in-out duration-300 opacity-100 schedule-li"><a href="https://portalen.sst.trade" target="_blank" class="login-btn">Login</a></li>
			<?php endif; ?>
		</ul>
	</div>
	<style>
		.hamburguer-bt {
			cursor: pointer;
			height: 100%;
			position: absolute;
			right: 0%;
			top: -10px;
			width: 40px;
			margin-top: 0px;
			transition: all .2s ease-out;
		}

		.hamburguer-bt .hamburguer-bt__stripe {
			width: 100%;
			height: 5px;
			background: #fff;
			margin: 4px auto;
			transition: all 0.3s;
			border-radius: 5px;
			backface-visibility: hidden;
		}

		.hamburguer-bt.on .hamburguer-bt__stripe__top {
			transform: rotate(45deg) translate(4px, 10px);
		}

		.hamburguer-bt.on .hamburguer-bt__stripe__middle {
			opacity: 0;
			transform: rotate(45deg) scale(0);
		}

		.hamburguer-bt.on .hamburguer-bt__stripe__bottom {
			transform: rotate(-45deg) translate(2px, -10px);
		}
	</style>
</nav>