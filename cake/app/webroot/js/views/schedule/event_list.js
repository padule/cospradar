(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.EventList = (function(_super) {
    __extends(EventList, _super);

    function EventList() {
      _ref = EventList.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    EventList.prototype.el = $("#eventList");

    EventList.prototype.initialize = function(options) {
      if (options == null) {
        options = {};
      }
      _.bindAll(this);
      this.listenTo(this.collection, 'add', this.render);
      this.modal = options.modal;
      return this.infoArea = options.infoArea;
    };

    EventList.prototype.render = function(model) {
      var view;
      view = new padule.Views.EventListElement({
        model: model,
        modal: this.modal,
        infoArea: this.infoArea
      });
      return this.$el.prepend(view.render().el);
    };

    return EventList;

  })(Backbone.View);

}).call(this);
