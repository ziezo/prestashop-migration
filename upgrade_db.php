#!/usr/bin/php
<?php

//check files present
if($argc<=1) die("ERROR: pass prestashop zip file as argument, e.g. prestashop_1.7.5.1.zip\n");
$zip = $argv[1];
if(!file_exists($zip)) die("ERROR: zip file not found: $zip\n");

if(!file_exists('settings.inc.php')) die("ERROR: copy settings.inc.php to same directory as this script\n");

//unzip
echo "unzipping $zip to ./install ...\n";
system('rm -rf install');
system("unzip -q -d install $zip");
system('unzip -q -d install/ps install/prestashop.zip');
system('cp settings.inc.php install/ps/config');

//upgrade
echo "upgrading database\n";
$_GET['action']='UpgradeDb';
require('install/ps/install/upgrade/upgrade.php');

//update ps_configuration
echo "old db version=".Configuration::get('PS_VERSION_DB')."\n";
echo "new db version="._PS_INSTALL_VERSION_."\n\n";

if (!$upgrade->hasFailure()) {
    Configuration::updateGlobalValue('PS_HIDE_OPTIMIZATION_TIPS', 0);
    Configuration::updateGlobalValue('PS_NEED_REBUILD_INDEX', 1);
    Configuration::updateGlobalValue('PS_VERSION_DB', _PS_INSTALL_VERSION_);
    echo "upgrade_db COMPLETED\n";
}else{
    echo "upgrade_db FAILED\n";
}
