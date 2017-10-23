<?php

/* themes/chipdyno/templates/block/block--homepagesteps.html.twig */
class __TwigTemplate_f4a773f0aa7d522c58777b20da05f183093fbeeadce1e5b6d1a44dcafc74438f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("set" => 2, "if" => 10, "block" => 14);
        $filters = array("clean_class" => 4);
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('set', 'if', 'block'),
                array('clean_class'),
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

        // line 2
        $context["classes"] = array(0 => "block", 1 => ("block-" . \Drupal\Component\Utility\Html::getClass($this->getAttribute(        // line 4
(isset($context["configuration"]) ? $context["configuration"] : null), "provider", array()))), 2 => ("block-" . \Drupal\Component\Utility\Html::getClass(        // line 5
(isset($context["plugin_id"]) ? $context["plugin_id"] : null))));
        // line 8
        echo "
  ";
        // line 9
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["title_prefix"]) ? $context["title_prefix"] : null), "html", null, true));
        echo "
  ";
        // line 10
        if ((isset($context["label"]) ? $context["label"] : null)) {
            // line 11
            echo "    <h2";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["title_attributes"]) ? $context["title_attributes"] : null), "html", null, true));
            echo ">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true));
            echo "</h2>
  ";
        }
        // line 13
        echo "  ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["title_suffix"]) ? $context["title_suffix"] : null), "html", null, true));
        echo "
  ";
        // line 14
        $this->displayBlock('content', $context, $blocks);
        // line 17
        echo "  
<div id=\"cardropdown\" class=\"pure-g\">
<form name=\"tuning_files\" id=\"tuning_files\" method=\"get\" action=\"/search-tuning-files\">
    <h2>You can view all our tuning files specifications online</h2>
    <div class=\"pure-u-1 pure-u-md-4-24\" >
        <select data-drupal-selector=\"edit-field-make-target-id\" 
                id=\"edit-field-make-target-id\" name=\"field_make_target_id\" 
                class=\"form-select\">
            <option value=\"All\">Choose Make</option>
        </select>
    </div>
    <div class=\"pure-u-1 pure-u-md-4-24\">
        <select data-drupal-selector=\"edit-field-model-target-id\" id=\"edit-field-model-target-id\" 
                name=\"field_model_target_id\" class=\"form-select\">
            <option value=\"All\">Choose Model</option>
        </select>        
    </div>
    <div class=\"pure-u-1 pure-u-md-4-24\" >
        <select data-drupal-selector=\"edit-field-generation-target-id\" 
                id=\"edit-field-generation-target-id\" name=\"field_generation_target_id\" class=\"form-select\">
            <option value=\"All\">Choose Generation</option>
        </select>
    </div>
    <div class=\"pure-u-1 pure-u-md-4-24\" >
        <select data-drupal-selector=\"edit-field-engine-target-id\" 
                id=\"edit-field-engine-target-id\" name=\"field_engine_target_id\" class=\"form-select\">
            <option value=\"All\">Choose Engine</option>
        </select>
    </div>
    <div class=\"pure-u-1 pure-u-md-4-24last\">
        <input type=\"image\" name=\"search_file\" value=\"Search\" class=\"search_input\"
               src=\"/themes/chipdyno/images/more.png\">
    </div>
</form>
</div>
";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true));
        echo "
  ";
    }

    public function getTemplateName()
    {
        return "themes/chipdyno/templates/block/block--homepagesteps.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 15,  111 => 14,  72 => 17,  70 => 14,  65 => 13,  57 => 11,  55 => 10,  51 => 9,  48 => 8,  46 => 5,  45 => 4,  44 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{%
  set classes = [
    'block',
    'block-' ~ configuration.provider|clean_class,
    'block-' ~ plugin_id|clean_class,
  ]
%}

  {{ title_prefix }}
  {% if label %}
    <h2{{ title_attributes }}>{{ label }}</h2>
  {% endif %}
  {{ title_suffix }}
  {% block content %}
    {{ content }}
  {% endblock %}
  
<div id=\"cardropdown\" class=\"pure-g\">
<form name=\"tuning_files\" id=\"tuning_files\" method=\"get\" action=\"/search-tuning-files\">
    <h2>You can view all our tuning files specifications online</h2>
    <div class=\"pure-u-1 pure-u-md-4-24\" >
        <select data-drupal-selector=\"edit-field-make-target-id\" 
                id=\"edit-field-make-target-id\" name=\"field_make_target_id\" 
                class=\"form-select\">
            <option value=\"All\">Choose Make</option>
        </select>
    </div>
    <div class=\"pure-u-1 pure-u-md-4-24\">
        <select data-drupal-selector=\"edit-field-model-target-id\" id=\"edit-field-model-target-id\" 
                name=\"field_model_target_id\" class=\"form-select\">
            <option value=\"All\">Choose Model</option>
        </select>        
    </div>
    <div class=\"pure-u-1 pure-u-md-4-24\" >
        <select data-drupal-selector=\"edit-field-generation-target-id\" 
                id=\"edit-field-generation-target-id\" name=\"field_generation_target_id\" class=\"form-select\">
            <option value=\"All\">Choose Generation</option>
        </select>
    </div>
    <div class=\"pure-u-1 pure-u-md-4-24\" >
        <select data-drupal-selector=\"edit-field-engine-target-id\" 
                id=\"edit-field-engine-target-id\" name=\"field_engine_target_id\" class=\"form-select\">
            <option value=\"All\">Choose Engine</option>
        </select>
    </div>
    <div class=\"pure-u-1 pure-u-md-4-24last\">
        <input type=\"image\" name=\"search_file\" value=\"Search\" class=\"search_input\"
               src=\"/themes/chipdyno/images/more.png\">
    </div>
</form>
</div>
", "themes/chipdyno/templates/block/block--homepagesteps.html.twig", "/mnt/jeet/www/local/chipc/themes/chipdyno/templates/block/block--homepagesteps.html.twig");
    }
}
