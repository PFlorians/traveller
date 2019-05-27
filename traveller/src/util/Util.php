<?php//utilitary class
    /**
     * this is an utilitary class only - technical methods only
     */
    class Util
    {
        private $os;
        private $relativePath;//never allow setting the value externally
        private $pathAddressingChar;
        private $relativeAddressingChar;//html char
        private $siteName;
        private $selfRoot;//root dir of entire website
        private $selfDir;//relative dire of self
        private $scriptName;//scripts name
        private $pageRoot;//folder where the index is
        //nemenne, s ktorymi sa v adresarovej strukture na web serveri pocita
        public const img='img';//images are all here
        public const php='php';//only objects are here, strictly technical, backend ops only
        public const js='js';//frontend JS related resources only
        public const css='css';//style only
        public const documentation='documentation';//documentation for this project
        public const fonts='fonts'; //fonts
        
        function __construct()
        {
            $this->relativeAddressingChar = "/";
            $this->os=PHP_OS;//init OS type, no filter specific
            $this->init();//initialize1
        }
        public function init()//this determines if server is WINdows or not, if it is, then return true
        {
            //echo 'util initialized ';
            if(strtoupper(substr(PHP_OS, 0, 3)) === "WIN")
            {//cesty su v tvare '\'
                $arr=explode("\\", dirname(__FILE__));
                $str="";
                for($i=0;$i<sizeof($arr)-1;$i++)//except the last dir since this is specific, not general
                {
                    if($i>0)
                    {
                        $str=$str . "\\" . $arr[$i];
                    }
                    else if($i==sizeof($arr)-2)//works ONLY if I assume that this class is in /php/folder
                    {
                        $this->siteName=$arr[$i];
                    }
                    else {
                        $str=$str . $arr[$i];
                    }
                }
                $this->pathAddressingChar = "\\";//pokial je to windows
            }
            else
            { //something else, lets hope its UNIX based
                //opacne lomitko
                $arr=explode("/", dirname(__FILE__));
                $str="";
                for($i=0;$i<sizeof($arr)-1;$i++)
                {
                    if($i>0)
                    {
                        $str=$str . "/" . $arr[$i];
                    }
                    else if($i==sizeof($arr)-2)//works ONLY if I assume that this class is in /php/folder
                    {
                        $this->siteName=$arr[$i];
                    }
                    else {
                        $str=$str . $arr[$i];
                    }
                }
                $this->pathAddressingChar="/";//pokial unix
            }
            $this->relativePath = $str;//initialize var
            //this one goes everywhere
            $arr=explode("/", $_SERVER['PHP_SELF']);
            $this->selfDir=$arr[sizeof($arr)-2];
            $this->scriptName=$arr[sizeof($arr)-1];
            $this->selfRoot="/";
            $this->pageRoot="";
            for($i=0;$i<sizeof($arr)-2;$i++)
            {
                if($i>0)
                {
                    $this->selfRoot=$this->selfRoot.$arr[$i]."/";
                    if($i==1)
                    {
                        $this->pageRoot=$this->pageRoot.$arr[$i]."/";
                    }
                }
            }

            if((self::img!=$arr[sizeof($arr)-2]) && (self::html!=$arr[sizeof($arr)-2]) &&
                (self::php!=$arr[sizeof($arr)-2]) && (self::css!=$arr[sizeof($arr)-2]) &&
                (self::js!=$arr[sizeof($arr)-2]) && (self::fonts!=$arr[sizeof($arr)-2]) &&
                (self::documentation!=$arr[sizeof($arr)-2]))//ak je to root dir
            {
                $this->selfRoot="";
            }
        }
        //get relative path of website on server
        public function getRelativePath()
        {
            return $this->relativePath;
        }
        /**
        *    get the way to use while dealing with dependencies
        *   in HTML if given path such as: path/to/file.php -> is resolved automatically
        */
        public function getPathAddressingChar()
        {
            return $this->pathAddressingChar;
        }
        public function getOs()
        {
            return $this->os;
        }
        //default znak /
        public function getRelativeAddressingChar()
        {
            return $this->relativeAddressingChar;
        }
        //premenne relativnej cesty self
        public function getSelfRoot()
        {
            return $this->selfRoot;
        }
        public function getSelfDir()
        {
            return $this->selfDir;
        }
        public function getSelfScriptName()
        {
            return $this->scriptName;
        }
        public function getPageRoot()
        {
            return $this->pageRoot;
        }
    }

 ?>
