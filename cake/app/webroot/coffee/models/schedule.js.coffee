class padule.Models.Schedule extends Backbone.Model
  urlRoot: "/schedules"
  localStorage: new Store "schedule"
  parse: (resp)->
    if resp.responseText
      resp.responseText
    else
      resp

  initialize: ->
    if @has 'seeker_schedules'
      @seeker_schedules = new padule.Collections.SeekerSchedules @get('seeker_schedules'),
        schedule: @
    else if @collection?.first()?.has 'seeker_schedules'
      @seeker_schedules = @collection.first().seeker_schedules.clone().resetType()
    else
      @seeker_schedules = new padule.Collections.SeekerSchedules false, schedule: @

  saveByEvent: (options = {})->
    @seeker_schedules.each (seeker_schedule)->
      seeker_schedule.save()

    options =
      url: @url() + "?event_id=" + @get 'event_id'
      success: options.success()
    @save null, options
