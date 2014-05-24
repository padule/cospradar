class padule.Models.User extends Backbone.Model
  urlRoot: '/users'

  parse: (resp)->
    if resp.responseText
      resp.responseText
    else
      resp

  logout: ->
    @sync 'create', @,
      url: "/users/logout"
      complete: ->
        console.log "hogehoge"
        location.href = "/users/login"
