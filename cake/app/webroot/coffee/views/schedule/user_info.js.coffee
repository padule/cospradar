class padule.Views.UserInfo extends Backbone.View
  el: $ '#userInfo'

  events:
    'click #logout' : (e)->
      e?.preventDefault()
      @model.logout()


  initialize: ->
    _.bindAll @

    @listenTo @model, 'sync', (model)->
      $('#userName').html model.get 'name'

    @model.set 'id', @$el.attr 'data-userid'
    @model.fetch()
