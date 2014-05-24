class padule.Views.Schedule extends Backbone.View
  el: $ '#scheduleContents'

  events:
    'click #confirmButton' : ->
      @modal.show
        title: 'スケジュールを確定'
        contents: "スケジュールを確定してよろしいですか？"
        model: @collection

  initialize: (options = {})->
    _.bindAll @

    padule.clearTimeoutAll()

    @modal = options.modal
    @info_area = options.info_area

    @tableContainer = @$ '.schedule-table-container'
    @controlContainer = @$ '.control-container'
    @buttonContainer = @$ '.button-container'

    @listenTo @collection, 'sync', @render
    @listenTo @collection, 'changeType', @enableConfirmButton
    @listenTo @collection.event, 'change', @renderControlView
    @listenTo @modal, "clickOk:#{@collection.cid}", ->
      @collection.each (schedule)->
        schedule.seeker_schedules.each (seeker_schedule)->
          seeker_schedule.confirm()
      @info_area.show
        text: 'スケジュールを確定しました'
        class_name: 'label-info'

    @clear()
    @renderControlView()
    @startLoading()
    @collection.fetchByEvent()

  setTableHeight: ->
    height = $(window).height() - $('.control-container').height() - $('.button-container').height() - $('.padule-nav').height() - 65
    @$('.schedule-table-container').height(height)

  clear: ->
    @tableContainer.empty()
    @controlContainer.empty()

  clearAllEvents: ->
    @undelegateEvents()
    @off()
    @stopListening()

  renderControlView: ->
    @control = new padule.Views.ScheduleControl
      collection: @collection
      info_area: @info_area
    @controlContainer.html @control.render().el
    @endLoading()

  render: ->
    @table = new padule.Views.ScheduleTable
      collection: @collection
      modal: @modal
      info_area: @info_area
    @tableContainer.html @table.render().el

    @updateInfoArea()

    @setTableHeight()

    @enableConfirmButton()
    @buttonContainer.show()

    @endLoading()

  updateInfoArea: ->
    if @collection.length <= 0
      @info_area.show
        text: 'まだ日程が登録されていません。'
        class_name: 'label-warning'
        ms: 20000
    else if @collection.first_schedule()?.seeker_schedules.length <= 0
      @info_area.show
        text: 'まだ求職者からの日程登録はありません。'
        class_name: 'label-warning'
        ms: 20000
    else
      @info_area.hide()

  startLoading: ->
    @$el.addClass 'loading'

  endLoading: ->
    @$el.removeClass 'loading'

  enableConfirmButton: ->
    has_temp = false
    @collection.each (schedule)=>
      schedule.seeker_schedules.each (seeker_schedule)=>
        if seeker_schedule.isTemp()
          has_temp = true
          return

    if has_temp
      @buttonContainer.find('#confirmButton').removeClass 'disabled'
    else
      @buttonContainer.find('#confirmButton').addClass 'disabled'