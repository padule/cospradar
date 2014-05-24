(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleTfootTr = (function(_super) {
    __extends(ScheduleTfootTr, _super);

    function ScheduleTfootTr() {
      _ref = ScheduleTfootTr.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleTfootTr.prototype.tagName = 'tr';

    ScheduleTfootTr.prototype.initialize = function() {
      _.bindAll(this);
      this.seeker_schedules = [];
      if (this.collection.models.length > 0) {
        return this.seeker_schedules = this.collection.first_schedule().seeker_schedules;
      }
    };

    ScheduleTfootTr.prototype.renderOne = function(seeker_schedule) {
      var view;
      view = new padule.Views.ScheduleTFootTd({
        model: seeker_schedule.seeker
      });
      return this.$el.append(view.render().el);
    };

    ScheduleTfootTr.prototype.render = function() {
      var _ref1;
      this.$el.append('<td></td>');
      if ((_ref1 = this.seeker_schedules) != null) {
        _ref1.each(this.renderOne);
      }
      return this;
    };

    return ScheduleTfootTr;

  })(Backbone.View);

}).call(this);
