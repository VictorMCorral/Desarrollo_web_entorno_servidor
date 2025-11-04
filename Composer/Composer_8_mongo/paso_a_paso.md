  ## Instrucciones Mongo DB y Docker
  ### Copiar Script en contenedor php
  ``` 
   docker cp init-pizzas.js mongodb-db:/tmp/init-pizzas.js
  ```

  ### Insertar Script en mongo db
  ```
  docker exec -it mongodb-db mongosh admin -u developer -p devpassword --authenticationDatabase admin /tmp/init-pizzas.js
  ```

  ### Entrar en Mongo db
  ```
  docker exec -it mongodb-db mongosh admin -u developer -p devpassword
  ```

  ```mongodb
    use myapp
    db.Pizzas.insertMany([
        {...
        },
        {...
        }
        ])
  ```

  ### Mostrar contenido collection
  #### Encontrar registros normales: 
  ``` 
    db.Pizzas.find()
  ```
  #### Encontrar registros normales de modo pretty: 
  ``` 
    db.Pizzas.find().pretty()
  ```
  #### Encontrar cantidad de registros:  
  ``` 
    db.Pizzas.countDocuments()
  ```

  ### Salir
  ```
    exit
  ```