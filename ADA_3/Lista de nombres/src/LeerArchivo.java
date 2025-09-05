import java.io.*;
import java.util.ArrayList;
public class LeerArchivo {
    protected ArrayList<String> nombres;
    
    public LeerArchivo(){
        nombres = new ArrayList<String>();
        try (BufferedReader lector = new BufferedReader(new FileReader("nombres.txt"))) {
            String linea;
            while ((linea = lector.readLine()) != null) {
                nombres.add(linea); 
            }
        } catch (IOException e) {
            System.out.println("Error al leer el archivo: " + e.getMessage());
        }
    }

    public ArrayList<String> getNombres(){
        return nombres;
    }
    
    public void imprimirLista(){
        System.out.println(nombres.toString());
    }
    
}
