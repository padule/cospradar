class padule.Collections.Events extends Backbone.Collection
  model: padule.Models.Event
  url: "/events"
  localStorage: new Store "event"
  comparator: (model)->
    -1 * model.id
  parse: (resp)->
    if _.isArray(resp)
      resp
    else
      resp.responseText