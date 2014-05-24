class padule.Views.EventListElement extends Backbone.View
  tagName: 'li'
  className: 'event'
  template: JST['templates/event']

  events:
    'click .js-delete-event-btn' : 'deleteEvent'
    'click a' : (e)->
      e.preventDefault()
      @showSchedule()
      window.localStorage.setItem 'scrollTop', $('.sidebar-container').scrollTop()
    'dblclick a' : 'editEvent'
    'keypress .edit': (e)->
      if e.keyCode is 13 then @close()
    'blur .edit': ->
      @$el.removeClass 'editing'
      if @model.isNew() and !@model.get('title') then @remove()

  initialize: (options = {})->
    _.bindAll @

    @modal = options.modal
    @infoArea = options.infoArea

    @listenTo @model, 'change:title', @render

    @listenTo @model, 'unactive', ->
      @$el.removeClass 'active'
      @scheduleView?.clearAllEvents()

    @listenTo @model, 'destroy', ->
      @remove()
      @infoArea.show
        text: 'イベントを削除しました'
        class_name: 'label-info'

    @listenTo @modal, "clickOk:#{@model.cid}", ->
      @model.destroy()

    @listenTo @model, 'sync', (model)->
      @model = model
      @infoArea.show
        text: 'スケジュールを保存しました。'
        class_name: 'label-info'

  editEvent: ->
    @$el.addClass 'editing'
    @focus()

  close: ->
    value = @input.val()
    if value
      @model.set 'title', value
      @model.save()
      @$el.removeClass 'editing'
      @showSchedule()

  render: =>
    @$el.html @template
      event: @model.toJSON()
    @input = @$('.edit')
    if @model.isNew()
      @$el.addClass 'editing'
      @focus()

    active_event_id = window.localStorage.getItem @model.className
    if active_event_id? && active_event_id is @model.id
      @showSchedule()

    $('.sidebar-container').scrollTop window.localStorage.getItem('scrollTop')

    @

  deleteEvent: (e)->
    e.preventDefault()
    @modal.show
      title: 'イベントを削除'
      contents: "『#{@model.get 'title'}』を削除してよろしいですか？"
      model: @model

  showSchedule: (e)->
    e?.preventDefault()
    @model.collection.each (event)->
      event.trigger 'unactive'
    @$el.addClass 'active'

    window.localStorage.setItem @model.className, @model.id

    @scheduleView = new padule.Views.Schedule
      collection: new padule.Collections.Schedules false, _event: @model
      modal: @modal
      info_area: @infoArea

  focus: ->
    setTimeout =>
      @input.focus()
    , 0