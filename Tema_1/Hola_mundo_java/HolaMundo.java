    import java.io.FileWriter;
    import java.io.IOException;
    import java.io.PrintWriter;

    public class HolaMundo{
        public static void main(String[] args) {
            try (PrintWriter writer = new PrintWriter(new FileWriter("index.html"))) {
                writer.println("<!DOCTYPE html>");
                writer.println("<html lang='es'>");
                writer.println("<head>");
                writer.println("  <meta charset='UTF-8'>");
                writer.println("  <title>Ejemplo HTML</title>");
                writer.println("</head>");
                writer.println("<body>");
                writer.println("  <h1>¡Hola desde Java!</h1>");
                writer.println("  <p>Este párrafo fue creado con Java.</p>");
                writer.println("</body>");
                writer.println("</html>");
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }