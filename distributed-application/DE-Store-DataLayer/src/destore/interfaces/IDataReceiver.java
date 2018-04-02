package destore.interfaces;

import java.rmi.Remote;
import java.rmi.RemoteException;

import destore.Purchase;

public interface IDataReceiver extends Remote{
	String[] getProducts() throws RemoteException;  
	boolean sendPurchaseToServer(Purchase purchase) throws RemoteException;
	Purchase[] getAllPurchases()throws RemoteException;
}
