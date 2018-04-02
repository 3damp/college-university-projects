package destore;

import java.rmi.registry.LocateRegistry;
import java.rmi.registry.Registry;
import java.rmi.server.UnicastRemoteObject;

import destore.interfaces.IDataReceiver;

public class RunDataLayer {

	private static DBManager dbmgr;
	private static DataController dataController;

	public static void main(String[] args) {
		
		dbmgr = new DBManager();
		dataController = new DataController(dbmgr);
		createRegistry(dataController);
	}
	
	private static void createRegistry(DataController controller) {
		try {
			// Start the registry
			Registry registry = LocateRegistry.createRegistry(1098);

			// Instantiate the concrete class
			DataReceiver acc = new DataReceiver(controller);

			// Export the stub using the interface specification
			IDataReceiver stub = (IDataReceiver) UnicastRemoteObject.exportObject(acc, 0);

			// Bind the stub to the name "Account" in the registry
			registry.bind("DataLayer", stub);

			System.out.println("Data Layer ready\n########################");

		} catch (Exception e) {
			System.err.println("Server exception: " + e.toString());
			e.printStackTrace();
		}
	}
}
