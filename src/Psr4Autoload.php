<?php

namespace yidas;

/**
 * PSR-4 Autoloader for Codeiginiter 3 application
 * 
 * @author  Nick Tsai <myintaer@gmail.com>
 * @version 1.0.0
 * @see     https://github.com/yidas/codeigniter-psr4-autoload
 */
class Psr4Autoload
{
    /**
     * @var string Nampsapce prefix refered to application root
     */
    const DEFAULT_PREFIX = "app";
    
    /**
     * Register Autoloader
     * 
     * @param string $prefix PSR-4 namespace prefix
     */
    public static function register($prefix=null)
    {
        $prefix = ($prefix) ? (string)$prefix : self::DEFAULT_PREFIX;
        
        spl_autoload_register(function ($classname) use ($prefix) {
            // Prefix check
            if (strpos(strtolower($classname), "{$prefix}\\")===0) {
                // Locate class relative path
                $classname = str_replace("{$prefix}\\", "", $classname);
                $filepath = APPPATH.  str_replace('\\', DIRECTORY_SEPARATOR, ltrim($classname, '\\')) . '.php';
                
                if (file_exists($filepath)) {
                    
                    require $filepath;
                }
            }
        });
    }
}
