<?php
namespace App\Views;
use Twig_Environment;
class View
{
    protected $loader;
    protected $twig;

    public function render(string $filename)
    {

        require_once __DIR__ . "/" . $filename . ".php";
    }

    public function twigLoad(String $filename, array $data)
    {
        echo $this->twig->render($filename . ".twig", $data);
    }

    public function __construct($data = [])
    {
        $this->loader = new \Twig_Loader_Filesystem(APPLICATION_PATH.'/Views');
        $this->twig = new Twig_Environment($this->loader);
    }
}