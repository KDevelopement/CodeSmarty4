<?php
    namespace App\Libraries;

    use Smarty AS SmartyRun;

    class Smarty
    {

        /**
         * Iniciar a biblioteca Smarty
         * @var SmartyRun
         */
        protected $Smarty;
    
        /**
         * Pasta de templates
         * @var string
         */
        protected $templatesDir;

        /**
         * Pasta de template (One)
         * @var string
         */
        protected $templateDefault;

        /**
         * Pasta de plugins
         * @var string
         */
        protected $pluginsDir;
    
        /**
         * Pasta de compilações
         * @var bool
         */
        protected $forceCompile;

        /**
         * Pasta de compilações
         * @var string
         */
        protected $compileDir;
    
        /**
         * @var bool
         */
        protected bool $cacheOn;

        /**
         * @var int
         */
        protected $cacheLifeTime;

        /**
         * Pasta de caches
         * @var string
         */
        protected $cacheDir;
    
        /**
         * Pasta de configurações
         * @var string
         */
        protected $configDir;

        /**
         * Ext. de arquivo
         * @var string
         */
        protected $fileExtension;

        /**
         * Status de debug
         * @var bool
         */
        protected $Debug;

        public function __construct(array $Config = [])
        {   
            $this->Smarty = new SmartyRun();
            $this->templateDefault = $Config["Template"];
            $this->templatesDir = \Config\Smarty::$templatesDir;
            $this->pluginsDir = \Config\Smarty::$pluginsDir;
            $this->force_compile = \Config\Smarty::$forceCompile;
            $this->compileDir = \Config\Smarty::$compileDir;
            $this->cacheOn = \Config\Smarty::$cacheOn;
            $this->cacheDir = \Config\Smarty::$cacheDir;
            $this->cacheLifeTime = \Config\Smarty::$cacheLifeTime;
            $this->configDir = \Config\Smarty::$configDir;
            $this->fileExtension = \Config\Smarty::$fileExtension;
            $this->Debug = \Config\Smarty::$Debug;
        }

        public function Init () 
        {
            $AllTemplate = [];
            $RootFolder = $this->templatesDir;
            $Folders = array_diff(scandir($RootFolder), ['..', '.']);
            foreach ($Folders AS $Folder){
                $AllTemplate[$Folder] = $this->templatesDir . DIRECTORY_SEPARATOR . $Folder;
            }
            $this->Smarty->setTemplateDir(["Default" => APPPATH . "Views"]);
            if($AllTemplate) 
                $this->Smarty->addTemplateDir($AllTemplate);
            //$this->Smarty->setPluginsDir($this->pluginsDir);
            $this->Smarty->force_compile = $this->forceCompile;
            $this->Smarty->setCompileDir($this->compileDir);
            $this->Smarty->caching = $this->cacheOn;
            $this->Smarty->setCacheDir($this->cacheDir);
            $this->Smarty->cache_lifetime = $this->cacheLifeTime;
            $this->Smarty->setConfigDir($this->configDir);
            $this->Smarty->debugging = $this->Debug;
        }

        public function Very () 
        {
            return $this->Smarty->testInstall();
        }

        public function getTemplateDir () 
        {
            return $this->Smarty->getTemplateDir();
        }

        public function View ($View, array $Data = [])
        {
            $selected = $this->templateDefault;
            $ViewSelected = $this->Smarty->getTemplateDir($selected) . $View . "." . $this->fileExtension;
            if( !$this->Smarty->templateExists($ViewSelected) ){
                $ViewSelected = $this->Smarty->getTemplateDir("Default") . $View . "." . $this->fileExtension;
            }
            $this->Smarty->assign($Data);
            $this->Smarty->display($ViewSelected);
        }
        /*
            $AllTemplate = [];
            $RootFolder = $this->templatesDir;
            $Folders = array_diff(scandir($RootFolder), ['..', '.']);
            $Count = 0;
            foreach ($Folders AS $Folder){
                $fileInfo = $this->templatesDir . DIRECTORY_SEPARATOR . $Folder  . DIRECTORY_SEPARATOR ."info.txt";
                if (file_exists($fileInfo)) {
                    $Count++;
                    $info = file_get_contents($fileInfo);
                    $infoArray = explode("\n", $info);
                    $getInfo["Name"] = str_replace("Name: ", "", $infoArray[0]);
                    $getInfo["Author"] = str_replace("Author: ", "", $infoArray[1]);
                    $getInfo["Link"] = str_replace("Link: ", "", $infoArray[2]);
                    $getInfo["Date"] = str_replace("Date: ", "", $infoArray[3]);
                    $getInfo["Version"] = str_replace("Version: ", "", $infoArray[4]);
                }
                $Template["Info"] = $getInfo;
                $Template["Folder"] = $this->templatesDir . DIRECTORY_SEPARATOR . $Folder;
            }
         */
    }
