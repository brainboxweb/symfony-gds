<?php

require_once('forms/ContactFormPDO.php');

Class ContactFormSheila extends ContactFormPDO{

   function __construct($dbPDO,$emailDetails){
	            
        $this->dbPDO=$dbPDO;
        $this->emailDetails=$emailDetails;
        //call the parent constructor
        parent::__construct($dbPDO,$emailDetails);	#Handles the call to Quickform

   }						
   
	 
   function setForm(){           					 
              
      $this->form->removeAttribute('name'); //for XHTML compliance
      
       $this->form->addElement('text','email-email','',array('class'=>'honey'));

      
      $this->form->addElement('text','name','Name',array('class'=>'text'));
      //$this->form->addElement('text','company','Organisation',array('class'=>'text'));
      $this->form->addElement('text','email','Email',array('class'=>'text'));
     
      $this->form->addElement('text','phone','Telephone',array('class'=>'text'));
      //$this->form->addElement('text','phone','Phone number',array('class'=>'text'));
      
      $attrs = array("rows"=>"10", "cols"=>"50"); 
      $this->form->addElement('textarea','description','Message',$attrs);
      
      $this->form->addElement('submit','submit','Submit', array('class'=>'button'));
      
      
      //Spam-killer rules - work on the SERVER side only
      
      //RULES
       $this->form->addRule('email-email',      'Field must be left blank',               'regex','/^$/' ,'client');
      $this->form->addRule('name',      'Please enter your name',               'required','' ,'client');
      $this->form->addRule('email',     'Please enter your email address',      'required','' ,'client');
      $this->form->addRule('email',     'Please enter a valid email address',   'email','' ,'client');  
      $this->form->addRule('description','Please enter a short message',    'required','' ,'client');
      
      //low key spam protection: no puctuation (to prevent email addresses in evey field
      $this->form->registerRule('no_at','regex','/^[^@]+$/');
      $this->form->addRule('name',       'The "@" character is not allowed in this field.',      'no_at');
      // $this->form->addRule('company',    'The "@" character is not allowed in this field.',      'no_at');
      $this->form->addRule('description','The "@" character is not allowed in this field.',     'no_at');
      
      //SPAM STUFF
      $this->form->registerRule('noEmailHeaders','function','noEmailHeaders');
      $this->form->addRule('name',       'The text "Content-Type" is not allowed in this field.',      'noEmailHeaders');
      // $this->form->addRule('company',    'The text "Content-Type" is not allowed in this field.',      'noEmailHeaders');
      $this->form->addRule('email',      'The text "Content-Type" is not allowed in this field.',      'noEmailHeaders');
      //$this->form->addRule('phone',      'The text "Content-Type" is not allowed in this field.',      'noEmailHeaders');
      $this->form->addRule('description','The text "Content-Type" is not allowed in this field.',      'noEmailHeaders');
              
     }
}

