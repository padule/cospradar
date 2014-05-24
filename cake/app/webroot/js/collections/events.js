(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Collections.Events = (function(_super) {
    __extends(Events, _super);

    function Events() {
      _ref = Events.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    Events.prototype.model = padule.Models.Event;

    Events.prototype.url = "/events";

    Events.prototype.localStorage = new Store("event");

    Events.prototype.comparator = function(model) {
      return -1 * model.id;
    };

    Events.prototype.parse = function(resp) {
      if (_.isArray(resp)) {
        return resp;
      } else {
        return resp.responseText;
      }
    };

    return Events;

  })(Backbone.Collection);

}).call(this);
