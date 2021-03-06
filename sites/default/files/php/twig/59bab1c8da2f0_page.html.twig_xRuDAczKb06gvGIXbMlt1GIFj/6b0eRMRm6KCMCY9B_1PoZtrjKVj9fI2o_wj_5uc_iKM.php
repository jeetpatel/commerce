<?php

/* themes/chipdyno/templates/layout/page.html.twig */
class __TwigTemplate_9fbfdb2c091aa5f00932c3053cc37a44394b19ff53f866fbada3c76b7c574850 extends Twig_Template
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
        $tags = array("set" => 64, "if" => 69);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('set', 'if'),
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

        // line 45
        echo "<div class=\"layout-container\">

  <header role=\"banner\">
    ";
        // line 48
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_header", array()), "html", null, true));
        echo "
  </header>

  ";
        // line 51
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "primary_menu", array()), "html", null, true));
        echo "
  ";
        // line 52
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "secondary_menu", array()), "html", null, true));
        echo "

  ";
        // line 54
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "breadcrumb", array()), "html", null, true));
        echo "

  ";
        // line 56
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "highlighted", array()), "html", null, true));
        echo "

  ";
        // line 58
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "help", array()), "html", null, true));
        echo "

<main class=\"wrap colorBG middle_content\">
    <a id=\"main-content\" tabindex=\"-1\"></a>";
        // line 62
        echo "<div class=\"container\">
";
        // line 64
        $context["content_classes"] = array(0 => ((twig_test_empty($this->getAttribute(        // line 65
(isset($context["page"]) ? $context["page"] : null), "chipdyno_sidebar_first", array()))) ? ("layout-content col-sm-12") : ("")), 1 => (($this->getAttribute(        // line 66
(isset($context["page"]) ? $context["page"] : null), "chipdyno_sidebar_first", array())) ? ("layout-content layout_content_right") : ("")));
        // line 68
        echo "    
    ";
        // line 69
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_sidebar_first", array())) {
            // line 70
            echo "      <div class=\"layout-sidebar-first\" role=\"complementary\">
        ";
            // line 71
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_sidebar_first", array()), "html", null, true));
            echo "
      </div>
    ";
        }
        // line 73
        echo " 
    
    
    <div ";
        // line 76
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["content_attributes"]) ? $context["content_attributes"] : null), "addClass", array(0 => (isset($context["content_classes"]) ? $context["content_classes"] : null)), "method"), "html", null, true));
        echo ">
      ";
        // line 77
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_content", array()), "html", null, true));
        echo "
    </div>";
        // line 79
        echo "
    <div class=\"clear\"></div>
    <section role=\"center-content-layout\">
        ";
        // line 82
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_left_region", array())) {
            // line 83
            echo "          <div class=\"center-layout-left\">
            ";
            // line 84
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_left_region", array()), "html", null, true));
            echo "
          </div>
        ";
        }
        // line 87
        echo "        ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_center_region", array())) {
            // line 88
            echo "          <div class=\"center-layout-content\">
            ";
            // line 89
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_center_region", array()), "html", null, true));
            echo "
          </div>
        ";
        }
        // line 92
        echo "        ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_right_region", array())) {
            // line 93
            echo "          <div class=\"center-layout-right\">
            ";
            // line 94
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_right_region", array()), "html", null, true));
            echo "
          </div>
        ";
        }
        // line 97
        echo "        <div class=\"clear\"></div>
    </section>

  ";
        // line 100
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_upperfooter", array())) {
            // line 101
            echo "    <div class=\"wrap\">
      ";
            // line 102
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_upperfooter", array()), "html", null, true));
            echo "
    </div>
  ";
        }
        // line 105
        echo "</div>
  ";
        // line 106
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_footer", array())) {
            // line 107
            echo "    <div class=\"footer\">
        ";
            // line 108
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_footer", array()), "html", null, true));
            echo "
    </div>
  ";
        }
        // line 111
        echo "
