"use strict";

var _nodeFs = _interopRequireDefault(require("node:fs"));

var _nodeStream = require("node:stream");

var _promises = require("node:stream/promises");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var aMinusculas = new _nodeStream.Transform({
  transform: function transform(datos, _enc, cb) {
    this.push(datos.toString('utf8').toLowerCase());
    cb();
  }
});
var cambiarTexto = new _nodeStream.Transform({
  transform: function transform(datos, _enc, cb) {
    var textoBuscar = "hora";
    var textoCambiar = "AAAAAAAAAAAAAAAAAAAAAAA";
    var datosAlmacenados = datos.toString("utf8").replaceAll(textoBuscar, textoCambiar);
    this.push(datosAlmacenados.toString("utf8"));
    cb();
  }
}); // fs.createReadStream("./copia_seguridad/registro.txt", { encoding: "utf8"})
//     .pipe(aMinusculas)
//     .pipe(fs.createWriteStream("./copia_seguridad/registro_transform.txt"), {enconding: "utf8"})
//     .on("finish", ()=> {
//         console.log("Transformacion a minusculas finalizada")
//     })
//     .on("error", (err)=> {
//         console.log("Transformacion a minusculas finalizada erroneamente " + err)
//     })

(function _callee() {
  return regeneratorRuntime.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.prev = 0;
          _context.next = 3;
          return regeneratorRuntime.awrap((0, _promises.pipeline)(_nodeFs["default"].createReadStream("./copia_seguridad/registro.txt", {
            encoding: "utf8"
          }), cambiarTexto, _nodeFs["default"].createWriteStream("./copia_seguridad/registro_transform_pipeline_textocambiado.txt", {
            encoding: "utf8"
          })));

        case 3:
          console.log("Tarea terminada con pipeline");
          _context.next = 9;
          break;

        case 6:
          _context.prev = 6;
          _context.t0 = _context["catch"](0);
          console.log("Tarea terminada con pipeline erroneamente " + _context.t0);

        case 9:
        case "end":
          return _context.stop();
      }
    }
  }, null, null, [[0, 6]]);
})();