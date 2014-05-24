class padule.Views.ScheduleListElement extends Backbone.View
  tagName: 'li'
  className: 'list-group-item'
  template: JST['templates/seeker_schedule_status']
  events:
    'click .seeker-schedule-btn' : 'changeType'

  initialize: (options)->
    _.bindAll @
    @seeker_schedule = new padule.Models.SeekerSchedule {'type': 0}, {schedule: @model}
    @seeker_schedule.seeker = options.seeker
    @model.seeker_schedules.push @seeker_schedule

    @listenTo @seeker_schedule, 'change:type', @render

  changeType: (e)->
    e.preventDefault()
    @seeker_schedule.changeTypeBySeeker()

  render: ->
    @$el.html @template
      start_time: padule.dateformatyyyyMMddWhhmm @model.get('start_time')
      btn_class: @btnAttrs().btn_class_name
      icon_class: @btnAttrs().icon_class_name
    @

  btnAttrs: ->
    if @seeker_schedule.isOK()
      btn_class_name: 'btn-success'
      icon_class_name: 'glyphicon-ok'
      text: '◯'
    else
      btn_class_name: 'btn-default'
      icon_class_name: 'glyphicon-remove'
      text: '×'
