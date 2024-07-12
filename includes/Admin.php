<?php
namespace ADS\WTC;

use \ADS\WTC\Admin\Notice;
use \ADS\WTC\Admin\Menu;

class Admin{
    public function __construct(){
        // new Notice(); // Plugin Admin notice
        new Menu(); // Plugin Admin Menu 
        
    }
}



