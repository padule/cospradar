class padule.Views.ScheduleTheadTr extends Backbone.View
  tagName: 'tr'

  initialize: ->
    _.bindAll @
    @seeker_schedules = []
    if @collection.models.length > 0
      @seeker_schedules = @collection.first_schedule().seeker_schedules

  renderOne: (seeker_schedule)->
    view = new padule.Views.ScheduleTheadTh
      model: seeker_schedule
    @$el.append view.render().el

  render: ->
    @$el.append '<th></th>'
    @seeker_schedules?.each @renderOne
    @
