					</div>
				</div>
			</div>
			<div id="content">
				<div class="container">
					<div class="left-container">
						<div class="vertical-menu">
							<?php
								if($brand == 1){
									require_once 'kfcMenu.tpl';
								}elseif($brand == 2){
									require_once 'hardeesMenu.tpl';
								}else{
									require_once 'Menu.tpl';
								}
							?>
						</div>
					</div>
					<div class="right-container">
