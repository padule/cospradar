class padule.Views.ScheduleTbodyTh extends Backbone.View
  tagName: 'th'
  template: JST['templates/schedule_th']

  events:
    'click .schedule-delete-button' : 'deleteSchedule'

  initialize: (options = {})->
    _.bindAll @
    @modal = options.modal
    @info_area = options.info_area
    @start_time = padule.dateformatyyyyMMddWhhmm @model.get('start_time')

    @listenTo @modal, "clickOk:#{@model.cid}", ->
      @model.destroy()

  render: ->
    @$el.html @template
      start_time: @start_time
    @

  deleteSchedule: (e)->
    e.preventDefault()
    @modal.show
      model: @model
      title: 'スケジュールを削除'
      contents: "『#{@start_time}』の日程を削除してよろしいですか？"

