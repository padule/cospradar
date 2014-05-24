class padule.Views.FeedbackIndex extends Backbone.View
  el: $ '#feedbackIndex'
  template: JST['templates/feedback']

  events:
    'click #btnSendFeedback' : 'addFeedback'
    'change #feedbackKb' : (e)->
      category_kb = $(e.target).prop('selectedIndex') + 1
      @model.set 'category_kb', category_kb
    'keyup #feedbackContent' : (e)->
      content = padule.changeLine $(e.target).val()
      @model.set 'content', content
      @toggleAddBtn()

  initialize: (options = {})->
    _.bindAll @
    @user_id = $('#userName').attr 'data-userid'
    @is_admin = $('#userName').attr 'data-isadmin'
    @model = new padule.Models.Feedback
    @modal = new padule.Views.AlertModal

    @listenTo @collection, 'add', (model)->
      @render model
    @listenTo @collection, 'add', @changeCount
    @listenTo @collection, 'remove', @changeCount

    @collection.fetch
      data:
        json: true

  toggleAddBtn: =>
    if @$('#feedbackContent').val()
      @$('#btnSendFeedback').removeClass 'disabled'
    else
      @$('#btnSendFeedback').addClass 'disabled'

  changeCount: =>
    @$('.feedback-number').html @collection.length

  addFeedback: ->
    @model.save {},
      success: (model)=>
        @model = model
        @collection.add @model
        @clearForm()
        @model = new padule.Models.Feedback

  clearForm: ->
    $('#feedbackKb').val '1'
    $('#feedbackContent').val ''

  render: (model)=>
    view = new padule.Views.FeedbackListElement
      model: model
      modal: @modal
      user_id: @user_id
      is_admin: @is_admin

    @$('#feedbackTable tbody').prepend view.render().el
