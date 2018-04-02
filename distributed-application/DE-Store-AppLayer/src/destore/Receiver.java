package destore;

import java.rmi.RemoteException;

import destore.interfaces.IReceiver;

public class Receiver implements IReceiver{
		
	private AppController controller;

	public Receiver(AppController c) {
		this.controller = c;
	}
	
	
	@Override
	public String[] getProducts() throws RemoteException {
		return controller.getProducts();
	}

	@Override
	public boolean sendPurchaseToServer(Purchase purchase) {
		controller.sendPurchaseToServer(purchase);
		return true;
	}


	@Override
	public void requestSupplies(int shop, String product, int quantity) throws RemoteException {
		controller.requestSupplies(shop, product, quantity);
		
	}


	@Override
	public String analysisGeneric() throws RemoteException {
		return controller.analysisGeneric();
	}

}
