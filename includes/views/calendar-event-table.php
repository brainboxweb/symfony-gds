<table class="events">
    <thead>
       <tr><th class="col1">Date</th><th>Details</th></tr>
    </thead>
    <tbody>
        <?php foreach ($eventArray as $event ): ?>
        
            
            
            <tr>
                <td class="col1"><?php echo $event->dateRange(true) ?><br />
         
                    <?php  if((int)$event->daysToGo() > 1): ?>
                               
                        (<?php echo $event->daysToGo() ?> days to go)
                            
                    <?php elseif ($event->daysToGo()==1): ?>
                         
                        (tomorrow)
                               
                    <?php elseif($event->daysToGo()==0): ?>
                             
                        (today)
                              
                    <?php endif ?>
         
                </td>
                <td>
                    <h3><?php echo $event->title ?></h3>
                    <?php echo $event->body ?>
                </td>
            </tr>
  
        <?php endforeach ?>
   </tbody>
</table>