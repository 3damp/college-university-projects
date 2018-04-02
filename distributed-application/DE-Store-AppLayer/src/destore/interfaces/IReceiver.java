package destore.interfaces;

import java.rmi.Remote;
import java.rmi.RemoteException;

import destore.Purchase;

public interface IReceiver extends Remote {
	String[] getProducts() throws RemoteException;

	boolean sendPurchaseToServer(Purchase purchase) throws RemoteException;

	void requestSupplies(int shop, String product, int i)throws RemoteException;  	
	
	String analysisGeneric() throws RemoteException;
}
