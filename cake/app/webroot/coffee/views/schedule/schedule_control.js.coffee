class padule.Views.ScheduleControl extends Backbone.View
  template: JST['templates/schedule_control']
  events:
    'click #addScheduleButton' : 'addSchedule'
    'change #scheduleDatepicker' : 'toggleAddButton'
    'change #scheduleTimepicker' : 'toggleAddButton'
    'click #eventTextSaveBtn' : ->
      @event.save {'text': padule.changeLine($('.event-text-form').val())}
      @$('.event-text').removeClass 'editing'
    'click #eventTextCancelBtn' : ->
      @$('.event-text').removeClass 'editing'
    'click #eventTextEditBtn' : (e)->
      e?.preventDefault()
      @editText()
    'click #toggleBtn' : ->
      if @$('.event-text').hasClass('hide')
        @$('.event-text').removeClass 'hide'
        @$('#toggleBtn i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up')
      else
        @$('.event-text').addClass 'hide'
        @$('#toggleBtn i').addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-up')

    'keyup .event-text-form' : 'toggleTextBtns'


  toggleTextBtns: ->
    if @$('.event-text-form').val()
      @$('#eventTextSaveBtn').removeClass('disabled')
      @$('#eventTextCancelBtn').removeClass('disabled')
    else
      @$('#eventTextSaveBtn').addClass('disabled')
      @$('#eventTextCancelBtn').addClass('disabled')

  initialize: (options)->
    _.bindAll @
    @event = @collection.event
    @info_area = options.info_area

  editText: ->
    @$('.event-text').addClass 'editing'
    @focus()

  render: ->
    @$el.html @template
      event: @event.toJSON()
      url: "#{location.href.match(/^http?:\/\/[^\/]+/)}#{@event.get('url')}"

    @$('#eventText').html padule.changeTxtList @event.get('text')
    @datepicker = @$('#scheduleDatepicker')
    @timepicker = @$('#scheduleTimepicker')
    @_initDatepicker()
    @_initTimepicker()

    if @collection.length <= 0
      @focus @datepicker

    if !@event.get('text').length
      @$('.event-text').addClass 'editing'

    @toggleTextBtns()

    @

  toggleAddButton: =>
    if @_validateDatetime() and @datepicker.val() and @timepicker.val()
      @$('#addScheduleButton').removeClass('disabled')
    else
      @$('#addScheduleButton').addClass('disabled')

  addSchedule: ->
    new_schedule = new padule.Models.Schedule
      event_id: @event.id
      start_time: @_getStartTime()
    @collection.add new_schedule
    new_schedule.saveByEvent
      success: =>
        @info_area.show
          text: '日程を追加しました。'
          class_name: 'label-info'

  _validateDatetime: ->
    date = @datepicker.val()
    unless padule.checkDateFormat date
      @info_area.show
        text: '日づけのフォーマットが正しく入力してください。'
        class_name: 'label-danger'
      return false
    else
      return true

  _getStartTime: ->
    date = @datepicker.val()
    time = @timepicker.val()
    datetime = date + ' ' + time
    datetime = datetime.replace(/\//g, '-') + ":00"
    datetime

  _initDatepicker: ->
    @datepicker.datepicker
      format: 'yyyy/mm/dd'

  _initTimepicker: ->
    @timepicker.timepicker
      minuteStep: 10
      showInputs: false
      showSeconds: false
      defaultTime: false
      showMeridian: false
      modalBackdrop: true

  focus: (input)->
    setTimeout =>
      @$('.event-text-form').focus()
    , 0