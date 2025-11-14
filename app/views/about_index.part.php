<?php
foreach ($imagenes as $imagen) {

?>
  <div id="1" class="tab-pane">
    <div class="row popup-gallery">
      <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="sol">
          <img class="img-responsive" src="<?= $imagen->getUrlPortofolio() ?>" alt="<?= $imagen->getDescripcion() ?>">
          <div class="behind">
            <div class="head text-center">
              <ul class="list-inline">
                <li>
                  <a class="gallery" href="<?= $imagen->getUrlGaleria() ?>" data-toggle="tooltip" data-original-title="Quick View">
                    <i class="fa fa-eye"></i>
                  </a>
                </li>
                <li>
                  <a href="#" data-toggle="tooltip" data-original-title="Click if you like it">
                    <i class="fa fa-heart"></i>
                  </a>
                </li>
                <li>
                  <a href="#" data-toggle="tooltip" data-original-title="Download">
                    <i class="fa fa-download"></i>
                  </a>
                </li>
                <li>
                  <a href="#" data-toggle="tooltip" data-original-title="More information">
                    <i class="fa fa-info"></i>
                  </a>
                </li>
              </ul>
            </div>
            <div class="row box-content">
              <ul class="list-inline text-center">
                <li><i class="fa fa-eye"></i><?= $imagen->getNumVisualizaciones() ?></li>
                <li><i class="fa fa-heart"></i><?= $imagen->getNumLikes() ?></li>
                <li><i class="fa fa-download"></i><?= $imagen->getNumDownloads() ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>



    <?php
  }
    ?>