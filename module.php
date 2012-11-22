<?php
namespace bs {
  
  /**
   * 
   * 
   */
  class Base {
    public static $import_dir = __DIR__;
    private static $imported_packages = array();
    
    static function import() {
      foreach(func_get_args() as $name) {
        if(isset(self::$imported_packages[$name])) continue;
        
        $bs_initfile = static::$import_dir."/$name/init/module.php";
        if(file_exists($bs_initfile)) require $bs_initfile;
        else {
          set_include_path(get_include_path() . PATH_SEPARATOR . static::$import_dir . "/$name/lib");
          require str_replace('-', '/', $name).".php";
        }
        
        self::$imported_packages[$name] = true;
      }
    }
  }
  
  function import() {
    call_user_func_array('bs\Base::import', func_get_args());
  }
  
  import('loader');
}
?>