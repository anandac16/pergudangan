<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    protected function _initDb()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/application.ini', APPLICATION_ENV);
        $db = Zend_Db::factory($config->resources->db->adapter, array(
            'host'     => $config->resources->db->params->host,
            'username' => $config->resources->db->params->username,
            'password' => $config->resources->db->params->password,
            'dbname'   => $config->resources->db->params->dbname/*,
            'profiler' => $config->resources->db->params->profiler*/
        ));
        Zend_Registry::set('db', $db);

        // set db_adapter to all db_table objects
        Zend_Db_Table::setDefaultAdapter($db);
    }
}

