<?php

Class ContactPage extends Page{

     //NEEDS WORK!!!!

     function ContactPage(& $db, $emailDetails){
            
						//echo 'here';
						
						$this->db=& $db;
						//$this->menuID=$menuID;
			
							
  			    //$emailDetails=$emailDetails['contact'];
            //print_r($emailDetails);
            
            require_once('forms/ContactForm.php');
            
            //set up the form
            $form=new ContactForm($db,$emailDetails);
            
            if(!$form->validate()){
                 
            $this->contentString .=  '
            <p>Please use this form to contact us</strong>:</p>
            ';
            
                     $this->contentString .=   $form->getForm();
            }		
            
            //handle submission				
            else{
                    $this->contentString .= '<p>Thank you for your message.</p>';
                    $this->contentString .=  '<p style="margin-top: 100px">&nbsp;</p>';
                      }			 
            			

     }
		

}
?>