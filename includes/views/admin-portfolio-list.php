
            
                
<form class="add_form" name="addNew" method="post" >
    <input type="hidden" name="action" value="add" />
    <input type="submit" value="Add new item" />
</form>
                
   
                
<table id="itemlist">
    <thead>
        <tr>
           
            <th class="title">Title</th>
        
        </tr>
    </thead>
    <tbody>
                    
        <?php foreach ($this->portfolioArray as $portfolioItem ): ?>              
                   
            <tr class="<?php echo  $portfolioItem->isPublished ? 'active' : 'expired'; ?>">
                <td class="first" style="padding-left: 30px">
                    <a href="/admin/portfolio?id=<?php echo $portfolioItem->id  ?>"><?php echo $portfolioItem->title  ?></a>
                </td>
            </tr>
        
        <?php endforeach ?>
        
    </tbody>

</table>              