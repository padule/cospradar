class padule.Views.ScheduleTd extends Backbone.View
  tagName: 'td'
  template: JST['templates/schedule_status']
  events:
    'click .schedule-btn' : (e)->
      if @model.isConfirmed()
        e.preventDefault()
        @modal.show
          title: 'スケジュールを取り消し'
          contents: "確定したスケジュールを取り消しますか？"
          model: @model
      else
        @changeType(e)

  initialize: (options = {})->
    _.bindAll @
    @modal = options.modal
    @listenTo @model, 'change:type', @render
    @listenTo @model, 'afterChangeEditable', @changeDisabled
    @listenTo @modal, "clickOk:#{@model.cid}", (e)->
      @changeType(e)

  render: (editable)->
    @$el.html @template
      btn_class_name: @btnAttrs().btn_class_name
      icon_class_name: @btnAttrs().icon_class_name
      text: @btnAttrs().text
    @model.changeEditable()
    @

  changeDisabled: ->
    if @model.editable
      @$('.schedule-btn').removeClass 'disabled'
    else
      @$('.schedule-btn').removeClass('disabled').addClass('disabled')

  changeType: (e)->
    e?.preventDefault()
    @model.changeType()

  btnAttrs: ->
    if @model.isConfirmed()
      btn_class_name: 'btn-danger'
      icon_class_name: 'glyphicon-ok'
      text: '確定'
    else if @model.isOK()
      btn_class_name: 'btn-info'
      icon_class_name: 'glyphicon-thumbs-up'
      text: '◯'
    else if @model.isNG()
      btn_class_name: 'btn-link'
      icon_class_name: 'glyphicon-remove'
      text: '×'
    else if @model.isTemp()
      btn_class_name: 'btn-success'
      icon_class_name: 'glyphicon-ok'
      text: '候補'
    else
      btn_class_name: 'btn-link'
      icon_class_name: 'glyphicon-minus'
      text: 'ー'
