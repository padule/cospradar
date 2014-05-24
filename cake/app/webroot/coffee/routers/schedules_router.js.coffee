class padule.Routers.Schedules extends Backbone.Router
  routes:
    'users/mypage' : 'mypage'
    'seeker_schedules/index/:id' : 'seeker_schedules'
    'feedbacks' : 'feedbacks'

  mypage: ->
    new padule.Views.Event
      collection: new padule.Collections.Events

  seeker_schedules: ->
    event_id = $('.seeker-schedule-container').attr 'data-eventid'

    new padule.Views.SeekerScheduleInput
      collection: new padule.Collections.Schedules false, _event: new padule.Models.Event {id: event_id}
      seeker: new padule.Models.Seeker

  feedbacks: ->
    new padule.Views.FeedbackIndex
      collection: new padule.Collections.Feedbacks
