(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleTfoot = (function(_super) {
    __extends(ScheduleTfoot, _super);

    function ScheduleTfoot() {
      _ref = ScheduleTfoot.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleTfoot.prototype.tagName = 'tfoot';

    ScheduleTfoot.prototype.initialize = function() {
      _.bindAll(this);
      return this.listenTo(this.collection, 'add', this.render);
    };

    ScheduleTfoot.prototype.render = function() {
      var view;
      if (this.collection.length > 0) {
        view = new padule.Views.ScheduleTfootTr({
          collection: this.collection
        });
        this.$el.html(view.render().el);
      }
      return this;
    };

    return ScheduleTfoot;

  })(Backbone.View);

}).call(this);
