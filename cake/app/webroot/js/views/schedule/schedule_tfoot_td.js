(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleTFootTd = (function(_super) {
    __extends(ScheduleTFootTd, _super);

    function ScheduleTFootTd() {
      _ref = ScheduleTFootTd.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleTFootTd.prototype.tagName = 'td';

    ScheduleTFootTd.prototype.initialize = function() {
      return _.bindAll(this);
    };

    ScheduleTFootTd.prototype.render = function() {
      this.$el.html(this.model.get('comment'));
      return this;
    };

    return ScheduleTFootTd;

  })(Backbone.View);

}).call(this);
