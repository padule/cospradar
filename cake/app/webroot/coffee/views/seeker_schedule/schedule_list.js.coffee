class padule.Views.ScheduleList extends Backbone.View
  el: $ '#seeker-schedule-edit ul'

  initialize: (options)->
    _.bindAll @
    @listenTo @collection, 'sync', @render
    @seeker = options.seeker

  renderOne: (schedule)->
    view = new padule.Views.ScheduleListElement
      model: schedule
      seeker: @seeker
    @$el.append view.render().el

  render: ->
    @collection.each @renderOne
    @
