FROM openjdk:17-jdk-slim

WORKDIR /app

COPY HolaMundo.java .

# Compila y ejecuta el programa Java para que genere index.html
RUN javac HolaMundo.java && java HolaMundo

# Instala Python3 para servir el archivo
RUN apt-get update && apt-get install -y python3 && rm -rf /var/lib/apt/lists/*

EXPOSE 8000

CMD ["python3", "-m", "http.server", "8000"]
