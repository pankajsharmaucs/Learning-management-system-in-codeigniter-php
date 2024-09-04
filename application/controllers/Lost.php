<?php

defined('BASEPATH') or exit('No direct script access allowed');
use Spiritix\HtmlToPdf\Converter;
use Spiritix\HtmlToPdf\Input\StringInput;
use Spiritix\HtmlToPdf\Output\DownloadOutput;

class Lost extends CI_Controller
{
      public function index(){


        $input = new StringInput();
        $input->setHtml(file_get_contents('https://uat.kreditaid.com/home/print?id=3BUHnOgty7'));

        $converter = new Converter($input, new DownloadOutput());

        $converter->setOption('n');
        $converter->setOption('d', '300');

        $converter->setOptions([
            'no-background',
            'margin-bottom' => '100',
            'margin-top' => '100',
        ]);

        $output = $converter->convert();
        $output->download('file.pdf');

              }

}
