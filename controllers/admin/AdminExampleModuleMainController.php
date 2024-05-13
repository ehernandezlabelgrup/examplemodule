<?php

declare(strict_types=1);

/**
 * AdminExampleModuleMainController.php
 *
 * This file is part of a module developed by OKOI APP DEVELOPMENT S.L. for managing settings and configurations
 * in PrestaShop through an external module, facilitating the integration of custom features
 * into PrestaShop's core functionalities.
 *
 * @author: EMILIO HERNANDEZ
 * @copyright: Copyright (c) OKOI APP DEVELOPMENT S.L. 2023
 * @license: https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 * @version: 1.0.0
 * @date: 2024-02-09
 */

/**
 * AdminExampleModuleMainController class
 * Manages the backend functionality for the ExampleModule, allowing the admin to configure
 * and manage module-specific settings and functionalities.
 */
class AdminExampleModuleMainController extends ModuleAdminController
{
    /**
     * Constructor for the AdminExampleModuleMainController class.
     * Initializes the controller with specific properties for managing the module's settings.
     */
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'examplemoduletable';  // This should be the actual name of the table you're managing, if any
        $this->className = 'ExampleClass';   // This should be the actual model class name, if you have a model
        $this->identifier = 'id_example';    // This should be the primary key of the table you're managing
        $this->lang = true;
        $this->context = Context::getContext();

        // Define fields to be displayed in the list, adapt these fields based on what you need to display
        $this->fields_list = [
            'name_category' => [
                'title' => $this->context->getTranslator()->trans('Category', [], 'Admin.Global'),
                'width' => 140,
                'filter_key' => 'mc!name',
                'filter_type' => 'text',
                'havingFilter' => true,
            ],
            'name' => [
                'title' => $this->context->getTranslator()->trans('Name', [], 'Admin.Global'),
                'width' => 140,
                'havingFilter' => true,
                'filter_key' => 'a!name',
            ],
            'value' => [
                'title' => $this->context->getTranslator()->trans('Value', [], 'Admin.Global'),
                'width' => 140,
                'havingFilter' => true,
            ],
        ];

        parent::__construct();
    }

}
