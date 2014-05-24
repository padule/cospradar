(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleThead = (function(_super) {
    __extends(ScheduleThead, _super);

    function ScheduleThead() {
      _ref = ScheduleThead.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleThead.prototype.tagName = 'thead';

    ScheduleThead.prototype.initialize = function() {
      _.bindAll(this);
      return this.listenTo(this.collection, 'add', this.render);
    };

    ScheduleThead.prototype.render = function() {
      var view;
      if (this.collection.length > 0) {
        view = new padule.Views.ScheduleTheadTr({
          collection: this.collection
        });
        this.$el.html(view.render().el);
      }
      return this;
    };

    return ScheduleThead;

  })(Backbone.View);

}).call(this);
