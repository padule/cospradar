(function() {
  var _ref,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Collections.Schedules = (function(_super) {
    __extends(Schedules, _super);

    function Schedules() {
      this.poll = __bind(this.poll, this);
      _ref = Schedules.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    Schedules.prototype.model = padule.Models.Schedule;

    Schedules.prototype.url = "/schedules";

    Schedules.prototype.localStorage = new Store("schedule");

    Schedules.prototype.comparator = 'start_time';

    Schedules.prototype.parse = function(resp) {
      if (_.isArray(resp)) {
        return resp;
      } else {
        return resp.responseText;
      }
    };

    Schedules.prototype.initialize = function(models, options) {
      if (options == null) {
        options = {};
      }
      return this.event = options._event;
    };

    Schedules.prototype.fetchByEvent = function(options) {
      var defs;
      if (options == null) {
        options = {};
      }
      defs = {
        data: {
          event_id: this.event.id
        }
      };
      options = $.extend(defs, options);
      return this.fetch(options);
    };

    Schedules.prototype.poll = function() {
      var _this = this;
      return this.fetchByEvent({
        reset: true,
        success: function(collection) {
          return _this.collection = collection;
        }
      });
    };

    Schedules.prototype.first_schedule = function() {
      return this.min(function(schedule) {
        return schedule.id;
      });
    };

    return Schedules;

  })(Backbone.Collection);

}).call(this);
