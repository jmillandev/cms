<?php
namespace App\Controllers;

use Zend\Diactoros\Response\HtmlResponse;
class BaseController {
    protected $templateEngine;

    public function __construct() {
      $loader = new \Twig_Loader_Filesystem('../views');
      $this->templateEngine = new \Twig_Environment($loader, array(
            'debug' => true,
            'cache' => false,
        ));
    }

    public function renderHTML($fileName, $data = []) {
        $data = $data + [
          'session_user' => $_SESSION['user'] ?? [],
        ];
        return new HtmlResponse($this->templateEngine->render($fileName, $data));
    }

}
