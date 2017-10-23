<?php

/* themes/chipdyno/templates/layout/page--front.html.twig */
class __TwigTemplate_95d574774fcd6e1f21cdd14cff69901cee582ec79654747448184fb0a3c720e4 extends Twig_Template
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
        $tags = array("if" => 54);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('if'),
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
<div class=\"banner-slider\">
    <div class=\"wrap box\">
        <div class=\"banner\">
            ";
        // line 53
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_header_slider", array()), "html", null, true));
        echo "
            ";
        // line 54
        if (((isset($context["logged_in"]) ? $context["logged_in"] : null) == 0)) {
            // line 55
            echo "            <div class=\"Lets-start\">
                <a href=\"/user/register\">Register Now</a>
            </div>
            ";
        }
        // line 59
        echo "        </div>
        <div class=\"clear\"> </div>
        </div>
    <div class=\"clear\"> </div>
</div>  
<div class=\"wrap home_search\">            
";
        // line 65
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_home_search", array()), "html", null, true));
        echo "            
</div>

  

  <main role=\"main\">
    <a id=\"main-content\" tabindex=\"-1\"></a>";
        // line 72
        echo "
<section class=\"wrap colorBG homepage_middle\">
    <div class=\"homeCollumnWrapper\">
        <div class=\"homeCollumn\">
            ";
        // line 76
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "homepage_sidebar_first", array()), "html", null, true));
        echo "
        </div>
        <div class=\"homeCollumn1\">
            ";
        // line 79
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_content", array()), "html", null, true));
        echo "
        </div>
        <div class=\"clear\"></div>
    </div>

    <div class=\"section group homepage_projects\">
        
        ";
        // line 86
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_upperfooter", array()), "html", null, true));
        echo "
    </div>
    <div class=\"footer\">
        ";
        // line 89
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "chipdyno_footer", array()), "html", null, true));
        echo "
    </div>
</section>

  </main>
</div>";
    }

    public function getTemplateName()
    {
        return "themes/chipdyno/templates/layout/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 89,  107 => 86,  97 => 79,  91 => 76,  85 => 72,  76 => 65,  68 => 59,  62 => 55,  60 => 54,  56 => 53,  48 => 48,  43 => 45,);
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
<div class=\"banner-slider\">
    <div class=\"wrap box\">
        <div class=\"banner\">
            {{ page.chipdyno_header_slider }}
            {% if (logged_in == 0) %}
            <div class=\"Lets-start\">
                <a href=\"/user/register\">Register Now</a>
            </div>
            {% endif %}
        </div>
        <div class=\"clear\"> </div>
        </div>
    <div class=\"clear\"> </div>
</div>  
<div class=\"wrap home_search\">            
{{ page.chipdyno_home_search}}            
</div>

  

  <main role=\"main\">
    <a id=\"main-content\" tabindex=\"-1\"></a>{# link is in html.html.twig #}

<section class=\"wrap colorBG homepage_middle\">
    <div class=\"homeCollumnWrapper\">
        <div class=\"homeCollumn\">
            {{ page.homepage_sidebar_first }}
        </div>
        <div class=\"homeCollumn1\">
            {{ page.chipdyno_content }}
        </div>
        <div class=\"clear\"></div>
    </div>

    <div class=\"section group homepage_projects\">
        
        {{ page.chipdyno_upperfooter }}
    </div>
    <div class=\"footer\">
        {{ page.chipdyno_footer }}
    </div>
</section>

  </main>
</div>{# /.layout-container #}
", "themes/chipdyno/templates/layout/page--front.html.twig", "/mnt/jeet/www/local/chipc/themes/chipdyno/templates/layout/page--front.html.twig");
    }
}
