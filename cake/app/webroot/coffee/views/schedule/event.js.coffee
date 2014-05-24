class padule.Views.Event extends Backbone.View
  el: $ '#eventSidebar'

  events:
    'click .add-event-btn' : 'addEvent'

  initialize: ->
    _.bindAll @
    @listenTo @collection, 'sync', @endLoading

    @setSidebarHeight()

    @modal = new padule.Views.AlertModal
    @infoArea = new padule.Views.InfoArea

    new padule.Views.EventList
      collection: @collection
      modal: @modal
      infoArea: @infoArea

    new padule.Views.UserInfo
      model: new padule.Models.User

    @startLoading()
    @collection.fetch()

  addEvent: ->
    @collection.add new padule.Models.Event

  startLoading: ->
    @$el.addClass 'loading'

  endLoading: ->
    @$el.removeClass 'loading'

  setSidebarHeight: ->
    height = $(window).height() - $('.padule-nav').height() - $('#addEventButtonContainer').height() - 30
    @$('.sidebar-container').height(height)
