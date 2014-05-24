class padule.Views.ScheduleTable extends Backbone.View
  tagName: 'table'
  className: 'table table-hover table-condensed schedule-table'
  pollingInterval: 10000

  initialize: (options = {})->
    _.bindAll @
    @thead = new padule.Views.ScheduleThead
      collection: @collection
    @tbody = new padule.Views.ScheduleTbody
      collection: @collection
      modal: options.modal
      info_area: options.info_area
    @tfoot = new padule.Views.ScheduleTfoot
      collection: @collection

    setTimeout @collection.poll, @pollingInterval

  render: ->
    @$el.append @thead.render().el
    @$el.append @tbody.render().el
    @$el.append @tfoot.render().el
    @