class padule.Views.ScheduleTFootTd extends Backbone.View
  tagName: 'td'

  initialize: ->
    _.bindAll @

  render: ->
    @$el.html @model.get 'comment'
    @