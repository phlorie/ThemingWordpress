/**
 * Hugo scripts.
 *
 * @version 1.0
 */

/* --------------------------------------------------------------------
  =Fixed header
-------------------------------------------------------------------- */
(function($) {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) /* top bar height + site-title height */ {
            $('.site-nav').addClass('fixed-nav');
            $('.wild-title').css('margin-left', '20px');
        } else {
            $('.site-nav').removeClass('fixed-nav');
            $('.wild-title').css('margin-left', '-560px');
        }
    });
})(jQuery);

/* --------------------------------------------------------------------
  =Popover share button
-------------------------------------------------------------------- */

(function($) {
    $.fn.popover = function(options) {
      var defaults = {
        openEvent: null,
        closeEvent: null,
        offsetX: 0,
        offsetY: 0
    }
    var options = $.extend(defaults, options);

  var content = $(options.content).detach();
  var floater = $('<div class="popover">'
    + '<div class="triangle"></div>'
    + '<div class="pop-content"></div>'
    + '</div>').appendTo('body');
  $('.pop-content', floater).append(content);

  $.fn.popover.openedPopup = null;
  $(document).bind("click", function(event) {
    if ($.fn.popover.openedPopup != null
        && ($(event.target).parents(".popover").length === 0)
        && (!$(event.target).hasClass('popover-button'))) {
      $.fn.popover.openedPopup.trigger('hidePopover');
}
});

  var showPopover = function(button) {
    if ($.fn.popover.openedPopup === button) {
      $.fn.popover.openedPopup.trigger('hidePopover');
      return false;
  } else if($.fn.popover.openedPopup != null){
      $.fn.popover.openedPopup.trigger('hidePopover');
  }
  var triangle = $('.triangle', floater).click(function() {
    button.trigger('hidePopover') });

    floater.css('display', 'block');

    var leftOff = 0;
    var topOff = 0;
    var docWidth = $(document).width();
    var docHeight = $(document).height();
    var triangleSize = parseInt(triangle.css("border-bottom-width"));
    var contentWidth = floater.outerWidth();
    var contentHeight = floater.outerHeight();
    var buttonWidth = button.outerWidth();
    var buttonHeight = button.outerHeight()
    var offset = button.offset();

    topOff = offset.top - 124;//buttonHeight - triangleSize;
    var diffHeight = docHeight - (topOff + contentHeight + triangleSize);
    if (diffHeight < 0){
      floater.height(floater.height() + diffHeight);
  }

    var padding = 18;

    leftOff = offset.left + (buttonWidth - contentWidth)/2;
    var diffWidth = 0;
    if (leftOff < padding) {
      diffWidth = leftOff - padding;
  } else if (leftOff + contentWidth > docWidth) {
      diffWidth = leftOff + contentWidth - docWidth + padding;
  }

    triangle.css("left", contentWidth/2 - triangleSize + diffWidth);

    floater.offset({
      top: topOff + options.offsetY,
      left: leftOff - diffWidth + options.offsetX
  });
    floater.show();
    window.setTimeout(function() {
      floater.addClass("active");
      $(window).resize();
  }, 0);
    if ($.isFunction(options.openEvent)) options.openEvent();
    $.fn.popover.openedPopup = button;
    button.addClass('popover-on');
    return false;
}

this.each(function(){
    var button = $(this);
    button.addClass("popover-button");
    button.bind('click', function() { showPopover(button) });
    button.bind('showPopover', function() { showPopover(button) });
    button.bind('hidePopover', function() {
      button.removeClass('popover-on');
      floater.removeClass("active").attr("style", "").css('display', 'none');
      if ($.isFunction(options.closeEvent)) {
        options.closeEvent();
    }
    $.fn.popover.openedPopup = null;
    window.setTimeout(function() {
        $(window).resize();
    }, 0);
    return false;
});
});
}
})(jQuery);


/* --------------------------------------------------------------------
  =Better count for categories
-------------------------------------------------------------------- */

(function($) {
    $('.secondary li.cat-item').each(function(){
        var $contents = $(this).contents();
        if ($contents.length > 1)  {
            $contents.eq(1).wrap('<div class="cat-num"><span class="inner-num"></span></div>');

            $contents.eq(1).each(function() {
            });
        }
    }).contents();

    $('.secondary li.cat-item .cat-num .inner-num').each(function () {
        $(this).html($(this).text().substring(2));
        $(this).html( $(this).text().replace(/\)/gi, "") );
    });

    if ($('.secondary li.cat-item').length) {
        $('.secondary li.cat-item .cat-num .inner-num').each( function() {
            if ($(this).is(':empty')){
                $(this).parent().hide();
            }
        });
    }
})(jQuery);

/*
 * Bootstrap: dropdown.js v3.0.3
 * http://getbootstrap.com/javascript/#dropdowns
 *
 * Copyright 2013 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 */
