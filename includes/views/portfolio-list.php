

    
    
<?php foreach($this->portfolioArray as $portfolioItem ): ?>

    <h2><a href="/portfolio/<?php echo $portfolioItem->id ?>"><?php echo $portfolioItem->title ?></a></h2>
    
    <?php echo $portfolioItem->body ?>
    
<?php endforeach ?>


