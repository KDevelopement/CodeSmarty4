<?php
    namespace Config;

    use CodeIgniter\Config\BaseConfig;

    class Smarty extends BaseConfig {

        public static $TemplateErrors = E_ALL & ~E_NOTICE;

        public static $templatesDir = ROOTPATH . "templates";

        public static $templateDefault = "Default";

        public static $forceCompile = FALSE;

        public static $compileDir = ROOTPATH . "templates_c";

        public static $cacheDir = APPPATH . "Cache";

        public static $configDir = APPPATH . "Config";

        public static $pluginsDir = ROOTPATH . "modules";

        public static $fileExtension = "tpl";

        public static $cacheOn = FALSE;

        public static $cacheLifeTime = 3600;

        public static $Debug = FALSE;

    }