</main>";
        // line 113
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "themes/chipdyno/templates/layout/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 113,  183 => 111,  177 => 108,  174 => 107,  172 => 106,  169 => 105,  163 => 102,  160 => 101,  158 => 100,  153 => 97,  147 => 94,  144 => 93,  141 => 92,  135 => 89,  132 => 88,  129 => 87,  123 => 84,  120 => 83,  118 => 82,  113 => 79,  109 => 77,  105 => 76,  100 => 73,  94 => 71,  91 => 70,  89 => 69,  86 => 68,  84 => 66,  83 => 65,  82 => 64,  79 => 62,  73 => 58,  68 => 56,  63 => 54,  58 => 52,  54 => 51,  48 => 48,  43 => 45,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#
/**
 * @file
 * Theme override to display a single page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.html.twig template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - base_path: The base URL path of the Drupal installation. Will usually be
 *   \"/\" unless you have installed Drupal in a sub-directory.
 * - is_front: A flag indicating if the current page is the front page.
 * - logged_in: A flag indicating if the user is registered and signed in.
 * - is_admin: A flag indicating if the user has permission to access
 *   administration pages.
 *
 * Site identity:
 * - front_page: The URL of the front page. Use this instead of base_path when
 *   linking to the front page. This includes the language domain or prefix.
 *
 * Page content (in order of occurrence in the default page.html.twig):
 * - node: Fully loaded node, if there is an automatically-loaded node
 *   associated with the page and the node ID is the second argument in the
 *   page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - page.header: Items for the header region.
 * - page.primary_menu: Items for the primary menu region.
 * - page.secondary_menu: Items for the secondary menu region.
 * - page.highlighted: Items for the highlighted content region.
 * - page.help: Dynamic help text, mostly for admin pages.
 * - page.content: The main content of the current page.
 * - page.sidebar_first: Items for the first sidebar.
 * - page.sidebar_second: Items for the second sidebar.
 * - page.footer: Items for the footer region.
 * - page.breadcrumb: Items for the breadcrumb region.
 *
 * @see template_preprocess_page()
 * @see html.html.twig
 */
#}
<div class=\"layout-container\">

  <header role=\"banner\">
    {{ page.chipdyno_header }}
  </header>

  {{ page.primary_menu }}
  {{ page.secondary_menu }}

  {{ page.breadcrumb }}

  {{ page.highlighted }}

  {{ page.help }}

<main class=\"wrap colorBG middle_content\">
    <a id=\"main-content\" tabindex=\"-1\"></a>{# link is in html.html.twig #}
<div class=\"container\">
{%
    set content_classes = [
        page.chipdyno_sidebar_first is empty ? 'layout-content col-sm-12',
        page.chipdyno_sidebar_first ? 'layout-content layout_content_right'
    ]
%}    
    {% if page.chipdyno_sidebar_first %}
      <div class=\"layout-sidebar-first\" role=\"complementary\">
        {{ page.chipdyno_sidebar_first }}
      </div>
    {% endif %} 
    
    
    <div {{ content_attributes.addClass(content_classes) }}>
      {{ page.chipdyno_content }}
    </div>{# /.layout-content #}

    <div class=\"clear\"></div>
    <section role=\"center-content-layout\">
        {% if page.chipdyno_left_region %}
          <div class=\"center-layout-left\">
            {{ page.chipdyno_left_region }}
          </div>
        {% endif %}
        {% if page.chipdyno_center_region %}
          <div class=\"center-layout-content\">
            {{ page.chipdyno_center_region }}
          </div>
        {% endif %}
        {% if page.chipdyno_right_region %}
          <div class=\"center-layout-right\">
            {{ page.chipdyno_right_region }}
          </div>
        {% endif %}
        <div class=\"clear\"></div>
    </section>

  {% if page.chipdyno_upperfooter %}
    <div class=\"wrap\">
      {{ page.chipdyno_upperfooter }}
    </div>
  {% endif %}
</div>
  {% if page.chipdyno_footer %}
    <div class=\"footer\">
        {{ page.chipdyno_footer }}
    </div>
  {% endif %}

</main>{# /.layout-container #}
</div>
", "themes/chipdyno/templates/layout/page.html.twig", "/mnt/jeet/www/local/chipc/themes/chipdyno/templates/layout/page.html.twig");
    }
}
