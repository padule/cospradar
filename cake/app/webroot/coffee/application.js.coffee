#= require libs/jquery-2.0.3.min
#= require libs/bootstrap.min
#= require libs/bootstrap-datepicker
#= require libs/bootstrap-timepicker.min
#= require libs/json2
#= require libs/dateformat
#= require libs/underscore
#= require libs/backbone
#= require libs/backbone.localStorage
#= require padule
#= require libs/jquery.mockjax
#= require mocks/mock_utils
#= require_tree ./mocks
#= require_tree ./templates
#= require_tree ./models
#= require_tree ./collections
#= require_tree ./views
#= require_tree ./routers

window.padule.initialize = ->
  new padule.Routers.Schedules
  if Backbone.history && !Backbone.History.started
    Backbone.history.start {pushState: true, hashChange: false}

window.padule.dateformatyyyyMMddWhhmm = (string_date) ->
  if string_date is null
    return ""
  date_format = new DateFormat "yyyy-MM-dd HH:mm:ss"
  date = date_format.parse string_date
  y = date.getFullYear()
  m = date.getMonth()+1
  d = date.getDate()
  h = date.getHours()
  M = date.getMinutes()
  w = date.getDay()
  wNames = ['日', '月', '火', '水', '木', '金', '土']

  if m < 10
    m = '0' + m
  if d < 10
    d = '0' + d
  if h < 10
    h = '0' + h
  if M < 10
    M = '0' + M

  return y + "/" + m + "/" + d + "(" + wNames[w] + ") " + h + ":" + M;

window.padule.stringToDateYYYYMMDDHHMM = (stringdate, format) ->
  format ||= "yyyy/MM/dd HH:mm"
  dateFormat = new DateFormat(format);
  date = dateFormat.parse(stringdate);
  date

window.padule.checkDateFormat = (stringdate) ->
  # 正規表現による書式チェック
  unless stringdate.match(/^\d{4}\/\d{2}\/\d{2}$/)
    return false
  # 月,日の妥当性チェック
  year = stringdate.substr(0, 4) - 0
  month = stringdate.substr(5, 2) - 1
  day = stringdate.substr(8, 2) - 0
  if month >= 0 and month <= 11 and day >= 1 and day <= 31
    date = new Date(year, month, day);
    if isNaN(date)
      return false
    else if date.getFullYear() is year and date.getMonth() is month and date.getDate() is day
      return true
    else
      return false
  else
    return false

window.padule.changeLine = (txt)->
  txt.replace(/\r\n/g, '\n').replace(/\r/g, '\n')

window.padule.changeTxtList = (txt)->
  if txt is '' || txt is null || txt is undefined
    return '<p></p>'
  lines = txt.split('\n')
  target = ''
  for line in lines
    if line is ''
      line = '&nbsp;'
    target = "#{target}<p>#{line}</p>"
  target

window.padule.clearTimeoutAll = ->
  highestTimeoutId = setTimeout ';'
  for i in [0..highestTimeoutId]
    clearTimeout i

Backbone.ajaxSync = Backbone.sync
Backbone.sync = (method, model, options, error)->
  (Backbone.getSyncMethod model).apply this, [method, model, options, error]

Backbone.getSyncMethod = (model)->
  unless padule.use_localstorage
    return Backbone.ajaxSync;

  if model.localStorage || (model.collection && model.collection.localStorage)
    return Backbone.localSync;

  return Backbone.ajaxSync;