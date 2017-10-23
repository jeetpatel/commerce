<?php

/* {# inline_template_start #}<td><b>{{ created }}</b></td><td>&nbsp;</td><td>&nbsp;</td>
<td><b>{{ type }}</b></td><td>&nbsp;</td><td>&nbsp;</td>
<td><h4>{{ title }}</h4>
<span class="desc">{{ body }}</span>
</td>
<td colspan="7"><hr></td> */
class __TwigTemplate_1150026f0415a3b062962a674aa9aeec6715154369f40cfdf070d2fb315bfd05 extends Twig_Template
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
        echo "<td><b>";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["created"]) ? $context["created"] : null), "html", null, true));
        echo "</b></td><td>&nbsp;</td><td>&nbsp;</td>
<td><b>";
        // line 2
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["type"]) ? $context["type"] : null), "html", null, true));
        echo "</b></td><td>&nbsp;</td><td>&nbsp;</td>
<td><h4>";
        // line 3
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true));
        echo "</h4>
<span class=\"desc\">";
        // line 4
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["body"]) ? $context["body"] : null), "html", null, true));
        echo "</span>
</td>
<td colspan=\"7\"><hr></td>";
    }

    public function getTemplateName()
    {
        return "{# inline_template_start #}<td><b>{{ created }}</b></td><td>&nbsp;</td><td>&nbsp;</td>
<td><b>{{ type }}</b></td><td>&nbsp;</td><td>&nbsp;</td>
<td><h4>{{ title }}</h4>
<span class=\"desc\">{{ body }}</span>
</td>
<td colspan=\"7\"><hr></td>";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 4,  57 => 3,  53 => 2,  48 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{# inline_template_start #}<td><b>{{ created }}</b></td><td>&nbsp;</td><td>&nbsp;</td>
<td><b>{{ type }}</b></td><td>&nbsp;</td><td>&nbsp;</td>
<td><h4>{{ title }}</h4>
<span class=\"desc\">{{ body }}</span>
</td>
<td colspan=\"7\"><hr></td>", "{# inline_template_start #}<td><b>{{ created }}</b></td><td>&nbsp;</td><td>&nbsp;</td>
<td><b>{{ type }}</b></td><td>&nbsp;</td><td>&nbsp;</td>
<td><h4>{{ title }}</h4>
<span class=\"desc\">{{ body }}</span>
</td>
<td colspan=\"7\"><hr></td>", "");
    }
}
