<?php
/**
 * Este archivo es parte del módulo [Nombre del Módulo].
 *
 * Copyright (c) 2023 OKOI APP DEVELOPMENT S.L.
 * Todos los derechos reservados. No reproducir, distribuir ni modificar
 * sin el permiso expreso por escrito de OKOI APP DEVELOPMENT S.L..
 *
 * @author Emilio Hernandez
 * @copyright (c) 2023 OKOI APP DEVELOPMENT S.L.
 * @license https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 * @version 1.0.0
 */

 declare(strict_types=1);

if (!defined('_PS_VERSION_')) {
    exit;
}

class ExampleModule extends Module
{
        /**
     * Constructs the MultiLanguages module instance.
     * Initializes the module with basic details like name, tab, version, and author.
     */
    public function __construct()
    {
        $this->name = 'examplemodule';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'OKOI APP DEVELOPMENT S.L.';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '1.7', 'max' => _PS_VERSION_];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Exmaple Module');
        $this->description = $this->l('This is an example module for PrestaShop');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    /**
     * Installs the MultiLanguages module.
     * Executes the SQL statements necessary to set up the module's database structure
     * and installs the back office tabs.
     *
     * @return bool True if the installation succeeds, false otherwise.
     */
    public function install(): bool
    {
        if (!parent::install() || !$this->installTabs()) {
            return false;
        }

        $sql = include(dirname(__FILE__) . '/sql/install.php');
        foreach ($sql as $query) {
            if (!Db::getInstance()->execute($query)) {
                return false;
            }
        }

        return true;
    }

        /**
     * Uninstalls the MultiLanguages module.
     * Removes the database structure and back office tabs associated with the module.
     *
     * @return bool True if the uninstallation succeeds, false otherwise.
     */
    public function uninstall(): bool
    {
        $sql = include(dirname(__FILE__) . '/sql/uninstall.php');
        foreach ($sql as $query) {
            if (!Db::getInstance()->execute($query)) {
                return false;
            }
        }

        if (!$this->uninstallTabs()) {
            return false;
        }

        return parent::uninstall();
    }

        /**
     * Installs back office tabs for the MultiLanguages module.
     * Creates tabs for managing translation categories and translations.
     *
     * @return bool True if the tabs are successfully installed, false otherwise.
     */
    private function installTabs(): bool
    {
        $tabsInfo = [
            [
                'class_name' => 'AdminExampleModuleMain',
                'name' => 'Example Module Settings'
            ],
        ];

        foreach ($tabsInfo as $tabInfo) {
            $tab = new Tab();
            $tab->active = 1;
            $tab->class_name = $tabInfo['class_name'];
            $tab->name = [];
            foreach (Language::getLanguages(true) as $lang) {
                $tab->name[$lang['id_lang']] = $tabInfo['name'];
            }
            // Este tab debería ser hijo de una pestaña existente, como 'AdminTools' por ejemplo
            $tab->id_parent = (int)Tab::getIdFromClassName('AdminTools');
            $tab->module = $this->name;

            if (!$tab->add()) {
                return false;
            }
        }

        return true;
    }


    /**
     * Uninstalls back office tabs for the MultiLanguages module.
     * Removes the tabs created during the module's installation.
     *
     * @return bool True if the tabs are successfully uninstalled, false otherwise.
     */
    private function uninstallTabs(): bool
    {
        $tabClassNames = [
            'AdminExampleModuleMain'
        ];

        foreach ($tabClassNames as $className) {
            $idTab = (int)Tab::getIdFromClassName($className);
            if ($idTab) {
                $tab = new Tab($idTab);
                if (!$tab->delete()) {
                    return false;
                }
            }
        }

        return true;
    }

}