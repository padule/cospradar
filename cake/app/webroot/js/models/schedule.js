(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Models.Schedule = (function(_super) {
    __extends(Schedule, _super);

    function Schedule() {
      _ref = Schedule.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    Schedule.prototype.urlRoot = "/schedules";

    Schedule.prototype.localStorage = new Store("schedule");

    Schedule.prototype.parse = function(resp) {
      if (resp.responseText) {
        return resp.responseText;
      } else {
        return resp;
      }
    };

    Schedule.prototype.initialize = function() {
      var _ref1, _ref2;
      if (this.has('seeker_schedules')) {
        return this.seeker_schedules = new padule.Collections.SeekerSchedules(this.get('seeker_schedules'), {
          schedule: this
        });
      } else if ((_ref1 = this.collection) != null ? (_ref2 = _ref1.first()) != null ? _ref2.has('seeker_schedules') : void 0 : void 0) {
        return this.seeker_schedules = this.collection.first().seeker_schedules.clone().resetType();
      } else {
        return this.seeker_schedules = new padule.Collections.SeekerSchedules(false, {
          schedule: this
        });
      }
    };

    Schedule.prototype.saveByEvent = function(options) {
      if (options == null) {
        options = {};
      }
      this.seeker_schedules.each(function(seeker_schedule) {
        return seeker_schedule.save();
      });
      options = {
        url: this.url() + "?event_id=" + this.get('event_id'),
        success: options.success()
      };
      return this.save(null, options);
    };

    return Schedule;

  })(Backbone.Model);

}).call(this);
