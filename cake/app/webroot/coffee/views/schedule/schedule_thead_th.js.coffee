class padule.Views.ScheduleTheadTh extends Backbone.View
  tagName: 'th'
  template: JST['templates/schedule_seeker']

  initialize: ->
    _.bindAll @

  render: ->
    @$el.html @template
      name: @model.seeker.get 'name'
      mail: @model.seeker.get 'mail'
    @$('.seeker_info').popover()

    @
