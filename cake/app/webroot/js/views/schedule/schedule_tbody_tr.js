(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleTbodyTr = (function(_super) {
    __extends(ScheduleTbodyTr, _super);

    function ScheduleTbodyTr() {
      _ref = ScheduleTbodyTr.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleTbodyTr.prototype.tagName = 'tr';

    ScheduleTbodyTr.prototype.className = function() {
      if (this.model.isNew()) {
        return 'new-schedule';
      }
    };

    ScheduleTbodyTr.prototype.initialize = function(options) {
      if (options == null) {
        options = {};
      }
      _.bindAll(this);
      this.modal = options.modal;
      this.info_area = options.info_area;
      this.seeker_schedules = this.model.seeker_schedules;
      this.seeker_schedules.fillEmptySeekerSchedule();
      return this.listenTo(this.model, 'destroy', function() {
        this.remove();
        return this.info_area.show({
          text: 'スケジュールを削除しました',
          class_name: 'label-info'
        });
      });
    };

    ScheduleTbodyTr.prototype.renderOne = function(seeker_schedule) {
      var view;
      view = new padule.Views.ScheduleTd({
        model: seeker_schedule,
        modal: this.modal
      });
      return this.$el.append(view.render().el);
    };

    ScheduleTbodyTr.prototype.render = function() {
      this.renderTh();
      this.seeker_schedules.each(this.renderOne);
      this.changeEditable();
      return this;
    };

    ScheduleTbodyTr.prototype.renderTh = function() {
      var view;
      view = new padule.Views.ScheduleTbodyTh({
        model: this.model,
        modal: this.modal,
        info_area: this.info_area
      });
      return this.$el.append(view.render().el);
    };

    ScheduleTbodyTr.prototype.changeEditable = function() {
      if (this.seeker_schedules.hasConfirmed()) {
        this.$el.addClass('disabled');
        return this.seeker_schedules.changeEditable(false);
      } else {
        this.$el.removeClass('disabled');
        return this.seeker_schedules.changeEditable(true);
      }
    };

    return ScheduleTbodyTr;

  })(Backbone.View);

}).call(this);
