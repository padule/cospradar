(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleTheadTr = (function(_super) {
    __extends(ScheduleTheadTr, _super);

    function ScheduleTheadTr() {
      _ref = ScheduleTheadTr.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleTheadTr.prototype.tagName = 'tr';

    ScheduleTheadTr.prototype.initialize = function() {
      _.bindAll(this);
      this.seeker_schedules = [];
      if (this.collection.models.length > 0) {
        return this.seeker_schedules = this.collection.first_schedule().seeker_schedules;
      }
    };

    ScheduleTheadTr.prototype.renderOne = function(seeker_schedule) {
      var view;
      view = new padule.Views.ScheduleTheadTh({
        model: seeker_schedule
      });
      return this.$el.append(view.render().el);
    };

    ScheduleTheadTr.prototype.render = function() {
      var _ref1;
      this.$el.append('<th></th>');
      if ((_ref1 = this.seeker_schedules) != null) {
        _ref1.each(this.renderOne);
      }
      return this;
    };

    return ScheduleTheadTr;

  })(Backbone.View);

}).call(this);
