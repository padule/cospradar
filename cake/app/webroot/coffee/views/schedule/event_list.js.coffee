class padule.Views.EventList extends Backbone.View
  el: $ "#eventList"

  initialize: (options = {})->
    _.bindAll @
    @listenTo @collection, 'add', @render

    @modal = options.modal
    @infoArea = options.infoArea

  render: (model)->
    view = new padule.Views.EventListElement
      model: model
      modal: @modal
      infoArea: @infoArea

    @$el.prepend view.render().el
