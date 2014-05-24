(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleListElement = (function(_super) {
    __extends(ScheduleListElement, _super);

    function ScheduleListElement() {
      _ref = ScheduleListElement.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleListElement.prototype.tagName = 'li';

    ScheduleListElement.prototype.className = 'list-group-item';

    ScheduleListElement.prototype.template = JST['templates/seeker_schedule_status'];

    ScheduleListElement.prototype.events = {
      'click .seeker-schedule-btn': 'changeType'
    };

    ScheduleListElement.prototype.initialize = function(options) {
      _.bindAll(this);
      this.seeker_schedule = new padule.Models.SeekerSchedule({
        'type': 0
      }, {
        schedule: this.model
      });
      this.seeker_schedule.seeker = options.seeker;
      this.model.seeker_schedules.push(this.seeker_schedule);
      return this.listenTo(this.seeker_schedule, 'change:type', this.render);
    };

    ScheduleListElement.prototype.changeType = function(e) {
      e.preventDefault();
      return this.seeker_schedule.changeTypeBySeeker();
    };

    ScheduleListElement.prototype.render = function() {
      this.$el.html(this.template({
        start_time: padule.dateformatyyyyMMddWhhmm(this.model.get('start_time')),
        btn_class: this.btnAttrs().btn_class_name,
        icon_class: this.btnAttrs().icon_class_name
      }));
      return this;
    };

    ScheduleListElement.prototype.btnAttrs = function() {
      if (this.seeker_schedule.isOK()) {
        return {
          btn_class_name: 'btn-success',
          icon_class_name: 'glyphicon-ok',
          text: '◯'
        };
      } else {
        return {
          btn_class_name: 'btn-default',
          icon_class_name: 'glyphicon-remove',
          text: '×'
        };
      }
    };

    return ScheduleListElement;

  })(Backbone.View);

}).call(this);
