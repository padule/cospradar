class padule.Models.SeekerSchedule extends Backbone.Model
  urlRoot: "/seeker_schedules"
  localStorage: new Store "seeker_schedule"
  parse: (resp)->
    if resp.responseText
      resp.responseText
    else
      resp

  defaults:
    type: -1

  types:
    default: '-1'
    ng: '0'
    ok: '1'
    confirmed: '2'
    temp: '3'

  initialize: (models, options={})->
    @seeker = new padule.Models.Seeker @get 'seeker', {seeker_schedule: @}
    @schedule = @collection?.schedule

    @set 'seeker_id', @seeker.id
    @set 'schedule_id', @schedule?.id
    @changeEditable()
    @listenTo @, 'change:type', @changeEditable

  isConfirmed: ->
    @types.confirmed is @get 'type'

  isOK: ->
    @types.ok is @get 'type'

  isNG: ->
    @types.ng is @get 'type'

  isDefault: ->
    @types.default is @get 'type'

  isTemp: ->
    @types.temp is @get 'type'

  changeType: ->
    if @isOK()
      @set 'type', @types.temp
    else if @isTemp() or @isConfirmed()
      @set 'type', @types.ok
    @save {},
      success: =>
        editable = !@isTemp() and !@isConfirmed()
        @collection.changeEditable editable
        @collection.changeEditableBySeeker()
        @collection.schedule.collection.trigger 'changeType'

  confirm: ->
    if @isTemp()
      @set 'type', @types.confirmed
      @save {},
        success: =>
          editable = !@isTemp() and !@isConfirmed()
          @collection.changeEditable editable
          @collection.changeEditableBySeeker()
          @collection.schedule.collection.trigger 'changeType'

  changeEditable: (editable)->
    if @isConfirmed() or @isTemp()
      @editable = true
    else if editable is undefined
      @editable = @isOK()
    else
      @editable = editable and !@isNG()
    @trigger 'afterChangeEditable'

  changeTypeBySeeker: ->
    if @isOK()
      @set 'type', @types.ng
    else
      @set 'type', @types.ok
