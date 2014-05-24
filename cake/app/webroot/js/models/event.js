(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Models.Event = (function(_super) {
    __extends(Event, _super);

    function Event() {
      _ref = Event.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    Event.prototype.urlRoot = "/events";

    Event.prototype.parse = function(resp) {
      if (resp.responseText) {
        return resp.responseText;
      } else {
        return resp;
      }
    };

    Event.prototype.className = 'padule.Models.Event';

    Event.prototype.defaults = {
      title: "",
      url: "",
      text: "",
      enabled: true
    };

    Event.prototype.validate = function(attrs) {
      if (_.isEmpty(attrs.title)) {
        return "イベント名を入力してください。";
      }
    };

    return Event;

  })(Backbone.Model);

}).call(this);
