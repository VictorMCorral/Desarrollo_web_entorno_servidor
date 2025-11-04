// Conéctate a 'admin' para autenticarte, luego usa 'myapp'
db = db.getSiblingDB('myapp');

db.Pizzas.insertMany([
  {
    nombre: "Margherita",
    descripcion: "Clásica pizza italiana con salsa de tomate, mozzarella y albahaca fresca.",
    precio: 12.50,
    ingredientes: ["salsa de tomate", "mozzarella", "albahaca", "aceite de oliva"],
    vegetariana: true,
    picante: false,
    categoria: "tradicional"
  },
  {
    nombre: "Diablo",
    descripcion: "Para los amantes del picante: salchicha, jalapeños, chile serrano y salsa picante.",
    precio: 16.00,
    ingredientes: ["salsa de tomate", "mozzarella", "salchicha", "jalapeños", "chile serrano", "salsa picante"],
    vegetariana: false,
    picante: true,
    categoria: "picante"
  }
]);

print("✅ Pizzas insertadas en 'myapp'.");