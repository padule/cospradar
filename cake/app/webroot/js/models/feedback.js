(function() {
  var _ref,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  padule.Models.Feedback = (function(_super) {
    __extends(Feedback, _super);

    function Feedback() {
      _ref = Feedback.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    Feedback.prototype.urlRoot = '/feedbacks';

    Feedback.prototype.categories = {
      idea: '1',
      nice: '2',
      question: '3',
      bug: '4'
    };

    Feedback.prototype.responses = {
      not_confirmed: '1',
      confirmed: '2',
      not_supported: '3'
    };

    Feedback.prototype.defaults = {
      category_kb: '1',
      response_kb: '1'
    };

    Feedback.prototype.validate = function(attrs) {
      if (_.isEmpty(attrs.content)) {
        return '内容を入力してください。';
      }
    };

    Feedback.prototype.categoryText = function() {
      if (this.get('category_kb') === this.categories.idea) {
        return 'アイデア';
      } else if (this.get('category_kb') === this.categories.nice) {
        return 'いいね！';
      } else if (this.get('category_kb') === this.categories.question) {
        return '質問';
      } else {
        return 'バグ';
      }
    };

    Feedback.prototype.responseText = function() {
      if (this.get('response_kb') === this.responses.not_confirmed) {
        return '未対応';
      } else if (this.get('response_kb') === this.responses.confirmed) {
        return '対応します';
      } else {
        return '対応しません';
      }
    };

    return Feedback;

  })(Backbone.Model);

}).call(this);
