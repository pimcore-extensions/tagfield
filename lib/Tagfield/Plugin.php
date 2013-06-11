<?php

class Tagfield_Plugin extends Pimcore_API_Plugin_Abstract implements Pimcore_API_Plugin_Interface {

    /**
     *  install function
     * @return string $message statusmessage to display in frontend
     */
    public static function install() {
        Pimcore_API_Plugin_Abstract::getDb()->query("CREATE TABLE IF NOT EXISTS `plugin_tagfield` (
		`id` INT NOT NULL AUTO_INCREMENT,
                `key` varchar(255) DEFAULT NULL ,
		`tag` varchar(255) DEFAULT NULL ,
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

        if (self::isInstalled()) {
            $statusMessage = "Tagfield Plugin successfully installed.";
        } else {
            $statusMessage = "Tagfield Plugin could not be installed";
        }
        return $statusMessage;
    }

    /**
     *
     * @return boolean
     */
    public static function needsReloadAfterInstall() {
        return true;
    }

    public static function uninstall() {
        Pimcore_API_Plugin_Abstract::getDb()->query("DROP TABLE `plugin_tagfield`");






        if (!self::isInstalled()) {
            $statusMessage = "Tagfield Plugin successfully uninstalled.";
        } else {
            $statusMessage = "Tagfield Plugin could not be uninstalled";
        }
        return $statusMessage;
    }

    public static function isInstalled() {
        $result = null;
        try {
            $result = Pimcore_API_Plugin_Abstract::getDb()->query("SELECT * FROM `plugin_tagfield`") or die ("La table n'existe pas");
        } catch (Zend_Db_Statement_Exception $e) {
            
        }
        return!empty($result);
    }

    /**
     * @return string $jsClassName
     */
    public static function getJsClassName() {
        return ""; //pimcore.plugin.customerDb";
    }

    /**
     *
     * @param string $language
     * @return string path to the translation file relative to plugin direcory
     */
    public static function getTranslationFile($language) {
        if(file_exists(PIMCORE_PLUGINS_PATH . "/Tagfield/texts/" . $language . ".csv")){
            return "/Tagfield/texts/" . $language . ".csv";
        }
        return "/Tagfield/texts/en.csv";
        
    }

}