(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.Event = (function(_super) {
    __extends(Event, _super);

    function Event() {
      _ref = Event.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    Event.prototype.el = $('#eventSidebar');

    Event.prototype.events = {
      'click .add-event-btn': 'addEvent'
    };

    Event.prototype.initialize = function() {
      _.bindAll(this);
      this.listenTo(this.collection, 'sync', this.endLoading);
      this.setSidebarHeight();
      this.modal = new padule.Views.AlertModal;
      this.infoArea = new padule.Views.InfoArea;
      new padule.Views.EventList({
        collection: this.collection,
        modal: this.modal,
        infoArea: this.infoArea
      });
      new padule.Views.UserInfo({
        model: new padule.Models.User
      });
      this.startLoading();
      return this.collection.fetch();
    };

    Event.prototype.addEvent = function() {
      return this.collection.add(new padule.Models.Event);
    };

    Event.prototype.startLoading = function() {
      return this.$el.addClass('loading');
    };

    Event.prototype.endLoading = function() {
      return this.$el.removeClass('loading');
    };

    Event.prototype.setSidebarHeight = function() {
      var height;
      height = $(window).height() - $('.padule-nav').height() - $('#addEventButtonContainer').height() - 30;
      return this.$('.sidebar-container').height(height);
    };

    return Event;

  })(Backbone.View);

}).call(this);
