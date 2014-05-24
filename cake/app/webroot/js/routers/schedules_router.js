(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Routers.Schedules = (function(_super) {
    __extends(Schedules, _super);

    function Schedules() {
      _ref = Schedules.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    Schedules.prototype.routes = {
      'users/mypage': 'mypage',
      'seeker_schedules/index/:id': 'seeker_schedules',
      'feedbacks': 'feedbacks'
    };

    Schedules.prototype.mypage = function() {
      return new padule.Views.Event({
        collection: new padule.Collections.Events
      });
    };

    Schedules.prototype.seeker_schedules = function() {
      var event_id;
      event_id = $('.seeker-schedule-container').attr('data-eventid');
      return new padule.Views.SeekerScheduleInput({
        collection: new padule.Collections.Schedules(false, {
          _event: new padule.Models.Event({
            id: event_id
          })
        }),
        seeker: new padule.Models.Seeker
      });
    };

    Schedules.prototype.feedbacks = function() {
      return new padule.Views.FeedbackIndex({
        collection: new padule.Collections.Feedbacks
      });
    };

    return Schedules;

  })(Backbone.Router);

}).call(this);
