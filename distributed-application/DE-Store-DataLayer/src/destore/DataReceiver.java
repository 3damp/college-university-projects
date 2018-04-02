package destore;

import java.rmi.RemoteException;

import destore.interfaces.IDataReceiver;

public class DataReceiver implements IDataReceiver{
	
	private DataController controller;

	public DataReceiver(DataController c) {
		this.controller = c;
	}
	
	
	@Override
	public String[] getProducts() throws RemoteException {
		return controller.getProducts();
	}

	@Override
	public boolean sendPurchaseToServer(Purchase purchase) throws RemoteException {
		controller.storePurchase(purchase);
		return false;
	}

	@Override
	public Purchase[] getAllPurchases() throws RemoteException {
		return controller.getAllPurchases();
	}


}
