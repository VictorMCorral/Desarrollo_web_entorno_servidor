"use strict";

var _nodeFs = _interopRequireDefault(require("node:fs"));

var _nodeReadline = _interopRequireDefault(require("node:readline"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var rl = _nodeReadline["default"].createInterface(process.stdin, process.stdout);

rl.question("¿Como te llamas?", function (answer) {
  var stream = _nodeFs["default"].createWriteStream("./".concat(answer, ".md"));

  rl.setPrompt("¿Que quieres decir? (exit si quieres salir)");
  rl.prompt();
  rl.on("line", function (data) {
    if (data.toLowerCase().trim() === "exit") {
      stream.close();
      rl.close();
    } else {
      stream.write("".concat(data, "\n"));
      rl.prompt();
    }
  });
  rl.on("close", function () {
    console.log("Se termina la escritura");
  });
});