class padule.Views.ScheduleTfoot extends Backbone.View
  tagName: 'tfoot'

  initialize: ->
    _.bindAll @
    @listenTo @collection, 'add', @render

  render: ->
    if @collection.length > 0
      view = new padule.Views.ScheduleTfootTr
        collection: @collection
      @$el.html view.render().el
    @
