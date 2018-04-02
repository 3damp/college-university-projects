package destore;

import java.rmi.registry.LocateRegistry;
import java.rmi.registry.Registry;
import java.rmi.server.UnicastRemoteObject;

import destore.interfaces.IReceiver;

public class RunAppLayer {
	private static AppController controller;
	private static AppDataConnection dConnection;
	
	public static void main(String[] args) {
		dConnection = new AppDataConnection();
		controller = new AppController(dConnection);
		createRegistry(controller);
	}
	
	private static void createRegistry(AppController controller) {
		try {
			// Start the registry
			Registry registry = LocateRegistry.createRegistry(1099);

			// Instantiate the concrete class
			Receiver acc = new Receiver(controller);

			// Export the stub using the interface specification
			IReceiver stub = (IReceiver) UnicastRemoteObject.exportObject(acc, 0);

			// Bind the stub to the name "Account" in the registry
			registry.bind("AppLayer", stub);

			System.out.println("Application Layer ready\n########################");

		} catch (Exception e) {
			System.err.println("Server exception: " + e.toString());
			e.printStackTrace();
		}
	}

}
