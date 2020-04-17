<?php   
if (!defined('_PS_VERSION_'))
  exit;

class TestModTwo extends Module
{
     public function __construct()
  {
    $this->name = 'testmodtwo';
    $this->tab = 'front_office_features';
    $this->version = '1.0.0';
    $this->author = 'SIGURD WATT';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;
 
    parent::__construct();
 
    $this->displayName = $this->l('Sigurd Module');
    $this->description = $this->l('Description of Sigurds module.');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
    if (!Configuration::get('TESTMODTWO_NAME'))      
      $this->warning = $this->l('No name provided');
  }

public function install()
{
  if (Shop::isFeatureActive())
    Shop::setContext(Shop::CONTEXT_ALL);
 
  if (!parent::install() ||
    !$this->registerHook('leftColumn') ||
    !$this->registerHook('header') ||
    !Configuration::updateValue('TESTMODTWO_NAME', 'my friend')
  )
    return false;
 
  return true;
}

public function uninstall()
{
  if (!parent::uninstall() ||
    !Configuration::deleteByName('TESTMODTWO_NAME')
  )
    return false;
 
  return true;
}



}