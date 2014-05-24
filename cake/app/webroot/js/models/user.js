(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Models.User = (function(_super) {
    __extends(User, _super);

    function User() {
      _ref = User.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    User.prototype.urlRoot = '/users';

    User.prototype.parse = function(resp) {
      if (resp.responseText) {
        return resp.responseText;
      } else {
        return resp;
      }
    };

    User.prototype.logout = function() {
      return this.sync('create', this, {
        url: "/users/logout",
        complete: function() {
          console.log("hogehoge");
          return location.href = "/users/login";
        }
      });
    };

    return User;

  })(Backbone.Model);

}).call(this);
