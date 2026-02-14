"use strict";

var _nodeFs = _interopRequireDefault(require("node:fs"));

var _nodeReadline = _interopRequireDefault(require("node:readline"));

var _nodeStream = require("node:stream");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function _awaitAsyncGenerator(value) { return new _AwaitValue(value); }

function _wrapAsyncGenerator(fn) { return function () { return new _AsyncGenerator(fn.apply(this, arguments)); }; }

function _AsyncGenerator(gen) { var front, back; function send(key, arg) { return new Promise(function (resolve, reject) { var request = { key: key, arg: arg, resolve: resolve, reject: reject, next: null }; if (back) { back = back.next = request; } else { front = back = request; resume(key, arg); } }); } function resume(key, arg) { try { var result = gen[key](arg); var value = result.value; var wrappedAwait = value instanceof _AwaitValue; Promise.resolve(wrappedAwait ? value.wrapped : value).then(function (arg) { if (wrappedAwait) { resume(key === "return" ? "return" : "next", arg); return; } settle(result.done ? "return" : "normal", arg); }, function (err) { resume("throw", err); }); } catch (err) { settle("throw", err); } } function settle(type, value) { switch (type) { case "return": front.resolve({ value: value, done: true }); break; case "throw": front.reject(value); break; default: front.resolve({ value: value, done: false }); break; } front = front.next; if (front) { resume(front.key, front.arg); } else { back = null; } } this._invoke = send; if (typeof gen["return"] !== "function") { this["return"] = undefined; } }

if (typeof Symbol === "function" && Symbol.asyncIterator) { _AsyncGenerator.prototype[Symbol.asyncIterator] = function () { return this; }; }

_AsyncGenerator.prototype.next = function (arg) { return this._invoke("next", arg); };

_AsyncGenerator.prototype["throw"] = function (arg) { return this._invoke("throw", arg); };

_AsyncGenerator.prototype["return"] = function (arg) { return this._invoke("return", arg); };

function _AwaitValue(value) { this.wrapped = value; }

function _asyncIterator(iterable) { var method; if (typeof Symbol !== "undefined") { if (Symbol.asyncIterator) { method = iterable[Symbol.asyncIterator]; if (method != null) return method.call(iterable); } if (Symbol.iterator) { method = iterable[Symbol.iterator]; if (method != null) return method.call(iterable); } } throw new TypeError("Object is not async iterable"); }

var archivo_pasado = process.argv[2];
var cantidad_lineas = process.argv[3];
var archivo = "./copia_seguridad/".concat(archivo_pasado); // async function processLineByLine(archivo, cantidad_lineas){
//     const fileStream = fs.createReadStream(archivo);
//     let lines = 0;
//     const rl = Readline.createInterface({
//         input: fileStream,
//         crlfDelay: Infinity
//     })
//     for await (const line of rl){
//         if(lines == cantidad_lineas) return;
//         ++lines
//         console.log(`Linea ${lines} => ${line}`);
//     }
// }
// processLineByLine(archivo, cantidad_lineas);

function leerLineas(_x) {
  return _leerLineas.apply(this, arguments);
}

