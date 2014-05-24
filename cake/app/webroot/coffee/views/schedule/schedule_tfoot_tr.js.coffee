class padule.Views.ScheduleTfootTr extends Backbone.View
  tagName: 'tr'

  initialize: ->
    _.bindAll @
    @seeker_schedules = []
    if @collection.models.length > 0
      @seeker_schedules = @collection.first_schedule().seeker_schedules

  renderOne: (seeker_schedule)->
    view = new padule.Views.ScheduleTFootTd
      model: seeker_schedule.seeker
    @$el.append view.render().el

  render: ->
    @$el.append '<td></td>'
    @seeker_schedules?.each @renderOne
    @
