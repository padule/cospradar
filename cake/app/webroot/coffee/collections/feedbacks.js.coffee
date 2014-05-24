class padule.Collections.Feedbacks extends Backbone.Collection
  model: padule.Models.Feedback
  url: '/feedbacks'

  comparator: (model)->
    -1 * model.id
