class padule.Collections.SeekerSchedules extends Backbone.Collection
  model: padule.Models.SeekerSchedule
  url: "/seeker_schedules"
  localStorage: new Store "seeker_schedule"
  comparator: (seeker_schedule)->
    seeker_schedule.seeker.id
  initialize: (models, options)->
    @schedule = options.schedule

  resetType: ->
    @invoke 'set', {'type', '-1'}, {'silent', 'true'}

  fillEmptySeekerSchedule: ->
    first_seeker_schedules = @schedule.collection.first_schedule().seeker_schedules
    # 日程が増えていなければ何もしない
    if !first_seeker_schedules? or first_seeker_schedules.length is @length
      return

    seeker_ids = _.pluck(@pluck('seeker'), 'id')
    first_seekers = first_seeker_schedules.map (seeker_schedule)->
      seeker_schedule.seeker

    # 求職者が送信後に日程追加した時、ないデータを作っておく
    _.each first_seekers, (seeker)=>
      unless _.contains(seeker_ids, seeker.id)
        seeker_schedule = new padule.Models.SeekerSchedule {'seeker': seeker.toJSON()}
        @add seeker_schedule

  findBySeeker: (seeker_schedule)->
    result = []
    @schedule.collection.each (schedule)->
      filters = schedule.seeker_schedules.filter (each)->
          each.seeker.get('name') is seeker_schedule.seeker.get('name')
      result = result.concat filters
    result

  hasConfirmed: ->
    confirms = @filter (seeker_schedule)->
      seeker_schedule.isConfirmed() or seeker_schedule.isTemp()
    confirms?.length > 0

  changeEditable: (editable)->
    @each (seeker_schedule)->
      seeker_schedule.changeEditable editable

  changeEditableBySeeker: ->
    # 同じ人のスケジュールに未確定・確定済があればEditableを変更
    @each (each)=>
      has_confirmed = false
      seeker_schedules = @findBySeeker each
      _.each seeker_schedules, (seeker_schedule)=>
        if seeker_schedule.isConfirmed() or seeker_schedule.isTemp()
          has_confirmed = true

      # 初期表示時のみ
      _.each seeker_schedules, (seeker_schedule)=>
          seeker_schedule.changeEditable !has_confirmed and !seeker_schedule.collection.hasConfirmed()

