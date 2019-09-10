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

/* layout.html */
class __TwigTemplate_712ef5c38a9417c454ecb003ff65017db19201af102fecf42bcd59d67bf8f2c6 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
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
    <title>view test</title>
</head>
<body>
<header>header</header>
<content>
    ";
        // line 10
        $this->displayBlock('content', $context, $blocks);
        // line 13
        echo "</content>
<footer>footer</footer>
</body>
</html>";
    }

    // line 10
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 11
        echo "
    ";
    }

    public function getTemplateName()
    {
        return "layout.html";
    }

    public function getDebugInfo()
    {
        return array (  62 => 11,  58 => 10,  51 => 13,  49 => 10,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>view test</title>
</head>
<body>
<header>header</header>
<content>
    {% block content %}

    {% endblock %}
</content>
<footer>footer</footer>
</body>
</html>", "layout.html", "E:\\phpStudy\\PHPTutorial\\WWW\\MyFrame\\app\\views\\layout.html");
    }
}
