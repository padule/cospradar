class padule.Views.SeekerScheduleInput extends Backbone.View
  el: $ '.seeker-schedule-container'

  events:
    'keyup input#inputName' : 'setName'
    'keyup input#inputEmail' : 'setMail'
    'keyup input#inputEmail2' : 'changeSendButtonEnable'
    'keyup textarea#inputComment' : 'setText'
    'click #sendSeekerSchedule' : 'sendSeekerSchedule'

  initialize: (options={})->
    _.bindAll @
    @event = @collection.event
    @modal = new padule.Views.AlertModal
    @seeker = options.seeker

    @listenTo @modal, "clickOk:#{@collection.cid}", ->
      @seeker.set 'event_id', @event.id
      @seeker.save()
    @listenTo @event, 'sync', @render_event_info
    @listenTo @seeker, 'change', @changeSendButtonEnable
    @listenTo @seeker, 'sync', (seeker)->
      @seeker = seeker
      @collection.each (schedule)=>
        seeker_schedule = schedule.seeker_schedules.last()
        seeker_schedule.set 'seeker_id', seeker.id
        seeker_schedule.set 'schedule_id', schedule.id
        seeker_schedule.save {},
          success: (seeker_schedule)=>
            @afterSending()

    @event_container = @$ '.event-container'
    @seeker_container = @$ '.seeker-container'
    @control_container = @$ '.control-container'

    new padule.Views.ScheduleList
      collection: @collection
      seeker: @seeker

    @collection.fetchByEvent()
    @event.fetch()

  render_event_info: ->
    @event_container.find('.event-title').html @event.get 'title'
    @event_container.find('.event-text').html padule.changeTxtList @event.get('text')

  sendSeekerSchedule: ->
    @modal.show
      model: @collection
      title: 'スケジュールを送信します'
      contents: 'よろしいですか？'

  afterSending: ->
    @$('.necessary').attr 'disabled', true
    @$('#inputComment').attr 'disabled', true
    @$('.seeker-schedule-btn').addClass 'disabled'

    @control_container.find('#sendSeekerSchedule').removeClass('btn-success').addClass('btn-danger').addClass('disabled').html('送信しました')

  changeSendButtonEnable: ->
    if @seeker.hasNecessaryVal() and @checkMail()
      @control_container.find('#sendSeekerSchedule').removeClass 'disabled'
    else
      @control_container.find('#sendSeekerSchedule').addClass 'disabled'

  setName: (e)->
    @seeker.set 'name', $(e.currentTarget).val()

  setMail: (e)->
    @seeker.set 'mail', $(e.currentTarget).val()
    @checkMail()

  checkMail: ->
    if @validateMail(@$('#inputEmail').val()) or @$('#inputEmail').val() is ''
      @$('.input-email > .important').html '(必須)'
      @$('.input-email').removeClass 'has-error'
      @seeker.set 'mail', @$('#inputEmail').val()
    else
      @$('.input-email > .important').html 'メールアドレスが正しくありません'
      @$('.input-email').addClass 'has-error'
      @$('.input-email2 > .important').html '(必須)'
      @$('.input-email2').removeClass 'has-error'
      return false

    if @$('#inputEmail').val() is @$('#inputEmail2').val()
      @$('.input-email2 > .important').html '(必須)'
      @$('.input-email2').removeClass 'has-error'
      @seeker.set 'mail', @$('#inputEmail').val()
      return true
    else
      @$('.input-email2 > .important').html 'メールアドレスが一致しません'
      @$('.input-email2').addClass 'has-error'
      return false

  validateMail: (str)->
    if str.match(/.+@.+\..+/) is null
      return false
    else
      return true

  setText: (e)->
    @seeker.set 'comment', $(e.currentTarget).val()
