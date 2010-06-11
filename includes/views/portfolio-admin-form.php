
    
<?php  if(!empty($_SESSION['errors']) ): ?>
   
    <p class="error">Please correct the following error(s):</p>
    <ul>
        
        <?php foreach ( $_SESSION['errors'] as $name=>$value): ?>
            
            <li><?php echo $value['msg'] ?></li>
            
         <?php endforeach; ?>
         
    </ul>
    
<?php endif; ?>
    
    

            
<form action="" method="post" name="updateflexiItem" id="updateflexiItem">
    
    <input name="main" type="hidden" value="1" />
    <input name="id"  type="hidden" value="<?php echo $_GET['id'] ?>" />
    
    <table class="form" border=0>

        <tr>
            <td class="col1">
                            
            <input name="submit1" id="submit1" value="Save" type="submit" style="float:right"/>
            
            
            <div class="container">
                <h3><label for="title">Title</label></h3>
                <input name="title" id="title" type="text" value="<?php echo htmlspecialchars($this->portfolioItem->title ) ?>" class="long checkRequired" />
            </div>
           
                
            <div class="container">
                    <h3><label for="metaTitle">Meta Title</label></h3>
                    <input name="metaTitle" id="metaTitle" type="text" value="<?php echo htmlspecialchars( $this->portfolioItem->metaTitle ) ?>" class="long" />
            </div>
             
            <div class="container">
                <h3><label for="metaDescription">Meta Description</label> <span>For search engine results</span></h3>
                <textarea rows="5" cols="80" name="metaDescription" id="metaDescription" class="description checkRequired"><?php echo $this->portfolioItem->metaDescription  ?></textarea>
            </div>
         
                
                 
                 
        <h3><label for="body">Body</label></h3>
             
              <div class="container">
              <textarea rows="20" cols="80" name="body" id="body" class="checkRequired" ><?php echo  $this->portfolioItem->bodyRaw ?></textarea>
              </div>
       
       
       </td>
                
       
	<td>

         
            <div class="<?php  ?>">
                <h3><label for="isActive">Published</label></h3>
                    
                  <input type="checkbox"  name="isPublished" class="date" "<?php if( $this->portfolioItem->isPublished ) echo ' checked="checked"' ?>" />
                    
	    </div>
            
            </td>
	</tr>
        
      
      
    </table>

</form>

