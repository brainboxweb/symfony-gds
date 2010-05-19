<div id="homepagenews">
          
     <h2>Latest News</h2>
          
     <?php foreach ($this->newsArray as $news): ?>
             
          <div class="item">
               
               <h3><?php echo $news->title ?></h3>
               <?php echo $news->body ?>
               
          </div>
          
     <?php endforeach ?>
          
</div>