+function(e){"use strict";function i(){e(t).remove();e(n).each(function(t){var n=s(e(this));if(!n.hasClass("open"))return;n.trigger(t=e.Event("hide.bs.dropdown"));if(t.isDefaultPrevented())return;n.removeClass("open").trigger("hidden.bs.dropdown")})}function s(t){var n=t.attr("data-target");if(!n){n=t.attr("href");n=n&&/#/.test(n)&&n.replace(/.*(?=#[^\s]*$)/,"")}var r=n&&e(n);return r&&r.length?r:t.parent()}var t=".dropdown-backdrop";var n="[data-toggle=dropdown]";var r=function(t){e(t).on("click.bs.dropdown",this.toggle)};r.prototype.toggle=function(t){var n=e(this);if(n.is(".disabled, :disabled"))return;var r=s(n);var o=r.hasClass("open");i();if(!o){if("ontouchstart"in document.documentElement&&!r.closest(".navbar-nav").length){e('<div class="dropdown-backdrop"/>').insertAfter(e(this)).on("click",i)}r.trigger(t=e.Event("show.bs.dropdown"));if(t.isDefaultPrevented())return;r.toggleClass("open").trigger("shown.bs.dropdown");n.focus()}return false};r.prototype.keydown=function(t){if(!/(38|40|27)/.test(t.keyCode))return;var r=e(this);t.preventDefault();t.stopPropagation();if(r.is(".disabled, :disabled"))return;var i=s(r);var o=i.hasClass("open");if(!o||o&&t.keyCode==27){if(t.which==27)i.find(n).focus();return r.click()}var u=e("[role=menu] li:not(.divider):visible a",i);if(!u.length)return;var a=u.index(u.filter(":focus"));if(t.keyCode==38&&a>0)a--;if(t.keyCode==40&&a<u.length-1)a++;if(!~a)a=0;u.eq(a).focus()};var o=e.fn.dropdown;e.fn.dropdown=function(t){return this.each(function(){var n=e(this);var i=n.data("bs.dropdown");if(!i)n.data("bs.dropdown",i=new r(this));if(typeof t=="string")i[t].call(n)})};e.fn.dropdown.Constructor=r;e.fn.dropdown.noConflict=function(){e.fn.dropdown=o;return this};e(document).on("click.bs.dropdown.data-api",i).on("click.bs.dropdown.data-api",".dropdown form",function(e){e.stopPropagation()}).on("click.bs.dropdown.data-api",n,r.prototype.toggle).on("keydown.bs.dropdown.data-api",n+", [role=menu]",r.prototype.keydown)}(jQuery)


/*
 * Bootstrap: collapse.js v3.0.3
 * http://getbootstrap.com/javascript/#collapse
 *
 * Copyright 2013 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 */
+function(e){"use strict";var t=function(n,r){this.$element=e(n);this.options=e.extend({},t.DEFAULTS,r);this.transitioning=null;if(this.options.parent)this.$parent=e(this.options.parent);if(this.options.toggle)this.toggle()};t.DEFAULTS={toggle:true};t.prototype.dimension=function(){var e=this.$element.hasClass("width");return e?"width":"height"};t.prototype.show=function(){if(this.transitioning||this.$element.hasClass("in"))return;var t=e.Event("show.bs.collapse");this.$element.trigger(t);if(t.isDefaultPrevented())return;var n=this.$parent&&this.$parent.find("> .panel > .in");if(n&&n.length){var r=n.data("bs.collapse");if(r&&r.transitioning)return;n.collapse("hide");r||n.data("bs.collapse",null)}var i=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[i](0);this.transitioning=1;var s=function(){this.$element.removeClass("collapsing").addClass("in")[i]("auto");this.transitioning=0;this.$element.trigger("shown.bs.collapse")};if(!e.support.transition)return s.call(this);var o=e.camelCase(["scroll",i].join("-"));this.$element.one(e.support.transition.end,e.proxy(s,this)).emulateTransitionEnd(350)[i](this.$element[0][o])};t.prototype.hide=function(){if(this.transitioning||!this.$element.hasClass("in"))return;var t=e.Event("hide.bs.collapse");this.$element.trigger(t);if(t.isDefaultPrevented())return;var n=this.dimension();this.$element[n](this.$element[n]())[0].offsetHeight;this.$element.addClass("collapsing").removeClass("collapse").removeClass("in");this.transitioning=1;var r=function(){this.transitioning=0;this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse")};if(!e.support.transition)return r.call(this);this.$element[n](0).one(e.support.transition.end,e.proxy(r,this)).emulateTransitionEnd(350)};t.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()};var n=e.fn.collapse;e.fn.collapse=function(n){return this.each(function(){var r=e(this);var i=r.data("bs.collapse");var s=e.extend({},t.DEFAULTS,r.data(),typeof n=="object"&&n);if(!i)r.data("bs.collapse",i=new t(this,s));if(typeof n=="string")i[n]()})};e.fn.collapse.Constructor=t;e.fn.collapse.noConflict=function(){e.fn.collapse=n;return this};e(document).on("click.bs.collapse.data-api","[data-toggle=collapse]",function(t){var n=e(this),r;var i=n.attr("data-target")||t.preventDefault()||(r=n.attr("href"))&&r.replace(/.*(?=#[^\s]+$)/,"");var s=e(i);var o=s.data("bs.collapse");var u=o?"toggle":n.data();var a=n.attr("data-parent");var f=a&&e(a);if(!o||!o.transitioning){if(f)f.find('[data-toggle=collapse][data-parent="'+a+'"]').not(n).addClass("collapsed");n[s.hasClass("in")?"addClass":"removeClass"]("collapsed")}s.collapse(u)})}(jQuery)