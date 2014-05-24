class padule.Views.InfoArea extends Backbone.View
  el: $ '.info-area'

  initialize: ->
    _.bindAll @

  show: (options={})->
    if options.ms
      ms = options.ms
    else
      ms = 4000

    @$('.label').removeClass().addClass('label').addClass(options.class_name).html options.text
    @$el.removeClass('show').addClass 'show'
    setTimeout =>
      @$el.removeClass 'show'
    , ms

  hide: ->
    @$el.removeClass 'show'
