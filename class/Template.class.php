<?php 
class Template  
{ 
  private $_templateVars = false;
  public $defaultPath = 'tpl/';

  public function assign($name,$value) 
  { 
    $this->_templateVars[$name] = $value; 
  } 

  public function display($template) 
  {    
    if($this->_templateVars)
    {
      foreach($this->_templateVars as $__key => $__val)
      {
        $$__key = $__val;
      }
    } 
    include($this->defaultPath.$template); 
  }
}