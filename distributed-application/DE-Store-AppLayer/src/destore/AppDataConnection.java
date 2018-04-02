package destore;

import java.rmi.RemoteException;
import java.rmi.registry.LocateRegistry;
import java.rmi.registry.Registry;

import destore.interfaces.IDataReceiver;

public class AppDataConnection {
	Registry registry;
	IDataReceiver stub;
	
	public AppDataConnection() {
		try {
			// Get the registry from the server (null = local host)
			registry = LocateRegistry.getRegistry(null, 1098);

			// Look up the remote object
			stub = (IDataReceiver) registry.lookup("DataLayer");
			
		} catch (Exception e) {
			System.err.println("Client exception: " + e.toString());
			e.printStackTrace();
		}
	}
	
	public String[] getProductList() {
		try {
			return stub.getProducts();
		} catch (RemoteException e) {
			System.out.println("GUIModel exception.");
			e.printStackTrace();
		}
		return null;
	}
	public void sendPurchaseToServer(Purchase purchase) {
		try {
			stub.sendPurchaseToServer(purchase);
		} catch (RemoteException e) {
			System.out.println("ERROR sending purchase to Data Layer.");
			e.printStackTrace();
		}
	}
	public Purchase[] getAllPurchases() {
		try {
			return stub.getAllPurchases();
		} catch (RemoteException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return null;
	}

}
