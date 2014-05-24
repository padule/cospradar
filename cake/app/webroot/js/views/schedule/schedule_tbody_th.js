(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.ScheduleTbodyTh = (function(_super) {
    __extends(ScheduleTbodyTh, _super);

    function ScheduleTbodyTh() {
      _ref = ScheduleTbodyTh.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    ScheduleTbodyTh.prototype.tagName = 'th';

    ScheduleTbodyTh.prototype.template = JST['templates/schedule_th'];

    ScheduleTbodyTh.prototype.events = {
      'click .schedule-delete-button': 'deleteSchedule'
    };

    ScheduleTbodyTh.prototype.initialize = function(options) {
      if (options == null) {
        options = {};
      }
      _.bindAll(this);
      this.modal = options.modal;
      this.info_area = options.info_area;
      this.start_time = padule.dateformatyyyyMMddWhhmm(this.model.get('start_time'));
      return this.listenTo(this.modal, "clickOk:" + this.model.cid, function() {
        return this.model.destroy();
      });
    };

    ScheduleTbodyTh.prototype.render = function() {
      this.$el.html(this.template({
        start_time: this.start_time
      }));
      return this;
    };

    ScheduleTbodyTh.prototype.deleteSchedule = function(e) {
      e.preventDefault();
      return this.modal.show({
        model: this.model,
        title: 'スケジュールを削除',
        contents: "『" + this.start_time + "』の日程を削除してよろしいですか？"
      });
    };

    return ScheduleTbodyTh;

  })(Backbone.View);

}).call(this);
