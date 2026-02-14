"use strict";

var _nodeFs = _interopRequireDefault(require("node:fs"));

var _nodeReadline = _interopRequireDefault(require("node:readline"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

// const file = "./copia_seguridad/registro.txt";
var file = process.argv[2];
if (file === undefined) throw "Error, debe indicar un archivo de entrada";
var lines = 0;

var rl = _nodeReadline["default"].createInterface({
  input: _nodeFs["default"].createReadStream(file),
  crlfDelay: Infinity
});

rl.on("line", function (line) {
  if (lines == 5) return;
  ++lines;
  console.log("En la linea ".concat(lines, " hay ").concat(line.length, " caracetes"));
});
rl.on("close", function () {
  console.log("Numero total de lineas " + lines);
});