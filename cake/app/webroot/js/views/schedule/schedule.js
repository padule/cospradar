(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.Schedule = (function(_super) {
    __extends(Schedule, _super);

    function Schedule() {
      _ref = Schedule.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    Schedule.prototype.el = $('#scheduleContents');

    Schedule.prototype.events = {
      'click #confirmButton': function() {
        return this.modal.show({
          title: 'スケジュールを確定',
          contents: "スケジュールを確定してよろしいですか？",
          model: this.collection
        });
      }
    };

    Schedule.prototype.initialize = function(options) {
      if (options == null) {
        options = {};
      }
      _.bindAll(this);
      padule.clearTimeoutAll();
      this.modal = options.modal;
      this.info_area = options.info_area;
      this.tableContainer = this.$('.schedule-table-container');
      this.controlContainer = this.$('.control-container');
      this.buttonContainer = this.$('.button-container');
      this.listenTo(this.collection, 'sync', this.render);
      this.listenTo(this.collection, 'changeType', this.enableConfirmButton);
      this.listenTo(this.collection.event, 'change', this.renderControlView);
      this.listenTo(this.modal, "clickOk:" + this.collection.cid, function() {
        this.collection.each(function(schedule) {
          return schedule.seeker_schedules.each(function(seeker_schedule) {
            return seeker_schedule.confirm();
          });
        });
        return this.info_area.show({
          text: 'スケジュールを確定しました',
          class_name: 'label-info'
        });
      });
      this.clear();
      this.renderControlView();
      this.startLoading();
      return this.collection.fetchByEvent();
    };

    Schedule.prototype.setTableHeight = function() {
      var height;
      height = $(window).height() - $('.control-container').height() - $('.button-container').height() - $('.padule-nav').height() - 65;
      return this.$('.schedule-table-container').height(height);
    };

    Schedule.prototype.clear = function() {
      this.tableContainer.empty();
      return this.controlContainer.empty();
    };

    Schedule.prototype.clearAllEvents = function() {
      this.undelegateEvents();
      this.off();
      return this.stopListening();
    };

    Schedule.prototype.renderControlView = function() {
      this.control = new padule.Views.ScheduleControl({
        collection: this.collection,
        info_area: this.info_area
      });
      this.controlContainer.html(this.control.render().el);
      return this.endLoading();
    };

    Schedule.prototype.render = function() {
      this.table = new padule.Views.ScheduleTable({
        collection: this.collection,
        modal: this.modal,
        info_area: this.info_area
      });
      this.tableContainer.html(this.table.render().el);
      this.updateInfoArea();
      this.setTableHeight();
      this.enableConfirmButton();
      this.buttonContainer.show();
      return this.endLoading();
    };

    Schedule.prototype.updateInfoArea = function() {
      var _ref1;
      if (this.collection.length <= 0) {
        return this.info_area.show({
          text: 'まだ日程が登録されていません。',
          class_name: 'label-warning',
          ms: 20000
        });
      } else if (((_ref1 = this.collection.first_schedule()) != null ? _ref1.seeker_schedules.length : void 0) <= 0) {
        return this.info_area.show({
          text: 'まだ求職者からの日程登録はありません。',
          class_name: 'label-warning',
          ms: 20000
        });
      } else {
        return this.info_area.hide();
      }
    };

    Schedule.prototype.startLoading = function() {
      return this.$el.addClass('loading');
    };

    Schedule.prototype.endLoading = function() {
      return this.$el.removeClass('loading');
    };

    Schedule.prototype.enableConfirmButton = function() {
      var has_temp,
        _this = this;
      has_temp = false;
      this.collection.each(function(schedule) {
        return schedule.seeker_schedules.each(function(seeker_schedule) {
          if (seeker_schedule.isTemp()) {
            has_temp = true;
          }
        });
      });
      if (has_temp) {
        return this.buttonContainer.find('#confirmButton').removeClass('disabled');
      } else {
        return this.buttonContainer.find('#confirmButton').addClass('disabled');
      }
    };

    return Schedule;

  })(Backbone.View);

}).call(this);
