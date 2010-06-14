
 
<div id="portfolio-list">   
     <?php foreach($this->portfolioArray as $portfolioItem ): ?>
     
          <div class="portfolio-item">
          
               <h2><a href="/portfolio/<?php echo $portfolioItem->id ?>"><?php echo $portfolioItem->title ?></a></h2>
               
               <p><?php echo $portfolioItem->metaDescription ?></p>
               
               <p><a href="/portfolio/<?php echo $portfolioItem->id ?>" rel="nofollow">Full details...</a></p>
          
          </div>
          
     <?php endforeach ?>
</div>

