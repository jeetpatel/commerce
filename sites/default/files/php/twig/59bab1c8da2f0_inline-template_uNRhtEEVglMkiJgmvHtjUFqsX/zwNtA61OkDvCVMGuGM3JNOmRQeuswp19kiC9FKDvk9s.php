<?php

/* {# inline_template_start #}<div class="col images-1-of-3">
<a href="{{path('entity.taxonomy_term.canonical', {'taxonomy_term': tid})}}" class="projectsBlock">
{{ field_projects_image }}
<h3>{{ field_projects_image__title }}</h3>
</a>
</div> */
class __TwigTemplate_fd3600bbc2d054e44001fef2569129a2268616569d61567ab6c4c4a1830303b9 extends Twig_Template
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
        $functions = array("path" => 2);

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array(),
                array(),
                array('path')
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
        echo "<div class=\"col images-1-of-3\">
<a href=\"";
        // line 2
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("entity.taxonomy_term.canonical", array("taxonomy_term" => (isset($context["tid"]) ? $context["tid"] : null))), "html", null, true));
        echo "\" class=\"projectsBlock\">
";
        // line 3
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["field_projects_image"]) ? $context["field_projects_image"] : null), "html", null, true));
        echo "
<h3>";
        // line 4
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["field_projects_image__title"]) ? $context["field_projects_image__title"] : null), "html", null, true));
        echo "</h3>
</a>
</div>";
    }

    public function getTemplateName()
    {
        return "{# inline_template_start #}<div class=\"col images-1-of-3\">
<a href=\"{{path('entity.taxonomy_term.canonical', {'taxonomy_term': tid})}}\" class=\"projectsBlock\">
{{ field_projects_image }}
<h3>{{ field_projects_image__title }}</h3>
</a>
</div>";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 4,  55 => 3,  51 => 2,  48 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{# inline_template_start #}<div class=\"col images-1-of-3\">
<a href=\"{{path('entity.taxonomy_term.canonical', {'taxonomy_term': tid})}}\" class=\"projectsBlock\">
{{ field_projects_image }}
<h3>{{ field_projects_image__title }}</h3>
</a>
</div>", "{# inline_template_start #}<div class=\"col images-1-of-3\">
<a href=\"{{path('entity.taxonomy_term.canonical', {'taxonomy_term': tid})}}\" class=\"projectsBlock\">
{{ field_projects_image }}
<h3>{{ field_projects_image__title }}</h3>
</a>
</div>", "");
    }
}
