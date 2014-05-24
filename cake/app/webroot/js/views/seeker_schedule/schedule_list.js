(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleList = (function(_super) {
    __extends(ScheduleList, _super);

    function ScheduleList() {
      _ref = ScheduleList.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleList.prototype.el = $('#seeker-schedule-edit ul');

    ScheduleList.prototype.initialize = function(options) {
      _.bindAll(this);
      this.listenTo(this.collection, 'sync', this.render);
      return this.seeker = options.seeker;
    };

    ScheduleList.prototype.renderOne = function(schedule) {
      var view;
      view = new padule.Views.ScheduleListElement({
        model: schedule,
        seeker: this.seeker
      });
      return this.$el.append(view.render().el);
    };

    ScheduleList.prototype.render = function() {
      this.collection.each(this.renderOne);
      return this;
    };

    return ScheduleList;

  })(Backbone.View);

}).call(this);
