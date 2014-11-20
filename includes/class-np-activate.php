<?php
/**
* Plugin Activation
*/
require_once('class-np-activate-upgrades.php');
class NP_Activate {

	/**
	* Plugin Version
	*/
	private $version;


	public function __construct()
	{
		register_activation_hook( dirname( dirname(__FILE__) ) . '/nestedpages.php', array($this, 'install') );
	}


	/**
	* Activation Hook
	*/
	public function install()
	{
		$this->version = '1.1.5';
		$this->addMenu();
		new NP_ActivateUpgrades($this->version);
		$this->setVersion();
		$this->setOptions();
	}


	/**
	* Set the Plugin Version
	*/
	private function setVersion()
	{
		update_option('nestedpages_version', $this->version);
	}


	/**
	* Add the nav menu if there isnt one
	*/
	private function addMenu()
	{
		if ( !get_option('nestedpages_menu') ){
			$menu_id = wp_create_nav_menu('Nested Pages');
			update_option('nestedpages_menu', $menu_id);
		}
	}


	/**
	* Set Default Options
	*/
	private function setOptions()
	{
		if ( !get_option('nestedpages_menusync') ){
			update_option('nestedpages_menusync', 'sync');
		}
	}


}