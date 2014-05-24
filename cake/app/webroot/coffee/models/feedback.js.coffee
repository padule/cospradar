class padule.Models.Feedback extends Backbone.Model
  urlRoot: '/feedbacks'

  categories:
    idea: '1'
    nice: '2'
    question: '3'
    bug: '4'

  responses:
    not_confirmed: '1'
    confirmed: '2'
    not_supported: '3'

  defaults:
    category_kb: '1'
    response_kb: '1'

  validate: (attrs)->
    if _.isEmpty attrs.content
      '内容を入力してください。'

  categoryText: ->
    if @get('category_kb') is @categories.idea
      'アイデア'
    else if @get('category_kb') is @categories.nice
      'いいね！'
    else if @get('category_kb') is @categories.question
      '質問'
    else
      'バグ'

  responseText: ->
    if @get('response_kb') is @responses.not_confirmed
      '未対応'
    else if @get('response_kb') is @responses.confirmed
      '対応します'
    else
      '対応しません'
