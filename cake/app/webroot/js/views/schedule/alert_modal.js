(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.AlertModal = (function(_super) {
    __extends(AlertModal, _super);

    function AlertModal() {
      _ref = AlertModal.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    AlertModal.prototype.el = $('#alertModal');

    AlertModal.prototype.events = {
      'click #alertOK': function() {
        this.trigger("clickOk:" + this.model.cid);
        return this.$el.modal('hide');
      }
    };

    AlertModal.prototype.show = function(options) {
      if (options == null) {
        options = {};
      }
      this.model = options.model;
      this.$el.find('.modal-title').html(options.title);
      this.$el.find('.modal-body').html(options.contents);
      return this.$el.modal('show');
    };

    return AlertModal;

  })(Backbone.View);

}).call(this);
