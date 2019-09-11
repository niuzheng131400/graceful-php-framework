<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* default.php */
class __TwigTemplate_56d0238a4188195a42f6f2f036ad56f4530a5a20f81c2d0cd06a9ceed3f824e9 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Welcome to MyFrame</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
</head>
<body>
<div style=\"width: 500px;margin: auto\">
    <h2>欢迎使用MyFrame╰(￣▽￣)╮</h2><span><a href=\"http://niuzheng.net\" target=\"_blank\">友儿の博客地址</a></span>
</div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "default.php";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Welcome to MyFrame</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
</head>
<body>
<div style=\"width: 500px;margin: auto\">
    <h2>欢迎使用MyFrame╰(￣▽￣)╮</h2><span><a href=\"http://niuzheng.net\" target=\"_blank\">友儿の博客地址</a></span>
</div>
</body>
</html>", "default.php", "/Users/zhengniu/Downloads/study/MyFrame/app/views/default.php");
    }
}
