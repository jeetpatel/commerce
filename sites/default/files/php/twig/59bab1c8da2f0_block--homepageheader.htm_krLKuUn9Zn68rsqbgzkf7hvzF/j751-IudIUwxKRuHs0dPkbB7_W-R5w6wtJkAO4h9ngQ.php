<?php

/* themes/chipdyno/templates/block/block--homepageheader.html.twig */
class __TwigTemplate_8fed2c69dc2619b4365d33db7b768725d2452eb36a87f6d2f6c599affc05fb6d extends Twig_Template
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
        $tags = array("set" => 28);
        $filters = array("t" => 49);
        $functions = array("account_menu" => 28, "drupal_block" => 37, "path" => 49);

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('set'),
                array('t'),
                array('account_menu', 'drupal_block', 'path')
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

        // line 28
        $context["account"] = $this->env->getExtension('Drupal\chip_dyno_home\TwigExtension')->account_menu();
        // line 29
        echo "<div id=\"block-homepageheader\" class=\"block block-block-content block-block-content53ee5745-6392-4fab-ba96-184547a6d319\">


    <div class=\"clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item\">
        <div class=\"header\"><!--start-wrap--->
            <div id=\"topOptions\">
                <div class=\"wrap\">
                    <div id=\"topOptionsWrapper\">
                        ";
        // line 37
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("languageswitcher", false), "html", null, true));
        echo "
                        <div id=\"topaccount\">
                            <div id=\"topaccountBtns\">
                                <a class=\"topDefault\" href=\"";
        // line 40
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["account"]) ? $context["account"] : null), "first_link", array()), "html", null, true));
        echo "\" title=\"";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["account"]) ? $context["account"] : null), "first_title", array()), "html", null, true));
        echo "\"><span>";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["account"]) ? $context["account"] : null), "first_label", array()), "html", null, true));
        echo "</span></a> 
                                <span>|</span> 
                                <a class=\"";
        // line 42
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["account"]) ? $context["account"] : null), "second_class", array()), "html", null, true));
        echo "\" href=\"";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["account"]) ? $context["account"] : null), "second_link", array()), "html", null, true));
        echo "\" title=\"";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["account"]) ? $context["account"] : null), "second_title", array()), "html", null, true));
        echo "\"><span>";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["account"]) ? $context["account"] : null), "second_label", array()), "html", null, true));
        echo "</span></a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"wrap\" style=\"background:none\">
                <div class=\"logo\"><a href=\"";
        // line 49
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("<front>")));
        echo "\" title=\"";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Home")));
        echo "\" rel=\"home\"><img src=\"/themes/chipdyno/images/logo.jpg\"></a></div>
                        ";
        // line 50
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("mainnavigation", false), "html", null, true));
        echo "
                        
                <div class=\"clear\">&nbsp;</div>
                </div>

            <div class=\"top-nav1\">
                <div class=\"wrap\">
                    <ul>
                        <li>";
        // line 58
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("cart", false), "html", null, true));
        echo "</li>
                        <li><a href=\"mailto:info@chip4dyno.com\" style=\"border-right:1px solid #f2f2f2;\">Question? Mail Us</a></li>
                        <div class=\"clear\">&nbsp;</div>
                    </ul>
                </div>
            </div>
            <!--End-header---></div>
        <script>
            var sselected = false;
            var sbrand = \"\";
            var smodel = \"\";
            var sproduct = \"\";

        </script><style>

            #cardropdown {
                padding: 12px 0rem 28px 16px;
                background: #009fdb;
                margin-bottom: 24px;
                font-family: 'PT Sans', sans-serif;
            }
            #cardropdown select {
                box-sizing:border-box;
                width: 99%;
                margin: 0 auto;
                font-family: 'Roboto', sans-serif;
                margin-bottom: 2px;
                border: solid 1px #999;
                height: 35px !important;
                font-size: 0.9em;
            }
            #cardropdown select[disabled] {
                background: #efefef;
                border: solid 1px #ccc;
            }

        </style></div>

