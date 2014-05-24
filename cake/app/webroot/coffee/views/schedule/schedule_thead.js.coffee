class padule.Views.ScheduleThead extends Backbone.View
  tagName: 'thead'

  initialize: ->
    _.bindAll @
    @listenTo @collection, 'add', @render

  render: ->
    if @collection.length > 0
      view = new padule.Views.ScheduleTheadTr
        collection: @collection
      @$el.html view.render().el
    @
