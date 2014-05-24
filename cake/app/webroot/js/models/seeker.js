(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Models.Seeker = (function(_super) {
    __extends(Seeker, _super);

    function Seeker() {
      _ref = Seeker.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    Seeker.prototype.urlRoot = "/seekers";

    Seeker.prototype.localStorage = new Store("seeker");

    Seeker.prototype.parse = function(resp) {
      if (resp.responseText) {
        return resp.responseText;
      } else {
        return resp;
      }
    };

    Seeker.prototype.defaults = {
      comment: ""
    };

    Seeker.prototype.initialize = function(options) {
      if (options == null) {
        options = {};
      }
      return this.seeker_schedule = options.seeker_schedule;
    };

    Seeker.prototype.hasNecessaryVal = function() {
      return this.get('name') !== '' && this.get('name') !== void 0 && this.get('mail') !== '' && this.get('mail') !== void 0;
    };

    return Seeker;

  })(Backbone.Model);

}).call(this);
