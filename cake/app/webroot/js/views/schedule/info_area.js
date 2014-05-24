(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.InfoArea = (function(_super) {
    __extends(InfoArea, _super);

    function InfoArea() {
      _ref = InfoArea.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    InfoArea.prototype.el = $('.info-area');

    InfoArea.prototype.initialize = function() {
      return _.bindAll(this);
    };

    InfoArea.prototype.show = function(options) {
      var ms,
        _this = this;
      if (options == null) {
        options = {};
      }
      if (options.ms) {
        ms = options.ms;
      } else {
        ms = 4000;
      }
      this.$('.label').removeClass().addClass('label').addClass(options.class_name).html(options.text);
      this.$el.removeClass('show').addClass('show');
      return setTimeout(function() {
        return _this.$el.removeClass('show');
      }, ms);
    };

    InfoArea.prototype.hide = function() {
      return this.$el.removeClass('show');
    };

    return InfoArea;

  })(Backbone.View);

}).call(this);