</div>
";
    }

    public function getTemplateName()
    {
        return "themes/chipdyno/templates/block/block--homepageheader.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 58,  92 => 50,  86 => 49,  70 => 42,  61 => 40,  55 => 37,  45 => 29,  43 => 28,);
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
 * Theme override to display a block.
 *
 * Available variables:
 * - plugin_id: The ID of the block implementation.
 * - label: The configured label of the block if visible.
 * - configuration: A list of the block's configuration values.
 *   - label: The configured label for the block.
 *   - label_display: The display settings for the label.
 *   - provider: The module or other provider that provided this block plugin.
 *   - Block plugin specific settings will also be stored here.
 * - content: The content of this block.
 * - attributes: array of HTML attributes populated by modules, intended to
 *   be added to the main container tag of this template.
 *   - id: A valid HTML ID and guaranteed unique.
 * - title_attributes: Same as attributes, except applied to the main title
 *   tag that appears in the template.
 * - title_prefix: Additional output populated by modules, intended to be
 *   displayed in front of the main title tag that appears in the template.
 * - title_suffix: Additional output populated by modules, intended to be
 *   displayed after the main title tag that appears in the template.
 *
 * @see template_preprocess_block()
 */
#}
{% set account = account_menu() %}
<div id=\"block-homepageheader\" class=\"block block-block-content block-block-content53ee5745-6392-4fab-ba96-184547a6d319\">


    <div class=\"clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item\">
        <div class=\"header\"><!--start-wrap--->
            <div id=\"topOptions\">
                <div class=\"wrap\">
                    <div id=\"topOptionsWrapper\">
                        {{ drupal_block('languageswitcher', FALSE) }}
                        <div id=\"topaccount\">
                            <div id=\"topaccountBtns\">
                                <a class=\"topDefault\" href=\"{{ account.first_link }}\" title=\"{{ account.first_title }}\"><span>{{ account.first_label }}</span></a> 
                                <span>|</span> 
                                <a class=\"{{ account.second_class }}\" href=\"{{ account.second_link }}\" title=\"{{ account.second_title }}\"><span>{{ account.second_label }}</span></a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"wrap\" style=\"background:none\">
                <div class=\"logo\"><a href=\"{{ path('<front>') }}\" title=\"{{ 'Home'|t }}\" rel=\"home\"><img src=\"/themes/chipdyno/images/logo.jpg\"></a></div>
                        {{ drupal_block('mainnavigation', FALSE) }}
                        
                <div class=\"clear\">&nbsp;</div>
                </div>

            <div class=\"top-nav1\">
                <div class=\"wrap\">
                    <ul>
                        <li>{{ drupal_block('cart', FALSE) }}</li>
                        <li><a href=\"mailto:info@chip4dyno.com\" style=\"border-right:1px solid #f2f2f2;\">Question? Mail Us</a></li>
                        <div class=\"clear\">&nbsp;</div>
                    </ul>
                </div>
            </div>
            <!--End-header---></div>
        <script>
            var sselected = false;
            var sbrand = \"\";
            var smodel = \"\";
            var sproduct = \"\";

        </script><style>

            #cardropdown {
                padding: 12px 0rem 28px 16px;
                background: #009fdb;
                margin-bottom: 24px;
                font-family: 'PT Sans', sans-serif;
            }
            #cardropdown select {
                box-sizing:border-box;
                width: 99%;
                margin: 0 auto;
                font-family: 'Roboto', sans-serif;
                margin-bottom: 2px;
                border: solid 1px #999;
                height: 35px !important;
                font-size: 0.9em;
            }
            #cardropdown select[disabled] {
                background: #efefef;
                border: solid 1px #ccc;
            }

        </style></div>

</div>
", "themes/chipdyno/templates/block/block--homepageheader.html.twig", "/mnt/jeet/www/local/chipc/themes/chipdyno/templates/block/block--homepageheader.html.twig");
    }
}
