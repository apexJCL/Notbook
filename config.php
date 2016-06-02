<?php
if (getenv('OPENSHIFT_APP_NAME') === false) {
    define('PATH', '/var/www/html/Notbook/');
    define('SMARTYDIR', PATH . 'view/');
    define('MODELDIR', PATH . 'model/ActiveRecordModels/');
    define('CONTROLLERDIR', PATH . 'controller/');
    define('VIEWDIR', PATH . 'view/');
    define('TEMPLATES', 'templates/');
    define('TEMPLATES_C', 'templates_c/');
    define('CACHE', 'cache/');
    define('CONFIGS', 'configs/');
    define('DB_DBMS', 'mysql');
    define('DB_DATABASE', 'notbook');
    define('DB_USER', 'reander');
    define('DB_PASSWORD', 'parsing');
    define('DB_HOST', '127.0.0.1');
} else {
    define('PATH', getenv('OPENSHIFT_REPO_DIR'));
    define('SMARTYDIR', PATH . 'view/');
    define('MODELDIR', PATH . 'model/ActiveRecordModels/');
    define('CONTROLLERDIR', PATH . 'controller/');
    define('VIEWDIR', PATH . 'view/');
    define('TEMPLATES', 'templates/');
    define('TEMPLATES_C', 'templates_c/');
    define('CACHE', 'cache/');
    define('CONFIGS', 'configs/');
    define('DB_DBMS', 'mysql');
    define('DB_DATABASE', 'notbook');
    if(DB_DBMS == 'mysql'){
        define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
        define('DB_PASSWORD', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
        define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
    } elseif (DB_DBMS == 'pgsql'){
        define('DB_USER', getenv('OPENSHIFT_POSTGRESQL_DB_USERNAME'));
        define('DB_PASSWORD', getenv('OPENSHIFT_POSTGRESQL_DB_PASSWORD'));
        define('DB_HOST', getenv('OPENSHIFT_POSTGRESQL_DB_HOST'));
    }
}

ini_set('date.timezone', 'america/mexico_city');
