# prestashop-migration

Miration Tools
- upgrade only the database, using official released upgrade sql scripts. Tested for v1.5.6.1 -> v1.7.5.1

## Usage

- backup & restore your db
- copy existing config/settings.inc.php to this dir
- download PS installer prestashop_x.x.x.x.zip
- apt-get install php-mysql
- execute ./upgrade_db.php

Note: use mysql 5.5 during upgrade - later versions do not work due to v5.5 specific SQL code.

## Expected output
```
./upgrade_db.php ../prestashop_1.7.5.1.zip
unzipping ../prestashop_1.7.5.1.zip to ./install ...
upgrading database
PHP Warning:  Cannot modify header information - headers already sent by (output started at /root/upgrade_db/upgrade_db.php:12) in /root/upgrade_db/install/ps/install/upgrade/upgrade.php on line 123
<?xml version="1.0" encoding="UTF-8"?><action result="ok" id="">
<action result="info" id="1.5.6.2"><![CDATA[[OK] SQL 1.5.6.2 : SET NAMES 'utf8']]></action>

<action result="info" id="1.6.0.1"><![CDATA[[OK] SQL 1.6.0.1 : SET NAMES 'utf8']]></action>

<action result="info" id="1.6.0.1"><![CDATA[[OK] SQL 1.6.0.1 : INSERT INTO `ps_configuration` (`name`, `value`, `date_add`, `date_upd`) VALUES('PS_DASHBOARD_USE_PUSH', '0', NOW(), NOW())]]></action>

...

<action result="info" id="1.7.5.1"><![CDATA[[OK] SQL 1.7.5.1 : -- Update default links in quick access
UPDATE `ps_quick_access` SET `link` = &quot;index.php/improve/modules/manage&quot;
  WHERE link = &quot;index.php/module/manage&quot;]]></action>

<action result="info" id="1.7.5.1"><![CDATA[[OK] SQL 1.7.5.1 : UPDATE `ps_quick_access` SET `link` = &quot;index.php/sell/catalog/products/new&quot;
  WHERE link = &quot;index.php/product/new&quot;]]></action>

<action result="info" id="1.7.5.1"><![CDATA[[OK] PHP 1.7.5.1 : /* PHP:ps_1751_update_module_sf_tab(); */]]></action>

old db version=1.5.6.1
new db version=1.7.5.1

upgrade_db COMPLETED
```
