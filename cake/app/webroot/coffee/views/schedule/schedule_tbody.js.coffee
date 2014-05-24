class padule.Views.ScheduleTbody extends Backbone.View
  tagName: 'tbody'

  initialize: (options = {})->
    _.bindAll @
    @modal = options.modal
    @info_area = options.info_area
    @listenTo @collection, 'add', @renderOne

  renderOne: (schedule)->
    view = new padule.Views.ScheduleTbodyTr
      model: schedule
      modal: @modal
      info_area: @info_area
    @$el.append view.render().el

  render: ->
    @collection.each @renderOne
    @changeEditable()
    @

  changeEditable: ->
    if @collection.length > 0 and @collection.first_schedule().seeker_schedules.length > 0
      # 同じ求職者で未確定、確定済のものがある場合は編集不可
      @collection.first_schedule().seeker_schedules.changeEditableBySeeker()