function _leerLineas() {
  _leerLineas = _wrapAsyncGenerator(
  /*#__PURE__*/
  regeneratorRuntime.mark(function _callee(archivo) {
    var fileStream, rl, _iteratorNormalCompletion, _didIteratorError, _iteratorError, _iterator, _step, _value, linea;

    return regeneratorRuntime.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            fileStream = _nodeFs["default"].createReadStream(archivo, {
              encoding: "utf8"
            });
            rl = _nodeReadline["default"].createInterface({
              input: fileStream,
              crlfDelay: Infinity
            });
            _iteratorNormalCompletion = true;
            _didIteratorError = false;
            _context.prev = 4;
            _iterator = _asyncIterator(rl);

          case 6:
            _context.next = 8;
            return _awaitAsyncGenerator(_iterator.next());

          case 8:
            _step = _context.sent;
            _iteratorNormalCompletion = _step.done;
            _context.next = 12;
            return _awaitAsyncGenerator(_step.value);

          case 12:
            _value = _context.sent;

            if (_iteratorNormalCompletion) {
              _context.next = 20;
              break;
            }

            linea = _value;
            _context.next = 17;
            return linea;

          case 17:
            _iteratorNormalCompletion = true;
            _context.next = 6;
            break;

          case 20:
            _context.next = 26;
            break;

          case 22:
            _context.prev = 22;
            _context.t0 = _context["catch"](4);
            _didIteratorError = true;
            _iteratorError = _context.t0;

          case 26:
            _context.prev = 26;
            _context.prev = 27;

            if (!(!_iteratorNormalCompletion && _iterator["return"] != null)) {
              _context.next = 31;
              break;
            }

            _context.next = 31;
            return _awaitAsyncGenerator(_iterator["return"]());

          case 31:
            _context.prev = 31;

            if (!_didIteratorError) {
              _context.next = 34;
              break;
            }

            throw _iteratorError;

          case 34:
            return _context.finish(31);

          case 35:
            return _context.finish(26);

          case 36:
          case "end":
            return _context.stop();
        }
      }
    }, _callee, null, [[4, 22, 26, 36], [27,, 31, 35]]);
  }));
  return _leerLineas.apply(this, arguments);
}

function procesarArchivo(archivo, cantidad_lineas) {
  var iteradorDeLineas, streamLimitado, lineas, _iteratorNormalCompletion2, _didIteratorError2, _iteratorError2, _iterator2, _step2, _value2, linea;

  return regeneratorRuntime.async(function procesarArchivo$(_context2) {
    while (1) {
      switch (_context2.prev = _context2.next) {
        case 0:
          iteradorDeLineas = leerLineas(archivo); //Cierra el stream automáticamente: Una vez que se han procesado esas N líneas, el método .take() finaliza el stream (emite el evento end).

          streamLimitado = _nodeStream.Readable.from(iteradorDeLineas).take(cantidad_lineas); //Eficiencia: Al llegar al límite, deja de pedir más datos al iteradorDeLineas. Esto es muy útil si el archivo original tiene millones de 
          // líneas pero tú solo quieres procesar las primeras 100, ya que evita leer el resto del archivo innecesariamente.

          lineas = 0;
          streamLimitado.on('data', function () {
            console.log("--------------------------------- ".concat(lineas, " ---------------------------------"));
          });
          streamLimitado.on('close', function () {
            console.log("\n----------- El stream ha finalizado de emitir datos. -----------\n");
            streamLimitado.destroy();
          });
          _iteratorNormalCompletion2 = true;
          _didIteratorError2 = false;
          _context2.prev = 7;
          _iterator2 = _asyncIterator(streamLimitado);

        case 9:
          _context2.next = 11;
          return regeneratorRuntime.awrap(_iterator2.next());

        case 11:
          _step2 = _context2.sent;
          _iteratorNormalCompletion2 = _step2.done;
          _context2.next = 15;
          return regeneratorRuntime.awrap(_step2.value);

        case 15:
          _value2 = _context2.sent;

          if (_iteratorNormalCompletion2) {
            _context2.next = 23;
            break;
          }

          linea = _value2;
          lineas++;
          console.log("Procesando linea ".concat(lineas, ": ").concat(linea));

        case 20:
          _iteratorNormalCompletion2 = true;
          _context2.next = 9;
          break;

        case 23:
          _context2.next = 29;
          break;

        case 25:
          _context2.prev = 25;
          _context2.t0 = _context2["catch"](7);
          _didIteratorError2 = true;
          _iteratorError2 = _context2.t0;

        case 29:
          _context2.prev = 29;
          _context2.prev = 30;

          if (!(!_iteratorNormalCompletion2 && _iterator2["return"] != null)) {
            _context2.next = 34;
            break;
          }

          _context2.next = 34;
          return regeneratorRuntime.awrap(_iterator2["return"]());

        case 34:
          _context2.prev = 34;

          if (!_didIteratorError2) {
            _context2.next = 37;
            break;
          }

          throw _iteratorError2;

        case 37:
          return _context2.finish(34);

        case 38:
          return _context2.finish(29);

        case 39:
        case "end":
          return _context2.stop();
      }
    }
  }, null, null, [[7, 25, 29, 39], [30,, 34, 38]]);
}

procesarArchivo(archivo, cantidad_lineas);