class padule.Views.AlertModal extends Backbone.View
  el: $ '#alertModal'

  events:
    'click #alertOK': ->
      @trigger "clickOk:#{@model.cid}"
      @$el.modal 'hide'

  show: (options = {})->
    @model = options.model

    @$el.find('.modal-title').html options.title
    @$el.find('.modal-body').html options.contents
    @$el.modal 'show'