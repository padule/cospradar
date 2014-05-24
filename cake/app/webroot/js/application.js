(function() {
  window.padule.initialize = function() {
    new padule.Routers.Schedules;
    if (Backbone.history && !Backbone.History.started) {
      return Backbone.history.start({
        pushState: true,
        hashChange: false
      });
    }
  };

  window.padule.dateformatyyyyMMddWhhmm = function(string_date) {
    var M, d, date, date_format, h, m, w, wNames, y;
    if (string_date === null) {
      return "";
    }
    date_format = new DateFormat("yyyy-MM-dd HH:mm:ss");
    date = date_format.parse(string_date);
    y = date.getFullYear();
    m = date.getMonth() + 1;
    d = date.getDate();
    h = date.getHours();
    M = date.getMinutes();
    w = date.getDay();
    wNames = ['日', '月', '火', '水', '木', '金', '土'];
    if (m < 10) {
      m = '0' + m;
    }
    if (d < 10) {
      d = '0' + d;
    }
    if (h < 10) {
      h = '0' + h;
    }
    if (M < 10) {
      M = '0' + M;
    }
    return y + "/" + m + "/" + d + "(" + wNames[w] + ") " + h + ":" + M;
  };

  window.padule.stringToDateYYYYMMDDHHMM = function(stringdate, format) {
    var date, dateFormat;
    format || (format = "yyyy/MM/dd HH:mm");
    dateFormat = new DateFormat(format);
    date = dateFormat.parse(stringdate);
    return date;
  };

  window.padule.checkDateFormat = function(stringdate) {
    var date, day, month, year;
    if (!stringdate.match(/^\d{4}\/\d{2}\/\d{2}$/)) {
      return false;
    }
    year = stringdate.substr(0, 4) - 0;
    month = stringdate.substr(5, 2) - 1;
    day = stringdate.substr(8, 2) - 0;
    if (month >= 0 && month <= 11 && day >= 1 && day <= 31) {
      date = new Date(year, month, day);
      if (isNaN(date)) {
        return false;
      } else if (date.getFullYear() === year && date.getMonth() === month && date.getDate() === day) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  };

  window.padule.changeLine = function(txt) {
    return txt.replace(/\r\n/g, '\n').replace(/\r/g, '\n');
  };

  window.padule.changeTxtList = function(txt) {
    var line, lines, target, _i, _len;
    if (txt === '' || txt === null || txt === void 0) {
      return '<p></p>';
    }
    lines = txt.split('\n');
    target = '';
    for (_i = 0, _len = lines.length; _i < _len; _i++) {
      line = lines[_i];
      if (line === '') {
        line = '&nbsp;';
      }
      target = "" + target + "<p>" + line + "</p>";
    }
    return target;
  };

  window.padule.clearTimeoutAll = function() {
    var highestTimeoutId, i, _i, _results;
    highestTimeoutId = setTimeout(';');
    _results = [];
    for (i = _i = 0; 0 <= highestTimeoutId ? _i <= highestTimeoutId : _i >= highestTimeoutId; i = 0 <= highestTimeoutId ? ++_i : --_i) {
      _results.push(clearTimeout(i));
    }
    return _results;
  };

  Backbone.ajaxSync = Backbone.sync;

  Backbone.sync = function(method, model, options, error) {
    return (Backbone.getSyncMethod(model)).apply(this, [method, model, options, error]);
  };

  Backbone.getSyncMethod = function(model) {
    if (!padule.use_localstorage) {
      return Backbone.ajaxSync;
    }
    if (model.localStorage || (model.collection && model.collection.localStorage)) {
      return Backbone.localSync;
    }
    return Backbone.ajaxSync;
  };

}).call(this);
