<?php

foreach($asociados as $asociado){
?>

<ul class="list-inline">
              <li><img src="<?= $asociado->getUrl()?>" alt="<?= $asociado->getDescripcion() ?>"></li>
              <li><?= $asociado->getDescripcion()?></li>
</ul>

<?php
}
?>