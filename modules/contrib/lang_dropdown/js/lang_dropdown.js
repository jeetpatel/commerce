(function ($, drupalSettings) {
  'use strict';

  Drupal.behaviors.lang_dropdown = {
    attach: function (context, settings) {
      settings = settings || drupalSettings;

      if (settings.lang_dropdown) {
        var flags;
        var msddSettings;

        for (var key in settings.lang_dropdown) {
          msddSettings = settings.lang_dropdown[key];
          flags = msddSettings.languageicons;
          if (flags) {
            $.each(flags, function (index, value) {
              if (msddSettings.widget === 'msdropdown') {
                $('select#lang-dropdown-select-' + msddSettings.key + ' option[value="' + index + '"]').attr('data-image', value);
              }
              else if (msddSettings.widget === 'ddslick' && Boolean(msddSettings.showSelectedHTML)) {
                $('select#lang-dropdown-select-' + msddSettings.key + ' option[value="' + index + '"]').attr('data-imagesrc', value);
              }
            });
          }

          if (msddSettings.widget === 'msdropdown') {
            try {
              $('select#lang-dropdown-select-' + msddSettings.key).msDropDown({
                visibleRows: msddSettings.visibleRows,
                roundedCorner: Boolean(msddSettings.roundedCorner),
                animStyle: msddSettings.animStyle,
                event: msddSettings.event,
                mainCSS: msddSettings.mainCSS
              });
            }
            catch (e) {
              if (console) {
                console.log(e);
              }
            }
          }
          else if (msddSettings.widget === 'chosen') {
            $('select#lang-dropdown-select-' + msddSettings.key).chosen({
              disable_search: msddSettings.disable_search,
              no_results_text: msddSettings.no_results_text
            });
          }
          else if (msddSettings.widget === 'ddslick') {
            $.data(document.body, 'ddslick' + key + 'flag', 0);
            $('select#lang-dropdown-select-' + msddSettings.key).ddslick({
              width: msddSettings.width,
              height: (msddSettings.height === 0) ? null : msddSettings.height,
              showSelectedHTML: Boolean(msddSettings.showSelectedHTML),
              imagePosition: msddSettings.imagePosition,
              onSelected: function (data) {
                var i = $.data(document.body, 'ddslick' + key + 'flag');
                if (i) {
                  $.data(document.body, 'ddslick' + key + 'flag', 0);
                  $(this).parents('form').submit();
                }
                $.data(document.body, 'ddslick' + key + 'flag', 1);
              }
            });
          }
        }
      }

      $('select.lang-dropdown-select-element').change(function () {
        $(this).parents('form').submit();
      });

      $('form.lang-dropdown-form').after('<div style="clear:both;"></div>');
    }
  };
})(jQuery, drupalSettings);
