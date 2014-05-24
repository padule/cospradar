(function() {
  var _ref,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.FeedbackIndex = (function(_super) {
    __extends(FeedbackIndex, _super);

    function FeedbackIndex() {
      this.render = __bind(this.render, this);
      this.changeCount = __bind(this.changeCount, this);
      this.toggleAddBtn = __bind(this.toggleAddBtn, this);
      _ref = FeedbackIndex.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    FeedbackIndex.prototype.el = $('#feedbackIndex');

    FeedbackIndex.prototype.template = JST['templates/feedback'];

    FeedbackIndex.prototype.events = {
      'click #btnSendFeedback': 'addFeedback',
      'change #feedbackKb': function(e) {
        var category_kb;
        category_kb = $(e.target).prop('selectedIndex') + 1;
        return this.model.set('category_kb', category_kb);
      },
      'keyup #feedbackContent': function(e) {
        var content;
        content = padule.changeLine($(e.target).val());
        this.model.set('content', content);
        return this.toggleAddBtn();
      }
    };

    FeedbackIndex.prototype.initialize = function(options) {
      if (options == null) {
        options = {};
      }
      _.bindAll(this);
      this.user_id = $('#userName').attr('data-userid');
      this.is_admin = $('#userName').attr('data-isadmin');
      this.model = new padule.Models.Feedback;
      this.modal = new padule.Views.AlertModal;
      this.listenTo(this.collection, 'add', function(model) {
        return this.render(model);
      });
      this.listenTo(this.collection, 'add', this.changeCount);
      this.listenTo(this.collection, 'remove', this.changeCount);
      return this.collection.fetch({
        data: {
          json: true
        }
      });
    };

    FeedbackIndex.prototype.toggleAddBtn = function() {
      if (this.$('#feedbackContent').val()) {
        return this.$('#btnSendFeedback').removeClass('disabled');
      } else {
        return this.$('#btnSendFeedback').addClass('disabled');
      }
    };

    FeedbackIndex.prototype.changeCount = function() {
      return this.$('.feedback-number').html(this.collection.length);
    };

    FeedbackIndex.prototype.addFeedback = function() {
      var _this = this;
      return this.model.save({}, {
        success: function(model) {
          _this.model = model;
          _this.collection.add(_this.model);
          _this.clearForm();
          return _this.model = new padule.Models.Feedback;
        }
      });
    };

    FeedbackIndex.prototype.clearForm = function() {
      $('#feedbackKb').val('1');
      return $('#feedbackContent').val('');
    };

    FeedbackIndex.prototype.render = function(model) {
      var view;
      view = new padule.Views.FeedbackListElement({
        model: model,
        modal: this.modal,
        user_id: this.user_id,
        is_admin: this.is_admin
      });
      return this.$('#feedbackTable tbody').prepend(view.render().el);
    };

    return FeedbackIndex;

  })(Backbone.View);

}).call(this);
