package destore;

import java.rmi.RemoteException;
import java.rmi.registry.LocateRegistry;
import java.rmi.registry.Registry;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import destore.interfaces.IReceiver;



public class GUIModel {
	private Registry registry;
	private IReceiver stub;
	private Map<String,ProductInfo> db = new HashMap<String,ProductInfo>();
	private List<String[]> dbsales = new ArrayList<String[]>();
	
	
	public GUIModel() {
		loadRegistry();
		
		// Fill db with sample data
		try {
			for (String name : stub.getProducts()) {
				db.put(name, new ProductInfo(name,1,1.95f));
				
			}
		} catch (RemoteException e) {
			e.printStackTrace();
		}
		
				
	}

	private void loadRegistry() {
		try {
			// Get the registry from the server (null = local host)
			registry = LocateRegistry.getRegistry(null);

			// Look up the remote object
			stub = (IReceiver) registry.lookup("AppLayer");

			
		} catch (Exception e) {
			System.err.println("Client exception: " + e.toString());
			e.printStackTrace();
		}
	}

	public void sendPurchase(Purchase purchase) {
		try {
			stub.sendPurchaseToServer(purchase);
			System.out.println("Purchase sent.");
			if (db.containsKey(purchase.getItems())) {
				//Decrease quantity from DB
				ProductInfo q = db.get(purchase.getItems()); 
				q.quantity = q.quantity>0 ? q.quantity-1:0;
				//Order supplies if minimum amount reached
				if(q.quantity<=0) {
					stub.requestSupplies(purchase.getShopID(), q.name, 10);
					System.out.println("Supplies request sent: "+q.name+"");
				}
				//Update DB with new data
				db.put(purchase.getItems(), q);
			}
		} catch (RemoteException e) {
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

	public int getQuantity(String productName) {
		if(db.containsKey(productName)) return db.get(productName).quantity;
		return 0;
	}
	
	public float getPrice(String productName) {
		if(db.containsKey(productName)) return db.get(productName).price;
		return 0;
	}

	public void editProduct(String productName, int quantity, float price) {
		ProductInfo pi = new ProductInfo(productName,quantity,price);
		db.put(productName, pi); // Store into local db
		System.out.println("Product updated: "+productName);
	}
	
	public void saveOffer(String prod, String saleType) {
		dbsales.add(new String[] {prod,saleType}); // Store into local db
		System.out.println("Offer: \""+saleType+" in "+prod+"\" STORED into local db.");
	}
	public List<String[]> getSales() {
		return dbsales;
	}
	public void removeOffer(int index) {
		String[] r = dbsales.get(index);
		System.out.println("Offer: \""+r[1]+" in "+r[0]+"\" REMOVED from local db.");
		dbsales.remove(index);
	}
	
	public String analysisGeneric() {
		try {
			return stub.analysisGeneric();
		} catch (RemoteException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return null;
	}
	
}
