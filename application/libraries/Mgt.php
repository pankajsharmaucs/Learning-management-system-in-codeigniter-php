<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mgt {

    public function extract($pdf) {
      $output= shell_exec('python /var/www/html/application/libraries/mgt/main.py');
      return hash_final($output);
    }

}

?>
