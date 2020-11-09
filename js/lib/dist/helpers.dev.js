"use strict";

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(source, true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(source).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function setCookie(name, value) {
  var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
  options = _objectSpread({
    path: '/'
  }, options);

  if (options.expires instanceof Date) {
    options.expires = options.expires.toUTCString();
  }

  var updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

  for (var optionKey in options) {
    updatedCookie += "; " + optionKey;
    var optionValue = options[optionKey];

    if (optionValue !== true) {
      updatedCookie += "=" + optionValue;
    }
  }

  document.cookie = updatedCookie;
}

function deleteCookie(name) {
  setCookie(name, "", {
    'max-age': -1
  });
}

function getCookie(name) {
  var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
  return matches ? decodeURIComponent(matches[1]) : undefined;
} // Пример использования:
// setCookie('user', 'John', {secure: true, 'max-age': 3600});


function unixToTime(t) {
  var unix_timestamp = t; // Create a new JavaScript Date object based on the timestamp
  // multiplied by 1000 so that the argument is in milliseconds, not seconds.

  var date = new Date(unix_timestamp * 1000); // Hours part from the timestamp

  var hours = date.getHours(); // Minutes part from the timestamp

  var minutes = "0" + date.getMinutes(); // Seconds part from the timestamp

  var seconds = "0" + date.getSeconds(); // Will display time in 10:30:23 format

  return hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
}

function unixToDate(t) {
  return new Date(t * 1000);
}

function setStore(n, d) {
  window.localStorage.setItem(n, d);
  setCookie(n, d, {
    secure: true,
    'max-age': 900000
  });
  return true;
}

function removeStore() {
  var n = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

  if (n === false) {} else {}

  return true;
}

function getStore(n) {
  if (getCookie(n) != undefined) {
    return getCookie(n);
  } else {
    return window.localStorage.getItem(n);
  }
}

function date_to_start(d, now) {
  var nowDate = now;
  var achiveDate = new Date(d); //Задаем дату, к которой будет осуществляться обратный отсчет

  var result = achiveDate - nowDate + 1000;

  if (result < 0) {
    return {
      time: '0:00:00',
      red: true
    };
    return undefined;
  }

  var seconds = Math.floor(result / 1000 % 60);
  var minutes = Math.floor(result / 1000 / 60 % 60);
  var hours = Math.floor(result / 1000 / 60 / 60 % 24);
  var days = Math.floor(result / 1000 / 60 / 60 / 24);
  if (seconds < 10) seconds = '0' + seconds;
  if (minutes < 10) minutes = '0' + minutes;
  if (hours < 10) hours = '0' + hours;
  return {
    time: (days > 0 ? days + ':' : '') + hours + ':' + minutes + ':' + seconds,
    red: result / 1000 < 2 * 3600
  };
}

function microtime() {
  return parseInt(new Date().getTime() / 1000);
}

var b64toBlobAlt = function b64toBlobAlt(dataURI, contentType) {
  var ab, byteString, i, ia;
  byteString = atob(dataURI.split(',')[1]);
  ab = new ArrayBuffer(byteString.length);
  ia = new Uint8Array(ab);
  i = 0;

  while (i < byteString.length) {
    ia[i] = byteString.charCodeAt(i);
    i++;
  }

  return new Blob([ab], {
    type: contentType
  });
};