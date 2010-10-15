<?php

require_once 'webpage/Page.php';

Class ContactPage extends Page{

     //NEEDS WORK!!!!

     function ContactPage($dbPDO, $emailDetails){
            
						//echo 'here';
						
						$this->dbPDO= $dbPDO;
						//$this->menuID=$menuID;
			
							
  			    //$emailDetails=$emailDetails['contact'];
            //print_r($emailDetails);
            
            require_once('ContactFormSheila.php');
            
            //set up the form
            $form=new ContactFormSheila($dbPDO,$emailDetails);
            
            if(!$form->validate()){
                 
            $this->contentString .=  '
            <p>Please use this form to get in touch</strong>:<br /></p></p>&nbsp;</p>
            ';
            
                     $this->contentString .=   $form->getForm();
            }		
            
            //handle submission				
            else{
                    $this->contentString .= '<p>Thank you for your message.</p>';
                    $this->contentString .=  '<p style="margin-top: 100px">&nbsp;</p>';
                      }			 
            			

		    $this->contentString .=  '
		  
			   <h2>Contact address</h2>
			   
					<p>Gary Straughan<br />
					BRAINBOX Webtech Limited<br />
					Oxford Road South<br />
					Chiswick<br />
					London W4 3DD</p>
					
					<p>07834 003 110</p>
					
					
			   
			   <h3>Registered office </h3>
			   
					<p>BRAINBOX Webtech Limited is Registered in England and Wales<br />
					Company registration number: 7404796</p>
					
	 
					<p>c/o Deacon\'s Chartered Accountants & Registered Auditors<br />
					The Stables<br />
					Shipton Bridge Farm<br />
					Widdington<br />
					Saffron Walden<br />
					Essex CB11 3SU</p>
	 		  
		  ';

     }
		

}
?>