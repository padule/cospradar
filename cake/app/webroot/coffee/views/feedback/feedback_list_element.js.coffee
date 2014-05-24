class padule.Views.FeedbackListElement extends Backbone.View
  tagName: 'tr'

  template: JST['templates/feedback']

  events:
    'click .js-delete-btn' : 'deleteFeedback'
    'click .js-edit-btn' : 'editFeedback'
    'change .js-response-kb' : (e)->
      response_kb = $(e.target).prop('selectedIndex') + 1
      @model.set 'response_kb', response_kb
    'keyup .js-comment' : (e)->
      comment = padule.changeLine $(e.target).val()
      @model.set 'comment', comment

  initialize: (options = {})->
    _.bindAll @

    @modal = options.modal
    @user_id = options.user_id
    @is_admin = !!options.is_admin

    @listenTo @modal, "clickOk:#{@model.cid}", ->
      @model.destroy()
      @remove()

    @listenTo @model, 'change', ->
      if @model.hasChanged()
        @$('.js-edit-btn').removeClass 'disabled'
      else
        @$('.js-edit-btn').addClass 'disabled'

  deleteFeedback: ->
    @modal.show
      title: 'フィードバックを削除'
      contents: '削除してよろしいですか？'
      model: @model

  editFeedback: =>
    @model.save {},
      success: (model)=>
        @model = model
        alert '保存しました'

  render: =>
    @$el.html @template
      feedback: @model
      content: @model.get 'content'
      user: @model.get 'User'
      isOwn: @model.get('User').id is @user_id
      isAdmin: @is_admin
      comment: @model.get 'comment'
      created: padule.dateformatyyyyMMddWhhmm @model.get('created')

    @