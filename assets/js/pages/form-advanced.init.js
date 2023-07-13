!function ($) {
  "use strict";

  var AdvancedForm = function () { };

  AdvancedForm.prototype.init = function () {

    // Select2
    $(".select2").select2();

    function formatState(state) {
      if (!state.id) {
        return state.text;
      }
    //   var baseUrl = "./assets/images/icons";
    //   var $state = $(
    //     '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
    //   );
    var $state = $(
                '<span><i class="fab fa-'+ state.element.value.toLowerCase() +' h3 social-d"></i> ' + state.text + '</span>'
              );
      return $state;
    };

    $(".select2-templating").select2({
      templateResult: formatState
    });
    $(".select2-nosearch").select2({
      minimumResultsForSearch: -1,
      templateResult: formatState
    });

    $('.plan-content-wrapper textarea, .plan-content-wrapper #pc_title, .project-content-wrapper textarea, .project-content-wrapper #pc_title').maxlength({
      alwaysShow: true,
      warningClass: "badge bg-info",
      limitReachedClass: "badge bg-warning"
    });

  },
    //init
    $.AdvancedForm = new AdvancedForm, $.AdvancedForm.Constructor = AdvancedForm
}(window.jQuery),

  //Datepicker
  function ($) {
    "use strict";
    $.AdvancedForm.init();
  }(window.jQuery);

$(function () {
  'use strict';

  var $date = $('.docs-date');
  var $container = $('.docs-datepicker-container');
  var $trigger = $('.docs-datepicker-trigger');
  var options = {
    show: function (e) {
      console.log(e.type, e.namespace);
    },
    hide: function (e) {
      console.log(e.type, e.namespace);
    },
    pick: function (e) {
      console.log(e.type, e.namespace, e.view);
    }
  };

  $date.on({
    'show.datepicker': function (e) {
      console.log(e.type, e.namespace);
    },
    'hide.datepicker': function (e) {
      console.log(e.type, e.namespace);
    },
    'pick.datepicker': function (e) {
      console.log(e.type, e.namespace, e.view);
    }
  }).datepicker(options);

  $('.docs-options, .docs-toggles').on('change', function (e) {
    var target = e.target;
    var $target = $(target);
    var name = $target.attr('name');
    var value = target.type === 'checkbox' ? target.checked : $target.val();
    var $optionContainer;

    switch (name) {
      case 'container':
        if (value) {
          value = $container;
          $container.show();
        } else {
          $container.hide();
        }

        break;

      case 'trigger':
        if (value) {
          value = $trigger;
          $trigger.prop('disabled', false);
        } else {
          $trigger.prop('disabled', true);
        }

        break;

      case 'inline':
        $optionContainer = $('input[name="container"]');

        if (!$optionContainer.prop('checked')) {
          $optionContainer.click();
        }

        break;

      case 'language':
        $('input[name="format"]').val($.fn.datepicker.languages[value].format);
        break;
    }

    options[name] = value;
    $date.datepicker('reset').datepicker('destroy').datepicker(options);
  });

  $('.docs-actions').on('click', 'button', function (e) {
    var data = $(this).data();
    var args = data.arguments || [];
    var result;

    e.stopPropagation();

    if (data.method) {
      if (data.source) {
        $date.datepicker(data.method, $(data.source).val());
      } else {
        result = $date.datepicker(data.method, args[0], args[1], args[2]);

        if (result && data.target) {
          $(data.target).val(result);
        }
      }
    }
  });

});