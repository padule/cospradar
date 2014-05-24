class padule.Models.Event extends Backbone.Model
  urlRoot: "/events"
  parse: (resp)->
    if resp.responseText
      resp.responseText
    else
      resp

  className: 'padule.Models.Event'

  defaults:
    title: ""
    url: ""
    text: ""
    enabled: true

  validate: (attrs)->
    if _.isEmpty attrs.title
      return "イベント名を入力してください。"
