(function() {
  var _ref,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Views.FeedbackListElement = (function(_super) {
    __extends(FeedbackListElement, _super);

    function FeedbackListElement() {
      this.render = __bind(this.render, this);
      this.editFeedback = __bind(this.editFeedback, this);
      _ref = FeedbackListElement.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    FeedbackListElement.prototype.tagName = 'tr';

    FeedbackListElement.prototype.template = JST['templates/feedback'];

    FeedbackListElement.prototype.events = {
      'click .js-delete-btn': 'deleteFeedback',
      'click .js-edit-btn': 'editFeedback',
      'change .js-response-kb': function(e) {
        var response_kb;
        response_kb = $(e.target).prop('selectedIndex') + 1;
        return this.model.set('response_kb', response_kb);
      },
      'keyup .js-comment': function(e) {
        var comment;
        comment = padule.changeLine($(e.target).val());
        return this.model.set('comment', comment);
      }
    };

    FeedbackListElement.prototype.initialize = function(options) {
      if (options == null) {
        options = {};
      }
      _.bindAll(this);
      this.modal = options.modal;
      this.user_id = options.user_id;
      this.is_admin = !!options.is_admin;
      this.listenTo(this.modal, "clickOk:" + this.model.cid, function() {
        this.model.destroy();
        return this.remove();
      });
      return this.listenTo(this.model, 'change', function() {
        if (this.model.hasChanged()) {
          return this.$('.js-edit-btn').removeClass('disabled');
        } else {
          return this.$('.js-edit-btn').addClass('disabled');
        }
      });
    };

    FeedbackListElement.prototype.deleteFeedback = function() {
      return this.modal.show({
        title: 'フィードバックを削除',
        contents: '削除してよろしいですか？',
        model: this.model
      });
    };

    FeedbackListElement.prototype.editFeedback = function() {
      var _this = this;
      return this.model.save({}, {
        success: function(model) {
          _this.model = model;
          return alert('保存しました');
        }
      });
    };

    FeedbackListElement.prototype.render = function() {
      this.$el.html(this.template({
        feedback: this.model,
        content: this.model.get('content'),
        user: this.model.get('User'),
        isOwn: this.model.get('User').id === this.user_id,
        isAdmin: this.is_admin,
        comment: this.model.get('comment'),
        created: padule.dateformatyyyyMMddWhhmm(this.model.get('created'))
      }));
      return this;
    };

    return FeedbackListElement;

  })(Backbone.View);

}).call(this);
