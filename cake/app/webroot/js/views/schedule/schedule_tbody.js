(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleTbody = (function(_super) {
    __extends(ScheduleTbody, _super);

    function ScheduleTbody() {
      _ref = ScheduleTbody.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleTbody.prototype.tagName = 'tbody';

    ScheduleTbody.prototype.initialize = function(options) {
      if (options == null) {
        options = {};
      }
      _.bindAll(this);
      this.modal = options.modal;
      this.info_area = options.info_area;
      return this.listenTo(this.collection, 'add', this.renderOne);
    };

    ScheduleTbody.prototype.renderOne = function(schedule) {
      var view;
      view = new padule.Views.ScheduleTbodyTr({
        model: schedule,
        modal: this.modal,
        info_area: this.info_area
      });
      return this.$el.append(view.render().el);
    };

    ScheduleTbody.prototype.render = function() {
      this.collection.each(this.renderOne);
      this.changeEditable();
      return this;
    };

    ScheduleTbody.prototype.changeEditable = function() {
      if (this.collection.length > 0 && this.collection.first_schedule().seeker_schedules.length > 0) {
        return this.collection.first_schedule().seeker_schedules.changeEditableBySeeker();
      }
    };

    return ScheduleTbody;

  })(Backbone.View);

}).call(this);
