<div class="left-menu">
	<div class="inner">
		<div class="logo"></div>
		<ul class="menu">
			<?php foreach($this->tabs as $index => $tab):?>
			<li class="item-left"><a class="<?php echo esc_attr($tab['slug']);?>" href="#tab-<?php echo esc_attr($tab['slug']);?>"><span><?php echo esc_attr($tab['name']);?></span></a></li>
			<?php endforeach;?>
		</ul>
	</div>
</div>