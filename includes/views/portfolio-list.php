
 
<div id="portfolio-list">   
     <?php foreach($this->portfolioArray as $portfolioItem ): ?>
     
          <div class="portfolio-item">
          
               <h2><?php echo $portfolioItem->title ?></h2>
               
               <div>
                    <p><?php echo $portfolioItem->metaDescription ?></p>
                    
                    <p>More on <a href="/portfolio/<?php echo $portfolioItem->id ?>"><?php echo $portfolioItem->title ?></a>...</p>
               </div>
          </div>
          
     <?php endforeach ?>
</div>

