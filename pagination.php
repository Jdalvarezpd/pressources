<?php $numero_paginas = numero_paginas(3, $conexion); ?>

<section>
	<div class="container">
		<div class="row">
			<nav aria-label="...">
				<div class="text-center">
					<ul class="pagination pagination-lg center-ob">
						<?php if(func_pagina_actual() == 1): ?>
						<!--<li class="disabled">&laquo;</li>-->
					 	<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
						<?php else: ?>
						<li><a href="<?php echo RUTA; ?>/searchprofile.php?p=<?php echo func_pagina_actual() - 1; ?>">&laquo;</a></li>	
	
						<?php endif; ?>	
	
						<?php for ($i=1; $i <=$numero_paginas; $i++): ?>
							<?php if(func_pagina_actual() === $i): ?>
	
							<!--<li class="active"><?php echo  $i; ?></li>-->
							<li class="active"><a href="#"><?php echo  $i; ?> <span class="sr-only">(current)</span></a></li>
	
							<?php else: ?>
								<li><a href="<?php echo RUTA; ?>/searchprofile.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
							<?php endif; ?>
						<?php endfor; ?>

						<?php if(func_pagina_actual() == $numero_paginas): ?>
							<!--<li class="disabled">&raquo;</li>-->
							<li class="disabled"><a href="<?php echo RUTA; ?>/searchprofile.php?p=<?php echo func_pagina_actual() + 1; ?>" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>
						<?php else: ?>
							<li><a href="<?php echo RUTA; ?>/searchprofile.php?p=<?php echo func_pagina_actual() - 1; ?>">&raquo;</a></li>
						<?php endif; ?>		
					</ul>	
				</div>
			</nav>	
		</div>
	</div>
	
</section>
