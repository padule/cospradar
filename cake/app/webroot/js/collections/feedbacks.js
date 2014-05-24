(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Collections.Feedbacks = (function(_super) {
    __extends(Feedbacks, _super);

    function Feedbacks() {
      _ref = Feedbacks.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    Feedbacks.prototype.model = padule.Models.Feedback;

    Feedbacks.prototype.url = '/feedbacks';

    Feedbacks.prototype.comparator = function(model) {
      return -1 * model.id;
    };

    return Feedbacks;

  })(Backbone.Collection);

}).call(this);
