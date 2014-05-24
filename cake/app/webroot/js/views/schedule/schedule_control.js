(function() {
  var _ref,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleControl = (function(_super) {
    __extends(ScheduleControl, _super);

    function ScheduleControl() {
      this.toggleAddButton = __bind(this.toggleAddButton, this);
      _ref = ScheduleControl.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleControl.prototype.template = JST['templates/schedule_control'];

    ScheduleControl.prototype.events = {
      'click #addScheduleButton': 'addSchedule',
      'change #scheduleDatepicker': 'toggleAddButton',
      'change #scheduleTimepicker': 'toggleAddButton',
      'click #eventTextSaveBtn': function() {
        this.event.save({
          'text': padule.changeLine($('.event-text-form').val())
        });
        return this.$('.event-text').removeClass('editing');
      },
      'click #eventTextCancelBtn': function() {
        return this.$('.event-text').removeClass('editing');
      },
      'click #eventTextEditBtn': function(e) {
        if (e != null) {
          e.preventDefault();
        }
        return this.editText();
      },
      'click #toggleBtn': function() {
        if (this.$('.event-text').hasClass('hide')) {
          this.$('.event-text').removeClass('hide');
          return this.$('#toggleBtn i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        } else {
          this.$('.event-text').addClass('hide');
          return this.$('#toggleBtn i').addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-up');
        }
      },
      'keyup .event-text-form': 'toggleTextBtns'
    };

    ScheduleControl.prototype.toggleTextBtns = function() {
      if (this.$('.event-text-form').val()) {
        this.$('#eventTextSaveBtn').removeClass('disabled');
        return this.$('#eventTextCancelBtn').removeClass('disabled');
      } else {
        this.$('#eventTextSaveBtn').addClass('disabled');
        return this.$('#eventTextCancelBtn').addClass('disabled');
      }
    };

    ScheduleControl.prototype.initialize = function(options) {
      _.bindAll(this);
      this.event = this.collection.event;
      return this.info_area = options.info_area;
    };

    ScheduleControl.prototype.editText = function() {
      this.$('.event-text').addClass('editing');
      return this.focus();
    };

    ScheduleControl.prototype.render = function() {
      this.$el.html(this.template({
        event: this.event.toJSON(),
        url: "" + (location.href.match(/^http?:\/\/[^\/]+/)) + (this.event.get('url'))
      }));
      this.$('#eventText').html(padule.changeTxtList(this.event.get('text')));
      this.datepicker = this.$('#scheduleDatepicker');
      this.timepicker = this.$('#scheduleTimepicker');
      this._initDatepicker();
      this._initTimepicker();
      if (this.collection.length <= 0) {
        this.focus(this.datepicker);
      }
      if (!this.event.get('text').length) {
        this.$('.event-text').addClass('editing');
      }
      this.toggleTextBtns();
      return this;
    };

    ScheduleControl.prototype.toggleAddButton = function() {
      if (this._validateDatetime() && this.datepicker.val() && this.timepicker.val()) {
        return this.$('#addScheduleButton').removeClass('disabled');
      } else {
        return this.$('#addScheduleButton').addClass('disabled');
      }
    };

    ScheduleControl.prototype.addSchedule = function() {
      var new_schedule,
        _this = this;
      new_schedule = new padule.Models.Schedule({
        event_id: this.event.id,
        start_time: this._getStartTime()
      });
      this.collection.add(new_schedule);
      return new_schedule.saveByEvent({
        success: function() {
          return _this.info_area.show({
            text: '日程を追加しました。',
            class_name: 'label-info'
          });
        }
      });
    };

    ScheduleControl.prototype._validateDatetime = function() {
      var date;
      date = this.datepicker.val();
      if (!padule.checkDateFormat(date)) {
        this.info_area.show({
          text: '日づけのフォーマットが正しく入力してください。',
          class_name: 'label-danger'
        });
        return false;
      } else {
        return true;
      }
    };

    ScheduleControl.prototype._getStartTime = function() {
      var date, datetime, time;
      date = this.datepicker.val();
      time = this.timepicker.val();
      datetime = date + ' ' + time;
      datetime = datetime.replace(/\//g, '-') + ":00";
      return datetime;
    };

    ScheduleControl.prototype._initDatepicker = function() {
      return this.datepicker.datepicker({
        format: 'yyyy/mm/dd'
      });
    };

    ScheduleControl.prototype._initTimepicker = function() {
      return this.timepicker.timepicker({
        minuteStep: 10,
        showInputs: false,
        showSeconds: false,
        defaultTime: false,
        showMeridian: false,
        modalBackdrop: true
      });
    };

    ScheduleControl.prototype.focus = function(input) {
      var _this = this;
      return setTimeout(function() {
        return _this.$('.event-text-form').focus();
      }, 0);
    };

    return ScheduleControl;

  })(Backbone.View);

}).call(this);
