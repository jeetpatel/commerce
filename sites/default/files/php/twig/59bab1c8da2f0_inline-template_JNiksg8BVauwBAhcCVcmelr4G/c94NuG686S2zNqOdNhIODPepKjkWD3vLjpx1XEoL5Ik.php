<?php

/* {# inline_template_start #}<div class="center bold recent_file_uploads">
{{ title }} 
</div>
<div class="changed center">File transferred on:<br>{{ changed }} </div> */
class __TwigTemplate_cbb95becfae9b46d27ad4f170a83cf8190e8bf77c6a9637cbdb99338bd03b9fe extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array();
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array(),
                array(),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 1
        echo "<div class=\"center bold recent_file_uploads\">
";
        // line 2
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true));
        echo " 
</div>
<div class=\"changed center\">File transferred on:<br>";
        // line 4
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["changed"]) ? $context["changed"] : null), "html", null, true));
        echo " </div>";
    }

    public function getTemplateName()
    {
        return "{# inline_template_start #}<div class=\"center bold recent_file_uploads\">
{{ title }} 
</div>
<div class=\"changed center\">File transferred on:<br>{{ changed }} </div>";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 4,  49 => 2,  46 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{# inline_template_start #}<div class=\"center bold recent_file_uploads\">
{{ title }} 
</div>
<div class=\"changed center\">File transferred on:<br>{{ changed }} </div>", "{# inline_template_start #}<div class=\"center bold recent_file_uploads\">
{{ title }} 
</div>
<div class=\"changed center\">File transferred on:<br>{{ changed }} </div>", "");
    }
}
